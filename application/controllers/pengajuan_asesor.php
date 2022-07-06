<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pengajuan_asesor extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('pengajuan_asesor_model');
        $this->load->model('jadwal_asesmen_model');
        $this->load->model('asesor_model');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'pengajuan_asesor_model', 'controller' => 'pengajuan_asesor', 'options' => array('id' => 'pengajuan_asesor', 'pagination', 'rownumber')))->load_model()->set_grid();
            $view = $this->load->view('pengajuan_asesor/index', array('grid' => $grid), true);
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
            $id_tuk = $this->auth->get_user_data()->pegawai_id;
//            $this->db->where('id', $id_tuk);
//            $row_tuk = $this->db->get(kode_tbl() . 'tuk')->row();
            $where['tbl007_mapping_asesor.id_tuk'] = $id_tuk;

            if (isset($_POST['id_jadwal']) && !empty($_POST['id_jadwal'])) {
                $where['id_jadwal'] = $this->input->post('id_jadwal');
            }
            if (isset($_POST['id_asesor']) && !empty($_POST['id_asesor'])) {
                $where['id_asesor'] = $this->input->post('id_asesor');
            }
            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->pengajuan_asesor_model->count_by($where) : $this->pengajuan_asesor_model->count_all();
            $this->pengajuan_asesor_model->limit($row, $offset);
            $rows = $this->pengajuan_asesor_model->set_params($params)->with(array('jadual', 'user'));
            $data['rows'] = $this->pengajuan_asesor_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //$jenis_asesmen = $this->input->post('jenis_asesmen');
            //var_dump($jenis_asesmen); die();
            $data = $this->pengajuan_asesor_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->pengajuan_asesor_model->check_unique($data)) {
                    $id_asesor = $this->input->post('id_asesor');
                    $id_jadwal = $this->input->post('id_jadwal');
                    $id_tuk = $this->auth->get_user_data()->pegawai_id;
                    $data['id_tuk'] = $id_tuk;
                    //$this->sms($id_asesor,$id_jadwal);

                    if ($this->pengajuan_asesor_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->pengajuan_asesor_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $this->load->library('combogrid');
            $jadwal_grid = $this->combogrid->set_properties(array('model' => 'jadwal_asesmen_model', 'controller' => 'jadwal_asesmen', 'fields' => array('jadual', 'tanggal'), 'options' => array('id' => 'id_jadwal', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'jadual', 'panelWidth' => 500)))->load_model()->set_grid();
            $asesor_grid = $this->combogrid->set_properties(array('model' => 'asesor_model', 'controller' => 'asesor', 'fields' => array('users', 'no_reg'), 'options' => array('id' => 'id_asesor', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'users', 'panelWidth' => 500)))->load_model()->set_grid();
            $this->load->model('prodi_model');
            $prodi = $this->prodi_model->dropdown('id', 'program_studi');
            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('pengajuan_asesor/add', array('jadwal_grid' => $jadwal_grid
                    , 'asesor_grid' => $asesor_grid, 'prodi' => $prodi), TRUE)));
        }
    }

    function sms($id_asesor, $id_jadwal) {
        $this->db->where('id', $id_jadwal);
        $row = $this->db->get(kode_tbl() . 'jadual_asesmen')->row();
        $jadwal = $row->jadual;
        $admin = $this->db->get('r_konfigurasi_aplikasi')->row();
        // Ambil data username asesor
        $this->db->where('pegawai_id', $id_asesor);
        $this->db->where('jenis_user', '2');
        $row_asesor = $this->db->get('t_users')->row();
        $akses = 'Username ' . $row_asesor->akun . ' Password 123456';

        $pesan = 'ST Asesor ' . $jadwal . '.' . $akses;

        smssend_zenziva($row_asesor->hp, $pesan);

        $post = '{"personalizations": [{"to": [{"email": "' . $row_asesor->email . '"}],"subject": "Surat Tugas Asesor' . $jadwal . '"}],"from": {"email": "' . $admin->alamat_email . '"},"content": [{"type": "text/plain","value": "' . $pesan . '"}]}';
        //var_dump($post);die();
        sendgrid_api_text('https://api.sendgrid.com/v3/mail/send', $post);

        //$this->db->where('id', $checked);
        //$row = $this->db->get('t_users')->row();

        $data['sender_id'] = 1;
        $data['reciepent_id'] = $row_asesor->id;
        $data['title'] = 'ST Asesor';
        $data['message'] = $pesan;

        $this->load->model('Pesan_Model');
        $this->Pesan_Model->insert($data);
        //smssend($row_asesor->hp, $pesan);

        $pesan_notif = 'ST Asesor ' . $row_asesor->nama_user . ', ' . $jadwal;
        $list_notif = explode(',', $admin->notifikasi_surat_tugas);
        foreach ($list_notif as $key => $value) {
            smssend_zenziva($value, $pesan_notif);
        }
    }

    function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->pengajuan_asesor_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->pengajuan_asesor_model->check_unique($data, intval($id))) {
                    if ($this->pengajuan_asesor_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil diubah !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data gagal diubah !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->pengajuan_asesor_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $con_method = $this->pengajuan_asesor_model->get(intval($id));

            if (sizeof($con_method) == 1) {
                $this->load->model('jadwal_asesmen_model');
                $this->load->model('asesor_model');
                $jadwals = $this->jadwal_asesmen_model->dropdown('id', 'jadual');
                $users = $this->asesor_model->dropdown('id', 'users');

                $view = $this->load->view('pengajuan_asesor/edit', array('jadwal' => $jadwals, 'user' => $users, 'data' => $this->pengajuan_asesor_model->get_single($con_method)), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
    }

    function delete($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $roles = $this->pengajuan_asesor_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->pengajuan_asesor_model->delete(intval($id))) {
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

    function search() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('combogrid');
            $jadwal_grid = $this->combogrid->set_properties(array('model' => 'jadwal_asesmen_model', 'controller' => 'jadwal_asesmen', 'fields' => array('jadual', 'tanggal'), 'options' => array('id' => 'id_jadwal', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'jadual', 'panelWidth' => 500)))->load_model()->set_grid();
            $asesor_grid = $this->combogrid->set_properties(array('model' => 'asesor_model', 'controller' => 'asesor', 'fields' => array('users', 'no_reg'), 'options' => array('id' => 'id_asesor', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'users', 'panelWidth' => 500)))->load_model()->set_grid();
            $view = $this->load->view('pengajuan_asesor/search', array('jadwal_grid' => $jadwal_grid
                , 'asesor_grid' => $asesor_grid), TRUE);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        } else {
            block_access_method();
        }
    }

}
