<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	class Laporan_asesmen extends MY_Controller {


	function __construct()

	{
		parent::__construct();
		$this->load->model('v_laporan_asesmen');
	}
	function index()
		{
			$this->load->library('grid');
			$grid = $this->grid->set_properties(array('model'=>'v_laporan_asesmen', 'controller'=>'laporan_asesmen', 'rownumber', 'options'=>array('id'=>'laporan_asesmen', 'pagination')))->load_model()->set_grid();
			
			$view = $this->load->view('v_laporan_asesmen/index', array('grid'=>$grid), true);
			
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
            if($jenis_user == 3){
                $asesi_id = $this->auth->get_user_data()->pegawai_id;
                $where['id_tuk ='] = $asesi_id;     
            }
			if(isset($_POST['nama_user']) && !empty($_POST['nama_user']))
			{
				$where['nama_user LIKE'] = '%' . $this->input->post('nama_user') . '%';
			}
			if(isset($_POST['akun']) && !empty($_POST['akun']))
			{
				$where['akun LIKE'] = '%' . $this->input->post('akun') . '%';
			}
			if(isset($_POST['jenis_user']) && !empty($_POST['jenis_user']))
			{
				$where['jenis_user ='] = $this->input->post('jenis_user') ;
			}
			$where['id !='] = "";	
			$params = array('_return'=>'data');
			if(isset($where)) $params['_where'] = $where;
			$data['total'] = $where ? $this->v_laporan_asesmen->count_by($where) : $this->v_laporan_asesmen->count_all();
			$this->v_laporan_asesmen->limit($row, $offset);
			$order = $this->v_laporan_asesmen->get_params('_order');
			$rows = $this->v_laporan_asesmen->set_params($params)->with(array());
			$data['rows'] = $this->v_laporan_asesmen->get_selected()->data_formatter($rows);
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
		$view = $this->load->view('v_laporan_asesmen/cetak',$data , true);
		if($type=="pdf") {
			$this->load->library("htm12pdf");
			$this->htm12pdf->pdf_create($view, "laporan_asesmen" . date('YmdHis') . ".pdf", false, true,'L');
		   
		}
	}
}