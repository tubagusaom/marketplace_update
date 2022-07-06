<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Asesi_update_model extends MY_Model {

    public function __construct() {
        $this->_table = kode_tbl()."asesi"; 
        parent::__construct($this->_table);
    }
    protected $_table;
    protected $table_label = 'Data Pendaftaran UJK';
    protected $_columns = array(
        'u_date_create' => array(
            'label' => 'Registration Date',
            'rule' => 'trim|xss_clean',
            'formatter' => 'datetime',
            'save_formatter' => 'string',
            'width' => 170,
            'align' => 'center'
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
            
        ),'no_identitas' => array(
            'label' => 'Identity Number',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 170
        ),
        'no_uji_kompetensi' => array(
            'label' => 'UJK Number',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 170,
            'hidden' => 'true'
        ),
        'tempat_lahir' => array(
            'label' => 'Birth Place',
            'rule' => 'trim||xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 120,
            'hidden' => 'true',
        ),
        'tgl_lahir' => array(
            'label' => 'Birth Date',
            'rule' => 'trim|xss_clean',
            'formatter' => 'general_date',
            'save_formatter' => 'date',
            'width' => 100,
            'align' =>'center',
            'hidden' => 'true',
        ),
        'jenis_kelamin' => array(
            'label' => 'Sex',
            'rule' => 'trim|xss_clean',
            'formatter' => array('-','Pria','Wanita'),
            'save_formatter' => 'string',
            'width' => 60,
            
        ),
        'telp' => array(
            'label' => 'Telp',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 120,
            
        ),
        'email' => array(
            'label' => 'Email',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 120,
            'hidden' => 'true',
        ),
        'alamat' => array(
            'label' => 'Pra ',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'hidden' => 'true',
            
        ),
        'pra_asesmen_checked' => array(
            'label' => 'Checked Pra Asesmen',
            'rule' => 'trim|xss_clean',
            'formatter' => 'nama_user',
            'save_formatter' => 'string',
            'width' => 210,
            
        ),
        'file_bukti_pendukung' => array(
            'label' => 'Checked Pra Asesmen',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 210,
            'hidden'=>'true'
            
        ),
        'pra_asesmen_description' => array(
            'label' => 'Checked Pra Asesmen',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 210,
            'hidden'=>'true'
            
        )
    );
    protected $_order = array("u_date_create" => "DESC");

      protected $belongs_to = array(
          'skema' =>  array(
          'model' => 'skema_model',
          'primary_key' => 'skema_sertifikasi',
          'retrieve_columns' => array('skema')
          ),
          'user' =>  array(
          'model' => 'user_model',
          'primary_key' => 'pra_asesmen_checked',
          'retrieve_columns' => array('nama_user','jenis_user'),
          'join_type' => 'left'
          ),
      );
      
    protected $_unique = array('unique' => array('instruktur_code'), 'group' => false);

    function data_asesi($id){
        $this->db->select('a.*,b.skema,b.kode_skema');
        $this->db->from('lsp029_asesi a');
        $this->db->join('lsp029_skema b','a.skema_sertifikasi=b.id');
        $this->db->where('a.id',$id);
        $detail_asesi = $this->db->get()->row();
        return $detail_asesi;
    }
    
    function data_unit_kompetensi($id){
        $query = $this->db->query("select a.id_unit_kompetensi,a.unit_kompetensi
    from lsp029_unit_kompetensi a
    JOIN lsp029_skema_detail b ON b.id_unit_kompetensi=a.id
    WHERE b.id_skema =$id");
    return $query->result();
    }
    
    function asesi_detail($id){
        $this->db->where('asesi_id',$id);
        $detail_asesi = $this->db->get(kode_tbl().'asesi_detail')->result();
        return $detail_asesi;
    }
    function elemen($id){
        $query = $this->db->query("SELECT a.*
        FROM lsp029_elemen_kompetensi a
        WHERE a.id_unit_kompetensi=(SELECT id
        FROM lsp029_unit_kompetensi WHERE id_unit_kompetensi='$id')");
        return $query->result();
    }
    function kuk($id){
        $query = $this->db->query("SELECT *
        FROM lsp029_kuk a
        WHERE a.id_elemen_kompetensi=$id");
        return $query->result();
    }
}
