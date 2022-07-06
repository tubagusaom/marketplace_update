<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Evaluasi extends MY_Controller {

    function __construct() {

        parent::__construct();
        $this->load->model('evaluasi_model');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'evaluasi_model', 'fields' => array('siswa_id','program_study_current','stage_evaluation','category_evaluation','evaluation_date','time_lesson','result','foto'), 'controller' => 'evaluasi', 'options' => array('id' => 'evaluasi','pagination','rownumber')))->load_model()->set_grid();
            $view = $this->load->view('evaluasi/index', array('grid' => $grid), true);
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
            $jenis_user = $this->auth->get_user_data()->jenis_user;
            if($jenis_user == 1){
                $siswa_id = $this->auth->get_user_data()->pegawai_id;
                $where['siswa_id ='] = $siswa_id;
            }


        if(isset($_POST['from_time']) && !empty($_POST['from_time']) && isset($_POST['to_time']) && !empty($_POST['to_time']))
			{
                $from_time = mysql_date($this->input->post('from_time'));
                $to_time = mysql_date($this->input->post('to_time'));
				$where['evaluation_date BETWEEN "'.$from_time.'" AND'] = $to_time;
			}
        if(isset($_POST['siswa_id']) && !empty($_POST['siswa_id']))
			{
				$where['siswa_id ='] = $this->input->post('siswa_id');
			}
        if (isset($where))
            $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->evaluasi_model->count_by($where) : $this->evaluasi_model->count_all();
            $this->evaluasi_model->limit($row, $offset);
            $rows = $this->evaluasi_model->set_params($params)->with(array('nama'));
            $data['rows'] = $this->evaluasi_model->fields_selected(array('nis','category_evaluation','stage_evaluation', 'siswa_id','program_study_current','evaluation_date','time_lesson','result','foto'))->data_formatter($rows);
            echo json_encode($data);
        }
        else {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->evaluasi_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->evaluasi_model->check_unique($data)) {
                    if ($this->evaluasi_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->evaluasi_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $this->load->library('combogrid');
			$siswa_grid = $this->combogrid->set_properties(array('model'=>'v_siswa_model', 'controller'=>'siswa', 'fields'=>array('nis', 'nama'), 'options'=>array('id'=>'siswa_id', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama', 'panelWidth'=>400)))->load_model()->set_grid();
		    $schedule_grid = $this->combogrid->set_properties(array('model'=>'v_schedule_model', 'controller'=>'schedule', 'fields'=>array('nama', 'schedule_date','current_program','stage','siswa_id'), 'options'=>array('id'=>'schedule_id', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama', 'panelWidth'=>500)))->load_model()->set_grid();


            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('evaluasi/add',
               array('siswa_grid'=>$siswa_grid
               ,'schedule_grid'=>$schedule_grid,'category_evaluation' => array('-Pilih-','Dual','Solo','Simulator')), TRUE)));


        }
    }

    function delete($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $roles = $this->evaluasi_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->evaluasi_model->delete(intval($id))) {
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
		if($_SERVER['REQUEST_METHOD'] == 'GET') {
            $evaluasi = $this->evaluasi_model->get(intval($id));
            if (sizeof($evaluasi) == 1) {
				$data = $this->evaluasi_model->get_single($evaluasi);
                $this->load->library('combogrid');
    			$siswa_grid = $this->combogrid->set_properties(array('model'=>'v_siswa_model', 'controller'=>'siswa', 'fields'=>array('nis', 'nama'), 'options'=>array('id'=>'siswa_id', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama', 'panelWidth'=>400)))->load_model()->set_grid();
    			$program_grid = $this->combogrid->set_properties(array('model'=>'v_program_model', 'controller'=>'program', 'fields'=>array('abr', 'program_study'), 'options'=>array('id'=>'program_id', 'onchange'=>array('target'=>'subject_id', 'type'=>'combogrid', 'q_field'=>'program_id'), 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'program_study', 'panelWidth'=>400)))->load_model()->set_grid();
    			$subject_grid = $this->combogrid->set_properties(array('model'=>'subjek_model', 'controller'=>'subjek', 'fields'=>array('subject_name', 'total_hours'), 'options'=>array('id'=>'subject_id', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'subject_name', 'panelWidth'=>500)))->load_model()->set_grid();
    			$kurikulum_grid = $this->combogrid->set_properties(array('model'=>'v_kurikulum_model', 'controller'=>'kurikulum', 'fields'=>array('nama_kurikulum', 'hours'), 'options'=>array('id'=>'kurikulum_id', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama_kurikulum', 'panelWidth'=>500)))->load_model()->set_grid();
                $schedule_grid = $this->combogrid->set_properties(array('model'=>'v_schedule_model', 'controller'=>'schedule', 'fields'=>array('nama', 'schedule_date','current_program','stage','siswa_id'), 'options'=>array('id'=>'schedule_id', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama', 'panelWidth'=>500)))->load_model()->set_grid();
    			$subject_detail = $this->combogrid->set_properties(array('model'=>'sub_subjek_model', 'controller'=>'sub_subjek', 'fields'=>array('nama_subjek', 'hours','category'), 'options'=>array('id'=>'subject_detail_id', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama_subjek', 'panelWidth'=>500)))->load_model()->set_grid();

                $view = $this->load->view('evaluasi/edit', array('data' => $data, 'url'=>base_url() . 'evaluasi/edit_upload/' . $id,
                'siswa_grid'=>$siswa_grid,'program_grid'=>$program_grid,'kurikulum_grid'=>$kurikulum_grid,
               'subject_grid'=>$subject_grid,'subject_detail'=>$subject_detail,'schedule_grid'=>$schedule_grid), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
    }

	function upload() {
	   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	       $id_siswa = $this->input->post('siswa_id');
           $schedule_id = $this->input->post('schedule_id');

            $data = $this->evaluasi_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->evaluasi_model->check_unique($data)) {
                    if (isset($_FILES['fileToUpload']['tmp_name']) && !empty($_FILES['fileToUpload']['tmp_name'])) {
                        $data['foto'] = date('Y-m-d').'-'.$schedule_id.'-'.$id_siswa.'-'.str_replace(' ', '_', $_FILES['fileToUpload']['name']);
                        $config['upload_path'] = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/files/evaluasi/';
                        $config['allowed_types'] = '*';
                        $config['max_size'] = '51200000';
                        $config['file_name'] = date('Y-m-d').'-'.$schedule_id.'-'.$id_siswa.'-'.str_replace(' ', '_', $_FILES['fileToUpload']['name']);

                        $this->load->library('upload', $config);

                        if (!$this->upload->do_upload('fileToUpload')) {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => $this->upload->display_errors()));
                            exit();
                        }
                    }
                    if ($this->evaluasi_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", strip_tag($this->evaluasi_model->get_validation()))));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        }
	}

	function edit_upload($id = false){
		if (!$id) {
            data_not_found();
            exit;
        }
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->evaluasi_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->evaluasi_model->check_unique($data, intval($id))) {
					if(isset($_FILES)) {
						$evaluasi = $this->evaluasi_model->get(intval($id));
						$data['foto'] = $data['siswa_id'] . '_' . str_replace(' ', '_', $_FILES['fileToUpload']['name']);
						$config['upload_path'] = substr(__dir__,0, strpos( __dir__,"application")) . 'assets/img/evaluasi/';
						$config['allowed_types'] = 'bmp|jpg|png|gif|jpeg';
						$config['file_name'] = $data['foto'];
						$config['max_size'] = '512000';

						$this->load->library('upload', $config);

						if ($this->upload->do_upload('fileToUpload')) {
							$current_file = substr(__dir__,0, strpos( __dir__,"application")) . 'assets/img/evaluasi/' . $evaluasi->foto;
							if(is_file($current_file)){
								unlink($current_file);
							}
						}
						else {
							echo json_encode(array('msgType' => 'error', 'msgValue' => strip_tags($this->upload->display_errors())));
							exit();
						}
					}
                    if ($this->evaluasi_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->evaluasi_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        }
	}
    function combogrid($id = false)
	{
		$this->load->model('v_evaluasi_model');
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
		$data['total'] = isset($where) ? $this->v_evaluasi_model->count_by($where) : $this->v_evaluasi_model->count_all();
		$this->v_evaluasi_model->limit($row, $offset);
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
			$order = $this->v_evaluasi_model->get_params('_order');
		}
		$rows = isset($where) ? $this->v_evaluasi_model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->v_evaluasi_model->order_by($order, $order_criteria, $_order_escape)->get_all();
		$data['rows'] = $this->v_evaluasi_model->get_selected()->data_formatter($rows);
        //var_dump($data);
		echo json_encode($data);
	}
    function search() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('combogrid');
            $schedule_grid = $this->combogrid->set_properties(array('model' => 'v_siswa_model', 'controller' => 'siswa', 'options' => array('id' => 'siswa_id', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'nama', 'panelWidth' => 400)))->load_model()->set_grid();
            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('evaluasi/search', array('siswa_grid' => $schedule_grid), TRUE)));
        } else {
            block_access_method();
        }
    }
    function download($id = false)
	{
		if(!$id)
		{
			block_access_method();
		}
		else
		{
			if($_SERVER['REQUEST_METHOD'] == "GET")
			{
				$docs = $this->evaluasi_model->get(intval($id));
				if(sizeof($docs) == 1)
				{
					$doc = $this->evaluasi_model->get_single($docs);
					$files = substr(__dir__,0, strpos( __dir__,"application")) . '/assets/files/evaluasi/' . $doc->foto;
					if(file_exists($files))
					{
						header('Cache-Control: public');
						 header('Content-Disposition: attachment; filename="' . $doc->foto . '"');
						 readfile($files);
						 die();
					}
					else
					{
						echo json_encode(array('msgType'=>'error', 'msgValue'=>'File tidak dapat ditemukan'));
					}
				}
				else
				{
					echo json_encode(array('msgType'=>'error', 'msgValue'=>'Data tidak dapat ditemukan'));
				}
			}
		}
	}

}
