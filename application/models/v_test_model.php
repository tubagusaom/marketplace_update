<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class V_Test_model extends MY_Model {

    protected $_table = 'v_test';
    protected $table_label = 'Data Test';
    protected $_columns = array(
        'nama' => array(
            'label' => 'Student Name',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 120
        ),
        'subject_category' => array(
            'label' => 'Student Name',
            'rule' => 'trim|required|xss_clean',
            'formatter' => array("-","Solo Flight","PPL Checkride","CPL Checkride","IR Checkride","ME Checkride"),
            'save_formatter' => 'string',
            'width' => 120
        ),
        'instruktur_name' => array(
            'label' => 'Instructors',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 120
        ),
        'schedule_date' => array(
            'label' => 'Date',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'general_date',
            'save_formatter' => 'date',
            'width' => 120
        ),
        'plane_name' => array(
            'label' => 'Plane/Simulator',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 100
        ),
        'nama_airport' => array(
            'label' => 'Departure',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 120
        ),
        'nama_airport2' => array(
            'label' => 'Destination',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 120
        ),
        'from_time' => array(
            'label' => 'Start Period',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 90
        ),
        'to_time' => array(
            'label' => 'End Period',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 90
        ),
        'base' => array(
            'label' => 'Base',
            'rule' => 'trim|required|xss_clean',
            'formatter' => array("-","BTO","CBN","BKS"),
            'save_formatter' => 'string',
            'width' => 90
        )
    );
    protected $_order = array("schedule_date" => "DESC");
    protected $_unique = array('unique' => array('id','schedule_date'), 'group' => true);

    function __construct() {
        parent::__construct();
    }

}