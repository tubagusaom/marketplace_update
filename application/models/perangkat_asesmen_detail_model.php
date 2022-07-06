<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Perangkat_asesmen_detail_model extends MY_Model {

   // protected $_table = 'lsp029_asesi';
    public function __construct() {
        $this->_table = kode_tbl()."perangkat_asesmen_detail"; 
        parent::__construct($this->_table);
    }
    protected $_table;
        
    protected $table_label = 'Data Perangkat Asesmen';
    protected $_columns = array(
        'no_perangkat_detail' => array(
            'label' => 'Kode Perangkat',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 100,
            'align'=>'center'
            
        ),'id_perangkat_asesmen' => array(
            'label' => 'Perangkat Asesmen',
            'rule' => 'trim|xss_clean',
            'formatter' => 'nama_perangkat',
            'save_formatter' => 'string',
            'width' => 200,
            'align' => 'left'
        ),
        'perangkat_detail' => array(
            'label' => 'Nama detail perangkat',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 200,
            
        ),
        
        'versi_perangkat' => array(
            'label' => 'Versi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 90,
            'align'=>'center'
        ),
        'description_detail' => array(
            'label' => 'Versi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'align'=>'center',
            'hidden' => 'true',
           
        ),
        'file_detail' => array(
            'label' => 'Versi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'align'=>'center',
            'hidden' => 'true',
           
        ),
        'jenis_perangkat' => array(
            'label' => 'Jenis Uji',
            'rule' => 'trim|xss_clean',
            'formatter' => array('','Uji Teori','Observasi','Tes Lisan','Wawancara','Studi Kasus'),
            'save_formatter' => 'string',
            'align'=>'center',
            'width' => 110
           
        ),
        'jumlah_soal' => array(
            'label' => 'Jumlah Soal',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'align'=>'center',
            'width' => 90
           
        ),
        'waktu_pengerjaan' => array(
            'label' => 'Waktu(Menit)',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'align'=>'center',
            'width' => 110
           
        )
    );
    protected $_order = array("id"=>"DESC");

      protected $belongs_to = array(
          'master_perangkat' =>  array(
              'model' => 'perangkat_asesmen_model',
              'primary_key' => 'id_perangkat_asesmen',
              'retrieve_columns' => array('nama_perangkat'),
              'join_type' => 'left'
          )
      );
      
    protected $_unique = array('unique' => array('id'), 'group' => false);

    
    
}
