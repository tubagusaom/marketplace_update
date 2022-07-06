<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class V_laporan_asesmen extends MY_Model 
{
	protected $_table = 'v_laporan_asesmen';
	
	protected $table_label = 'Laporan Asesmen';
	
	protected $_columns = array(
		'jadual'	=>	array(
			'label'	=> 	'Nama Jadwal',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 250
		),
        'tanggal' => array(
            'label' => 'Tanggal Uji',
            'rule' => 'trim|xss_clean',
            'formatter' => 'general_date',
            'save_formatter' => 'date',
            'width' => 100,
            'align' =>'center',
        ),
		'tuk'	=>	array(
			'label'	=> 	'Tempat Uji Kompetensi',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 150
		),
		'jumla_asesi'	=>	array(
			'label'	=> 	'Asesi',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 100,
			'align'=>'center'
		),
		'nk'	=>	array(
			'label'	=> 	'Belum di Rekomendasi',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 150,
			'align'=>'center'
		),
		'k'	=>	array(
			'label'	=> 	'K',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 50,
			'align'=>'center'
		),
		'bk'	=>	array(
			'label'	=> 	'BK',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 50,
			'align'=>'center'
		)
	);
	
	protected $_order = array("id"=>"DESC");
	
	public function __construct()
	{
		parent::__construct();
	}
	
}