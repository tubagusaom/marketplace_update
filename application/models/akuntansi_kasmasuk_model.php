<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Akuntansi_kasmasuk_model extends MY_Model {
    
    public function __construct() {
        $this->_table = "acc_jurnal_srb"; 
        parent::__construct($this->_table);
    }
    protected $_table;
    protected $table_label = 'Data  Jurnal Kas Masuk';
    protected $_columns = array(
        'tanggal' => array(
            'label' => 'Tanggal',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'date',
            'save_formatter' => 'string',
            'width' => 50
        ),
        'nobukti' => array(
            'label' => 'Nomor Bukti',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 50
        ),
        'ket' => array(
            'label' => 'Keterangan',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden'=> 'true'
        ),
        'ket2' => array(
            'label' => 'Keterangan',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'jumlah' => array(
            'label' => 'Nilai',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'rupiah',
            'save_formatter' => 'string',
            'width' => 80
        ),
        'kd' => array(
            'label' => 'KD',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden'=> 'true'
        ),
        'kk' => array(
            'label' => 'KK',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden'=> 'true'
        ),
        'jenis' => array(
            'label' => 'Jenis',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden'=> 'true'
        ),
        'tipe_jurnal' => array(
            'label' => 'Tipe Jurnal',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden'=> 'true'
        )
        
    );
    
    protected $_where = array('tipe_jurnal' => "JKM");
    protected $_order = array("id" => "DESC");
}
