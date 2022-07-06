<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Peserta_diklat_model extends MY_Model {

    protected $_table = 'js_kegiatan';
    protected $table_label = 'Data Peserta Diklat';
    protected $_columns = array(
        'dk_date_create' => array(
            'label' => 'Tanggal ',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 130,
            'align' => 'center'
        ),'dk_name_full' => array(
            'label' => 'Nama Lengkap',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 180
        ),
        'dk_born_place' => array(
            'label' => 'Tanggal Lahir',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 100,
            'hidden' => true
        ),
        'dk_born_date' => array(
            'label' => 'Born Date',
            'rule' => 'trim|xss_clean',
            'formatter' => 'date',
            'save_formatter' => 'string',
            'width' => 80,
            'align' => 'center',
            'hidden' => true
        ),
        'dk_address' => array(
            'label' => 'Alamat',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 180,
            'align' => 'center'
        ),
        'dk_office_name' => array(
            'label' => 'Office',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 100
        ),
        'dk_office_position' => array(
            'label' => 'Biaya',
            'rule' => 'trim|xss_clean',
            'formatter' => 'rupiah',
            'save_formatter' => 'string',
            'width' => 80,
            'hidden' => true
        ),
        'dk_edu' => array(
            'label' => 'Pendidikan',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 80,
            'hidden' => true
        ),
        'dk_tel' => array(
            'label' => 'Telpon',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 80,
            'hidden' => true
        ),
        'dk_hp' => array(
            'label' => 'HP',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 100
        ),
        'dk_fax' => array(
            'label' => 'Biaya',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 80,
            'hidden' => true
        ),
        'dk_email' => array(
            'label' => 'Email',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 120
        ),
        'dk_status_paid' => array(
            'label' => 'Paid',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 60,
            'align' => 'center'
        ),
        'akses_login' => array(
            'label' => 'Login',
            'rule' => 'trim|xss_clean',
            'formatter' => array('<label style="background-color:red">N</label>','Y'),
            'save_formatter' => 'string',
            'width' => 60,
            'align' => 'center'
        )
    );
    
    protected $_order = array("id" => "ASC");
    protected $_unique = array('unique' => array('id'), 'group' => false);

    function __construct() {
        parent::__construct();
    }  
}