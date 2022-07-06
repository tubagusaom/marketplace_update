<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Vpemakaian_blanko extends MY_Model 
{
	protected $_table = 'vpemakaian_blanko';
	
	protected $table_label = 'Laporan Pemakaian Blanko';
	
	protected $_columns = array(
		'total'	=>	array(
			'label'	=> 	'Total Blanko',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 150,
			'align'=>'center'
		),
		'blanko_kosong'	=>	array(
			'label'	=> 	'Blanko Kosong',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 100,
			'align'=>'center'
		),
		'telah_di_cetak'	=>	array(
			'label'	=> 	'Telah di Cetak',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 100,
			'align'=>'center'
		),
		'blanko_rusak'	=>	array(
			'label'	=> 	'Blanko Rusak',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 100,
			'align'=>'center'
		)
	);
	
	protected $_order = array("id"=>"DESC");
	
	public function __construct()
	{
		parent::__construct();
	}
	
}