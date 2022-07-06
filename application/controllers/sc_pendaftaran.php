<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sc_pendaftaran extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Sc_pendaftaran_Model');
        $this->load->model('v_asesi');
    }
    
    function index()
    {
        $this->load->library('combogrid');
        $users = $this->combogrid->set_properties(array('model'=>'v_asesi', 'controller'=>'asesi', 'fields'=>array('nama_lengkap','u_date_create','no_identitas'), 'options'=>array('id'=>'id_asesi', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama_lengkap', 'panelWidth'=>500,
                    'queryParams'=>array('name'=>'easui') 
                    )))->load_model()->set_grid();
        //$data['id_asesi'] = $users;
        $view = $this->load->view('shortcut/pendaftaran', array('id_asesi'=>$users), TRUE);
        echo json_encode(array('msgType'=>'success', 'msgValue'=>$view));
    }
    
    function add()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $this->load->model('Sc_pendaftaran_Model');
            $id_asesi = $this->input->post('id_asesi');
            $id_asesi2 = $this->input->post('id_asesi2');
            $id_tuk = $this->input->post('id_tuk');
            $pra_asesmen_checked = $this->input->post('pra_asesmen_checked');
            
            $data_pendaftaran = $this->Sc_pendaftaran_Model->data_asesi($id_asesi,$id_asesi2,$id_tuk);
            
            if(count($data_pendaftaran) > 0)
            {
                //var_dump($data_pendaftaran);die();
                foreach($data_pendaftaran as $key=>$values){
                    $data=array(
                            'pra_asesmen_checked'=>$pra_asesmen_checked,
                            );
                    $this->db->where('id',$values->id);
                    $this->db->update(kode_tbl().'asesi',$data);

                            $nama_lengkap = $values->nama_lengkap;
                            $email = $values->email;
                            $hp = $values->telp;
                            $nama =   str_replace(' ','',strtolower($nama_lengkap));
                            if(strlen($nama) > 4){
                                $datax['akun'] =  substr($nama, 0, 4).rand(1,9999);
                            }else{
                                $datax['akun'] =  $nama.rand(1,9999);
                            }
                            
                            
                            $datax['email'] = $email ;
                            $datax['hp'] = $hp ;
                            $datax['nama_user'] = $nama_lengkap ;
                            $datax['jenis_user'] = '1' ;
                            $datax['sandi'] = '123456' ;
                            $datax['sandi_asli'] = '123456' ;
                            $datax['aktif'] = '1' ;
                            $datax['pegawai_id'] = $values->id ;
                            
                            $this->load->model('User_Model');
                            $this->User_Model->insert($datax);
                            $user_id= $this->db->insert_id();
                            
                            $datay['user_id'] = $user_id; 
                            $datay['role_id'] = 17;
                            $this->load->model('User_Role_Model');
                            $this->User_Role_Model->insert($datay);
                            
                            //if($jenis_user == '1'){
                                //$id_users = $this->db->insert_id();
                                $dataxy = array(
                                               'id_users' => $user_id
                                            );
                                $this->db->where('id', $values->id);
                                $this->db->update(kode_tbl().'asesi', $dataxy);
    
                            //} 
                        
                            $this->sms($nama_lengkap,$pra_asesmen_checked,$user_id);
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
             $asesor = $this->combogrid->set_properties(array('model'=>'Vasesi_Users_Model', 'controller'=>'combo_pra_asesmen', 'fields'=>array('nama_user','email','jenis_user'), 'options'=>array('id'=>'pra_asesmen_checked', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama_user', 'panelWidth'=>500,
                    'queryParams'=>array('name'=>'easui') 
                    )))->load_model()->set_grid();
            $view = $this->load->view('shortcut/pendaftaran', array('id_tuk'=>$tuk_grid,'id_asesi'=>$users,'id_asesi2'=>$users2,
                'pra_asesmen_grid' => $asesor,'pendaftaran_ujk' => array('-','Selesai','Belum Selesai')
                ,'sumber_pendanaan' => array('-','Subsidi BNSP','Mandiri','Lain-lain')), TRUE);
            echo json_encode(array('msgType'=>'success', 'msgValue'=>$view, 'title'=>'Shortcut Pendaftaran', 'width'=>600, 'height'=>400));
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