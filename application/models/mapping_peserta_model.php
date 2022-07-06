<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Mapping_peserta_model extends MY_Model {

    protected $_table = 'lsp508_detail_jadwal';
    protected $table_label = 'Data Detail Jadwal Uji Kompetensi';
    protected $_columns = array(
         'id_mahasiswa' => array(
            'label' => 'Nama Asesi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'nama_calon',
            'save_formatter' => 'string',
            'width' => 120
        ),
        'id_asesor' => array(
            'label' => 'NIM',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 70,
            'hidden' => true
            
        ),        
        'nama_asesor' => array(
            'label' => 'Asesor Kompetensi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            
        ),
        'kode_unit' => array(
            'label' => 'Sertifikat Teknis',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 100,
            'hidden' => true
            
        ),
        'judul_unit' => array(
            'label' => 'Judul Unit',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 220,
            
        ),
        'id_jadwal' => array(
            'label' => 'Jadual',
            'rule' => 'trim|xss_clean',
            'formatter' => 'jadual',
            'save_formatter' => 'string',
            'width' => 400,
            
        )
    );

    protected $_order = array("id" => "ASC");
    protected $belongs_to = array(
          'mahasiswa' =>  array(
          'model' => 'mahasiswa_model',
          'primary_key' => 'id_mahasiswa',
          'retrieve_columns' => array('nama_calon'),
          'join_type' => 'left'
          ),
          'jadwal' =>  array(
          'model' => 'jadwal_asesmen_model',
          'primary_key' => 'id_jadwal',
          'retrieve_columns' => array('jadual'),
          'join_type' => 'left'
          )        
    );    
}
