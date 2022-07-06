<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Sertifikat_model extends MY_Model {

     public function __construct() {
        $this->_table = kode_tbl()."asesi";
        parent::__construct($this->_table);
    }
    protected $_table;
    protected $table_label = 'Data Sertifikat';
    protected $_columns = array(
        'skema_sertifikasi' => array(
            'label' => 'Skema Sertifikasi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'skema',
            'save_formatter' => 'string',
            'width' => 190,
            'hidden' => 'true'
        ),
        'nama_lengkap' => array(
            'label' => 'Complete Name',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 140,

        ),
        'no_registrasi' => array(
            'label' => 'No Registrasi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 110,
            'align'=>'center'
        ),
        'no_sertifikat' => array(
            'label' => 'No Sertifikat',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 140,
            'align'=>'center'

        ),
        'no_seri' => array(
            'label' => 'No Seri/Blanko',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 90,
            'align'=>'center'

        ),
        'id_asesor' => array(
            'label' => 'Nama Asesor',
            'rule' => 'trim|xss_clean',
            'formatter' => 'users',
            'save_formatter' => 'string',
            'width' => 120,
            'hidden' => 'true'
        ),
        'tanggal_terbit' => array(
            'label' => 'Tanggal Terbit',
            'rule' => 'trim|xss_clean',
            'formatter' => 'general_date',
            'save_formatter' => 'date',
            'width' => 90,
            'align' => 'center'
        ),
        'tanggal_rcc' => array(
            'label' => 'Tanggal Expired',
            'rule' => 'trim|xss_clean',
            'formatter' => 'general_date',
            'save_formatter' => 'date',
            'width' => 90,
            'align' => 'center'
        ),
        'is_posting' => array(
            'label' => 'is posting',
            'rule' => 'trim|xss_clean',
            'formatter' => array('N','Y'),
            'save_formatter' => 'string',
            'width' => 80,
            'align'=>'center',
             'hidden' => 'true'
        ),
        'tanggal_terima_sertifikat' => array(
            'label' => 'Terima Sertifikat',
            'rule' => 'trim|xss_clean',
            'formatter' => 'general_date',
            'save_formatter' => 'date',
            'width' => 90,
            'align' => 'center'
        ),
        'metode_terima' => array(
            'label' => 'Motode Terima',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 120,
            'hidden' => 'true',

        ),
        'file_sertifikat' => array(
            'label' => 'Nama Asesor',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 120,
            'hidden' => 'true'
        ),
        'file_sertifikat_belakang' => array(
            'label' => 'Nama Asesor',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 120,
            'hidden' => 'true'
        )
    );
    protected $_order = array("jadwal_id" => "DESC");

      protected $belongs_to = array(
          'skema' =>  array(
          'model' => 'skema_model',
          'primary_key' => 'skema_sertifikasi',
          'retrieve_columns' => array('skema'),
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
    function sertifikat($id){
        $this->db->select('a.id,a.nama_lengkap,a.no_registrasi,a.telp,a.no_seri,a.no_sertifikat,a.skema_sertifikasi,b.skema,b.bidang,b.bidang_title,b.title_skema,a.tanggal_terbit');
        $this->db->from(kode_tbl().'asesi a');
        $this->db->join(kode_tbl().'skema b','a.skema_sertifikasi=b.id');
        $this->db->where('a.id',$id);
        return $this->db->get()->row();
    }
}
