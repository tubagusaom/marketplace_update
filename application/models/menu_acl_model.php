<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Menu_Acl_Model extends MY_Model
{
	protected $_table = 't_menu_acl';
	
	protected $table_label = 'Data Menu Access Control List';
	
	protected $_columns = array(
		'menu_id'		=>	array(
			'label'	=>	'Menu Name',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'int',
			'save_formatter' => 'int', 
			'width' => 150
		),
		'acl_id'		=>	array(
			'label'	=>	'ACL',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'int',
			'save_formatter' => 'int', 
			'width' => 150
		)
	);	
	
	protected $_order = "menu_id, acl_id";
	
	protected $_unique = array('unique'=>array('menu_id', 'acl_id'), 'group'=>true);

	function __construct()
	{
		parent::__construct();
	}

}