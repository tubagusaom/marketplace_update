<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Import_asesor_model extends MY_Model {

   // protected $_table = 'lsp029_import_skema';
    public function __construct() {
        $this->_table = kode_tbl()."asesor_temp"; 
        parent::__construct($this->_table);
    }
    protected $_table;
        
    protected $table_label = 'Data Import Asesor';
    protected $_columns = array(
       'no_registrasi' => array(
            'label' => 'No Registrasi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'align' => 'center'
        ),
        'nama' => array(
            'label' => 'Nama',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 250
        ),
        'no_sertifikat' => array(
            'label' => 'No Sertifikat',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 100
        ),
        'no_blanko' => array(
            'label' => 'No Blanko',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 100
        ),
        'email' => array(
            'label' => 'Email',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 130
        ),
        'hp' => array(
            'label' => 'HP',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 90,
            'align' => 'center'
        ),
        'bidang' => array(
            'label' => 'Bidang',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 90,
            'align' => 'center'
        ),
        'tahun_laporan' => array(
            'label' => 'Tahun Laporan',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 90,
            'align' => 'center'
        ),
        'provinsi' => array(
            'label' => 'Provinsi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 90,
            'align' => 'center'
        ),

    );
    protected $_order = array("id" => "ASC");
      
    protected $_unique = array('unique' => array('id'), 'group' => false);

}