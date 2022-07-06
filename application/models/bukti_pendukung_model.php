<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Bukti_pendukung_model extends MY_Model {

    public function __construct() {
        
    }

    public function bukti_pendukung($id) {
        $this->db->select('b.nama_dokumen');
        $this->db->from('t_asesi_portofolio a');
        $this->db->join('t_repositori b','a.id_repositori=b.id');
        $this->db->where('a.id_asesi',$id);
        $portofolio = $this->db->get()->result();

        return $portofolio;
    }

    public function bukti_pendukung_asesi($data = array()) {
        $this->db->where('id_asesi', $data['id_asesi']);
        $this->db->where('jenis_portofolio', $data['jenis_portofolio']);
        $query = $this->db->get('t_repositori');
        return $query->result_array();
    }

    function row_bukti_pendukung($id) {
        $this->db->select('id,nama_dokumen');
        $this->db->where('id_asesi', $id);
        $query = $this->db->get('t_repositori')->result();
        $array_skema = array();
        $i = 0;
        foreach ($query as $key => $value) {
            //array_push(array, var)
            $array_skema[$value->id] = $value->nama_dokumen;
            //$array_skema[$i]['skema'] = $value->skema;
        }
        return $array_skema;
    }

    function syarat_pendaftaran($id) {

        $this->db->where('id_skema', $id);
        return $this->db->get(kode_tbl() . 'skema_syarat')->result();
    }

    function nama_skema($id) {
        $this->db->select('skema_sertifikasi');
        $this->db->where('id', $id);
        $this->db->from(kode_tbl() . 'asesi');
        return $this->db->get()->row();
    }

}
