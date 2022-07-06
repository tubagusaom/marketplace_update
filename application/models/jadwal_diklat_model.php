<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Jadwal_diklat_model extends MY_Model {

    protected $_table = 'js_kegiatan';
    protected $table_label = 'Data Jadwal Diklat';
    protected $_columns = array(
        'kg_code' => array(
            'label' => 'Kode',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 50,
            'hidden' => true
        ),
        'kg_title' => array(
            'label' => 'Nama Kegiatan Diklat',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 350
        ),
        'kg_date' => array(
            'label' => 'Start Date',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 80,
            'align' => 'center'
        ),
        'kg_date_exp' => array(
            'label' => 'End Date',
            'rule' => 'trim|xss_clean',
            'formatter' => 'date',
            'save_formatter' => 'string',
            'width' => 80,
            'align' => 'center'
        ),
        'kg_price' => array(
            'label' => 'Biaya',
            'rule' => 'trim|xss_clean',
            'formatter' => 'rupiah',
            'save_formatter' => 'string',
            'width' => 80
        ),
        'total_peserta' => array(
            'label' => 'Total<br/>Peserta',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 50,
            'align' => 'center'
        ),
        'total_paid' => array(
            'label' => 'Paid',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 50,
            'align' => 'center'
        ),
        'total_not_paid' => array(
            'label' => 'Unpaid',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 50,
            'align' => 'center'
        )
    );
    
    protected $_order = array("id" => "ASC");
    protected $_unique = array('unique' => array('id'), 'group' => false);

    function __construct() {
        parent::__construct();
    }

  
    
}