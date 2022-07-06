<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Hyperlink_Model extends MY_Model
{
	protected $_table = 't_hyperlink';
	
	protected $table_label = 'Information / Hyperlink Data';
	
	protected $_columns = array(
		'hyperlink'		=>	array(
			'label'	=> 'Hyperlink',
			'rule' => 'required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 150
		),
        'description'		=>	array(
			'label'	=> 'Description',
			'rule' => 'required|xss_clean',
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