<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	class Bantuan extends MY_Controller {

		function __construct()
		{
			parent::__construct();
			$this->load->model('Dokumentasi_Model');
            $this->load->model('repositori_model');
		}
        
        function index() {            
            $this->load->library('grid');
		    //$dokumentasi_grid = $this->grid->set_properties(array('model'=>'Dokumentasi_Model', 'controller'=>'bantuan', 'options'=>array('id'=>'dokumentasi_grid', 'pagination', 'rownumber')))->load_model()->set_grid();
		
		    $view = $this->load->view('bantuan/dokumentasi', array(), true);
		
		    echo json_encode(array('msgType'=>'success', 'msgValue'=>$view));
        }
		
		function datagrid() {
		    if($_SERVER['REQUEST_METHOD'] == 'POST')
			{
				$row = intval($this->input->post('rows')) == 0 ? 15 : intval($this->input->post('rows')) ;
				$page = intval($this->input->post('page'))== 0 ? 1 : intval($this->input->post('page'));
				$offset = $row * ($page - 1);
				$data = array();
				$params = array('_return'=>'data');
				if(isset($where)) $params['_where'] = $where;
				$data['total'] = isset($where) ? $this->Dokumentasi_Model->count_by($where) : $this->Dokumentasi_Model->count_all();
				$this->Dokumentasi_Model->limit($row, $offset);
				$order = $this->Dokumentasi_Model->get_params('_order');
				$rows = isset($where) ? $this->Dokumentasi_Model->order_by($order)->get_many_by($where) : $this->Dokumentasi_Model->order_by($order)->get_all();
				$data['rows'] = $this->Dokumentasi_Model->get_selected()->data_formatter($rows);
				echo json_encode($data);
			}
			else
			{
				block_access_method();
			}
		}
		
		function add()
		{
			if($_SERVER['REQUEST_METHOD'] == 'GET')
			{
				echo json_encode(array('msgType'=>'success', 'msgValue'=>$this->load->view('bantuan/add','', TRUE)));
			}
			else
			{
				block_access_method();
			}
		}
		
		function upload() 
		{
  //var_dump('OK');die();
		    if($_SERVER['REQUEST_METHOD'] == 'POST')
			{
				$data['nama_file'] = str_replace(' ', '_', $_FILES['fileToUpload']['name']);
				if($this->repositori_model->check_unique($data)) {
					$config['upload_path'] = substr(__dir__,0, strpos( __dir__,"application")) . 'assets/files';
					$config['allowed_types'] = 'xlsx|xls|csv|doc|pdf';
					$config['max_size'] = '10240';

					$this->load->library('upload', $config);
					
					if ( ! $this->upload->do_upload('fileToUpload'))
					{
						echo json_encode(array('msgType'=>'error','msgValue'=>$this->upload->display_errors()));
					}
					else
					{
						$uploaded = $this->upload->data();
						$data['nama_file'] = $uploaded['file_name'];
						if($this->repositori_model->insert($data) !== false) {
						    echo json_encode(array('msgType'=>'success','msgValue'=>"Data berhasil diupload"));
						}						
					}
				} else {
					echo json_encode(array('msgType'=>'error', 'msgValue'=>'Dokumen sudah ada !'));
				}
			}
			else
			{
				block_access_method();
			}
		}
		
		function delete($id = false) {
		    if(!$id){
				data_not_found();
				exit;
			}
			if($_SERVER['REQUEST_METHOD'] == 'POST')
			{
				$dokumen = $this->Dokumentasi_Model->get(intval($id));
				if(sizeof($dokumen) == 1)
				{
					if($this->Dokumentasi_Model->delete(intval($id)))
					{
						unlink(substr(__dir__,0, strpos( __dir__,"application")) . 'assets/files/' . $dokumen->nama_file);
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
		function kontak() {
	        $this->load->model('knowledge_base_categories_model');

	        $konfigurasi = $this->db->get('r_konfigurasi_aplikasi')->row();

	        $template_header = 'templates/responsive/header';
	        $template_body = 'kontak/view';
	        $template_bottom = 'templates/responsive/footer';

	        $this->load->view($template_header, array('aplikasi' => $this->aplikasi, 'query_pesan' => $this->query_pesan, 'query_pesan_unread' => $this->query_pesan_unread));
	        $this->load->view($template_body, array('aplikasi' => $this->aplikasi, 'unread_message' => $this->unread_message, 'menus' => $this->menus, 'rolename' => $this->auth->get_rolename(), 'nama_user' => $this->auth->get_user_data()->nama, "konfigurasi" => $konfigurasi));
	        $this->load->view($template_bottom, array('aplikasi' => $this->aplikasi));
	    }
	    function kontak_back() {
	        $this->load->model('knowledge_base_categories_model');

	        $konfigurasi = $this->db->get('r_konfigurasi_aplikasi')->row();

	        $template_header = 'templates/responsive/header';
	        $template_body = 'kontak/view_front';
	        $template_bottom = 'templates/responsive/footer';

	        $this->load->view($template_header, array('aplikasi' => $this->aplikasi, 'query_pesan' => $this->query_pesan, 'query_pesan_unread' => $this->query_pesan_unread));
	        $this->load->view($template_body, array('aplikasi' => $this->aplikasi, 'unread_message' => $this->unread_message, 'menus' => $this->menus, 'rolename' => $this->auth->get_rolename(), 'nama_user' => $this->auth->get_user_data()->nama, "konfigurasi" => $konfigurasi));
	        $this->load->view($template_bottom, array('aplikasi' => $this->aplikasi));
	    }
	}