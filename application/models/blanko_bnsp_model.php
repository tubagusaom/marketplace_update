<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class blanko_bnsp_Model extends MY_Model
{
	protected $_table = 't_blanko';
	
	protected $table_label = 'Permintaan Blanko BNSP';
	
	protected $_columns = array(
		'no_permintaan'		=>	array(
			'label'	=> 'No Surat Permintaan',
			'rule' => 'xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 150
		),
        'tanggal_permintaan'		=>	array(
			'label'	=> 'Tanggal Permintaan',
			'rule' => 'required|xss_clean',
			'formatter'	=>	'general_date',
			'save_formatter' => 'date', 
			'width' => 150
		),      
        'no_seri_awal'		=>	array(
			'label'	=> 'No Seri Awal',
			'rule' => 'required|xss_clean',
			'formatter'	=>	'string',	
			'save_formatter' => 'string', 
			'width' => 150
		),
        'no_seri_akhir'		=>	array(
			'label'	=> 'No Seri Akhir',
			'rule' => 'required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string', 
			'width' => 150,
            
		),
        'keterangan'		=>	array(
			'label'	=> 'Keterangan',
			'rule' => 'xss_clean',
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