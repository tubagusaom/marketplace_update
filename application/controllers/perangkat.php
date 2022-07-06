<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perangkat extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('skema_model');
        $this->load->model('asesor_model');
        $this->load->model('perangkat_model');
	}

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'perangkat_model', 'controller' => 'perangkat', 'options' => array('id' => 'perangkat','pagination','rownumber')))->load_model()->set_grid();
            $view = $this->load->view('perangkat/index', array('grid' => $grid), true);
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
            $data['total'] = isset($where) ? $this->perangkat_model->count_by($where) : $this->perangkat_model->count_all();
            $this->perangkat_model->limit($row, $offset);
            $rows = $this->perangkat_model->set_params($params)->with(array(''));
            //$rows = $this->perangkat_model->set_params($params)->with(array('kategori', 'id_kategori'));
            $data['rows'] = $this->perangkat_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else {
            block_access_method();
        }
    }

}
