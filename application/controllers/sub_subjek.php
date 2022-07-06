<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sub_subjek extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('sub_subjek_model');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'sub_subjek_model', 'controller' => 'sub_subjek', 'options' => array('id' => 'sub_subjek', 'pagination', 'rownumber')))->load_model()->set_grid();
            $view = $this->load->view('sub_subjek/index', array('grid' => $grid), true);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        } else {
            block_access_method();
        }
    }

    function datagrid($id = false) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($id !== false) {
                $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
                $page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
                $offset = $row * ($page - 1);
                $data = array();
                $where['kurikulum_id'] = intval($id);
                $params = array('_return' => 'data');
                if (isset($where))
                    $params['_where'] = $where;
                $data['total'] = isset($where) ? $this->sub_subjek_model->count_by($where) : $this->sub_subjek_model->count_all();
                $this->sub_subjek_model->limit($row, $offset);
                $order = $this->sub_subjek_model->get_params('_order');
                $rows = isset($where) ? $this->sub_subjek_model->order_by($order)->get_many_by($where) : $this->sub_subjek_model->order_by($order)->get_all();
                $data['rows'] = $this->sub_subjek_model->fields_selected(array('category','nama_subjek', 'hours'))->data_formatter($rows);
                echo json_encode($data);
            }
            else {
                echo json_encode(array('total' => 0, 'rows' => array()));
            }
        } else {
            block_access_method();
        }
    }

    function add($id = false) {
        $this->load->model('kurikulum_model');
        if (!$id) {
            echo json_encode(array('msgType' => 'error', 'msgValue' => 'Anda belum memilih data Kurikulum !'));
            exit;
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST['kurikulum_id'] = intval($id);
                $data = $this->sub_subjek_model->set_validation()->validate();
                //var_dump($data);
                //die();
                if ($data !== false) {
                    if ($this->sub_subjek_model->check_unique($data)) {
                        if ($this->sub_subjek_model->insert($data) !== false) {
                            echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                        } else {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                        }
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->sub_subjek_model->get_validation())));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
                }
            } else {
                $this->load->model('kurikulum_model');
                $kurikulum = $this->kurikulum_model->get_single($this->kurikulum_model->get($id));
                $view = $this->load->view('sub_subjek/add', array('nama_kurikulum' => $kurikulum->nama_kurikulum,'category'=>array('Ground','Flying')), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            }
        }
    }

    function edit($id = false) {

        if (!$id) {
            data_not_found();
            exit;
        } else {
            $this->load->model('kurikulum_model');

            $sub_subjek = $this->sub_subjek_model->get(intval($id));
            if (sizeof($sub_subjek) == 1) {

                $sub = $this->sub_subjek_model->get_single($sub_subjek);

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $_POST['kurikulum_id'] = $sub->kurikulum_id;

                    $data = $this->sub_subjek_model->set_validation()->validate();
                    if ($data !== false) {
                        if ($this->sub_subjek_model->check_unique($data, intval($id))) {
                            if ($this->sub_subjek_model->update(intval($id), $data) !== false) {
                                echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                            } else {
                                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                            }
                        } else {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->Menu_Model->get_validation())));
                        }
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
                    }
                } else {

                    $group = $this->kurikulum_model->get_single($this->kurikulum_model->get(intval($sub_subjek->kurikulum_id)));
                    $view = $this->load->view('sub_subjek/edit', array('data' => $sub_subjek, 'nama_kurikulum' => $group->nama_kurikulum), TRUE);
                    echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
    }

    function delete($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $acls = $this->sub_subjek_model->get(intval($id));
                if (sizeof($acls) == 1) {
                    if ($this->sub_subjek_model->delete(intval($id))) {
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

    function combogrid($id = false) {
        $this->load->model('Sub_subjek_model');
        $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
        $page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
        $offset = $row * ($page - 1);
        $data = array();
        $params = array('_return' => 'data');
        if (isset($_POST['q'])) {
            $where['nama_subjek LIKE'] = "%" . $this->input->post('q') . "%";
        }
        if (isset($where))
            $params['_where'] = $where;
        $data['total'] = isset($where) ? $this->Sub_subjek_model->count_by($where) : $this->Sub_subjek_model->count_all();
        $this->Sub_subjek_model->limit($row, $offset);
        $order_criteria = "ASC";
        $_order_escape = TRUE;
        if ($id) {
            $order = "FIELD(id, " . intval($id) . ")";
            $order_criteria = "DESC";
            $_order_escape = FALSE;
        } else {
            $order = $this->Sub_subjek_model->get_params('_order');
        }
        $rows = isset($where) ? $this->Sub_subjek_model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->Sub_subjek_model->order_by($order, $order_criteria, $_order_escape)->get_all();
        $data['rows'] = $this->Sub_subjek_model->get_selected()->data_formatter($rows);
        echo json_encode($data);
    }

}
