<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kelas extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('Kelas_Model');
		
	}
	
	function index()
	{
		$this->load->library('grid');
		$grid = $this->grid->set_properties(array('model'=>'Kelas_Model', 'controller'=>'kelas', 'options'=>array('id'=>'kelas', 'pagination', 'rownumber')))->load_model()->set_grid();
		
		$view = $this->load->view('kelas/index', array('grid'=>$grid), true);
		
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
			if(isset($_POST['nama_kelas']) && !empty($_POST['nama_kelas']))
			{
				$where['nama_kelas LIKE'] = '%' . $this->input->post('nama_kelas') . '%';
			}
			if(isset($where)) $params['_where'] = $where;
			$data['total'] = $this->Kelas_Model->set_params($params)->count_with(array('guru'));
			 
			$this->Kelas_Model->limit($row, $offset);
			$order = $this->Kelas_Model->get_params('_order');
			$rows = $this->Kelas_Model->set_params($params)->with(array('guru'));
			$data['rows'] = $this->Kelas_Model->get_selected()->data_formatter($rows);
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
			$data = $this->Kelas_Model->set_validation()->validate();
			if($data !== false)
			{
				if($this->Kelas_Model->check_unique($data))
				{
					if($this->Kelas_Model->insert($data) !== false)
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
					echo json_encode(array('msgType'=>'error', 'msgValue'=>implode("<br/>", $this->Kelas_Model->get_validation())));
				}
			}
			else
			{
				echo json_encode(array('msgType'=>'error', 'msgValue'=>validation_errors()));
			}
		}
		else
		{
			$this->load->library('combogrid');
			
			$guru_grid = $this->combogrid->set_properties(array('model'=>'Guru_Model', 'controller'=>'guru', 'options'=>array('id'=>'id_guru', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama_guru', 'panelWidth'=>400)))->load_model()->set_grid();
			
			echo json_encode(array('msgType'=>'success', 'msgValue'=>$this->load->view('kelas/add',array('grid'=>$guru_grid), TRUE)));
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
			$data = $this->Kelas_Model->set_validation()->validate();
			if($data !== false)
			{
				if($this->Kelas_Model->check_unique($data, intval($id)))
				{
					if($this->Kelas_Model->update(intval($id), $data) !== false)
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
					echo json_encode(array('msgType'=>'error', 'msgValue'=>implode("<br/>", $this->Kelas_Model->get_validation())));
				}
			}
			else
			{
				echo json_encode(array('msgType'=>'error', 'msgValue'=>validation_errors()));
			}
		}
		else
		{
			$controller = $this->Kelas_Model->get(intval($id));
			if(sizeof($controller) == 1)
			{
				$this->load->library('combogrid');
			
				$guru_grid = $this->combogrid->set_properties(array('model'=>'Guru_Model', 'controller'=>'guru','value'=>$controller->id_guru,  'options'=>array('id'=>'id_guru', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama_guru', 'panelWidth'=>400)))->load_model()->set_grid();

				$view = $this->load->view('kelas/edit', array('data'=>$this->Kelas_Model->get_single($controller),'grid'=>$guru_grid), TRUE);
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
			$method = $this->Kelas_Model->get(intval($id));
			if(sizeof($method) == 1)
			{
				if($this->Kelas_Model->delete(intval($id)))
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
	
	function search()
	{
		if($_SERVER['REQUEST_METHOD'] == 'GET')
		{
			echo json_encode(array('msgType'=>'success', 'msgValue'=>$this->load->view('controllers/search','', TRUE)));
		}
		else
		{
			block_access_method();
		}
	}

}