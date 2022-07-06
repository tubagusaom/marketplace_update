<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Berita extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Berita_Model');
    }

    function index() {
        $this->load->library('grid');

        $jab_grid = $this->grid->set_properties(array('model' => 'Berita_Model', 'controller' => 'berita', 'options' => array('id' => 'berita', 'pagination', 'rownumber')))->load_model()->set_grid();

        $view = $this->load->view('berita/index', array('berita_grid' => $jab_grid), true);

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
            $data['total'] = isset($where) ? $this->Berita_Model->count_by($where) : $this->Berita_Model->count_all();
            $this->Berita_Model->limit($row, $offset);
            $order = $this->Berita_Model->get_params('_order');
            $rows = isset($where) ? $this->Berita_Model->order_by($order)->get_many_by($where) : $this->Berita_Model->order_by($order)->get_all();
            $data['rows'] = $this->Berita_Model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->Berita_Model->set_validation()->validate();
            if ($data !== false) {
                if ($this->Berita_Model->check_unique($data)) {
                    if ($this->Berita_Model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->Berita_Model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('berita/add', '', TRUE)));
        }
    }

    function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->Berita_Model->set_validation()->validate();
            if ($data !== false) {
                if ($this->Berita_Model->check_unique($data, intval($id))) {
                    if ($this->Berita_Model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->Berita_Model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $berita = $this->Berita_Model->get(intval($id));
            if (sizeof($berita) == 1) {
                $view = $this->load->view('berita/edit', array('data' => $this->Berita_Model->get_single($berita)), TRUE);
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
            $roles = $this->Berita_Model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->Berita_Model->delete(intval($id))) {
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
            $where['nama_berita LIKE'] = "%" . $this->input->post('q') . "%";
        }
        if (isset($where))
            $params['_where'] = $where;
        $data['total'] = isset($where) ? $this->Berita_Model->count_by($where) : $this->Berita_Model->count_all();
        $this->Berita_Model->limit($row, $offset);
        $order_criteria = "ASC";
        $_order_escape = TRUE;
        if ($id) {
            $order = "FIELD(id, " . intval($id) . ")";
            $order_criteria = "DESC";
            $_order_escape = FALSE;
        } else {
            $order = $this->Berita_Model->get_params('_order');
        }
        $rows = isset($where) ? $this->Berita_Model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->Berita_Model->order_by($order, $order_criteria, $_order_escape)->get_all();
        $data['rows'] = $this->Berita_Model->get_selected()->data_formatter($rows);
        echo json_encode($data);
    }

}
