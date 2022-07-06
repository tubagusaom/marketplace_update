<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Roles extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('Role_Model');

	}

	function index()
	{
		$this->load->library('grid');

		$role_grid = $this->grid->set_properties(array('model'=>'Role_Model', 'controller'=>'roles', 'options'=>array('id'=>'roles', 'pagination', 'rownumber', 'target'=>array('id'=>'user_roles', 'controller'=>'userroles'))))->load_model()->set_grid();
		$user_grid = $this->grid->set_properties(array('model'=>'V_User_Role_Model', 'controller'=>'userroles', 'fields'=>array('akun', 'nama_user'), 'options'=>array('child', 'id'=>'user_roles', 'pagination', 'rownumber')))->load_model()->set_grid();

		$view = $this->load->view('roles/index', array('role_grid'=>$role_grid, 'user_grid'=>$user_grid), true);

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
			$where['id >'] = 2;
			$params = array('_return'=>'data');
			if(isset($where)) $params['_where'] = $where;
			$data['total'] = isset($where) ? $this->Role_Model->count_by($where) : $this->Role_Model->count_all();
			$this->Role_Model->limit($row, $offset);
			$order = $this->Role_Model->get_params('_order');
			$rows = isset($where) ? $this->Role_Model->order_by($order)->get_many_by($where) : $this->Role_Model->order_by($order)->get_all();
			$data['rows'] = $this->Role_Model->get_selected()->data_formatter($rows);
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
			$data = $this->Role_Model->set_validation()->validate();
			if($data !== false)
			{
				if($this->Role_Model->check_unique($data))
				{
					if($this->Role_Model->insert($data) !== false)
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
					echo json_encode(array('msgType'=>'error', 'msgValue'=>implode("<br/>", $this->Role_Model->get_validation())));
				}
			}
			else
			{
				echo json_encode(array('msgType'=>'error', 'msgValue'=>validation_errors()));
			}
		}
		else
		{
			echo json_encode(array('msgType'=>'success', 'msgValue'=>$this->load->view('roles/add','', TRUE)));
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
			$data = $this->Role_Model->set_validation()->validate();
			if($data !== false)
			{
				if($this->Role_Model->check_unique($data, intval($id)))
				{
					if($this->Role_Model->update(intval($id), $data) !== false)
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
					echo json_encode(array('msgType'=>'error', 'msgValue'=>implode("<br/>", $this->Role_Model->get_validation())));
				}
			}
			else
			{
				echo json_encode(array('msgType'=>'error', 'msgValue'=>validation_errors()));
			}
		}
		else
		{
			$roles = $this->Role_Model->get(intval($id));
			if(sizeof($roles) == 1)
			{
				$view = $this->load->view('roles/edit', array('data'=>$this->Role_Model->get_single($roles)), TRUE);
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
			$roles = $this->Role_Model->get(intval($id));
			if(sizeof($roles) == 1)
			{
				if($this->Role_Model->delete(intval($id)))
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
