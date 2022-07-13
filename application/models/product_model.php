<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Product_model extends MY_Model
{

  function get_product($id){
      $this->db->where('id_member',$id);
      $this->db->order_by('id','DESC');
      // $this->db->limit(1);
      return $this->db->get(kode_tbl().'product')->result();
  }

  function detail_product($id){

    $this->db->select(
      '
        a.*,
        b.kategori,
        c.sub_kategori,
        d.member
      ');
      $this->db->from(kode_tbl().'product'.' a');
      $this->db->join(kode_tbl().'kategori b','b.id=a.id_kategori','left');
      $this->db->join(kode_tbl().'sub_kategori c','c.id=a.id_sub_kategori','left');
      $this->db->join(kode_tbl().'members d','a.id_member=d.id');

      $this->db->where('a.id',$id);
      // $this->db->order_by('id','DESC');
      // $this->db->limit(1);
      return $this->db->get(kode_tbl().'product')->row();
  }

  function file_product_detail($id){

    // var_dump($id); die();

    $this->db->from('t_repositori'.' a');
    $this->db->where('a.id_product',$id);
    $query = $this->db->get()->result();

    return $query;
    // var_dump($query); die();

  }

  function show_filter_product($k,$id_k,$k1,$id_k1,$k2,$id_k2){

    // var_dump($k); die();

    if (empty($k)) {
      $f="...";
    }
    else {
      $f=$k;
    }

    if (empty($k1)) {
      $f1="...";
    }
    else {
      $f1=$k1;
    }
    // echo "
    //   cari berdasarkan kategori <br>
    //     <b style='padding-left:15px;color:red;'>$f</b> dan sub kategori <br>
    //     <b style='padding-left:15px;color:red;'>$f1</b>";

    $menu_k   = $k;
    $menu_id  = $id_k;
    $kat_k    = $k1;
    $kat_id   = $id_k1;
    $sub_k    = $k2;
    $sub_id   = $id_k2;


    if (!empty($menu_id) AND !empty($kat_k) AND !empty($sub_id)) {
      $ac = "id_sub_kategori";
      $where1 = $this->db->where('a.id_sub_kategori', $id_k2);
    }elseif (!empty($menu_id) AND !empty($kat_k)) {
      $ac = "id_kategori";
      $where1 = $this->db->where('a.id_kategori', $id_k1);
    }elseif (!empty($menu_id)) {
      $ac = "id_menu_kategori";
      $where1 = $this->db->where('a.id_menu_kategori', $id_k);
    }

    // var_dump($wheres); die();

    $this->db->select(
    '
      a.*,
      b.id AS id_repo,
      b.nama_file,
      c.member
    ');
    $this->db->from(kode_tbl().'product'.' a');

    $this->db->join('t_repositori b','a.id=b.id_product');
    $this->db->join(kode_tbl().'members c','a.id_member=c.id');
    // $this->db->join(kode_tbl().'product_favorite c','a.id=c.id_product','left');
    // $this->db->join(kode_tbl().'skema b', 'a.skema_sertifikasi = b.id', 'left');

    // $this->db->where('c.id_member !=', $id_member);
    $where1;
    $this->db->where('b.nama_dokumen', 'produk_1');
    $this->db->where('c.status_delete <', '2');
    $this->db->order_by('a.id', 'DESC');
    $this->db->group_by('a.id');

    // $this->db->limit($perpage);
    // $this->db->offset($offset);

    $query = $this->db->get();
    return $query->result();

  }


  public function get_all_product($perpage, $offset,$search="") {

    // var_dump($search); die();

     if($search ==""){
         $this->db->order_by('id', 'ASC');
         $this->db->limit($perpage);
         $this->db->offset($offset);
         // $this->db->where('id_group_users',6);
         $query = $this->db->get(kode_tbl().'product a');
     }else{
         // $this->db->where('id_group_users',6);
         $this->db->select(
         '
           a.*,
           b.id AS id_repo,
           b.nama_file,
           c.member
         ');
         $this->db->like('a.nama_product', $search);
         $this->db->order_by('a.id', 'ASC');
         $this->db->limit($perpage);
         $this->db->offset($offset);
         $this->db->join('t_repositori b','a.id=b.id_product');
         $this->db->join(kode_tbl().'members c','a.id_member=c.id');
         $query = $this->db->get(kode_tbl().'product a');
     }
     return $query->result();
 }

}
