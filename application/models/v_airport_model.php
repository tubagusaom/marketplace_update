<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class V_airport_model extends MY_Model {

    protected $_table = 't_airport';
    protected $table_label = 'Data Airport';
    protected $_columns = array(
        'nama_airport' => array(
            'label' => 'Airport Name',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'airport_abr' => array(
            'label' => 'Abreviation',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 100
        )
    );
   
	protected $_unique = array('unique' => array('id'), 'group' => false);
    protected $_order = "nama_airport,airport_abr";
    function __construct() {
        parent::__construct();
    }

}
