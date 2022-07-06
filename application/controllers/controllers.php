<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controllers extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('Controller_Model');
		
	}
	
	function index()
	{
		$this->load->library('grid');
		$grid = $this->grid->set_properties(array('model'=>'Controller_Model', 'controller'=>'controllers', 'options'=>array('id'=>'controllers', 'pagination', 'rownumber')))->load_model()->set_grid();
		
		$view = $this->load->view('controllers/index', array('grid'=>$grid), true);
		
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
			if(isset($_POST['nama_controller']) && !empty($_POST['nama_controller']))
			{
				$where['controller_name LIKE'] = '%' . $this->input->post('nama_controller') . '%';
			}
			if(isset($where)) $params['_where'] = $where;
			$data['total'] = isset($where) ? $this->Controller_Model->count_by($where) : $this->Controller_Model->count_all();
			$this->Controller_Model->limit($row, $offset);
			$order = $this->Controller_Model->get_params('_order');
			$rows = isset($where) ? $this->Controller_Model->order_by($order)->get_many_by($where) : $this->Controller_Model->order_by($order)->get_all();
			$data['rows'] = $this->Controller_Model->get_selected()->data_formatter($rows);
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
			$data = $this->Controller_Model->set_validation()->validate();
			if($data !== false)
			{
				if($this->Controller_Model->check_unique($data))
				{
					if($this->Controller_Model->insert($data) !== false)
					{
						$controller = fopen(dirname(__FILE__) . "/" . $data['controller_name'] . ".php", "w");
						
						$txt = "<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');\n

							class " . ucwords($data['controller_name']) . " extends MY_Controller {\n

								function __construct()\n
								{
									parent::__construct();\n
								}
							}";
						fwrite($controller, $txt);
						fclose($controller);
						
						echo json_encode(array('msgType'=>'success', 'msgValue'=>'Data berhasil disimpan !'));
					}
					else
					{
						echo json_encode(array('msgType'=>'error', 'msgValue'=>'Data tidak dapat disimpan !'));
					}
				}
				else
				{
					echo json_encode(array('msgType'=>'error', 'msgValue'=>implode("<br/>", $this->Controller_Model->get_validation())));
				}
			}
			else
			{
				echo json_encode(array('msgType'=>'error', 'msgValue'=>validation_errors()));
			}
		}
		else
		{
			echo json_encode(array('msgType'=>'success', 'msgValue'=>$this->load->view('controllers/add','', TRUE)));
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
			$data = $this->Controller_Model->set_validation()->validate();
			if($data !== false)
			{
				if($this->Controller_Model->check_unique($data, intval($id)))
				{
					if($this->Controller_Model->update(intval($id), $data) !== false)
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
					echo json_encode(array('msgType'=>'error', 'msgValue'=>implode("<br/>", $this->Controller_Model->get_validation())));
				}
			}
			else
			{
				echo json_encode(array('msgType'=>'error', 'msgValue'=>validation_errors()));
			}
		}
		else
		{
			$controller = $this->Controller_Model->get(intval($id));
			if(sizeof($controller) == 1)
			{
				$view = $this->load->view('controllers/edit', array('data'=>$this->Controller_Model->get_single($controller)), TRUE);
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
			$method = $this->Controller_Model->get(intval($id));
			if(sizeof($method) == 1)
			{
				if($this->Controller_Model->delete(intval($id)))
				{
					$this->load->model('Controller_Method_Model');
					$this->Controller_Method_Model->delete_by(array('controller_id'=>intval($id)));
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