<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	class Pemakaian_blanko extends MY_Controller {


	function __construct()

	{
		parent::__construct();
		$this->load->model('vpemakaian_blanko');
		
	}
	function index()
		{
			$this->load->library('grid');
			$grid = $this->grid->set_properties(array('model'=>'vpemakaian_blanko', 'controller'=>'pemakaian_blanko', 'rownumber', 'options'=>array('id'=>'pemakaian_blanko', 'pagination')))->load_model()->set_grid();
			
			$view = $this->load->view('v_laporan_asesmen/vpemakaian_blanko', array('grid'=>$grid), true);
			
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
            
			$where['id !='] = "";	
			$params = array('_return'=>'data');
			if(isset($where)) $params['_where'] = $where;
			$data['total'] = $where ? $this->vpemakaian_blanko->count_by($where) : $this->vpemakaian_blanko->count_all();
			$this->vpemakaian_blanko->limit($row, $offset);
			$order = $this->vpemakaian_blanko->get_params('_order');
			$rows = $this->vpemakaian_blanko->set_params($params)->with(array());
			$data['rows'] = $this->vpemakaian_blanko->get_selected()->data_formatter($rows);
			echo json_encode($data);
		}
		else
		{
			block_access_method();
		}
	}

}