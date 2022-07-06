<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kategori extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('kategori_model');
    }

    function index() {
        $this->load->library('grid');
        $grid = $this->grid->set_properties(array('model' => 'kategori_model', 'controller' => 'kategori', 'options' => array('id' => 'kategori', 'pagination', 'rownumber')))->load_model()->set_grid();
        $view = $this->load->view('kategori/index', array('grid' => $grid), true);

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
            $data['total'] = isset($where) ? $this->kategori_model->count_by($where) : $this->kategori_model->count_all();
            $this->kategori_model->limit($row, $offset);
            $order = $this->kategori_model->get_params('_order');
            // $rows = isset($where) ? $this->kategori_model->order_by($order)->get_many_by($where) : $this->kategori_model->order_by($order)->get_all();
            $rows = $this->kategori_model->set_params($params)->with(array('menu_kategori'));
            $data['rows'] = $this->kategori_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->kategori_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->kategori_model->check_unique($data)) {
                    if ($this->kategori_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->kategori_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $this->load->model('menu_kategori_model');
            $this->db->order_by('menu_kategori', 'ASC');
            $menu = $this->menu_kategori_model->dropdown('id', 'menu_kategori');

            $view = $this->load->view('kategori/add', array('menu' => $menu,'url' => base_url() . 'kategori/add'), TRUE);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        }
    }

    function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->kategori_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->kategori_model->check_unique($data, intval($id))) {
                    if ($this->kategori_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->kategori_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $kategori = $this->kategori_model->get(intval($id));
            if (sizeof($kategori) == 1) {
              $this->load->model('menu_kategori_model');
              $this->db->order_by('menu_kategori', 'ASC');
              $menu = $this->menu_kategori_model->dropdown('id', 'menu_kategori');

              $view = $this->load->view('kategori/edit', array('menu' => $menu,'data' => $this->kategori_model->get_single($kategori)), TRUE);
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
            $roles = $this->kategori_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->kategori_model->delete(intval($id))) {
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
