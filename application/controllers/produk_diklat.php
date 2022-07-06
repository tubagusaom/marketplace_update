<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produk_diklat extends MY_Controller {

	function __construct()
	{
		parent::__construct();
	}

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'produk_diklat_model', 'controller' => 'produk_diklat', 'options' => array('id' => 'produk_diklat','pagination','rows_number')))->load_model()->set_grid();
            $view = $this->load->view('produk_diklat/index', array('grid' => $grid), true);
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
            $data['total'] = isset($where) ? $this->produk_diklat_model->count_by($where) : $this->produk_diklat_model->count_all();
            $this->produk_diklat_model->limit($row, $offset);
            $rows = $this->produk_diklat_model->set_params($params)->with(array('kategori', 'id_kategori'));
            $data['rows'] = $this->produk_diklat_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else {
            block_access_method();
        }
    }

    function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->produk_diklat_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->produk_diklat_model->check_unique($data, intval($id))) {
                    if ($this->produk_diklat_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->produk_diklat_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $con_method = $this->produk_diklat_model->get(intval($id));
            if (sizeof($con_method) == 1) {
                $this->load->model('Artikel_Kategori_Model');
                $kategori = $this->Artikel_Kategori_Model->dropdown('id', 'kategori');

                $data = $this->produk_diklat_model->get_single($con_method);
                $view = $this->load->view('produk_diklat/edit', array('kategori' => $kategori, 'data' => $data,'url' => base_url() . 'produk_diklat/edit_upload/' . $id), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
    }


}
