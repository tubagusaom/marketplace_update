<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Tamansari_garden extends MY_Controller {

		function __construct() {
			parent::__construct();
		}

		public function index() {
			$data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();

			// var_dump($data['menu']); die();

			$this->load->view('templates/tamansari/header',$data);
			$this->load->view('templates/tamansari/body',$data);
			$this->load->view('templates/tamansari/bottom',$data);
		}

	}
