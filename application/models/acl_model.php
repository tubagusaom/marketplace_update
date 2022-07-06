<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Acl_Model extends MY_Model {

    protected $_table = 't_acl';
    protected $table_label = 'ACL Data';
    protected $_columns = array(
        'controller_method_id' => array(
            'label' => 'Controller Method ID',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'int',
            'save_formatter' => 'int',
            'width' => 150
        ),
        'role_id' => array(
            'label' => 'Role ID',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'nama_peran',
            'save_formatter' => 'int',
            'width' => 150
        ),
        'request_method' => array(
            'label' => 'HTTP Request Method',
            'rule' => 'trim|required|xss_clean',
            'formatter' => array(1 => 'AJAX', 2 => 'Non AJAX'),
            'save_formatter' => 'int',
            'width' => 150
        )
    );
    protected $belongs_to = array(
        'controller_method' => array(
            'model' => 'Controller_Method_Model',
            'primary_key' => 'controller_method_id',
            'retrieve_columns' => array('controller_id', 'method_id')
        ),
        'role' => array(
            'model' => 'Role_Model',
            'primary_key' => 'role_id',
            'retrieve_columns' => array('nama_peran', 'keterangan')
        )
    );
    protected $_order = "id";
    protected $_unique = array('unique' => array('controller_method_id', 'role_id'), 'group' => true);
    protected $_enum = array(
        'request_method' => array(1, 2)
    );

    function __construct() {
        parent::__construct();
    }

}
