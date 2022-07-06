<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    Class My_shop_model extends MY_Model {

      function keranjang_order($id){

        // var_dump($id); die();

        $keranjang = kode_tbl().'product_keranjang';
        $transaksi = kode_tbl().'transaksi_buyer';
        $member    = kode_tbl().'members';
        $buyer     = kode_tbl().'buyer';
        $buyeralmt = kode_tbl().'buyer_alamat';
        $product   = kode_tbl().'product';
        $kurir     = kode_tbl().'kurir_pengiriman_buyer';

        //
        $this->db->select("
          a.*,
          b.*,
          c.nama_product,
          c.harga_product,
          d.*,
          e.*,
          f.*
        ");

        $this->db->from("$keranjang a");
        $this->db->join("$member b","a.id_member = b.id");
        $this->db->join("$product c","a.id_product = c.id");
        $this->db->join("$buyer d","a.id_buyer = d.id");
        $this->db->join("$buyeralmt e","e.id_buyer = d.id");
        $this->db->join("$kurir f","a.id = f.id_keranjang");

        $this->db->where('a.id_member', $id);
        $this->db->where("a.stts_keranjang", '1');

        // $this->db->where('a.id !=', $id);
        // $this->db->limit(5);
        // $this->db->order_by('a.id','RANDOM');
        $query = $this->db->get()->result();

        // var_dump($query); die();

        return $query;

      }


//     function galeri()
//     {
//         $this->db->select('a.foto');
//         $this->db->from('$artikel a');
//         $this->db->where('a.id_kategori',4);
//         $query = $this->db->get();
//         return $query->result();
//     }
//
//     function artikel()
//     {
//         $artikel = kode_tbl().'artikel';
//         $artikel_kategori = kode_tbl().'artikel_kategori';
//
//         $this->db->select('$artikel.id, $artikel.judul, $artikel.headline, $artikel.isi, $artikel_kategori.kategori');
//         $this->db->from('$artikel');
//         $this->db->join('$artikel_kategori','$artikel.id_kategori = $artikel_kategori.id');
//         $this->db->where('$artikel.id_kategori', 1);
//         $query = $this->db->get();
//         return $query->result();
//     }
//     function berita_lainnya()
//     {
//         $artikel = kode_tbl().'artikel';
//         $artikel_kategori = kode_tbl().'artikel_kategori';
//
//         $this->db->select("a.id, a.judul, a.headline, a.isi, b.kategori,a.tanggal_buat");
//         $this->db->from("$artikel a");
//         $this->db->join("$artikel_kategori b","a.id_kategori = b.id");
//         //$this->db->where("$artikel.id_kategori", 1);
//         $this->db->limit(5);
//         $this->db->order_by('a.id','RANDOM');
//         $query = $this->db->get();
//         return $query->result();
//     }
//
//     function berita_lsp_lainnya($id){
//       $artikel = kode_tbl().'artikel';
//       $artikel_kategori = kode_tbl().'artikel_kategori';
//
//       $this->db->select("a.*, b.kategori");
//       $this->db->from("$artikel a");
//       $this->db->join("$artikel_kategori b","a.id_kategori = b.id");
//       $this->db->where("a.id_kategori", 4);
//       $this->db->where('a.id !=', $id);
//       $this->db->limit(5);
//       $this->db->order_by('a.id','RANDOM');
//       $query = $this->db->get();
//       return $query->result();
//     }
//
//     function detail($id)
//     {
//         $artikel = kode_tbl().'artikel';
//         $this->db->select('*');
//         $this->db->from("$artikel a");
//         $this->db->where("id", $id);
//         $query = $this->db->get();
//         return $query->row();
//     }
//     function get_link($id){
//         $this->db->where('category_id',$id);
//         return $this->db->get('t_links')->result();
//
//     }
//     function get_detail($id)
//     {
//         $artikel = kode_tbl().'artikel';
//         $this->db->select('*');
//         $this->db->from("$artikel a");
//         $this->db->where("id", $id);
//         $query = $this->db->get();
//         return $query->row();
//     }
//     function get_gallery()
//     {
//         $galeri = 't_galeri';
//         $this->db->select('*');
//         $this->db->from("$galeri a");
//         $this->db->where("id_kategori", 15);
//         $query = $this->db->get();
//         return $query->result();
//     }
//
//     function get_mitra()
//     {
//         $this->db->select('a.id, a.judul, a.headline, a.isi, b.kategori, a.foto');
//         $this->db->from('$artikel a');
//         $this->db->join('$artikel_kategori b', 'a.id_kategori = b.id');
//         $this->db->where('a.id_kategori', 10);
//         $query = $this->db->get();
//         return $query->result();
//     }
//     function get_slideshow()
//     {
//         $artikel = kode_tbl().'artikel';
//         $artikel_kategori = kode_tbl().'artikel_kategori';
//
//         $this->db->select("a.*");
//         $this->db->from("$artikel a");
//         $this->db->join("$artikel_kategori b","a.id_kategori = b.id");
//         $this->db->where("a.id_kategori", 4);
// $this->db->order_by('id','DESC');
//         $query = $this->db->get();
//         return $query->result();
//     }
//     function berita_lsp(){
//         // $artikel = kode_tbl().'artikel';
//         // $artikel_kategori = kode_tbl().'artikel_kategori';
//         // $this->db->select('a.id, a.judul, a.headline, a.isi, b.kategori, a.foto', 'a.created_when','a.tanggal_buat');
//         // $this->db->from("$artikel a");
//         // $this->db->join("$artikel_kategori b", "a.id_kategori = b.id");
//         // $this->db->where("a.id_kategori", 4);
//         // $this->db->limit(5);
//         // $this->db->order_by('a.created_when');
//         // $query = $this->db->get();
//         // return $query->row();
//
//         $artikel = kode_tbl().'artikel';
//         $artikel_kategori = kode_tbl().'artikel_kategori';
//
//         $this->db->select("a.*, b.kategori");
//         $this->db->from("$artikel a");
//         $this->db->join("$artikel_kategori b","a.id_kategori = b.id");
//         $this->db->where("a.id_kategori", 4);
//         $this->db->limit(5);
//         $this->db->order_by('a.id','RANDOM');
//         $query = $this->db->get();
//         return $query->result();
//     }
//     function berita_lsp2(){
//         $artikel = kode_tbl().'artikel';
//         $artikel_kategori = kode_tbl().'artikel_kategori';
//         $this->db->select('a.id, a.judul, a.headline, a.isi, b.kategori, a.foto');
//         $this->db->from("$artikel a");
//         $this->db->join("$artikel_kategori b", "a.id_kategori = b.id");
//         $this->db->where("a.id_kategori", 1);
//         $this->db->limit(1,1);
//         $this->db->order_by('id','DESC');
//         $query = $this->db->get();
//         return $query->row();
//     }
//
// 	function berita_lsp_list(){
//         $artikel = kode_tbl().'artikel';
//         $artikel_kategori = kode_tbl().'artikel_kategori';
//         $this->db->select('a.*, b.kategori');
//         $this->db->from("$artikel a");
//         $this->db->join("$artikel_kategori b", "a.id_kategori = b.id");
//         $this->db->where("a.id_kategori", 4);
//         $this->db->limit(10);
//         $this->db->order_by('id','DESC');
//         $query = $this->db->get();
//         return $query->result();
//     }
//
//     function berita_bnsp(){
//         $artikel = kode_tbl().'artikel';
//         $artikel_kategori = kode_tbl().'artikel_kategori';
//         $this->db->select('a.id, a.judul, a.headline, a.isi, b.kategori, a.foto');
//         $this->db->from("$artikel a");
//         $this->db->join("$artikel_kategori b", "a.id_kategori = b.id");
//         $this->db->where("a.id_kategori", 11);
//         $this->db->limit(1);
//         $this->db->order_by('id','DESC');
//         $query = $this->db->get();
//         return $query->row();
//     }
//     function berita_kompetensi(){
//         $artikel = kode_tbl().'artikel';
//         $artikel_kategori = kode_tbl().'artikel_kategori';
//         $this->db->select('a.id, a.judul, a.headline, a.isi, b.kategori, a.foto');
//         $this->db->from("$artikel a");
//         $this->db->join("$artikel_kategori b", "a.id_kategori = b.id");
//         $this->db->where("a.id_kategori", 12);
//         $this->db->limit(1);
//         $this->db->order_by('id','DESC');
//         $query = $this->db->get();
//         return $query->row();
//     }
//     function category($id){
//         $artikel = kode_tbl().'artikel';
//         $artikel_kategori = kode_tbl().'artikel_kategori';
//         $this->db->select('a.*, b.kategori, c.nama_user');
//         $this->db->from("$artikel a");
//         $this->db->join("$artikel_kategori b", "a.id_kategori = b.id");
//         $this->db->join("t_users c", "c.id = a.created_by","LEFT");
//         $this->db->where("a.id_kategori", $id);
//         $this->db->order_by('id','DESC');
//         $query = $this->db->get();
//         return $query->result();
//     }
//
// 	function marquee(){
//         $artikel = kode_tbl().'artikel';
//         $artikel_kategori = kode_tbl().'artikel_kategori';
//         $this->db->select('a.id, a.judul, a.headline, a.isi, b.kategori, a.foto');
//         $this->db->from("$artikel a");
//         $this->db->join("$artikel_kategori b", "a.id_kategori = b.id");
//         $this->db->where("a.id_kategori", 15);
//         $this->db->limit(3);
//         $this->db->order_by('id','DESC');
//         $query = $this->db->get();
//         return $query->result();
//     }
//     function media_lsp(){
//         $artikel = kode_tbl().'artikel';
//         $artikel_kategori = kode_tbl().'artikel_kategori';
//         $this->db->select('a.id, a.judul, a.headline, a.isi, b.kategori, a.foto');
//         $this->db->from("$artikel a");
//         $this->db->join("$artikel_kategori b", "a.id_kategori = b.id");
//         $this->db->where("a.id_kategori", 14);
//         $this->db->order_by('id','DESC');
//         $query = $this->db->get();
//         return $query->result();
//     }
//     function detail_asesor($id){
//         $asesi = kode_tbl().'users';
//         $this->db->where("id", $id);
//         $query = $this->db->get($asesi);
//         return $query->row();
//     }
//     function kompetensi_teknis($id){
//         $skema = kode_tbl().'skema';
//         $this->db->select('a.*, b.skema');
//         $this->db->from("t_bidang a");
//         $this->db->join("$skema b", "a.id_skema = b.id");
//         $this->db->where("a.id_asesor", $id);
//         $this->db->order_by('a.id','ASC');
//         $query = $this->db->get();
//         return $query->result();
//     }
//     function menguji($id){
//         $skema = kode_tbl().'skema';
//         $asesi = kode_tbl().'asesi';
//         $this->db->select('a.u_date_create,a.nama_lengkap, b.skema');
//         $this->db->from("$asesi a");
//         $this->db->join("$skema b", "a.skema_sertifikasi = b.id");
//         $this->db->where("a.id_asesor", $id);
//         $this->db->order_by('a.u_date_create','DESC');
//         $query = $this->db->get();
//         return $query->result();
//     }
//     function berita_lsp_pilihan(){
//         $artikel = kode_tbl().'artikel';
//         $artikel_kategori = kode_tbl().'artikel_kategori';
//         $this->db->select('a.id, a.judul, a.headline, a.isi, b.kategori, a.foto,a.content_img_thumb');
//         $this->db->from("$artikel a");
//         $this->db->join("$artikel_kategori b", "a.id_kategori = b.id");
//         $this->db->where("a.id_kategori", 4);
//         $this->db->limit(9);
//         $this->db->order_by('id','DESC');
//         $query = $this->db->get();
//         return $query->result();
//     }
//
//     function logo_lsp(){
//         $artikel = kode_tbl().'artikel';
//         $artikel_kategori = kode_tbl().'artikel_kategori';
//         $this->db->select('a.id,a.foto');
//         $this->db->from("$artikel a");
//         $this->db->join("$artikel_kategori b", "a.id_kategori = b.id");
//         $this->db->where("a.id_kategori", 10);
//         $this->db->limit(1);
//         $query = $this->db->get();
//         return $query->result();
//     }

  }
