<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produk extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('produk_model');
	}

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'produk_model', 'controller' => 'produk', 'options' => array('id' => 'produk','pagination','rownumber')))->load_model()->set_grid();
            $view = $this->load->view('produk/index', array('grid' => $grid), true);
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
            $data['total'] = isset($where) ? $this->produk_model->count_by($where) : $this->produk_model->count_all();
            $this->produk_model->limit($row, $offset);
            $rows = $this->produk_model->set_params($params)->with(array('nama_trainer', 'id_trainer'));
            $data['rows'] = $this->produk_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->produk_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->produk_model->check_unique($data)) {
                    if ($this->produk_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->produk_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $this->load->model('trainer_model');
            $narasumber = $this->trainer_model->dropdown('id', 'nama_trainer');

            $view = $this->load->view('produk/add', array('nama_trainer' => $narasumber), TRUE);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        }
    }
    
    function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->produk_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->produk_model->check_unique($data, intval($id))) {
                    if ($this->produk_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->produk_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $con_method = $this->produk_model->get(intval($id));
            if (sizeof($con_method) == 1) {
	            $this->load->model('trainer_model');
	            $narasumber = $this->trainer_model->dropdown('id', 'nama_trainer');

                $data = $this->produk_model->get_single($con_method);
                $view = $this->load->view('produk/edit', array('nama_trainer' => $narasumber, 'data' => $data), TRUE);
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
            $roles = $this->produk_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->produk_model->delete(intval($id))) {
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