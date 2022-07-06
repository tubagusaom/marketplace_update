<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Skema_model extends MY_Model {

     public function __construct() {
        $this->_table = kode_tbl()."skema";
        parent::__construct($this->_table);
    }
    protected $_table;
    protected $table_label = 'Data Skema Sertifikasi';
    protected $_columns = array(
        'kode_skema' => array(
            'label' => 'Kode Skema',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 70
        ),
        'skema' => array(
            'label' => 'Skema Sertifikasi',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 190
        ),
        'kategori_skema' => array(
            'label' => 'Kategori',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 80
        ),
        'jumlah_unit' => array(
            'label' => 'Jumlah Unit',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 90,
            'align' => 'center'
        ),
        'description' => array(
            'label' => 'description',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => 'true'
        ),
        'bidang_title' => array(
            'label' => 'description',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => 'true'
        ),
        'bidang' => array(
            'label' => 'description',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => 'true'
        ),
        'link_download' => array(
            'label' => 'Download Skema',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => 'true'
        ),
        'link_skkni' => array(
            'label' => 'Download Skema',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'hidden' => 'true'
        ),
        'title_skema' => array(
            'label' => 'Download Skema',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'hidden' => 'true'
        ),
        'link_apl' => array(
            'label' => 'Download Skema',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'hidden' => 'true'
        ),
        'kblui' => array(
            'label' => 'KBLUI',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 80,
            'align' => 'center'
        ),
        'kbji' => array(
            'label' => 'KBJI',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 80,
            'align' => 'center'
        ),
        'jenjang' => array(
            'label' => 'Jenjang',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 80,
            'align' => 'center'
        ),
        'kode_sektor' => array(
            'label' => 'Kode Sektor',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 80,
            'align' => 'center'
        ),
        'id_prodi' => array(
            'label' => 'Prodi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'program_studi',
            'save_formatter' => 'string',
            'width' => 200
        ),
        'semester' => array(
            'label' => 'Semester',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 80,
            'align' => 'center'
        ),
    );

    protected $belongs_to = array(
        'program_studi' => array(
            'model' => 'prodi_model',
            'primary_key' => 'id_prodi',
            'retrieve_columns' => array('program_studi'),
            'join_type' => 'left'
        )
    );

    protected $_order = array("id" => "ASC");

    protected $_unique = array('unique' => array('kode_skema'), 'group' => false);

}
