<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Pesan_Model extends MY_Model {

    protected $_table = 't_pesan';
    protected $table_label = 'Data Ticket';
    protected $_columns = array(
        'parent_id' => array(
            'label' => 'Code Room',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' =>'true'
        ),
        'title' => array(
            'label' => 'Title',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'message' => array(
            'label' => 'Message',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'sender_id' => array(
            'label' => 'Pengirim',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'reciepent_id' => array(
            'label' => 'Penerima',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'status_read_recepient' => array(
            'label' => 'Status Read',
            'rule' => 'trim|xss_clean',
            'formatter' => array('Unread','Read'),
            'save_formatter' => 'string',
            'width' => 100,
            'align' => 'center'
        ),
        'status_ticket' => array(
            'label' => 'Status Ticket',
            'rule' => 'trim|xss_clean',
            'formatter' => array('Dibuka','Ditutup'),
            'save_formatter' => 'string',
            'width' => 100,
            'align' => 'center'
        ),
        'attachment' => array(
            'label' => 'Status Ticket',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 100,
            'align' => 'center'
        )
    );
    protected $_order = array("id" => "DESC");
    protected $_unique = array('unique' => array('id'), 'group' => false);

    function __construct() {
        parent::__construct();
    }
    function comment($id){
        $this->db->select('a.*,b.nama_user');
        $this->db->join('t_users b','a.sender_id=b.id');
        $this->db->from('t_pesan a');
        $this->db->where('a.parent_id',$id);
        $query = $this->db->get();
        return $query->result();
    }
}
