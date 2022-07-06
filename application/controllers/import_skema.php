<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Import_skema extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('import_skema_model');
          $this->load->model('User_Model');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'import_skema_model', 'controller' => 'import_skema', 'options' => array('id' => 'import_skema', 'pagination', 'rownumber')))->load_model()->set_grid();
            $view = $this->load->view('import_skema/index', array('grid' => $grid), true);
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
            $data['total'] = isset($where) ? $this->import_skema_model->count_by($where) : $this->import_skema_model->count_all();
            $this->import_skema_model->limit($row, $offset);
            $order = $this->import_skema_model->get_params('_order');
            //$rows = isset($where) ? $this->import_skema_model->order_by($order)->get_many_by($where) : $this->import_skema_model->order_by($order)->get_all();
            $rows = $this->import_skema_model->set_params($params)->with(array('tuk','skema','user'));
            $data['rows'] = $this->import_skema_model->get_selected()->data_formatter($rows);
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
            $roles = $this->import_skema_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->import_skema_model->delete(intval($id))) {
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
            $this->load->model('import_skema_model');
            $view = $this->load->view('import_skema/search', array(), TRUE);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));

        } else {
            block_access_method();
        }
    }

    function add()
    {
        if($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            echo json_encode(array('msgType'=>'success', 'msgValue'=>$this->load->view('import_skema/add','', TRUE)));
        }
        else
        {
            block_access_method();
        }
    }

    function upload()
    {
         $skema_temp = kode_tbl().'skema_temp';
        $skema = kode_tbl().'skema';
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
                $uploaded = $this->upload->data();
                $files = substr(__dir__,0, strpos( __dir__,"application")) . 'assets/files/excels/' . $uploaded['file_name'];
                $this->load->library('excel');
                $objReader = $this->load->library('PHPExcel/Reader/PHPExcel_Reader_Excel5', $files);
                $objReader = new PHPExcel_Reader_Excel5();
                $objReader->setReadDataOnly(true);
                $objPHPExcel = $objReader->load($files);
                $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
                $this->db->query("TRUNCATE TABLE $skema_temp");
                for($x=2; $x <= sizeof($sheetData); $x++)
                {
                        $data = array();
                        $data['kode_skema'] = $sheetData[$x]['A'];
                        $data['skema'] = $sheetData[$x]['B'];
                        $data['kode_unit'] = $sheetData[$x]['C'];
                        $data['unit'] = $sheetData[$x]['D'];
                        $this->db->insert($skema_temp,$data);

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
        $skema_temp = kode_tbl().'skema_temp';
        $skema = kode_tbl().'skema';
        $unit_kompetensi = kode_tbl().'unit_kompetensi';
        $skema_detail = kode_tbl().'skema_detail';
    	$data = $this->db->get($skema_temp)->result();
    	foreach ($data as $key => $value) {

		    if($value->skema != ''){
		        $data_skema = array('skema'=>$value->skema,'kode_skema'=>$value->kode_skema);
		        $this->db->insert($skema,$data_skema);
		    }else{
		    	$this->db->where('id_unit_kompetensi',$value->kode_unit);
		    	$query = $this->db->get($unit_kompetensi);

		        if($query->num_rows() > 0){
		            $array_unit=$query->row();
		            $id_unit = $array_unit->id;
		            $this->db->query("INSERT INTO $skema_detail SET id_skema=(SELECT MAX(id) FROM $skema),id_unit_kompetensi=".$id_unit);
		        }else{
		            $kode_unit = $value->kode_unit;
		            $unit = $value->unit;
		            $this->db->query("INSERT INTO $unit_kompetensi SET id_unit_kompetensi='$kode_unit',unit_kompetensi='$unit'");

		            $this->db->query("INSERT INTO $skema_detail SET id_skema=(SELECT MAX(id) FROM $skema),
		            id_unit_kompetensi=(SELECT MAX(id) FROM $unit_kompetensi)");
		        }
		    }

		}

    }

}
