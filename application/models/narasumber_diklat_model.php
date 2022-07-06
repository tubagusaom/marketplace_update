<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Narasumber_diklat_model extends MY_Model {

    protected $_table = 'js_diklat';
    protected $table_label = 'Data Narasumber';
    protected $_columns = array(
        'dk_name_full' => array(
            'label' => 'Nama Lengkap',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        )
    );
    
    protected $_order = array("id" => "ASC");
    protected $_unique = array('unique' => array('id'), 'group' => false);

    function __construct() {
        parent::__construct();
    }

  
    
}