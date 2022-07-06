<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Import_ps extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('import_ps_model');
          $this->load->model('User_Model');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'import_ps_model', 'controller' => 'import_ps', 'options' => array('id' => 'import_ps', 'pagination', 'rownumber')))->load_model()->set_grid();
            $view = $this->load->view('import_ps/index', array('grid' => $grid), true);
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
            $data['total'] = isset($where) ? $this->import_ps_model->count_by($where) : $this->import_ps_model->count_all();
            $this->import_ps_model->limit($row, $offset);
            $order = $this->import_ps_model->get_params('_order');
            //$rows = isset($where) ? $this->import_ps_model->order_by($order)->get_many_by($where) : $this->import_ps_model->order_by($order)->get_all();
            $rows = $this->import_ps_model->set_params($params)->with(array('skema'));
            $data['rows'] = $this->import_ps_model->get_selected()->data_formatter($rows);
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
            $roles = $this->import_ps_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->import_ps_model->delete(intval($id))) {
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
            $this->load->model('import_ps_model');
            $view = $this->load->view('import_ps/search', array(), TRUE);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));

        } else {
            block_access_method();
        }
    }

    function add()
    {
        if($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            echo json_encode(array('msgType'=>'success', 'msgValue'=>$this->load->view('import_ps/add','', TRUE)));
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
                $uploaded = $this->upload->data();
                $files = substr(__dir__,0, strpos( __dir__,"application")) . 'assets/files/excels/' . $uploaded['file_name'];
                $this->load->library('excel');
                $objReader = $this->load->library('PHPExcel/Reader/PHPExcel_Reader_Excel5', $files);
                $objReader = new PHPExcel_Reader_Excel5();
                $objReader->setReadDataOnly(true);
                $objPHPExcel = $objReader->load($files);
                $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
                $users_temp = kode_tbl().'users_temp';
                $this->db->query("TRUNCATE TABLE $users_temp");
                for($x=2; $x <= sizeof($sheetData); $x++)
                {
                        $data = array();
                        $data['users'] = $sheetData[$x]['A'];
                        $data['no_reg'] = $sheetData[$x]['B'];
                        $data['hp'] = $sheetData[$x]['C'];
                        $data['email'] = $sheetData[$x]['D'];
                        $data['skema_sertifikasi'] = $sheetData[$x]['E'];
                        $data['no_sertifikat'] = $sheetData[$x]['F'];
                        $data['no_seri'] = $sheetData[$x]['G'];
                        $data['provinsi'] = $sheetData[$x]['H'];
                         $data['tahun'] = $sheetData[$x]['I'];
                        $this->db->insert($users_temp,$data);

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
        $users_temp = kode_tbl().'users_temp';
        $skema = kode_tbl().'skema';
        $unit_kompetensi = kode_tbl().'unit_kompetensi';
        $skema_detail = kode_tbl().'skema_detail';
        $asesi = kode_tbl().'asesi';

    	$data = $this->db->get($users_temp)->result();
    	foreach ($data as $key => $value) {

		    if($value->users != ''){
		        $data_asesi = array(
		        	'nama_lengkap'=>$value->users,
		        	'email'=>$value->email,
		        	'telp'=>$value->hp,
		        	'no_registrasi'=>$value->no_reg,
                    'no_seri'=>$value->no_seri,
		        	'skema_sertifikasi'=>$value->skema_sertifikasi,
		        	'no_sertifikat'=>$value->no_sertifikat,
		        	'tahun_penerbitan_sertifikat'=>$value->tahun,
		        	'terbitkan_sertifikat'=>'on',
                    'provinsi'=>$value->provinsi,

		        );
		        $this->db->insert($asesi,$data_asesi);
		    }

		}

    }

}
