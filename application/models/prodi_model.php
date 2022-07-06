<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Prodi_model extends MY_Model {

     public function __construct() {
        $this->_table = "t_prodi";
        parent::__construct($this->_table);
    }
    protected $_table;
    protected $table_label = 'Data Program Studi';
    protected $_columns = array(
        'program_studi' => array(
            'label' => 'Program Studi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'id_tuk' => array(
            'label' => 'TUK',
            'rule' => 'trim|xss_clean',
            'formatter' => 'tuk',
            'save_formatter' => 'string',
            'width' => 150
        )
    );

    protected $belongs_to = array(
        'tuk' => array(
            'model' => 'tuk_model',
            'primary_key' => 'id_tuk',
            'retrieve_columns' => array('tuk'),
            'join_type' => 'left'
        )
    );

    protected $_order = array("id" => "DESC");

    protected $_unique = array('unique' => array(), 'group' => false);

}
