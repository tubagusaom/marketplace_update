<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu_kategori extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('menu_kategori_model');
    }

    function index() {
        $this->load->library('grid');
        $grid = $this->grid->set_properties(array('model' => 'menu_kategori_model', 'controller' => 'menu_kategori', 'options' => array('id' => 'menu_kategori', 'pagination', 'rownumber')))->load_model()->set_grid();
        $view = $this->load->view('menu_kategori/index', array('grid' => $grid), true);

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
            $data['total'] = isset($where) ? $this->menu_kategori_model->count_by($where) : $this->menu_kategori_model->count_all();
            $this->menu_kategori_model->limit($row, $offset);
            $order = $this->menu_kategori_model->get_params('_order');
            $rows = isset($where) ? $this->menu_kategori_model->order_by($order)->get_many_by($where) : $this->menu_kategori_model->order_by($order)->get_all();
            $data['rows'] = $this->menu_kategori_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->menu_kategori_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->menu_kategori_model->check_unique($data)) {
                    if ($this->menu_kategori_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->menu_kategori_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('menu_kategori/add', '', TRUE)));
        }
    }

    function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->menu_kategori_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->menu_kategori_model->check_unique($data, intval($id))) {
                    if ($this->menu_kategori_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->menu_kategori_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $menu = $this->menu_kategori_model->get(intval($id));
            if (sizeof($menu) == 1) {
                $view = $this->load->view('menu_kategori/edit', array('data' => $this->menu_kategori_model->get_single($menu)), TRUE);
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
            $roles = $this->menu_kategori_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->menu_kategori_model->delete(intval($id))) {
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

    function combogrid($id = false) {
        $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
        $page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
        $offset = $row * ($page - 1);
        $data = array();
        $params = array('_return' => 'data');
        if (isset($_POST['q'])) {
            $where['nama_menu LIKE'] = "%" . $this->input->post('q') . "%";
        }
        if (isset($where))
            $params['_where'] = $where;
        $data['total'] = isset($where) ? $this->menu_kategori_model->count_by($where) : $this->menu_kategori_model->count_all();
        $this->menu_kategori_model->limit($row, $offset);
        $order_criteria = "ASC";
        $_order_escape = TRUE;
        if ($id) {
            $order = "FIELD(id, " . intval($id) . ")";
            $order_criteria = "DESC";
            $_order_escape = FALSE;
        } else {
            $order = $this->menu_kategori_model->get_params('_order');
        }
        $rows = isset($where) ? $this->menu_kategori_model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->menu_kategori_model->order_by($order, $order_criteria, $_order_escape)->get_all();
        $data['rows'] = $this->menu_kategori_model->get_selected()->data_formatter($rows);
        echo json_encode($data);
    }

}
