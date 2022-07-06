<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Schedule_flight extends MY_Controller {

    function __construct() {

        parent::__construct();
        $this->load->model('v_schedule_model');
        $this->load->model('schedule_model');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'v_schedule_model', 'controller' => 'schedule_flight', 'options' => array('id' => 'schedule', 'pagination', 'rownumber')))->load_model()->set_grid();
            $view = $this->load->view('schedule_flight/index', array('grid' => $grid), true);
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
            if(isset($_POST['siswa_id']) && !empty($_POST['siswa_id']))
			{
				$where['siswa_id LIKE'] = '%' . $this->input->post('siswa_id') . '%';
			}
            $where['subject_category IN (2,3) AND id !='] = '';
            
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
            $data['total'] = isset($where) ? $this->v_schedule_model->count_by($where) : $this->v_schedule_model->count_all();
            $this->v_schedule_model->limit($row, $offset);
            $rows = $this->v_schedule_model->set_params($params)->with(array());
            $data['rows'] = $this->v_schedule_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else {
            block_access_method();
        }
    }

    function add() {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $batch_id = $this->input->post("batch_id");
            $from_airport = $this->input->post("from_airport");
            $to_airport = $this->input->post("to_airport");
            $from_time = $this->input->post("from_time");
            $to_time = $this->input->post("to_time");
            $instruktur_id = $this->input->post("instruktur_id");
            $plane_id = $this->input->post("plane_id");
           	$room_id = $this->input->post("room_id");
            $schedule_date = $this->input->post("schedule_date");
            $date = array_reverse(explode("/", $schedule_date));
            $result_date = implode('-', $date);
                
            $siswa_id = $this->input->post("siswa_id");
            $subject_category = $this->input->post("subject_category");
            $stage = $this->input->post("stage");
            $revision = $this->input->post("revision");
            
            if($subject_category == 1){
                // Jika combo batch ada isinya
                if($batch_id != ""){
                    // Ambil data siswa pada batch yang di pilih
                    $this->db->select('id as siswa_id');
                    $this->db->where('batch_id',$batch_id);
                    $query = $this->db->get('t_siswa')->result_array();
                    // Jika ada siswa pada batch yang di pilih
                    if(count($query) > 0){
                        $array = array();
                        // Jadikan dalam bentuk array yang sudah di tambah value dari method post
                        foreach($query as $value){
                            $hasil = array(
            					"siswa_id"   => $value['siswa_id'],
            					"subject_category"   => $subject_category,
            					"schedule_date" => $result_date,
                                "instruktur_id" => $instruktur_id,
                                "from_time" => $from_time,
                                "to_time" => $to_time,
                                "room_id" => $room_id,
                                "batch_id" => $batch_id,
                                "stage" => $stage,
                                "revision" => $revision
            				);
                            array_push($array,$hasil);
                        }
                        // Jika data berhasil di input dalam bentuk array atau multi record
                        if ($this->db->insert_batch('t_schedule',$array) !== false) {
                            echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                        } else {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                        }        
                    }else{
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Tidak ada siswa dalam Batch ini !'));
                    }
                }else{
                    $data = array(
                            "subject_category" => $subject_category,
                            "schedule_date" => $result_date,
                            "instruktur_id" => $instruktur_id,
                            "from_time" => $from_time,
                            "to_time" => $to_time,
                            "room_id" => $room_id,
                            "siswa_id" => $siswa_id,
                            "batch_id" => $batch_id,
                            "stage" => $stage,
                            "revision" => $revision
                            
                        );
                    if ($this->db->insert('t_schedule',$data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }    
                }
                
            }else if($subject_category == 2){
                $date = array_reverse(explode("/", $schedule_date));
				$result_date = implode('-', $date);
                $data = array(
                            "subject_category" => $subject_category,
                            "schedule_date" => $result_date,
                            "instruktur_id" => $instruktur_id,
                            "from_time" => $from_time,
                            "to_time" => $to_time,
                            "plane_id" => $plane_id,
                            "siswa_id" => $siswa_id,
                            "from_airport" => $from_airport,
                            "to_airport" => $to_airport,
                            "stage" => $stage,
                            "revision" => $revision
                
                        );
                if ($this->db->insert('t_schedule',$data) !== false) {
                    echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                }
            }else{
                if($batch_id != ""){
                    $date = array_reverse(explode("/", $schedule_date));
    				$result_date = implode('-', $date);
                    // Ambil data siswa pada batch yang di pilih
                    $this->db->select('id as siswa_id');
                    $this->db->where('batch_id',$batch_id);
                    $query = $this->db->get('t_siswa')->result_array();
                    // Jika ada siswa pada batch yang di pilih
                    if(count($query) > 0){
                        $array = array();
                        // Jadikan dalam bentuk array yang sudah di tambah value dari method post
                        foreach($query as $value){
                            $hasil = array(
            					"siswa_id"   => $value['siswa_id'],
            					"subject_category" => $subject_category,
                                "batch_id" => $batch_id,
                                "from_time" => $from_time,
                                "to_time" => $to_time,
                                "instruktur_id" => $instruktur_id,
                                "plane_id" => $plane_id,
                                "room_id" => $room_id,
                                "schedule_date" => $result_date,
                                "stage" => $stage,
                                "revision" => $revision
            				);
                            array_push($array,$hasil);
                        }
                        // Jika data berhasil di input dalam bentuk array atau multi record
                        if ($this->db->insert_batch('t_schedule',$array) !== false) {
                            echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                        } else {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                        }        
                    }else{
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Tidak ada siswa dalam Batch ini !'));
                    }
                }else{
                    $data = array(
                                "subject_category" => $subject_category,
                                "siswa_id" => $siswa_id,
                                //"batch_id" => $batch_id,
                                "from_time" => $from_time,
                                "to_time" => $to_time,
                                "instruktur_id" => $instruktur_id,
                                "plane_id" => $plane_id,
                                //"room_id" => $room_id,
                                "schedule_date" => $result_date,
                                "stage" => $stage,
                                "revision" => $revision
                            );
                    if ($this->db->insert('t_schedule',$data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                }
            }      
        } else {
            $this->load->library('combogrid');
            $schedule_grid = $this->combogrid->set_properties(array('model' => 'v_siswa_model', 'controller' => 'siswa', 'options' => array('id' => 'siswa_id', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'nama', 'panelWidth' => 500)))->load_model()->set_grid();
            $instruktur_grid = $this->combogrid->set_properties(array('model' => 'v_instruktur_model', 'controller' => 'instruktur', 'fields' => array('instruktur_code', 'instruktur_name'), 'options' => array('id' => 'instruktur_id', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'instruktur_name', 'panelWidth' => 400)))->load_model()->set_grid();
            $from_airport_grid = $this->combogrid->set_properties(array('model' => 'v_schedule_model', 'controller' => 'airport', 'fields' => array('airport_abr', 'nama_airport'), 'options' => array('id' => 'from_airport', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'nama_airport', 'panelWidth' => 400)))->load_model()->set_grid();
            $to_airport_grid = $this->combogrid->set_properties(array('model' => 'v_schedule_model', 'controller' => 'airport', 'fields' => array('airport_abr', 'nama_airport'), 'options' => array('id' => 'to_airport', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'nama_airport', 'panelWidth' => 400)))->load_model()->set_grid();
            $plane_grid = $this->combogrid->set_properties(array('model' => 'v_plane_model', 'controller' => 'plane', 'fields' => array('plane_code', 'plane_name','status'), 'options' => array('id' => 'plane_id', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'plane_name', 'panelWidth' => 550)))->load_model()->set_grid();
            $room_grid = $this->combogrid->set_properties(array('model' => 'room_model', 'controller' => 'room', 'fields' => array('room_code', 'room_name'), 'options' => array('id' => 'room_id', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'room_name', 'panelWidth' => 400)))->load_model()->set_grid();
            $batch_grid = $this->combogrid->set_properties(array('model' => 'angkatan_model', 'controller' => 'angkatan', 'fields' => array('batch_code', 'batch_name'), 'options' => array('id' => 'batch_id', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'batch_name', 'panelWidth' => 400)))->load_model()->set_grid();
            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('schedule_flight/add', array('siswa_grid' => $schedule_grid, 'instruktur_grid' => $instruktur_grid,
                    'from_airport_grid' => $from_airport_grid, 'to_airport_grid' => $to_airport_grid
                    , 'plane_grid' => $plane_grid, 'revision' =>array("New","Revise 1","Revise 2","Revise 3")
                    , 'batch_grid' => $batch_grid, 'room_grid' => $room_grid), TRUE)));
        }
    }

    function delete($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $roles = $this->schedule_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->schedule_model->delete(intval($id))) {
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
            $data = $this->schedule_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->schedule_model->check_unique($data, intval($id))) {
                    if ($this->schedule_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->schedule_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $schedule = $this->schedule_model->get(intval($id));
            if (sizeof($schedule) == 1) {
                $this->load->library('combogrid');
                $schedule_grid = $this->combogrid->set_properties(array('model' => 'v_siswa_model', 'controller' => 'siswa', 'value'=>$schedule->siswa_id, 'options' => array('id' => 'siswa_id', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'nama', 'panelWidth' => 400)))->load_model()->set_grid();
                $instruktur_grid = $this->combogrid->set_properties(array('model' => 'v_instruktur_model', 'controller' => 'instruktur', 'value'=>$schedule->instruktur_id, 'fields' => array('instruktur_code', 'instruktur_name'), 'options' => array('id' => 'instruktur_id', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'instruktur_name', 'panelWidth' => 400)))->load_model()->set_grid();
                $from_airport_grid = $this->combogrid->set_properties(array('model' => 'v_schedule_model', 'controller' => 'airport', 'value'=>$schedule->from_airport, 'fields' => array('airport_abr', 'nama_airport'), 'options' => array('id' => 'from_airport', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'nama_airport', 'panelWidth' => 400)))->load_model()->set_grid();
                $to_airport_grid = $this->combogrid->set_properties(array('model' => 'v_schedule_model', 'controller' => 'airport', 'value'=>$schedule->to_airport, 'fields' => array('airport_abr', 'nama_airport'), 'options' => array('id' => 'to_airport', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'nama_airport', 'panelWidth' => 400)))->load_model()->set_grid();
                $plane_grid = $this->combogrid->set_properties(array('model' => 'v_plane_model', 'controller' => 'plane', 'value'=>$schedule->plane_id, 'fields' => array('plane_code', 'plane_name'), 'options' => array('id' => 'plane_id', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'plane_name', 'panelWidth' => 400)))->load_model()->set_grid();

                $view = $this->load->view('schedule_flight/edit', array('data' => $this->schedule_model->get_single($schedule),'siswa_grid' => $schedule_grid, 'instruktur_grid' => $instruktur_grid,
                    'from_airport_grid' => $from_airport_grid, 'to_airport_grid' => $to_airport_grid
                    , 'plane_grid' => $plane_grid), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
    }
    function search() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('combogrid');
            $schedule_grid = $this->combogrid->set_properties(array('model' => 'v_siswa_model', 'controller' => 'siswa', 'options' => array('id' => 'siswa_id', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'nama', 'panelWidth' => 400)))->load_model()->set_grid();
            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('schedule_flight/search', array('siswa_grid' => $schedule_grid), TRUE)));
        } else {
            block_access_method();
        }
    }
    function simpan(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $roles = $this->schedule_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->schedule_model->delete(intval($id))) {
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
        $this->load->model('v_schedule_model');
		$row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows')) ;
		$page = intval($this->input->post('page'))== 0 ? 1 : intval($this->input->post('page'));
		$offset = $row * ($page - 1);
		$data = array();
		$params = array('_return'=>'data');
		if(isset($_POST['q']))
		{
			$where['nama LIKE'] = "%" . $this->input->post('q') . "%";
        }
		if(isset($where)) $params['_where'] = $where;
		$data['total'] = isset($where) ? $this->v_schedule_model->count_by($where) : $this->v_schedule_model->count_all();
		$this->v_schedule_model->limit($row, $offset);
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
			$order = $this->v_schedule_model->get_params('_order');
		}		
		$rows = isset($where) ? $this->v_schedule_model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->v_schedule_model->order_by($order, $order_criteria, $_order_escape)->get_all();
		$data['rows'] = $this->v_schedule_model->get_selected()->data_formatter($rows);
        echo json_encode($data);
	}    
}
