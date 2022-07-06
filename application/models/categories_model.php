<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Categories_Model extends MY_Model {
    
    protected $_table = 't_categories';
    protected $table_label = 'Categories Repositori';
    protected $_columns = array(
        'categories' => array(
            'label' => 'Categories',
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
        ),
    );
    
    protected $_order = "id";
    protected $_unique = array('unique' => array('id'), 'group' => false);

    function __construct() {
        parent::__construct();
    }

}