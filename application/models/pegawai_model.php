<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Pegawai_Model extends MY_Model
{

	protected $_table = 't_pegawai';
	
	protected $table_label = 'Employee Data';
	
	protected $_columns = array(
		'no_pegawai'		=>	array(
			'label'	=>	'Employee Number',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 150
		),
		'nama_pegawai'		=>	array(
			'label'	=>	'Employee Name',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 150
		),
		'nama_pegawai_gelar'		=>	array(
			'label'	=>	'Full Name',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 150
		),
		'divisi_id'		=>	array(
			'label'	=>	'Division',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'nama_singkat',
			'save_formatter' => 'int', 
			'width' => 150
		)
	);	
	
	protected $_order = array("no_pegawai"=>"ASC");
	
	protected $belongs_to = array(
		'divisi' =>  array(
			'model' => 'Divisi_Model',
			'primary_key' => 'divisi_id',
			'retrieve_columns' => array('nama_singkat')
		)
	);
	
	protected $_unique = array('unique'=>array('no_pegawai'), 'group'=>false);

	function __construct()
	{
		parent::__construct();
	}
}