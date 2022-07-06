<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_pribadi extends MY_Controller {

    function __construct() {

        parent::__construct();
        $this->load->model('data_pribadi_model');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $session = $this->auth->get_user_data();
            $profil_asesor = $this->data_pribadi_model->profil_asesor($session->pegawai_id);
            $grid = $this->grid->set_properties(array('model' => 'data_pribadi_model', 'controller' => 'data_pribadi', 'options' => array('id' => 'data_pribadi', 'pagination', 'rownumber')))->load_model()->set_grid();

            $view = $this->load->view('data_pribadi/data_asesor', array('grid' => $grid,'profil_asesor' => $profil_asesor, 'url' => base_url() . 'data_pribadi/edit_upload/' . $profil_asesor->id,'sex'=>array('','Laki-Laki','Perempuan')), true);
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
            if(isset($_POST['nis']) && !empty($_POST['nis']))
			{
				$where['nis LIKE'] = '%' . $this->input->post('nis') . '%';
			}
            if(isset($_POST['nama']) && !empty($_POST['nama']))
			{
				$where['nama LIKE'] = '%' . $this->input->post('nama') . '%';
			}
            if(isset($_POST['batch_id']) && !empty($_POST['batch_id']))
			{
                if($_POST['batch_id']==0){
                    $where['batch_id LIKE'] = '%%';
                }else{
                    $where['batch_id ='] = $this->input->post('batch_id');
                }

			}
            if(isset($_POST['base']) && !empty($_POST['base']))
			{
                if($_POST['base']!=0){
                    $where['base ='] = $this->input->post('base');
                }

			}
            if(isset($_POST['current_program']) && !empty($_POST['current_program']))
			{
				$where['current_program ='] = $this->input->post('current_program');
			}
            $data = array();
            $params = array('_return' => 'data');

            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->data_pribadi_model->count_by($where) : $this->data_pribadi_model->count_all();
            $this->data_pribadi_model->limit($row, $offset);
            $rows = $this->data_pribadi_model->set_params($params)->with(array('batch_name', 'program_study'));
            //var_dump($rows);
            //die();
            $data['rows'] = $this->data_pribadi_model->get_selected()->data_formatter($rows);
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
            //if(isset($_POST['nis']) && !empty($_POST['nis']))
			//{
			//	$where['nis LIKE'] = '%' . $this->input->post('nis') . '%';
			//}
            if(isset($_POST['q']) && !empty($_POST['q']))
			{
				$where['nama LIKE'] = '%' . $this->input->post('q') . '%';
            }

            $data = array();
            $params = array('_return' => 'data');

            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->data_pribadi_model->count_by($where) : $this->data_pribadi_model->count_all();
            $this->data_pribadi_model->limit($row, $offset);
            $rows = $this->data_pribadi_model->set_params($params)->with(array('batch_name', 'program_study'));
            $data['rows'] = $this->data_pribadi_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        	$id = $this->input->post('id');
            $email = $this->input->post('email');
            $hp = $this->input->post('hp');
            $data = $this->data_pribadi_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->data_pribadi_model->check_unique($data)) {
                     if ($this->data_pribadi_model->update($id, $data) !== false) {
                        $data_users = array('hp'=>$hp,'email'=>$email);
                        $this->db->where('pegawai_id',$id);
                        $this->db->where('jenis_user',2);
                        $this->db->update('t_users',$data_users);
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->data_pribadi_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
        	$this->load->library('combogrid');
                $files = $this->combogrid->set_properties(array('model'=>'repositori_model', 'controller'=>'combo_files', 'fields'=>array('nama_dokumen','nama_file','file_size'), 'options'=>array('id'=>'foto_user', 'pagination', 'rownumber', 'idField'=>'nama_file', 'textField'=>'nama_dokumen', 'panelWidth'=>500,
                    'queryParams'=>array('name'=>'easui')
                    )))->load_model()->set_grid();

        	$user_id = $this->auth->get_user_data()->id;
        	$session = $this->auth->get_user_data();
            $profil_asesor = $this->data_pribadi_model->profil_asesor($session->pegawai_id);

            $view = $this->load->view('data_pribadi/add', array('akun'=>$this->auth->get_user_data()->akun,'files'=>$files,'user_id'=>$user_id,'profil_asesor' => $profil_asesor, 'url' => base_url() . 'data_pribadi/upload/' . $profil_asesor->id,'sex'=>array('','Laki-Laki','Perempuan')), TRUE);

            echo json_encode(array('msgType' => 'success', 'msgValue' => $view, 'title'=>'Profil Asesor', 'width'=>600, 'height'=>450));
        }
    }

    function delete($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $roles = $this->data_pribadi_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->data_pribadi_model->delete(intval($id))) {
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
            $data = $this->data_pribadi_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->data_pribadi_model->check_unique($data, intval($id))) {
                    if ($this->data_pribadi_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->data_pribadi_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $con_method = $this->data_pribadi_model->get(intval($id));
            if (sizeof($con_method) == 1) {

                $this->load->model('angkatan_model');
                $this->load->model('program_model');
                $angkatan = $this->angkatan_model->dropdown('id', 'batch_name');
                $program = $this->program_model->dropdown('id', 'program_study');

                $data = $this->data_pribadi_model->get_single($con_method);
                $view = $this->load->view('data_pribadi/edit', array('program' => $program, 'angkatan' => $angkatan, 'data' => $data, 'url' => base_url() . 'data_pribadi/edit_upload/' . $id, 'gender' => array('Laki-laki', 'Perempuan'),
                    'agama' => array('Islam', 'Kristen Katolik', 'Kristen Protestan', 'Hindu', 'Budha', 'Kong Hu Chu'),
                    'current_program' => array('-Pilih-','PPL Ground', 'CPL-IR Ground', 'PPL Flight', 'CPL Flight','IR','ME','CRM','Avsec','DG'),
                    'base' => array('-Pilih-', 'BTO', 'CBN', 'BKS'),), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
    }

    function cetak($id,$type = "pdf") {
        $this->db->where('id',$id);
        $data['data']=$this->db->get('t_data_pribadi')->row();
        $data['gender'] = array('Laki-laki', 'Perempuan');
        $data['agama'] = array('Islam', 'Kristen', 'Hindu', 'Budha', 'Khonghucu');
        $data['current_program'] = array('-Pilih-','PPL Ground', 'CPL-IR Ground', 'PPL Flight', 'CPL Flight','IR','ME','CRM','Avsec','DG');
        $data['base'] = array('-Pilih-', 'BTO', 'CBN', 'BKS');

        $this->load->model('angkatan_model');
        $this->load->model('program_model');
        $angkatan = $this->angkatan_model->dropdown('id', 'batch_name');
        $program = $this->program_model->dropdown('id', 'program_study');

        $data['angkatan'] = $angkatan;
        $data['program']  = $program;
        //$gender =
		$view = $this->load->view('data_pribadi/cetak',$data , true);
		if($type=="pdf") {
			$this->load->library("htm12pdf");
			$this->htm12pdf->pdf_create($view, "report_student_" . date('YmdHis') . ".pdf", false, true);
		}
	}

    function upload() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->data_pribadi_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->data_pribadi_model->check_unique($data)) {
                    if (isset($_FILES['fileToUpload']['tmp_name']) && !empty($_FILES['fileToUpload']['tmp_name'])) {
                        $data['foto'] = str_replace(' ', '_', $_FILES['fileToUpload']['name']);
                        $config['upload_path'] = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/img/data_pribadi/';
                        $config['allowed_types'] = 'bmp|jpg|png|gif|jpeg';
                        $config['max_size'] = '5120000000';

                        $this->load->library('upload', $config);

                        if (!$this->upload->do_upload('fileToUpload')) {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => $this->upload->display_errors()));
                            exit();
                        }
                    } else {
						$data['foto'] = "";
					}
                    if ($this->data_pribadi_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", strip_tag($this->data_pribadi_model->get_validation()))));
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
            $data = $this->data_pribadi_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->data_pribadi_model->check_unique($data, intval($id))) {
                    if (isset($_FILES['fileToUpload']['tmp_name']) && !empty($_FILES['fileToUpload']['tmp_name'])) {
                        $data_pribadi = $this->data_pribadi_model->get(intval($id));
                        $data['foto_user'] = $data['nis'] . '_' . str_replace(' ', '_', $_FILES['fileToUpload']['name']);
                        $config['upload_path'] = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/img/foto_asesor/';
                        $config['allowed_types'] = 'bmp|jpg|png|gif|jpeg';
                        $config['file_name'] = $data['foto'];
                        $config['max_size'] = '51200000000';

                        $this->load->library('upload', $config);

                        if ($this->upload->do_upload('fileToUpload')) {
                            $current_file = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/img/foto_asesor/' . $data_pribadi->foto;
                            if (is_file($current_file)) {
                                unlink($current_file);
                            }
                        } else {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => strip_tags($this->upload->display_errors())));
                            exit();
                        }
                    }else{
                        $data['foto_user'] = $this->input->post('foto_hidden');
                    }
                    if ($this->data_pribadi_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->data_pribadi_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        }
    }

    function search() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            $this->load->model('angkatan_model');
            $angkatan = $this->angkatan_model->dropdown('id', 'batch_name');
            array_unshift($angkatan,"-Semua Angkatan-");

            $view = $this->load->view('data_pribadi/search', array('angkatan' => $angkatan,'base' => array('-Pilih-','BTO','CBN','BKS'),'current_program'=>array('-Pilih-','PPL Ground', 'CPL-IR Ground', 'PPL Flight', 'CPL Flight','IR','ME','CRM','Avsec','DG'),
            'hidden' => true), TRUE);

            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));

        } else {
            block_access_method();
        }
    }
    function view($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
            $con_method = $this->data_pribadi_model->get(intval($id));
            if (sizeof($con_method) == 1) {

                $this->load->model('angkatan_model');
                $this->load->model('program_model');
                $angkatan = $this->angkatan_model->dropdown('id', 'batch_name');
                $program = $this->program_model->dropdown('id', 'program_study');

                $data = $this->data_pribadi_model->get_single($con_method);
                $view = $this->load->view('data_pribadi/view', array('program' => $program, 'angkatan' => $angkatan, 'data' => $data, 'url' => base_url() . 'data_pribadi/edit_upload/' . $id, 'gender' => array('Laki-laki', 'Perempuan'),
                    'agama' => array('Islam', 'Kristen', 'Hindu', 'Budha', 'Khonghucu'),
                    'current_program' => array('-Pilih-','PPL Ground', 'CPL-IR Ground', 'PPL Flight', 'CPL Flight','IR','ME','CRM','Avsec','DG'),
                    'base' => array('-Pilih-', 'BTO', 'CBN', 'BKS'),), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
}
