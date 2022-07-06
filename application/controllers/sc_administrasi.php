<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sc_administrasi extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Sc_Administrasi_Model');
		$this->load->model('v_asesi');
	}
	
	function index()
	{
		$this->load->library('combogrid');
		$users = $this->combogrid->set_properties(array('model'=>'v_asesi', 'controller'=>'asesi', 'fields'=>array('nama_lengkap','u_date_create','no_identitas'), 'options'=>array('id'=>'id_asesi', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama_lengkap', 'panelWidth'=>500,
                    'queryParams'=>array('name'=>'easui') 
                    )))->load_model()->set_grid();
		//$data['id_asesi'] = $users;
		$view = $this->load->view('shortcut/administrasi', array('id_asesi'=>$users), TRUE);
		echo json_encode(array('msgType'=>'success', 'msgValue'=>$view));
	}
	
	function add()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$this->load->model('Sc_Administrasi_Model');
			$id_asesi = $this->input->post('id_asesi');
			$id_asesi2 = $this->input->post('id_asesi2');
			$id_tuk = $this->input->post('id_tuk');
			$administrasi_ujk = $this->input->post('administrasi_ujk');
			$sumber_pendanaan = $this->input->post('sumber_pendanaan');
			
			
			$data_administrasi = $this->Sc_Administrasi_Model->data_asesi($id_asesi,$id_asesi2,$id_tuk);
			
			if(count($data_administrasi) > 0)
			{
				//var_dump($data_administrasi);die();
				foreach($data_administrasi as $key=>$values){
					$data=array(
							'administrasi_ujk'=>$administrasi_ujk,
							'sumber_pendanaan'=>$sumber_pendanaan
							);
					$this->db->where('id',$values->id);
					$this->db->update(kode_tbl().'asesi',$data);
				}
				echo json_encode(array('msgType'=>'success', 'msgValue'=>'Data berhasil disimpan !'));			
			}else
			{
				echo json_encode(array('msgType'=>'error', 'msgValue'=>'Data tidak ditemukan. Harus lolos pra asesmen atau  teliti lagi RANGE asesi nya !'));
			}
		}
		else
		{
			$this->load->library('combogrid');
		    $users = $this->combogrid->set_properties(array('model'=>'v_asesi', 'controller'=>'asesi', 'fields'=>array('nama_lengkap','u_date_create','no_identitas'), 'options'=>array('id'=>'id_asesi', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama_lengkap', 'panelWidth'=>500,
                    'queryParams'=>array('name'=>'easui') 
                    )))->load_model()->set_grid();
			$tuk_grid = $this->combogrid->set_properties(array('model' => 'tuk_model', 'controller' => 'tuk', 'fields' => array('tuk', 'alamat'), 'options' => array('id' => 'id_tuk', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'tuk', 'panelWidth' => 500)))->load_model()->set_grid();
                
			 $users2 = $this->combogrid->set_properties(array('model'=>'v_asesi', 'controller'=>'asesi', 'fields'=>array('nama_lengkap','u_date_create','no_identitas'), 'options'=>array('id'=>'id_asesi2', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama_lengkap', 'panelWidth'=>500,
			'queryParams'=>array('name'=>'easui') 
			)))->load_model()->set_grid();
		//$data['id_asesi'] = $users;
			$view = $this->load->view('shortcut/administrasi', array('id_tuk'=>$tuk_grid,'id_asesi'=>$users,'id_asesi2'=>$users2,'administrasi_ujk' => array('-','Selesai','Belum Selesai')
                ,'sumber_pendanaan' => array('-','Subsidi BNSP','Mandiri','Lain-lain')), TRUE);
			echo json_encode(array('msgType'=>'success', 'msgValue'=>$view, 'title'=>'Shortcut Admnistrasi', 'width'=>600, 'height'=>400));
		}
	}
	
}	