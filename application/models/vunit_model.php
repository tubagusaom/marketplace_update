<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Vunit_model extends MY_Model {
 protected $_table= 'vunit';
    protected $table_label = 'Data Unit';
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
            'label' => 'Translate',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 250
        ),
        'skema' => array(
            'label' => 'Skema',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 250
        ),
        'id_skema' => array(
            'label' => 'Skema',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 250,
            'hidden' => 'true'
        )
    );
 protected $_order = array("skema" => "ASC");

    protected $_unique = array('unique' => array('id'), 'group' => false);

}
