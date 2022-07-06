<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Laporan_Model extends MY_Model {

    protected $_table = 'lsp';
    protected $table_label = 'LSP';
    protected $_columns = array(
        'id' => array(
            'label' => 'Kode LSP',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'lsp' => array(
            'label' => 'Nama LSP',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        )
    );
    
   
    protected $_order = array("id" => "ASC");
    protected $_unique = array('unique' => array('id'), 'group' => false);

    function __construct() {
        parent::__construct();
    }
    function skema_sertifikasi(){
        //$DB2 = $this->load->database('bnsp',TRUE);
        $asesi = kode_tbl().'asesi';
        $skema = kode_tbl().'skema';
        $query=$this->db->query("SELECT COUNT(a.skema_sertifikasi) as data,b.skema as name
        FROM $asesi a
        JOIN $skema b ON a.skema_sertifikasi=b.id
        GROUP BY a.skema_sertifikasi ORDER BY data DESC");
        $return=$query->result_array();
        return $return;
    }

    function statistik_lsp(){
        $DB2 = $this->load->database('bnsp',TRUE);
        $query=$DB2->query('SELECT COUNT(YEAR(dlisensi)) as data,YEAR(dlisensi) as name
        FROM lsp where kategori_lsp="lsp"
        GROUP BY YEAR(dlisensi)');
        $return=$query->result_array();
        //var_dump($return);
        return $return;
    }
    function total_lsp(){
        $DB2 = $this->load->database('bnsp',TRUE);
        $DB2->where('kategori_lsp','lsp');
        $return=count($DB2->get('lsp')->result());
        return $return;
    }
    function total_skema(){
        $DB2 = $this->load->database('bnsp',TRUE);
        $return=count($DB2->get('laporan_skema')->result());
        return $return;
    }
    function total_asesor(){
        $DB2 = $this->load->database('bnsp',TRUE);
        $return=count($DB2->get('laporan_asesor')->result());
        return $return;
    }
    function total_tuk(){
        $DB2 = $this->load->database('bnsp',TRUE);
        $return=count($DB2->get('laporan_tuk')->result());
        return $return;
    }
    function total_asesi(){
        $DB2 = $this->load->database('bnsp',TRUE);
        $return=count($DB2->get('laporan_sertifikat')->result());
        return $return;
    }
    
    function jenis_lsp(){
        $DB2 = $this->load->database('bnsp',TRUE);
        $query=$DB2->query("SELECT COUNT(jenis_lsp) as data,jenis_lsp as name
        FROM lsp
        WHERE kategori_lsp='lsp'
        GROUP BY jenis_lsp");
        $return=$query->result_array();
        return $return;
    }
    function data_lsp(){
        $DB2 = $this->load->database('bnsp',TRUE);
        $query=$DB2->query("SELECT SUM(IF(data_skema = 'Y' AND data_tuk = 'Y' AND data_asesor = 'Y' AND data_asesi = 'Y',1,0))AS 'Lengkap' FROM lsp");
        $hasil=$query->row();
        $jumlah_lsp = $this->total_lsp();
        $hasil_lengkap = $hasil->Lengkap;
        $array = array(
            array('data'=>$hasil_lengkap,'name'=>'Lengkap'),
            array('data'=>($jumlah_lsp - $hasil_lengkap),'name'=>'Belum Lengkap')
            );
        return $array;
    }
    function provinsi_lsp(){
        $DB2 = $this->load->database('bnsp',TRUE);
        $query=$DB2->query("SELECT COUNT(a.provinsi_id) as data,b.kode_wilayah as name,b.provinsi
                            FROM lsp a
                            JOIN master_provinsi b ON b.id=a.provinsi_id
                            WHERE a.provinsi_id != '' 
                            GROUP BY a.provinsi_id
                            ORDER BY data DESC");
        $return=$query->result();
        return $return;
    }
    function sektor_lsp(){
        $DB2 = $this->load->database('bnsp',TRUE);
        $query=$DB2->query('SELECT COUNT(sektor9) as data,sektor9 as name
        FROM lsp
        GROUP BY sektor9');
        $return=$query->result_array();
        return $return;
    }
    function jenis_skema(){
        $DB2 = $this->load->database('bnsp',TRUE);
        $query=$DB2->query('SELECT COUNT(kategori_skema) as data,kategori_skema as name
        FROM laporan_skema
        WHERE kategori_skema != ""
        GROUP BY kategori_skema');
        $return=$query->result_array();
        return $return;
    }
    
    function sektor_skema(){
        $DB2 = $this->load->database('bnsp',TRUE);
        $query=$DB2->query('SELECT COUNT(sektor) as data,sektor as name
        FROM laporan_skema
        WHERE sektor != ""
        GROUP BY sektor');
        $return=$query->result_array();
        return $return;
    }
    function domisili_asesor(){
        $DB2 = $this->load->database('bnsp',TRUE);
        $query=$DB2->query('SELECT COUNT(provinsi) as data,provinsi as name
        FROM laporan_asesor
        WHERE provinsi != ""
        GROUP BY provinsi');
        $return=$query->result_array();
        return $return;
    }
    function bidang_asesor(){
        $DB2 = $this->load->database('bnsp',TRUE);
        $query=$DB2->query('SELECT COUNT(bidang) as data,bidang as name
        FROM laporan_asesor
        WHERE bidang != ""
        GROUP BY bidang');
        $return=$query->result_array();
        return $return;
    }
    function tahun_asesor(){
        $DB2 = $this->load->database('bnsp',TRUE);
        $query=$DB2->query('SELECT COUNT(tahun_laporan) as data,tahun_laporan as name
        FROM laporan_asesor
        WHERE tahun_laporan != ""
        GROUP BY tahun_laporan');
        $return=$query->result_array();
        return $return;
    }
    function provinsi_tuk(){
        $DB2 = $this->load->database('bnsp',TRUE);
        $query=$DB2->query('SELECT COUNT(provinsi) as data,provinsi as name
        FROM laporan_tuk
        WHERE provinsi != ""
        GROUP BY provinsi');
        $return=$query->result_array();
        return $return;
    }
    function jenis_tuk(){
        $DB2 = $this->load->database('bnsp',TRUE);
        $query=$DB2->query('SELECT COUNT(jenis_tuk) as data,jenis_tuk as name
        FROM laporan_tuk
        WHERE jenis_tuk != ""
        GROUP BY jenis_tuk');
        $return=$query->result_array();
        return $return;
    }
    function lsp_asesi(){
        $DB2 = $this->load->database('bnsp',TRUE);
        $query=$DB2->query('SELECT COUNT(nama_lsp) as data,nama_lsp as name
        FROM laporan_sertifikat
        GROUP BY nama_lsp');
        $return=$query->result_array();
        return $return;
    }
    function provinsi_asesi(){
        $DB2 = $this->load->database('bnsp',TRUE);
        $query=$DB2->query('SELECT COUNT(provinsi) as data,provinsi as name
        FROM laporan_sertifikat
        WHERE provinsi != ""
        GROUP BY provinsi');
        $return=$query->result_array();
        return $return;
    }
    function tahun_asesi(){
        $DB2 = $this->load->database('bnsp',TRUE);
        $query=$DB2->query('SELECT COUNT(tahun_laporan) as data,tahun_laporan as name
        FROM laporan_sertifikat
        WHERE tahun_laporan != ""
        GROUP BY tahun_laporan');
        $return=$query->result_array();
        return $return;
    }
    function laporan_lsp_detail(){
        $DB2 = $this->load->database('bnsp',TRUE);
        $query=$DB2->query("SELECT 
        SUM(IF(data_skema ='Y',1,0)) as skema_lengkap,
        SUM(IF(data_tuk ='Y',1,0)) as tuk_lengkap,
        SUM(IF(data_asesor ='Y',1,0)) as asesor_lengkap,
        SUM(IF(data_asesi ='Y',1,0)) as asesi_lengkap
        FROM lsp");
        $return=$query->row_array();
        return $return;
    }
    function laporan_lsp_detail_n(){
        $DB2 = $this->load->database('bnsp',TRUE);
        $query=$DB2->query("SELECT 
        SUM(IF(data_skema ='N',1,0)) as skema_belum_lengkap,
        SUM(IF(data_tuk ='N',1,0)) as tuk_belum_lengkap,
        SUM(IF(data_asesor ='N',1,0)) as asesor_belum_lengkap,
        SUM(IF(data_asesi ='N',1,0)) as asesi_belum_lengkap
        FROM lsp");
        $return=$query->row_array();
        return $return;
    }
}