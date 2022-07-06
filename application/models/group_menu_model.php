<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Group_Menu_Model extends MY_Model
{
	protected $_table = 't_group_menu';
	
	protected $table_label = 'Data Group Menu';
	
	protected $_columns = array(
		'group_name'		=>	array(
			'label'	=>	'Group Menu Name',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 150
		),
		'no_urut'		=>	array(
			'label'	=>	'Serial Number',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'int',
			'save_formatter' => 'int', 
			'width' => 50
		)
	);	
	
	protected $_order = "group_name";
	
	protected $_unique = array('unique'=>array('group_name'), 'group'=>false);

	function __construct()
	{
		parent::__construct();
	}

}