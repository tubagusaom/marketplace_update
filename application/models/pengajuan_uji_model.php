<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Pengajuan_uji_model extends MY_Model {

    public function __construct() {
        $this->_table = 't_pengajuan_uji';
        parent::__construct($this->_table);
    }
    protected $_table;

    protected $table_label = 'Data Pengajuan';
    protected $_columns = array(
        'id_mhs' => array(
            'label' => 'Mahasiswa',
            'rule' => 'trim|xss_clean',
            'formatter' => 'nama_calon',
            'save_formatter' => 'string',
            'width' => 350
        ),
        'tgl_pengajuan' => array(
            'label' => 'Tanggal',
            'rule' => 'trim|xss_clean',
            'formatter' => 'general_date',
            'save_formatter' => 'date',
            'width' => 120,
            'align' =>'center'
        ),
        'stts_pengajuan' => array(
            'label' => 'Status',
            'rule' => 'trim|xss_clean',
            'formatter' => array('-','Disetujui','Ditolak'),
            'save_formatter' => 'string',
            'width' => 100,
            'align' =>'center'
        )
    );

    protected $belongs_to = array(
        'nama_calon' => array(
            'model' => 'mahasiswa_model',
            'primary_key' => 'id_mhs',
            'retrieve_columns' => array('nama_calon'),
            'join_type' => 'left'
        )
    );

    protected $_order = array("id" => "DESC");
    protected $_unique = array('unique' => array('id'), 'group' => false);

}
