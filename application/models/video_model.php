<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Video_model extends MY_Model {

    protected $_table = 't_video';
    protected $table_label = 'Data Link Video';
    protected $_columns = array(
        'nama_video' => array(
            'label' => 'Judul',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'link_video' => array(
            'label' => 'Link Embed',
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

    public function get_all_video($perpage, $offset,$search="") {
        if($search ==""){
            $this->db->order_by('id', 'DESC');
            $this->db->limit($perpage);
            $this->db->offset($offset);
            $query = $this->db->get('t_video');
        }else{
            $this->db->like('nama_video', $search);
            $this->db->order_by('id', 'DESC');
            $this->db->limit($perpage);
            $this->db->offset($offset);
            $query = $this->db->get('t_video');
        }
        return $query->result();
    }

    function get_video(){
        $this->db->select('a.nama_video, a.link_video, a.id');
        $this->db->from('t_video a');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }


}
