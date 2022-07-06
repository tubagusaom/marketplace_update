<?php

class Sertifikasi_Model extends MY_Model {
    public function data_skema($idlsp) {
        $this->db->select('*', false);
        $this->db->from($idlsp . 'skema');
        $query = $this->db->get();
        return $query->result();
    }
    public function data_tuk($idlsp) {
        $this->db->select('*', false);
        $this->db->from($idlsp . 'tuk');
        $query = $this->db->get();
        return $query->result();
    }

    public function summary_lsp($idlsp) {
        $this->load->database("lspbnsp", true);

        $query = $this->db->query("SELECT  (
            SELECT COUNT(*)
            FROM " . $idlsp . "unit_kompetensi WHERE id_lsp='100'
            ) AS total_unit_kompetensi,
            (
            SELECT COUNT(*)
            FROM " . $idlsp . "skema WHERE id_lsp='100'
            ) AS total_skema_kompetensi,
            (
            SELECT COUNT(*)
            FROM " . $idlsp . "tuk WHERE id_lsp='100'
            ) AS total_tuk,
            (
            SELECT COUNT(*)
            FROM " . $idlsp . "asesor WHERE id_lsp_asesor='100'
            ) AS total_asesor,
            (
            SELECT COUNT(*)
            FROM " . $idlsp . "users WHERE id_lsp='100'
            ) AS total_ps,
    				(
    				SELECT COUNT(*) FROM " . $idlsp . "users LEFT JOIN
    				" . $idlsp . "sertifikat ON " . $idlsp . "sertifikat.id_users=" . $idlsp . "users.id
    				WHERE " . $idlsp . "users.id_lsp='100'
    				) AS total_sertifikat
            FROM    dual
            ");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        } else {
            return false;
        }
    }

    public function api_get_skema_lsp() {
        $this->load->database('lspta_db', true);

        //$id = $this->input->get('idlsp');

//        $this->db->select('id,kode_skema,skema,tanggal_ketetapan,jumlah_unit,id as idskema', false);
//        $this->db->from($idlsp . 'skema');
//        //$this->db->where('id_lsp', $idlsp);
//        $this->db->where('status_aktif', 1);

        $query = $this->db->get('com_lsp_asesi');
        return $query->result();
    }

    public function api_get_skema_detail($idlsp, $idskema) {
        $this->load->database('lspta_db', true);

        $this->db->where('id_skema', $idskema);
        $this->db->from($idlsp . 'skema_detail');
        $query = $this->db->get();
        return $query->result();
    }

    function get_data_detail_asesi($id) {
        $this->load->database('default', true);

        $this->db->where("com_lsp_asesi_id", $id);
        $query = $this->db->get("com_lsp_asesi_asesmen_mandiri");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        } else {
            return 0;
        }
    }

    function get_data_asesi($id) {
        $this->db->where("u_status", "A");
        $this->db->where("id", $id);
        $query = $this->db->get("com_lsp_asesi");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        } else {
            return 0;
        }
    }

    function get_data_asesi_mandiri($id) {
        $this->db->where('com_lsp_asesi_id', $id);
        $query = $this->db->get('com_lsp_asesi_asesmen_mandiri');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        } else {
            return false;
        }
    }

    function get_data_skema() {
        $hasil = $this->db->get("lsp029_skema");
        if ($hasil->num_rows() > 0){
            return $hasil->result();
        } else {
            return array();
        }
    }

    function get_detail_skema($id){
        $this->db->select('c.id as skema_id,a.id, c.skema, c.kode_skema, c.link_download, c.description, b.unit_kompetensi, b.id_unit_kompetensi');
        $this->db->from(kode_tbl().'skema_detail a');
        $this->db->join(kode_tbl().'unit_kompetensi b','b.id = a.id_unit_kompetensi');
        $this->db->join(kode_tbl().'skema c','c.id = a.id_skema');
        $this->db->where('a.id_skema',$id);
        $query = $this->db->get()->result();
        return $query;
    }

    function get_data_tuk() {
        $this->db->where("status_aktif", 1);
        $query = $this->db->get("lsp029_tuk");
        return $query->result();
    }

    function get_detail_data_tuk($id){

        $this->db->where("id", $id);
        $tuk = kode_tbl().'tuk';
        $query = $this->db->get($tuk);
        return $query->row();
    }

    function view_asesor_mandiri_detail($idasesi) {
        $this->db->where('com_lsp_asesi_id', $idasesi);
        $query = $this->db->get('com_lsp_asesor_asesmen_mandiri');
        return $query->result();
    }

    function get_provinsi() {
        $this->load->database("lspbnsp", true);
        $this->db->where("status_aktif", 1);
        $query = $this->db->get("lsp101_master_provinsi");
        return $query->result();
    }

    function get_kabupaten($idprovinsi) {
        $this->load->database("lspbnsp", true);
        $this->db->where("provinsi_id", $idprovinsi);
        $query = $this->db->get("master_kabupaten");
        return $query->result();
    }

    function getprovinsi($provinsi_id) {
        $this->load->database("lspbnsp", true);
        $this->db->where("id", $provinsi_id);
        $query = $this->db->get("master_provinsi");
        return $query->result();
    }

    function getkabupaten($idkab) {
        $this->load->database("lspbnsp", true);
        $this->db->where("id", $idkab);
        $query = $this->db->get("master_kabupaten");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        } else {
            return false;
        }
    }

    function get_unit_kompetensi($idlsp) {
        $this->load->database("lspbnsp", true);
        $this->db->where("status", 1);
        $query = $this->db->get($idlsp . "unit_kompetensi");
        return $query->result();
    }

    function get_unitkompetensi($idlsp, $kdunit) {
        $this->load->database("lspbnsp", true);

        $this->db->where("status", 1);
        $this->db->where("id_unit_kompetensi", $kdunit);
        $query = $this->db->get($idlsp . "unit_kompetensi");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        } else {
            return false;
        }
    }

    function get_unitkompetensi_many($idlsp, $kdunit) {
        $this->load->database("lspbnsp", true);

        $this->db->where("status", 1);
        $this->db->where_in("id", $kdunit);
        $query = $this->db->get($idlsp . "unit_kompetensi");
        return $query->result();
    }

    function get_jenis_tuk() {
        $this->load->database("lspbnsp", true);
        $query = $this->db->get("tuk_jenis");
        return $query->result();
    }

    function simpan_pendaftaran_tuk($data) {
        foreach ($data as $dthasil) {
            if (substr($dthasil['name'], 0, 3) != 'txt') {
                $hasil[$dthasil['name']] = $dthasil['value'];
            }
        }

        $hasil['u_status'] = "A";

        // Saving user account transaction
        $hasil['u_create'] = 0;

        // Saving transaction date
        $hasil['u_date_create'] = date('Y-m-d H:m:s');

        // Execute to tables
        $result = $this->db->insert("com_lsp_tuk", $hasil);

        // Check transaction result
        if ($result) {
            // Return true if executed
            return true;
        } else {
            // Return false if doesn't execute
            return false;
        }
    }

    function get_pendaftaran_tuk($id) {
        $this->db->where("id", $id);
        $this->db->from("com_lsp_tuk");
        $query = $this->db->get();
        return $query->result();
    }

    function get_lsp_asesi($idasesi) {
        $this->db->select("a.*,b.skema", false);
        $this->db->from("lspabi_db.com_lsp_asesi a");
        $this->db->join("lspabi_bnspbaru_db.100skema b", "b.id=a.skema_id", "left");
        $this->db->where("a.id", $idasesi);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        } else {
            return false;
        }
    }

    function get_lsp_asesor($idasesor) {
        $this->db->select("a.*,b.skema", false);
        $this->db->from("lspabi_db.com_lsp_asesor a");
        $this->db->join("lspabi_bnspbaru_db.100skema b", "b.id=a.skema_id", "left");
        $this->db->where("a.id", $idasesor);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        } else {
            return false;
        }
    }

    function get_user_mail() {
        $this->db->where("u_status", "A");
        $query = $this->db->get("notifikasi_email");
        return $query->result();
    }

    function new_asesi($idasesi) {
        $this->db->where('id', $idasesi);
        $query = $this->db->get("com_lsp_asesi");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        } else {
            return false;
        }
    }

    function get_asesi_kdtran($kdtran) {
        $this->db->where('kode_transaksi', $kdtran);
        $query = $this->db->get("com_lsp_asesi");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        } else {
            return false;
        }
    }

    function update_status_asesi($id, $kdtransaksi, $status) {
        $data['kode_transaksi'] = $kdtransaksi;
        $data['status_ujian'] = $status;

        $this->db->where('id', $id);
        $query = $this->db->update('com_lsp_asesi', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    function update_status_asesi_front($kdtransaksi, $status) {
        $data['status_ujian'] = $status;
        $this->db->where('kode_transaksi', $kdtransaksi);
        $query = $this->db->update('com_lsp_asesi', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    function approve_asesi($kdtransaksi, $status) {
        $data['status_ujian'] = $status;
        $data['tgl_approve'] = date('Y-m-d H:i:s');
        $this->db->where('kode_transaksi', $kdtransaksi);
        $query = $this->db->update('com_lsp_asesi', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    function update_selesai($id,$status){
        $data['status_ujian'] = $status;
        $data['tgl_selesai'] = date('Y-m-d H:i:s');
        $this->db->where('id', $id);
        $query = $this->db->update('com_lsp_asesi', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    function get_elemen_kuk($id, $idlsp) {
        $this->db = $this->load->database('lspbnsp', true);
        //$id = $this->input->get("id");
        $this->db->where("id", $id);
        $this->db->where("status_delete", 0);
        $query = $this->db->get($idlsp . "kuk");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        } else {
            return 0;
        }
    }

    function get_global_data($pengguna) {
        $this->db->where("pengguna", $pengguna);
        $query = $this->db->get("global_data");

        if ($query->num_rows() > 1) {
            return $query->result();
        } else {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
    }

    function save_konfirmasi_asesi($param) {
        foreach ($param as $konfirm) {
            $data[$konfirm['name']] = $konfirm['value'];
        }

        $data['tgl_upload'] = date('Y-m-d H:i:s');
        $query = $this->db->insert('com_konfirmasi_pembayaran_asesi', $data);
        return $query;
    }

    function get_data_konfirmasi($kdtran){
        $this->db->where('kode_transaksi',$kdtran);
        $query = $this->db->get('com_konfirmasi_pembayaran_asesi');
        if($query->num_rows() > 0){
            foreach($query->result() as $row){
                $data=$row;
            }
            return $data;
        }else{
            return false;
        }
    }

    function get_archive(){
        $this->load->database('default', true);
        $query = $this->db->query("SELECT DISTINCT DATE_FORMAT(com_content.u_date_create, '%M %Y') AS myformat, COUNT(id) AS total
                FROM com_content
                GROUP BY MONTH (com_content.u_date_create)
                ORDER BY com_content.u_date_create DESC");
        //$this->db->group_by('com_content.u_date_create DESC');
        //$query = $this->db->get();
        return $query->result();
    }

    public function get_all_skemas($perpage, $offset,$search="") {
        if($search ==""){
            $this->db->order_by('id', 'ASC');
            $this->db->limit($perpage);
            $this->db->offset($offset);
            $query = $this->db->get(kode_tbl().'skemaxx');
        }else{
            //$this->db->like('skema', $search);
            $this->db->order_by('id', 'ASC');
            //$this->db->limit($perpage);
            //$this->db->offset($offset);
            $query = $this->db->get(kode_tbl().'skemas');
        }
        return $query->result();
    }


    public function get_all_asesor($perpage, $offset,$search="") {
        if($search ==""){
            $this->db->order_by('id', 'ASC');
            $this->db->limit($perpage);
            $this->db->offset($offset);
            $this->db->where('id_group_users',6);
            $query = $this->db->get('tbl007_users');
        }else{
            $this->db->where('id_group_users',6);
            $this->db->like('users', $search);
            $this->db->order_by('id', 'ASC');
            $this->db->limit($perpage);
            $this->db->offset($offset);
            $query = $this->db->get('tbl007_users');
        }
        return $query->result();
    }
    public function get_asesi($perpage, $offset, $search=""){
        if($search ==""){
            $this->db->select('a.id,a.nama_lengkap,a.no_registrasi,a.no_sertifikat,a.no_seri,a.tanggal_terbit,a.tanggal_rcc,a.tgl_penerbitan_sertifikat,a.skema_sertifikasi,b.skema');
            $this->db->from(kode_tbl().'asesi a');
            $this->db->join(kode_tbl().'skema b','a.skema_sertifikasi=b.id');
            // $this->db->where('a.no_registrasi !=',"");
            // $this->db->order_by('no_registrasi','DESC');
            $this->db->limit($perpage);
            $this->db->offset($offset);
            $query = $this->db->get();
        }else{
            $this->db->select('a.id,a.nama_lengkap,a.no_registrasi,a.no_sertifikat,a.no_seri,a.tanggal_terbit,a.tanggal_rcc,a.tgl_penerbitan_sertifikat,a.skema_sertifikasi,b.skema');
            $this->db->from(kode_tbl().'asesi a');
            $this->db->join(kode_tbl().'skema b','a.skema_sertifikasi=b.id');
            // $this->db->where('a.no_registrasi !=',"");
            $this->db->like('a.nama_lengkap',$search);
            // $this->db->order_by('no_registrasi','DESC');
            $this->db->limit($perpage);
            $this->db->offset($offset);
            $query = $this->db->get();
        }
            return $query->result();
    }
     function jadwal_uji_kompetensi(){
        $this->db->select('a.*,COUNT(b.id) as total_asesi');
        $this->db->from(kode_tbl().'jadual_asesmen a');
        $this->db->join(kode_tbl().'asesi b','a.id=b.jadwal_id','LEFT');
        $this->db->where('a.status_jadwal','0');
        $this->db->where('a.tanggal >',date('Y-m-d'));
        $this->db->group_by('a.id');
        $this->db->order_by('a.tanggal');
        return $this->db->get()->result();
    }
}
