<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Produk_Model extends MY_Model {

    protected $_table = 'm_pelatihan';
    protected $table_label = 'Data Pelatihan';
    protected $_columns = array(
        'nama_pelatihan' => array(
            'label' => 'Nama Pelatihan',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'durasi' => array(
            'label' => 'Durasi Waktu',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'jam' => array(
            'label' => 'Jam',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'deskripsi' => array(
            'label' => 'Description',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'biaya' => array(
            'label' => 'Biaya',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'id_trainer' => array(
            'label' => 'Narasumber',
            'rule' => 'trim|xss_clean',
            'formatter' => 'nama_trainer',
            'save_formatter' => 'string',
            'width' => 150
        )
    );
    
    protected $belongs_to = array(
        'nama_trainer' => array(
            'model' => 'trainer_model',
            'primary_key' => 'id_trainer',
            'retrieve_columns' => array('nama_trainer')
        )
    );
    
    protected $_order = array("id" => "ASC");
    protected $_unique = array('unique' => array('id'), 'group' => false);

    function __construct() {
        parent::__construct();
    }

}