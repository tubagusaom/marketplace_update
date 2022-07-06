<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tuk extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('tuk_model');
        $this->load->model('Sertifikasi_Model');
        $this->load->library('pagination');
        $this->load->model('artikel_model');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'tuk_model', 'controller' => 'tuk', 'options' => array('id' => 'tuk', 'pagination', 'rownumber')))->load_model()->set_grid();
            $view = $this->load->view('tuk/index', array('grid' => $grid), true);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        } else {
            block_access_method();
        }
    }

    function datagrid() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
            $page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
            $offset = $row * ($page - 1);
            $data = array();
            $params = array('_return' => 'data');

            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->tuk_model->count_by($where) : $this->tuk_model->count_all();
            $this->tuk_model->limit($row, $offset);
            $order = $this->tuk_model->get_params('_order');
            $rows = isset($where) ? $this->tuk_model->order_by($order)->get_many_by($where) : $this->tuk_model->order_by($order)->get_all();
            $data['rows'] = $this->tuk_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        } else {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->tuk_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->tuk_model->check_unique($data)) {
                    $data['is_users'] = '1';
                    $insert_database = $this->tuk_model->insert($data);
                    if ($insert_database !== false) {
                        $no_cab = strtolower($this->input->post('no_cab'));

                         $akun =   str_replace('-','',$no_cab);
                         $data_user = array(
                               'akun' => $akun,
                               'email' => $this->input->post('email_tuk'),
                               'hp' => $this->input->post('telp'),
                               'nama_user' => $this->input->post('tuk'),
                               'jenis_user' => '3',
                               'sandi' => '123456',
                               'sandi_asli' => '123456',
                               'aktif' => '1' ,
                               'pegawai_id' => $insert_database,
                            );

                            $this->load->model('User_Model');
                            $this->User_Model->insert($data_user);
                            $user_id= $this->db->insert_id();

                            $datay['user_id'] = $user_id;
                            $datay['role_id'] = 5;
                            $this->load->model('User_Role_Model');
                            $this->User_Role_Model->insert($datay);
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->tuk_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            //echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('tuk/add', array('status' => 1, 'bidang' => 1),  TRUE)));
            $this->load->model('prodi_model');
            $prodi = $this->prodi_model->dropdown('id', 'program_studi');
                $view = $this->load->view('tuk/add', array('prodi'=>$prodi), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        }
    }

    function delete($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $roles = $this->tuk_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->tuk_model->delete(intval($id))) {
                    echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil dihapus'));
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak berhasil dihapus !'));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        } else {
            block_access_method();
        }
    }

    function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->tuk_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->tuk_model->check_unique($data, intval($id))) {
                    $is_users = $this->input->post('is_users');
                    $no_cab = strtolower($this->input->post('no_cab'));
                    $data['is_users'] = '1';
                    if ($this->tuk_model->update(intval($id), $data) !== false) {
                        if($is_users=='0'){
                            $akun =   str_replace('-','',$no_cab);
                         $data_user = array(
                               'akun' => $akun,
                               'email' => $this->input->post('email_tuk'),
                               'hp' => $this->input->post('hp'),
                               'nama_user' => $this->input->post('tuk'),
                               'jenis_user' => '3',
                               'sandi' => '123456',
                               'sandi_asli' => '123456',
                               'aktif' => '1' ,
                               'pegawai_id' => $id,
                            );

                            $this->load->model('User_Model');
                            $this->User_Model->insert($data_user);
                            $user_id= $this->db->insert_id();

                            $datay['user_id'] = $user_id;
                            $datay['role_id'] = 5;
                            $this->load->model('User_Role_Model');
                            $this->User_Role_Model->insert($datay);
                        }
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->tuk_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $batch = $this->tuk_model->get(intval($id));
            if (sizeof($batch) == 1) {
                $this->load->model('prodi_model');
            $prodi = $this->prodi_model->dropdown('id', 'program_studi');
               $view = $this->load->view('tuk/edit', array('prodi'=>$prodi,'data' => $this->tuk_model->get_single($batch),
                'kategori' => array('Klaster'=>'Klaster','Okupasi' => 'Okupasi','KKNI'=>'KKNI','Standar Khusus'=>'Standar Khusus','Standar Internasional'=>'Standar Internasional')), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));

            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
    }
    function combogrid($id = false)
	{
		$row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows')) ;
		$page = intval($this->input->post('page'))== 0 ? 1 : intval($this->input->post('page'));
		$offset = $row * ($page - 1);
		$data = array();
		$params = array('_return'=>'data');
		if(isset($_POST['q']))
		{
			$where['tuk LIKE'] = "%" . $this->input->post('q') . "%";
		}
		if(isset($where)) $params['_where'] = $where;
		$data['total'] = isset($where) ? $this->tuk_model->count_by($where) : $this->tuk_model->count_all();
		$this->tuk_model->limit($row, $offset);
		$order_criteria = "ASC";
		$_order_escape = TRUE;
		if($id)
		{
			$order = "FIELD(id, " . intval($id) . ")";
			$order_criteria = "DESC";
			$_order_escape = FALSE;
		}
		else
		{
			$order = $this->tuk_model->get_params('_order');
		}
		$rows = isset($where) ? $this->tuk_model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->tuk_model->order_by($order, $order_criteria, $_order_escape)->get_all();
		$data['rows'] = $this->tuk_model->get_selected()->data_formatter($rows);
        //var_dump($data);
		echo json_encode($data);
	}
    function view($id=0,$offset=0){
        $data['marquee'] = $this->artikel_model->marquee();
        $data['berita_lainnya'] = $this->artikel_model->berita_lainnya();
        $data['berita_lsp_pilihan'] = $this->artikel_model->berita_lsp_pilihan();
        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();

        $keyword=$this->input->get('keyword');
        if($keyword==""){
            $offset = $this->uri->segment(4);
            $jml = $this->db->get(kode_tbl().'tuk');
            $data['jmldata'] = $jml->num_rows();
            //pengaturan pagination
            $config['enable_query_strings'] = true;
            $config['base_url'] = base_url().'tuk/view/'.$id;
            $config['total_rows'] = $jml->num_rows();
            $config['per_page'] = 10;
            $config['first_page'] = 'Awal';
            $config['last_page'] = 'Akhir';
            $config['next_page'] = '&laquo;';
            $config['prev_page'] = '&raquo;';
            $config['uri_segment'] = 4;
            //inisialisasi config
            $this->pagination->initialize($config);
            //buat pagination
            $data['halaman'] = $this->pagination->create_links();
            $data['data'] = $this->Sertifikasi_Model->get_all_tuk($config['per_page'],$offset);
            $data['berita_lsp_list'] = $this->artikel_model->berita_lsp_list();
        }else{
            $offset = $this->uri->segment(3);
            $this->db->like('tuk', $keyword);
            $jml = $this->db->get(kode_tbl().'tuk');
            $data['jmldata'] = $jml->num_rows();

                    //pengaturan pagination
            $config['enable_query_strings'] = true;
            if(!empty($keyword)){
                $config['suffix'] = "?keyword=".$keyword;
            }

            $config['base_url'] = base_url().'tuk/view/'.$id;
            $config['total_rows'] = $jml->num_rows();
            $config['per_page'] = 10;
            $config['first_page'] = 'Awal';
            $config['last_page'] = 'Akhir';
            $config['next_page'] = '&laquo;';
            $config['prev_page'] = '&raquo;';
            $config['uri_segment'] = 4;
            //inisialisasi config
            $this->pagination->initialize($config);
            //buat pagination
            $data['halaman'] = $this->pagination->create_links();
            $data['data'] = $this->Sertifikasi_Model->get_all_tuk($config['per_page'],$offset,$keyword);
            $data['berita_lsp_list'] = $this->artikel_model->berita_lsp_list();
            //var_dump($data['data']);
        }
        $this->load->view('templates/bootstraps/header',$data);
        $this->load->view('sertifikasi/vtuk',$data);
        $this->load->view('templates/bootstraps/bottom');
    }

    function sms($id=false){
       if(!$id){
            data_not_found();
            exit;
        }
        $this->db->where('pegawai_id',$id);
        $this->db->where('jenis_user',3);
        $row = $this->db->get('t_users')->row();
        $username = $row->akun;
        $password = $row->sandi_asli;
        //var_dump($password);die();
        $admin = $this->db->get('r_konfigurasi_aplikasi')->row();
        $pesan = 'Login '.$admin->url_aplikasi.' User:'.$username.' Pass:'.$password;
        $data['sender_id'] = $this->auth->get_user_data()->id;
        $data['reciepent_id'] = $row->id ;
        $data['title'] = 'Akses Login Aplikasi' ;
        $data['message'] = $pesan ;

        $this->load->model('Pesan_Model');
        $this->Pesan_Model->insert($data);
        $hasil = smssend($row->hp,$pesan);
        //var_dump($hasil);
        //die();
        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Notifikasi Terkirim !'));
    }
}
