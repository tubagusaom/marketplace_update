<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Jadwal extends MY_Controller {


	function __construct()
	{
		parent::__construct();
		$this->load->model('jadwal_model');
	}

	function index()
	{
		$template_header = 'templates/responsive/header';
    	$template_body = 'templates/responsive/jadwal/index';
    	$template_bottom = 'templates/responsive/footer';
        $list_jadwal = $this->jadwal_model->list_jadwal();
		$this->load->view($template_header, array('aplikasi'=>$this->aplikasi,'query_pesan'=>$this->query_pesan,'query_pesan_unread'=>$this->query_pesan_unread));
		$this->load->view($template_body, array('aplikasi'=>$this->aplikasi,'unread_message'=>$this->unread_message,'menus'=>$this->menus, 'rolename'=>$this->auth->get_rolename(), 'nama_user'=>$this->auth->get_user_data()->nama,'list_jadwal'=>$list_jadwal));
		$this->load->view($template_bottom, array('aplikasi'=>$this->aplikasi));
	}

	function registrasi($id="") {
		$template_header = 'templates/responsive/header';
		if($id==""){
			$template_body = 'templates/responsive/jadwal/registrasi_baru';
		}else{
			$template_body = 'templates/responsive/jadwal/registrasi';
		}

    	$template_bottom = 'templates/responsive/footer';
        $row_jadwal = $this->jadwal_model->row_jadwal($id);
        $row_skema = $this->jadwal_model->row_skema();

        $row_jadwal_combo = $this->jadwal_model->row_jadwal_combo();
        $data['row_jadwal_combo'] = $row_jadwal_combo;
        $data['row_skema'] = $row_skema;

        $this->load->model('profil_model');
        $biodata = $this->profil_model->biodata($this->id);
				$data['biodata'] = $biodata;
        $data['row_jadwal'] = $row_jadwal;
        $data['aplikasi'] = $this->aplikasi;


    $this->load->view($template_header, array('aplikasi'=>$this->aplikasi,'query_pesan'=>$this->query_pesan,'query_pesan_unread'=>$this->query_pesan_unread));
		$this->load->view($template_body, $data);
		$this->load->view($template_bottom, array('aplikasi'=>$this->aplikasi));
	}

	function add(){
		$skema = $this->input->post('skema_sertifikasi');
		$jadwal = $this->input->post('id_jadwal');
		$metode_bayar = $this->input->post('metode_bayar');

		$id = $this->id;
		$asesi = kode_tbl().'asesi';
		$this->db->where('id_users',$id);
		$this->db->where('jadwal_id',$jadwal);
		$query_jadwal = $this->db->get(kode_tbl().'asesi')->result();
		if(count($query_jadwal) > 0){
			$this->session->set_flashdata('result', 'Pendaftaran Gagal, anda sudah terdaftar di jadwal ini');
           			 $this->session->set_flashdata('mode_alert', 'warning');
           			 redirect('home/sukses');
		}else{
			$query = $this->db->query("INSERT INTO $asesi(skema_sertifikasi,jadwal_id,nama_lengkap,created_when,id_users,metode_bayar) SELECT $skema,$jadwal,nama_user,NOW(),$id,$metode_bayar FROM t_users WHERE id=$id");
			if($query){
				$id = $this->db->insert_id();
				redirect('sertifikasi/detail/'.$id);
			}else{
				$this->session->set_flashdata('result', 'Pendaftaran Gagal, anda sudah terdaftar di jadwal ini');
	           			 $this->session->set_flashdata('mode_alert', 'warning');
	           			 redirect('home/sukses');
			}
		}
	}

	function riwayat_sertifikasi() {
		$template_header = 'templates/responsive/header';
    	$template_body = 'templates/responsive/jadwal/index';
    	$template_bottom = 'templates/responsive/footer';
        $list_jadwal = $this->jadwal_model->list_jadwal();
		$this->load->view($template_header, array('aplikasi'=>$this->aplikasi,'query_pesan'=>$this->query_pesan,'query_pesan_unread'=>$this->query_pesan_unread));
		$this->load->view($template_body, array('aplikasi'=>$this->aplikasi,'unread_message'=>$this->unread_message,'menus'=>$this->menus, 'rolename'=>$this->auth->get_rolename(), 'nama_user'=>$this->auth->get_user_data()->nama,'list_jadwal'=>$list_jadwal));
		$this->load->view($template_bottom, array('aplikasi'=>$this->aplikasi));
	}

}
