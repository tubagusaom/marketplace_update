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


        //$id = $this->input->get('idlsp');

//        $this->db->select('id,kode_skema,skema,tanggal_ketetapan,jumlah_unit,id as idskema', false);
//        $this->db->from($idlsp . 'skema');
//        //$this->db->where('id_lsp', $idlsp);
//        $this->db->where('status_aktif', 1);

        $query = $this->db->get('com_lsp_asesi');
        return $query->result();
    }

    public function api_get_skema_detail($idlsp, $idskema) {


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
        $this->db->select('a.id, c.skema, c.kode_skema, c.link_download, c.description, b.unit_kompetensi, b.id_unit_kompetensi, b.translate');
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
        $this->db->where("status_aktif", 1);
        $this->db->where("id", $id);
        $query = $this->db->get( "lsp029_tuk");
        return $query->result();
    }

    function view_asesor_mandiri_detail($idasesi) {
        $this->db->where('com_lsp_asesi_id', $idasesi);
        $query = $this->db->get('com_lsp_asesor_asesmen_mandiri');
        return $query->result();
    }

    function get_provinsi() {

        $this->db->where("status_aktif", 1);
        $query = $this->db->get("lsp101_master_provinsi");
        return $query->result();
    }

    function get_kabupaten($idprovinsi) {

        $this->db->where("provinsi_id", $idprovinsi);
        $query = $this->db->get("master_kabupaten");
        return $query->result();
    }

    function getprovinsi($provinsi_id) {

        $this->db->where("id", $provinsi_id);
        $query = $this->db->get("master_provinsi");
        return $query->result();
    }

    function getkabupaten($idkab) {

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

        $this->db->where("status", 1);
        $query = $this->db->get($idlsp . "unit_kompetensi");
        return $query->result();
    }

    function get_unitkompetensi($idlsp, $kdunit) {


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


        $this->db->where("status", 1);
        $this->db->where_in("id", $kdunit);
        $query = $this->db->get($idlsp . "unit_kompetensi");
        return $query->result();
    }

    function get_jenis_tuk() {

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
    function table_master2($table_name){

        $sql = $this->db->get($table_name)->result();
        return $sql;
    }
    function row_lsp($id){

        $this->db->where('id',$id);
        $sql = $this->db->get('lsp')->row();
        return $sql;
    }
    function lsp_search($jenis,$lsp,$bidang,$provinsi){

        if($jenis!=""){
            $this->db->like('jenis_lsp', $jenis);
        }
        if($lsp!=""){
            $this->db->like('lsp', $lsp);
        }
        if($bidang!=""){
            $this->db->where('bidang_id', $bidang);
        }
        if($provinsi!=""){
            $this->db->where('provinsi_id', $provinsi);
        }
        return $this->db->get('lsp')->result();
    }
    function elemen_lsp($id){

        $skema = $id.'skema';
        $tuk = $id.'tuk';
        $asesor = $id.'asesor';
        $pemegang_sertifikat = $id.'pemegang_sertifikat';
        $total_skema = $this->db->get($skema)->num_rows();
        $total_tuk = $this->db->get($tuk)->num_rows();
        $total_asesor = $this->db->get($asesor)->num_rows();
        $total_pemegang_sertifikat = $this->db->get($pemegang_sertifikat)->num_rows();
        $array = array('total_skema'=>$total_skema,'total_tuk'=>$total_tuk,'total_asesor'=>$total_asesor,'total_pemegang_sertifikat'=>$total_pemegang_sertifikat);
        return $array;
    }
    function rekap_lsp($id){

        $this->db->where('id_lsp',$id);
        $laporan = $this->db->get('laporan_lsp')->result();
        if(count($laporan) > 0){
            $this->db->select_sum('skema');
            $this->db->select_sum('tuk');
            $this->db->select_sum('asesor');
            $this->db->select_sum('asesi');
            $this->db->where('id_lsp',$id);
            $this->db->group_by('id_lsp');
            $hasil = $this->db->get('laporan_lsp')->row();
            $rekap = 'Hasil laporan dari LSP sejak berdiri adalah Skema Sertifikasi sebanyak '.$hasil->skema.' Skema, TUK sebanyak '.$hasil->tuk.' TUK'.', Asesor sebanyak '.$hasil->asesor.' Orang'.', dan Asesi sebanyak '.$hasil->asesi.' Orang.';
        }else{
            $rekap = 'Data Laporan LSP belum di laporkan';
        }

        return $rekap;
    }
    function get_galery($id)
    {
        $this->db->select('a.id, a.title, a.link, a.image_description');
        $this->db->from('t_links a');
        $this->db->where('a.id_lsp',$id);
        $query = $this->db->get();
        return $query->result();
    }
    function master_sektor(){

        $this->db->group_by('sektor');
        $this->db->where('sektor !=','');
        return $this->db->get('laporan_skema')->result();
    }
    function master_bidang(){

        $this->db->group_by('bidang');
        $this->db->where('bidang !=','');
        return $this->db->get('laporan_skema')->result();
    }
    function skema_search($sektor,$lsp,$bidang,$nama_skema){

        if($sektor!=""){
            $this->db->like('sektor', $sektor);
        }
        if($bidang!=""){
            $this->db->like('bidang', $bidang);
        }
        if($lsp!=""){
            $this->db->where('kode_lsp', $lsp);
        }
        if($nama_skema!=""){
            $this->db->like('nama_skema', $nama_skema);
        }
        return $this->db->get('laporan_skema')->result();
    }
    public function get_all_lsp($perpage, $offset,$pencarian="",$jenis="",$lsp="",$bidang="",$provinsi="") {

        if($pencarian ==""){
            $this->db->order_by('id', 'ASC');
            $this->db->limit($perpage);
            $this->db->offset($offset);
            $query = $this->db->get('lsp');
        }else{
            if($jenis!=""){
                $this->db->like('jenis_lsp', $jenis);
            }
            if($lsp!=""){
                $this->db->like('lsp', $lsp);
            }
            if($bidang!=""){
                $this->db->where('bidang_id', $bidang);
            }
            if($provinsi!=""){
                $this->db->where('provinsi_id', $provinsi);
            }
            $this->db->order_by('id', 'ASC');
            $this->db->limit($perpage);
            $this->db->offset($offset);
            $query = $this->db->get('lsp');
        }
        return $query->result();
    }
    public function get_all_skema($perpage, $offset,$search="") {
        if($search ==""){
            $this->db->order_by('id', 'ASC');
            $this->db->limit($perpage);
            $this->db->offset($offset);
            $query = $this->db->get(kode_tbl().'skema');
        }else{
            $this->db->like('skema', $search);
            $this->db->order_by('id', 'ASC');
            $this->db->limit($perpage);
            $this->db->offset($offset);
            $query = $this->db->get(kode_tbl().'skema');
        }
        return $query->result();
    }
    function count_tuk(){

        return $this->db->count_all('laporan_tuk');
    }
    function get_row_skema($kode_lsp,$id){

        $this->db->where('id',$id);
        return $this->db->get($kode_lsp.'skema')->row();
    }
     public function get_all_asesor($perpage, $offset,$search="") {
        if($search ==""){
            $this->db->order_by('id', 'ASC');
            $this->db->limit($perpage);
            $this->db->offset($offset);
            $this->db->where('id_group_users',6);
            $query = $this->db->get(kode_tbl().'users');
        }else{
            $this->db->where('id_group_users',6);
            $this->db->like('users', $search);
            $this->db->order_by('id', 'ASC');
            $this->db->limit($perpage);
            $this->db->offset($offset);
            $query = $this->db->get(kode_tbl().'users');
        }
        return $query->result();
    }
    function asesor_search($provinsi,$lsp,$bidang,$nama_asesor,$no_reg){

        if($provinsi!=""){
            $this->db->where('provinsi', $provinsi);
        }
        if($bidang!=""){
            $this->db->like('bidang', $bidang);
        }
        if($lsp!=""){
            $this->db->where('kode_lsp', $lsp);
        }
        if($nama_asesor!=""){
            $this->db->like('nama_asesor', $nama_asesor);
        }
        if($no_reg!=""){
            $this->db->like('no_reg', $no_reg);
        }
        return $this->db->get('laporan_asesor')->result();
    }
    public function get_all_tuk($perpage, $offset,$search="") {
        if($search ==""){
            $this->db->order_by('no_cab', 'ASC');
            $this->db->limit($perpage);
            $this->db->offset($offset);
            $query = $this->db->get(kode_tbl().'tuk');
        }else{
            $this->db->like('tuk', $search);
            $this->db->order_by('no_cab', 'ASC');
            $this->db->limit($perpage);
            $this->db->offset($offset);
            $query = $this->db->get(kode_tbl().'tuk');
        }
        return $query->result();
    }
    function tuk_search($provinsi,$lsp,$jenis_tuk,$nama_tuk){

        if($provinsi!=""){
            $this->db->where('provinsi', $provinsi);
        }
        if($jenis_tuk!=""){
            $this->db->where('jenis_tuk', $jenis_tuk);
        }
        if($lsp!=""){
            $this->db->where('kode_lsp', $lsp);
        }
        if($nama_tuk!=""){
            $this->db->like('nama_tuk', $nama_tuk);
        }

        return $this->db->get('laporan_tuk')->result();
    }

    public function get_asesi($perpage, $offset,$search="") {
        if($search ==""){
            $this->db->select('a.nama_lengkap,a.no_registrasi,a.no_sertifikat,a.no_seri,a.tanggal_terbit,a.tanggal_rcc,b.skema')
            ->from(kode_tbl().'asesi a')
            ->join(kode_tbl().'skema b','a.skema_sertifikasi=b.id','LEFT')
            ->where('a.no_registrasi !=',"")
            ->order_by('no_registrasi', 'DESC')
            ->limit($perpage)
            ->offset($offset)
            ;
            $query = $this->db->get();
        }else{
            $this->db->select('a.nama_lengkap,a.no_registrasi,a.no_sertifikat,a.no_seri,a.tanggal_terbit,a.tanggal_rcc,b.skema')
            ->from(kode_tbl().'asesi a')
            ->join(kode_tbl().'skema b','a.skema_sertifikasi=b.id','LEFT')
            ->where('a.no_registrasi !=',"")
            ->like('a.nama_lengkap',$search)
            ->order_by('no_registrasi', 'DESC')
            ->limit($perpage)
            ->offset($offset)
            ;
            $query = $this->db->get();
        }
        return $query->result();
    }

    public function get_user($perpage, $offset,$search="") {
        if($search ==""){
            $this->db->select('a.*')
            ->from('t_users a')
            ->where('a.jenis_user',1)
            ->limit($perpage)
            ->offset($offset)
            ;
            $query = $this->db->get();
        }else{
            $this->db->select('a.*')
            ->from('t_users a')
            ->where('a.jenis_user',1)
            ->like('a.nama_user',$search)
            ->limit($perpage)
            ->offset($offset)
            ;
            $query = $this->db->get();
        }
        return $query->result();
    }

    public function get_all_asesi($perpage, $offset,$pencarian="",$skkni="",$skema_sertifikasi="",$provinsi="",$lsp="",$nama_pemegang_sertifikat="") {

        if($pencarian ==""){
            $this->db->where('a.nama_lengkap !=', '');
            $this->db->where('a.no_registrasi !=', '');
            $this->db->order_by('id', 'ASC');
            $this->db->limit($perpage);
            $this->db->offset($offset);
            $query = $this->db->get(kode_tbl().'asesi a');
        }else{

                 $this->db->like('nama_lengkap', $pencarian);
            $this->db->where('a.nama_lengkap !=', '');
            $this->db->where('a.no_registrasi !=', '');
            $this->db->order_by('id', 'ASC');
            $this->db->limit($perpage);
            $this->db->offset($offset);
            $query = $this->db->get(kode_tbl().'asesi a');
        }
        return $query->result();
    }
    function asesi_search($skkni,$skema_sertifikasi,$provinsi,$lsp,$nama_pemegang_sertifikat){

        if($provinsi!=""){
            $this->db->where('provinsi', $provinsi);
            }
            if($skkni!=""){
                $this->db->where('skkni', $skkni);
            }
            if($lsp!=""){
                $this->db->where('kode_lsp', $lsp);
            }
            if($skema_sertifikasi!=""){
                $this->db->where('skema_sertifikasi', $skema_sertifikasi);
            }
            if($nama_pemegang_sertifikat!=""){
                $this->db->like('nama_pemegang_sertifikat', $nama_pemegang_sertifikat);
            }

        return $this->db->get('laporan_sertifikat')->result();
    }

    public function get_all_jadwal_asesmen($perpage, $offset,$pencarian="",$lsp="",$nama_jadwal="",$tanggal_awal="") {

        if($pencarian ==""){
            $this->db->order_by('id', 'ASC');
            $this->db->limit($perpage);
            $this->db->offset($offset);
            $query = $this->db->get('laporan_jadwal_asesmen');
        }else{
            if($lsp!=""){
            $this->db->where('lsp', $lsp);
            }
            if($nama_jadwal!=""){
                $this->db->like('nama_jadwal', $nama_jadwal);
            }
            if($tanggal_awal!=""){
                $this->db->where('tanggal_awal', $tanggal_awal);
            }

            $this->db->order_by('tanggal_awal', 'DESC');
            $this->db->limit($perpage);
            $this->db->offset($offset);
            $query = $this->db->get('laporan_jadwal_asesmen');
        }
        return $query->result();
    }
    function jadwal_asesmen_search($lsp,$nama_jadwal,$tanggal_awal){

            if($lsp!=""){
                $this->db->where('lsp', $lsp);
            }
            if($nama_jadwal!=""){
                $this->db->like('nama_jadwal', $nama_jadwal);
            }
            if($tanggal_awal!=""){
                $this->db->where('tanggal_awal', $tanggal_awal);
            }

        return $this->db->get('laporan_jadwal_asesmen')->result();
    }
    public function get_all_lsp_status($perpage, $offset,$pencarian="",$data_all="",$lsp="",$skema="",$tuk="",$asesor="",$asesi="") {

        if($pencarian ==""){
            $this->db->order_by('id', 'ASC');
            $this->db->limit($perpage);
            $this->db->offset($offset);
            $query = $this->db->get('lsp');
        }else{
            if($data_all!=""){
                $this->db->where('data_skema', $data_all);
                $this->db->where('data_tuk', $data_all);
                $this->db->where('data_asesor', $data_all);
                $this->db->where('data_asesi', $data_all);
            }
            if($lsp!=""){
                $this->db->like('lsp', $lsp);
            }
            if($skema!=""){
                $this->db->where('data_skema', $skema);
            }
            if($tuk!=""){
                $this->db->where('data_tuk', $tuk);
            }
            if($asesor!=""){
                $this->db->where('data_asesor', $asesor);
            }
            if($asesi!=""){
                $this->db->where('data_asesi', $asesi);
            }
            $this->db->order_by('id', 'ASC');
            $this->db->limit($perpage);
            $this->db->offset($offset);
            $query = $this->db->get('lsp');
        }
        return $query->result();
    }
    function lsp_status_search($data_all,$lsp,$skema,$tuk,$asesor,$asesi){

        if($data_all!=""){
                $this->db->where('data_skema', $data_all);
                $this->db->where('data_tuk', $data_all);
                $this->db->where('data_asesor', $data_all);
                $this->db->where('data_asesi', $data_all);
            }
            if($lsp!=""){
                $this->db->like('lsp', $lsp);
            }
            if($skema!=""){
                $this->db->where('data_skema', $skema);
            }
            if($tuk!=""){
                $this->db->where('data_tuk', $tuk);
            }
            if($asesor!=""){
                $this->db->where('data_asesor', $asesor);
            }
            if($asesi!=""){
                $this->db->where('data_asesi', $asesi);
            }
        return $this->db->get('lsp')->result();
    }

    public function riwayat_sertifikasi($id){
        $this->db->select('a.*  ,b.skema,c.jadual,c.tanggal as tanggal_mulai_uji,c.tanggal_akhir as tanggal_akhir_uji,c.status_jadwal');
        $this->db->from(kode_tbl().'asesi a');
        $this->db->join(kode_tbl().'skema b','a.skema_sertifikasi=b.id');
        $this->db->join(kode_tbl().'jadual_asesmen c','a.jadwal_id=c.id','LEFT');
        $this->db->where('a.id_users',$id);
        $this->db->where('a.rekomendasi_asesor !=','0');
        $query = $this->db->get();
        return $query->result();
    }

    public function riwayat_uji($id){
        $this->db->select('
            c.*,
            a.skema,
            e.tanggal
          ');
        $this->db->from(kode_tbl().'skema a');
        $this->db->join(kode_tbl() . 'perangkat_asesmen b', 'b.skema_perangkat=a.id','LEFT');
        $this->db->join(kode_tbl() . 'perangkat_asesmen_detail c', 'c.id_perangkat_asesmen=b.id','LEFT');
        $this->db->join(kode_tbl().'asesi d','d.skema_sertifikasi=a.id');
        $this->db->join(kode_tbl().'jadual_asesmen e','d.jadwal_id=e.id');
        $this->db->where('d.id_users',$id);
        $this->db->where('d.rekomendasi_asesor','0');
        $this->db->where('e.status_jadwal','1');
        $query = $this->db->get();
        return $query->result();
    }

    function detail_sertifikasi($id){
        $this->db->select('a.*,b.skema,c.jadual,c.status_jadwal');
        $this->db->from(kode_tbl().'asesi a');
        $this->db->join(kode_tbl().'skema b','a.skema_sertifikasi=b.id');
        $this->db->join(kode_tbl().'jadual_asesmen c','a.jadwal_id=c.id','LEFT');
        $this->db->where('a.id',$id);
        $query = $this->db->get();
        return $query->row();
    }
    function detail_sertifikasi_asesmen($id,$id_users){
        $this->db->select('a.*,b.nama_dokumen');
        $this->db->from('t_asesi_portofolio a');
        $this->db->join('t_repositori b','a.id_repositori=b.id');
        $this->db->join(kode_tbl().'asesi c','a.id_asesi=c.id');
        $this->db->where('a.id_asesi',$id);
        $this->db->where('c.id_users',$id_users);

        $query = $this->db->get();
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
     function detail_sertifikasi_jadwal($id,$id_users){
        $this->db->select('a.*,b.*,e.tuk,e.alamat,c.skema,d.users');
        $this->db->from(kode_tbl().'asesi a');
        $this->db->join(kode_tbl().'jadual_asesmen b','a.jadwal_id=b.id');
        $this->db->join(kode_tbl().'tuk e','b.id_tuk=e.id','LEFT');
        $this->db->join(kode_tbl().'skema c','a.skema_sertifikasi=c.id');
        $this->db->join(kode_tbl().'users d','a.id_asesor=d.id','LEFT');
        $this->db->where('a.id',$id);

        $query = $this->db->get();
        return $query->row();
    }

    function perangkat_uji($id){
      // $this->db->select('a.*, b.jenis_perangkat, b.perangkat_detail, b.waktu_pengerjaan');
      // $this->db->from(kode_tbl().'perangkat_asesmen a');
      // $this->db->join(kode_tbl().'perangkat_asesmen_detail b','a.id=b.id_perangkat_asesmen');
      // $this->db->join(kode_tbl().'skema c','a.skema_perangkat=c.id');

      $this->db->select('a.*, b.id as id_perangkat, b.nama_perangkat, c.jenis_perangkat, c.perangkat_detail, c.waktu_pengerjaan');
      $this->db->from(kode_tbl().'skema a');
      $this->db->join(kode_tbl().'perangkat_asesmen b','a.id=b.skema_perangkat');
      $this->db->join(kode_tbl().'perangkat_asesmen_detail c','b.id=c.id_perangkat_asesmen','LEFT');

      $this->db->where('a.id',$id);

      $query = $this->db->get();
      return $query->row();
    }

    function pra_asesmen($id){
      $this->db->select('
          a.id,
          a.u_date_create,
          a.nama_lengkap,
          a.pra_asesmen_date,
          a.pra_asesmen,
          c.nama_user,
          d.skema
        ');
      $this->db->from(kode_tbl().'asesi a');
      $this->db->join(kode_tbl() . 'users b', 'b.id=a.id_asesor','LEFT');
      $this->db->join('vasesi_users_model c', 'c.pegawai_id=b.id','LEFT');
      $this->db->join(kode_tbl().'skema d', 'd.id=a.skema_sertifikasi','LEFT');
      $this->db->where('a.id_asesor',$id);
      // $this->db->group_by('a.id');
      $query = $this->db->get();
      return $query->result();
    }

}
