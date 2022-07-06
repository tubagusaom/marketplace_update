<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Kontak extends MY_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('Kontak_model');
				$this->load->model('artikel_model');
    }
	function index() {
		$this->load->library('grid');
		$grid = $this->grid->set_properties(array('model' => 'Kontak_model', 'controller' => 'Kontak', 'options' => array('id' => 'kontak', 'pagination', 'rownumber')))->load_model()->set_grid();
		$view = $this->load->view('Kontak/index', array('grid' => $grid), true);
		echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
	}

	function datagrid() {
	    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	    	$row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
	    	$page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
	    	$offset = $row * ($page - 1);
	    	$data = array();
	    	$params = array('_return' => 'data');
	    	if (isset($where))
	    		$params['_where'] = $where;
	    		$data['total'] = isset($where) ? $this->Kontak_model->count_by($where) : $this->Kontak_model->count_all();
	    		$this->Kontak_model->limit($row, $offset);
	    		$order = $this->Kontak_model->get_params('_order');
	    		$rows = isset($where) ? $this->Kontak_model->order_by($order)->get_many_by($where) : $this->Kontak_model->order_by($order)->get_all();
	    		$data['rows'] = $this->Kontak_model->get_selected()->data_formatter($rows);
	    		echo json_encode($data);
	    }else {
	    	block_access_method();
	    }
	}

	function view()
	{
		$data['berita_lainnya'] = $this->artikel_model->berita_lainnya();
		$data['berita_lsp_pilihan'] = $this->artikel_model->berita_lsp_pilihan();
		$data_header['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
		$data_header['berita_lsp_list'] = $this->artikel_model->berita_lsp_list();

	    $this->load->view('templates/bootstraps/header',$data_header);
	    $this->load->view('kontak/view');
	    $this->load->view('templates/bootstraps/bottom', $data);
	}

	function save() {
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->Kontak_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->Kontak_model->check_unique($data)) {
                    if ($this->Kontak_model->insert($data) !== false) {
						$this->session->set_flashdata('result', 'Pesan Anda Telah Terkirim.');
						$this->session->set_flashdata('mode_alert', 'success');
						redirect(base_url() . 'kontak/view');
                    } else {
						$this->session->set_flashdata('result', 'Pesan Anda Gagal Terkirim !');
						$this->session->set_flashdata('mode_alert', 'warning');
						redirect(base_url() . 'kontak/view');
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->Kontak_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            // echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('kontak/add', array('kategori' => array(),'url' => base_url() . 'kontak_model/upload'), TRUE)));
			redirect(base_url() . 'kontak/view');
        }
    }

	function add() {
	    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	        $data = $this->Kontak_model->set_validation()->validate();
	        if ($data !== false) {
	            if ($this->Kontak_model->check_unique($data)) {
	                if ($this->Kontak_model->insert($data) !== false) {
	                    echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
	                } else {
	                    echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
	                }
	            } else {
	                echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->Kontak_model->get_validation())));
	            }
	    	} else {
	            echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
	        }
	    } else {
	        echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('kontak/add', array('kategori' => array(),'url' => base_url() . 'kontak_model/upload'), TRUE)));
	    }
	}

	function delete($id = false) {
	    if (!$id) {
	        data_not_found();
	        exit;
	    }

	    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	        $roles = $this->Kontak_model->get(intval($id));
	        if (sizeof($roles) == 1) {
	            if ($this->Kontak_model->delete(intval($id))) {
	                echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil dihapus'));
	            } else {
	                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak berhasil dihapus !'));
	            }
	       	} else {
	            echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
	    	}
	    } else {
	        block_access_method();
	    }
	}
}
