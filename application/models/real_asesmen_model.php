<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Real_asesmen_model extends MY_Model {

     public function __construct() {
        $this->_table = kode_tbl()."asesi";
        parent::__construct($this->_table);
    }
    protected $_table;
    protected $table_label = 'Data Real Asesmen';
    protected $_columns = array(
        'skema_sertifikasi' => array(
            'label' => 'Skema Sertifikasi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'skema',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => 'true'
        ),
        'id_users' => array(
            'label' => 'Skema Sertifikasi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 250,
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
        'nama_lengkap' => array(
            'label' => 'Complete Name',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,

        ),
        'no_uji_kompetensi' => array(
            'label' => 'No Uji Kompetensi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 120,
        ),
        'jadwal_id' => array(
            'label' => 'Jadwal Asesmen',
            'rule' => 'trim|xss_clean',
            'formatter' => 'jadual',
            'save_formatter' => 'string',
            'width' => 220,

        ),
        'administrasi_ujk' => array(
            'label' => 'Adm Status',
            'rule' => 'trim|xss_clean',
            'formatter' => array('-','Selesai','Belum Selesai'),
            'save_formatter' => 'string',
            'width' => 120,
            'hidden' => 'true'
        ),
        'id_asesor' => array(
            'label' => 'Nama Asesor',
            'rule' => 'trim|xss_clean',
            'formatter' => 'users',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'id_tuk' => array(
            'label' => 'TUK',
            'rule' => 'trim|xss_clean',
            'formatter' => 'tuk',
            'save_formatter' => 'string',
            'width' => 120

        )
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
          ),
          'jadwal_asesmen' =>  array(
          'model' => 'jadwal_asesmen_model',
          'primary_key' => 'jadwal_id',
          'retrieve_columns' => array('jadual','tanggal'),
          'join_type' => 'left'
          ),
          'asesor' =>  array(
          'model' => 'asesor_model',
          'primary_key' => 'id_asesor',
          'retrieve_columns' => array('users','no_reg'),
          'join_type' => 'left'
          ),
          'tuk' =>  array(
          'model' => 'tuk_model',
          'primary_key' => 'id_tuk',
          'retrieve_columns' => array('tuk'),
          'join_type' => 'left'
          )
      );
    protected $_unique = array('unique' => array('id'), 'group' => false);

    function data_asesi($id){
        $asesi = kode_tbl().'asesi';
        $jadual_asesmen = kode_tbl().'jadual_asesmen';
        $tuk = kode_tbl().'tuk';
        $skema = kode_tbl().'skema';

        $query = $this->db->query("SELECT a.no_uji_kompetensi,b.jadual,c.tuk,c.alamat as alamat_tuk,c.telp as telp_tuk,
        d.skema,d.kode_skema,a.*,b.tanggal as tanggal_mulai,b.tanggal_akhir
        FROM $asesi a
        JOIN $skema d ON d.id=a.skema_sertifikasi
        JOIN $jadual_asesmen b ON a.jadwal_id=b.id
        JOIN $tuk c ON c.id=a.id_tuk
        WHERE a.id=$id
        ");
        return $query->row();
    }
    function pra_asesmen_checked($id){
      $this->db->where('id',$id);
      $data = $this->db->get('t_users')->row();
      return $data;
    }
}
