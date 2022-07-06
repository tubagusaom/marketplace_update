<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Siswa_schedule extends MY_Controller {

	function __construct() {
	    parent::__construct();
        $this->load->model('v_schedule_model');
        $this->load->model('schedule_model');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'v_schedule_model', 'controller' => 'siswa_schedule', 'options' => array('id' => 'siswa_schedule','pagination','rownumber')))->load_model()->set_grid();
            $view = $this->load->view('siswa_schedule/index', array('grid' => $grid), true);
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
            $id = $this->auth->get_user_data()->pegawai_id;
            $where['siswa_id ='] = $id;
            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->v_schedule_model->count_by($where) : $this->v_schedule_model->count_all();
            $this->v_schedule_model->limit($row, $offset);
            $rows = $this->v_schedule_model->set_params($params)->with(array());
            $data['rows'] = $this->v_schedule_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else {
            block_access_method();
        }
    }
}