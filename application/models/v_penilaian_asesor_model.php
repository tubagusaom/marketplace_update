<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class V_penilaian_asesor_model extends MY_Model {

     public function __construct() {
        $this->_table = "v_penilaian_asesor"; 
        parent::__construct($this->_table);
    }
    protected $_table;
    protected $table_label = 'Data Asesi';
    protected $_columns = array(
        'nama_calon' => array(
            'label' => 'Nama Asesi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 70
        ),
        'id_mahasiswa' => array(
            'label' => 'ID Mahasiswa',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 70
        ),
        'id_asesor' => array(
            'label' => 'ID Asesor',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 190
        )
    );
    protected $_order = array("id" => "ASC");

    protected $_unique = array('unique' => array('id'), 'group' => false);

}
