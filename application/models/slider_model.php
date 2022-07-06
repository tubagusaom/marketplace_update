<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Slider_model extends MY_Model {

  public function __construct() {
      $this->_table = kode_tbl()."slider";
      parent::__construct($this->_table);
  }

  protected $_table;
  protected $table_label = 'Data Slide';
  protected $_columns = array(
    'nama_slide1' => array(
        'label' => 'Nama Slide',
        'rule' => 'trim|xss_clean',
        'formatter' => 'string',
        'save_formatter' => 'string',
        'width' => 150
    ),
    // 'nama_slide2' => array(
    //     'label' => 'Text Bawah',
    //     'rule' => 'trim|xss_clean',
    //     'formatter' => 'string',
    //     'save_formatter' => 'string',
    //     'width' => 250
    // ),
    'urutan_slide' => array(
        'label' => 'Urutan',
        'rule' => 'trim|xss_clean',
        'formatter' => 'string',
        'save_formatter' => 'string',
        'width' => 20,
        'align' =>'center',
    ),
    'foto_slide' => array(
        'label' => 'Slide Images',
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
          return "<img width=100% height=100% src='" . base_url() . "assets/img/slides/" . $url . "' class='img-thumbnail' />";
        }else {
            return "";
        }
    }

    function tampil_slideshow() {
        $sliders = 't_slider';
        $this->db->select("*");
        $this->db->from("$sliders");
        $this->db->order_by('id','ASC');
        $query = $this->db->get();
        return $query->result();
    }



}

?>
