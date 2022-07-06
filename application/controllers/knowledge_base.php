<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Knowledge_base extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('knowledge_base_model');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'knowledge_base_model', 'controller' => 'knowledge_base', 'options' => array('id' => 'knowledge_base', 'pagination', 'rownumber')))->load_model()->set_grid();
            $view = $this->load->view('knowledge_base/index', array('grid' => $grid), true);
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
            $data['total'] = isset($where) ? $this->knowledge_base_model->count_by($where) : $this->knowledge_base_model->count_all();
            $this->knowledge_base_model->limit($row, $offset);
            $order = $this->knowledge_base_model->get_params('_order');
            $rows = $this->knowledge_base_model->set_params($params)->with(array('category'));
			$data['rows'] = $this->knowledge_base_model->get_selected()->data_formatter($rows);

             echo json_encode($data);
        } else {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->knowledge_base_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->knowledge_base_model->check_unique($data)) {
                    if ($this->knowledge_base_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->knowledge_base_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            //echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('knowledge_base/add', array('status' => 1, 'bidang' => 1),  TRUE)));
                $this->load->model('knowledge_base_categories_model');
                $kategori = $this->knowledge_base_categories_model->dropdown('id', 'category');

                $view = $this->load->view('knowledge_base/add', array('kategori' => $kategori), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        }
    }

    function delete($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $roles = $this->knowledge_base_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->knowledge_base_model->delete(intval($id))) {
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
            $data = $this->knowledge_base_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->knowledge_base_model->check_unique($data, intval($id))) {
                    if ($this->knowledge_base_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->knowledge_base_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $batch = $this->knowledge_base_model->get(intval($id));
            if (sizeof($batch) == 1) {
                $this->load->model('knowledge_base_categories_model');
                $kategori = $this->knowledge_base_categories_model->dropdown('id', 'category');

                $view = $this->load->view('knowledge_base/edit', array('data' => $this->knowledge_base_model->get_single($batch),'url' => base_url() . 'knowledge_base/edit_upload/' . $id,
                'kategori' => $kategori), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));

            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
    }
    function combogrid($id = false)
	{
		$this->load->model('v_knowledge_base_model');
		$row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows')) ;
		$page = intval($this->input->post('page'))== 0 ? 1 : intval($this->input->post('page'));
		$offset = $row * ($page - 1);
		$data = array();
		$params = array('_return'=>'data');
		if(isset($_POST['q']))
		{
			$where['knowledge_base_name LIKE'] = "%" . $this->input->post('q') . "%";
		}
		if(isset($where)) $params['_where'] = $where;
		$data['total'] = isset($where) ? $this->v_knowledge_base_model->count_by($where) : $this->v_knowledge_base_model->count_all();
		$this->v_knowledge_base_model->limit($row, $offset);
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
			$order = $this->v_knowledge_base_model->get_params('_order');
		}
		$rows = isset($where) ? $this->v_knowledge_base_model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->v_knowledge_base_model->order_by($order, $order_criteria, $_order_escape)->get_all();
		$data['rows'] = $this->v_knowledge_base_model->get_selected()->data_formatter($rows);
        //var_dump($data);
		echo json_encode($data);
	}
    function view($id=false) {

            $this->load->model('knowledge_base_categories_model');
            $order = $this->knowledge_base_categories_model->get_params('_order');
            $data['category'] = $this->knowledge_base_categories_model->order_by($order)->get_all();
            $category = $data['category'];
            $count = array();
            $knowledge_base = array();
            foreach ($category as $key => $value) {
                $where['kbc_id ='] = $value->id;
                $total = $this->knowledge_base_model->count_by($where);
                array_push($count, $total);

                //$where_category['kbc_id ='] = $value->id;
                array_push($knowledge_base, $this->knowledge_base_model->order_by(array("kbc_id" => "ASC","no_urut" => "ASC"))->get_many_by($where));
            }
            $data['count'] = $count;
            $data['knowledge_base'] = $knowledge_base;

            $data['class_active'] = 'tutorial';
            $data_header['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
            $this->load->view('templates/bootstraps/header',$data_header);
            if($id==1){
                $view = 'alamat_website';
            }elseif($id==2){
                $view = 'pendaftaran';
            }else{
                $view = 'tutorial';
            }
            $this->load->view('tutorial/'.$view,$data);
            $this->load->view('templates/bootstraps/bottom');
    }
    function detail($id=false) {
            $where['id ='] = $id;
            $data['rows'] = $this->knowledge_base_model->order_by('id')->get_many_by($where);

            $where_category['kbc_id ='] = $data['rows'][0]->kbc_id;
            $params['_where'] = $where_category;
            $rows = $this->knowledge_base_model->set_params($params)->with(array('category'));

            $data['rows_category'] = $this->knowledge_base_model->get_selected()->data_formatter($rows);
            //var_dump($data['rows_category']);
            //die();
            $data['class_active'] = 'tutorial';

            $data_header['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
            $this->load->view('templates/bootstraps/header',$data_header);

            $this->load->view('tutorial/tutorial_detail',$data);
            $this->load->view('templates/bootstraps/bottom');
    }
    function draft($id=false) {
            $where_category['kbc_id ='] = $id;
            $params['_where'] = $where_category;
            $rows = $this->knowledge_base_model->set_params($params)->with(array('category'));

            $data['rows_category'] = $this->knowledge_base_model->get_selected()->data_formatter($rows);
            $data['class_active'] = 'tutorial';

            $data_header['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
            $this->load->view('templates/bootstraps/header',$data_header);

            $this->load->view('tutorial/draft_detail',$data);
            $this->load->view('templates/bootstraps/bottom');
    }
    function upload() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->knowledge_base_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->knowledge_base_model->check_unique($data)) {
                    if (isset($_FILES['fileToUpload']['tmp_name']) && !empty($_FILES['fileToUpload']['tmp_name'])) {
                        $data['image_description'] = str_replace(' ', '_', $_FILES['fileToUpload']['name']);
                        $config['upload_path'] = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/files/tutorial/';
                        $config['allowed_types'] = '*';
                        $config['max_size'] = '0';

                        $this->load->library('upload', $config);

                        if (!$this->upload->do_upload('fileToUpload')) {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => $this->upload->display_errors()));
                            exit();
                        }
                    }else{
                        $data['image_description'] = "";
                    }
                    if ($this->knowledge_base_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", strip_tag($this->knowledge_base_model->get_validation()))));
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
            $data = $this->knowledge_base_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->knowledge_base_model->check_unique($data, intval($id))) {
                        if (isset($_FILES['fileToUpload']['tmp_name']) && !empty($_FILES['fileToUpload']['tmp_name'])) {
                        $siswa = $this->knowledge_base_model->get(intval($id));
                        //var_dump($siswa);die();

                        $data['image_description'] =  rand().str_replace(' ', '_', $_FILES['fileToUpload']['name']);
                        $config['upload_path'] = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/files/tutorial/';
                        $config['allowed_types'] = '*';
                        $config['file_name'] = $data['image_description'];
                        $config['max_size'] = '512000000';

                        $this->load->library('upload', $config);

                        if ($this->upload->do_upload('fileToUpload')) {
                            $current_file = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/files/tutorial/' . $siswa->image_description;
                            if (is_file($current_file)) {
                                unlink($current_file);
                            }
                        } else {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => strip_tags($this->upload->display_errors())));
                            exit();
                        }
                    }else{
                        $data['image_description'] = $this->input->post('hidden_field');
                    }
                    if ($this->knowledge_base_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->knowledge_base_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        }
    }
}
