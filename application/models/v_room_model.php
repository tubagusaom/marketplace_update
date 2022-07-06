<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Room_model extends MY_Model {

    protected $_table = 't_room';
    protected $table_label = 'Data Room';
    protected $_columns = array(
        'room_code' => array(
            'label' => 'Code Room',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'room_name' => array(
            'label' => 'Nama Room',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'capacity' => array(
            'label' => 'Capacity',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'description' => array(
            'label' => 'Description',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        )
    );
    protected $_order = array("id" => "ASC");

    /* 	protected $belongs_to = array(
      'divisi' =>  array(
      'model' => 'Divisi_Model',
      'primary_key' => 'divisi_id',
      'retrieve_columns' => array('nama_singkat')
      )
      );
     */
    protected $_unique = array('unique' => array('room_code'), 'group' => false);

    function __construct() {
        parent::__construct();
    }

}
