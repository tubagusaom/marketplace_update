<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Penilaian_asesor_model extends MY_Model {
    
     public function __construct() {
        $this->_table = kode_tbl()."detail_jadwal"; 
        parent::__construct($this->_table);
    }
    protected $_table;
    protected $table_label = 'Data Rekomendasi Asesor';
    protected $_columns = array(
        'id_mahasiswa' => array(
            'label' => 'Nama Asesi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'nama_calon',
            'save_formatter' => 'string',
            'width' => 120,
        ),
        'id_jadwal' => array(
            'label' => 'Jadwal Asesmen',
            'rule' => 'trim|xss_clean',
            'formatter' => 'jadual',
            'save_formatter' => 'string',
            'width' => 350,
        ),
        'id_asesor' => array(
            'label' => 'Asesor Kompetensi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'users',
            'save_formatter' => 'string',
            'width' => 140,
            
           
        ),
        'judul_unit' => array(
            'label' => 'Unit Kompetensi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 200,
            
        ),
        'rekomendasi_asesor' => array(
            'label' => 'Rekomendasi',
            'rule' => 'trim|xss_clean',
            'formatter' => array('','Kompeten','Belum Kompeten'),
            'save_formatter' => 'string',
            'width' => 80,
        ),
        'catatan_rekomendasi' => array(
            'label' => 'Rekomendasi',
            'rule' => 'trim|xss_clean',
            'formatter' => array('','Kompeten','Belum Kompeten'),
            'save_formatter' => 'string',
            'width' => 80,
            'hidden' => 'true'
        )
    );
    protected $_order = array("id" => "DESC");

     	protected $belongs_to = array(
          'mahasiswa' =>  array(
          'model' => 'mahasiswa_model',
          'primary_key' => 'id_mahasiswa',
          'retrieve_columns' => array('nama_calon')
          ),
          'jadwal' =>  array(
          'model' => 'jadwal_asesmen_model',
          'primary_key' => 'id_jadwal',
          'retrieve_columns' => array('jadual'),
          'join_type' => 'left'
          ),
          'asesor' =>  array(
          'model' => 'asesor_model',
          'primary_key' => 'id_asesor',
          'retrieve_columns' => array('users'),
          'join_type' => 'left'
          )
      );
    protected $_unique = array('unique' => array('instruktur_code'), 'group' => false);

    function index($limit, $offset, $id_asesor, $search=""){
        if ($search =="") {
            $this->db->select('a.id, b.nama_calon, c.jadual, d.users, a.judul_unit, a.rekomendasi_asesor');
            $this->db->from(kode_tbl().'detail_jadwal a');
            $this->db->join(kode_tbl().'calon_asesi b', 'a.id_mahasiswa = b.id');
            $this->db->join(kode_tbl().'jadual_asesmen c', 'a.id_jadwal = c.id');
            $this->db->join(kode_tbl().'users d', 'a.id_asesor = d.id', 'LEFT');
            $this->db->where('a.id_asesor', $id_asesor);
            $this->db->order_by('id', 'desc');
            $this->db->limit($limit);
            $this->db->offset($offset);
            $query = $this->db->get();            
        }else {
            $this->db->select('a.id, b.nama_calon, c.jadual, d.users, a.judul_unit, a.rekomendasi_asesor');
            $this->db->from(kode_tbl().'detail_jadwal a');
            $this->db->join(kode_tbl().'calon_asesi b', 'a.id_mahasiswa = b.id');
            $this->db->join(kode_tbl().'jadual_asesmen c', 'a.id_jadwal = c.id');
            $this->db->join(kode_tbl().'users d', 'a.id_asesor = d.id', 'LEFT');
            $this->db->where('a.id_asesor', $id_asesor);
            $this->db->or_like('b.nama_calon', $search);
            $this->db->or_like('c.jadual', $search);
            $this->db->or_like('d.users', $search);
            $this->db->order_by('id', 'desc');
            $this->db->limit($limit);
            $this->db->offset($offset);
            $query = $this->db->get();                        
            
        }
        return $query->result();
    }

    function data_asesi($id){
        $asesi = kode_tbl().'asesi';
        $jadual_asesmen = kode_tbl().'jadual_asesmen';
        $tuk = kode_tbl().'tuk';
        $skema = kode_tbl().'skema';
        
        $query = $this->db->query("SELECT b.jadual,c.tuk,c.alamat as alamat_tuk,c.telp as telp_tuk,
        d.skema,d.kode_skema,a.*,b.tanggal as tanggal_mulai,b.tanggal_akhir
        FROM $asesi a
        JOIN $skema d ON d.id=a.skema_sertifikasi
        JOIN $jadual_asesmen b ON a.jadwal_id=b.id
        JOIN $tuk c ON c.id=a.id_tuk
        ");
        return $query->row();
    }

    function get_elemen_kompetensi($id){
        $unit_kompetensi = kode_tbl().'unit_kompetensi';
        $elemen = kode_tbl().'elemen_kompetensi';
        
        
        $this->db->where('id_unit_kompetensi', $id);
        $query = $this->db->get($elemen);
        return $query->result();
    }    
}
