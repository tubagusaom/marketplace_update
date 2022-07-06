<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class karir_Model extends MY_Model
{
	protected $_table = 't_karir';
	
	protected $table_label = 'Lowongan Kerja';
	
	protected $_columns = array(
		'karir'		=>	array(
			'label'	=> 'Karir',
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
        'created_when'		=>	array(
			'label'	=> 'Created Date',
			'rule' => 'xss_clean',
			'formatter'	=>	'datetime',
			'save_formatter' => 'date', 
			'width' => 150
		),
        'expired_when'		=>	array(
			'label'	=> 'Expired date',
			'rule' => 'required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
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