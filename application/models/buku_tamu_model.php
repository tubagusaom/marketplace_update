<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Buku_tamu_Model extends MY_Model
{
	protected $_table = 't_buku_tamu';
	
	protected $table_label = 'Buku Tamu Data';
	
	protected $_columns = array(
		'nama'		=>	array(
			'label'	=> 'Nama',
			'rule' => 'required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 150
		),
        'email'		=>	array(
			'label'	=> 'Email',
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
		)
	);	
	
	protected $_order = "id";
	
	protected $_unique = array('unique'=>array('id'), 'group'=>false);

	function __construct()
	{
		parent::__construct();
	}

}