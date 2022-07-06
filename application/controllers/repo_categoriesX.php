<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Repo_categories extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('Categories_Model');
	}
    
    function index() {
        $this->load->library('grid');

        $grid = $this->grid->set_properties(array('model' => 'Categories_Model', 'controller' => 'repo_categories', 'options' => array('id' => 'repo_categories', 'pagination', 'rownumber')))->load_model()->set_grid();

        $view = $this->load->view('repo_categories/index', array('grid' => $grid), true);

        echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
    }

    function datagrid() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
            $page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
            $offset = $row * ($page - 1);
            $data = array();
            $params = array('_return' => 'data');
            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->Categories_Model->count_by($where) : $this->Categories_Model->count_all();
            $this->Categories_Model->limit($row, $offset);
            $order = $this->Categories_Model->get_params('_order');
            $rows = isset($where) ? $this->Categories_Model->order_by($order)->get_many_by($where) : $this->Categories_Model->order_by($order)->get_all();
            $data['rows'] = $this->Categories_Model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else
        {
            block_access_method();
        }
    }
    
    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->Categories_Model->set_validation()->validate();
            if ($data !== false) {
                if ($this->Categories_Model->check_unique($data)) {
                    if ($this->Categories_Model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->Categories_Model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('repo_categories/add', '', TRUE)));
        }
    }
    
    function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->Categories_Model->set_validation()->validate();
            if ($data !== false) {
                if ($this->Categories_Model->check_unique($data, intval($id))) {
                    if ($this->Categories_Model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->Categories_Model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $value = $this->Categories_Model->get(intval($id));
            if (sizeof($value) == 1) {
                $view = $this->load->view('repo_categories/edit', array('data' => $this->Categories_Model->get_single($value)), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
    }
    
    function delete($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $roles = $this->Categories_Model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->Categories_Model->delete(intval($id))) {
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