<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Combo_Users_Model extends MY_Model
{
	protected $_table = 't_users';
	
	protected $table_label = 'Data Users';
	
	protected $_columns = array(
		'nama_user'		=>	array(
			'label'	=>	'Username',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 150
		),'email'		=>	array(
			'label'	=>	'Email',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 150
		),'jenis_user'		=>	array(
			'label'	=>	'User Category',
			'rule'	=>	'trim|xss_clean',
			'formatter'	=>	array('-','Pemegang Sertifikat','Asesor','TUK','Administrator'),
			'save_formatter' => 'string', 
			'width' => 100
		)
	);	
	
	protected $_order = "nama_user";

	function __construct()
	{
		parent::__construct();
	}

}