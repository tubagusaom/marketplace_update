<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menus extends MY_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Menu_Model');
	}
	
	function index()
	{
		block_access_method();
	}
	
	function datagrid($id = false)
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if($id)
			{
				$row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows')) ;
				$page = intval($this->input->post('page'))== 0 ? 1 : intval($this->input->post('page'));
				$offset = $row * ($page - 1);
				$data = array();
				$where['group_menu_id'] = intval($id); 
				$params = array('_return'=>'data');
				if(isset($where)) $params['_where'] = $where;
				$data['total'] = isset($where) ? $this->Menu_Model->count_by($where) : $this->Menu_Model->count_all();
				$this->Menu_Model->limit($row, $offset);
				$order = $this->Menu_Model->get_params('_order');
				$rows = isset($where) ? $this->Menu_Model->order_by($order)->get_many_by($where) : $this->Menu_Model->order_by($order)->get_all();
				$data['rows'] = $this->Menu_Model->get_selected()->data_formatter($rows);
				echo json_encode($data);
			}
			else
			{
				echo json_encode(array('total'=>0, 'rows'=>array()));
			}
		}
		else
		{
			block_access_method();
		}
	}
	
	function add($id = false)
	{
		$this->load->model('Group_Menu_Model');
		if(!$id)
		{
			echo json_encode(array('msgType'=>'error', 'msgValue'=>'Anda belum memilih data Controller Method !'));
			exit;
		}
		else
		{
			if($_SERVER['REQUEST_METHOD'] == 'POST')
			{
				$_POST['group_menu_id'] = intval($id);
				$data = $this->Menu_Model->set_validation()->validate();
				if($data !== false)
				{
					if($this->Menu_Model->check_unique($data))
					{
						if($this->Menu_Model->insert($data) !== false)
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
						echo json_encode(array('msgType'=>'error', 'msgValue'=>implode("<br/>", $this->Menu_Model->get_validation())));
					}
				}
				else
				{
					echo json_encode(array('msgType'=>'error', 'msgValue'=>validation_errors()));
				}
			}
			else
			{
				$gmenus = $this->Group_Menu_Model->get_single($this->Group_Menu_Model->get(intval($id)));
				$view = $this->load->view('menus/add', array('group_name'=>$gmenus->group_name), TRUE);
				echo json_encode(array('msgType'=>'success', 'msgValue'=>$view));
			}
		}
	}
	
	function edit($id = false)
	{		
		if(!$id){
			data_not_found();
			exit;
		}
		else
		{
			$this->load->model('Group_Menu_Model');
			
			$menus = $this->Menu_Model->get(intval($id));				
			if(sizeof($menus) == 1)
			{
			
				$menu = $this->Menu_Model->get_single($menus);
				
				if($_SERVER['REQUEST_METHOD'] == 'POST')
				{
					$_POST['group_menu_id'] = $menu->group_menu_id;
					
					$data = $this->Menu_Model->set_validation()->validate();
					if($data !== false)
					{
						if($this->Menu_Model->check_unique($data, intval($id)))
						{
							if($this->Menu_Model->update(intval($id), $data) !== false)
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
							echo json_encode(array('msgType'=>'error', 'msgValue'=>implode("<br/>", $this->Menu_Model->get_validation())));
						}
					}
					else
					{
						echo json_encode(array('msgType'=>'error', 'msgValue'=>validation_errors()));
					}
				}
				else
				{
					
					$group = $this->Group_Menu_Model->get_single($this->Group_Menu_Model->get(intval($menu->group_menu_id)));
					$view = $this->load->view('menus/edit', array('data'=>$menu, 'group_name'=>$group->group_name), TRUE);
					echo json_encode(array('msgType'=>'success', 'msgValue'=>$view));
					
				}
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
				$menus = $this->Menu_Model->get(intval($id));
				if(sizeof($menus) == 1)
				{
					if($this->Menu_Model->delete_with_child(intval($id)))
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
	
	function combogrid($id = false)
	{
		$this->load->model('V_Group_Menu_Model');
		$row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows')) ;
		$page = intval($this->input->post('page'))== 0 ? 1 : intval($this->input->post('page'));
		$offset = $row * ($page - 1);
		$data = array();
		$params = array('_return'=>'data');
		if(isset($_POST['q']))
		{
			$where['menu_name LIKE'] = "%" . $this->input->post('q') . "%";
		}
		if(isset($where)) $params['_where'] = $where;
		$data['total'] = isset($where) ? $this->V_Group_Menu_Model->count_by($where) : $this->V_Group_Menu_Model->count_all();
		$this->V_Group_Menu_Model->limit($row, $offset);
		$order_criteria = "ASC";
		$_order_escape = TRUE;
		if($id)
		{
			$order = "FIELD(id, " . intval($id) . ")";
			$order_criteria = "DESC";
			$_order_escape = FALSE;
		}
		else
		{
			$order = $this->V_Group_Menu_Model->get_params('_order');
		}		
		$rows = isset($where) ? $this->V_Group_Menu_Model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->V_Group_Menu_Model->order_by($order, $order_criteria, $_order_escape)->get_all();
		$data['rows'] = $this->V_Group_Menu_Model->get_selected()->data_formatter($rows);
		echo json_encode($data);
	}
}