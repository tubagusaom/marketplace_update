<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Unit_model extends MY_Model {
  public function __construct() {
        $this->_table = kode_tbl()."unit_kompetensi"; 
        parent::__construct($this->_table);
    }
    protected $_table;
    protected $table_label = 'Data Unit Kompetensi';
    protected $_columns = array(
        'id_unit_kompetensi' => array(
            'label' => 'Kode Unit',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 100,
            'align' => 'center'
        ),
        'unit_kompetensi' => array(
            'label' => 'Unit Kompetensi',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 250
        ),
       'translate' => array(
            'label' => 'Translate of Unit Competency',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 250
        )
    );
 protected $_order = array("id" => "ASC");

    protected $_unique = array('unique' => array('id'), 'group' => false);

}
