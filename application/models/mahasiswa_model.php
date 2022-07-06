<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Mahasiswa_model extends MY_Model {

    protected $_table = "lsp508_calon_asesi";
    protected $table_label = 'Data Mahasiswa';
    protected $_columns = array(
        'nim_calon' => array(
            'label' => 'Nim',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 100
        ),
        'nama_calon' => array(
            'label' => 'Nama',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 250
        ),
        'kelas_calon' => array(
            'label' => 'Kelas',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 60,
            'align' => 'center'
        ),
        'semester_calon' => array(
            'label' => 'Semester',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 60,
            'align' => 'center'
        ),
        'id_angkatan' => array(
            'label' => 'Tahun Akademik',
            'rule' => 'trim|xss_clean',
            'formatter' => 'angkatan',
            'save_formatter' => 'string',
            'width' => 100,
            'align' => 'center'
        ),
        'id_prodi' => array(
            'label' => 'Program Studi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'program_studi',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'hp_calon' => array(
            'label' => 'HP',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 90,
            'align' => 'center'
        ),
        'email_calon' => array(
            'label' => 'Email',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 90,
            'align' => 'center'
        ),
        'is_user' => array(
            'label' => 'Login',
            'rule' => 'trim|xss_clean',
            'formatter' => array('<div style="background-color:red;color:white;">X</div>', '&#10004;'),
            'save_formatter' => 'string',
            'width' => 50,
             'align' => 'center'
        )
    );

    protected $_order = array("id" => "DESC");
    protected $_unique = array('unique' => array('id'), 'group' => false);
     protected $belongs_to = array(
          'angkatan' =>  array(
          'model' => 'angkatan_model',
          'primary_key' => 'id_angkatan',
          'retrieve_columns' => array('angkatan'),
          'join_type' => 'left'
          ),
          'prodi' =>  array(
          'model' => 'prodi_model',
          'primary_key' => 'id_prodi',
          'retrieve_columns' => array('program_studi'),
          'join_type' => 'left'
          )
      );

    function __construct() {
        parent::__construct();
    }

    public function get_all_mahasiswa($perpage, $offset,$search="") {
        if($search ==""){
            $this->db->select('a.*, b.program_studi, c.angkatan');
            $this->db->from(kode_tbl().'calon_asesi a');
            $this->db->join('t_prodi b','a.id_prodi=b.id');
            $this->db->join('t_angkatan c','a.id_angkatan=c.id');
            $this->db->order_by('a.id', 'DESC');

            $this->db->limit($perpage);
            $this->db->offset($offset);
            $query = $this->db->get();
        }else{
            $this->db->like('nama_calon', $search);
            $this->db->from(kode_tbl().'calon_asesi a');
            $this->db->join('t_prodi b','a.id_prodi=b.id');
            $this->db->join('t_angkatan c','a.id_angkatan=c.id');

            $this->db->order_by('nama_calon', 'ASC');
            $this->db->limit($perpage);
            $this->db->offset($offset);
            $query = $this->db->get();
        }
        return $query->result();
    }

    function get_detail_mahasiswa($id){
        $this->db->select('a.*, b.*, c.nama_matkul');
        $this->db->from(kode_tbl().'calon_asesi a');
        $this->db->join(kode_tbl().'khs b','b.id_calon_asesi = a.id');
        $this->db->join(kode_tbl().'matkul c','c.id = b.mata_kuliah');


        $this->db->where('b.id_calon_asesi',$id);
        $query = $this->db->get()->result();
        return $query;
    }

    function get_detail_uji($id){
        // $this->db->select('a.id, b.unit_kompetensi, b.id_unit_kompetensi');
        $this->db->select('a.*, b.*');
        $this->db->from(kode_tbl().'calon_asesi a');
        $this->db->join(kode_tbl().'uji_kompetensi b','b.nim = a.nim_calon');
        $this->db->where('a.id',$id);
        $query = $this->db->get()->result();
        return $query;
    }

    // public function get_all_jadwal($perpage, $offset,$search="") {
    //     if($search ==""){
    //         $this->db->order_by('tanggal', 'DESC');
    //         $this->db->limit($perpage);
    //         $this->db->offset($offset);
    //         $query = $this->db->get(kode_tbl().'jadual_asesmen');
    //     }else{
    //         $this->db->like('jadual', $search);
    //         $this->db->order_by('id', 'ASC');
    //         $this->db->limit($perpage);
    //         $this->db->offset($offset);
    //         $query = $this->db->get(kode_tbl().'jadual_asesmen');
    //     }
    //     return $query->result();
    // }
    //
    // function get_detail_jadwal($id){
    //     $this->db->select('a.*, b.*, c.nama_calon');
    //     $this->db->from(kode_tbl().'detail_jadwal a');
    //     $this->db->join(kode_tbl().'jadual_asesmen b','b.id = a.id_jadwal');
    //     $this->db->join(kode_tbl().'calon_asesi c','c.id = a.id_mahasiswa');
    //     $this->db->where('a.id_jadwal',$id);
    //     $this->db->order_by('c.nama_calon', 'ASC');
    //     $query = $this->db->get()->result();
    //
    //     return $query;
    //
    // }

}
