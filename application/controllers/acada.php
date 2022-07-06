<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Acada extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('acada_model');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'acada_model', 'controller' => 'acada', 'options' => array('id' => 'acada', 'pagination', 'rownumber')))->load_model()->set_grid();
            $view = $this->load->view('acada/index', array('grid' => $grid), true);
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
            $data['total'] = isset($where) ? $this->acada_model->count_by($where) : $this->acada_model->count_all();
            $this->acada_model->limit($row, $offset);
            $rows = $this->acada_model->set_params($params)->with(array('divisi'));
            $data['rows'] = $this->acada_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else {
            block_access_method();
        }
    }

    function add() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->acada_model->set_validation()->validate();

            if ($data !== false) {
                if ($this->acada_model->check_unique($data)) {
                    if ($this->acada_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->acada_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('acada/add', array('status' => 1, 'bidang' => 1), TRUE)));
        }
    }

    function delete($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $roles = $this->acada_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->acada_model->delete(intval($id))) {
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
            $data = $this->acada_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->acada_model->check_unique($data, intval($id))) {
                    if ($this->acada_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->acada_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $siswa = $this->acada_model->get(intval($id));
            if (sizeof($siswa) == 1) {
                $view = $this->load->view('acada/edit', array('data' => $this->acada_model->get_single($siswa)), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
    }

}
