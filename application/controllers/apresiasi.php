<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Apresiasi extends MY_Controller {

	function __construct(){
		parent::__construct();
	}

	function index(){
		// tubagus aom
	}

	function view()
	{
		$data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
	    $this->load->view('templates/bootstraps/header',$data);
	    $this->load->view('apresiasi/view',$data);
	    $this->load->view('templates/bootstraps/bottom');
	}

}
