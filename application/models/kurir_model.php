<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Kurir_model extends MY_Model
{

  function get_seller($id){
      $this->db->where('id',$id);
      return $this->db->get(kode_tbl().'members')->row();
  }

}
