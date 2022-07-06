<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Kontak_model extends MY_Model {

    protected $_table = 't_kontak';
    protected $table_label = 'Data Pesan';
    protected $_columns = array(
        'nama_kontak' => array(
            'label' => 'Nama',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'email_kontak' => array(
            'label' => 'Email',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'subject_kontak' => array(
            'label' => 'Subject',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'message_kontak' => array(
            'label' => 'Message',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
    );

    protected $_order = array("id" => "DESC");
    protected $_unique = array('unique' => array('id'), 'group' => false);

    function __construct() {
        parent::__construct();
    }

    // function artikel_kontak()
    // {
    //     $this->db->select('a.id, a.judul, a.headline, a.isi');
    //     $this->db->from('lsp188_artikel a');
    //     $this->db->where('a.id', 123);
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    public function get_all_kontak($perpage, $offset,$search="") {
        if($search ==""){
            $this->db->order_by('id', 'ASC');
            $this->db->limit($perpage);
            $this->db->offset($offset);
            $query = $this->db->get('t_kontak');
        }else{
            $this->db->like('nama_kontak', $search);
            $this->db->order_by('id', 'ASC');
            $this->db->limit($perpage);
            $this->db->offset($offset);
            $query = $this->db->get('t_kontak');
        }
        return $query->result();
    }


}