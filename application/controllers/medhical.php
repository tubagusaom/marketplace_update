<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Medhical extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('medhical_model');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'medhical_model', 'controller' => 'medhical', 'options' => array('id' => 'medhical','pagination','rownumber')))->load_model()->set_grid();
            $view = $this->load->view('medhical/index', array('grid' => $grid), true);
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
            $jenis_user = $this->auth->get_user_data()->jenis_user;
            if($jenis_user == 1){
                $siswa_id = $this->auth->get_user_data()->pegawai_id;
                $where['siswa_id ='] = $siswa_id;
            }

            if (isset($_POST['medhical_name']) && !empty($_POST['medhical_name'])) {
                $where['medhical_name LIKE'] = '%' . $this->input->post('medhical_name') . '%';
            }
            if (isset($_POST['nama']) && !empty($_POST['nama'])) {
                $where['nama LIKE'] = '%' . $this->input->post('nama') . '%';
            }
            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = $this->medhical_model->set_params($params)->count_with(array('nama'));
            $this->medhical_model->limit($row, $offset);
            $rows = $this->medhical_model->set_params($params)->with(array('nama'));
            $data['rows'] = $this->medhical_model->get_selected()->data_formatter($rows);

            echo json_encode($data);
        }
        else {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->medhical_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->medhical_model->check_unique($data)) {
                    if ($this->medhical_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->medhical_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $this->load->library('combogrid');
		    $siswa_grid = $this->combogrid->set_properties(array('model'=>'v_siswa_model', 'controller'=>'siswa', 'fields'=>array('nis', 'nama'), 'options'=>array('id'=>'siswa_id', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama', 'panelWidth'=>400)))->load_model()->set_grid();
            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('medhical/add',
               array('siswa_grid'=>$siswa_grid), TRUE)));

        }
    }

    function delete($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $roles = $this->medhical_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->medhical_model->delete(intval($id))) {
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
		if($_SERVER['REQUEST_METHOD'] == 'GET') {
            $schedule = $this->medhical_model->get(intval($id));
            if (sizeof($schedule) == 1) {
				$data = $this->medhical_model->get_single($schedule);
                $this->load->library('combogrid');
                $siswa_grid = $this->combogrid->set_properties(array('model'=>'v_siswa_model', 'controller'=>'siswa', 'fields'=>array('nis', 'nama'), 'options'=>array('id'=>'siswa_id', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama', 'panelWidth'=>400)))->load_model()->set_grid();
                $view = $this->load->view('medhical/edit', array('data' => $data, 'url'=>base_url() . 'medhical/edit_upload/' . $id,'siswa_grid'=>$siswa_grid), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
    }

	function upload() {
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->medhical_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->medhical_model->check_unique($data)) {
					if (isset($_FILES['fileToUpload']['tmp_name']) && !empty($_FILES['fileToUpload']['tmp_name'])) {
						$data['foto'] = str_replace(' ', '_', $_FILES['fileToUpload']['name']);
						$config['upload_path'] = substr(__dir__,0, strpos( __dir__,"application")) . 'assets/files/medhical/';
						$config['allowed_types'] = 'bmp|jpg|png|gif|jpeg|pdf|doc|docx|xls|xlsx';
						$config['max_size'] = '51200000';
						$this->load->library('upload', $config);
						if ( ! $this->upload->do_upload('fileToUpload')) {
							echo json_encode(array('msgType' => 'error', 'msgValue' => $this->upload->display_errors()));
							exit();
						}
					}
                    if ($this->medhical_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", strip_tag($this->medhical_model->get_validation()))));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
		}
	}

	function edit_upload($id = false){
	   	if (!$id) {
            data_not_found();
            exit;
        }
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->medhical_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->medhical_model->check_unique($data, intval($id))) {
					if (isset($_FILES['fileToUpload']['tmp_name']) && !empty($_FILES['fileToUpload']['tmp_name'])) {
						$schedule = $this->medhical_model->get(intval($id));
						$data['foto'] = $data['medhical_name'] . '_' . str_replace(' ', '_', $_FILES['fileToUpload']['name']);
						$config['upload_path'] = substr(__dir__,0, strpos( __dir__,"application")) . 'assets/files/medhical/';
						$config['allowed_types'] = 'bmp|jpg|png|gif|jpeg';
						$config['file_name'] = $data['foto'];
						$config['max_size'] = '51200000';

						$this->load->library('upload', $config);

						if ($this->upload->do_upload('fileToUpload')) {
							$current_file = substr(__dir__,0, strpos( __dir__,"application")) . 'assets/files/medhical/' . $schedule->foto;
							if(is_file($current_file)){
								unlink($current_file);
							}
						}
						else {
							echo json_encode(array('msgType' => 'error', 'msgValue' => strip_tags($this->upload->display_errors())));
							exit();
						}
					}else{
                        $data['foto'] = $this->input->post('foto_hidden');
                    }
                    if ($this->medhical_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->medhical_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        }
	}
    function search() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('medhical/search', '', TRUE)));
        } else {
            block_access_method();
        }
    }
    function download($id = false)
	{
		if(!$id)
		{
			block_access_method();
		}
		else
		{
			if($_SERVER['REQUEST_METHOD'] == "GET")
			{
				$docs = $this->medhical_model->get(intval($id));
				if(sizeof($docs) == 1)
				{
					$doc = $this->medhical_model->get_single($docs);
					$files = substr(__dir__,0, strpos( __dir__,"application")) . 'assets/files/medhical/' . $doc->foto;
					if(file_exists($files))
					{
						header('Cache-Control: public');
						 header('Content-Disposition: attachment; filename="' . $doc->foto . '"');
						 readfile($files);
						 die();
					} else {

						echo json_encode(array('msgType'=>'error', 'msgValue'=>'File tidak dapat ditemukan'));
					}
				}
				else
				{
					echo json_encode(array('msgType'=>'error', 'msgValue'=>'Data tidak dapat ditemukan'));
				}
			}
		}
	}
}
