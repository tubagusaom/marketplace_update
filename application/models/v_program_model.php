<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class V_Program_Model extends MY_Model {

    protected $_table = 't_program';
    protected $table_label = 'Data Program Study';
    protected $_columns = array(
        'program_study' => array(
            'label' => 'Program Name',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'abr' => array(
            'label' => 'Abreviation',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 50
        )
    );

    protected $_order = array("id" => "ASC");
    protected $_unique = array('unique' => array('id'), 'group' => false);

    function __construct() {
        parent::__construct();
    }
}
