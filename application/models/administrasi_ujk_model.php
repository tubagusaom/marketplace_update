<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Administrasi_ujk_model extends MY_Model {
    public function __construct() {
        $this->_table = kode_tbl()."asesi";
        parent::__construct($this->_table);
    }
    protected $_table;
    protected $table_label = 'Data Administrasi UJK';
    protected $_columns = array(
        'u_date_create' => array(
            'label' => 'Registration Date',
            'rule' => 'trim|xss_clean',
            'formatter' => 'datetime',
            'save_formatter' => 'string',
            'width' => 170,
            'align' => 'center'
        ),
        'id_users' => array(
            'label' => 'Skema Sertifikasi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 250,
            'hidden' => 'true'


        ),
        'skema_sertifikasi' => array(
            'label' => 'Skema Sertifikasi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'skema',
            'save_formatter' => 'string',
            'width' => 250,

        ),
        'nama_lengkap' => array(
            'label' => 'Complete Name',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 170,

        ),
        'no_uji_kompetensi' => array(
            'label' => 'UJK Number',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 170,
            'hidden' => 'true'
        ),
        'telp' => array(
            'label' => 'Telp',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 120,

            'hidden' => 'true'
        ),
        'email' => array(
            'label' => 'Email',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 120,
            'hidden' => 'true'
        ),
        'pra_asesmen_date' => array(
            'label' => 'Pra Date',
            'rule' => 'trim|xss_clean',
            'formatter' => 'general_date',
            'save_formatter' => 'date',
            'width' => 120,
            'hidden' => 'true'
        ),
        'pra_asesmen_description' => array(
            'label' => 'Pra Asesmen Date ',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 120,
            'hidden' => 'true'

        ),
        'pra_asesmen_checked' => array(
            'label' => 'Checked Pra Asesmen',
            'rule' => 'trim|xss_clean',
            'formatter' => 'nama_user',
            'save_formatter' => 'string',
            'width' => 210,
            'hidden' => 'true'

        ),
        'administrasi_ujk' => array(
            'label' => 'Adm Status',
            'rule' => 'trim|xss_clean',
            'formatter' => array('-','Selesai','Belum Selesai','Kirim Invoice'),
            'save_formatter' => 'string',
            'width' => 120,

        ),
        'sumber_pendanaan' => array(
            'label' => 'Sumber Dana',
            'rule' => 'trim|xss_clean',
            'formatter' => array('-','Subsidi BNSP','Mandiri','Lain-lain'),
            'save_formatter' => 'string',
            'width' => 120,

        ),
        'metode_pembayaran' => array(
            'label' => 'Metode Bayar',
            'rule' => 'trim|xss_clean',
            'formatter' => array('-','Tunai','Transfer Bank'),
            'save_formatter' => 'string',
            'width' => 120,
            'hidden' => 'true'

        ),
        'tanggal_bayar' => array(
            'label' => 'Tanggal Pembayaran',
            'rule' => 'trim|xss_clean',
            'formatter' => 'general_date',
            'save_formatter' => 'date',
            'width' => 120,
            'hidden' => 'true'

        ),
        'atas_nama' => array(
            'label' => 'Atas Nama',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 110,
            'hidden' => 'true'

        ),
        'jumlah_pembayaran' => array(
            'label' => 'Jumlah Pembayaran',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'align' => 'center'


        ),
        'bukti_pembayaran' => array(
            'label' => 'Bukti Pembayaran',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 140,


        ),

    );
    protected $_order = array("id" => "DESC");

        protected $belongs_to = array(
          'skema' =>  array(
          'model' => 'skema_model',
          'primary_key' => 'skema_sertifikasi',
          'retrieve_columns' => array('skema'),
          'join_type' => 'left'
          ),
          'user' =>  array(
          'model' => 'user_model',
          'primary_key' => 'pra_asesmen_checked',
          'retrieve_columns' => array('nama_user','jenis_user'),
          'join_type' => 'left'

          )
      );
    protected $_unique = array('unique' => array('instruktur_code'), 'group' => false);
    function get_biaya($id){
        $asesi = kode_tbl().'asesi';
        $skema = kode_tbl().'skema';
        $query = $this->db->query("SELECT a.skema_sertifikasi,b.biaya_skema
                                                FROM $asesi a
                                                JOIN $skema b ON b.id=a.skema_sertifikasi
                                                WHERE a.id=$id")->row();
        return $query;
    }
    function get_asesi($id){
        $this->db->select('a.id,a.nama_lengkap,a.alamat,b.skema');
        $this->db->from(kode_tbl().'asesi a');
        $this->db->join(kode_tbl().'skema b','a.skema_sertifikasi=b.id');
        $this->db->where('a.id',$id);
        return $this->db->get()->row();
    }
}
