<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	class Monitoring extends MY_Controller {


	function __construct()

	{
		parent::__construct();
		$this->load->model('v_monitoring');
		$this->load->model('artikel_model');
	}
	function index()
		{
			$this->load->library('grid');
			$grid = $this->grid->set_properties(array('model'=>'v_monitoring', 'controller'=>'monitoring', 'rownumber', 'options'=>array('id'=>'monitoring', 'pagination')))->load_model()->set_grid();
			
			$view = $this->load->view('v_laporan_asesmen/monitoring', array('grid'=>$grid), true);
			
			echo json_encode(array('msgType'=>'success', 'msgValue'=>$view));
			
		}
	
	function datagrid()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows')) ;
			$page = intval($this->input->post('page'))== 0 ? 1 : intval($this->input->post('page'));
			$offset = $row * ($page - 1);
			$data = array();
			$jenis_user = $this->auth->get_user_data()->jenis_user;
            if($jenis_user == 3){
                $asesi_id = $this->auth->get_user_data()->pegawai_id;
                $where['id_tuk ='] = $asesi_id;     
            }
			if(isset($_POST['nama_user']) && !empty($_POST['nama_user']))
			{
				$where['nama_user LIKE'] = '%' . $this->input->post('nama_user') . '%';
			}
			if(isset($_POST['akun']) && !empty($_POST['akun']))
			{
				$where['akun LIKE'] = '%' . $this->input->post('akun') . '%';
			}
			if(isset($_POST['jenis_user']) && !empty($_POST['jenis_user']))
			{
				$where['jenis_user ='] = $this->input->post('jenis_user') ;
			}
			$where['id !='] = "";	
			$params = array('_return'=>'data');
			if(isset($where)) $params['_where'] = $where;
			$data['total'] = $where ? $this->v_monitoring->count_by($where) : $this->v_monitoring->count_all();
			$this->v_monitoring->limit($row, $offset);
			$order = $this->v_monitoring->get_params('_order');
			$rows = $this->v_monitoring->set_params($params)->with(array());
			$data['rows'] = $this->v_monitoring->get_selected()->data_formatter($rows);
			echo json_encode($data);
		}
		else
		{
			block_access_method();
		}
	}
	
}