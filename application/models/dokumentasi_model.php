<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Dokumentasi_Model extends MY_Model
{
	protected $_table = 't_dokumentasi';
	
	protected $table_label = 'Documentation';
	
	protected $_columns = array(
		'nama_file'		=>	array(
			'label'	=>	'Filename',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 100
		)
	);	
	
	protected $_order = "id";
	
	protected $_unique = array('unique'=>array('nama_file'), 'group'=>false);

	function __construct()
	{
		parent::__construct();
	}

}