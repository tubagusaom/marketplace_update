<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Angkatan_model extends MY_Model {

     public function __construct() {
        $this->_table = "t_angkatan";
        parent::__construct($this->_table);
    }
    protected $_table;
    protected $table_label = 'Data Angkatan';
    protected $_columns = array(
        'angkatan' => array(
            'label' => 'Angkatan',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        )
    );
    protected $_order = array("id" => "ASC");

    protected $_unique = array('unique' => array(), 'group' => false);

}
