<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Aircraft_certificate extends MY_Controller {

    function __construct() {

        parent::__construct();
        $this->load->model('aircraft_certificate_model');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'aircraft_certificate_model', 'controller' => 'aircraft_certificate', 'options' => array('id' => 'aircraft_certificate','pagination','rownumber')))->load_model()->set_grid();
            $view = $this->load->view('aircraft_certificate/index', array('grid' => $grid), true);
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
            if (isset($_POST['certificate_name']) && !empty($_POST['certificate_name'])) {
                $where['certificate_name LIKE'] = '%' . $this->input->post('certificate_name') . '%';
            }
            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = $this->aircraft_certificate_model->set_params($params)->count_with(array('plane'));
            $this->aircraft_certificate_model->limit($row, $offset);
            $rows = $this->aircraft_certificate_model->set_params($params)->with(array('plane'));
            $data['rows'] = $this->aircraft_certificate_model->get_selected()->data_formatter($rows);

            echo json_encode($data);
        }
        else {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->aircraft_certificate_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->aircraft_certificate_model->check_unique($data)) {
                    if ($this->aircraft_certificate_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->aircraft_certificate_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $this->load->library('combogrid');
		    $plane_grid = $this->combogrid->set_properties(array('model' => 'v_plane_model', 'controller' => 'plane', 'fields' => array('plane_code', 'plane_name','status'), 'options' => array('id' => 'plane_id', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'plane_name', 'panelWidth' => 550)))->load_model()->set_grid();

            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('aircraft_certificate/add',
               array('plane_grid'=>$plane_grid), TRUE)));

        }
    }

    function delete($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $roles = $this->aircraft_certificate_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->aircraft_certificate_model->delete(intval($id))) {
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
            $schedule = $this->aircraft_certificate_model->get(intval($id));
            if (sizeof($schedule) == 1) {
				$data = $this->aircraft_certificate_model->get_single($schedule);
                $this->load->library('combogrid');
                $plane_grid = $this->combogrid->set_properties(array('model' => 'v_plane_model', 'controller' => 'plane', 'fields' => array('plane_code', 'plane_name','status'), 'options' => array('id' => 'plane_id', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'plane_name', 'panelWidth' => 550)))->load_model()->set_grid();

                $view = $this->load->view('aircraft_certificate/edit', array('data' => $data, 'url'=>base_url() . 'aircraft_certificate/edit_upload/' . $id,'plane_grid'=>$plane_grid), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
    }

	function upload() {
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		  $plane_id = $this->input->post('plane_id');
            $data = $this->aircraft_certificate_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->aircraft_certificate_model->check_unique($data)) {
					if (isset($_FILES['fileToUpload']['tmp_name']) && !empty($_FILES['fileToUpload']['tmp_name'])) {
					    $data['foto'] = date('Y-m-d').'-'.$plane_id.'-'.str_replace(' ', '_', $_FILES['fileToUpload']['name']);

						//$data['foto'] = str_replace(' ', '_', $_FILES['fileToUpload']['name']);
						$config['upload_path'] = substr(__dir__,0, strpos( __dir__,"application")) . 'assets/files/aircraft_certificate/';
						$config['allowed_types'] = 'bmp|jpg|png|gif|jpeg|pdf|doc|docx|xls|xlsx|zip|rar';
						$config['max_size'] = '51200000';
                        $config['file_name'] = date('Y-m-d').'-'.$plane_id.'-'.str_replace(' ', '_', $_FILES['fileToUpload']['name']);

						$this->load->library('upload', $config);

						if ( ! $this->upload->do_upload('fileToUpload')) {
							echo json_encode(array('msgType' => 'error', 'msgValue' => $this->upload->display_errors()));
							exit();
						}
					}
                    if ($this->aircraft_certificate_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", strip_tag($this->aircraft_certificate_model->get_validation()))));
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
		  $plane_id = $this->input->post('plane_id');
		  $data['foto'] = date('Y-m-d').'-'.$plane_id.'-'.str_replace(' ', '_', $_FILES['fileToUpload']['name']);

            $data = $this->aircraft_certificate_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->aircraft_certificate_model->check_unique($data, intval($id))) {
					if (isset($_FILES['fileToUpload']['tmp_name']) && !empty($_FILES['fileToUpload']['tmp_name'])) {
						$schedule = $this->aircraft_certificate_model->get(intval($id));
						$data['foto'] = date('Y-m-d').'-'.$plane_id.'-'.str_replace(' ', '_', $_FILES['fileToUpload']['name']);
                        $config['upload_path'] = substr(__dir__,0, strpos( __dir__,"application")) . 'assets/files/aircraft_certificate/';
						$config['allowed_types'] = 'bmp|jpg|png|gif|jpeg|pdf|doc|docx|xls|xlsx|zip|rar';
						$config['file_name'] = $data['foto'];
						$config['max_size'] = '51200000';
                        $config['file_name'] = date('Y-m-d').'-'.$plane_id.'-'.str_replace(' ', '_', $_FILES['fileToUpload']['name']);

						$this->load->library('upload', $config);

						if ($this->upload->do_upload('fileToUpload')) {
							$current_file = substr(__dir__,0, strpos( __dir__,"application")) . 'assets/files/aircraft_certificate/' . $schedule->foto;
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
                    if ($this->aircraft_certificate_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->aircraft_certificate_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        }
	}
    function search() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('aircraft_certificate/search', '', TRUE)));
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
				$docs = $this->aircraft_certificate_model->get(intval($id));
				if(sizeof($docs) == 1)
				{
					$doc = $this->aircraft_certificate_model->get_single($docs);
					$files = substr(__dir__,0, strpos( __dir__,"application")) . 'assets/files/aircraft_certificate/' . $doc->foto;
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
