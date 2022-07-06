<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Vbidang_asesor extends MY_Model 
{
	protected $_table = 'v_bidang_asesor';
	
	protected $table_label = 'Laporan Asesor per bidang';
	
	protected $_columns = array(
		'skema'	=>	array(
			'label'	=> 	'Nama Skema Sertifikasi',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 200
		),
        'total' => array(
            'label' => 'Jumlah Asesor',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 120,
            'align' =>'center',
        )
	);
	
	protected $_order = array("id"=>"ASC");
	
	public function __construct()
	{
		parent::__construct();
	}
	
}