<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Repositori extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('Repositori_Model');
        $this->load->model('artikel_model');
	}

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'repositori_model', 'controller' => 'repositori', 'options' => array('id' => 'repositori','pagination','rownumber')))->load_model()->set_grid();
            $view = $this->load->view('repositori/index', array('grid' => $grid), true);
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
            $jenis_user = $this->auth->get_user_data()->jenis_user;

            if($jenis_user == '2'){
                $user_id = $this->auth->get_user_data()->id;
                $where['t_repositori.created_by'] = $user_id;
            }

            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->Repositori_Model->count_by($where) : $this->Repositori_Model->count_all();
            $this->Repositori_Model->limit($row, $offset);
            $rows = $this->Repositori_Model->set_params($params)->with(array('categories', 'id_categories'));
            //$rows = $this->Repositori_Model->set_params($params)->with(array('divisi'));
            $data['rows'] = $this->Repositori_Model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->Repositori_Model->set_validation()->validate();
            if ($data !== false) {
                if ($this->Repositori_Model->check_unique($data)) {
                    if ($this->Repositori_Model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->Repositori_Model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $user_id = $this->auth->get_user_data()->id;
            $this->load->model('Categories_Model');
            $id_categories = $this->Categories_Model->dropdown('id', 'categories');
            //var_dump($categories);
            $view = $this->load->view('repositori/add', array('user_id'=>$user_id,'id_categories' => $id_categories, 'permisions' => array('Publik', 'Private'), 'path' => array('Assets', 'Repositori')), TRUE);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        }
    }

	function upload() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $path = $this->input->post('path');

            $data = $this->Repositori_Model->set_validation()->validate();
            if ($data !== false) {
                if ($this->Repositori_Model->check_unique($data)) {
                    if (isset($_FILES['fileToUpload']['tmp_name']) && !empty($_FILES['fileToUpload']['tmp_name'])) {
                        $data['nama_file'] = str_replace(' ', '_', $_FILES['fileToUpload']['name']);
                        if($path=='0'){
                        $config['upload_path'] = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/files/artikel/';

                        }else{
                        $config['upload_path'] = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/files/repositori/';

                        }
                        $config['allowed_types'] = '*';
                        $config['max_size'] = 0;

                        $this->load->library('upload', $config);
                        if (!$this->upload->do_upload('fileToUpload')) {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => $this->upload->display_errors()));
                            exit();
                        }else{
                            $data_upload = $this->upload->data();
                            $data['file_size'] = round(($data_upload['file_size'] / 1024),2).' MB';
                            $data['extension'] = str_replace('.','',$data_upload['file_ext']);
                        }
                    }
                    if ($this->Repositori_Model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", strip_tag($this->Repositori_Model->get_validation()))));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        }
	}

    function delete($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $dokumen = $this->Repositori_Model->get(intval($id));
			if(sizeof($dokumen) == 1)
			{
				if($this->Repositori_Model->delete(intval($id)))
				{
					unlink(substr(__dir__,0, strpos( __dir__,"application")) . 'assets/files/repositori/' . $dokumen->nama_file);
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
        } else {
            block_access_method();
        }
    }
    function edit_upload($id = false){
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->Repositori_Model->set_validation()->validate();
            if ($data !== false) {
                if ($this->Repositori_Model->check_unique($data, intval($id))) {
                    if (isset($_FILES['fileToUpload']['tmp_name']) && !empty($_FILES['fileToUpload']['tmp_name'])) {
                        $schedule = $this->Repositori_Model->get(intval($id));
                        $data['nama_file'] = rand() . '_' . str_replace(' ', '_', $_FILES['fileToUpload']['name']);
                        $config['upload_path'] = substr(__dir__,0, strpos( __dir__,"application")) . 'assets/files/repositori/';
                        $config['allowed_types'] = '*';
                        $config['file_name'] = $data['nama_file'];
                        $config['max_size'] = '0';

                        $this->load->library('upload', $config);

                        if ($this->upload->do_upload('fileToUpload')) {
                            $current_file = substr(__dir__,0, strpos( __dir__,"application")) . 'assets/files/repositori/' . $schedule->nama_file;
                            if(is_file($current_file)){
                                unlink($current_file);
                            }
                            $data_upload = $this->upload->data();
                            $data['file_size'] = round(($data_upload['file_size'] / 1024),2).' MB';
                            $data['extension'] = str_replace('.','',$data_upload['file_ext']);
                        }else {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => strip_tags($this->upload->display_errors())));
                            exit();
                        }
                    }else{
                        $data['nama_file'] = $this->input->post('foto_hidden');
                        $data['extension'] = $this->input->post('ext_hidden');
                        $data['file_size'] = $this->input->post('size_hidden');
                    }
                    if ($this->Repositori_Model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->Repositori_Model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        }
    }

    function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
            $repositori = $this->Repositori_Model->get(intval($id));

            if (sizeof($repositori) == 1) {
                $this->load->model('Categories_Model');
                $id_categories = $this->Categories_Model->dropdown('id', 'categories');

                $view = $this->load->view('repositori/edit', array('data' => $this->Repositori_Model->get_single($repositori),'url' => base_url() . 'repositori/edit_upload/' . $id,'id_categories' => $id_categories,'permisions' => array('Publik', 'Private')), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }

    }
	function vdownload($id){
        $data['marquee'] = $this->artikel_model->marquee();
				$data['berita_lsp_pilihan'] = $this->artikel_model->berita_lsp_pilihan();
        $data['data'] = $this->Repositori_Model->detail($id);
        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
        $this->load->view('templates/bootstraps/header',$data);
        $this->load->view('repositori/vrepositori',$data);
        $this->load->view('templates/bootstraps/bottom');
    }
    function vdetail_download($id){
         $data['marquee'] = $this->artikel_model->marquee();

        $data['data'] = $this->Repositori_Model->detail_download($id);
        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
        $this->load->view('templates/bootstraps/header',$data);
        $this->load->view('repositori/vrepositori_detail',$data);
        $this->load->view('templates/bootstraps/bottom');
    }
    function download_category(){
        $data['marquee'] = $this->artikel_model->marquee();
        $data['berita_lsp_pilihan'] = $this->artikel_model->berita_lsp_pilihan();
        $data['data'] = $this->db->get('t_categories')->result();
        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();

        $this->load->view('templates/bootstraps/header',$data);
        $this->load->view('repositori/vdownload_category',$data);
        $this->load->view('templates/bootstraps/bottom');
    }
	function download($id = false)
	{
		if(!$id)
		{
			block_access_method();
		}
		else
		{
			if($_SERVER['REQUEST_METHOD'] == "GET")
			{
				$docs = $this->Repositori_Model->get(intval($id));
				if(sizeof($docs) == 1)
				{
					$doc = $this->Repositori_Model->get_single($docs);
					$files = substr(__dir__,0, strpos( __dir__,"application")) . 'assets/files/repositori/' . $doc->nama_file;
					if(file_exists($files))
					{
						header('Cache-Control: public');
						header('Content-Disposition: attachment; filename="' . $doc->nama_file . '"');
						readfile($files);
                        $this->db->query("UPDATE t_repositori SET jumlah_download=jumlah_download+1 WHERE id= $id");
						//
                        redirect(base_url());
                        //die();
					} else {
						echo json_encode(array('msgType'=>'error', 'msgValue'=>'File tidak dapat ditemukan'));
					}
				}
				else
				{
					echo json_encode(array('msgType'=>'error', 'msgValue'=>'Data tidak dapat ditemukan'));
				}
			}
		}
	}

    function det_repositori()
    {
        $data['value'] = $this->Repositori_Model->get_repositori();
        $this->load->view('repositori/file_download',$data);
    }

    function detail_repo($id)
    {
        $data['value'] = $this->Repositori_Model->detail($id);
        //var_dump($data['value']);
        //die();
        $this->load->view('repositori/detail_repositori',$data);
    }
    function klik_download($id)
    {

            if($_SERVER['REQUEST_METHOD'] == "GET")
            {
                $docs = $this->Repositori_Model->get(intval($id));
                 if(count($docs) == 1)
                {
                    //$doc = $this->Repositori_Model->get_single($id);
                    //var_dump(substr(__dir__,0, strpos( __dir__,"application")));
                    $files = substr(__dir__,0, strpos( __dir__,"application")) .'assets/files/artikel/' . $docs->nama_file;
                    if(file_exists($files))
                    {
                        header('Cache-Control: public');
                        header('Content-Disposition: attachment; filename="' . $docs->nama_file . '"');
                        readfile($files);
                        $this->db->query("UPDATE t_repositori SET jumlah_download=jumlah_download+1 WHERE id= $id");
                        //
                        //redirect(base_url().'repositori/download/4');
                        //die();
                    } else {
                        echo 'File tidak dapat ditemukan';
                    }
                }
                else
                {
                    echo 'Data tidak dapat ditemukan';
                }
            }

    }
    function proses(){

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $this->input->post('id');
            $isi = $this->input->post('isi');
             $data = array(
               'description' => $isi,

            );

            $this->db->where('id', $id);
            $this->db->update('t_repositori', $data);
            echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil di simpan'));
        }else{
            echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data gagal disimpan'));
        }
    }
}
