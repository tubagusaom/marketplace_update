<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Toolbar_Acl_Model extends MY_Model
{

	protected $_table = 't_toolbars_acl';
	
	protected $table_label = 'Data Toolbar Access Control';
	
	protected $_columns = array(
		'toolbar_id'		=>	array(
			'label'	=>	'Toolbar ID',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 150
		),
		'acl_id'		=>	array(
			'label'	=>	'Access Control',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'int',
			'save_formatter' => 'int', 
			'width' => 150
		),
		'no_urut'	=>	array(
			'label'	=> 	'Toolbar Name',
			'rule'	=>	'trim|xss_clean',
			'formatter'	=>	'int',
			'save_formatter' => 'int', 
			'width' => 150,
			'nullable' => true
		),
		'grid_type'		=>	array(
			'label'	=>	'Grid Type',
			'rule'	=>	'trim|xss_clean',
			//'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'int',
			'save_formatter' => 'int', 
			'width' => 150
		),
		'parent_grid'		=>	array(
			'label'	=>	'Main Grid',
			'rule'	=>	'trim|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 150,
			'nullable' => true
		),
		'modal_height'		=>	array(
			'label'	=>	'Height Modal Window',
			'rule'	=>	'trim|xss_clean',
			'formatter'	=>	'int',
			'save_formatter' => 'int', 
			'width' => 150,
			'nullable' => true
		),
		'modal_width'		=>	array(
			'label'	=>	'Width Modal Window',
			'rule'	=>	'trim|xss_clean',
			'formatter'	=>	'int',
			'save_formatter' => 'int', 
			'width' => 150,
			'nullable' => true
		)
	);	
	
	protected $_order = "acl_id, toolbar_id";
	
	function __construct()
	{
		parent::__construct();
	}
}