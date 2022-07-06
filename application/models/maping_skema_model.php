<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Maping_skema_model extends MY_Model {

    protected $_table;
    protected $table_label = 'Data Mapping Skema';
    protected $_columns = array(

        'id_jadwal' => array(
            'label' => 'Jadwal Uji Kompetensi',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'jadual',
            'save_formatter' => 'string',
            'width' => 350
        ),
        'id_skema' => array(
            'label' => 'Skema Sertifikasi',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'skema',
            'save_formatter' => 'string',
            'width' => 280
        )
    );

    protected $belongs_to = array(
        'jadual' => array(
            'model' => 'jadwal_asesmen_model',
            'primary_key' => 'id_jadwal',
            'retrieve_columns' => array('jadual'),
            'join_type' => 'left'
        ),
        'skema' => array(
            'model' => 'skema_model',
            'primary_key' => 'id_skema',
            'retrieve_columns' => array('skema'),
            'join_type' => 'left'
        )
    );

    protected $_order = array("id" => "ASC");
    protected $_unique = array('unique' => array('id'), 'group' => false);

    function __construct() {
        parent::__construct();
        $this->_table = kode_tbl()."mapping_skema";
        parent::__construct($this->_table);
    }

}
