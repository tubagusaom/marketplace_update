<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Siswa_certificate extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('certificate_model');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'certificate_model', 'controller' => 'siswa_certificate', 'options' => array('id' => 'certificate','pagination','rownumber')))->load_model()->set_grid();
            $view = $this->load->view('certificate/index', array('grid' => $grid), true);
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
            if (isset($_POST['nama']) && !empty($_POST['nama'])) {
                $where['nama LIKE'] = '%' . $this->input->post('nama') . '%';
            }
            $id = $this->auth->get_user_data()->pegawai_id;
            $where['siswa_id ='] = $id;
            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = $this->certificate_model->set_params($params)->count_with(array('nama', 'program_study'));
            $this->certificate_model->limit($row, $offset);
            $rows = $this->certificate_model->set_params($params)->with(array('nama', 'program_study'));
            $data['rows'] = $this->certificate_model->get_selected()->data_formatter($rows);
                                    
            echo json_encode($data);
        }
        else {
            block_access_method();
        }
    }


    function search() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('certificate/search', '', TRUE)));
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
				$docs = $this->certificate_model->get(intval($id));
				if(sizeof($docs) == 1)
				{
					$doc = $this->certificate_model->get_single($docs);
					$files = substr(__dir__,0, strpos( __dir__,"application")) . 'assets/files/certificate/' . $doc->foto;
					if(file_exists($files))
					{
						header('Cache-Control: public'); 
						 header('Content-Disposition: attachment; filename="' . $doc->foto . '"');
						 readfile($files);
						 die(); 
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
