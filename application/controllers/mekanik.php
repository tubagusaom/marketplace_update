<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Mekanik extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('mekanik_model');
	}
    
    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'mekanik_model','fields' => array('plane_name','plane_code','nama_mekanik','start_date','end_date','description','status'), 'controller' => 'mekanik', 'options' => array('id' => 'mekanik', 'pagination', 'rownumber')))->load_model()->set_grid();
          $view = $this->load->view('mekanik/index', array('grid' => $grid), true);
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
            $data['total'] = isset($where) ? $this->mekanik_model->count_by($where) : $this->mekanik_model->count_all();
            $this->mekanik_model->limit($row, $offset);
            $rows = $this->mekanik_model->set_params($params)->with(array('plane_name'));
            $data['rows'] = $this->mekanik_model->fields_selected(array('plane_name','plane_code','nama_mekanik','start_date','end_date','description','status'))->data_formatter($rows);
            echo json_encode($data);
        }
        else {
            block_access_method();
        }
    }
    function proses($air_craft,$status){
        $data = array(
               'status' => $status,
             );

        $this->db->where('id', $air_craft);
        $this->db->update('t_plane', $data); 
    }
    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->mekanik_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->mekanik_model->check_unique($data)) {
                    if ($this->mekanik_model->insert($data) !== false) {
                        $air_craft = $this->input->post('aircraft_id');
                        $status = $this->input->post('status');
                        $this->proses($air_craft,$status);
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->mekanik_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $this->load->library('combogrid');
            $plane_grid = $this->combogrid->set_properties(array('model' => 'v_plane_model', 'controller' => 'plane', 'fields' => array('plane_code', 'plane_name','status'), 'options' => array('id' => 'aircraft_id', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'plane_name', 'panelWidth' => 400)))->load_model()->set_grid();
            $view = $this->load->view('mekanik/add', array('plane_grid' => $plane_grid,'status'=> array('Maintenance','OK')), TRUE);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            
            //echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('mekanik/add', array('status' => 1, 'bidang' => 1), TRUE)));
        }
    }
    
    function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->mekanik_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->mekanik_model->check_unique($data, intval($id))) {
                    if ($this->mekanik_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->mekanik_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $batch = $this->mekanik_model->get(intval($id));
            if (sizeof($batch) == 1) {
                $view = $this->load->view('mekanik/edit', array('data' => $this->mekanik_model->get_single($batch)), TRUE);
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
            $roles = $this->mekanik_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->mekanik_model->delete(intval($id))) {
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