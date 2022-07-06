<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Pengajuan_asesor_model extends MY_Model {

    protected $_table;
    protected $table_label = 'Data Pengajuan Asesor';
    protected $_columns = array(

        'id_jadwal' => array(
            'label' => 'Jadwal Uji Kompetensi',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'jadual',
            'save_formatter' => 'string',
            'width' => 350
        ),
        'id_asesor' => array(
            'label' => 'Nama Asesor',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'users',
            'save_formatter' => 'string',
            'width' => 180
        ),
        'jenis_asesmen' => array(
            'label' => 'Sebagai',
            'rule' => 'trim|required|xss_clean',
            'formatter' => array('','Asesor Mandiri','Asesor Penguji','Asesor Mandiri/Penguji','Lead Asesor','Penanggung Jawab','Asesor Lisensi','Subject Specialist'),
            'save_formatter' => 'string',
            'width' => 150
        )
    );

    protected $belongs_to = array(
        'jadual' => array(
            'model' => 'jadwal_asesmen_model',
            'primary_key' => 'id_jadwal',
            'retrieve_columns' => array('jadual'),
            'join_type' => 'left'
        ),
        'user' => array(
            'model' => 'asesor_model',
            'primary_key' => 'id_asesor',
            'retrieve_columns' => array('users'),
            'join_type' => 'left'
        )
    );

    protected $_order = array("id" => "ASC");
    protected $_unique = array('unique' => array('id'), 'group' => false);

    function __construct() {
        parent::__construct();
        $this->_table = kode_tbl()."mapping_asesor";
        parent::__construct($this->_table);
    }

    function get_jadwal(){
        $this->db->select('a.id_jadwal, b.jadual, a.id,c.users');
        $this->db->from('lsp646_mapping_asesor a');
        $this->db->join('lsp646_users c', 'a.id_asesor = c.id');
        $this->db->join('lsp646_jadual_asesmen b','a.id_jadwal = b.id');
        // $this->db->where('a.id_kategori', 6);
        $query = $this->db->get();
        return $query->result();
    }
}
