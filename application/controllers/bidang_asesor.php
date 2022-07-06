<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	class Bidang_asesor extends MY_Controller {


	function __construct()

	{
		parent::__construct();
		$this->load->model('vbidang_asesor');
	}
	function index()
		{
			$this->load->library('grid');
			$grid = $this->grid->set_properties(array('model'=>'vbidang_asesor', 'controller'=>'bidang_asesor', 'rownumber', 'options'=>array('id'=>'bidang_asesor', 'pagination')))->load_model()->set_grid();
			
			$view = $this->load->view('v_laporan_asesmen/vbidang_asesor', array('grid'=>$grid), true);
			
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
			$jenis_user = $this->auth->get_user_data()->jenis_user;
            
			$where['id !='] = "";	
			$params = array('_return'=>'data');
			if(isset($where)) $params['_where'] = $where;
			$data['total'] = $where ? $this->vbidang_asesor->count_by($where) : $this->vbidang_asesor->count_all();
			$this->vbidang_asesor->limit($row, $offset);
			$order = $this->vbidang_asesor->get_params('_order');
			$rows = $this->vbidang_asesor->set_params($params)->with(array());
			$data['rows'] = $this->vbidang_asesor->get_selected()->data_formatter($rows);
			echo json_encode($data);
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
			$jenis_users = array(0=>'-', 1=>'Pemegang Sertifikat', 2=>'Asesor', 3=>'TUK', 4=>'Administrator');
				
			echo json_encode(array('msgType'=>'success', 'msgValue'=>$this->load->view('users/search',array('jenis_user'=>$jenis_users), TRUE)));
		}
		else
		{
			block_access_method();
		}
	}
	 function cetak($id,$type = "pdf") {
		$data['konfigurasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
        $this->db->where('id',$id);
        $data['jadwal'] = $this->db->get(kode_tbl().'jadual_asesmen')->row();
        $this->load->model('jadwal_asesmen_model');
        $data['daftar_hadir'] = $this->jadwal_asesmen_model->daftar_hadir($id);
        $data['asesor'] = $this->jadwal_asesmen_model->get_asesor($id);
       //var_dump($data['daftar_hadir']);die();
		$view = $this->load->view('vbidang_asesor/cetak',$data , true);
		if($type=="pdf") {
			$this->load->library("htm12pdf");
			$this->htm12pdf->pdf_create($view, "bidang_asesor" . date('YmdHis') . ".pdf", false, true,'L');
		   
		}
	}
}