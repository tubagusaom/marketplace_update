<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends MY_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('welcome_model');
        $this->load->model('my_shop_model');
        $this->load->model('slider_model');
        $this->load->helper('cookie');
        $this->load->library('curl');
    }

    function index() {
        $jenis_user = $this->auth->get_user_data()->jenis_user;
        $id_user = $this->auth->get_user_data()->id;
        $id_member = $this->auth->get_user_data()->id_member;

        // var_dump($jenis_user); die();

        if ($jenis_user == 2) { //seller
            $template_header = ('templates/seller/header');
            $template_body = 'templates/seller/body';
            $template_bottom = 'templates/seller/bottom_seller';

            // $keranjang_order = $this->my_shop_model->keranjang_order($id_member);
            // var_dump(count($keranjang_order)); die();

            $slide_count = '';
            $slideshow = '';
            $showiklan = '';

            $product_terbaru = "";
            $product_favorite = "";
            $total_keranjang = "";

            $menu = '';
            $kategori = '';
            $sub_kategori = '';

            $query_pesan = "";
            $data_aktivitas = "";

            // var_dump($sub_kategori); die();

        } else if ($jenis_user == 3) { //buyer
            $template_header = ('templates/buyer/header');
            $template_body = 'templates/buyer/body';
            // $template_bottom = 'templates/buyer/bottom_buyer';
            $template_bottom = 'templates/bootstraps/bottom';

            // $template_header = ('templates/bootstraps/header');
            // $template_body = 'templates/bootstraps/body';
            // $template_bottom = 'templates/bootstraps/bottom';

            // $this->load->view('templates/bootstraps/header',$data);
            // $this->load->view('templates/bootstraps/body',$data);
            // $this->load->view('templates/bootstraps/bottom',$data);

            $slide_count = $this->welcome_model->slide_total();
            $slideshow = $this->welcome_model->slide_show();
            $showiklan = $this->welcome_model->show_iklan();

            $product_terbaru = $this->welcome_model->show_product_terbaru($id_member);
            $product_favorite = $this->welcome_model->product_favorite($id_member);
            $keranjang_buyer = $this->welcome_model->keranjang_buyer($id_member);

            foreach ($keranjang_buyer as $key => $keranjang) {
              $totalkeranjang+=$keranjang->jumlah_product;
            }

            if ($totalkeranjang == '') {
              $total_keranjang = '0';
            }else {
              $total_keranjang = $totalkeranjang;
            }

            $menu = $this->welcome_model->menu();
            $kategori = $this->welcome_model->kategori();
            $sub_kategori = $this->welcome_model->sub_kategori();

            $query_pesan = "";
            $data_aktivitas = "";

            // var_dump(($total_keranjang)); die();

        } else if ($jenis_user == 1) {
            $template_header = 'templates/responsive/header';
            $template_body = 'templates/responsive/body';
            $template_bottom = 'templates/responsive/footer_home';

            $this->db->where('id_users', $id_member);
            $row = $this->db->get(kode_tbl() . 'asesi')->row();

            // $this->load->model('Sertifikasi_Model');
            // $data_aktivitas = $this->Sertifikasi_Model->riwayat_uji($id_member);

            $slide_count = "";
            $slideshow = "";
            $showiklan = "";

            $product_terbaru = "";
            $product_favorite = "";
            $total_keranjang = "";

            $menu = "";
            $kategori = "";
            $sub_kategori = "";

        } else if ($jenis_user == 18 || $jenis_user == 5 || $jenis_user == 4 || $jenis_user == 99) { //finance
          $template_header = 'templates/jeasyui/header';
          $template_body = 'templates/jeasyui/body';
          $template_bottom = 'templates/jeasyui/footer';

          $query_pesan = "";
          // $data_aktivitas = "";

          $slide_count = "";
          $slideshow = "";
          $showiklan = "";

          $product_terbaru = "";
          $product_favorite = "";
          $total_keranjang = "";

          $menu = "";
          $kategori = "";
          $sub_kategori = "";

        } else {

            block_access_method();

            // $template_header = 'templates/jeasyui/header';
            // $template_body = 'templates/jeasyui/body';
            // $template_bottom = 'templates/jeasyui/footer';
            //
            // $query_pesan = "";
            // // $data_aktivitas = "";
            //
            // $slide_count = "";
            // $slideshow = "";
            // $showiklan = "";
            //
            // $product_terbaru = "";
            // $product_favorite = "";
            // $total_keranjang = "";
            //
            // $menu = "";
            // $kategori = "";
            // $sub_kategori = "";
            //
            // var_dump($jenis_user); die();
        }



        $aplikasi = $this->db->get('r_konfigurasi_aplikasi')->row();

        $this->load->model('welcome_model');

        // var_dump($data['total']); die();

        $this->load->view(
          $template_header,
          array(
            'aplikasi' => $this->aplikasi,
            'rolename' => $this->auth->get_rolename(),
            'nama_user' => $this->auth->get_user_data()->nama,
            'id_user' => $this->auth->get_user_data()->id,
            'id_member' => $this->auth->get_user_data()->id_member,

            'menu' => $menu,
            'kategori' => $kategori,
            'sub_kategori' => $sub_kategori,

            'product_favorite' => $product_favorite,
            'total_keranjang' => $total_keranjang,

            '_css_tag' => array(
              _Asset_JS_ . 'cleditor/jquery.cleditor',
              _Asset_CSS_ . 'default',
              _Asset_CSS_ . 'themes/default/easyui',
              _Asset_CSS_ . 'themes/icon',
              _Asset_CSS_ . 'bootstraps/font-awesome.min'),
              'query_pesan' => $this->query_pesan,
              'query_pesan_unread' => $this->query_pesan_unread,
              '_script_tag' => array(
                _Asset_JS_ . 'jquery.min',
                _Asset_JS_ . 'jquery-ui/jquery-ui.min',
                _Asset_JS_ . 'elfinder/elfinder.min',
                _Asset_JS_ . 'jquery.easyui.min')
          )
        );

        $this->load->view(
          $template_body,
          array(
            'aplikasi' => $this->aplikasi,
            'id_member' => $this->auth->get_user_data()->id_member,

            'unread_message' => $this->unread_message,
            'menus' => $this->menus,
            'rolename' => $this->auth->get_rolename(),
            'nama_user' => $this->auth->get_user_data()->nama,
            'product_terbaru' => $product_terbaru,
            'product_favorite' => $product_favorite,
            // 'data_aktivitas' => $data_aktivitas,

            'slide_count' => $slide_count,
            'slideshow' => $slideshow,
            'showiklan' => $showiklan
          )
        );

        $this->load->view(
          $template_bottom,
          array(
            'aplikasi' => $this->aplikasi,
            'pengunjung' => $data['pengunjung'],
            'total' => $data['total'],
            'rst' => $data['rst'],
            '_bottom_JS_' => array(
              _Asset_JS_ . 'member/jscript',
              _Asset_JS_ . 'member/default',
              _Asset_JS_ . 'easyui.form.extend',
              _Asset_JS_ . 'jquery.extend',
              _Asset_JS_ . 'member/serializeObject',
              _Asset_JS_ . 'jquery.easyui.lang.id',
              _Asset_JS_ . 'member/ajaxfileupload',
              _Asset_JS_ . 'cleditor/jquery.cleditor.min')
          )
        );

    }

    function about() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            echo json_encode(array('msgType' => 'success', 'width' => 600, 'height' => 400, 'title' => 'Tentang Aplikasi', 'msgValue' => $this->load->view('home/about', '', TRUE)));
        }
    }

    function sukses() {
        $template_header = 'templates/responsive/header';
        $template_body = 'templates/responsive/sukses';
        $template_bottom = 'templates/responsive/footer';
        $this->load->view($template_header, array('aplikasi' => $this->aplikasi, 'query_pesan' => $this->query_pesan, 'query_pesan_unread' => $this->query_pesan_unread));
        $this->load->view($template_body, array('aplikasi' => $this->aplikasi, 'unread_message' => $this->unread_message, 'menus' => $this->menus, 'rolename' => $this->auth->get_rolename(), 'nama_user' => $this->auth->get_user_data()->nama));
        $this->load->view($template_bottom, array('aplikasi' => $this->aplikasi));
    }

    function data_aktifitas(){
           $this->load->model('Sertifikasi_Model');
           $this->db->where('id',$this->id);
           $this->db->where('jenis_user','1');
           $row = $this->db->get('t_users')->row();

            //var_dump($this->id);die();
            $data['riwayat_sertifikasi'] = $this->Sertifikasi_Model->riwayat_sertifikasi($row->id_member);
            //dump($data['riwayat_sertifikasi']);die();
            $status_data_aktifitas = "";
            $detail_sertifikasi = $this->Sertifikasi_Model->detail_sertifikasi($row->id_member);
            //dump($detail_sertifikasi);die();
            $data['jadwal_uji_kompetensi'] = $this->Sertifikasi_Model->jadwal_uji_kompetensi();
            //var_dump($data['jadwal_uji_kompetensi']);die();
            $data['detail_sertifikasi'] = $detail_sertifikasi;

            $data['created_when'] = $detail_sertifikasi->created_when;
            $data['registrasi_baru'] = $detail_sertifikasi->created_when;
            $data['registrasi_baru'] = date("Y-m-d",strtotime($data['registrasi_baru']));
            //var_dump($detail_sertifikasi->complete_portofolio);die();

            $this->db->where('id_asesi',$this->id);
            $this->db->where_in('jenis_portofolio',array('1','3'));
            $row_repositori = $this->db->get('t_repositori')->result();
            //var_dump($row_repositori);die();
        if (count($row_repositori) >= 3) {
            $data['status_praasesmen'] = "Lengkap";
            $data['tanggal_praasesmen'] = $detail_sertifikasi->tanggal_portofolio;
        } else {
            $data['status_praasesmen'] = "Belum Lengkap";
            $data['tanggal_praasesmen'] = "-";
        }

        if ($detail_sertifikasi->complete_praasesmen == '1') {
            $data['status_mandiri'] = "Lengkap";
            $data['tanggal_mandiri'] = $detail_sertifikasi->tgl_praasesmen;
        } else {
            $data['status_mandiri'] = "Belum Lengkap";
            $data['tanggal_mandiri'] = "-";
        }
        if ($detail_sertifikasi->metode_bayar == '1') {

            if ($detail_sertifikasi->administrasi_ujk == '1') {
                $data['status_administrasi'] = "Kolektif";
                $data['tanggal_administrasi'] = 'Pembayaran di Akhir';
            } else {
                $data['status_administrasi'] = "Kolektif dan Lunas";
                $data['tanggal_administrasi'] = tgl_indo($detail_sertifikasi->tanggal_bayar);
            }
        } else {
            if ($detail_sertifikasi->administrasi_ujk == '0') {
                $data['status_administrasi'] = "Pribadi dan terbit Invoice";
                $data['tanggal_administrasi'] = '-';
            } elseif ($detail_sertifikasi->administrasi_ujk == '1') {
                $data['status_administrasi'] = "Pribadi dan Lunas";
                $data['tanggal_administrasi'] = '-';
            } elseif ($detail_sertifikasi->administrasi_ujk == '2') {
                $data['status_administrasi'] = "Pribadi dan Menunggu Konfirmasi Pembayaran";
                $data['tanggal_administrasi'] = '-';
            } else {
                $data['status_administrasi'] = "Pribadi dan Terbit Invoice";
                $data['tanggal_administrasi'] = tgl_indo($detail_sertifikasi->tanggal_tagihan);
            }
        }
        if ($detail_sertifikasi->pra_asesmen == '1') {
            $data['status_praasesmen_siap'] = "Siap dilaksanakan";
            $data['tanggal_praasesmen_siap'] = $detail_sertifikasi->pra_asesmen_datetime;
        } else if ($detail_sertifikasi->pra_asesmen == '2') {
            $data['status_praasesmen_siap'] = "Permohonan ditolak";
            $data['tanggal_praasesmen_siap'] = $detail_sertifikasi->pra_asesmen_datetime;
        } else {
            $data['status_praasesmen_siap'] = "Belum di proses";
            $data['tanggal_praasesmen_siap'] = "-";
        }

        if ($detail_sertifikasi->id_asesor != 'NULL') {
            $data['status_penjadwalan'] = "Terjadwal";
            $this->db->where('id', $detail_sertifikasi->jadwal_id);
            $query = $this->db->get(kode_tbl() . 'jadual_asesmen')->row();

            $data['tanggal_penjadwalan'] = tgl_indo($query->tanggal);
        } else {
            $data['status_penjadwalan'] = "Belum Terjadwal";
            $data['tanggal_penjadwalan'] = "-";
        }
        if ($detail_sertifikasi->rekomendasi_asesor == '0') {
            $data['status_rekomendasi'] = "Belum di rekomendasi";
            $data['tanggal_rekomendasi'] = "-";
        } else {
            $array_rekomendasi = array('Belum di rekomendasi', 'Kompeten', 'Belum Kompeten');
            $data['status_rekomendasi'] = $array_rekomendasi[$detail_sertifikasi->rekomendasi_asesor];
            $data['tanggal_rekomendasi'] = $detail_sertifikasi->tgl_rekomendasi_asesor;
        }
        if ($detail_sertifikasi->complete_komite_teknis == '0') {
            $data['status_komite_teknis'] = "Belum Selesai";
            $data['tanggal_komite_teknis'] = "-";
        } else {
            $data['status_komite_teknis'] = "Selesai";
            $data['tanggal_komite_teknis'] = $detail_sertifikasi->tgl_komite_teknis;
        }
        //var_dump($data['tanggal_komite_teknis']);die();

        if ($detail_sertifikasi->status_jadwal == '0') {
            $data['status_berita_acara'] = "Belum Selesai";
            $data['tanggal_berita_acara'] = "-";
        } else {
            $data['status_berita_acara'] = "Selesai";
            $data['tanggal_berita_acara'] = tgl_indo($detail_sertifikasi->tgl_berita_acara);
        }
        if ($detail_sertifikasi->no_seri == '') {
            $data['status_sertifikat'] = "Belum Dicetak";
            $data['tanggal_sertifikat'] = "-";
        } else {
            $data['status_sertifikat'] = "Sudah Dicetak";
            $data['tanggal_sertifikat'] = tgl_indo($detail_sertifikasi->tanggal_terbit);
        }
        if ($detail_sertifikasi->complete_pengiriman == '0') {
            $data['status_pengiriman'] = "Belum Dikirm";
            $data['tanggal_pengiriman'] = "-";
        } else {
            $data['status_pengiriman'] = "Sudah Dikirim";
            $data['tanggal_pengiriman'] = tgl_indo($detail_sertifikasi->tgl_pengiriman);
        }


        return $data;

    }
}
