<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Buyer extends MY_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('welcome_model');
        $this->load->model('slider_model');
        $this->load->model('buyer_model');
        $this->load->helper('cookie');
        $this->load->library('curl');

        $this->load->library('xendit');
    }

    function index(){

      $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();

      $data['jenis_user'] = $this->auth->get_user_data()->jenis_user;
      $data['nama_user'] = $this->auth->get_user_data()->nama;
      $data['id_user'] = $this->auth->get_user_data()->id;
      $data['id_member'] = $this->auth->get_user_data()->id_member;
      $id_member = $data['id_member'];

      // var_dump($id_member); die();

      $data['menu'] = $this->welcome_model->menu();
      $data['kategori'] = $this->welcome_model->kategori();
      $data['sub_kategori'] = $this->welcome_model->sub_kategori();

      $data['buyer'] = $this->buyer_model->buyer($id_member);
      $data['buyer_alamat'] = $this->buyer_model->buyer_alamat($id_member);

      $data['keranjang_get_member'] = $this->welcome_model->keranjang_get_member($id_member);
      $data['product_favorite'] = $this->welcome_model->product_favorite($id_member);
      $data['keranjang_buyer'] = $this->welcome_model->keranjang_buyer($id_member);

      $keranjang_buyer = $data['keranjang_buyer'];

      // $data_toko = "";
      foreach ($keranjang_buyer as $key => $keranjang) {
        $totalkeranjang += $keranjang->jumlah_product;
      }

      if ($totalkeranjang == '') {
        $data['total_keranjang'] = '0';
      }else {
        $data['total_keranjang'] = $totalkeranjang;
      }

      // var_dump($data['member']); die();
      // var_dump($id_member); die();

      $this->load->view('templates/buyer/akun/header',$data);
      $this->load->view('templates/buyer/akun/body',$data);
      $this->load->view('templates/bootstraps/bottom',$data);

    }

    function keranjang(){
      $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();

      $data['jenis_user'] = $this->auth->get_user_data()->jenis_user;
      $data['nama_user'] = $this->auth->get_user_data()->nama;
      $data['id_user'] = $this->auth->get_user_data()->id;
      $data['id_member'] = $this->auth->get_user_data()->id_member;
      $id_member = $data['id_member'];

      // var_dump($id_member); die();

      $data['menu'] = $this->welcome_model->menu();
      $data['kategori'] = $this->welcome_model->kategori();
      $data['sub_kategori'] = $this->welcome_model->sub_kategori();

      $data['keranjang_get_member'] = $this->welcome_model->keranjang_get_member($id_member);
      $data['product_favorite'] = $this->welcome_model->product_favorite($id_member);
      $data['keranjang_buyer'] = $this->welcome_model->keranjang_buyer($id_member);

      $keranjang_buyer = $data['keranjang_buyer'];

      // $data_toko = "";
      foreach ($keranjang_buyer as $key => $keranjang) {
        $totalkeranjang += $keranjang->jumlah_product;
      }

      if ($totalkeranjang == '') {
        $data['total_keranjang'] = '0';
      }else {
        $data['total_keranjang'] = $totalkeranjang;
      }

      // var_dump($data['keranjang_get_member']); die();
      // var_dump($id_member); die();

      $this->load->view('templates/buyer/header',$data);
      $this->load->view('buyer/keranjang',$data);
      $this->load->view('templates/bootstraps/bottom',$data);
    }

    function checkout(){

      $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();

      $data['jenis_user'] = $this->auth->get_user_data()->jenis_user;
      $data['nama_user'] = $this->auth->get_user_data()->nama;
      $data['id_user'] = $this->auth->get_user_data()->id;
      $data['id_member'] = $this->auth->get_user_data()->id_member;
      $id_member = $data['id_member'];

      $data['menu'] = $this->welcome_model->menu();
      $data['kategori'] = $this->welcome_model->kategori();
      $data['sub_kategori'] = $this->welcome_model->sub_kategori();

      $data['keranjang_get_member'] = $this->welcome_model->keranjang_get_member($id_member);
      $data['product_favorite'] = $this->welcome_model->product_favorite($id_member);



      // $data['grand_total'] = $this->input->post('grand_total');
      $data['check_toko'] = $this->input->post('check_toko');
      $id_toko = $data['check_toko'];

      // $arridtoko='';
      foreach ($id_toko as $idt) {
          $arridtoko[] .= $idt;
      }

      // $this->db->where_in('id', $arridtoko);
      // $data['datatoko'] = $this->db->get(kode_tbl() . 'members')->result();

      $data['datatoko'] = $this->buyer_model->datatoko($arridtoko);

      // var_dump($data['datatoko']); die();

      $this->db->where_in('id_member', $arridtoko);
      $this->db->where_in('id_buyer', $id_member);
      $this->db->where('status_pengiriman', '0');
      $data['datakurirpengiriman'] = $this->db->get(kode_tbl() . 'kurir_pengiriman_buyer')->result();
      $datakurirpengiriman = $data['datakurirpengiriman'];

      // var_dump($datakurirpengiriman); die();

      foreach ($datakurirpengiriman as $key => $dkp) {
        $data['total_biaya_kirim'] += $dkp->biaya_pengiriman;

        $data['detail_biaya_kirim'][$key] += $dkp->biaya_pengiriman;
        $data['detail_kurir_kirim'][$key] = $dkp->kurir_pengiriman;
        $data['id_kurir_kirim'][$key] = $dkp->id;
      }

      $data['keranjang_get_member'] = $this->welcome_model->keranjang_get_member($id_member);
      $keranjang_get_member = $data['keranjang_get_member'];

      foreach ($keranjang_get_member as $key => $get_keranjang) {
        $data['total_keranjang'] += $get_keranjang->jumlah_product;
      }

      // $data['total_keranjang'] = $keranjang_get_member;
      // var_dump(($data['total_keranjang'])); die();

      $data['keranjang_buyer'] = $this->buyer_model->perkeranjang_buyer($id_member,$arridtoko);
      $keranjang_buyer = $data['keranjang_buyer'];

      foreach ($keranjang_buyer as $key => $keranjang) {
        $data['sel_total_keranjang'] += $keranjang->jumlah_product;
        $data['berat_keranjang'] += ($keranjang->berat_product*$keranjang->jumlah_product);
        $data['grand_total']     += ($keranjang->jumlah_product*$keranjang->harga_product);

        // $data['berat_perkeranjang'][$key] += ($keranjang->berat_product*$keranjang->jumlah_product);
        $data['id_perkeranjang'][$key] = $keranjang->id;
        $data['detail_product_perkeranjang'][$key] = $keranjang;

        $bpk += ($keranjang->berat_product*$keranjang->jumlah_product);
        $b_perk = ($keranjang->berat_product*$keranjang->jumlah_product);
        $data['berat_keranjang_pertoko'][$key] = $b_perk;
      }

      // $data['berat_keranjang_pertoko'] = $bpk++;
      // $berat_keranjang_pertoko = $data['berat_keranjang_pertoko'];

      // var_dump($data['berat_keranjang_pertoko']); die();
      // var_dump($berat_keranjang_pertoko); die();

      $data['alamat_utama_buyer'] = $this->welcome_model->buyer_alamat_utama($id_member);

      // var_dump(json_encode($err)); die();
      // var_dump($data['alamat_utama_buyer']); die();

      // $data['provinsi_ro'] = $this->provinsi_ro();
      // // $kota_toko = '';
      // foreach ($data['datatoko'] as $key => $kt) {
      //   // $kota_toko .=$kt->id_kabupaten_member;
      //   $ko_to = json_decode($this->kota_ro($kt->id_kabupaten_member));
      //   $prov_toko[$key] = $ko_to->province;
      //   $kota_toko[$key] = $ko_to->city_name;
      // }

      // var_dump($kota_toko); die();
      // $testkota =  $this->kota_ro('39');

      // $kota_buyer = $this->kota_ro($data['alamat_utama_buyer']->id_kabupaten);
      // // $tarif_ro = $this->tarif_ro('501','114','5','tiki');
      //
      // $data['prov_toko']  = $prov_toko;
      // $data['kota_toko']  = $kota_toko;
      // // $data['kota_tokox']  = json_decode($data['kota_toko']);
      // $data['kota_buyer'] = json_decode($kota_buyer);

      // var_dump($data['provinsi_ro']); die();
      // var_dump($data['alamat_utama_buyer']->id_kabupaten); die();
      // var_dump($testkota); die();
      // jaktim = 154
      // jaksel = 153


      $this->load->view('templates/buyer/header',$data);
      $this->load->view('buyer/checkout',$data);
      $this->load->view('templates/bootstraps/bottom',$data);
    }

    function rincian_transaksi(){
      $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();

      $data['jenis_user'] = $this->auth->get_user_data()->jenis_user;
      $data['nama_user'] = $this->auth->get_user_data()->nama;
      $data['id_user'] = $this->auth->get_user_data()->id;
      $data['id_member'] = $this->auth->get_user_data()->id_member;
      $id_member = $data['id_member'];

      // var_dump($id_member); die();

      $data['menu'] = $this->welcome_model->menu();
      $data['kategori'] = $this->welcome_model->kategori();
      $data['sub_kategori'] = $this->welcome_model->sub_kategori();

      $data['keranjang_get_member'] = $this->welcome_model->keranjang_get_member($id_member);
      $data['product_favorite'] = $this->welcome_model->product_favorite($id_member);
      $data['keranjang_buyer'] = $this->welcome_model->keranjang_buyer($id_member);

      $keranjang_buyer = $data['keranjang_buyer'];

      // $data_toko = "";
      foreach ($keranjang_buyer as $key => $keranjang) {
        $totalkeranjang += $keranjang->jumlah_product;
      }

      if ($totalkeranjang == '') {
        $data['total_keranjang'] = '0';
      }else {
        $data['total_keranjang'] = $totalkeranjang;
      }

      $data['trans_belum']    = $this->buyer_model->trans_buyer($id_member,'1');
      $data['trans_dikemas']  = $this->buyer_model->trans_buyer($id_member,'2');
      $data['trans_dikirim']  = $this->buyer_model->trans_buyer($id_member,'5');
      $data['trans_selesai']  = $this->buyer_model->trans_buyer($id_member,'3');

      // var_dump($data['trans_selesai']); die();
      // var_dump($id_member); die();

      $this->load->view('templates/buyer/akun/header',$data);
      $this->load->view('templates/buyer/akun/rincian_transaksi',$data);
      $this->load->view('templates/bootstraps/bottom',$data);
    }







    function xendit_get_va($external_id, $bank_code, $name){

      $va = $this->xendit->createCallbackVirtualAccount($external_id, $bank_code, $name);
      var_dump($va); die();

    }

    function detail_transaksi(){

      $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();

      $data['jenis_user'] = $this->auth->get_user_data()->jenis_user;
      $data['nama_user'] = $this->auth->get_user_data()->nama;
      $data['id_user'] = $this->auth->get_user_data()->id;
      $data['id_member'] = $this->auth->get_user_data()->id_member;
      $id_member = $data['id_member'];

      $data['menu'] = $this->welcome_model->menu();
      $data['kategori'] = $this->welcome_model->kategori();
      $data['sub_kategori'] = $this->welcome_model->sub_kategori();

      $data['keranjang_get_member'] = $this->welcome_model->keranjang_get_member($id_member);
      $data['product_favorite'] = $this->welcome_model->product_favorite($id_member);



      // $data['grand_total'] = $this->input->post('grand_total');
      $data['check_toko'] = $this->input->post('check_toko');
      $id_toko = $data['check_toko'];

      // $arridtoko='';
      foreach ($id_toko as $idt) {
          $arridtoko[] .= $idt;
      }

      $data['datatoko'] = $this->buyer_model->datatoko($arridtoko);

      $data['keranjang_get_member'] = $this->welcome_model->keranjang_get_member($id_member);
      $keranjang_get_member = $data['keranjang_get_member'];

      foreach ($keranjang_get_member as $key => $get_keranjang) {
        $data['total_keranjang'] += $get_keranjang->jumlah_product;
      }






      $nm_penerima      = $this->input->post('nm_penerima');
      $tlp_penerima     = $this->input->post('tlp_penerima');
      $metodeatm        = $this->input->post('metodeatm');

      // $id = '61dba0151654fd7230461938';
      $external_id = $nm_penerima.'-'.$tlp_penerima;
      $bank_code = $metodeatm;
      $name = $nm_penerima;
      //
      // $va = $this->xendit->createCallbackVirtualAccount($external_id, $bank_code, $name);
      //
      // // var_dump($va); die();
      //
      // $data['virtual_id'] = $va['id'];
      // $data['virtual_account'] = $va['account_number'];

      // var_dump($data['virtual_id']); die();

      $data['id_keranjang'] = $this->input->post('id_keranjang');
      $data['id_toko'] = $this->input->post('id_toko');
      $data['id_buyer'] = $this->input->post('id_buyer');
      $data['id_kurir_kirim'] = $this->input->post('id_kurir_kirim');
      $data['total_transaksi'] = $this->input->post('total_transaksi');

      $data['nmbank_pengirim'] = $this->input->post('nmbank_pengirim');
      $data['norek_pengirim'] = $this->input->post('norek_pengirim');
      $data['nmrek_pengirim'] = $this->input->post('nmrek_pengirim');
      $data['nmbank_tujuan'] = $this->input->post('nmbank_tujuan');
      // $data['norek_tujuan'] = $va['account_number'];
      // $data['nmrek_tujuan'] = $bank_code.' Virtual Account';

      // $id_keranjang     = $this->input->post('id_keranjang');
      // $id_toko          = $this->input->post('id_toko');
      // $id_buyer         = $this->input->post('id_buyer');
      // $id_kurir_kirim   = $this->input->post('id_kurir_kirim');
      // $total_transaksi  = $this->input->post('total_transaksi');
      //
      // $nmbank_pengirim  = $this->input->post('nmbank_pengirim');
      // $norek_pengirim   = $this->input->post('norek_pengirim');
      // $nmrek_pengirim   = $this->input->post('nmrek_pengirim');
      // $nmbank_tujuan    = $this->input->post('nmbank_tujuan');
      // $norek_tujuan     = $this->input->post('norek_tujuan');
      // $nmrek_tujuan     = $this->input->post('nmrek_tujuan');

      // var_dump($data); die();

      $this->load->view('templates/buyer/header',$data);
      $this->load->view('buyer/detail_transaksi',$data);
      $this->load->view('templates/bootstraps/bottom',$data);
    }

    function transaksi(){

      $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();

      $data['jenis_user'] = $this->auth->get_user_data()->jenis_user;
      $data['nama_user'] = $this->auth->get_user_data()->nama;
      $data['id_user'] = $this->auth->get_user_data()->id;
      $data['id_member'] = $this->auth->get_user_data()->id_member;
      $id_member = $data['id_member'];

      // $data['menu'] = $this->welcome_model->menu();
      // $data['kategori'] = $this->welcome_model->kategori();
      // $data['sub_kategori'] = $this->welcome_model->sub_kategori();
      //
      // $data['keranjang_get_member'] = $this->welcome_model->keranjang_get_member($id_member);
      // $data['product_favorite'] = $this->welcome_model->product_favorite($id_member);
      //
      //
      //
      // // $data['grand_total'] = $this->input->post('grand_total');
      // $data['check_toko'] = $this->input->post('check_toko');
      // $id_toko = $data['check_toko'];
      //
      // // $arridtoko='';
      // foreach ($id_toko as $idt) {
      //     $arridtoko[] .= $idt;
      // }
      //
      // $data['datatoko'] = $this->buyer_model->datatoko($arridtoko);
      //
      // $data['keranjang_get_member'] = $this->welcome_model->keranjang_get_member($id_member);
      // $keranjang_get_member = $data['keranjang_get_member'];
      //
      // foreach ($keranjang_get_member as $key => $get_keranjang) {
      //   $data['total_keranjang'] += $get_keranjang->jumlah_product;
      // }






      $nm_penerima      = $this->input->post('nm_penerima');
      $tlp_penerima     = $this->input->post('tlp_penerima');
      $metodeatm        = $this->input->post('metodeatm');

      // $id = '61dba0151654fd7230461938';
      $external_id = $nm_penerima.'-'.$tlp_penerima;
      $bank_code = $metodeatm;
      $name = $nm_penerima;
      //
      $va = $this->xendit->createCallbackVirtualAccount($external_id, $bank_code, $name);
      //
      // var_dump($va); die();
      //
      // $data['virtual_id'] = $va['id'];
      // $data['virtual_account'] = $va['account_number'];

      // var_dump($data['virtual_id']); die();

      $virtual_id = $va['id'];
      $virtual_account = $va['account_number'];

      // id_keranjang
      $id_keranjang     = $this->input->post('id_keranjang');
      $id_toko          = $this->input->post('id_toko');
      $id_buyer         = $this->input->post('id_buyer');
      $id_kurir_kirim   = $this->input->post('id_kurir_kirim');
      $total_transaksi  = $this->input->post('jumlah_bayar');

      $nmbank_pengirim  = $this->input->post('nmbank_pengirim');
      $norek_pengirim   = $this->input->post('norek_pengirim');
      $nmrek_pengirim   = $this->input->post('nmrek_pengirim');

      $nmbank_tujuan    = $bank_code;
      $norek_tujuan     = $virtual_account;
      $nmrek_tujuan     = $bank_code.' Virtual Account';

      // var_dump($id_keranjang); die();

      date_default_timezone_set("Asia/jakarta");

      // foreach ($id_keranjang as $key => $keranjangid) {

        $data_transaksi = array(
            // 'id_keranjang' => $keranjangid,
            'nmbank_pengirim' => $nmbank_pengirim,
            'norek_pengirim' => $norek_pengirim,
            'nmrek_pengirim' => $nmrek_pengirim,
            'id_virtual' => $virtual_id,
            'nmbank_tujuan' => $nmbank_tujuan,
            'norek_tujuan' => $norek_tujuan,
            'nmrek_tujuan' => $nmrek_tujuan,
            'total_transaksi' => $total_transaksi,
            'stts_transaksi' => '0',
            'created_by' => $this->id,
            'created_when' => date("Y-m-d H:i:s"),
        );
        // $this->db->insert(kode_tbl().'transaksi_buyer', $data_transaksi);

        if ($this->db->insert(kode_tbl().'transaksi_buyer', $data_transaksi)) {

          $id_transaksi = $this->db->insert_id();

          // $this->db->where_in('id', $keranjangid);
          // $this->db->where('stts_keranjang', '0');
          // $keranjang = $this->db->get(kode_tbl().'product_keranjang')->result();
          // foreach ($keranjang as $key => $krj) {
          //   $data['id_product'][$key] = $krj->id_product;
          //   $data['total_keranjang'][$key] = $krj->jumlah_product;
          //
          //   // $this->db->where_in('id', $krj->id_product);
          //   // $product = $this->db->get(kode_tbl().'product')->result();
          //
          //   // foreach ($product as $keyp => $prd) {
          //   //   $jumlah_terjual[$keyp] = ($prd->jumlah_terjual);
          //   // }
          //
          //   // // update product
          //   // $data_update_product = array(
          //   //     'jumlah_terjual' => $jumlah_terjual[$keyp],
          //   // );
          //   // $this->db->where_in('id', $krj->id_product);
          //   // $this->db->update(kode_tbl().'product', $data_update_product);
          //
          // }
          // $id_product = $data['id_product'];
          // $total_keranjang = $data['total_keranjang'];

          // var_dump($data['jumlah_terjual']); die();
          // var_dump($keranjang); die();



          // update kurir pengiriman
          $data_update_kurir = array(
              // 'id_transaksi' => '999',
              'id_transaksi' => $id_transaksi,
              'status_pengiriman' => '1',
              'updated_by' => $this->id,
              'updated_when' => date("Y-m-d H:i:s"),
          );
          $this->db->where_in('id_keranjang', $id_keranjang);
          // $this->db->where('status_pengiriman', '0');
          $this->db->update(kode_tbl().'kurir_pengiriman_buyer', $data_update_kurir);

          // update keranjang
          $data_update_keranjang = array(
              // 'id_transaksi' => '999',
              'id_transaksi' => $id_transaksi,
              'stts_keranjang' => '1',
              'updated_by' => $this->id,
              'updated_when' => date("Y-m-d H:i:s"),
          );
          $this->db->where_in('id', $id_keranjang);
          $this->db->update(kode_tbl().'product_keranjang', $data_update_keranjang);

          // var_dump($data['id_kp_buyer']); die();
          // var_dump($id_keranjang); die();

          $this->session->set_flashdata('result', '<b> Transaksi Berhasil. segera lakukan pembayaran ke rek '.$metodeatm.' Virtual Account. </b> ');
          $this->session->set_flashdata('mode_alert', 'success');

          $this->session->set_flashdata('text_result', 'Nomor Virtual Account : <b> '.$virtual_account.' </b> ');
          $this->session->set_flashdata('count_result', 'Total Pembayaran : <b> '.$total_transaksi.' </b> ');

          redirect('welcome/sukses_pembayaran');
        }else {

          $this->session->set_flashdata('result', 'Transaksi Gagal. Ada kesalahan dalam pengisian database. <a href="'.$base_url("buyer/keranjang").'">Lihat Keranjang</a>.');
          $this->session->set_flashdata('mode_alert', 'warning');

          $this->session->set_flashdata('text_result', '');
          $this->session->set_flashdata('count_result', '');

          redirect('welcome/sukses_pembayaran');

        }

      // }

    }

    // function sukses(){
    //     $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
    //     $data['marquee'] = $this->artikel_model->marquee();
    //
    //     $this->load->view('templates/bootstraps/header',$data);
    //     $this->load->view('templates/bootstraps/sukses',$data);
    //     $this->load->view('templates/bootstraps/bottom',$data);
    // }

    function get_kota($id){
      $kota_ro = $this->kota_ro($id);
      echo $kota_ro;
    }

    function get_tarif($kota_asal,$kota_tujuan,$berat,$kurir){
      // var_dump($kota_asal); die();

      $tarif_ro = $this->tarif_ro($kota_asal,$kota_tujuan,$berat,$kurir);
      echo $tarif_ro;

      // var_dump($tarif_ro); die();
    }

    function favorit(){
      echo "Ini data produk favorit";
    }

    function add_keranjang($id_product) {
      $id_buyer = $this->auth->get_user_data()->id_member;
      // $id = $this->input->post('id_keranjang');

      // var_dump($id_product); die();

      $this->db->where('id', $id_product);
      $product = $this->db->get(kode_tbl().'product')->row();

      $this->db->where('id_product', $id_product);
      $this->db->where('id_buyer', $id_buyer);
      $this->db->where('stts_keranjang', '0');
      $keranjang = $this->db->get(kode_tbl().'product_keranjang')->row();

      // var_dump($product->jumlah_product); die();
      // var_dump($keranjang->jumlah_product); die();
      // var_dump($keranjang); die();

      date_default_timezone_set("Asia/jakarta");

      if (empty($keranjang)) {

        $data_keranjang = array(
            'id_product' => $id_product,
            'id_buyer' => $id_buyer,
            'id_member' => $product->id_member,
            'jumlah_product' => '1',
            'created_by' => $this->id,
            'created_when' => date("Y-m-d H:i:s"),
        );
        $this->db->insert(kode_tbl().'product_keranjang', $data_keranjang);

      }else{

        $data_keranjang = array(
            'jumlah_product' => ($keranjang->jumlah_product + 1),
            'updated_by' => $this->id,
            'updated_when' => date("Y-m-d H:i:s"),
        );

        $this->db->where('id_product', $id_product);
        $this->db->where('id_buyer', $id_buyer);
        $this->db->update(kode_tbl().'product_keranjang', $data_keranjang);

      }
    }

    function tambah_keranjang($id_product,$jum_product){

      $id_buyer = $this->auth->get_user_data()->id_member;

      // var_dump($id_product); die();

      $this->db->where('id', $id_product);
      $product = $this->db->get(kode_tbl().'product')->row();

      $this->db->where('id_product', $id_product);
      $this->db->where('id_buyer', $id_buyer);
      $this->db->where('stts_keranjang', '0');
      $keranjang = $this->db->get(kode_tbl().'product_keranjang')->row();

      // var_dump($product->jumlah_product); die();
      // var_dump($keranjang->jumlah_product); die();

      date_default_timezone_set("Asia/jakarta");

      if (empty($keranjang)) {

        $data_keranjang = array(
            'id_product' => $id_product,
            'id_buyer' => $id_buyer,
            'id_member' => $product->id_member,
            'jumlah_product' => $jum_product,
            'created_by' => $this->id,
            'created_when' => date("Y-m-d H:i:s"),
        );
        $this->db->insert(kode_tbl().'product_keranjang', $data_keranjang);

      }else{

        $data_keranjang = array(
            'jumlah_product' => ($keranjang->jumlah_product + $jum_product),
            'updated_by' => $this->id,
            'updated_when' => date("Y-m-d H:i:s"),
        );

        $this->db->where('id_product', $id_product);
        $this->db->where('id_buyer', $id_buyer);
        $this->db->update(kode_tbl().'product_keranjang', $data_keranjang);

      }

    }

    // function hapus_keranjang($id){
    function hapus_keranjang($id){

      // $id = $this->input->post('id_keranjang');

      // var_dump($id); die();

      date_default_timezone_set("Asia/jakarta");

      $data_keranjang = array(
          'stts_keranjang' => '4',
          'updated_by' => $this->id,
          'updated_when' => date("Y-m-d H:i:s"),
      );

      $this->db->where('id', $id);
      $this->db->update(kode_tbl().'product_keranjang', $data_keranjang);

      // echo json_encode(['success' => 'Sukses']);
    }

    // function hapus_keranjang($id){
    function ubah_keranjang($id,$data){

      // $id = $this->input->post('matchvalue');

      // var_dump($data); die();

      date_default_timezone_set("Asia/jakarta");

      $data_keranjang = array(
          'jumlah_product' => $data,
          'updated_by' => $this->id,
          'updated_when' => date("Y-m-d H:i:s"),
      );

      $this->db->where('id', $id);
      $this->db->update(kode_tbl().'product_keranjang', $data_keranjang);

      // echo json_encode(['success' => 'Sukses']);
    }

    function tambah_favorit($id_product){

      $id_buyer = $this->auth->get_user_data()->id_member;

      $this->db->where('id', $id_product);
      $product = $this->db->get(kode_tbl().'product')->row();

      // var_dump($product); die();

      date_default_timezone_set("Asia/jakarta");

      $array_fav = array(
          'id_product' => $id_product,
          'id_buyer' => $id_buyer,
          'id_member' => $product->id_member,
          'created_by' => $this->id,
          'created_when' => date("Y-m-d H:i:s"),
      );
      // $this->db->insert(kode_tbl().'product_favorite', $array_fav);

      if ($this->db->insert(kode_tbl().'product_favorite', $array_fav)) {
        redirect(base_url() . 'home');
      }

      // redirect(base_url() . 'home');
    }

    function hapus_favorit($id){

      // var_dump($id); die();

      $this->db->where('id',$id);
      $this->db->delete(kode_tbl().'product_favorite');
      redirect(base_url() . 'home');

    }

    function update_kurir($idkeranjang,$idtoko,$idbuyer,$kurir,$estimasi,$harga){

      // var_dump($idkeranjang); die();

      // $this->db->where('id_member', $idtoko);
      // $this->db->where('id_buyer', $idbuyer);

      $this->db->where('id_keranjang', $idkeranjang);
      $this->db->where('status_pengiriman', '0');
      $kurir_pengiriman = $this->db->get(kode_tbl().'kurir_pengiriman_buyer')->row();

      date_default_timezone_set("Asia/jakarta");

      if (empty($kurir_pengiriman)) {

        $data_kp = array(
            'id_keranjang' => $idkeranjang,
            'id_buyer' => $idbuyer,
            'id_member' => $idtoko,
            'kurir_pengiriman' => $kurir,
            'est_pengiriman' => $estimasi,
            'biaya_pengiriman' => $harga,
            'status_pengiriman' => '0',
            'created_by' => $this->id,
            'created_when' => date("Y-m-d H:i:s"),
        );

        $this->db->insert(kode_tbl().'kurir_pengiriman_buyer', $data_kp);

        // if ($this->db->insert(kode_tbl().'kurir_pengiriman_buyer', $data_kp)) {
        //   redirect(base_url() . 'buyer/checkout');
        // }

      }else{

        $data_kp = array(
            'biaya_pengiriman' => $harga,
            'kurir_pengiriman' => $kurir,
            'est_pengiriman' => $estimasi,
            'updated_by' => $this->id,
            'updated_when' => date("Y-m-d H:i:s"),
        );

        $this->db->where('id_member', $idtoko);
        $this->db->where('id_buyer', $idbuyer);
        $this->db->where('status_pengiriman', '0');

        $this->db->update(kode_tbl().'kurir_pengiriman_buyer', $data_kp);

        // if ($this->db->update(kode_tbl().'kurir_pengiriman_buyer', $data_kp)) {
        //   redirect(base_url() . 'buyer/checkout');
        // }
      }

      // var_dump($kurir_pengiriman); die();
    }




    private function _api_ongkir_post($origin,$des,$qty,$cour)
   {

     // var_dump($cour); die();

  	  $curl = curl_init();
  	  curl_setopt_array($curl , array(
      CURLOPT_SSL_VERIFYPEER => 0,
      CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
  	  CURLOPT_RETURNTRANSFER => true,
  	  CURLOPT_ENCODING => "",
  	  CURLOPT_MAXREDIRS => 10,
  	  CURLOPT_TIMEOUT => 30,
  	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  	  CURLOPT_CUSTOMREQUEST => "POST",
  	  CURLOPT_POSTFIELDS => "origin=".$origin."&destination=".$des."&weight=".$qty."&courier=".$cour,
  	  CURLOPT_HTTPHEADER => array(
	    "content-type: application/x-www-form-urlencoded",
	    /* masukan api key disini*/
	    // "key: 2211ef2ed169124a1ebc6f4a502073cf"
      // "key: 8a6d401055ec5f0df6e31aad625a2e41"
      "key: 413f3069e69eb48279c31d3a2ca55200"
      // "key: d16c153b1f9cb2d662e1b872c6da9042"
      // "key: 863d42799c01fe60f3cbeb06735b849f"
      // "key: e314668b23cc7563c789b7d0f9eca598"
      // "key: 05e209faf8bc57773b22b00e60004ed0"

		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

    // var_dump($err); die();

		// curl_close($curl);

		if ($err) {
		  return $err;
		} else {
		  return $response;
		}

   }

   function _api_ongkir($data)
   {
	   	$curl = curl_init();
		  curl_setopt_array($curl, array(
		  //CURLOPT_URL => "https://api.rajaongkir.com/starter/province?id=12",
		  //CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
		  CURLOPT_URL => "http://api.rajaongkir.com/starter/".$data,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		  	/* masukan api key disini*/
		    // "key: 2211ef2ed169124a1ebc6f4a502073cf"
        // "key: 8a6d401055ec5f0df6e31aad625a2e41"
        "key: 413f3069e69eb48279c31d3a2ca55200"
        // "key: d16c153b1f9cb2d662e1b872c6da9042"
        // "key: 863d42799c01fe60f3cbeb06735b849f"
        // "key: e314668b23cc7563c789b7d0f9eca598"
        // "key: 05e209faf8bc57773b22b00e60004ed0"
		  ),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);
		if ($err) {
		  return  $err;
		} else {
		  return $response;
		}
   }

	public function provinsi_ro()
	{
		$provinsi = $this->_api_ongkir('province');
		$data = json_decode($provinsi, true);
		// return json_encode($data['rajaongkir']['results']);

    return ($data['rajaongkir']['results']);

    // var_dump(($data['rajaongkir']['results'])); die();

    // return "xxx";
	}

	// public function lokasi()
	// {
	// 	$this->load->view('head');
	// 	$this->load->view('nav');
	// 	$this->load->view('halaman');
	// 	$this->load->view('footer');
  //
	// }

	public function kota_ro($kota)
	{
		if(!empty($kota))
		{
			if(is_numeric($kota))
			{
				$kota = $this->_api_ongkir('city?id='.$kota);
				$data = json_decode($kota, true);
				return json_encode($data['rajaongkir']['results']);
			}
			else
			{
				show_404();
			}
		}
	   else
	   {
	   	show_404();
	   }
	}

	public function tarif_ro($origin,$des,$qty,$cour)
	{
		$berat = $qty*1000;
		$tarif = $this->_api_ongkir_post($origin,$des,$berat,$cour);
		$data = json_decode($tarif, true);
		// return json_encode($data['rajaongkir']['results']);

    // var_dump($berat); die();

		return json_encode($data['rajaongkir']['results']);

    // $xxx = ($data['rajaongkir']['results']);

    // var_dump(json_encode($data['rajaongkir']['results'])); die();

	}


}
