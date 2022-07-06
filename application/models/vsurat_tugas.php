<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vsurat_tugas extends MY_Model
{
	protected $_table = 'vsurat_tugas';

	protected $table_label = 'Surat Tugas';

	protected $_columns = array(
		'jadual'	=>	array(
			'label'	=> 	'Nama Jadwal',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string',
			'width' => 200
		),
		'tanggal'	=>	array(
			'label'	=> 	'Tanggal ',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'general_date',
			'save_formatter' => 'date',
			'width' => 80,
			'align' => 'center'
		),
		'tuk'	=>	array(
			'label'	=> 	'Tempat Uji Kompetensi',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string',
			'width' => 180
		),
		'jumlah_asesi'	=>	array(
			'label'	=> 	'Asesi',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string',
			'width' => 50,
			'align'=>'center'
		),
		'nama_asesor'	=>	array(
			'label'	=> 	'Nama Asesor',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string',
			'width' => 150

		)	);

	protected $_order = array("id"=>"DESC");

	public function __construct()
	{
		parent::__construct();
	}
	function group_by_sekolah(){
		$query = $this->db->query("SELECT a.id,a.asal_sekolah,a.pel_kompetensi,a.program_keahlian,count(a.id) as total
		FROM lsp304_psertifikasi a
		GROUP BY a.asal_sekolah");
		return $query->result();
	}
	function keputusan_asesmen(){
		$query=$this->db->query("SELECT
		SUM(IF(a.rekomendasi_asesor='1',1,0)) as total_kompeten,
		SUM(IF(a.rekomendasi_asesor='0',1,0)) as total_belum_kompeten
		FROM lsp304_asesi a");
        $hasil=$query->row();
        $array = array(
            array('data'=>$hasil->total_kompeten,'name'=>'Kompeten'),
            array('data'=>$hasil->total_belum_kompeten,'name'=>'Belum Kompeten')
            );
        return $array;
	}
	function detail_keputusan_asesmen(){
		$query = $this->db->query("select a.id AS id,b.id AS id_tuk,a.jadual AS jadual,a.tanggal,
		b.tuk AS tuk,count(c.id) AS jumlah_asesi
		,sum(if((c.rekomendasi_asesor = '0'),1,0)) AS belum_rekomendasi
		,sum(if((c.rekomendasi_asesor = '1'),1,0)) AS k
		,sum(if((c.rekomendasi_asesor = '2'),1,0)) AS bk
		 from ((lsp304_jadual_asesmen a
		join lsp304_tuk b on((a.id_tuk = b.id)))
		join lsp304_asesi c on((c.jadwal_id = a.id))) group by a.id");
		return $query->result();
	}

	function surat_tugas($id){

			$asesi = kode_tbl().'asesi';
			$jadwal = kode_tbl().'jadual_asesmen';
			$tuk = kode_tbl().'tuk';
			$asesor = kode_tbl().'users';
			$map_asesor = kode_tbl().'mapping_asesor';

			$query = $this->db->query("SELECT
				b.id AS jadwal_id,
				b.jadual,
				b.tanggal,
				c.users AS nama_asesor

				FROM $map_asesor a
				JOIN $jadwal b ON b.id=a.id_jadwal
				JOIN $asesor c ON c.id=a.id_asesor
				WHERE a.id_asesor=$id");
			return $query->result();
	}

}
