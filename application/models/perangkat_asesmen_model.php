<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Perangkat_asesmen_model extends MY_Model {

    // protected $_table = 'lsp029_asesi';
    public function __construct() {
        $this->_table = kode_tbl() . "perangkat_asesmen";
        parent::__construct($this->_table);
    }

    protected $_table;
    protected $table_label = 'Data Perangkat Asesmen';
    protected $_columns = array(
        'no_perangkat' => array(
            'label' => 'Kode Perangkat',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 90
        ),'created_when' => array(
            'label' => 'Input Date',
            'rule' => 'trim|xss_clean',
            'formatter' => 'datetime',
            'save_formatter' => 'string',
            'width' => 130,
            'align' => 'center',
            'hidden' => 'true'
        ),
        'skema_perangkat' => array(
            'label' => 'Skema Sertifikasi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'skema',
            'save_formatter' => 'string',
            'width' => 270,
        ),
        'nama_perangkat' => array(
            'label' => 'Nama Perangkat',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 320,
        ),
        'versi' => array(
            'label' => 'Versi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'align' => 'center',
            'width' => 60,
        ),
        'description' => array(
            'label' => 'Versi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'align' => 'center',
            'hidden' => 'true'
        ),
        'file_perangkat' => array(
            'label' => 'Versi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'align' => 'center',
            'hidden' => 'true'
        ),
        'author' => array(
            'label' => 'Author',
            'rule' => 'trim||xss_clean',
            'formatter' => 'nama_user',
            'save_formatter' => 'string',
            'width' => 210,
            'hidden' => 'true'
        )
    );
    protected $_order = array("id" => "DESC");
    protected $belongs_to = array(
        'pembuat' => array(
            'model' => 'v_users_model',
            'primary_key' => 'author',
            'retrieve_columns' => array('nama_user'),
            'join_type' => 'left'
        ),
        'skema' => array(
            'model' => 'skema_model',
            'primary_key' => 'skema_perangkat',
            'retrieve_columns' => array('skema')
        )
    );
    protected $_unique = array('unique' => array('id'), 'group' => false);

    function get_id_asesor($id) {
        $asesi = kode_tbl() . 'asesi';
        $jadual_asesmen = kode_tbl() . 'jadual_asesmen';
        $perangkat_asesmen = kode_tbl() . 'perangkat_asesmen';

        $query = $this->db->query("SELECT a.id,a.id_asesor,b.jadual,c.nama_perangkat,c.id as kode_perangkat
        FROM
        $asesi a
        JOIN $jadual_asesmen b ON b.id=a.jadwal_id
        JOIN $perangkat_asesmen c ON c.id=b.id_perangkat WHERE id_asesor=$id");
        $array = $query->result();
        foreach ($array as $key => $value) {
            $hasil[] = $value->kode_perangkat;
        }
        if (count($hasil) > 0) {
            return implode(',', $hasil);
        } else {
            return '0';
        }
    }

    function jawaban($id) {
        $soal = kode_tbl() . 'soal';

        $query = $this->db->query("SELECT 
jawaban_benar FROM
$soal
WHERE id_perangkat_detail=$id");
        return $query->result_array();
    }

    function peserta_uji($id, $id_asesor) {
        $asesi = kode_tbl() . 'asesi';
        $jadual_asesmen = kode_tbl() . 'jadual_asesmen';
        $perangkat_asesmen = kode_tbl() . 'perangkat_asesmen';
        $perangkat_asesmen_detail = kode_tbl() . 'perangkat_asesmen_detail';

        $query = $this->db->query("SELECT a.id,a.nama_lengkap,a.id_asesor,a.jadwal_id,d.id as padi,
(SELECT t_uji.penilaian_asesor FROM t_uji WHERE t_uji.id_asesi = a.id ORDER BY t_uji.id DESC LIMIT 1) as penilaian_asesor
FROM $asesi a
JOIN $jadual_asesmen b ON b.id=a.jadwal_id
JOIN $perangkat_asesmen c ON c.id=b.id_perangkat
JOIN $perangkat_asesmen_detail d ON d.id_perangkat_asesmen=c.id
            WHERE d.id ='$id' AND a.id_asesor='$id_asesor'
        ");
        return $query->result();
    }

    function detail_soal($id) {
        $this->db->select('a.*,b.unit_kompetensi,b.id_unit_kompetensi as kode_unit');
        $this->db->from(kode_tbl() . 'soal a');
        $this->db->join(kode_tbl() . 'unit_kompetensi b', 'a.id_unit_kompetensi=b.id');
        $this->db->where('a.id_perangkat_detail', $id);
        $detail_perangkat = $this->db->get()->result();
        return $detail_perangkat;
    }

}
