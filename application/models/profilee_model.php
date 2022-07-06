<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Profilee_Model extends MY_Model {
    
    public function __construct() {
        $this->_table = 'lsp017_profile'; 
        parent::__construct($this->_table);
    }
    protected $_table;
    protected $table_label = 'Profile';
    protected $_columns = array(
        'judul' => array(
            'label' => 'Judul',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'headline' => array(
            'label' => 'Headline',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => true,
        ),        
        'isi' => array(
            'label' => 'Profile',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => true,
        ),
    );
    
    protected $belongs_to = array(
        'kategori' => array(
            'model' => 'artikel_kategori_model',
            'primary_key' => 'id_kategori',
            'retrieve_columns' => array('kategori')
        )
    );
    
    function url2images($url)
	{
		if(!is_null($url) && !empty($url)) {
			return "<img width=80px height=80px src='" . base_url() . "uploads/slide/" . $url . "' class='img-circle' />";
		} else {
			return "<img width=80px height=80px src='" . base_url() . "uploads/slide/person_default.jpg' class='img-circle' />";
		}
	}
    
    protected $_order = "id";
    protected $_unique = array('unique' => array('id'), 'group' => false);

   
    
 

}