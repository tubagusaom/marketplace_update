<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Album_Galeri_Model extends MY_Model {

    protected $_table = 't_galeri';
    protected $table_label = 'Galerry Data';
    protected $_columns = array(
        'nama_file' => array(
            'label' => 'File Name',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'id_kategori' => array(
            'label' => 'Categori',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'kategori',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'id_album' => array(
            'label' => 'Album',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'nama_album',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'foto' => array(
            'label' => 'Image',
            'rule' => 'trim|xss_clean',
            'formatter' => 'url2images',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'keterangan' => array(
            'label' => 'Keterangan',
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
        ),
        'nama_album' => array(
            'model' => 'album_model',
            'primary_key' => 'id_album',
            'retrieve_columns' => array('nama_album')
        )
    );

    protected $_order = array("id" => "ASC");
    protected $_unique = array('unique' => array('id'), 'group' => false);

    function __construct() {
        parent::__construct();
		//$this->_table = kode_tbl()."t_galeri";
    }

    function url2images($url)
	{
		if(!is_null($url) && !empty($url)) {
			return "<img width=80px height=80px src='" . base_url() . "assets/img/gallery/" . $url . "' class='img-circle' />";
		} else {
			return "<img width=80px height=80px src='" . base_url() . "uploads/slide/person_default.jpg' class='img-circle' />";
		}
	}

    function get_album()
    {
        $this->db->select('a.id_kategori, a.nama_album, a.keterangan, b.kategori, a.id');
        $this->db->from('t_album a');
        $this->db->join('tbl007_artikel_kategori b','a.id_kategori = b.id');
        $this->db->where('a.id_kategori', 9);
        $query = $this->db->get();
        return $query->result();
    }

	function get_valbum()
    {
        $this->db->select('a.id_kategori, a.nama_album, a.keterangan, b.id_album, a.id');
        $this->db->from('t_album a');
        $this->db->join('t_galeri b','a.id = b.id_album');
        $this->db->where('b.id_album',2);
        $query = $this->db->get();
        return $query->result();
    }

    function detail($id)
    {
        $this->db->select('a.nama_file, a.foto, a.keterangan, b.nama_album, a.id_album');
        $this->db->from('t_galeri a');
        $this->db->join('t_album b','a.id_album = b.id');
        $this->db->where('a.id_album',$id);
        $this->db->order_by('a.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

	function vdetail($id)
    {
        $this->db->select('a.nama_file, a.foto, a.keterangan, b.nama_album, a.id_album');
        $this->db->from('t_vgaleri a');
        $this->db->join('t_valbum b','a.id_album = b.id');
        $this->db->where('a.id_album',$id);
        $query = $this->db->get();
        return $query->result();
    }

    function all_galeri()
    {
        $query = $this->db->get('t_galeri');
        return $query->result();
    }

}
