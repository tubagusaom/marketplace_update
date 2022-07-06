<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Karyawan_Model extends MY_Model {

    protected $_table = 't_karyawan';
    protected $table_label = 'Employee Data';
    protected $_columns = array(
        'nama' => array(
            'label' => 'Employee Name',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'nik' => array(
            'label' => 'NIK',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'int',
            'width' => 150
        ),
        'jabatan_id' => array(
            'label' => 'Position',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'jabatan',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'mulai_kerja' => array(
            'label' => 'Mulai Kerja',
            'rule' => 'trim|xss_clean',
            'formatter' => 'general_date',
            'save_formatter' => 'date',
            'width' => 150,
            'hidden' => true
        ),
        'telepon' => array(
            'label' => 'Telephone',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'int',
            'width' => 150
        ),
        'gender' => array(
            'label' => 'Gender',
            'rule' => 'trim|xss_clean',
            'formatter' => array('Male','Female'),
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => true
        ),
        'status' => array(
            'label' => 'Status',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => true
        ),
        'agama' => array(
            'label' => 'Religion',
            'rule' => 'trim|xss_clean',
            'formatter' => array('Islam','Protestan','Catholic','Hindu','Buddhist','Khonghucu'),
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => true
        ),
        'tempat_lahir' => array(
            'label' => 'Birthplace',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => true
        ),
        'tgl_lahir' => array(
            'label' => 'Date of birth',
            'rule' => 'trim|xss_clean',
            'formatter' => 'general_date',
            'save_formatter' => 'date',
            'width' => 150,
            'hidden' => true
        ),
         'pendidikan' => array(
            'label' => 'Last Study',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
             'hidden' => true
        ),
        'ktp' => array(
            'label' => 'No KTP',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => true
        ),
        'masa_berlaku' => array(
            'label' => 'Expiration',
            'rule' => 'trim|xss_clean',
            'formatter' => 'general_date',
            'save_formatter' => 'date',
            'width' => 150,
            'hidden' => true
        ),
       'alamat' => array(
            'label' => 'Address',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'status_karyawan' => array(
            'label' => 'Employee Status',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => true
        ),
        'awal_kontrak' => array(
            'label' => 'Contract Early',
            'rule' => 'trim|xss_clean',
            'formatter' => 'general_date',
            'save_formatter' => 'date',
            'width' => 150,
            'hidden' => true
        ),
        'habis_kontrak' => array(
            'label' => 'End Of Contract',
            'rule' => 'trim|xss_clean',
            'formatter' => 'general_date',
            'save_formatter' => 'date',
            'width' => 150,
            'hidden' => true
        ),
        'foto' => array(
            'label' => 'Photo',
            'rule' => 'trim|xss_clean',
            'formatter' => 'url2images',
            'save_formatter' => 'string',
            'width' => 150
        )
    );
    
    protected $belongs_to = array(
        'jabatan' => array(
            'model' => 'jabatan_model',
            'primary_key' => 'jabatan_id',
            'retrieve_columns' => array('jabatan')
        )
    );
    
    function url2images($url)
    {
        return "<img width=100px height=130px src='" . base_url() . "assets/img/karyawan/" . $url . "'/>";
    }
    
    protected $_order = "id";
    protected $_unique = array('unique' => array('nik'), 'group' => true);

    function __construct() {
        parent::__construct();
    }

}
