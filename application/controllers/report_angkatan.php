<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Report_angkatan extends MY_Controller {


	function __construct()

	{
		parent::__construct();
		$this->load->model('v_report_student_model');
	}
	
    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'v_report_student_model', 'controller' => 'report_angkatan', 'options' => array('id' => 'report_student', 'pagination', 'rownumber')))->load_model()->set_grid();
            $view = $this->load->view('report_student/index', array('grid' => $grid), true);
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
            $jenis_user = $this->auth->get_user_data()->jenis_user;
            if($jenis_user == 1){
                $siswa_id = $this->auth->get_user_data()->pegawai_id;
                $where['siswa_id ='] = $siswa_id;    
            }
            
            if(isset($_POST['batch_id']) && !empty($_POST['batch_id']))
			{
                if($_POST['batch_id']==0){
                    $where['batch_id LIKE'] = '%%';
                }else{
                    $where['batch_id ='] = $this->input->post('batch_id');
                }

			}
            if(isset($_POST['siswa_id']) && !empty($_POST['siswa_id']))
			{
                    $where['siswa_id ='] = $this->input->post('siswa_id');
            }
            
            $data = array();
            $params = array('_return' => 'data');

            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->v_report_student_model->count_by($where) : $this->v_report_student_model->count_all();
            $this->v_report_student_model->limit($row, $offset);
            $rows = $this->v_report_student_model->set_params($params)->with(array());
            $data['rows'] = $this->v_report_student_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else {
            block_access_method();
        }
    }
	function search() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            
            $this->load->model('angkatan_model');
            $angkatan = $this->angkatan_model->dropdown('id', 'batch_name');
            array_unshift($angkatan,"-Semua Angkatan-");
            $this->load->library('combogrid');
            $schedule_grid = $this->combogrid->set_properties(array('model' => 'v_siswa_model', 'controller' => 'siswa', 'options' => array('id' => 'siswa_id', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'nama', 'panelWidth' => 400)))->load_model()->set_grid();
            $view = $this->load->view('report_student/search', array('angkatan' => $angkatan,'siswa_grid' => $schedule_grid), TRUE);

            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));

        } else {
            block_access_method();
        }
    }
	function download($type = "pdf") {
		$view = $this->load->view('report/report_student', $this->Report_Template_Model->angkatan(), true);
		if($type=="pdf") {
			$this->load->library("htm12pdf");
			$this->htm12pdf->pdf_create($view, "report_angkatan_" . date('YmdHis') . ".pdf", false, true);
		}
	}
    function cetak($type = "pdf") {
        $data['log_book'] = $this->v_report_student_model->report_all();
		$view = $this->load->view('report_student/cetak',$data , true);
		if($type=="pdf") {
			$this->load->library("htm12pdf");
			$this->htm12pdf->pdf_create($view, "report_student_" . date('YmdHis') . ".pdf", false, true);
		}
	}
		
}