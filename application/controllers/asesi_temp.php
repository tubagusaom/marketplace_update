<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Asesi_temp extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('asesi_temp_model');
          $this->load->model('User_Model');
    }

    function index() {
			if ($_SERVER['REQUEST_METHOD'] == 'GET') {
					$this->load->library('grid');
					$grid = $this->grid->set_properties(array('model' => 'asesi_temp_model', 'controller' => 'asesi_temp', 'options' => array('id' => 'asesi_temp', 'pagination', 'rownumber')))->load_model()->set_grid();
					$view = $this->load->view('asesi_temp/index', array('grid' => $grid), true);
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
					$data['total'] = isset($where) ? $this->asesi_temp_model->count_by($where) : $this->asesi_temp_model->count_all();
					$this->asesi_temp_model->limit($row, $offset);
					$order = $this->asesi_temp_model->get_params('_order');
					//$rows = isset($where) ? $this->import_elemen_model->order_by($order)->get_many_by($where) : $this->import_elemen_model->order_by($order)->get_all();
					$rows = $this->asesi_temp_model->set_params($params)->with(array('tuk','skema','user'));
					$data['rows'] = $this->asesi_temp_model->get_selected()->data_formatter($rows);
					echo json_encode($data);
			} else {
					block_access_method();
			}
	}

	function add(){
			if($_SERVER['REQUEST_METHOD'] == 'GET'){
					echo json_encode(array('msgType'=>'success', 'msgValue'=>$this->load->view('asesi_temp/add','', TRUE)));
			}else{
					block_access_method();
			}
	}

	function upload(){
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
					$calon_asesi_temp = kode_tbl().'calon_asesi_temp';
					$config['upload_path'] = substr(__dir__,0, strpos( __dir__,"application")) . 'assets/files/excels';
					$config['allowed_types'] = 'xlsx|xls|csv';
					$config['max_size'] = '1024';

					$this->load->library('upload', $config);

					if ( ! $this->upload->do_upload('fileToUpload')){
							echo json_encode(array('msgType'=>'error','msgValue'=>$this->upload->display_errors()));
					}else{
							$uploaded = $this->upload->data();
							$files = substr(__dir__,0, strpos( __dir__,"application")) . 'assets/files/excels/' . $uploaded['file_name'];
							$this->load->library('excel');
							$objReader = $this->load->library('PHPExcel/Reader/PHPExcel_Reader_Excel5', $files);
							$objReader = new PHPExcel_Reader_Excel5();
							$objReader->setReadDataOnly(true);
							$objPHPExcel = $objReader->load($files);
							$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
							$this->db->query("TRUNCATE TABLE $calon_asesi_temp");
							for($x=2; $x <= sizeof($sheetData); $x++){
											$data = array();
											$data['nim_asesi'] = $sheetData[$x]['A'];
											$data['tahun_akademik_asesi'] = $sheetData[$x]['B'];
											$data['nama_asesi'] = $sheetData[$x]['C'];
											$data['program_studi_asesi'] = $sheetData[$x]['D'];
											$data['kelas_asesi'] = $sheetData[$x]['E'];
											$data['semester_asesi'] = $sheetData[$x]['F'];
											$data['hp_asesi'] = $sheetData[$x]['G'];
											$data['email_asesi'] = $sheetData[$x]['H'];

											//var_dump($data);die();
											$this->db->insert($calon_asesi_temp,$data);

							}echo json_encode(array('msgType'=>'success','msgValue'=>"Data sukses diimport"));
					}
			}
			else{
					block_access_method();
			}
	}

	function posting(){
			echo json_encode(array('msgType'=>'success','msgValue'=>"Data sukses diposting"));
	}


	function proses(){
			$calon_asesi_temp = kode_tbl().'calon_asesi_temp';
			$calon_asesi = kode_tbl().'calon_asesi';
			$data = $this->db->get($calon_asesi_temp)->result();

      // var_dump($data); die();

			foreach ($data as $key => $value) {
				$nim = $value->nim_asesi;
				$tahun = $value->tahun_akademik_asesi;
				$nama = $value->nama_asesi;
				$studi = $value->program_studi_asesi;
				$kelas = $value->kelas_asesi;
				$semester =$value->semester_asesi;
				$hp =$value->hp_asesi;
				$email =$value->email_asesi;

				// $simpan=$this->db->query("INSERT INTO $calon_asesi SET
				// 	nim_calon='$nim',
				// 	-- tahun_akademik_calon='$tahun',
				// 	nama_calon='$nama',
				// 	-- program_studi_calon='$studi',
				// 	kelas_calon='$kelas',
				// 	semester_calon='$semester',
				// 	kelamin_calon='$klamin',
				// 	hp_calon='$hp',
				// 	email_calon='$email'
				// 	");

          $data_aray = array(
            'nim_calon' => $nim,
            'nama_calon' => $nama,
            'kelas_calon' => $kelas,
            'semester_calon' => $semester,
            'id_angkatan' => $tahun,
            'hp_calon' => $hp,
            'id_prodi' => $studi,
            'email_calon' => $email,
            'is_user' => "1"
          );

          $simpan_mhs=$this->db->insert($calon_asesi, $data_aray);

          if (isset($simpan_mhs)) {
		  	$this->db->truncate($calon_asesi_temp);

		  	$nama_mhs = str_replace(' ', '', strtolower($nama));
		  	if (strlen($nama_mhs) > 4) {
		  		$akun = substr($nama_mhs, 0, 4) . rand(1, 9999);
            } else {
            	$akun = $nama_mhs . rand(1, 9999);
            }

            $this->load->model('Mahasiswa_model');
            // $this->Mahasiswa_model->insert($data_aray);
            $pegawai_id = $this->db->insert_id();

            $data_user = array(
              'akun' => $akun,
              'email' => $email,
              'hp' => $hp,
              'no_identitas' => $nim,
              'nama_user' => $nama,
              'jenis_user' => '1',
              'sandi' => '123456',
              'sandi_asli' => '123456',
              'aktif' => '1',
              'pegawai_id' => $pegawai_id,
            );

            $this->load->model('User_Model');
            $this->User_Model->insert($data_user);
            $user_id = $this->db->insert_id();

            $datay['user_id'] = $user_id;
            $datay['role_id'] = 17;
            $this->load->model('User_Role_Model');
            $this->User_Role_Model->insert($datay);

	        echo json_encode(array('msgType'=>'success','msgValue'=>"Data berhasil diposting"));
	      }

	  }

      // if (sizeof($simpan) == 0) {
      //     echo json_encode(array('msgType'=>'success','msgValue'=>"Data gagal diposting"));
      // } else {
      //     echo json_encode(array('msgType'=>'success','msgValue'=>"Data berhasil diposting"));
      // }
	}

	function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->asesi_temp_model->set_validation()->validate();

            if ($data !== false) {
                if ($this->asesi_temp_model->check_unique($data, intval($id))) {
                    if ($this->asesi_temp_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->asesi_temp_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $value = $this->asesi_temp_model->get(intval($id));
            if (sizeof($value) == 1) {
                $view = $this->load->view('asesi_temp/edit', array('data' => $this->asesi_temp_model->get_single($value)), TRUE);
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
            $roles = $this->asesi_temp_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->asesi_temp_model->delete(intval($id))) {
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
