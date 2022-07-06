<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mahasiswa extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('mahasiswa_model');
        $this->load->model('artikel_model');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'mahasiswa_model', 'controller' => 'mahasiswa', 'options' => array('id' => 'mahasiswa', 'pagination', 'rownumber')))->load_model()->set_grid();
            $view = $this->load->view('mahasiswa/index', array('grid' => $grid), true);
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

            if(isset($_POST['nama_calon']) && !empty($_POST['nama_calon']))
            {
                $where['nama_calon like'] = '%' . $this->input->post('nama_calon') . '%';
            }
            
            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->mahasiswa_model->count_by($where) : $this->mahasiswa_model->count_all();
            $this->mahasiswa_model->limit($row, $offset);
            $order = $this->mahasiswa_model->get_params('_order');
            //$rows = isset($where) ? $this->jadwal_asesmen_model->order_by($order)->get_many_by($where) : $this->jadwal_asesmen_model->order_by($order)->get_all();
            $rows = $this->mahasiswa_model->set_params($params)->with(array('angkatan', 'prodi'));
            $data['rows'] = $this->mahasiswa_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
            // var_dump($data);die;
        }
        else {
            block_access_method();
        }
    }

    function search() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            //$this->load->model('pra_asesmen_model');
            // $this->load->library('combogrid');
            //     $prodi = $this->combogrid->set_properties(array('model' => 'mahasiswa_model', 'controller' => 'mahasiswa', 'fields' => array('tuk'), 'options' => array('id' => 'id_tuk', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'tuk', 'panelWidth' => 500)))->load_model()->set_grid();


            $view = $this->load->view('mahasiswa/search', array(''), TRUE);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));

        } else {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->mahasiswa_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->mahasiswa_model->check_unique($data)) {

                    if ($this->mahasiswa_model->insert($data) !== false) {
                        $id_mahasiswa = $this->db->insert_id();
                        $dataca = array('is_user' => "1");
                        $this->db->where('id', $id_mahasiswa);
                        $this->db->update(kode_tbl() . 'calon_asesi', $dataca);

                        $nama = str_replace(' ', '', strtolower($this->input->post('nama_calon')));
                        if (strlen($nama) > 4) {
                            $akun = substr($nama, 0, 4) . rand(1, 9999);
                        } else {
                            $akun = $nama . rand(1, 9999);
                        }
                        $data_user = array(
                            'akun' => $akun,
                            'email' => $this->input->post('email_calon'),
                            'hp' => $this->input->post('hp_calon'),
                            'no_identitas' => $this->input->post('nim_calon'),
                            'nama_user' => $this->input->post('nama_calon'),
                            'jenis_user' => '1',
                            'sandi' => '123456',
                            'sandi_asli' => '123456',
                            'aktif' => '1',
                            'pegawai_id' => $id_mahasiswa,
                        );

                        $this->load->model('User_Model');
                        $this->User_Model->insert($data_user);
                        $user_id = $this->db->insert_id();

                        $datay['user_id'] = $user_id;
                        $datay['role_id'] = 17;
                        $this->load->model('User_Role_Model');
                        $this->User_Role_Model->insert($datay);

                        $this->db->where('id', $user_id);
                        $row = $this->db->get('t_users')->row();
                        $username = $row->akun;
                        $password = $row->sandi_asli;
                        //var_dump($password);die();
                        $admin = $this->db->get('r_konfigurasi_aplikasi')->row();
                        $pesan = 'Login ' . $admin->url_aplikasi . ' User: ' . $username . ' Pass: ' . $password;
                        $data['sender_id'] = $this->auth->get_user_data()->id;
                        $data['reciepent_id'] = $user_id;
                        $data['title'] = 'Akses Login Aplikasi';
                        $data['message'] = $pesan;

                        $hasil = smssend_zenziva($row->hp, $pesan);

                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->mahasiswa_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $this->load->model('prodi_model');
            $prodi = $this->prodi_model->dropdown('id', 'program_studi');

            $this->load->model('angkatan_model');
            $angkatan = $this->angkatan_model->dropdown('id', 'angkatan');
            // $view = $this->load->view('mahasiswa/add',$data);
            $view = $this->load->view('mahasiswa/add', array('angkatan' => $angkatan, 'prodi' => $prodi), TRUE);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        }
    }

    function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->mahasiswa_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->mahasiswa_model->check_unique($data, intval($id))) {
                    if ($this->mahasiswa_model->update(intval($id), $data) !== false) {

                        $akses_login = isset($_POST['akses_login']) ? $this->input->post('akses_login') : "";

                        if ($akses_login != "") {
                            $dataca = array('is_user' => "1");
                            $this->db->where('id', $id);
                            $this->db->update(kode_tbl() . 'calon_asesi', $dataca);

                            $nama = str_replace(' ', '', strtolower($this->input->post('nama_calon')));
                            if (strlen($nama) > 4) {
                                $akun = substr($nama, 0, 4) . rand(1, 9999);
                            } else {
                                $akun = $nama . rand(1, 9999);
                            }
                            $data_user = array(
                                'akun' => $akun,
                                'email' => $this->input->post('email_calon'),
                                'hp' => $this->input->post('hp_calon'),
                                'no_identitas' => $this->input->post('nim_calon'),
                                'nama_user' => $this->input->post('nama_calon'),
                                'jenis_user' => '1',
                                'sandi' => '123456',
                                'sandi_asli' => '123456',
                                'aktif' => '1',
                                'pegawai_id' => $id,
                            );

                            $this->load->model('User_Model');
                            $this->User_Model->insert($data_user);
                            $user_id = $this->db->insert_id();

                            $datay['user_id'] = $user_id;
                            $datay['role_id'] = 17;
                            $this->load->model('User_Role_Model');
                            $this->User_Role_Model->insert($datay);
                        }


                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->mahasiswa_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $value = $this->mahasiswa_model->get(intval($id));
            $this->load->model('prodi_model');
            $prodi = $this->prodi_model->dropdown('id', 'program_studi');

            $this->load->model('angkatan_model');
            $angkatan = $this->angkatan_model->dropdown('id', 'angkatan');

            if (sizeof($value) == 1) {
                $view = $this->load->view('mahasiswa/edit', array('data' => $this->mahasiswa_model->get_single($value), 'angkatan' => $angkatan, 'prodi' => $prodi), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
    }

    function view($id = 0, $offset = 0) {
        $data['marquee'] = $this->artikel_model->marquee();
        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
        $keyword = $this->input->get('keyword');
        if ($keyword == "") {
            $offset = $this->uri->segment(4);

            // $this->db->from(kode_tbl().'calon_asesi a');
            // $this->db->join('t_prodi b','b.id = a.id_prodi');
            // $this->db->join('t_angkatan c','c.id = a.id_angkatan');
            // $this->db->order_by('id', 'DESC');
            //
						// $jml = $this->db->get()->result();

            $jml = $this->db->get(kode_tbl() . 'calon_asesi');

            $data['jmldata'] = $jml->num_rows();
            //pengaturan pagination
            $config['enable_query_strings'] = true;
            $config['base_url'] = base_url() . 'mahasiswa/view/' . $id;
            $config['total_rows'] = $jml->num_rows();
            $config['per_page'] = 15;
            $config['first_page'] = 'Awal';
            $config['last_page'] = 'Akhir';
            $config['next_page'] = '&laquo;';
            $config['prev_page'] = '&raquo;';
            $config['uri_segment'] = 4;
            //inisialisasi config
            $this->pagination->initialize($config);
            //buat pagination
            $data['halaman'] = $this->pagination->create_links();
            $data['data'] = $this->mahasiswa_model->get_all_mahasiswa($config['per_page'], $offset);
            // $data['mahasiswa'] = $this->mahasiswa_model->get_detail_mahasiswa($id);
        } else {
            $offset = $this->uri->segment(3);
            $this->db->like('nama_calon', $keyword);

            $jml = $this->db->get(kode_tbl() . 'calon_asesi');

            $data['jmldata'] = $jml->num_rows();

            //pengaturan pagination
            $config['enable_query_strings'] = true;
            if (!empty($keyword)) {
                $config['suffix'] = "?keyword=" . $keyword;
            }

            $config['base_url'] = base_url() . 'mahasiswa/view/' . $id;
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
            $data['data'] = $this->mahasiswa_model->get_all_mahasiswa($config['per_page'], $offset, $keyword);
            //var_dump($data['data']);
        }

        $this->load->view('templates/bootstraps/header', $data);
        $this->load->view('mahasiswa/view', $data);
        $this->load->view('templates/bootstraps/bottom', $data);
    }

    function detail($id) {
        $data['marquee'] = $this->artikel_model->marquee();
        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();

        $data['mahasiswa'] = $this->mahasiswa_model->get_detail_mahasiswa($id);
        $data['uji'] = $this->mahasiswa_model->get_detail_uji($id);

        $this->load->view('templates/bootstraps/header', $data);
        $this->load->view('mahasiswa/view_detail', $data);
        $this->load->view('templates/bootstraps/bottom');
    }

    function jadwal($id = 0, $offset = 0) {
        $data['marquee'] = $this->artikel_model->marquee();
        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
        $keyword = $this->input->get('keyword');
        if ($keyword == "") {
            $offset = $this->uri->segment(4);
            $jml = $this->db->get(kode_tbl() . 'jadual_asesmen');
            $data['jmldata'] = $jml->num_rows();
            //pengaturan pagination
            $config['enable_query_strings'] = true;
            $config['base_url'] = base_url() . 'mahasiswa/jadwal/' . $id;
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
            $data['data'] = $this->mahasiswa_model->get_all_jadwal($config['per_page'], $offset);
        } else {
            $offset = $this->uri->segment(3);
            $this->db->like('jadual', $keyword);
            $jml = $this->db->get(kode_tbl() . 'jadual_asesmen');
            $data['jmldata'] = $jml->num_rows();

            //pengaturan pagination
            $config['enable_query_strings'] = true;
            if (!empty($keyword)) {
                $config['suffix'] = "?keyword=" . $keyword;
            }

            $config['base_url'] = base_url() . 'mahasiswa/jadwal/' . $id;
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
            $data['data'] = $this->mahasiswa_model->get_all_jadwal($config['per_page'], $offset, $keyword);
            // var_dump($data['data']);
        }

        $this->load->view('templates/bootstraps/header', $data);
        $this->load->view('mahasiswa/jadwal', $data);
        $this->load->view('templates/bootstraps/bottom', $data);
    }

    function detail_jadwal($id) {
        $data['marquee'] = $this->artikel_model->marquee();
        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();

        $data['jadwal'] = $this->mahasiswa_model->get_detail_jadwal($id);

        $this->load->view('templates/bootstraps/header', $data);
        $this->load->view('mahasiswa/detail_jadwal', $data);
        $this->load->view('templates/bootstraps/bottom');
    }

    function combogrid($id = false) {
        $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
        $page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
        $offset = $row * ($page - 1);
        $data = array();
        $params = array('_return' => 'data');
        if (isset($_POST['q'])) {
            $where['nama_calon LIKE'] = "%" . $this->input->post('q') . "%";
        }
        if (isset($where))
            $params['_where'] = $where;
        $data['total'] = isset($where) ? $this->mahasiswa_model->count_by($where) : $this->mahasiswa_model->count_all();
        $this->mahasiswa_model->limit($row, $offset);
        $order_criteria = "ASC";
        $_order_escape = TRUE;
        if ($id) {
            $order = "FIELD(id, " . intval($id) . ")";
            $order_criteria = "DESC";
            $_order_escape = FALSE;
        } else {
            $order = $this->mahasiswa_model->get_params('_order');
        }
        $rows = isset($where) ? $this->mahasiswa_model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->mahasiswa_model->order_by($order, $order_criteria, $_order_escape)->get_all();
        $data['rows'] = $this->mahasiswa_model->get_selected()->data_formatter($rows);
        //var_dump($data);
        echo json_encode($data);
    }

    function delete($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $roles = $this->mahasiswa_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->mahasiswa_model->delete(intval($id))) {
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

}
