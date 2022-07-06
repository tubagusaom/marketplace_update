<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Skema extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('skema_model');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'skema_model', 'controller' => 'skema', 'options' => array('id' => 'skema', 'pagination', 'rownumber')))->load_model()->set_grid();
            $view = $this->load->view('skema/index', array('grid' => $grid), true);
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
            $data['total'] = isset($where) ? $this->skema_model->count_by($where) : $this->skema_model->count_all();
            $this->skema_model->limit($row, $offset);
            $order = $this->skema_model->get_params('_order');
            // $rows = isset($where) ? $this->skema_model->order_by($order)->get_many_by($where) : $this->skema_model->order_by($order)->get_all();
            $rows = $this->skema_model->set_params($params)->with(array('program_studi'));
            $data['rows'] = $this->skema_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        } else {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->skema_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->skema_model->check_unique($data)) {
                    if ($this->skema_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->skema_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            //echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('skema/add', array('status' => 1, 'bidang' => 1),  TRUE)));

                $view = $this->load->view('skema/add', array('kategori' => array('skema','simulator')), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        }
    }

    function delete($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $roles = $this->skema_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->skema_model->delete(intval($id))) {
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
            $data = $this->skema_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->skema_model->check_unique($data, intval($id))) {
                    if ($this->skema_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->skema_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $batch = $this->skema_model->get(intval($id));
            if (sizeof($batch) == 1) {
                $this->load->model('prodi_model');
                $prodi = $this->prodi_model->dropdown('id', 'program_studi');

                $view = $this->load->view('skema/edit', array('prodi' => $prodi, 'data' => $this->skema_model->get_single($batch),
                'semester' => array(''=>'- Pilih Semester -','1'=>'1 (Satu)','2' => '2 (Dua)','3'=>'3 (Tiga)','4'=>'4 (Empat)','5'=>'5 (Lima)','6'=>'6 (Enam)','7'=>'7 (Tujuh)','8'=>'8 (Delapan)'),
                'kategori_skema' => array(''=>'- Pilih -','Klaster'=>'Klaster','Okupasi' => 'Okupasi','KKNI'=>'KKNI','Standar Khusus'=>'Standar Khusus','Standar Internasional'=>'Standar Internasional')), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));

            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
    }

    function combogrid($id = false) {
  		$this->load->model('v_skema_model');
  		$row = intval($this->input->post('rows')) == 0 ? 200 : intval($this->input->post('rows')) ;
  		$page = intval($this->input->post('page'))== 0 ? 1 : intval($this->input->post('page'));
  		$offset = $row * ($page - 1);
  		$data = array();
  		$params = array('_return'=>'data');
  		if(isset($_POST['q']))
  		{
  			$where['skema LIKE'] = "%" . $this->input->post('q') . "%";
  		}
  		if(isset($where)) $params['_where'] = $where;
  		$data['total'] = isset($where) ? $this->v_skema_model->count_by($where) : $this->v_skema_model->count_all();
  		$this->v_skema_model->limit($row, $offset);
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
  			$order = $this->v_skema_model->get_params('_order');
  		}
  		$rows = isset($where) ? $this->v_skema_model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->v_skema_model->order_by($order, $order_criteria, $_order_escape)->get_all();
  		$data['rows'] = $this->v_skema_model->get_selected()->data_formatter($rows);
          //var_dump($data);
  		echo json_encode($data);
  	}
}
