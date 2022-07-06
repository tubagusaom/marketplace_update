<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Member extends MY_Controller {

    function __construct() {

        parent::__construct();
        $this->load->model('member_model');
        $this->load->model('artikel_model');
        // $this->load->model('Sertifikasi_Model');
        $this->load->library('pagination');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'member_model', 'controller' => 'member', 'options' => array('id' => 'member', 'pagination', 'rownumber')))->load_model()->set_grid();
            $view = $this->load->view('member/index', array('grid' => $grid), true);
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
            if(isset($_POST['member']) && !empty($_POST['member']))
            {
                $where['member LIKE'] = '%' . $this->input->post('member') . '%';
            }

            // $where['id_group_member ='] = '6';
            $data = array();
            $params = array('_return' => 'data');

            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->member_model->count_by($where) : $this->member_model->count_all();
            $this->member_model->limit($row, $offset);
            $rows = $this->member_model->set_params($params)->with(array());
            $data['rows'] = $this->member_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else {
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
            // $where['id_group_users ='] = '6';
            $data = array();
            $params = array('_return' => 'data');

            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->member_model->count_by($where) : $this->member_model->count_all();
            $this->member_model->limit($row, $offset);
            $rows = $this->member_model->set_params($params)->with(array());
            $data['rows'] = $this->member_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->member_model->set_validation()->validate();

            // var_dump($data); die();

            if ($data !== false) {
                if ($this->member_model->check_unique($data)) {
                    $data['is_member'] = '1';

                    $random_numeric =  rand(1,9999999999);
                    // $str_shuffle = 'merchant_'.substr(str_shuffle(str_repeat($random_numeric."abcdefghijklmnopqrstuvwxyz", 1)), 0, 7);
                    //
                    // $str_shuffle = substr(str_shuffle(str_repeat($random_numeric."abcdefghijklmnopqrstuvwxyz", 1)), 0, 7);
                    // $akun = 'merchant_'.$str_shuffle;
                    //
                    // var_dump($akun); die();

                    $insert_database = $this->member_model->insert($data);
                    if ($insert_database !== false) {
                      $id_member = $this->db->insert_id();
                            $random_numeric =  rand(1,9999999999);
                            $str_shuffle = substr(str_shuffle(str_repeat($random_numeric."abcdefghijklmnopqrstuvwxyz", 1)), 0, 4);
                            $akun = 'merchant_'.$str_shuffle.$id_member;
                            // //
                            // var_dump($akun); die();

                            $data_detail_member = array(
                               // 'akun' => $akun,
                               'id_member' => $id_member,
                               'nama_bank' => $this->input->post('nama_bank'),
                               'norek_bank' => $this->input->post('norek_bank'),
                               'nama_pemilik_bank' => $this->input->post('nama_pemilik_bank'),
                               'cabang_bank' => $this->input->post('cabang_bank'),

                               'nama_pic' => $this->input->post('nama_pic'),
                               'jabatan_pic' => $this->input->post('jabatan_pic'),
                               'hp_pic' => $this->input->post('hp_pic'),
                               'email_pic' => $this->input->post('email_member'),
                            );
                            $this->db->insert(kode_tbl().'member_detail', $data_detail_member);

                            $data_user = array(
                                'akun' => $akun,
                                'email' => $this->input->post('email_member'),
                                'hp' => $this->input->post('tlp_member'),
                                'nama_user' => $this->input->post('member'),
                                'jenis_user' => '2',
                                'sandi' => '123456',
                                'sandi_asli' => '123456',
                                'aktif' => '1',
                                'id_member' => $insert_database,
                            );

                            $this->load->model('User_Model');
                            $this->User_Model->insert($data_user);
                            $user_id= $this->db->insert_id();

                            $datay['user_id'] = $user_id;
                            $datay['role_id'] = 21;
                            $this->load->model('User_Role_Model');
                            $this->User_Role_Model->insert($datay);

                            echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));

                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->member_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {

          $this->load->model('ro_provinsi_model');
          $province = $this->ro_provinsi_model->dropdown('province_id', 'province_name');

          $this->load->model('ro_kota_model');
          $kota = $this->ro_kota_model->dropdown('city_id', 'city_name');

          // $this->load->library('combogrid');
          // $province = $this->combogrid->set_properties(array('model' => 'ro_provinsi_model', 'controller' => 'ro_provinsi', 'fields' => array('province_name'), 'options' => array('id' => 'id_province_member', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'province_name', 'panelWidth' => 400)))->load_model()->set_grid();

          // var_dump($kota); die();

          // echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('member/add','',TRUE)));
          echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('member/add', array('province' => $province, 'kota' => $kota), TRUE)));
        }
    }

    function delete($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $roles = $this->member_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->member_model->delete(intval($id))) {
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
            $data = $this->member_model->set_validation()->validate();

            if ($data !== false) {
                if ($this->member_model->check_unique($data, intval($id))) {
                    // $is_users = $this->input->post('is_users');
                    // $data['is_users'] = '1';
                    if ($this->member_model->update(intval($id), $data) !== false) {

                      $data_detail_member = array(
                         // 'akun' => $akun,
                         'nama_bank' => $this->input->post('nama_bank'),
                         'norek_bank' => $this->input->post('norek_bank'),
                         'nama_pemilik_bank' => $this->input->post('nama_pemilik_bank'),
                         'cabang_bank' => $this->input->post('cabang_bank'),

                         'nama_pic' => $this->input->post('nama_pic'),
                         'jabatan_pic' => $this->input->post('jabatan_pic'),
                         'hp_pic' => $this->input->post('hp_pic'),
                         'email_pic' => $this->input->post('email_member'),
                      );

                      // var_dump($id); die();

                      $this->db->where('id_member', $id);
                      $this->db->update(kode_tbl().'member_detail', $data_detail_member);

                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->member_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $con_method = $this->member_model->get(intval($id));
            if (sizeof($con_method) == 1) {
                $detail_member = $this->member_model->detail_member($id);
                $file_member = $this->member_model->file_member($id);

                // var_dump($file_member); die();

                $data = $this->member_model->get_single($con_method);
                $view = $this->load->view('member/edit', array('data' => $data,'detail_member' => $detail_member,'file_member' => $file_member), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
    }

    function detail($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->member_model->set_validation()->validate();

            if ($data !== false) {
                if ($this->member_model->check_unique($data, intval($id))) {
                    // $is_users = $this->input->post('is_users');
                    // $data['is_users'] = '1';
                    if ($this->member_model->update(intval($id), $data) !== false) {

                      $data_detail_member = array(
                         // 'akun' => $akun,
                         'nama_bank' => $this->input->post('nama_bank'),
                         'norek_bank' => $this->input->post('norek_bank'),
                         'nama_pemilik_bank' => $this->input->post('nama_pemilik_bank'),
                         'cabang_bank' => $this->input->post('cabang_bank'),

                         'nama_pic' => $this->input->post('nama_pic'),
                         'jabatan_pic' => $this->input->post('jabatan_pic'),
                         'hp_pic' => $this->input->post('hp_pic'),
                         'email_pic' => $this->input->post('email_member'),
                      );

                      // var_dump($id); die();

                      $this->db->where('id_member', $id);
                      $this->db->update(kode_tbl().'member_detail', $data_detail_member);

                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->member_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $con_method = $this->member_model->get(intval($id));
            if (sizeof($con_method) == 1) {
                $detail_member = $this->member_model->detail_member($id);
                $file_member = $this->member_model->file_member($id);

                // var_dump($file_member); die();

                $data = $this->member_model->get_single($con_method);
                $view = $this->load->view('member/detail', array('data' => $data,'detail_member' => $detail_member,'file_member' => $file_member), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
    }

    function upload() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->member_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->member_model->check_unique($data)) {
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
                    if ($this->member_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", strip_tag($this->member_model->get_validation()))));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        }
    }


    public function upload_ajax($jenis,$id) {

        //error_reporting(E_ALL ^ E_DEPRECATED);
		    //ini_set('display_errors', '1');

        $this->load->helper('postinger');
        $this->load->library('upload');

        $files = $_FILES['file'];
        $nama = str_replace(array(" ", "'", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "-", "+", "=", ":", ";", "/", "?", "<", ">", "~", "`", "[", "]"), "", $files['name']);

        $array_ext = explode(".", $nama); // Split file name into an array using the dot
        $fileExt = end($array_ext);
        $nama = str_replace($fileExt, '',$nama);
        //var_dump($fileExt);die();
        $nama_filenya= str_replace('.', '', $nama) . '.' . $fileExt;
        $namafile = $jenis . "_" . time().'_'.$nama_filenya;
        //var_dump($namafile);die();
        $fileupload = $this->upload_member('file', $namafile);
        $var_dump=json_decode($fileupload);

        $file_size = round(($var_dump->upload_data->file_size / 1024), 2) . ' MB';
        $extension = str_replace('.', '', $var_dump->upload_data->file_ext);
        $array_jenis_portofolio = array('npwp'=>'1','ktp'=>'2','nib'=>'3');

        $array_repositori = array(
            'id_users' => $id,
            'nama_dokumen' => $jenis,
            'nama_file' => $namafile,
            'jenis_dokumen' => $array_jenis_portofolio[$jenis],
            'file_size' => $file_size,
            'extension' => $extension,
        );
        $this->db->insert('t_repositori', $array_repositori);

        echo $fileupload;
    }

    function hapus_file(){
      $nama_file = $this->input->post('nama_file');
      $this->db->where('nama_file',$nama_file);

      if (!$this->db->delete('t_repositori')) {
        $error = array('error' => 'Gagal Menghapus');

        $result = json_encode($error);
      } else {

        $current_file = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/img/member/' . $nama_file;
        if (is_file($current_file)) {
            unlink($current_file);
        }

        $data = array('upload_data' => 'Berhasil Menghapus');

        $result = json_encode($data);
      }

    }

    function show_file() {
        $nmfile = $this->input->get('nmfile');
        $data['extension'] = strtolower(substr($nmfile, -3));
        $data['nmfile'] = $nmfile;

        // var_dump($nmfile); die();
        $this->load->view('member/view_image', $data);
    }

    function edit_upload($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->member_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->member_model->check_unique($data, intval($id))) {
                    if (isset($_FILES['fileToUpload']['tmp_name']) && !empty($_FILES['fileToUpload']['tmp_name'])) {
                        $siswa = $this->member_model->get(intval($id));
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
                    if ($this->member_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->member_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        }
    }

    function search() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
             $view = $this->load->view('member/search', array(), TRUE);

            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));

        } else {
            block_access_method();
        }
    }

    // function view($id=0,$offset=0){
    //     $data['marquee'] = $this->artikel_model->marquee();
    //     $data['berita_lainnya'] = $this->artikel_model->berita_lainnya();
    //     $data['berita_lsp_pilihan'] = $this->artikel_model->berita_lsp_pilihan();
    //     $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
    //
    //     $keyword=$this->input->get('keyword');
    //     if($keyword==""){
    //         $offset = $this->uri->segment(4);
    //         $this->db->where('id_group_users',6);
    //         $jml = $this->db->get(kode_tbl().'users');
    //         $data['jmldata'] = $jml->num_rows();
    //         //var_dump($data['jmldata']); die();
    //         //pengaturan pagination
    //         $config['enable_query_strings'] = true;
    //         $config['base_url'] = base_url().'member/view/'.$id;
    //         $config['total_rows'] = $jml->num_rows();
    //         $config['per_page'] = 10;
    //         $config['first_page'] = 'Awal';
    //         $config['last_page'] = 'Akhir';
    //         $config['next_page'] = '&laquo;';
    //         $config['prev_page'] = '&raquo;';
    //         $config['uri_segment'] = 4;
    //         //inisialisasi config
    //         $this->pagination->initialize($config);
    //         //buat pagination
    //         $data['halaman'] = $this->pagination->create_links();
    //         $data['data'] = $this->Sertifikasi_Model->get_all_member($config['per_page'],$offset);
    //     }else{
    //         $offset = $this->uri->segment(3);
    //         $this->db->where('id_group_users',6);
    //         $this->db->like('users', $keyword);
    //         $jml = $this->db->get(kode_tbl().'users');
    //         $data['jmldata'] = $jml->num_rows();
    //         //var_dump($data['jmldata']); die();
    //         //pengaturan pagination
    //         $config['enable_query_strings'] = true;
    //         if(!empty($keyword)){
    //             $config['suffix'] = "?keyword=".$keyword;
    //         }
    //
    //         $config['base_url'] = base_url().'member/view/'.$id;
    //         $config['total_rows'] = $jml->num_rows();
    //         $config['per_page'] = 10;
    //         $config['first_page'] = 'Awal';
    //         $config['last_page'] = 'Akhir';
    //         $config['next_page'] = '&laquo;';
    //         $config['prev_page'] = '&raquo;';
    //         $config['uri_segment'] = 4;
    //         //inisialisasi config
    //         $this->pagination->initialize($config);
    //         //buat pagination
    //         $data['halaman'] = $this->pagination->create_links();
    //         $data['data'] = $this->Sertifikasi_Model->get_all_member($config['per_page'],$offset,$keyword);
    //     }
    //
    //     $this->load->view('templates/bootstraps/header',$data);
    //     $this->load->view('sertifikasi/vmember',$data);
    //     $this->load->view('templates/bootstraps/bottom');
    // }

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
