<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kurikulum extends MY_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('kurikulum_model');
    }

    function index() {
        $this->load->library('grid');
        $kurikulum = $this->grid->set_properties(array('model' => 'kurikulum_model', 'controller' => 'kurikulum', 'options' => array('id' => 'kurikulum_grid', 'pagination', 'rownumber', 'target' => array('id' => 'sub_subject_grid', 'controller' => 'sub_subjek'))))->load_model()->set_grid();
        $sub_subject = $this->grid->set_properties(array('model' => 'sub_subjek_model', 'controller' => 'sub_subjek', 'fields' => array('category','nama_subjek', 'hours'), 'options' => array('child', 'id' => 'sub_subject_grid', 'pagination', 'rownumber')))->load_model()->set_grid();

        $view = $this->load->view('kurikulum/index', array('var_kurikulum' => $kurikulum, 'var_sub_subject' => $sub_subject), true);

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
            $data['total'] = isset($where) ? $this->kurikulum_model->count_by($where) : $this->kurikulum_model->count_all();
            $this->kurikulum_model->limit($row, $offset);
            $order = $this->kurikulum_model->get_params('_order');
            $rows = isset($where) ? $this->kurikulum_model->order_by($order)->get_many_by($where) : $this->kurikulum_model->order_by($order)->get_all();
            $data['rows'] = $this->kurikulum_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->kurikulum_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->kurikulum_model->check_unique($data)) {
                    if ($this->kurikulum_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->kurikulum_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $this->load->model('Controller_Model');
            $this->load->model('Method_Model');
            $controllers = $this->Controller_Model->dropdown('id', 'controller_name');
            $methods = $this->Method_Model->dropdown('id', 'method_name');
            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('kurikulum/add', array('controller' => $controllers, 'method' => $methods), TRUE)));
        }
    }

    function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->kurikulum_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->kurikulum_model->check_unique($data, intval($id))) {
                    if ($this->kurikulum_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->kurikulum_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $con_method = $this->kurikulum_model->get(intval($id));
            if (sizeof($con_method) == 1) {
                $this->load->model('Controller_Model');
                $this->load->model('Method_Model');
                $controllers = $this->Controller_Model->dropdown('id', 'controller_name');
                $methods = $this->Method_Model->dropdown('id', 'method_name');
                $view = $this->load->view('kurikulum/edit', array('controller' => $controllers, 'method' => $methods, 'data' => $this->kurikulum_model->get_single($con_method)), TRUE);
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
            $roles = $this->kurikulum_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->kurikulum_model->delete(intval($id))) {
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
            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('kurikulum/search', '', TRUE)));
        } else {
            block_access_method();
        }
    }
    function combogrid($id = false)
	{
		$this->load->model('v_kurikulum_model');
		$row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows')) ;
		$page = intval($this->input->post('page'))== 0 ? 1 : intval($this->input->post('page'));
		$offset = $row * ($page - 1);
		$data = array();
		$params = array('_return'=>'data');
		if(isset($_POST['q']))
		{
			$where['nama_kurikulum LIKE'] = "%" . $this->input->post('q') . "%";
		}
		if(isset($where)) $params['_where'] = $where;
		$data['total'] = isset($where) ? $this->v_kurikulum_model->count_by($where) : $this->v_kurikulum_model->count_all();
		$this->v_kurikulum_model->limit($row, $offset);
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
			$order = $this->v_kurikulum_model->get_params('_order');
		}		
		$rows = isset($where) ? $this->v_kurikulum_model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->v_kurikulum_model->order_by($order, $order_criteria, $_order_escape)->get_all();
		$data['rows'] = $this->v_kurikulum_model->get_selected()->data_formatter($rows);
        
		echo json_encode($data);
	}
}
