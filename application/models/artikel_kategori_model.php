<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Artikel_Kategori_Model extends MY_Model {
    
     public function __construct() {
        $this->_table = kode_tbl()."artikel_kategori"; 
        parent::__construct($this->_table);
    }
    protected $_table;
    protected $table_label = 'Artikel Kategori';
    protected $_columns = array(
        'kategori' => array(
            'label' => 'Kategori',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'description' => array(
            'label' => 'Description',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
//        'nik' => array(
//            'label' => 'NIK',
//            'rule' => 'trim|xss_clean',
//            'formatter' => 'string',
//            'save_formatter' => 'int',
//            'width' => 150
//        ),
//        'foto' => array(
//            'label' => 'Photo',
//            'rule' => 'trim|xss_clean',
//            'formatter' => 'url2images',
//            'save_formatter' => 'string',
//            'width' => 150
//        )
    );
    
//    protected $belongs_to = array(
//        'jabatan' => array(
//            'model' => 'jabatan_model',
//            'primary_key' => 'jabatan_id',
//            'retrieve_columns' => array('jabatan')
//        )
//    );
//    
//    function url2images($url)
//    {
//        return "<img width=100px height=130px src='" . base_url() . "assets/img/karyawan/" . $url . "'/>";
//    }
//    
    protected $_order = "id";
    protected $_unique = array('unique' => array('id'), 'group' => false);

   

}