<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class agenda_Model extends MY_Model
{
	protected $_table = 't_agenda';
	
	protected $table_label = 'Agenda';
	
	protected $_columns = array(
		'agenda'		=>	array(
			'label'	=> 'Agenda',
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
        'time_to'		=>	array(
			'label'	=> 'Time To',
			'rule' => 'xss_clean',
			'formatter'	=>	'datetime',
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