<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Pembayaran extends MY_Controller {


	function __construct()

	{
		parent::__construct();
		$this->load->model('pembayaran_model');
	}
	function invoice()
    {
        $template_header = 'templates/responsive/header';
        $template_body = 'templates/responsive/pembayaran/invoice';
        $template_bottom = 'templates/responsive/footer';
        $riwayat_sertifikasi = $this->pembayaran_model->riwayat_sertifikasi($this->id);
        //var_dump($riwayat_sertifikasi);die();
        $this->load->view($template_header, array('aplikasi'=>$this->aplikasi,'query_pesan'=>$this->query_pesan,'query_pesan_unread'=>$this->query_pesan_unread));
        $this->load->view($template_body, array('aplikasi'=>$this->aplikasi,'unread_message'=>$this->unread_message,'menus'=>$this->menus, 'rolename'=>$this->auth->get_rolename(), 'nama_user'=>$this->auth->get_user_data()->nama,'riwayat_sertifikasi'=>$riwayat_sertifikasi));
        $this->load->view($template_bottom, array('aplikasi'=>$this->aplikasi));
    }
    function detail($id)
    {
        $template_header = 'templates/responsive/header';
        $template_body = 'templates/responsive/pembayaran/detail';
        $template_bottom = 'templates/responsive/footer';
        $riwayat_sertifikasi = $this->pembayaran_model->riwayat_sertifikasi_detail($id);
        //var_dump($this->auth->get_user_data());die();
        //var_dump($riwayat_sertifikasi);die();
        $this->load->view($template_header, array('aplikasi'=>$this->aplikasi,'query_pesan'=>$this->query_pesan,'query_pesan_unread'=>$this->query_pesan_unread));
        $this->load->view($template_body, array('aplikasi'=>$this->aplikasi,'unread_message'=>$this->unread_message,'menus'=>$this->menus, 'rolename'=>$this->auth->get_rolename(), 'nama_user'=>$this->auth->get_user_data()->nama,'riwayat_sertifikasi'=>$riwayat_sertifikasi));
        $this->load->view($template_bottom, array('aplikasi'=>$this->aplikasi));
    }
}