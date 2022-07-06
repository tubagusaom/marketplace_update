<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pegawai extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('Pegawai_Model');
		
	}
	
	function index()
	{
		if($_SERVER['REQUEST_METHOD'] == 'GET')
			{
			$this->load->library('grid');
			$grid = $this->grid->set_properties(array('model'=>'Pegawai_Model', 'controller'=>'pegawai', 'options'=>array('id'=>'pegawai', 'pagination')))->load_model()->set_grid();
			
			$view = $this->load->view('pegawai/index', array('grid'=>$grid), true);
			
			echo json_encode(array('msgType'=>'success', 'msgValue'=>$view));
		}
		else
		{
			block_access_method();
		}
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
			$data['total'] = isset($where) ? $this->Pegawai_Model->count_by($where) : $this->Pegawai_Model->count_all();
			$this->Pegawai_Model->limit($row, $offset);
			$rows = $this->Pegawai_Model->set_params($params)->with(array('divisi'));
			$data['rows'] = $this->Pegawai_Model->get_selected()->data_formatter($rows);
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
			$data = $this->Pegawai_Model->set_validation()->validate();
			if($data !== false)
			{
				if($this->Pegawai_Model->check_unique($data))
				{
					if($this->Pegawai_Model->insert($data) !== false)
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
					echo json_encode(array('msgType'=>'error', 'msgValue'=>implode("<br/>", $this->Pegawai_Model->get_validation())));
				}
			}
			else
			{
				echo json_encode(array('msgType'=>'error', 'msgValue'=>validation_errors()));
			}
		}
		else
		{
			// $this->load->model('Status_Model');
			// $this->load->model('Bidang_Model');
			// $this->load->library('combogrid');
			// $status = $this->Status_Model->set_params(array('_where'=>array('nama_status <>'=>'THL')))->dropdown('id', 'nama_status');
			// $gol_grid = $this->combogrid->set_properties(array('model'=>'Golongan_Model', 'controller'=>'gols', 'options'=>array('id'=>'gol_id', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama_golongan', 'panelWidth'=>400)))->load_model()->set_grid();
			// $jabatan_grid = $this->combogrid->set_properties(array('model'=>'Jabatan_Model', 'controller'=>'jabatan', 'fields'=>array('nama_jabatan'), 'options'=>array('id'=>'jabatan_id', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama_jabatan', 'panelWidth'=>400)))->load_model()->set_grid();
			// $bidang = $this->Bidang_Model->dropdown('id', 'nama_singkat');
			echo json_encode(array('msgType'=>'success', 'msgValue'=>$this->load->view('pegawai/add',array('status'=>1, 'gol_grid'=>2, 'jabatan_grid'=>1, 'bidang'=>1), TRUE)));
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
			$data = $this->Pegawai_Model->set_validation()->validate();
			if($data !== false)
			{
				if($this->Pegawai_Model->check_unique($data, intval($id)))
				{
					if($this->Pegawai_Model->update(intval($id), $data) !== false)
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
					echo json_encode(array('msgType'=>'error', 'msgValue'=>implode("<br/>", $this->Pegawai_Model->get_validation())));
				}
			}
			else
			{
				echo json_encode(array('msgType'=>'error', 'msgValue'=>validation_errors()));
			}
		}
		else
		{
			$data = $this->Pegawai_Model->get(intval($id));
			if(sizeof($data) == 1)
			{
				$this->load->model('Status_Model');
				$this->load->library('combogrid');
				$this->load->model('Bidang_Model');
				$pegawai = $this->Pegawai_Model->get_single($data);
				$status = $this->Status_Model->dropdown('id', 'nama_status');
				if(!is_null($pegawai->gol_id))
				{
					$gol_grid = $this->combogrid->set_properties(array('model'=>'Golongan_Model', 'value'=>$pegawai->gol_id, 'controller'=>'gols', 'options'=>array('id'=>'gol_id', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama_golongan', 'panelWidth'=>400)))->load_model()->set_grid();
				}
				else
				{
					$gol_grid = $this->combogrid->set_properties(array('model'=>'Golongan_Model', 'controller'=>'gols', 'options'=>array('id'=>'gol_id', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama_golongan', 'panelWidth'=>400)))->load_model()->set_grid();
				}
				if(!is_null($pegawai->jabatan_id))
				{
					$jabatan_grid = $this->combogrid->set_properties(array('model'=>'Jabatan_Model', 'value'=>$pegawai->jabatan_id, 'controller'=>'jabatan', 'fields'=>array('nama_jabatan'), 'options'=>array('id'=>'jabatan_id', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama_jabatan', 'panelWidth'=>400)))->load_model()->set_grid();
				}
				else
				{
					$jabatan_grid = $this->combogrid->set_properties(array('model'=>'Jabatan_Model', 'controller'=>'jabatan', 'fields'=>array('nama_jabatan'), 'options'=>array('id'=>'jabatan_id', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama_jabatan', 'panelWidth'=>400)))->load_model()->set_grid();
				}
				$bidang = $this->Bidang_Model->dropdown('id', 'nama_singkat');
				echo json_encode(array('msgType'=>'success', 'msgValue'=>$this->load->view('pegawai/edit',array('data'=>$pegawai, 'status'=>$status, 'gol_grid'=>$gol_grid, 'jabatan_grid'=>$jabatan_grid, 'bidang'=>$bidang), TRUE)));
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
			$gols = $this->Pegawai_Model->get(intval($id));
			if(sizeof($gols) == 1)
			{
				if($this->Pegawai_Model->delete(intval($id)))
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
	
	function combogrid($id = false)
	{
		$row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows')) ;
		$page = intval($this->input->post('page'))== 0 ? 1 : intval($this->input->post('page'));
		$offset = $row * ($page - 1);
		$data = array();
		$params = array('_return'=>'data');
		if(isset($_POST['q']))
		{
			$where['nama_pegawai LIKE'] = "%" . $this->input->post('q') . "%";
		}
		if(isset($where)) $params['_where'] = $where;
		$data['total'] = isset($where) ? $this->Pegawai_Model->count_by($where) : $this->Pegawai_Model->count_all();
		$this->Pegawai_Model->limit($row, $offset);
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
			$order = $this->Pegawai_Model->get_params('_order');
		}		
		$rows = isset($where) ? $this->Pegawai_Model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->Pegawai_Model->order_by($order, $order_criteria, $_order_escape)->get_all();
		$data['rows'] = $this->Pegawai_Model->fields_selected(array('nip', 'nama_pegawai'))->data_formatter($rows);
		echo json_encode($data);
	}
	
}