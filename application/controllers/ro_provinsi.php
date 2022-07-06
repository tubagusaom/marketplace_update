<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ro_provinsi extends MY_Controller {

    function __construct() {

        parent::__construct();
        $this->load->model('ro_provinsi_model');
    }

    // function index() {
    //     if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //         $this->load->library('grid');
    //         $grid = $this->grid->set_properties(array('model' => 'ro_provinsi_model', 'controller' => 'member', 'options' => array('id' => 'member', 'pagination', 'rownumber')))->load_model()->set_grid();
    //         $view = $this->load->view('member/index', array('grid' => $grid), true);
    //         echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
    //     } else {
    //         block_access_method();
    //     }
    // }
    //
    // function datagrid() {
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
    //         $page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
    //         $offset = $row * ($page - 1);
    //         if(isset($_POST['member']) && !empty($_POST['member']))
    //         {
    //             $where['member LIKE'] = '%' . $this->input->post('member') . '%';
    //         }
    //
    //         // $where['id_group_member ='] = '6';
    //         $data = array();
    //         $params = array('_return' => 'data');
    //
    //         if (isset($where))
    //             $params['_where'] = $where;
    //         $data['total'] = isset($where) ? $this->ro_provinsi_model->count_by($where) : $this->ro_provinsi_model->count_all();
    //         $this->ro_provinsi_model->limit($row, $offset);
    //         $rows = $this->ro_provinsi_model->set_params($params)->with(array());
    //         $data['rows'] = $this->ro_provinsi_model->get_selected()->data_formatter($rows);
    //         echo json_encode($data);
    //     }
    //     else {
    //         block_access_method();
    //     }
    // }

    function combogrid() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
            $page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
            $offset = $row * ($page - 1);
            if(isset($_POST['q']) && !empty($_POST['q']))
            {
                $where['province_name LIKE'] = '%' . $this->input->post('q') . '%';
            }
            // $where['id_group_users ='] = '6';
            $data = array();
            $params = array('_return' => 'data');

            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->ro_provinsi_model->count_by($where) : $this->ro_provinsi_model->count_all();
            $this->ro_provinsi_model->limit($row, $offset);
            $rows = $this->ro_provinsi_model->set_params($params)->with(array());
            $data['rows'] = $this->ro_provinsi_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else {
            block_access_method();
        }
    }

}
