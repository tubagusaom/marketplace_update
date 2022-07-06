<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bukti_pendukung extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function upload() {
        $template_header = 'templates/responsive/header';
        $template_body = 'templates/responsive/bukti_pendukung/upload';
        $template_bottom = 'templates/responsive/footer';

        $this->load->view($template_header, array('aplikasi' => $this->aplikasi, 'query_pesan' => $this->query_pesan, 'query_pesan_unread' => $this->query_pesan_unread));
        $this->load->view($template_body, array('aplikasi' => $this->aplikasi, 'unread_message' => $this->unread_message, 'menus' => $this->menus, 'rolename' => $this->auth->get_rolename(), 'nama_user' => $this->auth->get_user_data()->nama));
        $this->load->view($template_bottom, array('aplikasi' => $this->aplikasi));
    }

    function add() {
        $aplikasi = $this->aplikasi;
        if (isset($_FILES['nama_file']['tmp_name']) && !empty($_FILES['nama_file']['tmp_name'])) {
            $data['nama_file'] = time() . str_replace(' ', '_', $_FILES['nama_file']['name']);
            $config['upload_path'] = substr(__dir__, 0, strpos(__dir__, "application")) . 'repo/asesi/';
            $config['allowed_types'] = '*';
            $config['max_size'] = 11000000;
            $config['file_name'] = $data['nama_file'];
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('nama_file')) {
                //var_dump($this->upload->display_errors());
                echo"gagal update";
            } else {
                $data_upload = $this->upload->data();
                $data['file_size'] = round(($data_upload['file_size'] / 1024), 2) . ' MB';
                $data['extension'] = str_replace('.', '', $data_upload['file_ext']);
                $data['id_asesi'] = $this->id;
                $data['nama_file'] = $config['file_name'];
                $data['jenis_portofolio'] = $this->input->post('jenis_portofolio');
                $data['nama_dokumen'] = $this->input->post('nama_dokumen');
                $data['description'] = $this->input->post('description');
                $this->db->insert('t_repositori', $data);
                redirect('bukti_pendukung/index');
            }
        }
    }

    function index() {
        $template_header = 'templates/responsive/header';
        $template_body = 'templates/responsive/bukti_pendukung/index';
        $template_bottom = 'templates/responsive/footer';
        $this->load->model('bukti_pendukung_model');

        $bukti_pendukung = $this->bukti_pendukung_model->bukti_pendukung($this->id);

        $dtjenis['1'] = $this->bukti_pendukung_model->bukti_pendukung_asesi(array('id_asesi' => $this->id, 'jenis_portofolio' => 1));
        $dtjenis['2'] = $this->bukti_pendukung_model->bukti_pendukung_asesi(array('id_asesi' => $this->id, 'jenis_portofolio' => 2));
        $dtjenis['3'] = $this->bukti_pendukung_model->bukti_pendukung_asesi(array('id_asesi' => $this->id, 'jenis_portofolio' => 3));
        $dtjenis['4'] = $this->bukti_pendukung_model->bukti_pendukung_asesi(array('id_asesi' => $this->id, 'jenis_portofolio' => 4));
        $dtjenis['5'] = $this->bukti_pendukung_model->bukti_pendukung_asesi(array('id_asesi' => $this->id, 'jenis_portofolio' => 5));
        $dtjenis['6'] = $this->bukti_pendukung_model->bukti_pendukung_asesi(array('id_asesi' => $this->id, 'jenis_portofolio' => 6));

        $this->load->view($template_header, array('aplikasi' => $this->aplikasi, 'query_pesan' => $this->query_pesan, 'query_pesan_unread' => $this->query_pesan_unread));
        $this->load->view($template_body, array('aplikasi' => $this->aplikasi, 'unread_message' => $this->unread_message, 'menus' => $this->menus, 'rolename' => $this->auth->get_rolename(), 'nama_user' => $this->auth->get_user_data()->nama, 'bukti_pendukung' => $bukti_pendukung, 'jns_portofolio' => $dtjenis));
        $this->load->view($template_bottom, array('aplikasi' => $this->aplikasi));
    }

    function jenis() {
        $template_header = 'templates/responsive/header';
        $template_body = 'templates/responsive/bukti_pendukung/jenis';
        $template_bottom = 'templates/responsive/footer';

        $this->load->view($template_header, array('aplikasi' => $this->aplikasi, 'query_pesan' => $this->query_pesan, 'query_pesan_unread' => $this->query_pesan_unread));
        $this->load->view($template_body, array('aplikasi' => $this->aplikasi, 'unread_message' => $this->unread_message, 'menus' => $this->menus, 'rolename' => $this->auth->get_rolename(), 'nama_user' => $this->auth->get_user_data()->nama));
        $this->load->view($template_bottom, array('aplikasi' => $this->aplikasi));
    }

    function hapus($id = false) {
        if (!$id) {
            redirect(base_url() . 'bukti_pendukung/index');
        } else {
            $this->db->where('id_asesi', $this->id);
            $this->db->where('id', $id);
            $this->db->delete('t_repositori');
            redirect(base_url() . 'bukti_pendukung/index');
        }
    }
    function edit($id) {
        $template_header = 'templates/responsive/header';
        $template_body = 'templates/responsive/bukti_pendukung/edit_upload';
        $template_bottom = 'templates/responsive/footer';
        $this->db->where('id',$id);
        $row = $this->db->get('t_repositori')->row();
        $this->load->view($template_header, array('aplikasi' => $this->aplikasi, 'query_pesan' => $this->query_pesan, 'query_pesan_unread' => $this->query_pesan_unread));
        $this->load->view($template_body, array('row'=>$row,'aplikasi' => $this->aplikasi, 'unread_message' => $this->unread_message, 'menus' => $this->menus, 'rolename' => $this->auth->get_rolename(), 'nama_user' => $this->auth->get_user_data()->nama));
        $this->load->view($template_bottom, array('aplikasi' => $this->aplikasi));
    }

    function update() {
        $is_work = $this->input->post('is_work');
        $nama_pekerjaan = $this->input->post('nama_pekerjaan');
        $nama_perusahaan = $this->input->post('nama_perusahaan');
        $id_provinsi = $this->input->post('id_provinsi');
        $tanggal_bergabung = $this->input->post('tanggal_bergabung');
        $tanggal_berhenti = $this->input->post('tanggal_berhenti');

        //var_dump($is_work); die();
        //$nama_pekerjaan = $_POST['group-a'];
        //$this->db->where('id_users', $this->id);
        //$this->db->delete('t_users_pekerjaan');
        //foreach ($nama_pekerjaan as $key => $value) {
            if ($nama_pekerjaan != "") {
                $tglberhenti = $tanggal_berhenti == "" ? NULL : mysql_date($tanggal_berhenti);
                $data_array = array('nama_pekerjaan' => $value['nama_pekerjaan'],
                    'tanggal_bergabung' => mysql_date($tanggal_bergabung),
                    'tanggal_berhenti' => $tglberhenti,
                    'nama_perusahaan' => $nama_perusahaan,
                    'nama_pekerjaan' => $nama_pekerjaan,
                    'id_provinsi' => $id_provinsi,
                    'is_work' => $is_work,
                    'id_users' => $this->id);
                //var_dump($data_array);die();
                $this->db->insert('t_users_pekerjaan', $data_array);
            }
        //}
        redirect('profil/pekerjaan');
    }
    function edit_upload() {
        $aplikasi = $this->aplikasi;
        if (isset($_FILES['nama_file']['tmp_name']) && !empty($_FILES['nama_file']['tmp_name'])) {
            $data['nama_file'] = time() . str_replace(' ', '_', $_FILES['nama_file']['name']);
            $config['upload_path'] = substr(__dir__, 0, strpos(__dir__, "application")) . 'repo/asesi/';
            $config['allowed_types'] = '*';
            $config['max_size'] = 1100000;
            $config['file_name'] = $data['nama_file'];
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('nama_file')) {
                echo"gagal update";
            } else {
                $data_upload = $this->upload->data();
                $data['file_size'] = round(($data_upload['file_size'] / 1024), 2) . ' MB';
                $data['extension'] = str_replace('.', '', $data_upload['file_ext']);
                //$data['id_asesi'] = $this->id;
                $data['nama_file'] = $config['file_name'];
                $data['jenis_portofolio'] = $this->input->post('jenis_portofolio');
                $data['nama_dokumen'] = $this->input->post('nama_dokumen');
                $data['description'] = $this->input->post('description');
                //var_dump($this->input->post('id'));die();
                $id= $this->input->post('id');
                $this->db->where('id',$id);
                $this->db->update('t_repositori', $data);
                redirect('bukti_pendukung/index');
            }
        }
    }
}
