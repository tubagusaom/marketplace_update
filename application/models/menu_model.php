<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Menu_Model extends MY_Model
{
	protected $_table = 't_menu';
	protected $table_label = 'Data Menu';

	protected $_columns = array(
		'group_menu_id'		=>	array(
			'label'	=>	'Group Menu Name',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'group_name',
			'save_formatter' => 'int',
			'width' => 150
		),
		'menu_name'		=>	array(
			'label'	=>	'Menu Name',
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
		'no_urut'		=>	array(
			'label'	=>	'Serial Number',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'int',
			'save_formatter' => 'int',
			'width' => 150
		)
	);

	protected $_order = "group_menu_id, menu_name";

	protected $_unique = array('unique'=>array('group_menu_id', 'menu_name'), 'group'=>true);

	protected $belongs_to = array(
		'groupdd'=>array(
			'model'=>'Group_Menu_Model',
			'primary_key'=>'group_menu_id',
			'retrieve_columns'=>array('grosup_name')
		)
	);

	protected $has_many = array(
		'acl' => array(
			'model' => 'Menu_Acl_Model',
			'primary_key' => 'menu_id',
			'retrieve_columns' => array('acl_id')
		)
	);

	function __construct()
	{
		parent::__construct();
	}

}
