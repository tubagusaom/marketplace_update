<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Profile extends MY_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('artikel_model');
    }

	function index($id) {
		$data['data'] = $this->artikel_model->detail($id);
		$data['berita_lainnya'] = $this->artikel_model->berita_lainnya($id);
		$data['berita_lsp_lainnya'] = $this->artikel_model->berita_lsp_lainnya($id);
		$data['berita_lsp_pilihan'] = $this->artikel_model->berita_lsp_pilihan();
		$data['marquee'] = $this->artikel_model->marquee();
		$data['lembaga_terkait'] = $this->artikel_model->get_link(2);
		$data['link_populer'] = $this->artikel_model->get_link(1);
		$data['lsp_jejaring'] = $this->artikel_model->get_link(3);

        $data['berita_lsp_list'] = $this->artikel_model->berita_lsp_list();
		//var_dump($data['berita_lainnya']);
		//die();
		$data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
	    $this->load->view('templates/bootstraps/header',$data);
	    $this->load->view('profile/index',$data);
	    $this->load->view('templates/bootstraps/bottom');
	}
}
