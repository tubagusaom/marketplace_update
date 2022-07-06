<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Menu_kategori_model extends MY_Model {

    protected $_table = 'tbl007_menu_kategori';
    protected $table_label = 'Data Menu';
    protected $_columns = array(
        'menu_kategori' => array(
            'label' => 'Kategori',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'description' => array(
            'label' => 'Keterangan',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        )
    );

    protected $_order = array("id" => "ASC");
    protected $_unique = array('unique' => array('id'), 'group' => false);

    function __construct() {
        parent::__construct();
    }


}
