<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Distribusi_model extends MY_Model {
    
     public function __construct() {
        $this->_table = kode_tbl()."asesi"; 
        parent::__construct($this->_table);
    }
    protected $_table;
    protected $table_label = 'Data Distribusi Sertifikat';
    protected $_columns = array(
        'skema_sertifikasi' => array(
            'label' => 'Skema Sertifikasi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'skema',
            'save_formatter' => 'string',
            'width' => 250,
        ),
        'nama_lengkap' => array(
            'label' => 'Nama lengkap',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            
        ),
        'tgl_pengiriman' => array(
            'label' => 'Tanggal pengiriman',
            'rule' => 'trim|xss_clean',
            'formatter' => 'general_date',
            'save_formatter' => 'date',
            'width' => 90,
            'align' => 'center'
        ),
        'via_pengiriman' => array(
            'label' => 'Kurir',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 90,
            
        ),
        'tertuju' => array(
            'label' => 'Tertuju',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 100
            
        ),
        'tgl_menerima' => array(
            'label' => 'Tanggal Menerima',
            'rule' => 'trim|xss_clean',
            'formatter' => 'general_date',
            'save_formatter' => 'date',
            'width' => 90,
            'align' => 'center'
        ),
        'nama_penerima' => array(
            'label' => 'Nama Penerima',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 110,
            'align' => 'center'
        )
    );
    protected $_order = array("id" => "DESC");
    protected $belongs_to = array(
          'skema' =>  array(
          'model' => 'skema_model',
          'primary_key' => 'skema_sertifikasi',
          'retrieve_columns' => array('skema')
          )
      );
   
    protected $_unique = array('unique' => array('id'), 'group' => false);
    
}
