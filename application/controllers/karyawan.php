<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Karyawan extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('karyawan_model');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'karyawan_model', 'controller' => 'karyawan', 'options' => array('id' => 'karyawan', 'pagination', 'rownumber')))->load_model()->set_grid();
            $view = $this->load->view('karyawan/index', array('grid' => $grid), true);
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
            if (isset($_POST['nik']) && !empty($_POST['nik'])) {
                $where['nik LIKE'] = '%' . $this->input->post('nik') . '%';
            }
            if (isset($_POST['nama']) && !empty($_POST['nama'])) {
                $where['nama LIKE'] = '%' . $this->input->post('nama') . '%';
            }

            $data = array();
            $params = array('_return' => 'data');
            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->karyawan_model->count_by($where) : $this->karyawan_model->count_all();
            $this->karyawan_model->limit($row, $offset);
            $rows = $this->karyawan_model->set_params($params)->with(array('jabatan'));
            $data['rows'] = $this->karyawan_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->karyawan_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->karyawan_model->check_unique($data)) {
                    if ($this->karyawan_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->karyawan_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
            //var_dump($data);
        } else {
            $this->load->model('jabatan_model');
            $jabatan = $this->jabatan_model->dropdown('id', 'jabatan');
            $view = $this->load->view('karyawan/add', array('gender' => array('laki-laki', 'perempuan')
            , 'url' => base_url() . 'karyawan/upload',
                'agama' => array('Islam', 'Kristen', 'Hindu', 'Budha', 'Khonghucu'), 'jabatan' => $jabatan), TRUE);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        }
    }

    function delete($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $roles = $this->karyawan_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->karyawan_model->delete(intval($id))) {
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

    function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->karyawan_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->karyawan_model->check_unique($data, intval($id))) {
                    if ($this->karyawan_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->karyawan_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $con_method = $this->karyawan_model->get(intval($id));
            if (sizeof($con_method) == 1) {

                $this->load->model('jabatan_model');
                $jabatan = $this->jabatan_model->dropdown('id', 'jabatan');
                $view = $this->load->view('karyawan/edit', array('data' => $this->jabatan_model->get_single($con_method), 'gender' => array('laki-laki', 'perempuan'),
                    'url' => base_url() . 'karyawan/edit_upload/' . $id,'agama' => array('Islam', 'Kristen', 'Hindu', 'Budha', 'Khonghucu'), 'jabatan' => $jabatan), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
    }

    function upload() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->karyawan_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->karyawan_model->check_unique($data)) {
                    if (isset($_FILES)) {
                        $data['foto'] = str_replace(' ', '_', $_FILES['fileToUpload']['name']);
                        $config['upload_path'] = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/img/karyawan/';
                        $config['allowed_types'] = 'bmp|jpg|png|gif|jpeg';
                        $config['max_size'] = '5120000';

                        $this->load->library('upload', $config);

                        if (!$this->upload->do_upload('fileToUpload')) {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => $this->upload->display_errors()));
                            exit();
                        }
                    }
                    if ($this->karyawan_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", strip_tag($this->karyawan_model->get_validation()))));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        }
    }

    function edit_upload($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->karyawan_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->karyawan_model->check_unique($data, intval($id))) {
                    if (isset($_FILES['fileToUpload']['tmp_name']) && !empty($_FILES['fileToUpload']['tmp_name'])) {
                        $siswa = $this->karyawan_model->get(intval($id));
                        $data['foto'] = $data['nik'] . '_' . str_replace(' ', '_', $_FILES['fileToUpload']['name']);
                        $config['upload_path'] = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/img/karyawan/';
                        $config['allowed_types'] = 'bmp|jpg|png|gif|jpeg';
                        $config['file_name'] = $data['foto'];
                        $config['max_size'] = '5120000';

                        $this->load->library('upload', $config);

                        if ($this->upload->do_upload('fileToUpload')) {
                            $current_file = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/img/karyawan/' . $siswa->foto;
                            if (is_file($current_file)) {
                                unlink($current_file);
                            }
                        } else {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => strip_tags($this->upload->display_errors())));
                            exit();
                        }
                    }else{
                        $data['foto'] = $this->input->post('foto_hidden');
                    }
                    if ($this->karyawan_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->karyawan_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        }
    }

    function search() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('karyawan/search', '', TRUE)));
        } else {
            block_access_method();
        }
    }

	function combogrid($id = false)
	{
		$row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows')) ;
		$page = intval($this->input->post('page'))== 0 ? 1 : intval($this->input->post('page'));
		$offset = $row * ($page - 1);
		$data = array();
		$params = array('_return'=>'data');
		if(isset($_POST['q']))
		{
			$where['nama LIKE'] = "%" . $this->input->post('q') . "%";
		}
		if(isset($where)) $params['_where'] = $where;
		$data['total'] = isset($where) ? $this->karyawan_model->count_by($where) : $this->karyawan_model->count_all();
		$this->karyawan_model->limit($row, $offset);
		$order_criteria = "ASC";
		$_order_escape = TRUE;
		if($id)
		{
			$order = "FIELD(id, " . intval($id) . ")";
			$order_criteria = "DESC";
			$_order_escape = FALSE;
		}
		else
		{
			$order = $this->karyawan_model->get_params('_order');
		}
        $rows = $this->karyawan_model->set_params($params)->with(array('jabatan'));
        $data['rows'] = $this->karyawan_model->get_selected()->data_formatter($rows);
		////$rows = isset($where) ? $this->karyawan_model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->karyawan_model->order_by($order, $order_criteria, $_order_escape)->get_all();
		//$data['rows'] = $this->karyawan_model->fields_selected(array('nik', 'nama','mulai_kerja'))->data_formatter($rows);
		echo json_encode($data);
	}

}
