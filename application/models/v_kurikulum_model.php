<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class V_Kurikulum_Model extends MY_Model {

    protected $_table = 't_kurikulum';
    protected $table_label = 'Curriculum Data';
    protected $_columns = array(
        'nama_kurikulum' => array(
            'label' => 'Curriculum',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 350
        ),
        'hours' => array(
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
