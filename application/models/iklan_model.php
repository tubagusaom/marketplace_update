<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Iklan_model extends MY_Model {

  public function __construct() {
      $this->_table = kode_tbl()."iklan";
      parent::__construct($this->_table);
  }

  protected $_table;
  protected $table_label = 'Data Slide';
  protected $_columns = array(
    'nama_iklan' => array(
        'label' => 'Nama Iklan',
        'rule' => 'trim|xss_clean',
        'formatter' => 'string',
        'save_formatter' => 'string',
        'width' => 150
    ),
    'status_iklan' => array(
        'label' => 'Status Iklan',
        'rule' => 'trim|xss_clean',
        'formatter' => array('Tidak Aktiv','Aktiv'),
        'save_formatter' => 'string',
        'width' => 60,
        'align' =>'center',
    ),
    'urutan_iklan' => array(
        'label' => 'No Urut',
        'rule' => 'trim|xss_clean',
        'formatter' => 'string',
        'save_formatter' => 'string',
        'width' => 60,
        'align' =>'center',
    ),
    'foto_iklan' => array(
        'label' => 'Foto Iklan',
        'rule' => 'trim|xss_clean',
        'formatter' => 'url2images',
        'save_formatter' => 'string',
        'width' => 60,
        'align' =>'center',
    ),
  );

    protected $_order = array("id" => "DESC");
    protected $_unique = array('unique' => array('id'), 'group' => false);

    function url2images($url) {
        if(!is_null($url) && !empty($url)) {
          return "<img width=100% height=100% src='" . base_url() . "assets/img/iklan/" . $url . "' class='img-thumbnail' />";
        }else {
            return "";
        }
    }

    function tampil_slideshow() {
        $iklan = 't_iklan';
        $this->db->select("*");
        $this->db->from("$iklan");
        $this->db->order_by('id','ASC');
        $query = $this->db->get();
        return $query->result();
    }



}

?>
