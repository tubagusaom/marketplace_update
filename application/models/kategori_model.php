<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Kategori_model extends MY_Model {

    protected $_table = 'tbl007_kategori';
    protected $table_label = 'Data Kategori';
    protected $_columns = array(
        'id_menu' => array(
            'label' => 'Menu',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'menu_kategori',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'kategori' => array(
            'label' => 'Sub Kategori',
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

    protected $belongs_to = array(
        'menu_kategori' => array(
            'model' => 'menu_kategori_model',
            'primary_key' => 'id_menu',
            'retrieve_columns' => array('menu_kategori')
        )
    );

    protected $_order = array("kategori" => "ASC");
    protected $_unique = array('unique' => array('id'), 'group' => false);

    function __construct() {
        parent::__construct();
    }


}
