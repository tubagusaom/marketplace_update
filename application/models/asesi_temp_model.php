<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Asesi_temp_model extends MY_Model {

   // protected $_table = 'lsp029_import_elemen';
    public function __construct() {
        $this->_table = kode_tbl()."calon_asesi_temp";
        parent::__construct($this->_table);
    }
    protected $_table;

    protected $table_label = 'Data Import asesi';
    protected $_columns = array(

        'nim_asesi' => array(
            'label' => 'Nim',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 100,

        ),
        'nama_asesi' => array(
            'label' => 'Nama',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 170,

        ),
        'tahun_akademik_asesi' => array(
            'label' => 'Tahun Akademik',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 250,

        ),
        'program_studi_asesi' => array(
            'label' => 'Program Studi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 170,

        ),'semester_asesi' => array(
            'label' => 'Semester',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 110
        ),'kelas_asesi' => array(
            'label' => 'Kelas',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 270
        ),'hp_asesi' => array(
            'label' => 'HP',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 120
        ),'email_asesi' => array(
            'label' => 'Email',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 130
        )
    );
    protected $_order = array("id" => "ASC");
    protected $_unique = array('unique' => array('id'), 'group' => false);
}
