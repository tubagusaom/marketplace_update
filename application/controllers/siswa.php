<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Siswa extends MY_Controller {

    function __construct() {

        parent::__construct();
        $this->load->model('Siswa_Model');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'Siswa_Model', 'controller' => 'siswa', 'options' => array('id' => 'siswa', 'pagination', 'rownumber')))->load_model()->set_grid();
            $view = $this->load->view('siswa/index', array('grid' => $grid), true);
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
            $data['total'] = isset($where) ? $this->Siswa_Model->count_by($where) : $this->Siswa_Model->count_all();
            $this->Siswa_Model->limit($row, $offset);
            $rows = $this->Siswa_Model->set_params($params)->with(array('batch_name', 'program_study'));
            $data['rows'] = $this->Siswa_Model->get_selected()->data_formatter($rows);
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
            $data['total'] = isset($where) ? $this->Siswa_Model->count_by($where) : $this->Siswa_Model->count_all();
            $this->Siswa_Model->limit($row, $offset);
            $rows = $this->Siswa_Model->set_params($params)->with(array('batch_name', 'program_study'));
            $data['rows'] = $this->Siswa_Model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->Siswa_Model->set_validation()->validate();
            if ($data !== false) {
                if ($this->Siswa_Model->check_unique($data)) {
                    if ($this->Siswa_Model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->Siswa_Model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $this->load->model('angkatan_model');
            $this->load->model('program_model');
            $angkatan = $this->angkatan_model->dropdown('id', 'batch_name');
            //var_dump($angkatan);
            $program = $this->program_model->dropdown('id', 'program_study');

            $view = $this->load->view('siswa/add', array('program' => $program, 'gender' => array('laki-laki', 'perempuan'),
                'agama' => array('Islam', 'Kristen', 'Hindu', 'Budha', 'Khonghucu'),
                'current_program' => array('-Pilih-','PPL Ground', 'CPL-IR Ground', 'PPL Flight', 'CPL Flight','IR','ME','CRM','Avsec','DG'),'base' => array('-Pilih-', 'BTO', 'CBN', 'BKS'),
                'angkatan' => $angkatan, 'url' => base_url() . 'siswa/upload'), TRUE);

            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        }
    }

    function delete($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $roles = $this->Siswa_Model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->Siswa_Model->delete(intval($id))) {
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
            $data = $this->Siswa_Model->set_validation()->validate();
            if ($data !== false) {
                if ($this->Siswa_Model->check_unique($data, intval($id))) {
                    if ($this->Siswa_Model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->Siswa_Model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $con_method = $this->Siswa_Model->get(intval($id));
            if (sizeof($con_method) == 1) {

                $this->load->model('angkatan_model');
                $this->load->model('program_model');
                $angkatan = $this->angkatan_model->dropdown('id', 'batch_name');
                $program = $this->program_model->dropdown('id', 'program_study');

                $data = $this->Siswa_Model->get_single($con_method);
                $view = $this->load->view('siswa/edit', array('program' => $program, 'angkatan' => $angkatan, 'data' => $data, 'url' => base_url() . 'siswa/edit_upload/' . $id, 'gender' => array('laki-laki', 'perempuan'),
                    'agama' => array('Islam', 'Kristen', 'Hindu', 'Budha', 'Khonghucu'),
                    'current_program' => array('-Pilih-','PPL Ground', 'CPL-IR Ground', 'PPL Flight', 'CPL Flight','IR','ME','CRM','Avsec','DG'),
                    'base' => array('-Pilih-', 'BTO', 'CBN', 'BKS'),), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
    }
    function upload() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->Siswa_Model->set_validation()->validate();
            if ($data !== false) {
                if ($this->Siswa_Model->check_unique($data)) {
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
                    if ($this->Siswa_Model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", strip_tag($this->Siswa_Model->get_validation()))));
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
            $data = $this->Siswa_Model->set_validation()->validate();
            if ($data !== false) {
                if ($this->Siswa_Model->check_unique($data, intval($id))) {
                    if (isset($_FILES['fileToUpload']['tmp_name']) && !empty($_FILES['fileToUpload']['tmp_name'])) {
                        $siswa = $this->Siswa_Model->get(intval($id));
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
                    if ($this->Siswa_Model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->Siswa_Model->get_validation())));
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
            
            $view = $this->load->view('siswa/search', array('angkatan' => $angkatan,'base' => array('-Pilih-','BTO','CBN','BKS'),'current_program'=>array('-Pilih-','PPL Ground', 'CPL-IR Ground', 'PPL Flight', 'CPL Flight','IR','ME','CRM','Avsec','DG'),
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
            $con_method = $this->Siswa_Model->get(intval($id));
            if (sizeof($con_method) == 1) {

                $this->load->model('angkatan_model');
                $this->load->model('program_model');
                $angkatan = $this->angkatan_model->dropdown('id', 'batch_name');
                $program = $this->program_model->dropdown('id', 'program_study');

                $data = $this->Siswa_Model->get_single($con_method);
                $view = $this->load->view('siswa/view', array('program' => $program, 'angkatan' => $angkatan, 'data' => $data, 'url' => base_url() . 'siswa/edit_upload/' . $id, 'gender' => array('laki-laki', 'perempuan'),
                    'agama' => array('Islam', 'Kristen', 'Hindu', 'Budha', 'Khonghucu'),
                    'current_program' => array('-Pilih-','PPL Ground', 'CPL-IR Ground', 'PPL Flight', 'CPL Flight','IR','ME','CRM','Avsec','DG'),
                    'base' => array('-Pilih-', 'BTO', 'CBN', 'BKS'),), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
}
