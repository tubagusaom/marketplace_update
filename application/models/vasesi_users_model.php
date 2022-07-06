<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Vasesi_Users_Model extends MY_Model 
{
	protected $_table = 'vasesi_users_model';
	
	protected $table_label = 'Data User';
	
	protected $_columns = array(		
		'nama_user' => array(
		    'label'	=>	'Shortname',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 100
		),
		'email'		=>	array(
			'label'	=>	'Email',
			'rule'	=>	'trim|required|valid_email|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 150
		),
		'jenis_user' => array(
		    'label'	=>	'User Category',
			'rule'	=>	'trim|xss_clean',
			'formatter'	=>	array(0=>'-', 1=>'Pemegang Sertifikat', 2=>'Asesor', 3=>'TUK', 4=>'Administrator'),
			'save_formatter' => 'string', 
			'width' => 90
		)
	);
	
	protected $_order = "akun";
	
	public function __construct()
	{
		parent::__construct();
	}
}