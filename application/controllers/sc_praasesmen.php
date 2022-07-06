<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sc_praasesmen extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Sc_praasesmen_Model');
		$this->load->model('v_asesi');
	}
	
	function index()
	{
		$this->load->library('combogrid');
		$users = $this->combogrid->set_properties(array('model'=>'v_asesi', 'controller'=>'asesi', 'fields'=>array('nama_lengkap','u_date_create','no_identitas'), 'options'=>array('id'=>'id_asesi', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama_lengkap', 'panelWidth'=>500,
                    'queryParams'=>array('name'=>'easui') 
                    )))->load_model()->set_grid();
		//$data['id_asesi'] = $users;
		$view = $this->load->view('shortcut/praasesmen', array('id_asesi'=>$users), TRUE);
		echo json_encode(array('msgType'=>'success', 'msgValue'=>$view));
	}
	
	function add()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$this->load->model('Sc_praasesmen_Model');
			$id_asesi = $this->input->post('id_asesi');
			$id_asesi2 = $this->input->post('id_asesi2');
			$id_tuk = $this->input->post('id_tuk');
			$perangkat = serialize($this->input->post('perangkat'));
			$pra_asesmen = $this->input->post('pra_asesmen');
			$pra_asesmen_date = array_reverse(explode("/", $this->input->post('pra_asesmen_date')));
			$pra_asesmen_date = implode('-', $pra_asesmen_date);

			$pra_asesmen_description = $this->input->post('pra_asesmen_description');

			$data_praasesmen = $this->Sc_praasesmen_Model->data_asesi($id_asesi,$id_asesi2,$id_tuk);
			//var_dump($data_praasesmen);die();
			if(count($data_praasesmen) > 0)
			{
				//var_dump($data_praasesmen);die();
				foreach($data_praasesmen as $key=>$values){
						$data_udpate=array(
							'pra_asesmen'=>$pra_asesmen,
							'pra_asesmen_date'=>$pra_asesmen_date,
							'pra_asesmen_description'=>$pra_asesmen_description,
							'perangkat'=>$perangkat,

							);
						$this->db->where('id',$values->id);
						$this->db->update(kode_tbl().'asesi',$data_udpate);

					    $this->db->where('asesi_id',$values->id);
                        $asesi= $this->db->get(kode_tbl().'asesi_detail')->result_array();
                        foreach($asesi as $key=>$value){
                            $data_update = array(
                                       'v' => '1',
                                       'a' => '1',
                                       't' => '1',
                                       'm' => '0',
                                    );
                            
                            $this->db->where('id', $value['id']);
                            $this->db->update(kode_tbl().'asesi_detail', $data_update); 
                        }
                        
                        /*$sms = isset($_POST['kirim_notifikasi']) ? $this->input->post('kirim_notifikasi') : "";
                        if($sms != ""){
                            $id_users = $values->id_users;
                            $rekomendasi = $this->input->post('pra_asesmen_description');
                            $pra_asesmen = $this->input->post('pra_asesmen');
                            
                            $this->sms($id_users,$rekomendasi,$pra_asesmen);
                        }*/
				}
				echo json_encode(array('msgType'=>'success', 'msgValue'=>'Data berhasil disimpan !'));			
			}else
			{
				echo json_encode(array('msgType'=>'error', 'msgValue'=>'Data tidak ditemukan. Harus sudah di tunjuk asesornya atau  teliti lagi RANGE asesi nya !'));
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
			 $data_perangkat = array('Pertanyaan Lisan','Pertanyaan Tulisan','Observasi / Praktek','Wawancara','Cek Portofolio');
                
			$view = $this->load->view('shortcut/praasesmen', array('id_tuk'=>$tuk_grid,'id_asesi'=>$users,'id_asesi2'=>$users2,'data_perangkat'=>$data_perangkat,'pra_asesmen' => array('-Pilih-', 'Lanjut', 'Tidak Lanjut')), TRUE);
			echo json_encode(array('msgType'=>'success', 'msgValue'=>$view, 'title'=>'Shortcut Pra Asesmen', 'width'=>600, 'height'=>400));
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