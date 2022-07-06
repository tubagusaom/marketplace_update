<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Import_soal extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('import_soal_model');
          $this->load->model('User_Model');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'import_soal_model', 'controller' => 'import_soal', 'options' => array('id' => 'import_soal', 'pagination', 'rows_number')))->load_model()->set_grid();
            $view = $this->load->view('import_soal/index', array('grid' => $grid), true);
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
            $data['total'] = isset($where) ? $this->import_soal_model->count_by($where) : $this->import_soal_model->count_all();
            $this->import_soal_model->limit($row, $offset);
            $order = $this->import_soal_model->get_params('_order');
            //$rows = isset($where) ? $this->import_soal_model->order_by($order)->get_many_by($where) : $this->import_soal_model->order_by($order)->get_all();
            $rows = $this->import_soal_model->set_params($params)->with(array('master_perangkat_detail','master_unit_kompetensi'));
            $data['rows'] = $this->import_soal_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        } else {
            block_access_method();
        }
    }

    

    function delete($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $roles = $this->import_soal_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->import_soal_model->delete(intval($id))) {
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
  
    function search() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->model('import_soal_model');
            $view = $this->load->view('import_soal/search', array(), TRUE);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));

        } else {
            block_access_method();
        }
    }
   
    function add()
    {
        if($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            echo json_encode(array('msgType'=>'success', 'msgValue'=>$this->load->view('import_soal/add','', TRUE)));
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
            $soal_temp = kode_tbl().'soal_temp';
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
                $uploaded = $this->upload->data();
                $files = substr(__dir__,0, strpos( __dir__,"application")) . 'assets/files/excels/' . $uploaded['file_name'];
                $this->load->library('excel');
                $objReader = $this->load->library('PHPExcel/Reader/PHPExcel_Reader_Excel5', $files);
                $objReader = new PHPExcel_Reader_Excel5();             
                $objReader->setReadDataOnly(true);
                $objPHPExcel = $objReader->load($files);
                $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
                $this->db->query("TRUNCATE TABLE $soal_temp");
                $soal = array('-','Pilihan Ganda','Essay','Menjodohkan');
                for($x=2; $x <= sizeof($sheetData); $x++)
                {
                        $data = array();
                        $data['id_perangkat_detail'] = $this->import_soal_model->get_kode_perangkat($sheetData[$x]['A']);
                        $data['id_unit_kompetensi'] = $this->import_soal_model->get_kode_unit($sheetData[$x]['B']);

                        if($sheetData[$x]['C']=='Pilihan Ganda'){
                        	$jenis_soal = '1';
                        }else if($sheetData[$x]['C']=='Essay'){
                        	$jenis_soal = '2';
                        }else if($sheetData[$x]['C']=='Menjodohkan'){
                        	$jenis_soal = '3';
                        }else{
                        	$jenis_soal = '';
                        }
                        $data['jenis_soal'] = $jenis_soal;
                        $data['pertanyaan'] = $sheetData[$x]['D'];

                        $data['jawaban_a'] = $sheetData[$x]['E'];
                        $data['jawaban_b'] = $sheetData[$x]['F'];
                        $data['jawaban_c'] = $sheetData[$x]['G'];
                        $data['jawaban_d'] = $sheetData[$x]['H'];
                        $data['jawaban_e'] = $sheetData[$x]['I'];
                        $data['jawaban_benar'] = $sheetData[$x]['J'];
                        $data['urutan'] = $sheetData[$x]['K'];

                        //var_dump($data);die();
                        $this->db->insert($soal_temp,$data);
                    
                }
                echo json_encode(array('msgType'=>'success','msgValue'=>"Data sukses diimport"));
            }
        }
        else
        {
            block_access_method();
        }
    }
    function posting(){
        echo json_encode(array('msgType'=>'success','msgValue'=>"Data sukses diimport"));
    }
    function proses(){
        $soal_temp = kode_tbl().'soal_temp';
        $soal = kode_tbl().'soal';
        $data = $this->db->get($soal_temp)->result();

    	foreach ($data as $key => $value) {
        	

	            	$id_perangkat_detail = $value->id_perangkat_detail;
	            	$id_unit_kompetensi = $value->id_unit_kompetensi;
                    $jenis_soal = $value->jenis_soal;
                    $pertanyaan = $value->pertanyaan;
                    $jawaban_a = $value->jawaban_a;
                    $jawaban_b = $value->jawaban_b;
                    $jawaban_c = $value->jawaban_c;
                    $jawaban_d = $value->jawaban_d;
                    $jawaban_e = $value->jawaban_e;
                    $jawaban_benar = $value->jawaban_benar;
                    $urutan = $value->urutan;
                    
	                $this->db->query("INSERT INTO $soal SET id_perangkat_detail='$id_perangkat_detail',id_unit_kompetensi='$id_unit_kompetensi',
	                	jenis_soal='$jenis_soal',
	                	pertanyaan='$pertanyaan',
	                	jawaban_a='$jawaban_a',
	                	jawaban_b='$jawaban_b',
	                	jawaban_c='$jawaban_c',
	                	jawaban_d='$jawaban_d',
	                	jawaban_e='$jawaban_e',
	                	jawaban_benar='$jawaban_benar',
	                	urutan='$urutan'
	                	"); 
	            }
	        
	    
    }
       
}
