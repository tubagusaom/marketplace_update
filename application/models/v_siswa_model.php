<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class V_Siswa_model extends MY_Model {

    protected $_table = 't_siswa';
    protected $table_label = 'Student Data';
    protected $_columns = array(
        'nis' => array(
            'label' => 'NIS',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 100
        ),
        'nama' => array(
            'label' => 'Name',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        )
    );
    protected $_order = "nis,nama";
    protected $_unique = array('unique' => array('nis'), 'group' => false);

    function __construct() {
        parent::__construct();
    }

}
