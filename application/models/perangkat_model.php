<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Perangkat_model extends MY_Model {
    
     public function __construct() {
        $this->_table = "t_perangkat"; 
        parent::__construct($this->_table);
    }
    protected $_table;
    protected $table_label = 'Data Perangkat Sertifikat';
    protected $_columns = array(
//        'skema_sertifikasi' => array(
//            'label' => 'Skema Sertifikasi',
//            'rule' => 'trim|xss_clean',
//            'formatter' => 'skema',
//            'save_formatter' => 'string',
//            'width' => 150,
//        ),
        'sertifikat_teknis' => array(
            'label' => 'Sertifikasi Teknis',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 130,  
        ),
        'id_asesor' => array(
            'label' => 'Nama Asesor',
            'rule' => 'trim|xss_clean',
            'formatter' => 'users',
            'save_formatter' => 'string',
            'width' => 120,
        ),
        'id_skema' => array(
            'label' => 'Nama Asesor',
            'rule' => 'trim|xss_clean',
            'formatter' => 'skema',
            'save_formatter' => 'string',
            'width' => 120,
        )
    );
    protected $_order = array("id" => "ASC");

      protected $belongs_to = array(
          'skema' =>  array(
              'model' => 'skema_model',
              'primary_key' => 'skema_sertifikasi',
              'retrieve_columns' => array('skema')
          ),
          'asesor' =>  array(
              'model' => 'asesor_model',
              'primary_key' => 'id_asesor',
              'retrieve_columns' => array('users','no_reg'),
              'join_type' => 'left'
          )
      );
    protected $_unique = array('unique' => array('id'), 'group' => false);
//    function sertifikat($id){
//        $this->db->select('a.id,a.nama_lengkap,a.no_registrasi,a.no_sertifikat,a.skema_sertifikasi,b.skema,b.bidang,b.bidang_title,b.title_skema,a.tanggal_terbit');
//        $this->db->from(kode_tbl().'asesi a');
//        $this->db->join(kode_tbl().'skema b','a.skema_sertifikasi=b.id');
//        $this->db->where('a.id',$id);
//        return $this->db->get()->row();
//    }
}
