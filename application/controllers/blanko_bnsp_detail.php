<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blanko_bnsp_detail extends MY_Controller {

    function __construct() {

        parent::__construct();
        $this->load->model('vblanko_bnsp_detail_model');
        $this->load->model('blanko_bnsp_detail_model');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'vblanko_bnsp_detail_model', 'controller' => 'blanko_bnsp_detail', 'options' => array('id' => 'blanko_bnsp_detail', 'pagination', 'rownumber')))->load_model()->set_grid();
            $view = $this->load->view('blanko_bnsp_detail/index', array('grid' => $grid), true);
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
            //$where['t_blanko_bnsp_detail.id !='] = "";
            if(isset($_POST['no_seri_blanko']) && !empty($_POST['no_seri_blanko']))
            {
                $where['no_seri_blanko like'] = '%' . $this->input->post('no_seri_blanko') . '%';
            }
            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->vblanko_bnsp_detail_model->count_by($where) : $this->vblanko_bnsp_detail_model->count_all();
            $this->vblanko_bnsp_detail_model->limit($row, $offset);
            $order = $this->vblanko_bnsp_detail_model->get_params('_order');
            //$rows = isset($where) ? $this->blanko_bnsp_detail_model->order_by($order)->get_many_by($where) : $this->blanko_bnsp_detail_model->order_by($order)->get_all();
            $rows = $this->vblanko_bnsp_detail_model->set_params($params)->with(array());
            $data['rows'] = $this->vblanko_bnsp_detail_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        } else {
            block_access_method();
        }
    }



    function delete($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $roles = $this->blanko_bnsp_detail_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->blanko_bnsp_detail_model->delete(intval($id))) {
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
            $data = $this->blanko_bnsp_detail_model->set_validation()->validate();

            if ($data !== false) {
                if ($this->blanko_bnsp_detail_model->check_unique($data, intval($id))) {
                    if ($this->blanko_bnsp_detail_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->blanko_bnsp_detail_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $con_method = $this->vblanko_bnsp_detail_model->get(intval($id));
            if (sizeof($con_method) == 1) {
                $status_blanko = array('Blanko Kosong','Sudah di cetak','Blanko Rusak');
                $data = $this->vblanko_bnsp_detail_model->get_single($con_method);
                //var_dump($data);
                //die();
                $view = $this->load->view('blanko_bnsp_detail/edit', array( 'data' => $data,'status_blanko' => $status_blanko ), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
    }

    function search() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
             $view = $this->load->view('blanko_bnsp_detail/search', array(), TRUE);

            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));

        } else {
            block_access_method();
        }
    }

}
