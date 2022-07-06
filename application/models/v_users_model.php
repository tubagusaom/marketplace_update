<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class V_Users_Model extends MY_Model
{
	protected $_table = 'v_users';
	
	protected $table_label = 'Data Users';
	
	protected $_columns = array(
		'akun'		=>	array(
			'label'	=>	'Username',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 150
		),
		'nama_user'		=>	array(
			'label'	=>	'Shortname',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 150
		),
		'nama'		=>	array(
			'label'	=>	'Nama',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 150
		)
	);	
	
	protected $_order = "akun";

	function __construct()
	{
		parent::__construct();
	}

}