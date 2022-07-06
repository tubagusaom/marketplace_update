<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Siswa_profile extends MY_Controller {


	function __construct()

	{
		parent::__construct();
        //session_start();
        $this->load->model('Siswa_Model');

	}
   function index() {      
        $id = $this->auth->get_user_data()->pegawai_id;
        //var_dump($id);die();
        $parsing_data['data_siswa'] = $this->Siswa_Model->siswa_profil($id);
        //var_dump($parsing_data['data_siswa']);
        //die();                
        $view = $this->load->view('siswa/siswa_profil', $parsing_data, true);
        echo json_encode(array('msgType'=>'success', 'msgValue'=>$view));
    }
}