<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


							class Guru extends MY_Controller {


								function __construct()

								{
									parent::__construct();

								}
								
								function combogrid($id = false)
	{		
		$this->load->model('Guru_Model');
		$row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows')) ;
		$page = intval($this->input->post('page'))== 0 ? 1 : intval($this->input->post('page'));
		$offset = $row * ($page - 1);
		$data = array();
		$params = array('_return'=>'data');
		if(isset($_POST['q']))
		{
			$where['nama_guru LIKE'] = "%" . $this->input->post('q') . "%";
		}
		if(isset($where)) $params['_where'] = $where;
		$data['total'] = isset($where) ? $this->Guru_Model->count_by($where) : $this->Guru_Model->count_all();
		$this->Guru_Model->limit($row, $offset);
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
			$order = $this->Guru_Model->get_params('_order');
		}		
		$rows = isset($where) ? $this->Guru_Model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->Guru_Model->order_by($order, $order_criteria, $_order_escape)->get_all();
		$data['rows'] = $this->Guru_Model->get_selected()->data_formatter($rows);
		echo json_encode($data); 
	} 
							}    