<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Jadwal_model extends MY_Model {
    public function __construct() {
        
    }
    public function list_jadwal(){
        $this->db->select('a.*,b.tuk');
        $this->db->from(kode_tbl().'jadual_asesmen a');
        $this->db->join(kode_tbl().'tuk b','a.id_tuk=b.id');
        $query = $this->db->get();
        return $query->result();
    }
    function row_jadwal($id){
        $this->db->where('id',$id);
        $query = $this->db->get(kode_tbl().'jadual_asesmen')->row();
        if(count($query) > 0){
            return $query;
        }else{
            return false;
        }
    }
    function row_skema(){
        $this->db->select('id,skema');
        $query = $this->db->get(kode_tbl().'skema')->result();
        $array_skema=array();
        $i=0;
        foreach ($query as $key => $value) {
            //array_push(array, var)
            $array_skema[$value->id] = $value->skema;
            //$array_skema[$i]['skema'] = $value->skema;
        }
        return $array_skema;
    }
    function row_jadwal_combo(){
        $this->db->select('id,jadual');
        $query = $this->db->get(kode_tbl().'jadual_asesmen')->result();
        $array_skema=array();
        $i=0;
        foreach ($query as $key => $value) {
            //array_push(array, var)
            $array_skema[$value->id] = $value->jadual;
            //$array_skema[$i]['skema'] = $value->skema;
        }
        return $array_skema;
    }
}
