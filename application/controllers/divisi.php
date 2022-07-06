<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Divisi extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('divisi_model');   
	}
    
    function index() {
        $this->load->library('grid');

        $jab_grid = $this->grid->set_properties(array('model' => 'divisi_model', 'controller' => 'divisi', 'options' => array('id' => 'divisi', 'pagination', 'rownumber')))->load_model()->set_grid();

        $view = $this->load->view('divisi/index', array('jab_grid' => $jab_grid), true);

        echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
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
            $data['total'] = isset($where) ? $this->divisi_model->count_by($where) : $this->divisi_model->count_all();
            $this->divisi_model->limit($row, $offset);
            $order = $this->divisi_model->get_params('_order');
            $rows = isset($where) ? $this->divisi_model->order_by($order)->get_many_by($where) : $this->divisi_model->order_by($order)->get_all();
            $data['rows'] = $this->divisi_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else {
            block_access_method();
        }
    }
    
    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->divisi_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->divisi_model->check_unique($data)) {
                    if ($this->divisi_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->divisi_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('divisi/add', '', TRUE)));
        }
    }
    
    function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->divisi_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->divisi_model->check_unique($data, intval($id))) {
                    if ($this->divisi_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->divisi_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $divisi = $this->divisi_model->get(intval($id));
            if (sizeof($divisi) == 1) {
                $view = $this->load->view('divisi/edit', array('data' => $this->divisi_model->get_single($divisi)), TRUE);
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
            $roles = $this->divisi_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->divisi_model->delete(intval($id))) {
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