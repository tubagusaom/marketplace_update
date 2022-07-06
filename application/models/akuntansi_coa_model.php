<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Akuntansi_Coa_Model extends MY_Model {
    
    public function __construct() {
        $this->_table = "acc_rekening"; 
        parent::__construct($this->_table);
    }
    protected $_table;
    protected $table_label = 'Data  Akun';
    protected $_columns = array(
        'kode_akun' => array(
            'label' => 'Kode Akun',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 50
        ),
        'nama_akun' => array(
            'label' => 'Nama Akun',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'tipe' => array(
            'label' => 'Tipe Akun',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 50
        ),
        'saldonormal' => array(
            'label' => 'Saldo Normal',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 50
        ),
        'level' => array(
            'label' => 'Level Akun',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 50
        )
        
    );
    
    protected $_order = array("kode_akun" => "ASC");
    //protected $_where = array("level" => "4");
}
