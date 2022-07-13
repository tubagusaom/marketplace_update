<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
Class Welcome_model extends MY_Model {

    function __construct() {
        parent::__construct();
    }

    // public function data_skema($idlsp) {
    //     $this->db->select('*', false);
    //     $this->db->from($idlsp . 'skema');
    //     $query = $this->db->get();
    //     return $query->result();
    // }
    // public function data_tuk($idlsp) {
    //     $this->db->select('*', false);
    //     $this->db->from($idlsp . 'tuk');
    //     $query = $this->db->get();
    //     return $query->result();
    // }
    //
    // public function search_skema($idlsp, $keyword) {
	  //    $this->db->like('skema', $keyword);
    //    $this->db->order_by('skema', 'asc');
    //    return $this->db->get($idlsp.'skema')->result();
    // }


    // public function data_jadwal($idlsp) {
    //     $this->db->select('*', false);
    //     $this->db->from($idlsp . 'jadual_asesmen');
    //     //$this->db->where('tanggal >=', date('Y-m-d'));
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    function provinsi(){
        $this->db->from('m_ro_provinsi');
        $query = $this->db->get();
        return $query->result();
    }

    function dataPengunjung(){
        $query = $this->db->query("SELECT * FROM t_counter WHERE tanggal=CURDATE() GROUP BY ip");
        return $query->num_rows();
    }
    function totalPengunjung(){
        //$query = $this->db->query("SELECT COUNT(hits) FROM t_counter");
        return $this->db->count_all('t_counter');
    }

    function slide_total(){
      $this->db->from(kode_tbl().'slider');
      $query = $this->db->get();
      return $query->num_rows();
    }

    function slide_show(){
      $this->db->from(kode_tbl().'slider');
      $this->db->order_by('urutan_slide', 'ASC');
      $query = $this->db->get();
      return $query->result();
    }

    function show_iklan(){
      $this->db->from(kode_tbl().'iklan');
      $this->db->where("status_iklan",'1');
      $this->db->order_by('urutan_iklan', 'ASC');
      $query = $this->db->get();
      return $query->result();
    }

    function menu(){
      $this->db->from(kode_tbl().'menu_kategori');
      $this->db->limit('8');
      $this->db->order_by('menu_kategori', 'ASC');
      $query = $this->db->get();
      return $query->result();
    }

    function kategori(){
      $this->db->from(kode_tbl().'kategori');
      $this->db->order_by('kategori', 'ASC');
      $query = $this->db->get();
      return $query->result();
    }

    function sub_kategori(){
      $this->db->from(kode_tbl().'sub_kategori');
      $this->db->order_by('sub_kategori', 'ASC');
      $query = $this->db->get();
      return $query->result();
    }

    function show_product_terbaru(){

      // var_dump($id_member); die();

      $this->db->select('a.*,b.id AS id_repo,b.nama_file,c.member');
      $this->db->from(kode_tbl().'product a');
      $this->db->join('t_repositori b','a.id=b.id_product','left');
      $this->db->join(kode_tbl().'members c','a.id_member=c.id');
      // $this->db->join(kode_tbl().'skema b', 'a.skema_sertifikasi = b.id', 'left');

      // $this->db->where('c.id_member !=', $id_member);
      $this->db->where('b.nama_dokumen', 'produk_1');
      $this->db->where('c.status_delete <', '2');
      $this->db->order_by('a.id', 'DESC');
      // $this->db->order_by('', RAND());
      $this->db->limit('50');
      $this->db->group_by('a.id');

      $query = $this->db->get()->result();

      // random query
      shuffle($query);

      return $query;
    }

    function file_product_terbaru($idproduct){
      // var_dump($idproduct); die();
      // echo ($idproduct);

      $this->db->select('a.*');
      $this->db->from(kode_tbl().'product a');
      $query = $this->db->get();
      return $query->result();
    }

    function product_favorite($id_buyer){
      $this->db->from(kode_tbl().'product_favorite'.' a');
      // $this->db->join(kode_tbl().'product b','a.id_product=b.id');
      $this->db->where('a.id_buyer', $id_buyer);
      $query = $this->db->get();
      return $query->result();
    }

    function keranjang_buyer($id_buyer){

      // var_dump($id_toko); die();

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
      // $this->db->where_in('a.id_member', $id_toko);
      $this->db->where('a.id_buyer', $id_buyer);
      $this->db->where('c.nama_dokumen', 'produk_1');
      $this->db->where('a.stts_keranjang', '0');

      $this->db->group_by('c.id_product');
      $query = $this->db->get();
      return $query->result();
    }

    function keranjang_get_member($id_buyer){

      // var_dump($id_buyer); die();

      $this->db->select('a.*, b.id as idm, b.member as nm_toko, c.province_name as provinsi, d.city_name as kota');
      $this->db->from(kode_tbl().'product_keranjang'.' a');
      $this->db->join(kode_tbl().'members b','a.id_member=b.id');
      $this->db->join('m_ro_provinsi c','c.province_id=b.id_province_member');
      $this->db->join('m_ro_kota d','d.city_id=b.id_kabupaten_member');
      $this->db->where('a.id_buyer', $id_buyer);
      $this->db->where('a.stts_keranjang', '0');
      $this->db->group_by('b.id');
      $query = $this->db->get();
      return $query->result();

    }

    function buyer_alamat_utama($id_buyer){
      // var_dump($id_buyer); die();

      $this->db->from(kode_tbl().'buyer_alamat'.' a');
      // $this->db->join(kode_tbl().'product b','a.id_product=b.id');
      $this->db->join('m_ro_provinsi b','a.id_provinsi=b.province_id');
      $this->db->join('m_ro_kota c','a.id_kabupaten=c.city_id');


      $this->db->where('a.id_buyer', $id_buyer);
      $this->db->where('a.jenis_alamat', '1');
      $query = $this->db->get();
      return $query->row();

    }

}
