<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Import_tuk_model extends MY_Model {

   // protected $_table = 'lsp029_import_skema';
    public function __construct() {
        $this->_table = kode_tbl()."tuk_temp"; 
        parent::__construct($this->_table);
    }
    protected $_table;
        
    protected $table_label = 'Data Import TUK';
    protected $_columns = array(
       'no_cab' => array(
            'label' => 'Kode TUK',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 80,
            'align' => 'center'
        ),
        'tuk' => array(
            'label' => 'TUK',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 250
        ),
        'alamat' => array(
            'label' => 'Alamat',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 280
        ),
        'telp' => array(
            'label' => 'No. Telp',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 90
        ),
        'email_tuk' => array(
            'label' => 'Email',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 130
        ),
        'is_users' => array(
            'label' => 'Is Users?',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 90,
            'align' => 'center'
        )
    );
    protected $_order = array("id" => "ASC");
/*    protected $belongs_to = array(
         
          'skema' =>  array(
          'model' => 'skema_model',
          'primary_key' => 'skema_sertifikasi',
          'retrieve_columns' => array('skema')
          )
      );*/
      
    protected $_unique = array('unique' => array('id'), 'group' => false);

}