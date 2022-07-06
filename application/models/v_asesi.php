<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class V_asesi extends MY_Model {

    protected $_table = 'v_asesi';
    protected $table_label = 'Data Asesi';
    protected $_columns = array(
        'nama_lengkap' => array(
            'label' => ' Full Name',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'u_date_create' => array(
            'label' => 'Register date',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 90
        ),
        'no_identitas' => array(
            'label' => 'Identity Number',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'jumlah_pembayaran' => array(
            'label' => 'Jumlah Tagihan',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        )
    );
    protected $_order = "id";
    protected $_unique = array('unique' => array('id'), 'group' => false);

    function __construct() {
        parent::__construct();
    }

}
