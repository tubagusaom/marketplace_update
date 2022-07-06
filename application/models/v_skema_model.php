<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class V_Skema_model extends MY_Model {

     public function __construct() {
        $this->_table = kode_tbl()."skema"; 
        parent::__construct($this->_table);
    }
    protected $_table;
    protected $table_label = 'Data Skema Sertifikasi';
    protected $_columns = array(
        'kode_skema' => array(
            'label' => 'Kode Skema',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 70
        ),
        'skema' => array(
            'label' => 'Skema Sertifikasi',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 190
        )
    );
    protected $_order = array("id" => "ASC");

    protected $_unique = array('unique' => array('kode_skema'), 'group' => false);

}
