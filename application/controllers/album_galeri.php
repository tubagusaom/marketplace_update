<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Album_galeri extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('album_galeri_model');
        $this->load->model('artikel_model');
	}

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'album_galeri_model', 'controller' => 'album_galeri', 'options' => array('id' => 'album_galeri','pagination','rownumber')))->load_model()->set_grid();
            $view = $this->load->view('galeri/index', array('grid' => $grid), true);
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
            $data['total'] = isset($where) ? $this->album_galeri_model->count_by($where) : $this->album_galeri_model->count_all();
            $this->album_galeri_model->limit($row, $offset);
            $rows = $this->album_galeri_model->set_params($params)->with(array('kategori', 'id_kategori', 'nama_album', 'id_album'));
            $data['rows'] = $this->album_galeri_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->album_galeri_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->album_galeri_model->check_unique($data)) {
                    if ($this->album_galeri_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->album_galeri_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $this->load->model('Artikel_Kategori_Model');
            $kategori = $this->Artikel_Kategori_Model->dropdown('id', 'kategori');
            $this->load->model('album_model');
            $nama_album = $this->album_model->dropdown('id', 'nama_album');

            $view = $this->load->view('galeri/add', array('kategori' => $kategori, 'nama_album' => $nama_album ,'url' => base_url() . 'album_galeri/upload'), TRUE);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        }
    }

    function upload() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->album_galeri_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->album_galeri_model->check_unique($data)) {
                    if (isset($_FILES['fileToUpload']['tmp_name']) && !empty($_FILES['fileToUpload']['tmp_name'])) {
                        $data['foto'] = str_replace(' ', '_', $_FILES['fileToUpload']['name']);
                        $config['upload_path'] = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/img/gallery/';
                        $config['allowed_types'] = 'bmp|jpg|png|gif|jpeg';
                        $config['max_size'] = '5120000000';

                        $this->load->library('upload', $config);

                        if (!$this->upload->do_upload('fileToUpload')) {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => $this->upload->display_errors()));
                            exit();
                        }
                    } else {
						$data['foto'] = "";
					}
                    if ($this->album_galeri_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", strip_tag($this->album_galeri_model->get_validation()))));
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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->album_galeri_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->album_galeri_model->check_unique($data, intval($id))) {
                    if ($this->album_galeri_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->album_galeri_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $con_method = $this->album_galeri_model->get(intval($id));
            if (sizeof($con_method) == 1) {
                $this->load->model('Artikel_Kategori_Model');
                $kategori = $this->Artikel_Kategori_Model->dropdown('id', 'kategori');
                $this->load->model('album_model');
                $nama_album = $this->album_model->dropdown('id', 'nama_album');

                $data = $this->album_galeri_model->get_single($con_method);
                $view = $this->load->view('galeri/edit', array('kategori' => $kategori, 'nama_album' => $nama_album ,'data' => $data,
                'url' => base_url() . 'album_galeri/edit_upload/' . $id), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
    }

    function edit_upload($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->album_galeri_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->album_galeri_model->check_unique($data, intval($id))) {
                    if (isset($_FILES['fileToUpload']['tmp_name']) && !empty($_FILES['fileToUpload']['tmp_name'])) {
                        $img = $this->album_galeri_model->get(intval($id));
                        $data['foto'] = str_replace(' ', '_', $_FILES['fileToUpload']['name']);
                        $config['upload_path'] = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/img/gallery/';
                        $config['allowed_types'] = 'bmp|jpg|png|gif|jpeg';
                        $config['file_name'] = $data['foto'];
                        $config['max_size'] = '5120000000';

                        $this->load->library('upload', $config);

                        if ($this->upload->do_upload('fileToUpload')) {
                            $current_file = substr(__dir__, 0, strpos(__dir__, "application")) . 'uploads/gallery/' . $img->foto;
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
                    if ($this->album_galeri_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->album_galeri_model->get_validation())));
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
            $roles = $this->album_galeri_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->album_galeri_model->delete(intval($id))) {
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

    function galeri_album(){
		$data['berita_lainnya'] = $this->artikel_model->berita_lainnya();
		$data['berita_lsp_pilihan'] = $this->artikel_model->berita_lsp_pilihan();
		$data['berita_lsp'] = $this->artikel_model->berita_lsp();
        $data['album'] = $this->album_galeri_model->get_album();
        $data_header['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
        $this->load->view('templates/bootstraps/header',$data_header);
        $this->load->view('galeri/v_album', $data);
        $this->load->view('templates/bootstraps/bottom');;
    }

    function galeri_foto($id=0,$offset=0)
    {
				$data['berita_lainnya'] = $this->artikel_model->berita_lainnya();
				$data['berita_lsp_pilihan'] = $this->artikel_model->berita_lsp_pilihan();
        $data['value'] = $this->album_galeri_model->detail($id);
				$data['berita_lsp'] = $this->artikel_model->berita_lsp();
/*        echo "<pre>";
        print_r($data['galeri']);
        echo "</pre>";
        die();*/
        $data_header['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
        $this->load->view('templates/bootstraps/header',$data_header);
        $this->load->view('galeri/v_galeri', $data);
        $this->load->view('templates/bootstraps/bottom');
    }

	function galeri_valbum()
    {
		$data['berita_lainnya'] = $this->artikel_model->berita_lainnya();
        $data['value'] = $this->album_galeri_model->get_valbum();
        $data_header['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
        $this->load->view('templates/bootstraps/header',$data_header);
        $this->load->view('galeri/v_video', $data); /**v_valbum**/
        $this->load->view('templates/bootstraps/bottom');;
    }

    function galeri_video()
    {
        $data['berita_lainnya'] = $this->artikel_model->berita_lainnya();
        $data_header['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
        $this->load->view('templates/bootstraps/header',$data_header);
        $this->load->view('galeri/v_video',$data);
        $this->load->view('templates/bootstraps/bottom');
    }

}
