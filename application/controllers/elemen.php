<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Elemen extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('elemen_model');
	}

    function index()
    {
        if($_SERVER['REQUEST_METHOD'] == 'GET')
            {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model'=>'elemen_model', 'controller'=>'elemen', 'options'=>array('id'=>'elemen', 'pagination')))->load_model()->set_grid();
            
            $view = $this->load->view('elemen/index', array('grid'=>$grid), true);
            
            echo json_encode(array('msgType'=>'success', 'msgValue'=>$view));
        }
        else
        {
            block_access_method();
        }
    }
    
    function datagrid()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows')) ;
            $page = intval($this->input->post('page'))== 0 ? 1 : intval($this->input->post('page'));
            $offset = $row * ($page - 1);
            $data = array();
            $params = array('_return'=>'data');
            if(isset($where)) $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->elemen_model->count_by($where) : $this->elemen_model->count_all();
            $this->elemen_model->limit($row, $offset);
            $rows = $this->elemen_model->set_params($params)->with(array('unit_kompetensi'));
            $data['rows'] = $this->elemen_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else
        {
            block_access_method();
        }
    }
    

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $data = $this->elemen_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->elemen_model->check_unique($data)) {
                   
                    if ($this->elemen_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->elemen_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $this->load->model('unit_model');
            $unit = $this->unit_model->dropdown('id', 'unit_kompetensi');

            $view = $this->load->view('elemen/add', array('unit' => $unit), TRUE);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        }
    }

    function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->elemen_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->elemen_model->check_unique($data, intval($id))) {
                    if ($this->elemen_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->elemen_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $con_method = $this->elemen_model->get(intval($id));
            if (sizeof($con_method) == 1) {
                $this->load->model('unit_model');
                $unit = $this->unit_model->dropdown('id', 'unit_kompetensi');

                $data = $this->elemen_model->get_single($con_method);
                $view = $this->load->view('elemen/edit', array('unit' => $unit, 'data' => $data), TRUE);
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
            $roles = $this->elemen_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->elemen_model->delete(intval($id))) {
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