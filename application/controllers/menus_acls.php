<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menus_Acls extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('V_Menu_Model');		
		$this->load->model('Menu_Acl_Model');
		
	}
	
	function index()
	{
		$this->load->library('grid');
		$menu_grid = $this->grid->set_properties(array('model'=>'V_Menu_Model', 'controller'=>'menus_acls', 'options'=>array('id'=>'vmenus', 'pagination', 'rownumber')))->load_model()->set_grid();
		
		$view = $this->load->view('vmenus/index', array('menu_grid'=>$menu_grid), true);
		
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
			if(isset($_POST['nama_group_menu']) && !empty($_POST['nama_group_menu']))
			{
				$where['group_name LIKE'] = '%' . $this->input->post('nama_group_menu') . '%';
			}
			if(isset($_POST['nama_menu']) && !empty($_POST['nama_menu']))
			{
				$where['menu_name LIKE'] = '%' . $this->input->post('nama_menu') . '%';
			}
			if(isset($_POST['nama_controller']) && !empty($_POST['nama_controller']))
			{
				$where['controller_name LIKE'] = '%' . $this->input->post('nama_controller') . '%';
			}
			if(isset($where)) $params['_where'] = $where;
			$data['total'] = isset($where) ? $this->V_Menu_Model->count_by($where) : $this->V_Menu_Model->count_all();
			$this->V_Menu_Model->limit($row, $offset);
			$order = $this->V_Menu_Model->get_params('_order');
			$rows = isset($where) ? $this->V_Menu_Model->order_by($order)->get_many_by($where) : $this->V_Menu_Model->order_by($order)->get_all();
			$data['rows'] = $this->V_Menu_Model->get_selected()->data_formatter($rows);
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
						
			$data = $this->Menu_Acl_Model->set_validation()->validate();
			if($data !== false)
			{
				if($this->Menu_Acl_Model->check_unique($data))
				{
					if($this->Menu_Acl_Model->insert($data) !== false)
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
					echo json_encode(array('msgType'=>'error', 'msgValue'=>implode("<br/>", $this->Menu_Acl_Model->get_validation())));
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
			
			$menu_grid = $this->combogrid->set_properties(array('model'=>'V_Group_Menu_Model', 'controller'=>'menus', 'options'=>array('id'=>'menu_id', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'menu_name', 'panelWidth'=>400)))->load_model()->set_grid();
			
			$acl_grid = $this->combogrid->set_properties(array('model'=>'V_Controller_Method_Role_Model', 'controller'=>'acls', 'fields'=>array('acl', 'controller_name', 'method_name', 'nama_peran'), 'options'=>array('id'=>'acl_id', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'acl', 'panelWidth'=>400)))->load_model()->set_grid();
			
			echo json_encode(array('msgType'=>'success', 'msgValue'=>$this->load->view('vmenus/add',array('menu_grid'=>$menu_grid, 'acl_grid'=>$acl_grid), TRUE)));
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
			$data = $this->Menu_Acl_Model->set_validation()->validate();
			if($data !== false)
			{
				if($this->Menu_Acl_Model->check_unique($data, intval($id)))
				{
					if($this->Menu_Acl_Model->update(intval($id), $data) !== false)
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
					echo json_encode(array('msgType'=>'error', 'msgValue'=>implode("<br/>", $this->Menu_Acl_Model->get_validation())));
				}
			}
			else
			{
				echo json_encode(array('msgType'=>'error', 'msgValue'=>validation_errors()));
			}
		}
		else
		{
			$acls = $this->Menu_Acl_Model->get(intval($id));
			if(sizeof($acls) == 1)
			{
				$this->load->library('combogrid');
				
				$acl = $this->Menu_Acl_Model->get_single($acls);
			
				$menu_grid = $this->combogrid->set_properties(array('model'=>'V_Group_Menu_Model', 'controller'=>'menus', 'value'=>$acl->menu_id, 'options'=>array('id'=>'menu_id', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'menu_name', 'panelWidth'=>400)))->load_model()->set_grid();
				
				$acl_grid = $this->combogrid->set_properties(array('model'=>'V_Controller_Method_Role_Model', 'controller'=>'acls', 'fields'=>array('acl', 'controller_name', 'method_name', 'nama_peran'), 'value'=>$acl->acl_id, 'options'=>array('id'=>'acl_id', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'acl', 'panelWidth'=>400)))->load_model()->set_grid();
				
				echo json_encode(array('msgType'=>'success', 'msgValue'=>$this->load->view('vmenus/edit',array('data'=>$acl, 'menu_grid'=>$menu_grid, 'acl_grid'=>$acl_grid), TRUE)));
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
		else
		{
			if($_SERVER['REQUEST_METHOD'] == 'POST')
			{
				$acl = $this->Menu_Acl_Model->get(intval($id));
				if(sizeof($acl) == 1)
				{
					if($this->Menu_Acl_Model->delete(intval($id)))
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
	
	function search()
	{
		if($_SERVER['REQUEST_METHOD'] == 'GET')
		{
			echo json_encode(array('msgType'=>'success', 'msgValue'=>$this->load->view('vmenus/search','', TRUE)));
		}
		else
		{
			block_access_method();
		}
	}

}