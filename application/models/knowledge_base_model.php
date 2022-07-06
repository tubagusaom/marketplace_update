<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Knowledge_base_model extends MY_Model {

     public function __construct() {
        $this->_table = "t_kb"; 
        parent::__construct($this->_table);
    }
    protected $_table;
    protected $table_label = 'Data Knowledge Base';
    protected $_columns = array(
        'title' => array(
            'label' => 'Title Of Knowledge',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 270
        ),
        'no_urut' => array(
            'label' => 'Order',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 40,
            'align' => 'center'
        ),
        'kbc_id' => array(
            'label' => 'Category',
            'rule' => 'trim|xss_clean',
            'formatter' => 'category',
            'save_formatter' => 'int',
            'width' => 180
        ),
        'summary' => array(
            'label' => 'Jumlah Unit',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 90,
            'hidden' => 'true'
        ),
        'description' => array(
            'label' => 'description',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => 'true'
        ),
        'link_download' => array(
            'label' => 'Download Skema',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'hidden' => 'true'
        ),
        'link_video' => array(
            'label' => 'Download Skema',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'hidden' => 'true'
        ),
        'download_times' => array(
            'label' => 'Download Skema',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'hidden' => 'true'
        ),
        'image_description' => array(
            'label' => 'Download Skema',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'hidden' => 'true'
        )
    );
    protected $_order = array("kbc_id" => "ASC","no_urut" => "ASC");
    protected $belongs_to = array(
		'category' =>  array(
			'model' => 'Knowledge_base_categories_model',
			'primary_key' => 'kbc_id',
			'retrieve_columns' => array('category'),
            'join_type'=>'left'
		)
	);
    protected $_unique = array('unique' => array('id'), 'group' => false);

}
