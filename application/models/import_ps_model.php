<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Import_ps_model extends MY_Model {

   // protected $_table = 'lsp029_import_skema';
    public function __construct() {
        $this->_table = kode_tbl()."users_temp"; 
        parent::__construct($this->_table);
    }
    protected $_table;
        
    protected $table_label = 'Data Import Pemegang Sertifikat';
    protected $_columns = array(
       
        'users' => array(
            'label' => 'Nama Lengkap',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            
        ),
        'no_reg' => array(
            'label' => 'No Registrasi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 100,
            
        ),
        'skema_sertifikasi' => array(
            'label' => 'Skema Sertifikasi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'skema',
            'save_formatter' => 'string',
            'width' => 150,
            
        ),
        'hp' => array(
            'label' => 'HP',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 90,
            
        ),'email' => array(
            'label' => 'Email',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 90
        ),'provinsi' => array(
            'label' => 'Provinsi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 120
        ),'no_sertifikat' => array(
            'label' => 'No Sertifikat',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 120
        ),'no_seri' => array(
            'label' => 'No Seri',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 80
        ),'tahun' => array(
            'label' => 'Tahun',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 80
        )
    );
    protected $_order = array("id" => "ASC");
    protected $belongs_to = array(
         
          'skema' =>  array(
          'model' => 'skema_model',
          'primary_key' => 'skema_sertifikasi',
          'retrieve_columns' => array('skema')
          )
      );
      
    protected $_unique = array('unique' => array('id'), 'group' => false);

    
    function data_import_skema($id){
        $import_skema = kode_tbl().'import_skema';
        $skema = kode_tbl().'skema';
        $this->db->select('a.*,b.skema,b.kode_skema');
        $this->db->from($import_skema.' a');
        $this->db->join($skema .' b','a.skema_sertifikasi=b.id');
        $this->db->where('a.id',$id);
        $detail_import_skema = $this->db->get()->row();
        return $detail_import_skema;
    }
    
    function data_unit_kompetensi($id){
        $unit_kompetensi = kode_tbl().'unit_kompetensi';
        $skema_detail = kode_tbl().'skema_detail';
        $query = $this->db->query("select a.id_unit_kompetensi,a.unit_kompetensi
    from $unit_kompetensi a
    JOIN $skema_detail b ON b.id_unit_kompetensi=a.id
    WHERE b.id_skema =$id");
    return $query->result();
    }
    
    function import_skema_detail($id){
        $this->db->where('import_skema_id',$id);
        $detail_import_skema = $this->db->get(kode_tbl().'import_skema_detail')->result();
        return $detail_import_skema;
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
}
