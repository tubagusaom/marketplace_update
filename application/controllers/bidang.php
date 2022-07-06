<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bidang extends MY_Controller {

    function __construct() {

        parent::__construct();
        $this->load->model('bidang_model');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'bidang_model', 'controller' => 'bidang', 'options' => array('id' => 'bidang', 'pagination', 'rownumber')))->load_model()->set_grid();
            $view = $this->load->view('bidang/index', array('grid' => $grid), true);
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
            //$where['t_bidang.id !='] = "";
            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->bidang_model->count_by($where) : $this->bidang_model->count_all();
            $this->bidang_model->limit($row, $offset);
            $order = $this->bidang_model->get_params('_order');
            // $rows = isset($where) ? $this->bidang_model->order_by($order)->get_many_by($where) : $this->bidang_model->order_by($order)->get_all();
            $rows = $this->bidang_model->set_params($params)->with(array('skema','users'));
            $data['rows'] = $this->bidang_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        } else {
            block_access_method();
        }
    }

    function combogrid() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
            $page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
            $offset = $row * ($page - 1);
            if(isset($_POST['q']) && !empty($_POST['q']))
            {
                $where['users LIKE'] = '%' . $this->input->post('q') . '%';
            }
            $where['id_group_users ='] = '6';
            $data = array();
            $params = array('_return' => 'data');

            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->bidang_model->count_by($where) : $this->bidang_model->count_all();
            $this->bidang_model->limit($row, $offset);
            $rows = $this->bidang_model->set_params($params)->with(array('skema','asesor'));
            $data['rows'] = $this->bidang_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_skema = $_POST['id_skema'];
            $id_asesor = $_POST['id_asesor'];
            $sertifikat_teknis = $_POST['sertifikat_teknis'];
            foreach ($id_skema as $key => $value) {
                $data_skema = array('id_asesor'=>$id_asesor,'id_skema'=>$value,'sertifikat_teknis'=>$sertifikat_teknis);
                $this->db->insert('t_bidang',$data_skema);
            }
            echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));

        } else {
        	$this->load->library('combogrid');
        	$asesor_grid = $this->combogrid->set_properties(array('model' => 'asesor_model', 'controller' => 'asesor', 'fields' => array('users', 'no_reg'), 'options' => array('id' => 'id_asesor', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'users', 'panelWidth' => 400)))->load_model()->set_grid();
            $skema_grid = $this->combogrid->set_properties(array('model' => 'skema_model', 'controller' => 'skema', 'fields' => array('id', 'skema'), 'options' => array('id' => 'id_skema', 'rownumber', 'idField' => 'id', 'textField' => 'skema', 'panelWidth' => 500)))->load_model()->set_grid();
        	//$this->load->model('skema_model');
            //$skema = $this->skema_model->dropdown('id', 'skema');
            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('bidang/add',array('skema_grid'=>$skema_grid,'asesor_grid'=>$asesor_grid),TRUE)));
        }
    }

    function delete($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $roles = $this->bidang_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->bidang_model->delete(intval($id))) {
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
            $data = $this->bidang_model->set_validation()->validate();

            if ($data !== false) {
                if ($this->bidang_model->check_unique($data, intval($id))) {
                    $is_users = $this->input->post('is_users');
                    $data['is_users'] = '1';
                    if ($this->bidang_model->update(intval($id), $data) !== false) {
                        if($is_users=='0'){
                            $nama =   str_replace(' ','',strtolower($this->input->post('users')));
                            if(strlen($nama) > 4){
                                $akun =  'bidang'.substr($nama, 0, 4).rand(1,99);
                            }else{
                                $akun =  'bidang'.$nama.rand(1,99);
                            }
                         $data_user = array(
                               'akun' => $akun,
                               'email' => $this->input->post('email'),
                               'hp' => $this->input->post('hp'),
                               'nama_user' => $this->input->post('users'),
                               'jenis_user' => '2',
                               'sandi' => '123456',
                               'sandi_asli' => '123456',
                               'aktif' => '1' ,
                               'pegawai_id' => $id,
                            );

                            $this->load->model('User_Model');
                            $this->User_Model->insert($data_user);
                            $user_id= $this->db->insert_id();

                            $datay['user_id'] = $user_id;
                            $datay['role_id'] = 16;
                            $this->load->model('User_Role_Model');
                            $this->User_Role_Model->insert($datay);
                        }
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->bidang_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $con_method = $this->bidang_model->get(intval($id));
            if (sizeof($con_method) == 1) {

                $data = $this->bidang_model->get_single($con_method);
                $view = $this->load->view('bidang/edit', array( 'data' => $data), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
    }
    function upload() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->bidang_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->bidang_model->check_unique($data)) {
                    if (isset($_FILES['fileToUpload']['tmp_name']) && !empty($_FILES['fileToUpload']['tmp_name'])) {
                        $data['foto'] = str_replace(' ', '_', $_FILES['fileToUpload']['name']);
                        $config['upload_path'] = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/img/siswa/';
                        $config['allowed_types'] = 'bmp|jpg|png|gif|jpeg';
                        $config['max_size'] = '512000';

                        $this->load->library('upload', $config);

                        if (!$this->upload->do_upload('fileToUpload')) {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => $this->upload->display_errors()));
                            exit();
                        }
                    } else {
                        $data['foto'] = "";
                    }
                    if ($this->bidang_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", strip_tag($this->bidang_model->get_validation()))));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        }
    }

    function edit_upload($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->bidang_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->bidang_model->check_unique($data, intval($id))) {
                    if (isset($_FILES['fileToUpload']['tmp_name']) && !empty($_FILES['fileToUpload']['tmp_name'])) {
                        $siswa = $this->bidang_model->get(intval($id));
                        $data['foto'] = $data['nis'] . '_' . str_replace(' ', '_', $_FILES['fileToUpload']['name']);
                        $config['upload_path'] = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/img/siswa/';
                        $config['allowed_types'] = 'bmp|jpg|png|gif|jpeg';
                        $config['file_name'] = $data['foto'];
                        $config['max_size'] = '512000';

                        $this->load->library('upload', $config);

                        if ($this->upload->do_upload('fileToUpload')) {
                            $current_file = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/img/siswa/' . $siswa->foto;
                            if (is_file($current_file)) {
                                unlink($current_file);
                            }
                        } else {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => strip_tags($this->upload->display_errors())));
                            exit();
                        }
                    }else{
                        $data['foto'] = $this->input->post('foto_hidden');
                    }
                    if ($this->bidang_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->bidang_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        }
    }

    function search() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
             $view = $this->load->view('bidang/search', array(), TRUE);

            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));

        } else {
            block_access_method();
        }
    }
    function view($id=0,$offset=0){
        $data['marquee'] = $this->artikel_model->marquee();

        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();

        $keyword=$this->input->get('keyword');
        if($keyword==""){
            $offset = $this->uri->segment(4);
            $this->db->where('id_group_users',6);
            $jml = $this->db->get(kode_tbl().'users');
            $data['jmldata'] = $jml->num_rows();
            //pengaturan pagination
            $config['enable_query_strings'] = true;
            $config['base_url'] = base_url().'bidang/view/'.$id;
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
            $data['data'] = $this->Sertifikasi_Model->get_all_bidang($config['per_page'],$offset);
        }else{
            $offset = $this->uri->segment(3);
            $this->db->where('id_group_users',6);
            $this->db->like('users', $keyword);
            $jml = $this->db->get(kode_tbl().'users');
            $data['jmldata'] = $jml->num_rows();

                    //pengaturan pagination
            $config['enable_query_strings'] = true;
            if(!empty($keyword)){
                $config['suffix'] = "?keyword=".$keyword;
            }

            $config['base_url'] = base_url().'bidang/view/'.$id;
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
            $data['data'] = $this->Sertifikasi_Model->get_all_bidang($config['per_page'],$offset,$keyword);
        }
        $this->load->view('templates/bootstraps/header',$data);
        $this->load->view('sertifikasi/vbidang',$data);
        $this->load->view('templates/bootstraps/bottom');
    }
    function sms($id=false){
       if(!$id){
            data_not_found();
            exit;
        }
        $this->db->where('pegawai_id',$id);
        $row = $this->db->get('t_users')->row();
        $username = $row->akun;
        $password = $row->sandi_asli;
        //var_dump($password);die();
        $admin = $this->db->get('r_konfigurasi_aplikasi')->row();
        $pesan = 'Login '.$admin->url_aplikasi.' User:'.$username.' Pass:'.$password;
        $data['sender_id'] = $this->auth->get_user_data()->id;
        $data['reciepent_id'] = $id ;
        $data['title'] = 'Akses Login Aplikasi' ;
        $data['message'] = $pesan ;

        $this->load->model('Pesan_Model');
        $this->Pesan_Model->insert($data);
        $hasil = smssend($row->hp,$pesan);
        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Notifikasi Terkirim !'));
    }
}
