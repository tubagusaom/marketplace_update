<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Hasil_model extends MY_Model {

   // protected $_table = 'lsp029_asesi';
    public function __construct() {
        $this->_table = "t_uji"; 
        parent::__construct($this->_table);
    }
    protected $_table;
        
    protected $table_label = 'Data Hasil Asesmen';
    protected $_columns = array(
        'tanggal_posting' => array(
            'label' => 'Tanggal',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 100,
            
        ),'id_asesi' => array(
            'label' => 'Nama Lengkap',
            'rule' => 'trim|xss_clean',
            'formatter' => 'nama_lengkap',
            'save_formatter' => 'string',
            'width' => 130

        ),
        'id_asesor' => array(
            'label' => 'Asesor',
            'rule' => 'trim|xss_clean',
            'formatter' => 'users',
            'save_formatter' => 'string',
            'width' => 130,
            
        ),
        'id_skema' => array(
            'label' => 'Nama Skema',
            'rule' => 'trim|xss_clean',
            'formatter' => 'skema',
            'save_formatter' => 'string',
            'width' => 170,
            
        ),
        'id_perangkat_detail' => array(
            'label' => 'Nama Perangkat',
            'rule' => 'trim|xss_clean',
            'formatter' => 'perangkat_detail',
            'save_formatter' => 'string',
            'width' => 220
        ),
        'jawaban_asesi' => array(
            'label' => 'UJK Number',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 170,
            'hidden' => 'true'
        ),
        'jawaban_benar' => array(
            'label' => 'B',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 20,
            
        ),
        'jawaban_salah' => array(
            'label' => 'S',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 20
        ),
        'file_jawaban' => array(
            'label' => 'Sex',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 170,
            'hidden' => 'true'
            
        ),
        'penilaian_asesor' => array(
            'label' => 'Telp',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 170,
            'hidden' => 'true'
            
        ),
        'koreksi_asesor' => array(
            'label' => 'Check',
            'rule' => 'trim|xss_clean',
            'formatter' => array('-','Y','N'),
            'save_formatter' => 'string',
            'width' => 40,
            'align'=>'center'
        )    

        );
    protected $_order = array("id_asesi"=>"ASC","tanggal_posting" => "DESC");

      protected $belongs_to = array(
          'asesi' =>  array(
          'model' => 'asesi_model',
          'primary_key' => 'id_asesi',
          'retrieve_columns' => array('nama_lengkap'),
          'join_type' => 'left'
          ),
          'asesor' =>  array(
          'model' => 'asesor_model',
          'primary_key' => 'id_asesor',
          'retrieve_columns' => array('users'),
          'join_type' => 'left'
          ),
          'skema' =>  array(
          'model' => 'skema_model',
          'primary_key' => 'id_skema',
          'retrieve_columns' => array('skema'),
          'join_type' => 'left'
          ),
          'perangkat_detail' =>  array(
          'model' => 'perangkat_asesmen_detail_model',
          'primary_key' => 'id_perangkat_detail',
          'retrieve_columns' => array('perangkat_detail'),
          'join_type' => 'left'
          ),
      );
      
    protected $_unique = array('unique' => array('id'), 'group' => false);

    
    function index($limit, $offset, $id_asesor, $search=""){
        if ($search =="") {
            $this->db->select('a.*, b.nama_lengkap, c.skema');
            $this->db->from('t_uji a');
            $this->db->join(kode_tbl().'asesi b', 'a.id_asesi = b.id');
            $this->db->join(kode_tbl().'skema c', 'a.id_skema = c.id');
            $this->db->where('a.id_asesor', $id_asesor);
            $this->db->order_by('a.id', 'desc');
            $this->db->group_by('a.id');
            $this->db->limit($limit);
            $this->db->offset($offset);            
            $query = $this->db->get();
        }else{
            $this->db->select('a.*, b.nama_lengkap, c.skema');
            $this->db->from('t_uji a');
            $this->db->join(kode_tbl().'asesi b', 'a.id_asesi = b.id');
            $this->db->join(kode_tbl().'skema c', 'a.id_skema = c.id');
            $this->db->where('a.id_asesor', $id_asesor);
            $this->db->like('b.nama_lengkap', $search);
            $this->db->order_by('a.id', 'desc');
            $this->db->group_by('a.id');
            $this->db->limit($limit);
            $this->db->offset($offset);            
            $query = $this->db->get();
        }
        
        return $query->result();
    }
    
    
}
