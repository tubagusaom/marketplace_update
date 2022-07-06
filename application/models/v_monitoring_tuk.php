<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class V_monitoring_tuk extends MY_Model 
{
	protected $_table = 'vlaporan_pertuk';
	
	protected $table_label = 'Monitoring Asesmen TUK';
	
	protected $_columns = array(
		'id_tuk'	=>	array(
			'label'	=> 	'Nama Proses',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'hidden' => true
		),
		'tuk'	=>	array(
			'label'	=> 	'Nama TUK',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => '190'
		),
		'total'	=>	array(
			'label'	=> 	'Total Peserta',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => '90',
			'align' => 'center'
		),
		'pra_asesmen'	=>	array(
			'label'	=> 	'Pra Asesmen',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => '90',
			'align' => 'center'
		),
		'administrasi'	=>	array(
			'label'	=> 	'Administrasi',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => '90',
			'align' => 'center'
		),
		'terjadwal'	=>	array(
			'label'	=> 	'Terjadwal',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => '90',
			'align' => 'center'
		),
		'terekomendasi'	=>	array(
			'label'	=> 	'Rekomendasi',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => '90',
			'align' => 'center'
		),
		'cetak_sertifikat'	=>	array(
			'label'	=> 	'Cetak Sertifikat',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => '90',
			'align' => 'center'
		)
	);
	
	protected $_order = array("id"=>"ASC");
	
	public function __construct()
	{
		parent::__construct();
	}
	
}