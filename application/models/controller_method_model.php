<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Controller_Method_Model extends MY_Model {

    protected $_table = 't_controller_method';
    protected $table_label = 'Data Controller Method';
    protected $_columns = array(
        'controller_id' => array(
            'label' => 'Controller ID',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'controller_name',
            'save_formatter' => 'int',
            'width' => 150
        ),
        'method_id' => array(
            'label' => 'Method ID',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'method_name',
            'save_formatter' => 'int',
            'width' => 150
        )
    );
    protected $belongs_to = array(
        'controller' => array(
            'model' => 'Controller_Model',
            'primary_key' => 'controller_id',
            'retrieve_columns' => array('controller_name')
        ),
        'method' => array(
            'model' => 'Method_Model',
            'primary_key' => 'method_id',
            'retrieve_columns' => array('method_name')
        )
    );
    protected $_order = array("t_controller_method.id" => "DESC");
    protected $_unique = array('unique' => array('controller_id', 'method_id'), 'group' => true);

    function __construct() {
        parent::__construct();
    }

}
