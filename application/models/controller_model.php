<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Controller_Model extends MY_Model
{
	protected $_table = 't_controller';
	
	protected $table_label = 'Data Nama Controller';
	
	protected $_columns = array(
		'controller_name'		=>	array(
			'label'	=>	'Nama Controller',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 80
		),
        'description'		=>	array(
			'label'	=>	'Description',
			'rule'	=>	'trim|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 250
		)
	);	
	protected $has_many = array(
		'controller_method'=>array(
			'model'=>'Controller_Method_Model', 
			'primary_key'=>'controller_id', 
			'retrieve_columns'=>array('method_id')
		)
	);
	
	protected $_order = "id";
	
	protected $_unique = array('unique'=>array('controller_name'), 'group'=>false);
	
	protected $before_create = array('add_callback', 'update_callback');
	
	protected $before_update = array('update_callback');

	function __construct()
	{
		parent::__construct();
	}

}