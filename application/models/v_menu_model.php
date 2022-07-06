<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class V_Menu_Model extends MY_Model 
{
	protected $_table = 'v_menus';
	
	protected $table_label = 'Menu Access Control List';
	
	protected $_columns = array(
		'nama_peran'	=>	array(
			'label'	=> 	'Role',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 100
		),
		'group_name'	=>	array(
			'label'	=>	'Group Menu Name',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 80
		),
		'menu_name'	=>	array(
			'label'	=>	'Menu Name',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 100
		),
		'controller_name'	=>	array(
			'label'	=>	'Controller Name',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 100
		),
		'method_name'	=>	array(
			'label'	=>	'Method Name',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 100
		),
		'g_no_urut'	=>	array(
			'label'	=>	'Group Serial Number',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'int',
			'save_formatter' => 'int', 
			'width' => 100,
			'hide'	=> true
		),
		'm_no_urut'	=>	array(
			'label'	=>	'Menu Serial Number',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'int',
			'save_formatter' => 'int', 
			'width' => 100,
			'hide'	=> true
		)
	);
	
	protected $_order = array("g_no_urut"=>"ASC", "m_no_urut"=>"ASC");
	
	public function __construct()
	{
		parent::__construct();
	}
	
}