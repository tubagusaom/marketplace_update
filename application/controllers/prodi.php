<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Prodi extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('prodi_model');
	}

	function index() {
			if ($_SERVER['REQUEST_METHOD'] == 'GET') {
					$this->load->library('grid');
					$grid = $this->grid->set_properties(array('model' => 'prodi_model', 'controller' => 'prodi', 'options' => array('id' => 'prodi', 'pagination', 'rownumber')))->load_model()->set_grid();
					$view = $this->load->view('prodi/index', array('grid' => $grid), true);
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
					$data['total'] = isset($where) ? $this->prodi_model->count_by($where) : $this->prodi_model->count_all();

					$this->prodi_model->limit($row, $offset);
					$order = $this->prodi_model->get_params('_order');
					$rows = $this->prodi_model->set_params($params)->with(array('tuk'));
					$data['rows'] = $this->prodi_model->get_selected()->data_formatter($rows);
					echo json_encode($data);
			} else {
					block_access_method();
			}
	}

	function add() {
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$data = $this->prodi_model->set_validation()->validate();
				if ($data !== false) {
						if ($this->prodi_model->check_unique($data)) {

								if ($this->prodi_model->insert($data) !== false) {
										echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
								} else {
										echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
								}
						} else {
								echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->prodi_model->get_validation())));
						}
				} else {
						echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
				}
		} else {
				$this->load->library('combogrid');
				$tuk_grid = $this->combogrid->set_properties(array('model' => 'tuk_model', 'controller' => 'tuk', 'fields' => array('no_cab', 'tuk', 'alamat'), 'options' => array('id' => 'id_tuk', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'tuk', 'panelWidth' => 500)))->load_model()->set_grid();
				echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('prodi/add', array('id_tuk' => $tuk_grid), TRUE)));
		}
	}

	function edit($id = false) {
			if (!$id) {
					data_not_found();
					exit;
			}
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$data = $this->prodi_model->set_validation()->validate();
					if ($data !== false) {
							if ($this->prodi_model->check_unique($data, intval($id))) {

									if ($this->prodi_model->update(intval($id), $data) !== false) {
											echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
									} else {
											echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
									}
							} else {
									echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->prodi_model->get_validation())));
							}
					} else {
							echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
					}
			} else {
					$con_method = $this->prodi_model->get(intval($id));
					if (sizeof($con_method) == 1) {
							$this->load->library('combogrid');
							$tuk_grid = $this->combogrid->set_properties(array('model' => 'tuk_model', 'controller' => 'tuk', 'fields' => array('tuk', 'alamat'), 'options' => array('id' => 'id_tuk', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'tuk', 'panelWidth' => 500)))->load_model()->set_grid();

							$data = $this->prodi_model->get_single($con_method);
							$view = $this->load->view('prodi/edit',
							array('id_tuk' => $tuk_grid,'id_tuk' => $tuk_grid, 'data' => $data), TRUE);
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
	        $roles = $this->prodi_model->get(intval($id));
	        if (sizeof($roles) == 1) {
	            if ($this->prodi_model->delete(intval($id))) {
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
