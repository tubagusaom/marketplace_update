<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class V_Plane_model extends MY_Model {

    protected $_table = 't_plane';
    protected $table_label = 'Data Aircraft';
    protected $_columns = array(
        'plane_code' => array(
            'label' => 'Plane Code',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 70
        ),
        'plane_name' => array(
            'label' => 'Aircraft Name',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'kategori' => array(
            'label' => 'Kategori',
            'rule' => 'trim|required|xss_clean',
            'formatter' => array('plane', 'simulator'),
            'save_formatter' => 'string',
            'width' => 150
        ),
        'status' => array(
            'label' => 'Status',
            'rule' => 'trim|required|xss_clean',
            'formatter' => array('Maintenance','OK'),
            'save_formatter' => 'string',
            'width' => 50
        )
    );
    protected $_order = array("id" => "ASC");

    protected $_unique = array('unique' => array('plane_code'), 'group' => false);

    function __construct() {
        parent::__construct();
    }

}
