<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Role_Model extends MY_Model
{
	protected $_table = 't_user_role';

	protected $table_label = 'Data User';

	protected $_columns = array(
		'user_id'	=>	array(
			'label'	=>	'Account',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'int',
			'save_formatter' => 'int',
			'width' => 150
		),
		'role_id'	=>	array(
			'label'	=> 	'Role ID',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'int',
			'save_formatter' => 'int',
			'width' => 150
		)
	);

	protected $belongs_to = array(
		'role'=>array(
			'model'=>'Role_Model',
			'primary_key'=>'role_id',
			'retrieve_columns'=>array('nama_peran')
		),
		'user'=>array(
			'model'=>'User_Model',
			'primary_key'=>'user_id',
			'retrieve_columns'=>array('akun', 'nama_user','id_member')
		)
	);

	protected $_order = "role_id,user_id";

	protected $_unique = array('unique'=>array('user_id'), 'group'=>false);

	//protected $_unique = array('unique'=>array('user_id', 'role_id'), 'group'=>true);

	public function __construct()
	{
		parent::__construct();
	}

}
