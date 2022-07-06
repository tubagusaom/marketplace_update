<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class V_Schedule_model extends MY_Model {

    protected $_table = 'v_schedule';
    protected $table_label = 'Schedule Data';
    protected $_columns = array(
        'schedule_date' => array(
            'label' => 'Schedule Date',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'general_date',
            'save_formatter' => 'date',
            'width' => 110,
            'align' => 'center'
        ),'nama' => array(
            'label' => 'Student Name',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 155
        ),'subject_category' => array(
            'label' => 'Category',
            'rule' => 'trim|required|xss_clean',
            'formatter' => array('','Ground','Flight','Simulator'),
            'save_formatter' => 'string',
            'width' => 80
        ),
        'program_study' => array(
            'label' => 'Program Study',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 130
        ),
        'current_program' => array(
            'label' => 'Current',
            'rule' => 'trim|xss_clean',
            'formatter' => array('-','PPL Ground', 'CPL-IR Ground', 'PPL Flight', 'CPL Flight','IR','ME','CRM','Avsec','DG'),
            'save_formatter' => 'string',
            'width' => 105,
            'align' => 'center'
        ),
        'instruktur_name' => array(
            'label' => 'Instructor',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 125
        ),
        'plane_name' => array(
            'label' => 'Plane/Simulator',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 140
        ),
        'nama_airport' => array(
            'label' => 'Departure',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 115
        ),
        'nama_airport2' => array(
            'label' => 'Destination',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 115
        ),
        'from_time' => array(
            'label' => 'Start Period',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 75,
            'align' => 'center'
        ),
        'to_time' => array(
            'label' => 'End Period',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 75,
            'align' => 'center'
        ),
        'stage' => array(
            'label' => 'Stage',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 75,
            'align' => 'center'
        ),
        'siswa_id' => array(
            'label' => 'Student ID',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 75,
            'hidden' => 'true'
        ),
        'revision' => array(
            'label' => 'Revise',
            'rule' => 'trim|required|xss_clean',
            'formatter' => array("New","Revise 1","Revise 2","Revise 3"),
            'save_formatter' => 'string',
            'width' => 90
        )
    );
    protected $_order = array("schedule_date" => "DESC","subject_category" => "DESC");

     	protected $belongs_to = array(
            'nama' =>  array(
              'model' => 'siswa_model',
              'primary_key' => 'siswa_id',
              'retrieve_columns' => array('nama')
            ),
            'instruktur_name' =>  array(
              'model' => 'instruktur_model',
              'primary_key' => 'instruktur_id',
              'retrieve_columns' => array('instruktur_name')
            ),
            'plane_name' =>  array(
              'model' => 'plane_model',
              'primary_key' => 'plane_id',
              'retrieve_columns' => array('plane_name')
            ),
            'nama_airport' =>  array(
              'model' => 'airport_model',
              'primary_key' => 'from_airport',
              'retrieve_columns' => array('nama_airport')
            )
      );
    protected $_unique = array('unique' => array('siswa_id','schedule_date'), 'group' => true);

    function __construct() {
        parent::__construct();
    }

}
