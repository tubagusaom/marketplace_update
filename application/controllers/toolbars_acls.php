<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Toolbars_Acls extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('V_Toolbar_Model');
		$this->load->model('Toolbar_Acl_Model');
		
	}
	
	function index()
	{
		$this->load->library('grid');
		$toolbar_grid = $this->grid->set_properties(array('model'=>'V_Toolbar_Model', 'controller'=>'toolbars_acls', 'options'=>array('id'=>'toolbars_acls', 'pagination', 'rownumber')))->load_model()->set_grid();
		
		$view = $this->load->view('vtoolbars/index', array('toolbar_grid'=>$toolbar_grid), true);
		
		echo json_encode(array('msgType'=>'success', 'msgValue'=>$view));
	}
	
	function datagrid()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows')) ;
			$page = intval($this->input->post('page'))== 0 ? 1 : intval($this->input->post('page'));
			$offset = $row * ($page - 1);
			if(isset($_POST['nama_controller']) && !empty($_POST['nama_controller']))
			{
				$where['controller_name LIKE'] = '%' . $this->input->post('nama_controller') . '%';
			}
			if(isset($_POST['nama_method']) && !empty($_POST['nama_method']))
			{
				$where['method_name LIKE'] = '%' . $this->input->post('nama_method') . '%';
			}
			if(isset($_POST['nama_toolbar']) && !empty($_POST['nama_toolbar']))
			{
				$where['toolbar_name LIKE'] = '%' . $this->input->post('nama_toolbar') . '%';
			}
			$data = array();
			$params = array('_return'=>'data');
			if(isset($where)) $params['_where'] = $where;
			$data['total'] = isset($where) ? $this->V_Toolbar_Model->count_by($where) : $this->V_Toolbar_Model->count_all();
			$this->V_Toolbar_Model->limit($row, $offset);
			$order = $this->V_Toolbar_Model->get_params('_order');
			$rows = isset($where) ? $this->V_Toolbar_Model->order_by($order)->get_many_by($where) : $this->V_Toolbar_Model->order_by($order)->get_all();
			$data['rows'] = $this->V_Toolbar_Model->get_selected()->data_formatter($rows);
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
			$data = $this->Toolbar_Acl_Model->set_validation()->validate();
			if($data !== false)
			{
				if($this->Toolbar_Acl_Model->check_unique($data))
				{
					if($this->Toolbar_Acl_Model->insert($data) !== false)
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
					echo json_encode(array('msgType'=>'error', 'msgValue'=>implode("<br/>", $this->Toolbar_Acl_Model->get_validation())));
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
			
			$toolbar_grid = $this->combogrid->set_properties(array('model'=>'Toolbar_Model', 'controller'=>'toolbars', 'options'=>array('id'=>'toolbar_id', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'toolbar_name', 'panelWidth'=>400)))->load_model()->set_grid();
			
			$acl_grid = $this->combogrid->set_properties(array('model'=>'V_Controller_Method_Role_Model', 'controller'=>'acls', 'fields'=>array('acl', 'controller_name', 'method_name', 'nama_peran'), 'options'=>array('id'=>'acl_id', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'acl', 'panelWidth'=>400)))->load_model()->set_grid();
			
			echo json_encode(array('msgType'=>'success', 'msgValue'=>$this->load->view('vtoolbars/add',array('toolbar_grid'=>$toolbar_grid, 'acl_grid'=>$acl_grid, 'grid_type'=>array('1'=>'Datagrid', '2'=>'Treegrid')), TRUE)));
		}
	}
	
	function edit($id = false)
	{
		if(!$id){
			data_not_found();
			exit;
		}
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$data = $this->Toolbar_Acl_Model->set_validation()->validate();
			if($data !== false)
			{
				if($this->Toolbar_Acl_Model->check_unique($data, intval($id)))
				{
					if($this->Toolbar_Acl_Model->update(intval($id), $data) !== false)
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
					echo json_encode(array('msgType'=>'error', 'msgValue'=>implode("<br/>", $this->Toolbar_Acl_Model->get_validation())));
				}
			}
			else
			{
				echo json_encode(array('msgType'=>'error', 'msgValue'=>validation_errors()));
			}
		}
		else
		{
			$toolbars = $this->Toolbar_Acl_Model->get(intval($id));
			if(sizeof($toolbars) == 1)
			{
				$toolbar = $this->Toolbar_Acl_Model->get_single($toolbars); 
				
				$this->load->library('combogrid');
			
				$toolbar_grid = $this->combogrid->set_properties(array('model'=>'Toolbar_Model', 'controller'=>'toolbars', 'value'=>$toolbar->toolbar_id, 'options'=>array('id'=>'toolbar_id', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'toolbar_name', 'panelWidth'=>400)))->load_model()->set_grid();
				
				$acl_grid = $this->combogrid->set_properties(array('model'=>'V_Controller_Method_Role_Model', 'controller'=>'acls', 'value'=>$toolbar->acl_id, 'fields'=>array('acl', 'controller_name', 'method_name', 'nama_peran'), 'options'=>array('id'=>'acl_id', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'acl', 'panelWidth'=>400)))->load_model()->set_grid();
				
				$view = $this->load->view('vtoolbars/edit', array('data'=>$toolbar, 'toolbar_grid'=>$toolbar_grid, 'acl_grid'=>$acl_grid, 'grid_type'=>array('1'=>'Datagrid', '2'=>'Treegrid')), TRUE);
				echo json_encode(array('msgType'=>'success', 'msgValue'=>$view));
			}
			else
			{
				echo json_encode(array('msgType'=>'error', 'msgValue'=>'Data tidak dapat ditemukan !'));
			}
		}
	}
	
	function delete($id = false)
	{
		if(!$id){
			data_not_found();
			exit;
		}
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$toolbar = $this->Toolbar_Acl_Model->get(intval($id));
			if(sizeof($toolbar) == 1)
			{
				if($this->Toolbar_Acl_Model->delete(intval($id)))
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
			echo json_encode(array('msgType'=>'success', 'msgValue'=>$this->load->view('vtoolbars/search','', TRUE)));
		}
		else
		{
			block_access_method();
		}
	}
	
}