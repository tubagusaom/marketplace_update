<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class V_User_Role_Model extends MY_Model
{
	protected $_table = 'v_userrole';

	protected $table_label = 'Data User Role';

	protected $_columns = array(
		'akun'		=>	array(
			'label'	=>	'Username',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string',
			'width' => 100
		),
		'nama_user'		=>	array(
			'label'	=>	'Shortname',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string',
			'width' => 150
		),
		'nama_peran'	=> array(
			'label'	=>	'Role',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string',
			'width' => 150
		),
		'role_id'	=> array(
			'label'	=>	'Email Address',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'int',
			'save_formatter' => 'int',
			'width' => 150
		)
	);

	protected $_order = "id";

	function __construct()
	{
		parent::__construct();
	}

}
