<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Angkatan extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('angkatan_model');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'angkatan_model', 'controller' => 'angkatan', 'options' => array('id' => 'angkatan', 'pagination', 'rownumber')))->load_model()->set_grid();
          $view = $this->load->view('angkatan/index', array('grid' => $grid), true);
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

            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->angkatan_model->count_by($where) : $this->angkatan_model->count_all();
            $this->angkatan_model->limit($row, $offset);
            $order = $this->angkatan_model->get_params('_order');
            $rows = isset($where) ? $this->angkatan_model->order_by($order)->get_many_by($where) : $this->angkatan_model->order_by($order)->get_all();
            $data['rows'] = $this->angkatan_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        } else {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->angkatan_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->angkatan_model->check_unique($data)) {
                    if ($this->angkatan_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->angkatan_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('angkatan/add', array('status' => 1, 'bidang' => 1), TRUE)));
        }
    }

    function delete($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $roles = $this->angkatan_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->angkatan_model->delete(intval($id))) {
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
            $data = $this->angkatan_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->angkatan_model->check_unique($data, intval($id))) {
                    if ($this->angkatan_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->angkatan_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $batch = $this->angkatan_model->get(intval($id));
            if (sizeof($batch) == 1) {
                $view = $this->load->view('angkatan/edit', array('data' => $this->angkatan_model->get_single($batch)), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
    }
    function combogrid($id = false)
	{
		$row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows')) ;
		$page = intval($this->input->post('page'))== 0 ? 1 : intval($this->input->post('page'));
		$offset = $row * ($page - 1);
		$data = array();
		$params = array('_return'=>'data');
		if(isset($_POST['q']))
		{
			$where['batch_name LIKE'] = "%" . $this->input->post('q') . "%";
		}
		if(isset($where)) $params['_where'] = $where;
		$data['total'] = isset($where) ? $this->angkatan_model->count_by($where) : $this->angkatan_model->count_all();
		$this->angkatan_model->limit($row, $offset);
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
			$order = $this->angkatan_model->get_params('_order');
		}		
		$rows = isset($where) ? $this->angkatan_model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->angkatan_model->order_by($order, $order_criteria, $_order_escape)->get_all();
		$data['rows'] = $this->angkatan_model->get_selected()->data_formatter($rows);
        //var_dump($data);
		echo json_encode($data);
	}    
}
