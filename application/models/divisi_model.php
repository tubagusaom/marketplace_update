<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Divisi_Model extends MY_Model
{

	protected $_table = 't_divisi';
	
	protected $table_label = 'Data Divisi';
	
	protected $_columns = array(
		'nama_divisi'		=>	array(
			'label'	=>	'Division Name',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 150
		),
		'nama_singkat'		=>	array(
			'label'	=>	'Short Name',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 150
		)
	);	
	
	protected $_order = array("nama_divisi"=>"ASC");
	
	protected $has_many = array(
		'pegawai' =>  array(
			'model' => 'Pegawai_Model',
			'primary_key' => 'divisi_id',
			'retrieve_columns' => array('nama_pegawai')
		)
	);
	
	protected $_unique = array('unique'=>array('nama_divisi'), 'group'=>false);

	function __construct()
	{
		parent::__construct();
	}
}