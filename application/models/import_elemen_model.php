<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Import_elemen_model extends MY_Model {

   // protected $_table = 'lsp029_import_elemen';
    public function __construct() {
        $this->_table = kode_tbl()."elemen_temp"; 
        parent::__construct($this->_table);
    }
    protected $_table;
        
    protected $table_label = 'Data Import elemen';
    protected $_columns = array(
       
        'kode_unit' => array(
            'label' => 'Kode Unit',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 100,
            
        ),
        'unit' => array(
            'label' => 'Unit Kompetensi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 250,
            
        ),
        'elemen' => array(
            'label' => 'Elemen Kompetensi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 170,
            
        ),
        'kuk' => array(
            'label' => 'KUK',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 170,
            
        ),'pertanyaan_kuk' => array(
            'label' => 'Pertanyaan KUK',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 270
        ),'jumlah_bukti' => array(
            'label' => 'Jumlah Bukti',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 110
        ),'bukti' => array(
            'label' => 'Bukti',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 170
        ),'jenis_bukti' => array(
            'label' => 'Jenis Bukti',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 100
        )
    );
    protected $_order = array("id" => "ASC");
    protected $_unique = array('unique' => array('id'), 'group' => false);
}
