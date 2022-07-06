<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Berita_acara_model extends MY_Model {

     public function __construct() {
        $this->_table = kode_tbl()."jadual_asesmen"; 
        parent::__construct($this->_table);
    }
    protected $_table;
            
    protected $table_label = 'Berita Acara Asesmen';
    protected $_columns = array(
        'jadual' => array(
            'label' => 'Nama Jadwal',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 170,
            'align' => 'center'
        ),
        'tanggal' => array(
            'label' => 'Start Date',
            'rule' => 'trim|xss_clean',
            'formatter' => 'general_date',
            'save_formatter' => 'date',
            'width' => 100,
            'align' =>'center',
        ),
        'status_jadwal' => array(
            'label' => 'Status',
            'rule' => 'trim|xss_clean',
            'formatter' => array('-','Sudah Selesai','Dibatalkan','Pending'),
            'save_formatter' => 'string',
            'width' => 100,
            'align' =>'center',
            
        ),
        'dokumen_berita_acara' => array(
            'label' => 'Dokumen Lampiran',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 250,
            'hidden' => 'true'
            
        ),
        'ringkasan_asesmen' => array(
            'label' => 'Ringkasan Asesmen',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 250,
            
        )
    );
    protected $_order = array("id" => "DESC");

    protected $_unique = array('unique' => array('jadual'), 'group' => false);

    function daftar_hadir($id){
        $this->db->where('jadwal_id',$id);
        $detail_asesi = $this->db->get('lsp029_asesi')->result_array();
        return $detail_asesi;
    }
    function no_registrasi($id){
        $aplikasi = $this->db->get('r_konfigurasi_aplikasi')->row();
        
        $this->db->select('b.kode_sektor');
        $this->db->from(kode_tbl().'asesi a');
        $this->db->join(kode_tbl().'skema b','a.skema_sertifikasi=b.id');
        $this->db->where('a.id',$id);
        $query = $this->db->get()->row();

        $this->db->where('tahun_penerbitan_sertifikat',date('Y'));
        $q = $this->db->get(kode_tbl().'asesi'); 
        $record = ($q->num_rows()) + ($aplikasi->no_urut_sertifikat);
        $no_urut = sprintf('%05s', $record);
        $no_registrasi = $query->kode_sektor.' '.$aplikasi->kode_lsp.' '.$no_urut.' '.date('Y');
        return $no_registrasi;
    }
    function no_sertifikat($id){
        $aplikasi = $this->db->get('r_konfigurasi_aplikasi')->row();
        $this->db->where('terbitkan_sertifikat','on');
        $q = $this->db->get(kode_tbl().'asesi'); 
        $record = $q->num_rows() +  $aplikasi->no_urut_sertifikat;
        $no_urut = sprintf('%07s', $record);

        $this->db->select('b.skema,b.kblui,b.kbji,b.jenjang');
        $this->db->from(kode_tbl().'asesi a');
        $this->db->join(kode_tbl().'skema b','a.skema_sertifikasi=b.id');
        $this->db->where('a.id',$id);
        $query = $this->db->get()->row();

        $no_sertifikat = $query->kblui.' '.$query->kbji.' '.$query->jenjang.' '.$no_urut.' '.date('Y');
        return $no_sertifikat;
    }
}
