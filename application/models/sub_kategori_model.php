<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Sub_kategori_model extends MY_Model {

    protected $_table = 'tbl007_sub_kategori';
    protected $table_label = 'Data Sub Kategori';
    protected $_columns = array(
        'id_kategori' => array(
            'label' => 'Kategori',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'kategori',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'sub_kategori' => array(
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
        'kategori' => array(
            'model' => 'kategori_model',
            'primary_key' => 'id_kategori',
            'retrieve_columns' => array('kategori')
        )
    );

    protected $_order = array("sub_kategori" => "ASC");
    protected $_unique = array('unique' => array('id'), 'group' => false);

    function __construct() {
        parent::__construct();
    }


}
