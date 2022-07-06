<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faq extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Faq_Model');
        $this->load->model('artikel_model');
    }

    function index()
    {
        $this->load->library('grid');
        $grid = $this->grid->set_properties(array('model' => 'Faq_Model', 'controller' => 'faq',
        'options' => array('id' => 'faq', 'pagination', 'rownumber')))->load_model()->set_grid();
        $view = $this->load->view('faq/index', array('grid' => $grid), true);
        echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
    }

    function datagrid()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
            $page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
            $offset = $row * ($page - 1);
            $data = array();
            $params = array('_return' => 'data');
            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->Faq_Model->count_by($where) : $this->Faq_Model->count_all();
            $this->Faq_Model->limit($row, $offset);
            $order = $this->Faq_Model->get_params('_order');
            $rows = isset($where) ? $this->Faq_Model->order_by($order)->get_many_by($where) : $this->Faq_Model->order_by($order)->get_all();
            $data['rows'] = $this->Faq_Model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else
        {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->Faq_Model->set_validation()->validate();
            if ($data !== false) {
                if ($this->Faq_Model->check_unique($data)) {
                    if ($this->Faq_Model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->Faq_Model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('faq/add', '', TRUE)));
        }
    }

    function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->Faq_Model->set_validation()->validate();
            if ($data !== false) {
                if ($this->Faq_Model->check_unique($data, intval($id))) {
                    if ($this->Faq_Model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->Faq_Model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $value = $this->Faq_Model->get(intval($id));
            if (sizeof($value) == 1) {
                $view = $this->load->view('faq/edit', array('data' => $this->Faq_Model->get_single($value)), TRUE);
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
            $roles = $this->Faq_Model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->Faq_Model->delete(intval($id))) {
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

    function view()
    {
        $data['value'] = $this->Faq_Model->get_faq();
        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
        $data['berita_lainnya'] = $this->artikel_model->berita_lainnya();
        $data['berita_lsp_pilihan'] = $this->artikel_model->berita_lsp_pilihan();
        $data['class_active'] = 'home';

        //$data['berita_lsp_list'] = $this->artikel_model->berita_lsp_list();
        $this->load->view('templates/bootstraps/header',$data);
        $this->load->view('profile/faq',$data);
        $this->load->view('templates/bootstraps/bottom',$data);

    }

}
