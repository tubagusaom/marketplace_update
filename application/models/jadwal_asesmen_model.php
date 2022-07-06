<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Jadwal_asesmen_model extends MY_Model {

     public function __construct() {
        $this->_table = kode_tbl()."jadual_asesmen";
        parent::__construct($this->_table);
    }
    protected $_table;
    protected $table_label = 'Data Jadwal Asesmen';
    protected $_columns = array(
        'jadual' => array(
            'label' => 'Jadwal',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 450,

        ),
        'tanggal' => array(
            'label' => 'Start Date',
            'rule' => 'trim|xss_clean',
            'formatter' => 'general_date',
            'save_formatter' => 'date',
            'width' => 120,
            'align' =>'center',
        ),
        'id_angkatan' => array(
            'label' => 'Angkatan',
            'rule' => 'trim|xss_clean',
            'formatter' => 'angkatan',
            'save_formatter' => 'string',
            'width' => 90,
            'align' =>'center',
        ),
        'id_prodi' => array(
            'label' => 'Prodi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'program_studi',
            'save_formatter' => 'string',
            'width' => 170,

        ),
        'jumlah_asesi' => array(
            'label' => 'Jumlah<br/> Asesi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 70,
            'align' =>'center',
        ),
        'semester' => array(
            'label' => 'Semester',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 70,
            'align' =>'center',
        ),
        'kelas' => array(
            'label' => 'Kelas',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 70,
            'align' =>'center',
        ),
        'tanggal_akhir' => array(
            'label' => 'End Date',
            'rule' => 'trim|xss_clean',
            'formatter' => 'general_date',
            'save_formatter' => 'date',
            'width' => 100,
            'align' =>'center',
            'hidden' => true
        ),
        'persyaratan' => array(
            'label' => 'Persyaratan Pendaftaran',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 200,
            'hidden' => true
        ),
        'panitia' => array(
            'label' => 'Panitia UJK',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => true,
        ),
        'download_time' => array(
            'label' => 'Download Time',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => true,
        ),
        'id_skema' => array(
            'label' => 'Skema',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'skema',
            'save_formatter' => 'string',
            'width' => 80,
            'align' => 'center',
            'hidden' => true,
        ),
        'id_tuk' => array(
            'label' => 'TUK',
            'rule' => 'trim|xss_clean',
            'formatter' => 'skema',
            'save_formatter' => 'string',
            'width' => 80,
            'align' => 'center',
            'hidden' => true,
        ),
        'status_jadwal' => array(
            'label' => 'Status',
            'rule' => 'trim|xss_clean',
            'formatter' => array('<label>Permohonan Baru</label>','<label style="background-color:green;color:white;">Disetujui</label>','<label style="background-color:red;color:white;">Ditolak</label>'),
            'save_formatter' => 'string',
            'width' => 120,

        )
    );

    protected $belongs_to = array(
        'prodi' => array(
            'model' => 'prodi_model',
            'primary_key' => 'id_prodi',
            'retrieve_columns' => array('program_studi'),
            'join_type' => 'left'
        ),
        'angkatan' => array (
            'model' => 'angkatan_model',
            'primary_key' => 'id_angkatan',
            'retrieve_columns' => array('angkatan'),
            'join_type' => 'left'
        ),
    );

    protected $_order = array("id" => "DESC");

    protected $_unique = array('unique' => array('id'), 'group' => false);


     function daftar_hadir($id){
        $this->db->select('a.id,c.users,a.nama_lengkap,a.no_uji_kompetensi,a.rekomendasi_asesor,a.alamat,a.telp,a.organisasi,b.skema');
        $this->db->from(kode_tbl().'asesi a');
        $this->db->join(kode_tbl().'skema b','a.skema_sertifikasi=b.id','LEFT');
        $this->db->join(kode_tbl().'users c','c.id=a.id_asesor','LEFT');
        $this->db->where('a.jadwal_id',$id);
        $this->db->order_by('c.users','ASC');
        $detail_asesi = $this->db->get()->result();
        //var_dump($detail_asesi);
        //die();
        return $detail_asesi;
    }
    function daftar_hadir_asesor($id){
        $jadual_asesmen = kode_tbl().'jadual_asesmen';
        $asesi = kode_tbl().'asesi';
        $users = kode_tbl().'users';
        $this->db->select('a.jadual,a.tanggal,a.tanggal_akhir,b.nama_lengkap,c.users');
        $this->db->from($jadual_asesmen.' a');
        $this->db->join($asesi.' b','a.id=b.jadwal_id');
        $this->db->join($users.' c','c.id=b.id_asesor');
        $this->db->where('a.id',$id);
        $this->db->group_by('b.id_asesor');
        $detail_asesi = $this->db->get()->result();
        return $detail_asesi;
    }
    function get_jadwal_tuk($id_tuk){
        $this->db->where('id_tuk',$id_tuk);
        $this->db->order_by('id','DESC');
        $this->db->limit(1);
        return $this->db->get(kode_tbl().'jadual_asesmen')->row();
    }
    function get_jadwal_isi($id_jadwal){
        $this->db->where('id',$id_jadwal);
        //$this->db->order_by('id','DESC');
        //$this->db->limit(1);
        return $this->db->get(kode_tbl().'jadual_asesmen')->row();
    }
    function get_asesor($id){
        $asesi = kode_tbl().'asesi';
        $users = kode_tbl().'users';
        $skema = kode_tbl().'skema';

        $query = $this->db->query("SELECT a.nama_lengkap,a.id_asesor,b.users,b.no_reg,c.skema,c.id as id_skema
        FROM $asesi a
        JOIN $users b ON b.id=a.id_asesor
        JOIN $skema c ON c.id=a.skema_sertifikasi
        WHERE a.jadwal_id=$id
        GROUP BY b.users");
        return $query->result();
    }
    public function get_all_jadwal($perpage, $offset,$search="") {
        if($search ==""){
            $this->db->order_by('tanggal', 'ASC');
            $this->db->limit($perpage);
            $this->db->offset($offset);
            $this->db->where('status_jadwal',1);
            $query = $this->db->get(kode_tbl().'jadual_asesmen');
        }else{
            $this->db->where('status_jadwal',1);
            $this->db->like('jadual', $search);
            $this->db->order_by('tanggal', 'ASC');
            $this->db->limit($perpage);
            $this->db->offset($offset);
            $query = $this->db->get(kode_tbl().'jadual_asesmen');
        }
        return $query->result();
    }
    function unit_kompetensi($id){
        $skema = kode_tbl().'skema';
        $skema_detail = kode_tbl().'skema_detail';
        $unit_kompetensi = kode_tbl().'unit_kompetensi';

        $this->db->select("c.id_unit_kompetensi,c.unit_kompetensi",false);
        $this->db->from("$skema a");
        $this->db->join("$skema_detail b","b.id_skema=a.id");
        $this->db->join("$unit_kompetensi c","c.id=b.id_unit_kompetensi");
        //$this->db->join("$elemen_kompetensi d","d.id_unit_kompetensi=c.id");
        $this->db->order_by('b.no_urut', 'ASC');
        $this->db->where("a.id",$id);
        return $this->db->get()->result();
    }
    function get_jadwal(){
        $this->db->limit(2);
        $this->db->where('status_jadwal',1);
        $query = $this->db->get(kode_tbl().'jadual_asesmen')->result();
        return $query;
    }

    function asesi_clo($id_asesor, $id_jadwal)
    {
        $this->db->select('a.id, a.nama_lengkap');
        $this->db->from(kode_tbl().'asesi a');
        $this->db->where('a.id_asesor', $id_asesor);
        $this->db->where('a.jadwal_id', $id_jadwal);
        $query = $this->db->get()->result();
        return $query;
    }
}
