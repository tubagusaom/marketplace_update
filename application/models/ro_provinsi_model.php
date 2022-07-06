<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
Class Ro_provinsi_model extends MY_Model {

    public function __construct() {
        $this->_table = "m_ro_provinsi";
        parent::__construct($this->_table);
    }
    protected $_table;
    protected $table_label = 'Data Provinsi';
    protected $_columns = array(
        'province_name' => array(
            'label' => 'Provinsi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
    );
    protected $_order = array("province_id" => "DESC");

    protected $_unique = array('unique' => array('province_id'), 'group' => false);

}
