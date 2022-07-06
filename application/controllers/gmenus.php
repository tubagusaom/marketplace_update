<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gmenus extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('Group_Menu_Model');
		
	}
	
	function index()
	{
		$this->load->library('grid');
		$gmenu_grid = $this->grid->set_properties(array('model'=>'Group_Menu_Model', 'controller'=>'gmenus', 'options'=>array('id'=>'gmenus', 'pagination', 'rownumber', 'target'=>array('id'=>'menus', 'controller'=>'menus'))))->load_model()->set_grid();
		$menu_grid = $this->grid->set_properties(array('model'=>'Menu_Model', 'controller'=>'menus', 'fields'=>array('menu_name', 'icon_name'), 'options'=>array('child', 'id'=>'menus', 'pagination', 'rownumber')))->load_model()->set_grid();
		
		$view = $this->load->view('gmenus/index', array('gmenu_grid'=>$gmenu_grid, 'menu_grid'=>$menu_grid), true);
		
		echo json_encode(array('msgType'=>'success', 'msgValue'=>$view));
		
	}
	
	function datagrid()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$row = intval($this->input->post('rows')) == 0 ? 15 : intval($this->input->post('rows')) ;
			$page = intval($this->input->post('page'))== 0 ? 1 : intval($this->input->post('page'));
			$offset = $row * ($page - 1);
			$data = array();
			$params = array('_return'=>'data');
			if(isset($where)) $params['_where'] = $where;
			$data['total'] = isset($where) ? $this->Group_Menu_Model->count_by($where) : $this->Group_Menu_Model->count_all();
			$this->Group_Menu_Model->limit($row, $offset);
			$order = $this->Group_Menu_Model->get_params('_order');
			$rows = isset($where) ? $this->Group_Menu_Model->order_by($order)->get_many_by($where) : $this->Group_Menu_Model->order_by($order)->get_all();
			$data['rows'] = $this->Group_Menu_Model->get_selected()->data_formatter($rows);
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
			$data = $this->Group_Menu_Model->set_validation()->validate();
			if($data !== false)
			{
				if($this->Group_Menu_Model->check_unique($data))
				{
					if($this->Group_Menu_Model->insert($data) !== false)
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
					echo json_encode(array('msgType'=>'error', 'msgValue'=>implode("<br/>", $this->Group_Menu_Model->get_validation())));
				}
			}
			else
			{
				echo json_encode(array('msgType'=>'error', 'msgValue'=>validation_errors()));
			}
		}
		else
		{
			echo json_encode(array('msgType'=>'success', 'msgValue'=>$this->load->view('gmenus/add','', TRUE)));
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
			$data = $this->Group_Menu_Model->set_validation()->validate();
			if($data !== false)
			{
				if($this->Group_Menu_Model->check_unique($data, intval($id)))
				{
					if($this->Group_Menu_Model->update(intval($id), $data) !== false)
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
					echo json_encode(array('msgType'=>'error', 'msgValue'=>implode("<br/>", $this->Group_Menu_Model->get_validation())));
				}
			}
			else
			{
				echo json_encode(array('msgType'=>'error', 'msgValue'=>validation_errors()));
			}
		}
		else
		{
			$con_method = $this->Group_Menu_Model->get(intval($id));
			if(sizeof($con_method) == 1)
			{
				$view = $this->load->view('gmenus/edit', array('data'=>$this->Group_Menu_Model->get_single($con_method)), TRUE);
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
			$roles = $this->Group_Menu_Model->get(intval($id));
			if(sizeof($roles) == 1)
			{
				if($this->Group_Menu_Model->delete(intval($id)))
				{
					$this->load->model('Menu_Model');
					$this->Menu_Model->delete_by(array('group_menu_id'=>intval($id)));
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