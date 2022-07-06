<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class V_Instruktur_model extends MY_Model {

    protected $_table = 't_instruktur';
    protected $table_label = 'Instructor Data';
    protected $_columns = array(
        'instruktur_code' => array(
            'label' => ' Code',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'instruktur_name' => array(
            'label' => 'Instructor Name',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        )
    );
    protected $_order = "instruktur_code, instruktur_name";
    protected $_unique = array('unique' => array('instruktur_code'), 'group' => false);

    function __construct() {
        parent::__construct();
    }

}
