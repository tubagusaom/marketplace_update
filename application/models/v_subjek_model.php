<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class V_Subjek_Model extends MY_Model {

    protected $_table = 't_subject';
    protected $table_label = 'Data Subject';
    protected $_columns = array(
        'subject_name' => array(
            'label' => 'Subject',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 350
        ),
        'total_hours' => array(
            'label' => 'Hours',
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
