<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Toolbar_Model extends MY_Model
{

	protected $_table = 't_toolbars';
	
	protected $table_label = 'Data Toolbar';
	
	protected $_columns = array(
		'toolbar_name'		=>	array(
			'label'	=>	'Toolbar Name',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 150
		),
		'icon_name'		=>	array(
			'label'	=>	'Icon Name',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 150
		),
		'function_type'		=>	array(
			'label'	=>	'Function Name',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 150
		)
	);	
	
	protected $_order = "toolbar_name";
	
	function __construct()
	{
		parent::__construct();
	}
}