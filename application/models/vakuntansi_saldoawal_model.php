<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Vakuntansi_saldoawal_model extends MY_Model {
    
    public function __construct() {
        $this->_table = "acc_v_saldo_awal"; 
        parent::__construct($this->_table);
    }
    protected $_table;
    protected $table_label = 'Data  Saldo Awal';
    protected $_columns = array(
        'kode_akun' => array(
            'label' => 'Kode akun',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 100
        ),
        'nama_akun' => array(
            'label' => 'Nama akun',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'debet' => array(
            'label' => 'Debet',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'rupiah',
            'save_formatter' => 'string',
            'width' => 50
        ),
        'kredit' => array(
            'label' => 'Kredit',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'rupiah',
            'save_formatter' => 'string',
            'width' => 50
        )
        
    );
   
    //protected $_where = array('tipe_jurnal' => "JUM");
    protected $_order = array("debet" => "DESC");
}
