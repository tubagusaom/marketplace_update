<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profil extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('profil_model');
    }

    function index() {

        if ($this->auth->get_user_data()->jenis_user === '2') {
            $template_header = 'templates/theme_asesor/header';
            $template_body = 'templates/responsive/profil/index';
            $template_bottom = 'templates/theme_asesor/footer';
        } else {
            $template_header = 'templates/responsive/header';
            $template_body = 'templates/responsive/profil/index';
            $template_bottom = 'templates/responsive/footer';
        }

        $biodata = $this->profil_model->biodata($this->id);

        $this->load->view($template_header, array('aplikasi' => $this->aplikasi, 'query_pesan' => $this->query_pesan, 'query_pesan_unread' => $this->query_pesan_unread));
        $this->load->view($template_body, array('aplikasi' => $this->aplikasi, 'unread_message' => $this->unread_message, 'menus' => $this->menus, 'rolename' => $this->auth->get_rolename(), 'nama_user' => $this->auth->get_user_data()->nama, 'biodata' => $biodata));
        $this->load->view($template_bottom, array('aplikasi' => $this->aplikasi));
    }

    function edit() {
        $nama_user = $this->input->post('nama_user');
        $no_identitas = $this->input->post('no_identitas');
        $organisasi = $this->input->post('organisasi');
        $tempat_lahir = $this->input->post('tempat_lahir');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $kewarganegaraan = $this->input->post('kewarganegaraan');
        $hp = $this->input->post('hp');
        $alamat = $this->input->post('alamat');
        $tgl_lahir = format_mysql_date($this->input->post('tgl_lahir'));
        //var_dump($tgl_lahir);die();
        $pendidikan_terakhir = $this->input->post('pendidikan_terakhir');
        $nama_lembaga = $this->input->post('nama_lembaga');
        $jenjang = $this->input->post('jenjang');
        $gelar = $this->input->post('gelar');
        $id_user = $this->input->post('id_user');
        $pegawai_id = $this->input->post('pegawai_id');

        // var_dump($pegawai_id);die();


        $data = array('nama_user' => $nama_user,
            'no_identitas' => $no_identitas,
            'organisasi' => $organisasi,
            'tempat_lahir' => $tempat_lahir,
            'jenis_kelamin' => $jenis_kelamin,
            'kewarganegaraan' => $kewarganegaraan,
            'hp' => $hp,
            'alamat' => $alamat,
            'pendidikan_terakhir' => $pendidikan_terakhir,
            'jenjang' => $jenjang,
            'nama_lembaga' => $nama_lembaga,
            'gelar' => $gelar,
            'tgl_lahir' => $tgl_lahir);

        //var_dump($data);die();
        $this->db->where('id', $id_user);
        if ($this->db->update('t_users', $data)) {


            $datacalon = array(
                    'nama_calon' => $nama_user,
                    'nim_calon' => $no_identitas,
                    'tempat_lahir' => $tempat_lahir,
                    'kelamin_calon' => $jenis_kelamin,
                    'hp_calon' => $hp,
                    'alamat' => $alamat,
                    'tanggal_lahir' => $tgl_lahir
                );
            $this->db->where('id', $pegawai_id);
            $this->db->update('tbl007_calon_asesi', $datacalon);


            $this->session->set_flashdata('result', 'Perbaharui biodata berhasil');
                    $this->session->set_flashdata('mode_alert', 'success');
                    redirect('profil/index');

        } else {
            return false;
        }
    }

    function pekerjaan($id=false) {
        if ($this->auth->get_user_data()->jenis_user === '2') {
            $template_header = 'templates/theme_asesor/header';
            $template_body = 'templates/responsive/profil/pekerjaan';
            $template_bottom = 'templates/theme_asesor/footer';
        } else {
            $template_header = 'templates/responsive/header';
            $template_body = 'templates/responsive/profil/pekerjaan';
            $template_bottom = 'templates/responsive/footer';
        }

        // $this->db->where('id',$id);
        // $row = $this->db->get('t_users_pekerjaan')->row();
        // $id = $this->input->get('id');
        // $id = $this->db->where('id', $this->id);
        // $row = $this->db->get('t_users_pekerjaan')->row();


        // $pekerjaan = $this->db->where('id',$id);
        $pekerjaan = $this->profil_model->pekerjaan($this->id);
        $provinsi = $this->profil_model->provinsi();


        $this->load->view($template_header, array('aplikasi' => $this->aplikasi, 'query_pesan' => $this->query_pesan, 'query_pesan_unread' => $this->query_pesan_unread));
        $this->load->view($template_body, array('aplikasi' => $this->aplikasi, 'unread_message' => $this->unread_message, 'menus' => $this->menus, 'rolename' => $this->auth->get_rolename(), 'nama_user' => $this->auth->get_user_data()->nama, 'pekerjaan' => $pekerjaan, 'provinsi' => $provinsi));
        $this->load->view($template_bottom, array('aplikasi' => $this->aplikasi));
    }

    function hapus($id) {
        if (!$id) {
            redirect(base_url() . 'profil/pekerjaan');
        } else {
            $this->db->where('id', $id);
            $this->db->delete('t_users_pekerjaan');
            redirect(base_url() . 'profil/pekerjaan');
        }
    }

    function pekerjaan_update() {
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

    function pekerjaan_edit($id) {
        $id = $this->input->post('id');
        $is_work = $this->input->post('is_work');
        $nama_pekerjaan = $this->input->post('nama_pekerjaan');
        $nama_perusahaan = $this->input->post('nama_perusahaan');
        $id_provinsi = $this->input->post('id_provinsi');
        $tanggal_bergabung = $this->input->post('tanggal_bergabung');
        $tanggal_berhenti = $this->input->post('tanggal_berhenti');

            if ($id != "") {
                $data_array = array(
                    'tanggal_bergabung' => $tanggal_bergabung,
                    'tanggal_berhenti' => $tgl_berhenti,
                    'nama_perusahaan' => $nama_perusahaan,
                    'nama_pekerjaan' => $nama_pekerjaan,
                    'id_provinsi' => $id_provinsi,
                    'is_work' => $is_work);
                //var_dump($data_array);die();
                $this->db->where('id',$id);
                $this->db->update('t_users_pekerjaan', $data_array);
            }
        //}
        redirect('profil/pekerjaan');
    }

    function pendidikan() {
        $template_header = 'templates/responsive/header';
        $template_body = 'templates/responsive/profil/pendidikan';
        $template_bottom = 'templates/responsive/footer';

        $pendidikan = $this->profil_model->pendidikan($this->id);

        $this->load->view($template_header, array('aplikasi' => $this->aplikasi, 'query_pesan' => $this->query_pesan, 'query_pesan_unread' => $this->query_pesan_unread));
        $this->load->view($template_body, array('aplikasi' => $this->aplikasi, 'unread_mess
age' => $this->unread_message, 'menus' => $this->menus, 'rolename' => $this->auth->get_rolename(), 'nama_user' => $this->auth->get_user_data()->nama, 'pendidikan' => $pendidikan));
        $this->load->view($template_bottom, array('aplikasi' => $this->aplikasi));
    }

    function pendidikan_update() {
        $nama_pendidikan = $_POST['group-a'];
        //var_dump($nama_pendidikan);die();
        $this->db->where('id_users', $this->id);
        $this->db->delete('t_users_pendidikan');
        foreach ($nama_pendidikan as $key => $value) {
            if ($value['jenjang_pendidikan'] != "") {
                $data_array = array('jenjang_pendidikan' => $value['jenjang_pendidikan'],
                    'institusi_pendidikan' => $value['institusi_pendidikan'],
                    'tahun_pendidikan' => $value['tahun_pendidikan'],
                    'jurusan' => $value['jurusan'],
                    'id_users' => $this->id);
                $this->db->insert('t_users_pendidikan', $data_array);
            }
        }
        redirect('profil/pendidikan');
    }

    function foto() {
        if ($this->auth->get_user_data()->jenis_user === '2') {
            $template_header = 'templates/theme_asesor/header';
            $template_body = 'templates/responsive/profil/foto';
            $template_bottom = 'templates/theme_asesor/footer';
        } else {
            $template_header = 'templates/responsive/header';
            $template_body = 'templates/responsive/profil/foto';
            $template_bottom = 'templates/responsive/footer';
        }

        $biodata = $this->profil_model->biodata($this->id);

        $this->load->view($template_header, array('aplikasi' => $this->aplikasi, 'query_pesan' => $this->query_pesan, 'query_pesan_unread' => $this->query_pesan_unread));
        $this->load->view($template_body, array('aplikasi' => $this->aplikasi, 'unread_message' => $this->unread_message, 'menus' => $this->menus, 'rolename' => $this->auth->get_rolename(), 'nama_user' => $this->auth->get_user_data()->nama, 'biodata' => $biodata));
        $this->load->view($template_bottom, array('aplikasi' => $this->aplikasi));
    }

    function photo_update() {
        if (isset($_FILES['foto_profil']['tmp_name']) && !empty($_FILES['foto_profil']['tmp_name'])) {
            $data['foto_profil'] = time() . str_replace(' ', '_', $_FILES['foto_profil']['name']);

            $config['upload_path'] = substr(__dir__, 0, strpos(__dir__, "application")) . 'repo/profil/';
            $config['allowed_types'] = '*';
            $config['max_size'] = 1100000;
            $config['file_name'] = $data['foto_profil'];

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('foto_profil')) {
                echo"gagal update";
            } else {
                $data_upload = $this->upload->data();
                $this->db->where('id', $this->id);
                $this->db->update('t_users', array('foto_profil' => $config['file_name']));
                redirect('profil/foto');
            }
        }
    }

}
