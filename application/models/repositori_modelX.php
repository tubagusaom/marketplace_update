<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Repositori_Model extends MY_Model {

    protected $_table = 't_repositori';
    protected $table_label = 'Repository Data';
    protected $_columns = array(
        'nama_dokumen' => array(
            'label' => 'Document Name',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'id_categories' => array(
            'label' => 'Categories',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'categories',
            'save_formatter' => 'string',
            'width' => 100
        ),
        'nama_file' => array(
            'label' => 'File',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 250
        ),
        'description' => array(
            'label' => 'File',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'hidden' => 'true'
        ),
        'extension' => array(
            'label' => 'Ext',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 50,
            'align' => 'center'
        ),
        'file_size' => array(
            'label' => 'Size',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 50,
            'align' => 'center'
        ),
        
        'permisions' => array(
            'label' => 'Permissions',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => array('Publik','Private'),
            'width' => 70,
            'align' => 'center'
        )
    );
    
    protected $belongs_to = array(
        'categories' => array(
            'model' => 'categories_model',
            'primary_key' => 'id_categories',
            'retrieve_columns' => array('categories')
        )
    );
    
    protected $_order = array("id" => "ASC");
    protected $_unique = array('unique' => array('id'), 'group' => false);

    function __construct() {
        parent::__construct();
    }

    function get_repositori()
    {
        $this->db->select('a.id, a.id_categories, a.nama_dokumen, b.categories, COUNT(id_categories) AS total');
        $this->db->from('t_repositori a');
        $this->db->join('t_categories b','a.id_categories = b.id', 'left');
        $this->db->group_by('a.id_categories');
        $query = $this->db->get();
        return $query->result();
        
    }
    
    function detail($id)
    {
        $this->db->select('a.*');
        $this->db->from('t_repositori a');
        $this->db->where('id_categories', $id);
        $query = $this->db->get();
        return $query->result();
    }
    
}