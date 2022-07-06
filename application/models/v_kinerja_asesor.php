<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class V_kinerja_asesor extends MY_Model 
{
	protected $_table = 'vkinerja_asesor';
	
	protected $table_label = 'Kinerja Asesor';
	
	protected $_columns = array(
		'users'	=>	array(
			'label'	=> 	'Nama Asesor',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 200
		),
        'jumlah_penugasan' => array(
            'label' => 'Jumlah Asesi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 120,
            'align' =>'center',
        ),
		'belum_rekomendasi'	=>	array(
			'label'	=> 	'Belum di rekomendasi',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 160,
			'align' =>'center',
		),
		'kompeten'	=>	array(
			'label'	=> 	'Kompeten',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 100,
			'align'=>'center'
		),
		'belum_kompeten'	=>	array(
			'label'	=> 	'Belum Kompeten',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 150,
			'align'=>'center'
		),
		'persentase'	=>	array(
			'label'	=> 	'Persentase(%)',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 100,
			'align'=>'center'
		)
	);
	
	protected $_order = array("id"=>"ASC");
	
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
}