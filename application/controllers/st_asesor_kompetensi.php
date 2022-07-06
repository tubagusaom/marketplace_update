<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class St_asesor_kompetensi extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('vst_askom');
    }

    function index() {
        $this->load->library('grid');
        $grid = $this->grid->set_properties(array('model' => 'vst_askom', 'controller' => 'st_asesor_kompetensi', 'options' => array('id' => 'st_askom', 'pagination', 'rownumber')))->load_model()->set_grid();
        $view = $this->load->view('v_laporan_asesmen/vst_askom', array('grid' => $grid), true);
        echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
    }

    function datagrid() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
            $page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
            $offset = $row * ($page - 1);
            $data = array();
            $jenis_user = $this->auth->get_user_data()->jenis_user;
            if ($jenis_user == 3) {
                $asesi_id = $this->auth->get_user_data()->pegawai_id;
                $where['id_tuk ='] = $asesi_id;
            }
            if (isset($_POST['nama_user']) && !empty($_POST['nama_user'])) {
                $where['nama_user LIKE'] = '%' . $this->input->post('nama_user') . '%';
            }
            if (isset($_POST['akun']) && !empty($_POST['akun'])) {
                $where['akun LIKE'] = '%' . $this->input->post('akun') . '%';
            }
            if (isset($_POST['jenis_user']) && !empty($_POST['jenis_user'])) {
                $where['jenis_user ='] = $this->input->post('jenis_user');
            }
            $where['id !='] = "";
            $params = array('_return' => 'data');
            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = $where ? $this->vst_askom->count_by($where) : $this->vst_askom->count_all();
            $this->vst_askom->limit($row, $offset);
            $order = $this->vst_askom->get_params('_order');
            $rows = $this->vst_askom->set_params($params)->with(array());
            $data['rows'] = $this->vst_askom->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else {
            block_access_method();
        }
    }

    function cetak($id, $type = "pdf", $email_attachment = false) {
        $this->db->select('a.*,b.tuk,b.alamat');
        $this->db->from(kode_tbl() . 'jadual_asesmen a');
        $this->db->join(kode_tbl() . 'tuk b', 'b.id=a.id_tuk');
        $this->db->where('a.id', $id);
        $row = $this->db->get()->row();
        $tanggal_jadwal = $row->tanggal;

        $data['tuk'] = $row->tuk;
        $tanggal_persiapan = strtotime('-3 day', strtotime($tanggal_jadwal));
        $data['tanggal_persiapan'] = tgl_indo(date('Y-m-d', $tanggal_persiapan));

        $data['skema_sertifikasi'] = $this->vst_askom->skema_sertifikasi($id);
        if ($data['skema_sertifikasi'] != '-') {
            $data['array_skema'] = explode(',', $data['skema_sertifikasi']);
            foreach ($data['array_skema'] as $keys => $values) {
                $unit_kompetensi[$keys] = $this->vst_askom->unit_kompetensi($values);
            }
            $data['unit_kompetensi'] = $unit_kompetensi;
        } else {
            $data['array_skema'] = array();
            $data['unit_kompetensi'] = array();
        }
        
        $jadual_asesmen = kode_tbl() . 'jadual_asesmen';
        $rows_jadwal_tahun = $this->db->query("select *
						from $jadual_asesmen
						WHERE YEAR(tanggal)='$tanggal_jadwal'")->result();
       
        $no_jadwal = sprintf("%03s", (count($rows_jadwal_tahun) + 1));
        $bulan_romawi = bulan_romawi($row->tanggal);
        $tahun_st = substr($row->tanggal, 0, 4);
        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
        $data['jadual_asesmen'] = $row;
        $tahun = explode('-', $row->created_when);
        $data['no_st'] = $no_jadwal . '/ST/UJI/LSPSTP-BANDUNG/' . $bulan_romawi . '/' . $tahun_st;
        $data['tanggal_st'] = tgl_indo($row->created_when);
        $data['qr_ketua_lsp'] = " Ketua " . $data['aplikasi']->singkatan_unit . " " . $data['aplikasi']->ketua . "\r\n\n\n" . $data['aplikasi']->url_aplikasi;


        $this->db->select('b.*,a.jenis_asesmen');
        $this->db->from(kode_tbl() . 'mapping_asesor a');
        $this->db->join(kode_tbl() . 'users b', 'a.id_asesor=b.id');
        $this->db->where('id_jadwal', $id);
        $data['asesor_kompetensi'] = $this->db->get()->result();
        $data['jenis_asesor'] = array('Asesor Mandiri', 'Asesor Penguji', 'Lead Assessor', 'Penanggung Jawab');
        //var_dump($data['asesor_kompetensi']);die();
        //var_dump($skema);die();
        $this->db->select('b.nama_calon,a.nama_asesor,a.judul_unit');
        $this->db->from(kode_tbl().'detail_jadwal a');
        $this->db->join(kode_tbl().'calon_asesi b','a.id_mahasiswa=b.id');
        $this->db->where('a.id_jadwal', $id);
        $this->db->order_by('a.id_asesor');
        $this->db->order_by('a.id_mahasiswa');
        $data['st_asesor'] = $this->db->get()->result_array();
        
        //var_dump($st_asesor);die();
        
        
        //$this->load->model('asesi_model');
        //$data['unit'] = $this->asesi_model->data_unit_kompetensi($data['sertifikat']->skema_sertifikasi);
        $data['msg'] = $data['no_st'] . "\r\n\n\n" . $data['aplikasi']->url_aplikasi . "/spt/tuk/" . $id;

        $view = $this->load->view('jadwal_asesmen/cetak_all_st', $data, true);

        if ($type == "pdf") {
            $this->load->library("htm12pdf");
            $this->htm12pdf->pdf_create($view, "st-" . $id . ".pdf", $email_attachment, true);
        }
    }

    function email($id) {
        $mapping_asesor = kode_tbl() . 'mapping_asesor';
        $jadual_asesmen = kode_tbl() . 'jadual_asesmen';

        $this->cetak($id, $type = "pdf", true);
        $query_maping = $this->db->query("SELECT b.jadual,a.id_asesor
        FROM $mapping_asesor a
        JOIN $jadual_asesmen b ON a.id_jadwal=b.id WHERE b.id=$id")->result();

        //var_dump($query_maping[0]->jadual);die();
        //$this->db->where("id",$id);

        foreach ($query_maping as $key => $value) {
            $kode_asesor[] = $value->id_asesor;
        }
        $this->db->select('email');
        $this->db->where('jenis_user', '2');
        $this->db->where_in('pegawai_id', $kode_asesor);
        $asesor = $this->db->get('t_users')->result();

        foreach ($asesor as $key => $value) {
            $email_tujuan[]["email"] = $value->email;
        }
        //echo json_encode($email_tujuan);
        //die();

        $filename = base64_encode(file_get_contents('repo/asesor/st-' . $id . '.pdf'));
        //var_dump($filename);die();
        //$isi_pesan = '<p>LSP '
        $admin = $this->db->get('r_konfigurasi_aplikasi')->row();
        $post = '{"personalizations": [{"to": ' . json_encode($email_tujuan) . ',"subject": "Surat Tugas Asesor ' . $query_maping[0]->jadual . '"}],"from": {"email": "' . $admin->alamat_email . '"},"content": [{"type": "text/plain","value": "Berikut terlampir Surat Tugas Pelaksanaan Uji Kompetensi. Terimakasih"}],"attachments": [{"content": "' . $filename . '","type": "application/pdf","filename": "st-' . $id . '.pdf"}]}';
        //var_dump($post);die();
        sendgrid_api_text('https://api.sendgrid.com/v3/mail/send', $post);
        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Surat Tugas berhasil dikirim !'));
    }

}
