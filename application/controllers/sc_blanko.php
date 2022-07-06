<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sc_blanko extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Sc_blanko_Model');
		$this->load->model('v_asesi');
	}
	
	function index()
	{
		$this->load->library('combogrid');
		$users = $this->combogrid->set_properties(array('model'=>'v_asesi', 'controller'=>'asesi', 'fields'=>array('nama_lengkap','u_date_create','no_identitas'), 'options'=>array('id'=>'id_asesi', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama_lengkap', 'panelWidth'=>500,
                    'queryParams'=>array('name'=>'easui') 
                    )))->load_model()->set_grid();
		//$data['id_asesi'] = $users;
		$view = $this->load->view('shortcut/blanko', array('id_asesi'=>$users), TRUE);
		echo json_encode(array('msgType'=>'success', 'msgValue'=>$view));
	}
	
	function add()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$this->load->model('Sc_blanko_Model');
			$id_asesi = $this->input->post('id_asesi');
			$id_asesi2 = $this->input->post('id_asesi2');
			$id_tuk = $this->input->post('id_tuk');
			$skema = $this->input->post('skema');
			$order = $this->input->post('order');
			
			$data_blanko = $this->Sc_blanko_Model->data_asesi($id_asesi,$id_asesi2,$skema);
			
			if(count($data_blanko) > 0)
			{
				//var_dump($data_blanko);die();
				foreach($data_blanko as $key=>$values){
					if($key > 0 && $key < (count($data_blanko) - 1)){
						if($order == '0'){
							$no_seri = $no_seri - 1;	
						}else{
							$no_seri = $no_seri + 1;	
						}
						
						$data=array(
							'no_seri'=>$no_seri,
							);
						$this->db->where('id',$values->id);
						$this->db->update(kode_tbl().'asesi',$data);
					}else{
						$no_seri = $values->no_seri;
					}
					
					
				}
				echo json_encode(array('msgType'=>'success', 'msgValue'=>'Data berhasil disimpan !'));			
			}else
			{
				echo json_encode(array('msgType'=>'error', 'msgValue'=>'Data tidak ditemukan. Pastikan sudah diterbitkan sertifikat atau  teliti lagi RANGE asesi nya !'));
			}
		}
		else
		{
			$this->load->library('combogrid');
		    $users = $this->combogrid->set_properties(array('model'=>'v_asesi', 'controller'=>'asesi', 'fields'=>array('nama_lengkap','u_date_create','no_identitas'), 'options'=>array('id'=>'id_asesi', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama_lengkap', 'panelWidth'=>500,
                    'queryParams'=>array('name'=>'easui') 
                    )))->load_model()->set_grid();
				 $users2 = $this->combogrid->set_properties(array('model'=>'v_asesi', 'controller'=>'asesi', 'fields'=>array('nama_lengkap','u_date_create','no_identitas'), 'options'=>array('id'=>'id_asesi2', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama_lengkap', 'panelWidth'=>500,
			'queryParams'=>array('name'=>'easui') 
			)))->load_model()->set_grid();
		//$data['id_asesi'] = $users;
				$this->load->model('skema_model');
                $skema = $this->skema_model->dropdown('id', 'skema');
                 
			$view = $this->load->view('shortcut/blanko', array('skema'=>$skema,'id_asesi'=>$users,'id_asesi2'=>$users2,'order' => array('Turun','Naik')
                ), TRUE);
			echo json_encode(array('msgType'=>'success', 'msgValue'=>$view, 'title'=>'Shortcut Blanko', 'width'=>600, 'height'=>400));
		}
	}
	
}	