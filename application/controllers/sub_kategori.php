<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sub_kategori extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('sub_kategori_model');
    }

    function index() {
        $this->load->library('grid');
        $grid = $this->grid->set_properties(array('model' => 'sub_kategori_model', 'controller' => 'sub_kategori', 'options' => array('id' => 'sub_kategori', 'pagination', 'rownumber')))->load_model()->set_grid();
        $view = $this->load->view('sub_kategori/index', array('grid' => $grid), true);

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
            $data['total'] = isset($where) ? $this->sub_kategori_model->count_by($where) : $this->sub_kategori_model->count_all();
            $this->sub_kategori_model->limit($row, $offset);
            $order = $this->sub_kategori_model->get_params('_order');
            // $rows = isset($where) ? $this->sub_kategori_model->order_by($order)->get_many_by($where) : $this->sub_kategori_model->order_by($order)->get_all();
            $rows = $this->sub_kategori_model->set_params($params)->with(array('kategori'));
            $data['rows'] = $this->sub_kategori_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->sub_kategori_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->sub_kategori_model->check_unique($data)) {
                    if ($this->sub_kategori_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->sub_kategori_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $this->load->model('kategori_model');
            $this->db->order_by('kategori', 'ASC');
            $kategori = $this->kategori_model->dropdown('id', 'kategori');

            $view = $this->load->view('sub_kategori/add', array('kategori' => $kategori,'url' => base_url() . 'kategori/add'), TRUE);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        }
    }

    function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->sub_kategori_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->sub_kategori_model->check_unique($data, intval($id))) {
                    if ($this->sub_kategori_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->sub_kategori_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $sub_kategori = $this->sub_kategori_model->get(intval($id));
            if (sizeof($sub_kategori) == 1) {
              $this->load->model('kategori_model');
              $this->db->order_by('kategori', 'ASC');
              $kategori = $this->kategori_model->dropdown('id', 'kategori');

              $view = $this->load->view('sub_kategori/edit', array('kategori' => $kategori,'data' => $this->sub_kategori_model->get_single($sub_kategori)), TRUE);
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
            $roles = $this->sub_kategori_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->sub_kategori_model->delete(intval($id))) {
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
