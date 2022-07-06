<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Materi extends MY_Controller {


   	function __construct()
	{
		parent::__construct();
        $this->load->model('repositori_model');

	}

    function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'repositori_model', 'controller' => 'materi', 'options' => array('id' => 'repositori','pagination','rownumber')))->load_model()->set_grid();
            $view = $this->load->view('repositori/materi', array('grid' => $grid), true);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        } else {
            block_access_method();
        }
    }

    function datagrid()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
            $page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
            $offset = $row * ($page - 1);
            $data = array();
            $params = array('_return' => 'data');
            $where['kategori ='] = '0';
            if (isset($where))
                $params['_where'] = $where;

            $data['total'] = isset($where) ? $this->repositori_model->count_by($where) : $this->repositori_model->count_all();
            $this->repositori_model->limit($row, $offset);
            $rows = $this->repositori_model->set_params($params)->with(array('divisi'));
            $data['rows'] = $this->repositori_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else {
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
				$docs = $this->repositori_model->get(intval($id));
				if(sizeof($docs) == 1)
				{
					$doc = $this->repositori_model->get_single($docs);
					$files = substr(__dir__,0, strpos( __dir__,"application")) . 'assets/files/repositori/' . $doc->nama_file;
					if(file_exists($files))
					{
						header('Cache-Control: public');
						 header('Content-Disposition: attachment; filename="' . $doc->nama_file . '"');
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
