<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Methods extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('Method_Model');
		
	}
	
	function index()
	{
		$this->load->library('grid');
		$grid = $this->grid->set_properties(array('model'=>'Method_Model', 'controller'=>'methods', 'options'=>array('id'=>'methods', 'pagination', 'rownumber')))->load_model()->set_grid();
		
		$view = $this->load->view('methods/index', array('grid'=>$grid), true);
		
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
			$params = array('_return'=>'data');
			if(isset($where)) $params['_where'] = $where;
			$data['total'] = isset($where) ? $this->Method_Model->count_by($where) : $this->Method_Model->count_all();
			$this->Method_Model->limit($row, $offset);
			$order = $this->Method_Model->get_params('_order');
			$rows = isset($where) ? $this->Method_Model->order_by($order)->get_many_by($where) : $this->Method_Model->order_by($order)->get_all();
			$data['rows'] = $this->Method_Model->get_selected()->data_formatter($rows);
			echo json_encode($data);
		}
		else
		{
			block_access_method();
		}
	}
	
	function add()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$data = $this->Method_Model->set_validation()->validate();
			if($data !== false)
			{
				if($this->Method_Model->check_unique($data))
				{
					if($this->Method_Model->insert($data) !== false)
					{
						echo json_encode(array('msgType'=>'success', 'msgValue'=>'Data berhasil disimpan !'));
					}
					else
					{
						echo json_encode(array('msgType'=>'error', 'msgValue'=>'Data tidak dapat disimpan !'));
					}
				}
				else
				{
					echo json_encode(array('msgType'=>'error', 'msgValue'=>implode("<br/>", $this->Method_Model->get_validation())));
				}
			}
			else
			{
				echo json_encode(array('msgType'=>'error', 'msgValue'=>validation_errors()));
			}
		}
		else
		{
			echo json_encode(array('msgType'=>'success', 'msgValue'=>$this->load->view('methods/add','', TRUE)));
		}
	}
	
	function edit($id)
	{
		if(!$id){
			data_not_found();
			exit;
		}
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$data = $this->Method_Model->set_validation()->validate();
			if($data !== false)
			{
				if($this->Method_Model->check_unique($data, intval($id)))
				{
					if($this->Method_Model->update(intval($id), $data) !== false)
					{
						echo json_encode(array('msgType'=>'success', 'msgValue'=>'Data berhasil disimpan !'));
					}
					else
					{
						echo json_encode(array('msgType'=>'error', 'msgValue'=>'Data tidak dapat disimpan !'));
					}
				}
				else
				{
					echo json_encode(array('msgType'=>'error', 'msgValue'=>implode("<br/>", $this->Method_Model->get_validation())));
				}
			}
			else
			{
				echo json_encode(array('msgType'=>'error', 'msgValue'=>validation_errors()));
			}
		}
		else
		{
			$method = $this->Method_Model->get(intval($id));
			if(sizeof($method) == 1)
			{
				$view = $this->load->view('methods/edit', array('data'=>$this->Method_Model->get_single($method)), TRUE);
				echo json_encode(array('msgType'=>'success', 'msgValue'=>$view));
			}
			else
			{
				echo json_encode(array('msgType'=>'error', 'msgValue'=>'Data tidak dapat ditemukan !'));
			}
		}
	}
	
	function delete($id)
	{
		if(!$id){
			data_not_found();
			exit;
		}
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$method = $this->Method_Model->get(intval($id));
			if(sizeof($method) == 1)
			{
				if($this->Method_Model->delete(intval($id)))
				{
					echo json_encode(array('msgType'=>'success', 'msgValue'=>'Data berhasil dihapus'));
				}
				else
				{
					echo json_encode(array('msgType'=>'error', 'msgValue'=>'Data tidak berhasil dihapus !'));
				}
			}
			else
			{
				echo json_encode(array('msgType'=>'error', 'msgValue'=>'Data tidak dapat ditemukan !'));
			}
		}
		else
		{
			block_access_method();
		}
	}

}