<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Media extends MY_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('artikel_model');
        $this->load->model('album_model');
    }
	function index($id) {
		$data['galeri'] = $this->album_model->get_gallery();
		//var_dump($data['galeri']->foto); die();
		$data['data'] = $this->artikel_model->get_detail($id);
		$data['berita_lainnya'] = $this->artikel_model->berita_lainnya();
		$data['lembaga_terkait'] = $this->artikel_model->get_link(2);
		$data['link_populer'] = $this->artikel_model->get_link(1);
		$data['lsp_jejaring'] = $this->artikel_model->get_link(3);
		
		//var_dump($data['berita_lainnya']);
		//die();
		$data_header['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row(); 
	    $this->load->view('templates/bootstraps/header',$data_header);
	    $this->load->view('artikel/vdetail_media',$data);
	    $this->load->view('templates/bootstraps/bottom');    
	}
}
