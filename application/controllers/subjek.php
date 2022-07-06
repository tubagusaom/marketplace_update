<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subjek extends MY_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('subjek_model');
    }

    function index() {
        $this->load->library('grid');
        $subjek = $this->grid->set_properties(array('model' => 'subjek_model', 'controller' => 'subjek', 'options' => array('id' => 'subjek_grid', 'pagination', 'rownumber', 'target' => array('id' => 'kurikulum_detail_grid', 'controller' => 'kurikulum_detail'))))->load_model()->set_grid();
        $kurikulum_detail = $this->grid->set_properties(array('model' => 'kurikulum_detail_model','fields' => array('nama_kurikulum', 'hours','subject_name'), 'controller' => 'kurikulum_detail','options' => array('child', 'id' => 'kurikulum_detail_grid', 'pagination', 'rownumber')))->load_model()->set_grid();
        $view = $this->load->view('subjek/index', array('var_subjek' => $subjek, 'var_kurikulum_detail' => $kurikulum_detail), true);
        echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
    }

    function datagrid() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $row = intval($this->input->post('rows')) == 0 ? 15 : intval($this->input->post('rows'));
            $page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
            $offset = $row * ($page - 1);
            $data = array();
            $params = array('_return' => 'data');
            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->subjek_model->count_by($where) : $this->subjek_model->count_all();
            $this->subjek_model->limit($row, $offset);
            $order = $this->subjek_model->get_params('_order');
            $rows = isset($where) ? $this->subjek_model->order_by($order)->get_many_by($where) : $this->subjek_model->order_by($order)->get_all();
            $data['rows'] = $this->subjek_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->subjek_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->subjek_model->check_unique($data)) {
                    if ($this->subjek_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->subjek_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('subjek/add', array(), TRUE)));
        }
    }

    function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->subjek_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->subjek_model->check_unique($data, intval($id))) {
                    if ($this->subjek_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->subjek_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $con_method = $this->subjek_model->get(intval($id));
            if (sizeof($con_method) == 1) {
                $this->load->model('Controller_Model');
                $this->load->model('Method_Model');
                $view = $this->load->view('subjek/edit', array('data' => $this->subjek_model->get_single($con_method)), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
    }

    function delete($id) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $roles = $this->subjek_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->subjek_model->delete(intval($id))) {
                    $this->load->model('sub_subjek_model');
                    $this->sub_subjek_model->delete_by(array('id' => intval($id)));
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
            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('subjek/search', '', TRUE)));
        } else {
            block_access_method();
        }
    }
    function combogrid($id = false)
	{
		$this->load->model('v_subjek_model');
		$row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows')) ;
		$page = intval($this->input->post('page'))== 0 ? 1 : intval($this->input->post('page'));
		$offset = $row * ($page - 1);
		$data = array();
		$params = array('_return'=>'data');
		if(isset($_POST['q']))
		{
			$where['nama LIKE'] = "%" . $this->input->post('q') . "%";
		}
		if(isset($where)) $params['_where'] = $where;
		$data['total'] = isset($where) ? $this->v_subjek_model->count_by($where) : $this->v_subjek_model->count_all();
		$this->v_subjek_model->limit($row, $offset);
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
			$order = $this->v_subjek_model->get_params('_order');
		}		
		$rows = isset($where) ? $this->v_subjek_model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->v_subjek_model->order_by($order, $order_criteria, $_order_escape)->get_all();
		$data['rows'] = $this->v_subjek_model->get_selected()->data_formatter($rows);
        //var_dump($data);
		echo json_encode($data);
	}
}
