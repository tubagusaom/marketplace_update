<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Galeri_video extends MY_Controller {

	function __construct() {
			parent::__construct();
			$this->load->model('video_model');
			$this->load->model('artikel_model');
			// $data['video']= $this->video_model->get_video();
	}


    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'video_model', 'controller' => 'galeri_video', 'options' => array('id' => 'galeri_video','pagination','rownumber')))->load_model()->set_grid();
            $view = $this->load->view('video/index', array('grid' => $grid), true);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        } else {
            block_access_method();
        }
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
            $data['total'] = isset($where) ? $this->video_model->count_by($where) : $this->video_model->count_all();
            $this->video_model->limit($row, $offset);
            $rows = $this->video_model->set_params($params)->with(array(''));
            $data['rows'] = $this->video_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else {
            block_access_method();
        }
    }

		function add() {
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
              $data = $this->video_model->set_validation()->validate();
              if ($data !== false) {
                  if ($this->video_model->check_unique($data)) {
                      if ($this->video_model->insert($data) !== false) {
                          echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                      } else {
                          echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                      }
                  } else {
                      echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->video_model->get_validation())));
                  }
              } else {
                  echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
              }
          } else {
              echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('video/add', array('kategori' => array(),'url' => base_url() . 'video_model/upload'), TRUE)));
          }
      }

			function edit($id = false) {
	        if (!$id) {
	            data_not_found();
	            exit;
	        }
	        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	            $data = $this->video_model->set_validation()->validate();
	            if ($data !== false) {
	                if ($this->video_model->check_unique($data, intval($id))) {
	                    if ($this->video_model->update(intval($id), $data) !== false) {
	                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
	                    } else {
	                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
	                    }
	                } else {
	                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->video_model->get_validation())));
	                }
	            } else {
	                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
	            }
	        } else {
	            $con_method = $this->video_model->get(intval($id));
	            if (sizeof($con_method) == 1) {
	                $this->load->model('Controller_Model');
	                $this->load->model('Method_Model');
	                $controllers = $this->Controller_Model->dropdown('id', 'controller_name');
	                $methods = $this->Method_Model->dropdown('id', 'method_name');
	                $view = $this->load->view('video/edit', array('controller' => $controllers, 'method' => $methods, 'data' => $this->video_model->get_single($con_method)), TRUE);
	                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
	            } else {
	                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
	            }
	        }
	    }

			function delete($id = false) {

        if (!$id) {

            data_not_found();

            exit;

        }


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $roles = $this->video_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->video_model->delete(intval($id))) {
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

	public function view(){
			$data['video'] = $this->video_model->get_video();
			$data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
			$data['berita_lainnya'] = $this->artikel_model->berita_lsp_list();

			$this->load->view('templates/bootstraps/header', $data);
			$this->load->view('video/v_video');
			$this->load->view('templates/bootstraps/bottom');
	}
}
