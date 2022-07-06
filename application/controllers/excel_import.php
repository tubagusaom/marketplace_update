<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Excel_Import extends MY_Controller {


	function __construct()
	{
		parent::__construct();
		$this->load->model('Siswa_model');

	}

	 function datagrid() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
            $page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
            $offset = $row * ($page - 1);
            if(isset($_POST['nis']) && !empty($_POST['nis']))
			{
				$where['nis LIKE'] = '%' . $this->input->post('nis') . '%';
			}
            if(isset($_POST['nama']) && !empty($_POST['nama']))
			{
				$where['nama LIKE'] = '%' . $this->input->post('nama') . '%';
			}
            if(isset($_POST['batch_id']) && !empty($_POST['batch_id']))
			{
                if($_POST['batch_id']==0){
                    $where['batch_id LIKE'] = '%%';
                }else{
                    $where['batch_id ='] = $this->input->post('batch_id');
                }

			}
            if(isset($_POST['base']) && !empty($_POST['base']))
			{
                if($_POST['base']!=0){
                    $where['base ='] = $this->input->post('base');
                }

			}
            if(isset($_POST['current_program']) && !empty($_POST['current_program']))
			{
				$where['current_program ='] = $this->input->post('current_program');
			}
            $data = array();
            $params = array('_return' => 'data');

            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->Siswa_model->count_by($where) : $this->Siswa_model->count_all();
            $this->Siswa_model->limit($row, $offset);
            $rows = $this->Siswa_model->set_params($params)->with(array('batch_name', 'program_study'));
            $data['rows'] = $this->Siswa_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else {
            block_access_method();
        }
    }

	function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'Siswa_model', 'controller' => 'excel_import', 'options' => array('id' => 'import_excel', 'pagination', 'rownumber')))->load_model()->set_grid();
            $view = $this->load->view('excel/index', array('grid' => $grid), true);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        } else {
            block_access_method();
        }
    }

	function add()
	{
		if($_SERVER['REQUEST_METHOD'] == 'GET')
		{
			echo json_encode(array('msgType'=>'success', 'msgValue'=>$this->load->view('excel/add','', TRUE)));
		}
		else
		{
			block_access_method();
		}
	}

	function upload()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$config['upload_path'] = substr(__dir__,0, strpos( __dir__,"application")) . 'assets/files/excels';
			$config['allowed_types'] = 'xlsx|xls|csv';
			$config['max_size'] = '1024';

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('fileToUpload'))
			{
				echo json_encode(array('msgType'=>'error','msgValue'=>$this->upload->display_errors()));
			}
			else
			{
				$this->load->model('angkatan_model');
				$this->load->model('program_model');
				$angkatan = $this->angkatan_model->dropdown('id', 'batch_name');
				$program = $this->program_model->dropdown('id', 'program_study');
				$columns = $this->Siswa_model->get_params('_columns');
				$uploaded = $this->upload->data();
				$files = substr(__dir__,0, strpos( __dir__,"application")) . 'assets/files/excels/' . $uploaded['file_name'];
				$this->load->library('excel');
				$objReader = $this->load->library('PHPExcel/Reader/PHPExcel_Reader_Excel5', $files);
				$objReader = new PHPExcel_Reader_Excel5();
				$objReader->setReadDataOnly(true);
				$objPHPExcel = $objReader->load($files);
				$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
				for($x=2; $x <= sizeof($sheetData); $x++)
				{
					$data = array();
					$id = $this->Siswa_model->get_by(array('nis'=>$sheetData[$x]['A']));
					$data_id = $this->Siswa_model->get_single($id);
					$data['nama'] = $sheetData[$x]['B'];
					$data['batch_id'] = array_search($sheetData[$x]['C'],$angkatan);
					$data['base'] = $sheetData[$x]['D'];
					$data['program_id'] = array_search($sheetData[$x]['E'],$program);
					$data['current_program'] = array_search($sheetData[$x]['F'],$columns['current_program']['formatter']);
					$data['spl'] = $sheetData[$x]['G'];
					$data['gender'] = array_search($sheetData[$x]['H'],$columns['gender']['formatter']);
					$data['agama'] = array_search($sheetData[$x]['I'],$columns['agama']['formatter']);
					$data['tempat_lahir'] = $sheetData[$x]['J'];
					$data['tgl_lahir'] = date('Y-m-d', strtotime($sheetData[$x]['K']));
					$data['alamat'] = $sheetData[$x]['L'];
					$data['email_siswa'] = $sheetData[$x]['M'];
					$data['telepon'] = $sheetData[$x]['N'];
					$data['orang_tua'] = $sheetData[$x]['O'];
					$data['kerja_orang_tua'] = $sheetData[$x]['P'];
					if(sizeof($id) == 1)
					{
						$this->Siswa_model->update($data_id->id, $data);
					}
					else
					{
						$data['nis'] = $sheetData[$x]['A'];
						$this->Siswa_model->insert($data);
					}
				}
				echo json_encode(array('msgType'=>'success','msgValue'=>"Data sukses diimport"));
			}
		}
		else
		{
			block_access_method();
		}
	}

}
