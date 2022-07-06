<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class V_Group_Menu_Model extends MY_Model
{
	protected $_table = 'v_groups_menus';
	
	protected $table_label = 'Data Group Menu';
	
	protected $_columns = array(
		'group_name'		=>	array(
			'label'	=>	'Group Menu Name',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 100
		),
		'menu_name'		=>	array(
			'label'	=>	'Menu Name',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 100
		)
	);	
	
	protected $_order = "group_name, menu_name";

	function __construct()
	{
		parent::__construct();
	}

}