<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Blanko_bnsp_detail_model extends MY_Model {

    
    protected $_table = 't_blanko_detail';
    protected $table_label = 'Detail blanko';
    protected $_columns = array(
         
        'status_blanko' => array(
            'label' => 'Status',
            'rule' => 'trim|xss_clean',
            'formatter' => array('Blanko Kosong','Sudah di cetak','Blanko Rusak'),
            'save_formatter' => 'string',
            'width' => 200,
            
        ),
        'status_kondisi' => array(
            'label' => 'Keterangan',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 100,
            
        )
    );

    
    protected $_order = array("no_seri_blanko" => "DESC");

    //protected $_unique = array('unique' => array('id'), 'group' => false);
}
