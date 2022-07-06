<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class V_Controller_Method_Role_Model extends MY_Model
{
	protected $_table = 'v_controller_method_role';
	
	protected $table_label = 'Data ACL';
	
	protected $_columns = array(
		'acl'		=>	array(
			'label'	=>	'Controller Method Role',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 100,
			'hidden' => true
		),
		'controller_name'		=>	array(
			'label'	=>	'Controller Name',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 100
		),
		'method_name'		=>	array(
			'label'	=>	'Method Name',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 100
		),
		'nama_peran'		=>	array(
			'label'	=>	'Role',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 100
		)
	);	
	
	protected $_order = "acl, id";

	function __construct()
	{
		parent::__construct();
	}

}