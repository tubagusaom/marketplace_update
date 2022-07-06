<?php

class Pembayaran_Model extends MY_Model {
    public function riwayat_sertifikasi($id){
        $this->db->select('a.*,b.skema,c.jadual');
        $this->db->from(kode_tbl().'asesi a');
        $this->db->join(kode_tbl().'skema b','a.skema_sertifikasi=b.id');
        $this->db->join(kode_tbl().'jadual_asesmen c','a.jadwal_id=c.id');
        $this->db->where('id_users',$id);
        $query = $this->db->get();
        return $query->result();
    }
    function riwayat_sertifikasi_detail($id){
        $this->db->select('a.*,b.skema,b.biaya_skema,c.jadual');
        $this->db->from(kode_tbl().'asesi a');
        $this->db->join(kode_tbl().'skema b','a.skema_sertifikasi=b.id');
        $this->db->join(kode_tbl().'jadual_asesmen c','a.jadwal_id=c.id');
        $this->db->where('a.id',$id);
        $query = $this->db->get();
        return $query->row();
    }

}

