<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Role_Model extends MY_Model
{
	protected $_table = 't_role';
	
	protected $table_label = 'Role Data';
	
	protected $_columns = array(
		'nama_peran'		=>	array(
			'label'	=>	'Role Name',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 50
		),
		'keterangan'		=>	array(
			'label'	=>	'Descriptions',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 75
		)
	);	
	
	protected $_order = "id";
	
	protected $_unique = array('unique'=>array('nama_peran'), 'group'=>false);

	function __construct()
	{
		parent::__construct();
	}

}