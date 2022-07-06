<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class V_monitoring extends MY_Model 
{
	protected $_table = 'vmonitoring';
	
	protected $table_label = 'Monitoring Asesmen';
	
	protected $_columns = array(
		'keterangan'	=>	array(
			'label'	=> 	'Nama Proses',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 150
		),
		'total'	=>	array(
			'label'	=> 	'Total Peserta (orang)',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 150
		)
	);
	
	protected $_order = array("id"=>"ASC");
	
	public function __construct()
	{
		parent::__construct();
	}
	
}