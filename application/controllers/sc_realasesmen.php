<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sc_realasesmen extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Sc_realasesmen_Model');
		$this->load->model('v_asesi');
	}
	
	function index()
	{
		$this->load->library('combogrid');
		$users = $this->combogrid->set_properties(array('model'=>'v_asesi', 'controller'=>'asesi', 'fields'=>array('nama_lengkap','u_date_create','no_identitas'), 'options'=>array('id'=>'id_asesi', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama_lengkap', 'panelWidth'=>500,
                    'queryParams'=>array('name'=>'easui') 
                    )))->load_model()->set_grid();
		//$data['id_asesi'] = $users;
		$view = $this->load->view('shortcut/realasesmen', array('id_asesi'=>$users), TRUE);
		echo json_encode(array('msgType'=>'success', 'msgValue'=>$view));
	}
	 function generate_number($total,$jadwal_id){
        $jadwal = kode_tbl().'jadual_asesmen';
        $asesi = kode_tbl().'asesi';
        $data = $this->db->query("SELECT
        DATE_FORMAT(a.tanggal,'%m-%Y') as tanggal
         FROM $jadwal a
        WHERE a.id=$jadwal_id")->row();
        
        $prefix = "UJK-".$jadwal_id."-";
        $digits = 3;
        //if($total == 0){
        //	$start = $total + 1 + $this->no_uji($jadwal_id);	
        //}else{
        	$start = $total + 1 ;
        //}
        
    
        for ($i = $start; $i < $start + 1; $i++) {
            $result = str_pad($i, $digits, "0", STR_PAD_LEFT);
        }
        $no = $prefix.$result;

        return $no.'-'.$data->tanggal;
    }
    function no_uji($jadwal_asesmen){
    	$this->db->where('no_uji_kompetensi !=','');
    	$this->db->where('jadwal_id',$jadwal_asesmen);
    	return count($this->db->get(kode_tbl().'asesi')->result());

    }
	function add()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$this->load->model('Sc_realasesmen_Model');
			$id_asesi = $this->input->post('id_asesi');
			$id_asesi2 = $this->input->post('id_asesi2');
			$id_tuk = $this->input->post('id_tuk');
			$jadwal_id = $this->input->post('jadwal_id');
			$id_asesor = $this->input->post('id_asesor');
			
			$data_realasesmen = $this->Sc_realasesmen_Model->data_asesi($id_asesi,$id_asesi2,$id_tuk);
			if(count($data_realasesmen) > 0)
			{
				//var_dump($data_realasesmen);die();
				foreach($data_realasesmen as $key=>$values){
					if($key==0){
						$key_ok = $this->no_uji($jadwal_id);
					}else{
						$key_ok = $key_ok + 1;
					}
					$no_uji_kompetensi = $this->generate_number($key_ok,$jadwal_id);
					$data=array(
							'jadwal_id'=>$jadwal_id,
							'id_asesor'=>$id_asesor,
							'no_uji_kompetensi'=>$no_uji_kompetensi
							);
					$this->db->where('id',$values->id);
					$this->db->update(kode_tbl().'asesi',$data);
				}
				echo json_encode(array('msgType'=>'success', 'msgValue'=>'Data berhasil disimpan !'));			
			}else
			{
				echo json_encode(array('msgType'=>'error', 'msgValue'=>'Data tidak ditemukan. Harus lolos administrasi atau  teliti lagi RANGE asesi nya !'));
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
			  $asesor_grid = $this->combogrid->set_properties(array('model' => 'asesor_model', 'controller' => 'asesor', 'fields' => array('users', 'no_reg'), 'options' => array('id' => 'id_asesor', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'users', 'panelWidth' => 500)))->load_model()->set_grid();
			 $jadwal_grid = $this->combogrid->set_properties(array('model' => 'jadwal_asesmen_model', 'controller' => 'jadwal_asesmen', 'fields' => array('jadual', 'tanggal'), 'options' => array('id' => 'jadwal_id', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'jadual', 'panelWidth' => 500)))->load_model()->set_grid();
                
			$view = $this->load->view('shortcut/realasesmen', array('jadwal_grid' => $jadwal_grid,'id_tuk'=>$tuk_grid,'id_asesi'=>$users,'id_asesi2'=>$users2,
				'asesor_grid' => $asesor_grid,'realasesmen_ujk' => array('-','Selesai','Belum Selesai')
                ,'sumber_pendanaan' => array('-','Subsidi BNSP','Mandiri','Lain-lain')), TRUE);
			echo json_encode(array('msgType'=>'success', 'msgValue'=>$view, 'title'=>'Shortcut realasesmen', 'width'=>600, 'height'=>400));
		}
	}
	 function sms($nama_lengkap,$checked,$users){
        $pesan = 'Anda Mendapat Tugas untuk memeriksa Dokumen pra asesmen atas nama '.$nama_lengkap;
        
        $this->db->where('id',$checked);
        $row = $this->db->get('t_users')->row();
        
        $data['sender_id'] = 1;
        $data['reciepent_id'] = $checked ;
        $data['title'] = 'Tugas Check Pra Asesmen' ;
        $data['message'] = $pesan ;
        
        $this->load->model('Pesan_Model');
        $this->Pesan_Model->insert($data);
        //smssend($row->hp,$pesan);
        
        
        $this->db->where('id',$users);
        $row = $this->db->get('t_users')->row();
        $username = $row->akun;
        $password = $row->sandi_asli;
        //var_dump($password);die();
        $admin = $this->db->get('r_konfigurasi_aplikasi')->row();
        $pesan = 'Login '.$admin->url_aplikasi.' User:'.$username.' Pass:'.$password;
        $data['sender_id'] = $this->auth->get_user_data()->id;
        $data['reciepent_id'] = $users ;
        $data['title'] = 'Akses Login Aplikasi' ;
        $data['message'] = $pesan ;
        
        $this->load->model('Pesan_Model');
        $this->Pesan_Model->insert($data);
        //$hasil = smssend($row->hp,$pesan);
    }
}	