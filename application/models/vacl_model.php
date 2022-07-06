<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Vacl_Model extends MY_Model
{

	protected $_table = 'v_acls';

	protected $table_label = 'ACL';

	protected $_columns = array(
		'rolename'		=>	array(
			'label'	=>	'Role Name',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string',
			'width' => 150
		),
		'controller_name'		=>	array(
			'label'	=>	'Controller Name',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string',
			'width' => 150
		),
		'method_name'		=>	array(
			'label'	=>	'Method Name',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string',
			'width' => 150
		),
		'request_method'		=>	array(
			'label'	=>	'Request Via',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'int',
			'save_formatter' => 'int',
			'width' => 150
		)
	);

	protected $_order = array("id" => "DESC");

	function __construct()
	{
		parent::__construct();
	}
}
