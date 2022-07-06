<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Faq_Model extends MY_Model {
    
    protected $_table = 't_faq';
    protected $table_label = 'FAQ';
    protected $_columns = array(
        'pertanyaan' => array(
            'label' => 'Pertanyaan',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'jawaban' => array(
            'label' => 'jawaban',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        )
    );
    
    protected $_order = "id";
    protected $_unique = array('unique' => array('id'), 'group' => false);

    function __construct() {
        parent::__construct();
    }

    function get_faq()
    {
        $query = $this->db->get('t_faq');
        return $query->result();
    }

}