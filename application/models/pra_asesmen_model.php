<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Pra_asesmen_model extends MY_Model {

     public function __construct() {
        $this->_table = kode_tbl()."asesi";
        parent::__construct($this->_table);
    }
    protected $_table;
    protected $table_label = 'Data Pra Asesmen UJK';
    protected $_columns = array(
        'u_date_create' => array(
            'label' => 'Registration Date',
            'rule' => 'trim|xss_clean',
            'formatter' => 'datetime',
            'save_formatter' => 'string',
            'width' => 170,
            'align' => 'center'
        ),
        'nama_lengkap' => array(
            'label' => 'Complete Name',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 230,

        ),
        'skema_sertifikasi' => array(
            'label' => 'Skema Sertifikasi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'skema',
            'save_formatter' => 'string',
            'width' => 170

        ),
        'id_tuk' => array(
            'label' => 'Prodi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'tuk',
            'save_formatter' => 'string',
            'width' => 170

        ),
        'no_identitas' => array(
            'label' => 'Identity Number',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 170,
            'hidden' => 'true'
        ),
        'tujuan_asesmen' => array(
            'label' => 'Jenis Asesmen',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 130,
            'hidden' => 'true'
        ),
        'no_uji_kompetensi' => array(
            'label' => 'UJK Number',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 170,
            'hidden' => 'true'
        ),
        'tempat_lahir' => array(
            'label' => 'Birth Place',
            'rule' => 'trim||xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 120,
            'hidden' => 'true',
        ),
        'tgl_lahir' => array(
            'label' => 'Birth Date',
            'rule' => 'trim|xss_clean',
            'formatter' => 'general_date',
            'save_formatter' => 'date',
            'width' => 100,
            'align' =>'center',
            'hidden' => 'true',
        ),
        'telp' => array(
            'label' => 'Telp',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 120,

            'hidden' => 'true'
        ),
        'email' => array(
            'label' => 'Email',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 120,
            'hidden' => 'true',
        ),
        'alamat' => array(
            'label' => 'Pra ',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'hidden' => 'true'

        ),
        'pra_asesmen_date' => array(
            'label' => 'Pra Asesmen Date ',
            'rule' => 'trim|xss_clean',
            'formatter' => 'pra_asesmen_date',
            'save_formatter' => 'date',
            'width' => 130,

        ),
        'pra_asesmen' => array(
            'label' => 'Rekomendasi',
            'rule' => 'trim|xss_clean',
            'formatter' => array('-','Lanjut','Tidak Lanjut'),
            'save_formatter' => 'string',
            'width' => 120,

        ),
        'pra_asesmen_description' => array(
            'label' => 'Pra Asesmen Date ',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 120,
            'hidden' => 'true'

        ),
        'file_revisi_pra' => array(
            'label' => 'Checked Pra Asesmen',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 210,
            'hidden'=>'true'

        ),
        'is_perpanjangan' => array(
            'label' => '*',
            'rule' => 'trim|xss_clean',
            'formatter' => array('N','Y'),
            'save_formatter' => 'string',
            'align' =>'center',
            'width' => 30,
            'hidden' => 'true',
        ),
        'pra_asesmen_checked' => array(
            'label' => 'Checked Pra Asesmen',
            'rule' => 'trim|xss_clean',
            'formatter' => 'nama_user',
            'save_formatter' => 'string',
            'width' => 210,

        ),
        'id_users' => array(
            'label' => 'Pra Asesmen Date ',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 120,
            'hidden' => 'true'

        ),
        'validitas_dokumen_pra_asesmen' => array(
            'label' => 'Checked Pra Asesmen',
            'rule' => '',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 210,
            'hidden' => 'true',
        ),
        'jadwal_id' => array(
            'label' => 'id jadwal',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 210,
            'hidden' => 'true'
        )
    );
    protected $_order = array("nama_lengkap" => "DESC");

        protected $belongs_to = array(
          'skema' =>  array(
          'model' => 'skema_model',
          'primary_key' => 'skema_sertifikasi',
          'retrieve_columns' => array('skema'),
          'join_type' => 'left'
          ),
          'tuk' =>  array(
          'model' => 'tuk_model',
          'primary_key' => 'id_tuk',
          'retrieve_columns' => array('tuk'),
          'join_type' => 'left'
          ),
          'user' =>  array(
          'model' => 'user_model',
          'primary_key' => 'pra_asesmen_checked',
          'retrieve_columns' => array('nama_user','jenis_user'),
          'join_type' => 'left'
        )
      );
    protected $_unique = array('unique' => array('instruktur_code'), 'group' => false);

    function pra_asesmen_date($datepra)
    {
        if(!is_null($datepra) && !empty($datepra)) {
            return "$datepra";
        } else {
            return "-";
        }
    }

    function asesor_pra_asesmen($id){
        $this->db->select('a.id,b.users,b.no_reg');
        $this->db->from('t_users a');
        $this->db->join(kode_tbl().'users b','a.pegawai_id=b.id');
        $this->db->where('a.id',$id);
        $query = $this->db->get()->row();
        if(count($query) > 0){
            return $query;
        }else{
            return array();
        }
    }
    function asesor_uji($id){
        $this->db->select('*');
        $this->db->from(kode_tbl().'users a');
        $this->db->where('a.id',$id);
        $query = $this->db->get()->row();
        if(count($query) > 0){
            return $query;
        }else{
            return array();
        }
    }
    function asesi($id){
        $this->db->select('a.id,a.nama_lengkap,a.validitas_dokumen_pra_asesmen,a.no_uji_kompetensi,a.no_identitas,a.jenis_kelamin,b.skema,c.tuk');
        $this->db->from(kode_tbl().'asesi a');
        $this->db->join(kode_tbl().'skema b','b.id=a.skema_sertifikasi');
        $this->db->join(kode_tbl().'tuk c','c.id=a.id_tuk');
        $this->db->where('a.id',$id);
        $query = $this->db->get(kode_tbl().'asesi')->row();
        if(count($query) > 0){
            return $query;
        }else{
            return array();
        }
    }
    function files_asesi($id){
        $this->db->where('id_asesi',$id);
        //$this->db->or_where('created_by',$id);
        $query = $this->db->get('t_repositori');
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return array();
        }
    }
    // function perangkat_ygdipakai($id_skema){
    //     $this->db->where('id_skema',$id_skema);
    //     $query = $this->db->get(kode_tbl().'skema_perangkat')->result();
    //     foreach ($query as $key => $value) {
    //         $perangkat[] = $value->nama_perangkat;
    //     }
    //     return implode(',',$perangkat);
    // }

    function jadwal($jadwal_id){
        $this->db->where('id',$jadwal_id);
        $jadwal = $this->db->get(kode_tbl().'jadual_asesmen')->row();

        // $this->db->where('id',$jadwal->id_tuk);
        // $data_tuk = $this->db->get(kode_tbl().'tuk')->row();

        return $jadwal;
    }

    function perangkat_ygdipakai($id_skema){
      $perangkat = kode_tbl().'perangkat_asesmen';
      $perangkat_detail = kode_tbl().'perangkat_asesmen_detail';

      $this->db->select('b.perangkat_detail');
      $this->db->from($perangkat.' a');
      $this->db->join($perangkat_detail .' b','a.id=b.id_perangkat_asesmen');
      $this->db->where('a.skema_perangkat',$id_skema);
      $detail_perangkat = $this->db->get()->result();
      return $detail_perangkat;
    }

    function index($limit, $offset, $id_asesor, $search=""){
        if ($search =="") {
            $this->db->select('a.id, a.id_mahasiswa, a.id_jadwal, a.kode_unit, a.judul_unit, a.pra_asesmen, b.nama_calon, c.jadual');
            $this->db->from(kode_tbl().'detail_jadwal a');
            $this->db->join(kode_tbl().'calon_asesi b', 'a.id_mahasiswa = b.id');
            $this->db->join(kode_tbl().'jadual_asesmen c', 'a.id_jadwal = c.id');
            $this->db->where('a.id_asesor', $id_asesor);
            $this->db->order_by('id', 'desc');
            $this->db->limit($limit);
            $this->db->offset($offset);
            $query = $this->db->get();            
        }else {
            $this->db->select('a.id, a.id_mahasiswa, a.id_jadwal, a.kode_unit, a.judul_unit, a.pra_asesmen, b.nama_calon, c.jadual');
            $this->db->from(kode_tbl().'detail_jadwal a');
            $this->db->join(kode_tbl().'calon_asesi b', 'a.id_mahasiswa = b.id');
            $this->db->join(kode_tbl().'jadual_asesmen c', 'a.id_jadwal = c.id');
            $this->db->where('a.id_asesor', $id_asesor);
            $this->db->like('b.nama_calon', $search);
            $this->db->order_by('id', 'desc');            
            $this->db->limit($limit);
            $this->db->offset($offset);
            $query = $this->db->get();                        
            
        }
        return $query->result();
    }    
}
