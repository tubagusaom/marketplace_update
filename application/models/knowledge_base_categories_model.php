<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Knowledge_base_categories_model extends MY_Model
{
	protected $_table = 't_kbc';
	
	protected $table_label = 'Knowledge Base Categories';
	
	protected $_columns = array(
		'category'		=>	array(
			'label'	=> 'Category',
			'rule' => 'required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 250
		),
        'no_urut'		=>	array(
			'label'	=> 'Order',
			'rule' => 'required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 150
		)
	);	
	
	protected $_order = "id";
	
	protected $_unique = array('unique'=>array('id'), 'group'=>false);

	function __construct()
	{
		parent::__construct();
	}

}