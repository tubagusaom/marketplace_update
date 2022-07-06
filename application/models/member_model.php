<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
Class Member_model extends MY_Model {

    public function __construct() {
        $this->_table = kode_tbl()."members";
        parent::__construct($this->_table);
    }
    protected $_table;
    protected $table_label = 'Data Merchant';
    protected $_columns = array(
        'member' => array(
            'label' => 'Merchant',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'email_member' => array(
            'label' => 'Email',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'tlp_member' => array(
            'label' => 'HP',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'is_member' => array(
            'label' => 'Akun ',
            'rule' => 'trim|xss_clean',
            'formatter'	=>	array(''=>'-',0=>'Non Aktiv', 1=>'Aktiv'),
            'save_formatter' => 'string',
            'width' => 50,
            'align' => 'center',
            'hidden' => true
        ),
        'id_group_member' => array(
            'label' => 'Akun Users',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 50,
            'hidden' => true
        ),
        'alamat_member' => array(
            'label' => 'HP',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => true
        ),
        'alamat_warehouse' => array(
            'label' => 'HP',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => true
        ),
        'npwp_member' => array(
            'label' => 'HP',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => true
        ),
        'id_province_member' => array(
            'label' => 'id_province_member',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => true
        ),
        'id_kabupaten_member' => array(
            'label' => 'id_kabupaten_member',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => true
        ),

    );
    protected $_order = array("id" => "DESC");

    protected $_unique = array('unique' => array('id'), 'group' => false);


    function detail_member($id){

      // var_dump($id); die();

      $this->db->from(kode_tbl().'member_detail');
      $this->db->where('id_member', $id);
      $query = $this->db->get();
      return $query->row();
    }

    function file_member($id){
      $this->db->from('t_repositori');
      $this->db->where('id_users', $id);
      $this->db->where('jenis_dokumen !=', '7');
      // $this->db->where('id_product', NULL);
      $query = $this->db->get();
      return $query->result();
    }

}
