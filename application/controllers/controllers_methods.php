<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Controllers_Methods extends MY_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('Controller_Method_Model');
    }

    function index() {
        $this->load->library('grid');
        $cm_grid = $this->grid->set_properties(array('model' => 'Controller_Method_Model', 'controller' => 'controllers_methods', 'options' => array('id' => 'controllers_methods', 'pagination', 'rownumber', 'target' => array('id' => 'acls', 'controller' => 'acls'))))->load_model()->set_grid();

        $acl_grid = $this->grid->set_properties(array('model' => 'Acl_Model', 'controller' => 'acls', 'fields' => array('role_id', 'request_method'), 'options' => array('child', 'id' => 'acls', 'pagination', 'rownumber')))->load_model()->set_grid();

        $view = $this->load->view('controllers_methods/index', array('cm_grid' => $cm_grid, 'acl_grid' => $acl_grid), true);

        echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
    }

    function datagrid() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $row = intval($this->input->post('rows')) == 0 ? 15 : intval($this->input->post('rows'));
            $page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
            $offset = $row * ($page - 1);
            $data = array();
            $params = array('_return' => 'data');
            if (isset($_POST['nama_controller']) && !empty($_POST['nama_controller'])) {
                $where['controller_name LIKE'] = '%' . $this->input->post('nama_controller') . '%';
            }
            if (isset($_POST['nama_method']) && !empty($_POST['nama_method'])) {
                $where['method_name LIKE'] = '%' . $this->input->post('nama_method') . '%';
            }
            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = $this->Controller_Method_Model->set_params($params)->count_with(array('controller', 'method'));
            $this->Controller_Method_Model->limit($row, $offset);
            $rows = $this->Controller_Method_Model->set_params($params)->with(array('controller', 'method'));
            $data['rows'] = $this->Controller_Method_Model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else {
            block_access_method();
        }
    }

    function add() {
        $this->load->model('Acl_Model');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $controller_id = $this->input->post('controller_id');
            $method = $this->input->post('method');
            $role = $this->input->post('role');
            $request_method = $this->input->post('request_method');
            //var_dump($role);die();
            foreach ($method as $key => $value) {
                $data = array('controller_id'=>$controller_id,'method_id'=>$value);
                $this->Controller_Method_Model->insert($data);
                $id = $this->db->insert_id();
                foreach ($role as $keys => $values) {
                    $data_acl = array('controller_method_id'=>$id,'role_id'=>$values,'request_method'=>$request_method);
                    $this->Acl_Model->insert($data_acl);
                }
            }
                echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
        } else {
            $this->db->order_by('order','ASC');
            $rows_method = $this->db->get('t_method')->result();
            foreach ($rows_method as $key => $value) {
                $methods[$value->id] = $value->method_name;
            }

            $this->db->order_by('id','DESC');
            $rows_controller = $this->db->get('t_controller')->result();
            foreach ($rows_controller as $key => $value) {
                $controllers[$value->id] = $value->controller_name;
            }

            $rows_role = $this->db->get('t_role')->result();
            foreach ($rows_role as $key => $value) {
                $roles[$value->id] = $value->nama_peran;
            }

            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('controllers_methods/add', array('controller' => $controllers, 'methods' => $methods, 'ajax' => array('1' => 'AJAX', '2' => 'Non AJAX'),'roles'=>$roles), TRUE)));
        }
    }

    function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->Controller_Method_Model->set_validation()->validate();
            if ($data !== false) {
                if ($this->Controller_Method_Model->check_unique($data, intval($id))) {
                    if ($this->Controller_Method_Model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->Controller_Method_Model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $con_method = $this->Controller_Method_Model->get(intval($id));
            
            if (sizeof($con_method) == 1) {
                $this->load->model('Controller_Model');
                $this->load->model('Method_Model');
                $controllers = $this->Controller_Model->dropdown('id', 'controller_name');
                $methods = $this->Method_Model->dropdown('id', 'method_name');
                $view = $this->load->view('controllers_methods/edit', array('controller' => $controllers, 'method' => $methods, 'data' => $this->Controller_Method_Model->get_single($con_method)), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
    }

    function delete($id) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $roles = $this->Controller_Method_Model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->Controller_Method_Model->delete(intval($id))) {
                    $this->load->model('Acl_Model');
                    $this->Acl_Model->delete_by(array('controller_method_id' => intval($id)));
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

    function search() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('controllers_methods/search', '', TRUE)));
        } else {
            block_access_method();
        }
    }

}
