<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Withdraw extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('withdraw_model');
		// $this->load->model('member_model');
		// $this->load->model('buyer_model');
	}

	function index() {
			$this->load->library('grid');
			$grid = $this->grid->set_properties(array('model' => 'withdraw_model', 'controller' => 'withdraw', 'options' => array('id' => 'withdraw', 'pagination', 'rownumber')))->load_model()->set_grid();
			$view = $this->load->view('withdraw/index', array('grid' => $grid), true);

			echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
	}

	function datagrid() {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
					$page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
					$offset = $row * ($page - 1);
					$data = array();
					$params = array('_return' => 'data');

					// $where['id_withdraw !='] = '';

					if (isset($where))
							$params['_where'] = $where;
					$data['total'] = isset($where) ? $this->withdraw_model->count_by($where) : $this->withdraw_model->count_all();
					$this->withdraw_model->limit($row, $offset);
					$order = $this->withdraw_model->get_params('_order');
					// $rows = isset($where) ? $this->withdraw_model->order_by($order)->get_many_by($where) : $this->withdraw_model->order_by($order)->get_all();
					$rows = $this->withdraw_model->set_params($params)->with(array('member','buyer'));
					$data['rows'] = $this->withdraw_model->get_selected()->data_formatter($rows);
					echo json_encode($data);
			}
			else {
					block_access_method();
			}
	}

	function edit($id = false) {

		if (!$id) {
				data_not_found();
				exit;
		}

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				// $checked = $this->input->post('pra_asesmen_checked');

				$data = $this->withdraw_model->set_validation()->validate();
				//var_dump($data['id_users']);die();
				// $buktiPendukung = str_replace("|", '"', $data['bukti_pendukung']);
				//$buktiPendukung = json_decode($buktiPendukung);
				//var_dump($buktiPendukung);die();
				if ($data !== false) {
						if ($this->withdraw_model->check_unique($data, intval($id))) {

								if ($this->withdraw_model->update(intval($id), $data) !== false) {
										echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
								} else {
										echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
								}

						} else {
								echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->withdraw_model->get_validation())));
						}
				} else {
						echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
				}
		} else {
				$withdraw = $this->withdraw_model->get(intval($id));
				if (sizeof($withdraw) == 1) {
						$data_aplikasi = $this->db->get('r_konfigurasi_aplikasi')->row();

						$saldo_member = $this->withdraw_model->saldo_member($withdraw->id_member);
						$saldo_wd = $this->withdraw_model->saldo_wd($withdraw->id_member);

						$totalwd = '';
						foreach ($saldo_wd as $key => $value) {
							$totalwd .= $value->total_withdraw;
						}

						// var_dump($saldo_wd); die();

						$view = $this->load->view('withdraw/edit',
							array(
								'data_member'=>$saldo_member,
								'saldo_wd'=>$saldo_wd,
								'data_aplikasi'=>$data_aplikasi,
								'data' => $this->withdraw_model->get_single($withdraw)
							), TRUE);

						echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
				} else {
						echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
				}
		}

	}

}
