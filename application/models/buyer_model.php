<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Buyer_model extends MY_Model {

  function __construct() {
      parent::__construct();
      $this->_table = kode_tbl()."buyer";
  }

  protected $_table;
  protected $table_label = 'Data Buyer';
  protected $_columns = array(
      'nm_buyer' => array(
          'label' => 'Buyer',
          'rule' => 'trim|xss_clean',
          'formatter' => 'string',
          'save_formatter' => 'string',
          'width' => 150
      ),
      'hp_buyer' => array(
          'label' => 'HP',
          'rule' => 'trim|xss_clean',
          'formatter' => 'string',
          'save_formatter' => 'string',
          'width' => 150
      ),
      'email_buyer' => array(
          'label' => 'Email',
          'rule' => 'trim|required|xss_clean',
          'formatter' => 'string',
          'save_formatter' => 'string',
          'width' => 150
      ),
  );
  protected $_order = array("id" => "DESC");

  protected $_unique = array('unique' => array('id'), 'group' => false);

  function buyer($id_buyer){
    // echo $id_buyer;

    $this->db->select('
      a.*,
      b.akun
    ');
    $this->db->from(kode_tbl().'buyer'.' a');
    $this->db->join('t_users b','b.id_member=a.id');

    $this->db->where('a.id', $id_buyer);

    $query = $this->db->get();
    return $query->row();

  }

  function buyer_alamat($id_buyer){
    $this->db->select('
      a.*,
      b.province_name,
      c.city_name,
    ');
    $this->db->from(kode_tbl().'buyer_alamat'.' a');
    $this->db->join('m_ro_provinsi b','b.province_id=a.id_provinsi');
    $this->db->join('m_ro_kota c','c.city_id=a.id_kabupaten');

    $this->db->where('a.id_buyer', $id_buyer);
    $this->db->order_by('a.jenis_alamat','DESC');

    $query = $this->db->get();
    return $query->result();
  }

  function trans_buyer($id_buyer, $status_transaksi){

    // var_dump($id_member); die();

    $this->db->select('
      a.*,
      b.nama_product,
      b.kondisi_product,
      b.ket_product,
      b.min_pesan_product,
      b.jumlah_product as total_product,
      b.jumlah_terjual as total_terjual,
      b.tag_product,
      b.harga_product,
      b.disc_product,
      b.link_product,
      b.berat_product,
      c.nama_file,
      d.nmrek_tujuan,
      d.norek_tujuan,
      d.total_transaksi
    ');
    $this->db->from(kode_tbl().'product_keranjang'.' a');
    $this->db->join(kode_tbl().'product b','a.id_product=b.id');
    $this->db->join('t_repositori c','c.id_product=b.id');
    $this->db->join(kode_tbl().'transaksi_buyer d','d.id=a.id_transaksi');

    $this->db->where('a.id_buyer', $id_buyer);
    $this->db->where('c.nama_dokumen', 'produk_1');
    $this->db->where('a.stts_keranjang', $status_transaksi);

    // $this->db->group_by('c.id_product');
    $this->db->group_by('a.id_transaksi');
    $this->db->group_by('a.id_member');

    $query = $this->db->get();
    return $query->result();

  }





  function perkeranjang_buyer($id_buyer,$arridtoko){

    // var_dump($arridtoko); die();

    $this->db->select('
      a.*,
      b.nama_product,
      b.kondisi_product,
      b.ket_product,
      b.min_pesan_product,
      b.jumlah_product as total_product,
      b.jumlah_terjual as total_terjual,
      b.tag_product,
      b.harga_product,
      b.disc_product,
      b.link_product,
      b.berat_product,
      c.nama_file
    ');
    $this->db->from(kode_tbl().'product_keranjang'.' a');
    $this->db->join(kode_tbl().'product b','a.id_product=b.id');
    $this->db->join('t_repositori c','c.id_product=b.id');

    $this->db->where_in('a.id_member', $arridtoko);
    $this->db->where('a.id_buyer', $id_buyer);
    $this->db->where('c.nama_dokumen', 'produk_1');
    $this->db->where('a.stts_keranjang', '0');

    $this->db->group_by('c.id_product');
    $query = $this->db->get();
    return $query->result();
  }

  function datatoko($arridtoko){
    // var_dump($id_buyer); die();

    // $this->db->from(kode_tbl().'buyer_alamat'.' a');
    // // $this->db->join(kode_tbl().'product b','a.id_product=b.id');
    // $this->db->where('a.id_buyer', $id_buyer);
    // $this->db->where('a.stts_alamat', '1');
    // $query = $this->db->get();
    // return $query->row();

    $this->db->from(kode_tbl().'members'.' a');
    $this->db->join('m_ro_provinsi b','a.id_province_member=b.province_id');
    $this->db->join('m_ro_kota c','a.id_kabupaten_member=c.city_id');

    $this->db->where_in('a.id', $arridtoko);
    $query = $this->db->get()->result();

    return $query;

  }

  function detail_buyer(){

  }

}
