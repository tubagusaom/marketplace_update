<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Test extends MY_Controller {

    function __construct() {

        parent::__construct();
        $this->load->model('test_model');
        $this->load->model('v_test_model');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'v_test_model', 'controller' => 'test', 'options' => array('id' => 'test', 'pagination', 'rownumber')))->load_model()->set_grid();
            $view = $this->load->view('test/index', array('grid' => $grid), true);
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
            $jenis_user = $this->auth->get_user_data()->jenis_user;
            if($jenis_user == 1){
                $siswa_id = $this->auth->get_user_data()->pegawai_id;
                $where['siswa_id ='] = $siswa_id;    
            }
            
            if(isset($_POST['siswa_id']) && !empty($_POST['siswa_id']))
			{
				$where['siswa_id ='] = $this->input->post('siswa_id');
			}
            if(isset($_POST['from_time']) && !empty($_POST['from_time']))
			{
                $from_time = mysql_date($this->input->post('from_time'));
                $to_time = mysql_date($this->input->post('to_time')); 
				$where['schedule_date BETWEEN "'.$from_time.'" AND'] = $to_time;
			}
            $data = array();
            $params = array('_return' => 'data');

            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->v_test_model->count_by($where) : $this->v_test_model->count_all();
            $this->v_test_model->limit($row, $offset);
            $rows = $this->v_test_model->set_params($params)->with(array());
            $data['rows'] = $this->v_test_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->test_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->test_model->check_unique($data)) {
                    if ($this->test_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->test_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $this->load->library('combogrid');
            $schedule_grid = $this->combogrid->set_properties(array('model' => 'v_siswa_model', 'controller' => 'siswa', 'options' => array('id' => 'siswa_id', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'nama', 'panelWidth' => 500)))->load_model()->set_grid();
            $instruktur_grid = $this->combogrid->set_properties(array('model' => 'v_instruktur_model', 'controller' => 'instruktur', 'fields' => array('instruktur_code', 'instruktur_name'), 'options' => array('id' => 'instruktur_id', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'instruktur_name', 'panelWidth' => 400)))->load_model()->set_grid();
            $from_airport_grid = $this->combogrid->set_properties(array('model' => 'v_schedule_model', 'controller' => 'airport', 'fields' => array('airport_abr', 'nama_airport'), 'options' => array('id' => 'from_airport', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'nama_airport', 'panelWidth' => 400)))->load_model()->set_grid();
            $to_airport_grid = $this->combogrid->set_properties(array('model' => 'v_schedule_model', 'controller' => 'airport', 'fields' => array('airport_abr', 'nama_airport'), 'options' => array('id' => 'to_airport', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'nama_airport', 'panelWidth' => 400)))->load_model()->set_grid();
            $plane_grid = $this->combogrid->set_properties(array('model' => 'v_plane_model', 'controller' => 'plane', 'fields' => array('plane_code', 'plane_name'), 'options' => array('id' => 'plane_id', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'plane_name', 'panelWidth' => 400)))->load_model()->set_grid();
            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('test/add', array('siswa_grid' => $schedule_grid, 'instruktur_grid' => $instruktur_grid,
                    'from_airport_grid' => $from_airport_grid, 'to_airport_grid' => $to_airport_grid
                    , 'plane_grid' => $plane_grid, 'base' =>array("-Pilih-","BTO","CBN","BKS"), 'subject_category' =>array("-Pilih-","Solo Flight","PPL Checkride","CPL Checkride","IR Checkride","ME Checkride")), TRUE)));
        }
    }

    function delete($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $roles = $this->test_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->test_model->delete(intval($id))) {
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

        function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->test_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->test_model->check_unique($data, intval($id))) {
                    if ($this->test_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->test_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $test = $this->test_model->get(intval($id));
            if (sizeof($test) == 1) {
                $this->load->library('combogrid');
                //$toolbar_grid = $this->combogrid->set_properties(array('model'=>'Toolbar_Model', 'controller'=>'toolbars', 'value'=>$toolbar->toolbar_id, 'options'=>array('id'=>'toolbar_id', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'toolbar_name', 'panelWidth'=>400)))->load_model()->set_grid();
                $test_grid = $this->combogrid->set_properties(array('model' => 'v_siswa_model', 'controller' => 'siswa', 'value'=>$test->siswa_id, 'options' => array('id' => 'siswa_id', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'nama', 'panelWidth' => 400)))->load_model()->set_grid();
                $instruktur_grid = $this->combogrid->set_properties(array('model' => 'v_instruktur_model', 'controller' => 'instruktur', 'value'=>$test->instruktur_id, 'fields' => array('instruktur_code', 'instruktur_name'), 'options' => array('id' => 'instruktur_id', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'instruktur_name', 'panelWidth' => 400)))->load_model()->set_grid();
                $from_airport_grid = $this->combogrid->set_properties(array('model' => 'test_model', 'controller' => 'airport', 'value'=>$test->from_airport, 'fields' => array('airport_abr', 'nama_airport'), 'options' => array('id' => 'from_airport', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'nama_airport', 'panelWidth' => 400)))->load_model()->set_grid();
                $to_airport_grid = $this->combogrid->set_properties(array('model' => 'test_model', 'controller' => 'airport', 'value'=>$test->to_airport, 'fields' => array('airport_abr', 'nama_airport'), 'options' => array('id' => 'to_airport', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'nama_airport', 'panelWidth' => 400)))->load_model()->set_grid();
                $plane_grid = $this->combogrid->set_properties(array('model' => 'v_plane_model', 'controller' => 'plane', 'value'=>$test->plane_id, 'fields' => array('plane_code', 'plane_name'), 'options' => array('id' => 'plane_id', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'plane_name', 'panelWidth' => 400)))->load_model()->set_grid();

                $view = $this->load->view('test/edit', array('data' => $this->test_model->get_single($test),'siswa_grid' => $test_grid, 'instruktur_grid' => $instruktur_grid,
                    'from_airport_grid' => $from_airport_grid, 'to_airport_grid' => $to_airport_grid
                    , 'plane_grid' => $plane_grid, 'base' =>array("-Pilih-","BTO","CBN","BKS"), 'subject_category' =>array("-Pilih-","Solo Flight","PPL Checkride","CPL Checkride","IR Checkride","ME Checkride")), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
    }
    function search() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('combogrid');
            $test_grid = $this->combogrid->set_properties(array('model' => 'v_siswa_model', 'controller' => 'siswa', 'options' => array('id' => 'siswa_id', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'nama', 'panelWidth' => 400)))->load_model()->set_grid();
            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('test/search', array('siswa_grid' => $test_grid), TRUE)));
        } else {
            block_access_method();
        }
    }
    function simpan(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $roles = $this->test_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->test_model->delete(intval($id))) {
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
    function combogrid($id = false)
	{
        $this->load->model('test_model');
		$row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows')) ;
		$page = intval($this->input->post('page'))== 0 ? 1 : intval($this->input->post('page'));
		$offset = $row * ($page - 1);
		$data = array();
		$params = array('_return'=>'data');
		if(isset($_POST['q']))
		{
			$where['nama LIKE'] = "%" . $this->input->post('q') . "%";
            //$where['nama LIKE'] = "%" . $this->input->post('q') . "% OR test_date LIKE'%". $this->input->post('q') ."%'";
            //$where['test_date LIKE'] = "%" . $this->input->post('q') . "%";
		}
		if(isset($where)) $params['_where'] = $where;
		$data['total'] = isset($where) ? $this->test_model->count_by($where) : $this->test_model->count_all();
		$this->test_model->limit($row, $offset);
		$order_criteria = "ASC";
		$_order_escape = TRUE;
		if($id)
		{
			$order = "FIELD(id, " . intval($id) . ")";
			$order_criteria = "DESC";
			$_order_escape = FALSE;
		}
		else
		{
			$order = $this->test_model->get_params('_order');
		}		
		$rows = isset($where) ? $this->test_model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->test_model->order_by($order, $order_criteria, $_order_escape)->get_all();
		$data['rows'] = $this->test_model->get_selected()->data_formatter($rows);
        echo json_encode($data);
	}    
}
