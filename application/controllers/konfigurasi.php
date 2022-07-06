<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Konfigurasi extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Konfigurasi_Model');
	}
	
	function index()
	{
		block_access_method();
	}
	
	function add()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$this->load->model('Konfigurasi_Model');
			$configs = $this->Konfigurasi_Model->get(1);
			$data = $this->Konfigurasi_Model->set_validation()->validate();
			if($data !== false)
			{
				if(sizeof($configs) == 1)
				{
					$config = $this->Konfigurasi_Model->get_single($configs);
					$id = $this->Konfigurasi_Model->update($config->id, $data);
				}
				else
				{
					$id = $this->Konfigurasi_Model->insert($data);
				}
				if($id !== false)
				{
					echo json_encode(array('msgType'=>'success', 'msgValue'=>'Data berhasil disimpan !'));
				}
				else
				{
					echo json_encode(array('msgType'=>'error', 'msgValue'=>'Data tidak dapat disimpan !'));
				}
			}
			else
			{
				echo json_encode(array('msgType'=>'error', 'msgValue'=>validation_errors()));
			}
		}
		else
		{
			$id = $this->Konfigurasi_Model->get(1);
			$data = sizeof($id) == 1 ? $this->Konfigurasi_Model->get_single($id) : "";
			$view = $this->load->view('konfigurasi/add', array('data'=>$data), TRUE);
			echo json_encode(array('msgType'=>'success', 'msgValue'=>$view, 'title'=>'Konfigurasi Aplikasi', 'width'=>850, 'height'=>450));
		}
	}
	
}	