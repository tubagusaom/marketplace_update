<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class V_Karyawan_Model extends MY_Model {

    protected $_table = 'v_karyawan';
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
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'jabatan' => array(
            'label' => 'Position',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'jabatan',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'mulai_kerja' => array(
            'label' => 'Working Early',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'telepon' => array(
            'label' => 'Telephone',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
//        'gender' => array(
//            'label' => 'Gender',
//            'rule' => 'trim|required|xss_clean',
//            'formatter' => 'string',
//            'save_formatter' => 'string',
//            'width' => 150
//        ),
//        'status' => array(
//            'label' => 'Status',
//            'rule' => 'trim|required|xss_clean',
//            'formatter' => 'string',
//            'save_formatter' => 'string',
//            'width' => 150
//        ),
//        'agama' => array(
//            'label' => 'Agama',
//            'rule' => 'trim|required|xss_clean',
//            'formatter' => 'string',
//            'save_formatter' => 'string',
//            'width' => 150
//        ),
//        'tempat_lahir' => array(
//            'label' => 'Tempat Lahir',
//            'rule' => 'trim|required|xss_clean',
//            'formatter' => 'string',
//            'save_formatter' => 'string',
//            'width' => 150
//        ),
//        'tgl_lahir' => array(
//            'label' => 'Tanggal Lahir',
//            'rule' => 'trim|required|xss_clean',
//            'formatter' => 'string',
//            'save_formatter' => 'string',
//            'width' => 150
//        ),
        'pendidikan' => array(
            'label' => 'Pendidikan',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
//        'ktp' => array(
//            'label' => 'No KTP',
//            'rule' => 'trim|required|xss_clean',
//            'formatter' => 'string',
//            'save_formatter' => 'string',
//            'width' => 150
//        ),
//        'masa_berlaku' => array(
//            'label' => 'Masa Berlaku',
//            'rule' => 'trim|required|xss_clean',
//            'formatter' => 'string',
//            'save_formatter' => 'string',
//            'width' => 150
//        ),
//        'alamat' => array(
//            'label' => 'Alamat',
//            'rule' => 'trim|required|xss_clean',
//            'formatter' => 'string',
//            'save_formatter' => 'string',
//            'width' => 150
//        ),
        'status_karyawan' => array(
            'label' => 'Status Karyawan',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'awal_kontrak' => array(
            'label' => 'Awal Kontrak',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'habis_kontrak' => array(
            'label' => 'Habis Kontrak',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        )
    );
    
    protected $belongs_to = array(
        'jabatan' => array(
            'model' => 'jabatan_model',
            'primary_key' => 'id',
            'retrieve_columns' => array('jabatan')
        )
    );
    protected $_order = "id";
    protected $_unique = array('unique' => array('nik'), 'group' => true);

    function __construct() {
        parent::__construct();
    }

}
