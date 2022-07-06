<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jadwal_ujk extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('jadwal_asesmen_model');
		$this->load->model('artikel_model');
		$this->load->library('pagination');
	}

	function view($id=0,$offset=0) {
		$data['berita_lainnya'] = $this->artikel_model->berita_lainnya();
		$data['berita_lsp_pilihan'] = $this->artikel_model->berita_lsp_pilihan();
		$data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
		$data['berita_lsp_list'] = $this->artikel_model->berita_lsp_list();

		$keyword=$this->input->get('keyword');
		if($keyword==""){
				$offset = $this->uri->segment(4);
				$this->db->where('status_jadwal',1);
				$jml = $this->db->get(kode_tbl().'jadual_asesmen');
				$data['jmldata'] = $jml->num_rows();
				// var_dump($data['jmldata']); die();
				//pengaturan pagination
				$config['enable_query_strings'] = true;
				$config['base_url'] = base_url().'jadwal_ujk/view/'.$id;
				$config['total_rows'] = $jml->num_rows();
				$config['per_page'] = 10;
				$config['first_page'] = 'Awal';
				$config['last_page'] = 'Akhir';
				$config['next_page'] = '&laquo;';
				$config['prev_page'] = '&raquo;';
				$config['uri_segment'] = 4;
				//inisialisasi config
				$this->pagination->initialize($config);
				//buat pagination
				$data['halaman'] = $this->pagination->create_links();
				$data['data'] = $this->jadwal_asesmen_model->get_all_jadwal($config['per_page'],$offset);
				// var_dump($data['halaman']); die();
		}else{
				$offset = $this->uri->segment(3);
				$this->db->where('status_jadwal',1);
				$this->db->like('jadual', $keyword);
				$jml = $this->db->get(kode_tbl().'jadual_asesmen');
				$data['jmldata'] = $jml->num_rows();
				//var_dump($data['jmldata']); die();
				//pengaturan pagination
				$config['enable_query_strings'] = true;
				if(!empty($keyword)){
						$config['suffix'] = "?keyword=".$keyword;
				}

				$config['base_url'] = base_url().'jadwal_ujk/view/'.$id;
				$config['total_rows'] = $jml->num_rows();
				$config['per_page'] = 10;
				$config['first_page'] = 'Awal';
				$config['last_page'] = 'Akhir';
				$config['next_page'] = '&laquo;';
				$config['prev_page'] = '&raquo;';
				$config['uri_segment'] = 4;
				//inisialisasi config
				$this->pagination->initialize($config);
				//buat pagination
				$data['halaman'] = $this->pagination->create_links();
				$data['data'] = $this->jadwal_asesmen_model->get_all_jadwal($config['per_page'],$offset,$keyword);
		}

		$this->load->view('templates/bootstraps/header',$data);
		$this->load->view('jadwal_asesmen/vjadwal', $data);
		$this->load->view('templates/bootstraps/bottom', $data);
	}

}
