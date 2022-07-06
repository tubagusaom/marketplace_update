<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class V_Pesan_Model extends MY_Model {

    protected $_table = 'v_pesan';
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
        'created_when' => array(
            'label' => 'Date',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'datetime',
            'save_formatter' => 'date',
            'width' => 150
        ),
        'pengirim' => array(
            'label' => 'Pengirim',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'penerima' => array(
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
            'formatter' => array('Closed','Open'),
            'save_formatter' => 'string',
            'width' => 100,
            'align' => 'center'
        )
    );
    protected $_order = array("id" => "DESC");

    /* 	protected $belongs_to = array(
      'divisi' =>  array(
      'model' => 'Divisi_Model',
      'primary_key' => 'divisi_id',
      'retrieve_columns' => array('nama_singkat')
      )
      );
     */
    protected $_unique = array('unique' => array('room_code'), 'group' => false);

    function __construct() {
        parent::__construct();
    }

}
