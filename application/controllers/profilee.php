<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Profilee extends MY_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('Profilee_Model');
    }

    function index() {
        $this->load->library('grid');

        $jab_grid = $this->grid->set_properties(array('model' => 'Profilee_Model', 'controller' => 'profilee', 'options' => array('id' => 'profilee', 'pagination', 'rownumber')))->load_model()->set_grid();

        $view = $this->load->view('profilee/index', array('jab_grid' => $jab_grid), true);

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
            $data['total'] = isset($where) ? $this->Profilee_Model->count_by($where) : $this->Profilee_Model->count_all();
            $this->Profilee_Model->limit($row, $offset);
            $order = $this->Profilee_Model->get_params('_order');
            $rows = isset($where) ? $this->Profilee_Model->order_by($order)->get_many_by($where) : $this->Profilee_Model->order_by($order)->get_all();
            $data['rows'] = $this->Profilee_Model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else {
            block_access_method();
        }
    }
    
}