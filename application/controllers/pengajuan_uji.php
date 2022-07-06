<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pengajuan_uji extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('pengajuan_uji_model');
		// $this->load->model('mahasiswa_model');
	}

	function index() {
			if ($_SERVER['REQUEST_METHOD'] == 'GET') {
					$this->load->library('grid');
					$grid = $this->grid->set_properties(array('model' => 'pengajuan_uji_model', 'controller' => 'pengajuan_uji', 'options' => array('id' => 'pengajuan_uji', 'pagination', 'rownumber')))->load_model()->set_grid();
					$view = $this->load->view('pengajuan_uji/index', array('grid' => $grid), true);
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
					$data['total'] = isset($where) ? $this->pengajuan_uji_model->count_by($where) : $this->pengajuan_uji_model->count_all();

					$this->pengajuan_uji_model->limit($row, $offset);
					$order = $this->pengajuan_uji_model->get_params('_order');
					$rows = $this->pengajuan_uji_model->set_params($params)->with(array('nama_calon'));
					$data['rows'] = $this->pengajuan_uji_model->get_selected()->data_formatter($rows);
					echo json_encode($data);
			} else {
					block_access_method();
			}
	}

	function add() {
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$data = $this->pengajuan_uji_model->set_validation()->validate();
				if ($data !== false) {
						if ($this->pengajuan_uji_model->check_unique($data)) {
								// $id_tuk = $this->input->post('id_tuk');
								// $jenis_user = $this->auth->get_user_data()->jenis_user;
								//
								// if ($jenis_user == 3) {
								// 		$data['id_tuk'] = $this->auth->get_user_data()->pegawai_id;
								// } else {
								// 		$data['id_tuk'] = $id_tuk;
								// }
								// $id_tuk = $this->input->post('id_tuk');
								// $id_skema = $this->input->post('id_skema');
								// $tanggal = $this->input->post('tanggal');
								//
								// $data['jadual'] = $this->nama_jadwal($id_tuk, $id_skema, $tanggal);

								//var_dump($data['jadual']);die();
								if ($this->pengajuan_uji_model->insert($data) !== false) {
										echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
								} else {
										echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
								}
						} else {
								echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->pengajuan_uji_model->get_validation())));
						}
				} else {
						echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
				}
		} else {
			  $this->load->model('prodi_model');
				$prodi = $this->prodi_model->dropdown('id', 'program_studi');

				$this->load->library('combogrid');
				$mhs_grid = $this->combogrid->set_properties(array('model' => 'mahasiswa_model', 'controller' => 'mahasiswa', 'fields' => array('nim_calon', 'nama_calon', 'semester_calon'), 'options' => array('id' => 'id_mhs', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'nama_calon', 'panelWidth' => 500)))->load_model()->set_grid();
				echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('pengajuan_uji/add', array('id_mhs' => $mhs_grid, 'prodi' => $prodi), TRUE)));
		}
	}

	function edit($id = false) {
			if (!$id) {
					data_not_found();
					exit;
			}
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$data = $this->pengajuan_uji_model->set_validation()->validate();
					if ($data !== false) {
							if ($this->pengajuan_uji_model->check_unique($data, intval($id))) {

									// $id_tuk = $this->input->post('id_tuk');
									// $jenis_user = $this->auth->get_user_data()->jenis_user;

									// if ($jenis_user == 3) {
									// 		$data['id_tuk'] = $this->auth->get_user_data()->pegawai_id;
									// } else {
									// 		$data['id_tuk'] = $id_tuk;
									// }
									// $id_tuk = $this->input->post('id_tuk');
									// $id_skema = $this->input->post('id_skema');
									// $tanggal = $this->input->post('tanggal');
									//
									// $data['jadual'] = $this->nama_jadwal($id_tuk, $id_skema, $tanggal);
									//var_dump($id_skema); die();

									if ($this->pengajuan_uji_model->update(intval($id), $data) !== false) {
											echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
									} else {
											echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
									}
							} else {
									echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->pengajuan_uji_model->get_validation())));
							}
					} else {
							echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
					}
			} else {
					$con_method = $this->pengajuan_uji_model->get(intval($id));
					if (sizeof($con_method) == 1) {
							$this->load->library('combogrid');
							// $tuk_grid = $this->combogrid->set_properties(array('model' => 'tuk_model', 'controller' => 'tuk', 'fields' => array('tuk', 'alamat'), 'options' => array('id' => 'id_tuk', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'tuk', 'panelWidth' => 500)))->load_model()->set_grid();
							$mhs_grid = $this->combogrid->set_properties(array('model' => 'mahasiswa_model', 'controller' => 'mahasiswa', 'fields' => array('nim_calon', 'nama_calon', 'semester_calon'), 'options' => array('id' => 'id_mhs', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'nama_calon', 'panelWidth' => 500)))->load_model()->set_grid();
							// $this->db->where('id_mhs',$id);

							$data = $this->pengajuan_uji_model->get_single($con_method);
							$view = $this->load->view('pengajuan_uji/edit',
							array('id_tuk' => $tuk_grid,'id_mhs' => $mhs_grid, 'data' => $data, 'stts_pengajuan' => array('-','Disetujui','Ditolak')), TRUE);
							echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
					} else {
							echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
					}
			}
	}

	function delete() {

	}

}
