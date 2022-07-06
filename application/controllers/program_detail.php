<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Program_detail extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('program_detail_model');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'program_detail_model','fields' => array('subject_name', 'total_hours','abr'), 'controller' => 'program_detail', 'options' => array('id' => 'program_detail', 'pagination', 'rownumber')))->load_model()->set_grid();
            $view = $this->load->view('program_detail/index', array('grid' => $grid), true);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        } else {
            block_access_method();
        }
    }

    function datagrid($id = false) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($id !== false) {
                $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
                $page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
                $offset = $row * ($page - 1);
                $data = array();
                $where['program_id'] = intval($id);
                $params = array('_return' => 'data');
                if (isset($where))
                $params['_where'] = $where;
                $data['total'] = isset($where) ? $this->program_detail_model->count_by($where) : $this->program_detail_model->count_all();
                $this->program_detail_model->limit($row, $offset);
                $rows = $this->program_detail_model->set_params($params)->with(array('program_study','nama_subjek'));
                $data['rows'] = $this->program_detail_model->fields_selected(array('subject_name', 'total_hours','abr'))->data_formatter($rows);
                echo json_encode($data);
            }
            else {
                echo json_encode(array('total' => 0, 'rows' => array()));
            }
        } else {
            block_access_method();
        }
    }

    function add($id = false) {
        if (!$id) {
            echo json_encode(array('msgType' => 'error', 'msgValue' => 'Anda belum memilih data Kurikulum !'));
            exit;
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST['program_id'] = intval($id);
                $data = $this->program_detail_model->set_validation()->validate();
                if ($data !== false) {
                    if ($this->program_detail_model->check_unique($data)) {
                        if ($this->program_detail_model->insert($data) !== false) {
                            echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                        } else {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                        }
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->program_detail_model->get_validation())));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
                }
            } else {
                $this->load->model('program_model');
                $this->load->model('subjek_model');
                $subject_dropdown = $this->subjek_model->dropdown('id', 'subject_name');
                
                $program= $this->program_model->get_single($this->program_model->get($id));
                $view = $this->load->view('program_detail/add', array('subject_dropdown'=>$subject_dropdown,'program_study'=>$program->program_study), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            }
        }
    }

    function edit($id = false) {

        if (!$id) {
            data_not_found();
            exit;
        } else {
            $this->load->model('subjek_model');

            $sub_subjek = $this->program_detail_model->get(intval($id));
            if (sizeof($sub_subjek) == 1) {

                $sub = $this->program_detail_model->get_single($sub_subjek);

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $_POST['program_id'] = $sub->program_id;

                    $data = $this->program_detail_model->set_validation()->validate();
                    if ($data !== false) {
                        if ($this->program_detail_model->check_unique($data, intval($id))) {
                            if ($this->program_detail_model->update(intval($id), $data) !== false) {
                                echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                            } else {
                                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                            }
                        } else {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->Menu_Model->get_validation())));
                        }
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
                    }
                } else {

                    $subjek = $this->subjek_model->get_single($this->subjek_model->get(intval($sub->program_id)));
                    $view = $this->load->view('program_detail/edit', array('data' => $sub, 'program_study' => $program->program_study), TRUE);
                    echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
    }

    function delete($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $acls = $this->program_detail_model->get(intval($id));
                if (sizeof($acls) == 1) {
                    if ($this->program_detail_model->delete(intval($id))) {
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
	
	function combogrid($id = false) {
		$this->load->model('program_detail_model');
		$row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows')) ;
		$page = intval($this->input->post('page'))== 0 ? 1 : intval($this->input->post('page'));
		$offset = $row * ($page - 1);
		$data = array();
		$params = array('_return'=>'data');
		if(isset($_POST['q']))
		{
			$where['subject_name LIKE'] = "%" . $this->input->post('q') . "%";
		}
		if(isset($_POST['program_id']))
		{
			$where['program_id LIKE'] = "%" . $this->input->post('program_id') . "%";
		}
		if(isset($where)) $params['_where'] = $where;
		$data['total'] = isset($where) ? $this->program_detail_model->count_by($where) : $this->program_detail_model->count_all();
        $this->program_detail_model->limit($row, $offset);
		$order_criteria = "ASC";
		$_order_escape = TRUE;
		
		if($id)
		{
			$order = "FIELD(id, " . intval($id) . ")";
			$order_criteria = "DESC";
			$_order_escape = FALSE;
		}
		else
		{
			$order = $this->program_detail_model->get_params('_order');
		}		
		
		$rows = $this->program_detail_model->set_params($params)->with(array('subject_name'));
		$data['rows'] = $this->program_detail_model->fields_selected(array('subject_name', 'total_hours'))->data_formatter($rows);
		echo json_encode($data);	
	}
	
}
