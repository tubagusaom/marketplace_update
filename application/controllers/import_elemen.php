<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Import_elemen extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('import_elemen_model');
          $this->load->model('User_Model');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'import_elemen_model', 'controller' => 'import_elemen', 'options' => array('id' => 'import_elemen', 'pagination', 'rownumber')))->load_model()->set_grid();
            $view = $this->load->view('import_elemen/index', array('grid' => $grid), true);
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
            $data['total'] = isset($where) ? $this->import_elemen_model->count_by($where) : $this->import_elemen_model->count_all();
            $this->import_elemen_model->limit($row, $offset);
            $order = $this->import_elemen_model->get_params('_order');
            //$rows = isset($where) ? $this->import_elemen_model->order_by($order)->get_many_by($where) : $this->import_elemen_model->order_by($order)->get_all();
            $rows = $this->import_elemen_model->set_params($params)->with(array('tuk','skema','user'));
            $data['rows'] = $this->import_elemen_model->get_selected()->data_formatter($rows);
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
            $roles = $this->import_elemen_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->import_elemen_model->delete(intval($id))) {
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
            $this->load->model('import_elemen_model');
            $view = $this->load->view('import_elemen/search', array(), TRUE);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));

        } else {
            block_access_method();
        }
    }

    function add()
    {
        if($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            echo json_encode(array('msgType'=>'success', 'msgValue'=>$this->load->view('import_elemen/add','', TRUE)));
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
            $elemen_temp = kode_tbl().'elemen_temp';
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
                $this->db->query("TRUNCATE TABLE $elemen_temp");
                for($x=2; $x <= sizeof($sheetData); $x++)
                {
                        $data = array();
                        $data['kode_unit'] = $sheetData[$x]['A'];
                        $data['unit'] = $sheetData[$x]['B'];
                        $data['elemen'] = $sheetData[$x]['C'];
                        $data['kuk'] = $sheetData[$x]['D'];
                        $data['pertanyaan_kuk'] = $sheetData[$x]['E'];
                        $data['jumlah_bukti'] = $sheetData[$x]['F'];
                        if($data['jumlah_bukti'] == '3'){
                        	$array_bukti = array($sheetData[$x]['G'],$sheetData[$x]['H'],$sheetData[$x]['I']);
                        	$data['bukti'] = serialize($array_bukti);
                        	$array_jenis_bukti = array($sheetData[$x]['J'],$sheetData[$x]['K'],$sheetData[$x]['L']);
                        	$data['jenis_bukti'] = serialize($array_jenis_bukti);
                        }else if($data['jumlah_bukti'] == '2'){
                        	$array_bukti = array($sheetData[$x]['G'],$sheetData[$x]['H']);
                        	$data['bukti'] = serialize($array_bukti);
                        	$array_jenis_bukti = array($sheetData[$x]['I'],$sheetData[$x]['J']);
                        	$data['jenis_bukti'] = serialize($array_jenis_bukti);
                        }else{
                        	$data['bukti'] = $sheetData[$x]['G'];
                        	$data['jenis_bukti'] = $sheetData[$x]['H'];
                        }

                        //var_dump($data);die();
                        $this->db->insert($elemen_temp,$data);

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
        $elemen_temp = kode_tbl().'elemen_temp';
         $unit_kompetensi = kode_tbl().'unit_kompetensi';
         $elemen_kompetensi = kode_tbl().'elemen_kompetensi';
         $table_kuk = kode_tbl().'kuk';
    	 $data = $this->db->get($elemen_temp)->result();

    	foreach ($data as $key => $value) {
        	if($value->kode_unit != ''){
        		$this->db->where('id_unit_kompetensi',$value->kode_unit);

		    	$query_unit = $this->db->get($unit_kompetensi);

	            if($query_unit->num_rows() > 0){
	                $arrray_unit=$query_unit->row();
	                $unit=$arrray_unit->id;
	            }
	        }else{
	            if($value->elemen != ''){
	                $elemen = $value->elemen;
	                $this->db->query("INSERT INTO $elemen_kompetensi SET elemen_kompetensi='$elemen',id_unit_kompetensi='$unit'");
	            }else{
	            	$kuk = $value->kuk;
	            	$pertanyaan_kuk = $value->pertanyaan_kuk;
                    $jumlah_bukti = $value->jumlah_bukti;
                    $bukti = $value->bukti;
                    $jenis_bukti = $value->jenis_bukti;

	                $this->db->query("INSERT INTO $table_kuk SET jumlah_bukti='$jumlah_bukti',bukti='$bukti',jenis_bukti='$jenis_bukti',kuk='$kuk',pertanyaan='$pertanyaan_kuk',id_elemen_kompetensi=(SELECT MAX(id) FROM $elemen_kompetensi)");
	            }
	        }
	    }
    }

}
