<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Acls extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Acl_Model');
    }

    function index() {
        block_access_method();
    }

    function datagrid($id = false) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($id !== false) {
                $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
                $page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
                $offset = $row * ($page - 1);
                $data = array();
                $where['controller_method_id'] = intval($id);
                $params = array('_return' => 'data');
                if (isset($where))
                    $params['_where'] = $where;
                $data['total'] = isset($where) ? $this->Acl_Model->count_by($where) : $this->Acl_Model->count_all();
                $this->Acl_Model->limit($row, $offset);
                $order = $this->Acl_Model->get_params('_order');
                $rows = $this->Acl_Model->set_params($params)->with(array('role'));
                $data['rows'] = $this->Acl_Model->get_selected()->data_formatter($rows);
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

        $this->load->model('Controller_Method_Model');
        $this->load->model('Role_Model');

        if (!$id) {
            echo json_encode(array('msgType' => 'error', 'msgValue' => 'Anda belum memilih data Controller Method !'));
            exit;
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST['controller_method_id'] = intval($id);
                $data = $this->Acl_Model->set_validation()->validate();
                if ($data !== false) {
                    if ($this->Acl_Model->check_unique($data)) {
                        if ($this->Acl_Model->insert($data) !== false) {
                            echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                        } else {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                        }
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->Acl_Model->get_validation())));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
                }
            } else {
                $table = $this->Controller_Method_Model->get_params('_table');
                $params = array('_return' => 'data');
                $params['_where'] = array($table . '.id' => intval($id));
                $controllers = $this->Controller_Method_Model->set_params($params)->with(array('controller', 'method'));
                $controller = $this->Controller_Method_Model->get_single($controllers);
                $role = $this->Role_Model->dropdown('id', 'nama_peran');
                $view = $this->load->view('acls/add', array('data' => $controller, 'role' => $role, 'ajax' => array('1' => 'AJAX', '2' => 'Non AJAX')), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            }
        }
    }

    function delete($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $acls = $this->Acl_Model->get(intval($id));
                if (sizeof($acls) == 1) {
                    if ($this->Acl_Model->delete(intval($id))) {
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
        $this->load->model('V_Controller_Method_Role_Model');
        $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
        $page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
        $offset = $row * ($page - 1);
        $data = array();
        $params = array('_return' => 'data');
        if (isset($_POST['q'])) {
            $where['controller_name LIKE'] = "%" . $this->input->post('q') . "%";
        }
        if (isset($where))
            $params['_where'] = $where;
        $data['total'] = isset($where) ? $this->V_Controller_Method_Role_Model->count_by($where) : $this->V_Controller_Method_Role_Model->count_all();
        $this->V_Controller_Method_Role_Model->limit($row, $offset);
        $order_criteria = "ASC";
        $_order_escape = TRUE;
        if ($id) {
            $order = "FIELD(id, " . intval($id) . ")";
            $order_criteria = "DESC";
            $_order_escape = FALSE;
        } else {
            $order = $this->V_Controller_Method_Role_Model->get_params('_order');
        }
        $rows = isset($where) ? $this->V_Controller_Method_Role_Model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->V_Controller_Method_Role_Model->order_by($order, $order_criteria, $_order_escape)->get_all();
        $data['rows'] = $this->V_Controller_Method_Role_Model->get_selected()->data_formatter($rows);
        echo json_encode($data);
    }

}
