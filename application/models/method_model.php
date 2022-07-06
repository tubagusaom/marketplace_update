<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Method_Model extends MY_Model
{
	protected $_table = 't_method';
	
	protected $table_label = 'Data Method Name';
	
	protected $_columns = array(
		'method_name'		=>	array(
			'label'	=>	'Method Name',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 150
		)
	);	
	
	protected $has_many = array(
		'controller_method'=>array(
			'model'=>'Controller_Method_Model', 
			'primary_key'=>'method_id', 
			'retrieve_columns'=>array('controller_id')
		)
	);
	
	protected $_order = "id";
	
	protected $_unique = array('unique'=>array('method_name'), 'group'=>false);
	
	protected $before_create = array('add_callback', 'update_callback');
	
	protected $before_update = array('update_callback');

	function __construct()
	{
		parent::__construct();
	}

}