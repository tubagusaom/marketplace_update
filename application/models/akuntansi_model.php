<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Akuntansi_Model extends MY_Model {
    
    public function __construct() {
        $this->_table = "acc_group_akun"; 
        parent::__construct($this->_table);
    }
    protected $_table;
    protected $table_label = 'Data Group Akun';
    protected $_columns = array(
        'nama_group' => array(
            'label' => 'Nama Group',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'kode_group' => array(
            'label' => 'Kode Group',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 50
        )
        
    );
    
    protected $_order = array("kode_group" => "ASC");
}
