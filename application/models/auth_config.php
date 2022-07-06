<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Auth_Config extends MY_Model 
{
	protected $_table = 't_auth_config';
	
	protected $table_label = 'Attempts Config';
	
	protected $_columns = array(
		'max_attempts'	=>	array(
			'label'	=>	'Maximum Tries',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'int',
			'save_formatter' => 'int', 
			'width' => 150
		),
		'time_to_wait'	=> array(
			'label'	=>	'Waiting Time',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'int',
			'save_formatter' => 'int', 
			'width' => 150
		)
	);
	
	protected $_order = "id";
	
	public function __construct()
	{
		parent::__construct();
	}

}
		