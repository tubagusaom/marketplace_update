<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Skema_unit_model extends MY_Model {
  public function __construct() {
        $this->_table = kode_tbl()."skema_detail"; 
        parent::__construct($this->_table);
    }
    protected $_table;
    protected $table_label = 'Data Skema Unit Kompetensi';
    protected $_columns = array(
        'id_skema' => array(
            'label' => 'Skema Sertifikasi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'skema',
            'save_formatter' => 'string',
            'width' => 300,
        ),
        'id_unit_kompetensi' => array(
            'label' => 'Unit Kompetensi',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'unit_kompetensi',
            'save_formatter' => 'string',
            'width' => 450
        ),
        'no_urut' => array(
            'label' => 'No Urut',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 100
        )
    );
 protected $_order = array("id_skema" => "DESC",'no_urut'=>'ASC');
 protected $belongs_to = array(
          'unit' =>  array(
          'model' => 'unit_model',
          'primary_key' => 'id_unit_kompetensi',
          'retrieve_columns' => array('unit_kompetensi')
          ),
          'skema' =>  array(
          'model' => 'skema_model',
          'primary_key' => 'id_skema',
          'retrieve_columns' => array('skema')
          )
      );
    protected $_unique = array('unique' => array('id_skema','id_unit_kompetensi'), 'group' => true);

}
