<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Berita_Model extends MY_Model
{
	protected $_table = 't_information';
	
	protected $table_label = 'Information / News Data';
	
	protected $_columns = array(
		'title'		=>	array(
			'label'	=> 'Title',
			'rule' => 'required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 150
		),
        'headline'		=>	array(
			'label'	=> 'Headline',
			'rule' => 'required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 150
		),
        'content'		=>	array(
			'label'	=> 'Content',
			'rule' => 'required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 150
		),
        'images'		=>	array(
			'label'	=> 'Images',
			'rule' => 'xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 150
		),
        'category'		=>	array(
			'label'	=> 'Category',
			'rule' => 'xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 150
		),
        'created_when'		=>	array(
			'label'	=> 'Created Date',
			'rule' => 'xss_clean',
			'formatter'	=>	'general_date',
			'save_formatter' => 'date', 
			'width' => 150
		),
	);	
	
	protected $_order = "id";
	
	protected $_unique = array('unique'=>array('id'), 'group'=>false);

	function __construct()
	{
		parent::__construct();
	}

}