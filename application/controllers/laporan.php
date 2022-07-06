<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Laporan extends MY_Controller {


	function __construct()

	{
		parent::__construct();
		$this->load->model('artikel_model');
		$this->load->model('laporan_model');
	}
	function skema_sertifikasi(){
		$data['marquee'] = $this->artikel_model->marquee();
        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row(); 
        
		$data['total_skema'] = $this->laporan_model->skema_sertifikasi();
		$total_skema = $data['total_skema'];

		foreach($total_skema as $value){
		    $dtstr[]=array($value['name'],(int)$value['data']);
		  }
		  
	    $dtstring = json_encode($dtstr);
  		$data['dtstring'] = $dtstring;
  		//var_dump($data['dtstring']);
  		//die();
		$this->load->view('templates/bootstraps/header',$data);
        $this->load->view('laporan/vskema',$data);
        $this->load->view('templates/bootstraps/bottom');
	}
}