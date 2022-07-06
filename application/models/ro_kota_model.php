<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
Class Ro_kota_model extends MY_Model {

    public function __construct() {
        $this->_table = "m_ro_kota";
        parent::__construct($this->_table);
    }
    protected $_table;
    protected $table_label = 'Data Provinsi';
    protected $_columns = array(
        'city_name' => array(
            'label' => 'Kota',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
    );
    protected $_order = array("city_id" => "DESC");

    protected $_unique = array('unique' => array('city_id'), 'group' => false);

}
