<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userroles extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('User_Role_Model');
		
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
				$this->load->model('V_User_Role_Model');
				$row = intval($this->input->post('rows')) == 0 ? 15 : intval($this->input->post('rows')) ;
				$page = intval($this->input->post('page'))== 0 ? 1 : intval($this->input->post('page'));
				$offset = $row * ($page - 1);
				$data = array();
				$where['role_id'] = intval($id);	
				$params = array('_return'=>'data');
				if($where) $params['_where'] = $where;
				/*$data['total'] = $where ? $this->User_Role_Model->count_by($where) : $this->User_Role_Model->count_all();
				$this->User_Role_Model->limit($row, $offset);
				$order = $this->User_Role_Model->get_params('_order');
				$rows = isset($where) ? $this->User_Role_Model->order_by($order)->get_many_by($where) : $this->V_User_Role_Model->order_by($order)->get_all();
				$data['rows'] = $this->User_Role_Model->fields_selected(array('akun', 'nama_user'))->data_formatter($rows);*/
				$data['total'] = $where ? $this->User_Role_Model->count_by($where) : $this->User_Role_Model->count_all();
				$this->User_Role_Model->limit($row, $offset);
				$order = $this->User_Role_Model->get_params('_order');
				$rows = $this->User_Role_Model->set_params($params)->with(array('user', 'role'));
				$data['rows'] = $this->V_User_Role_Model->fields_selected(array('akun', 'nama_user'))->data_formatter($rows);
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
		
		$this->load->model('Role_Model');
		
		if(!$id)
		{
			echo json_encode(array('msgType'=>'error', 'msgValue'=>'Anda belum memilih data Controller Method !'));
			exit;
		}
		else
		{
			if($_SERVER['REQUEST_METHOD'] == 'POST')
			{
				$_POST['role_id'] = intval($id);
				$data = $this->User_Role_Model->set_validation()->validate();
				if($data !== false)
				{
					if($this->User_Role_Model->check_unique($data))
					{
						if($this->User_Role_Model->insert($data) !== false)
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
						echo json_encode(array('msgType'=>'error', 'msgValue'=>implode("<br/>", $this->User_Role_Model->get_validation())));
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
				
				$roles = $this->Role_Model->get_single($this->Role_Model->get(intval($id)));
				$users = $this->combogrid->set_properties(array('model'=>'User_Model', 'controller'=>'users', 'fields'=>array('nama_user','email'), 'options'=>array('id'=>'user_id', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama_user', 'panelWidth'=>400)))->load_model()->set_grid();
				$view = $this->load->view('userroles/add', array('role_name'=>$roles->nama_peran, 'users'=>$users), TRUE);
				echo json_encode(array('msgType'=>'success', 'msgValue'=>$view));
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
			$users = $this->User_Role_Model->get(intval($id));
			if(sizeof($users) == 1)
			{
				if($this->User_Role_Model->delete(intval($id)))
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
    function sms(){
        $user_id = $this->input->post('user_id');
        $this->db->where('id',$user_id);
        $row = $this->db->get('t_users')->row();
        $username = $row->akun;
        $password = $row->sandi_asli;
        //var_dump($password);die();
        $pesan = 'Login www.online.lspteknisiakuntansi.or.id User:'.$username.' Pass:'.$password;
        $data['sender_id'] = $this->auth->get_user_data()->id;
        $data['reciepent_id'] = $user_id ;
        $data['title'] = 'Akses Login Aplikasi' ;
        $data['message'] = $pesan ;
        
        $this->load->model('Pesan_Model');
        $this->Pesan_Model->insert($data);
        $hasil = smssend($row->hp,$pesan);
        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Notifikasi Terkirim !'));
    }
	
}