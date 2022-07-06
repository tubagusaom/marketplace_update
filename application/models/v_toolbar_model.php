<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class V_Toolbar_Model extends MY_Model 
{
	protected $_table = 'v_toolbars';
	
	protected $table_label = 'Toolbar ACL';
	
	protected $_columns = array(
		'role_id'	=>	array(
			'label'	=>	'Role ID',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'int',
			'save_formatter' => 'int', 
			'width' => 50
		),
		'nama_peran'	=>	array(
			'label'	=>	'Role Name',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 100
		),
		'toolbar_name'	=>	array(
			'label'	=> 	'Toolbar Name',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 150
		),
		'no_urut'	=>	array(
			'label'	=> 	'Serial Number',
			'rule'	=>	'trim|xss_clean',
			'formatter'	=>	'int',
			'save_formatter' => 'int', 
			'width' => 150,
			'nullable' => true
		),
		'controller_name'	=>	array(
			'label'	=> 	'Controller Name',
			'rule'	=>	'trim|required|xss_clean', 
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 150
		),
		'method_name'	=>	array(
			'label'	=> 	'Method Name',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 150
		)
	);
	
	protected $_order = array('no_urut'=>'ASC',"toolbar_id"=>'ASC');
	
	public function __construct()
	{
		parent::__construct();
	}
	
}