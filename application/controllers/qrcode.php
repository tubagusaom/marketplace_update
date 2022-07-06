<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Qrcode extends MY_Controller {


	function __construct()

	{
		parent::__construct();
		$this->load->model('artikel_model');
		$this->load->model('pra_asesmen_model');
		

	}
	function asesor($id){

		$data['marquee'] = $this->artikel_model->marquee();
            
        $data['data'] = $this->pra_asesmen_model->asesor_pra_asesmen($id);
        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row(); 
        //$this->load->view('templates/bootstraps/header',$data);
        $this->load->view('asesor/qr_asesor',$data);
        //$this->load->view('templates/bootstraps/bottom');
	}
	function asesor_uji($id){

		$data['marquee'] = $this->artikel_model->marquee();
            
        $data['data'] = $this->pra_asesmen_model->asesor_uji($id);
        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row(); 
        //$this->load->view('templates/bootstraps/header',$data);
        $this->load->view('asesor/qr_asesor',$data);
        //$this->load->view('templates/bootstraps/bottom');
	}
	function asesi($id){

		$data['marquee'] = $this->artikel_model->marquee();
            
        $data['data'] = $this->pra_asesmen_model->asesi($id);
        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row(); 
        //$this->load->view('templates/bootstraps/header',$data);
        $this->load->view('asesor/qr_asesi',$data);
        //$this->load->view('templates/bootstraps/bottom');
	}
}