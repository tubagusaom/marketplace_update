<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Album_Model extends MY_Model {

    protected $_table = 't_album';
    protected $table_label = 'Album Data';
    protected $_columns = array(
        'nama_album' => array(
            'label' => 'Album Name',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'id_kategori' => array(
            'label' => 'Categories',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'kategori',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'keterangan' => array(
            'label' => 'Description',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        )
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
			return "<img width=80px height=80px src='" . base_url() . "assets/img/" . $url . "' class='img-circle' />";
		} else {
			return "";
		}
	}

    protected $_order = array("id" => "ASC");
    protected $_unique = array('unique' => array('id'), 'group' => false);

    function __construct() {
        parent::__construct();
    }

    function get_album()
    {
        $album = 't_album';
        $this->db->select('*');
        $this->db->from("$album a");
        $query = $this->db->get();
        return $query->result();
    }

    function get_detail($id)
    {
        $album = 't_album';
        $this->db->album('*');
        $this->db->from("$album a");
        $this->db->where("id", $id);
        $query = $this->db->get();
        return $query->row();
    }

}
