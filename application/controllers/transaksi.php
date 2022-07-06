<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaksi extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('transaksi_model');
		// $this->load->model('member_model');
		// $this->load->model('buyer_model');
	}

	function index() {
			$this->load->library('grid');
			$grid = $this->grid->set_properties(array('model' => 'transaksi_model', 'controller' => 'transaksi', 'options' => array('id' => 'transaksi', 'pagination', 'rownumber')))->load_model()->set_grid();
			$view = $this->load->view('transaksi/index', array('grid' => $grid), true);

			echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
	}

	function datagrid() {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
					$page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
					$offset = $row * ($page - 1);
					$data = array();
					$params = array('_return' => 'data');

					// $where['id_transaksi !='] = '';
					$where['stts_keranjang'] = '3';

					if (isset($where))
							$params['_where'] = $where;
					$data['total'] = isset($where) ? $this->transaksi_model->count_by($where) : $this->transaksi_model->count_all();
					$this->transaksi_model->limit($row, $offset);
					$order = $this->transaksi_model->get_params('_order');
					// $rows = isset($where) ? $this->transaksi_model->order_by($order)->get_many_by($where) : $this->transaksi_model->order_by($order)->get_all();
					$rows = $this->transaksi_model->set_params($params)->with(array('member','nm_buyer'));
					$data['rows'] = $this->transaksi_model->get_selected()->data_formatter($rows);
					echo json_encode($data);
			} else {
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

				// var_dump($id); die();

				$data = $this->transaksi_model->set_validation()->validate();

				if ($data !== false) {
						if ($this->transaksi_model->check_unique($data, intval($id))) {
								$saldo = $this->input->post('saldo_akhir');
								$idm = $this->input->post('idm');
								$acuan_stts = $this->input->post('acuan_stts');

								// var_dump($stts_pajak); die();
								$this->db->where('id_member', $idm);
								$row_saldo = $this->db->get(kode_tbl() . 'saldo_member')->row();

								$t_saldo = $row_saldo->total_saldo+$saldo;
								// var_dump($t_saldo); die();

								if ($this->transaksi_model->update(intval($id), $data) !== false) {

										if ($acuan_stts == '0') {

											// $this->db->where('id_member', $id);
			                // $row_saldo = $this->db->get(kode_tbl() . 'saldo_member')->row();
											date_default_timezone_set("Asia/jakarta");

											// update keranjang
						          $data_update_saldo = array(
						              'stts_saldo' => '1',
													'total_saldo' => $t_saldo,
						              'updated_by' => $this->id,
						              'updated_when' => date("Y-m-d H:i:s"),
						          );
						          $this->db->where_in('id_member', $idm);
						          $this->db->update(kode_tbl().'saldo_member', $data_update_saldo);

										}



										echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
								} else {
										echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
								}
						} else {
								echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->transaksi_model->get_validation())));
						}
				} else {
						echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
				}
		} else {
				$transaksi = $this->transaksi_model->get(intval($id));
				if (sizeof($transaksi) == 1) {
						$data_aplikasi = $this->db->get('r_konfigurasi_aplikasi')->row();

						$data_buyer 	= $this->transaksi_model->data_buyer($transaksi->id_buyer);
						$data_member = $this->transaksi_model->data_member($transaksi->id_member);
						$data_transaksi = $this->transaksi_model->data_transaksi($transaksi->id_transaksi);
						$data_kurir = $this->transaksi_model->data_kurir($transaksi->id);

						// $data_saldo = $this->transaksi_model->data_saldo($transaksi->id);

						// var_dump($data_member); die();

						// $this->load->library('combogrid');
						// $users = $this->combogrid->set_properties(array('model'=>'Vasesi_Users_Model', 'controller'=>'combo_pra_asesmen', 'fields'=>array('nama_user','email','jenis_user'), 'options'=>array('id'=>'pra_asesmen_checked', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama_user', 'panelWidth'=>500,
						// 		'queryParams'=>array('name'=>'easui')
						// 		)))->load_model()->set_grid();
						// $skema = $this->combogrid->set_properties(array('value'=>$transaksi->skema_sertifikasi,'model'=>'skema_model', 'controller'=>'skema', 'fields'=>array('skema'), 'options'=>array('id'=>'skema_sertifikasi', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'skema', 'panelWidth'=>500,
						// 		'queryParams'=>array('name'=>'easui')
						// 		)))->load_model()->set_grid();

						// $this->load->model('tuk_model');
						// //var_dump($transaksi->pra_asesmen_checked);
						// if($transaksi->pra_asesmen_checked == "0" || empty($transaksi->pra_asesmen_checked)){
						// 		$nama_asesor = '';
						// }else{
						// 		$asesor = $this->User_Model->get($transaksi->pra_asesmen_checked);
						// 		$nama_asesor = $asesor->nama_user;
						// }
						//  $tuk = $this->tuk_model->dropdown('id', 'tuk');
						//  //var_dump($tuk);die();
						//  $transaksi->bukti_pendukung =str_replace('"', '|', $transaksi->bukti_pendukung);
						//  //var_dump($transaksi->bukti_pendukung);die();
						//  $this->load->model('skema_model');
						//$skema = $this->skema_model->dropdown('id', 'skema');

						//$user_id = $this->auth->get_user_data()->id;
					 // $id_asesi = $this->id_asesi($id);
						// $this->db->where('pegawai_id',$id);
						// $this->db->where('jenis_user','1');
						// $row = $this->db->get('t_users')->row();
						// if(count($row) > 0){
						//     $files_asesi = $this->transaksi_model->files_asesi($row->id);
						// }else{
						//     $files_asesi = array();
						// }

						// $this->load->model('transaksi_model');
						//
						// $this->db->select('b.id');
						// $this->db->from(kode_tbl().'asesi a');
						// $this->db->join('t_users b','a.id_users=b.pegawai_id');
						// $this->db->where('a.id',$id);
						// $row = $this->db->get()->row();
						// var_dump($row->id);

						// $files_asesi = $this->transaksi_model->files_asesi($row->id);
						//
						// $this->load->model('pra_asesmen_model');
						// $jadwal = $this->pra_asesmen_model->jadwal($transaksi->jadwal_id);

						//var_dump($foto);die();

						$view = $this->load->view('transaksi/edit',
							array(
								'data_member'=>$data_member,
								'data_buyer'=>$data_buyer,
								'data_transaksi'=>$data_transaksi,
								'data_kurir'=>$data_kurir,
								// 'skema_grid' => $skema,
								// 'files_asesi'=>$files_asesi,
								'data_aplikasi'=>$data_aplikasi,
								// 'skema'=>$skema,
								'data' => $this->transaksi_model->get_single($transaksi),
								// 'pra_asesmen_grid' => $users,
								// 'tuk'=>$tuk,
								'pra_asesmen' => array('-Pilih-', 'Lanjut', 'Tidak Lanjut'),
								'jenis_kelamin'=>array('-Pilih-','Pria','Wanita')
							), TRUE);

						echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
				} else {
						echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
				}
		}

	}

}
