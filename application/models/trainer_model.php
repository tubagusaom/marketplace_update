<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Trainer_Model extends MY_Model {

    protected $_table = 'm_trainer';
    protected $table_label = 'Data Narasumber';
    protected $_columns = array(
        'nama_trainer' => array(
            'label' => 'Nama Trainer',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'telp' => array(
            'label' => 'Telepon',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'email' => array(
            'label' => 'Email',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'email',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'foto' => array(
            'label' => 'Foto',
            'rule' => 'trim|xss_clean',
            'formatter' => 'url2images',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'pendidikan_terakhir' => array(
            'label' => 'Pendidikan',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'bidang' => array(
            'label' => 'Bidang',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        )
    );
    
    protected $belongs_to = array(
        'kategori' => array(
            'model' => 'artikel_kategori_model',
            'primary_key' => 'id_kategori',
            'retrieve_columns' => array('kategori')
        )
    );
    
    protected $_order = array("id" => "ASC");
    protected $_unique = array('unique' => array('id'), 'group' => false);

    function __construct() {
        parent::__construct();
    }

    function url2images($url)
    {
        if(!is_null($url) && !empty($url)) {
            return "<img width=80px height=80px src='" . base_url() . "assets/img/gallery/" . $url . "' class='img-circle' />";
        } else {
            return "<img width=80px height=80px src='" . base_url() . "uploads/slide/person_default.jpg' class='img-circle' />";
        }
    }

}