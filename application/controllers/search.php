<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends MY_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model('product_model');
		$this->load->model('welcome_model');
	}

	function index($id=0,$offset=0){

		$id_member = $this->auth->get_user_data()->id_member;
		$data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();

		$data['pengunjung'] = $this->welcome_model->dataPengunjung();
		$data['total'] = $this->welcome_model->totalPengunjung();
		$data['rst'] = array();

		$data['menu'] = $this->welcome_model->menu();
		$data['kategori'] = $this->welcome_model->kategori();
		$data['sub_kategori'] = $this->welcome_model->sub_kategori();

		$data['keranjang_buyer'] = $this->welcome_model->keranjang_buyer($id_member);

		$keranjang_buyer = $data['keranjang_buyer'];

		$data_toko = "";
		$total_keranjang ="";
		foreach ($keranjang_buyer as $key => $keranjang) {
			$total_keranjang += $keranjang->jumlah_product;
		}

		if ($total_keranjang == "") {
			$data['total_keranjang'] = '0';
		}else {
			$data['total_keranjang'] = $total_keranjang;
		}

		$data['keyword']=$this->input->get('q');

		if (empty($id_member)) {
			$header = 'bootstraps/header';
			$filpro = "filter";
		}else {
			$header = 'buyer/header';
			$filpro = "filter_buyer";
		}

		$this->load->view('templates/'.$header,$data);
		$this->load->view('product/search');
		$this->load->view('templates/bootstraps/bottom',$data);


	}

	function filter($k=false,$id_k=false,$k1=false,$id_k1=false,$k2=false,$id_k2=false) {

		$id_member = $this->auth->get_user_data()->id_member;

		$data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();

		$data['pengunjung'] = $this->welcome_model->dataPengunjung();
		$data['total'] = $this->welcome_model->totalPengunjung();
		$data['rst'] = array();

		$data['slide_count'] = $this->welcome_model->slide_total();
		$data['slideshow'] = $this->welcome_model->slide_show();
		$data['showiklan'] = $this->welcome_model->show_iklan();

		$data['menu'] = $this->welcome_model->menu();
		$data['kategori'] = $this->welcome_model->kategori();
		$data['sub_kategori'] = $this->welcome_model->sub_kategori();

		$data['keranjang_buyer'] = $this->welcome_model->keranjang_buyer($id_member);

		$keranjang_buyer = $data['keranjang_buyer'];

		$data_toko = "";
		$total_keranjang ="";
		foreach ($keranjang_buyer as $key => $keranjang) {
			$total_keranjang += $keranjang->jumlah_product;
		}

		if ($total_keranjang == "") {
			$data['total_keranjang'] = '0';
		}else {
			$data['total_keranjang'] = $total_keranjang;
		}

		$data['show_filter_product'] = $this->product_model->show_filter_product($k,$id_k,$k1,$id_k1,$k2,$id_k2);

		$menu_k   = $k;
		$menu_id  = $id_k;
		$kat_k    = $k1;
		$kat_id   = $id_k1;
		$sub_k    = $k2;
		$sub_id   = $id_k2;

		if (!empty($menu_id) AND !empty($kat_k) AND !empty($sub_id)) {
			$data['ket_filter'] = $sub_k;
		}elseif (!empty($menu_id) AND !empty($kat_k)) {
			$data['ket_filter'] = $kat_k;
		}elseif (!empty($menu_id)) {
			$data['ket_filter'] = $menu_k;
		}

		// var_dump($menu_id); die();
		// var_dump($data['ket_filter']); die();


		if (empty($id_member)) {
			$header = 'bootstraps/header';
			$filpro = "filter";
		}else {
			$header = 'buyer/header';
			$filpro = "filter_buyer";
		}

		// var_dump($data['show_filter_product']); die();
		// var_dump($id_member); die();

		$this->load->view('templates/'.$header,$data);
		// $this->load->view('templates/bootstraps/body',$data);
		$this->load->view('product/'.$filpro,$data);
		$this->load->view('templates/bootstraps/bottom_filter',$data);
	}

}
