<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Asesi_model extends MY_Model {

   // protected $_table = 'lsp029_asesi';
    public function __construct() {
        $this->_table = kode_tbl()."asesi";
        parent::__construct($this->_table);
    }
    protected $_table;

    protected $table_label = 'Data Pendaftaran UJK';
    protected $_columns = array(
        'u_date_create' => array(
            'label' => 'Registration Date',
            'rule' => 'trim|xss_clean',
            'formatter' => 'datetime',
            'save_formatter' => 'string',
            'width' => 80,
            'align' => 'center'
        ),
        'skema_sertifikasi' => array(
            'label' => 'Skema Sertifikasi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'skema',
            'save_formatter' => 'string',
            'width' => 200,
        ),
        'nama_lengkap' => array(
            'label' => 'Nama Asesi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,

        ),
        'id_tuk' => array(
            'label' => 'TUK',
            'rule' => 'trim|xss_clean',
            'formatter' => 'tuk',
            'save_formatter' => 'string',
            'width' => 170,
            'hidden' => 'true'
        ),'no_identitas' => array(
            'label' => 'Identity Number',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 170,
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
            'rule' => 'trim|xss_clean',
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
        'jenis_kelamin' => array(
            'label' => 'Sex',
            'rule' => 'trim|xss_clean',
            'formatter' => array(''=>'-','0'=>'Pria','1'=>'Wanita'),
            'save_formatter' => 'string',
            'width' => 60,
            'hidden' => 'true'

        ),
        'telp' => array(
            'label' => 'Telp',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 120,

        ),
        'email' => array(
            'label' => 'Email',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,

        ),
        'alamat' => array(
            'label' => 'Pra ',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'hidden' => 'true',

        ),
        'file_bukti_pendukung' => array(
            'label' => 'Bukti Pendukung ',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 210,
            'hidden' => 'true',
        ),
        'organisasi' => array(
            'label' => 'Bukti Pendukung ',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 210,
            'hidden' => 'true',
        ),
        'pra_asesmen_checked' => array(
            'label' => 'Checked Pra Asesmen',
            'rule' => 'trim|xss_clean',
            'formatter' => 'nama_user',
            'save_formatter' => 'string',
            'width' => 150,

        ),
        'is_perpanjangan' => array(
            'label' => '*',
            'rule' => 'trim|xss_clean',
            'formatter' => array(''=>'','0'=>'N','1'=>'Y'),
            'save_formatter' => 'string',
            'align' =>'center',
            'width' => 30,
            'hidden' => 'true',
        ),
        'bukti_pendukung' => array(
            'label' => 'Checked Pra Asesmen',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 210,
            'hidden' => 'true',
        ),
        'jabatan' => array(
            'label' => 'Checked Pra Asesmen',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 210,
            'hidden' => 'true',
        ),
        'pendidikan_terakhir' => array(
            'label' => 'Pendidikan Terakhir',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 210,
            'hidden' => 'true',
        ),
        'validitas_dokumen' => array(
            'label' => 'Checked Pra Asesmen',
            'rule' => '',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 210,
            'hidden' => 'true',
        ),
        'catatan_validitas_dokumen' => array(
            'label' => 'Checked Pra Asesmen',
            'rule' => '',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 210,
            'hidden' => 'true',
        ),
        'rekomendasi_apl01' => array(
            'label' => 'rekomendasi_apl01',
            'rule' => '',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 210,
            'hidden' => 'true',
        ),
        'catatan_rekomendasi_apl01' => array(
            'label' => 'catatan_rekomendasi_apl01',
            'rule' => '',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 210,
            'hidden' => 'true',
        ),
        'id_users' => array(
            'label' => 'catatan_rekomendasi_apl01',
            'rule' => '',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 210,
            'hidden' => 'true',
        )
    );
    protected $_order = array("u_date_create" => "DESC","id"=>"DESC");

      protected $belongs_to = array(
          'tuk' =>  array(
          'model' => 'tuk_model',
          'primary_key' => 'id_tuk',
          'retrieve_columns' => array('tuk'),
          'join_type' => 'left'
          ),
          'skema' =>  array(
          'model' => 'skema_model',
          'primary_key' => 'skema_sertifikasi',
          'retrieve_columns' => array('skema'),
          'join_type' => 'left'
          ),
          'user' =>  array(
          'model' => 'user_model',
          'primary_key' => 'pra_asesmen_checked',
          'retrieve_columns' => array('nama_user','jenis_user'),
          'join_type' => 'left'
          ),
      );

    protected $_unique = array('unique' => array('instruktur_code'), 'group' => false);


    function data_asesi($id){
        $asesi = kode_tbl().'asesi';
        $skema = kode_tbl().'skema';
        $this->db->select('a.*,b.skema,b.kode_skema');
        $this->db->from($asesi.' a');
        $this->db->join($skema .' b','a.skema_sertifikasi=b.id');
        $this->db->where('a.id',$id);
        $detail_asesi = $this->db->get()->row();
        return $detail_asesi;
    }

    function data_unit_kompetensi($id){
            $unit_kompetensi = kode_tbl().'unit_kompetensi';
            $skema_detail = kode_tbl().'skema_detail';
            $query = $this->db->query("select a.*
            from $unit_kompetensi a
            JOIN $skema_detail b ON b.id_unit_kompetensi=a.id
            WHERE b.id_skema =$id");
            return $query->result();
    }

    function asesi_detail($id){
        $this->db->select('a.*, b.skema');
        $this->db->from(kode_tbl().'asesi a');
        $this->db->join(kode_tbl().'skema b', 'a.skema_sertifikasi = b.id', 'left');
        $this->db->where('a.id', $id);
        $query = $this->db->get();

        return $query->result();
    }
    function elemen($id){
        $elemen_kompetensi = kode_tbl().'elemen_kompetensi';
        $skema_detail = kode_tbl().'skema_detail';
        $unit_kompetensi = kode_tbl().'unit_kompetensi';
        $query = $this->db->query("SELECT a.*
        FROM $elemen_kompetensi a
        WHERE a.id_unit_kompetensi=(SELECT id
        FROM $unit_kompetensi WHERE id_unit_kompetensi='$id')");
        return $query->result();
    }
    function kuk($id){
        $kuk = kode_tbl().'kuk';
        $query = $this->db->query("SELECT *
        FROM $kuk a
        WHERE a.id_elemen_kompetensi=$id");
        return $query->result();
    }
    function detail_elemen_kuk($kode_skema){
        $skema = kode_tbl().'skema';
        $skema_detail = kode_tbl().'skema_detail';
        $unit_kompetensi = kode_tbl().'unit_kompetensi';
        $elemen_kompetensi = kode_tbl().'elemen_kompetensi';

        $data = $this->db->query("SELECT a.id,a.skema,c.id_unit_kompetensi,c.unit_kompetensi,d.id as id_elemen,d.elemen_kompetensi
            FROM $skema a
            JOIN $skema_detail b ON a.id=b.id_skema
            JOIN $unit_kompetensi c ON b.id_unit_kompetensi=c.id
            JOIN $elemen_kompetensi d ON c.id=d.id_unit_kompetensi
            WHERE a.id=".$kode_skema);
        return $data->result();
    }
    function files_asesi($id){
        $this->db->where('id_asesi',$id);
        $query = $this->db->get('t_repositori')->result();

        //$this->db->select('a.*');
        //$this->db->from('t_repositori a');
        //$this->db->join(kode_tbl().'asesi b','a.id_asesi=b.id_users');
        //$this->db->where('b.id',$id);
        //$this->db->or_where('created_by',$id);
        //$query = $this->db->get();
        return $query;

    }
     function foto($id){
        $query = $this->db->query("SELECT foto_profil
        FROM t_users b WHERE pegawai_id=$id AND b.jenis_user=1")->row();
        return $query->foto_profil;

    }

    function jadwal($jadwal_id){
        $this->db->where('id',$jadwal_id);
        $jadwal = $this->db->get(kode_tbl().'jadual_asesmen')->row();
        return $jadwal;
    }
    function perangkat_asesmen($id_skema){
      $perangkat = kode_tbl().'perangkat_asesmen';
      $perangkat_detail = kode_tbl().'perangkat_asesmen_detail';

      $this->db->select('b.perangkat_detail');
      $this->db->from($perangkat.' a');
      $this->db->join($perangkat_detail .' b','a.id=b.id_perangkat_asesmen');
      $this->db->where('a.skema_perangkat',$id_skema);
      $detail_perangkat = $this->db->get()->result();
      return $detail_perangkat;
    }
}
