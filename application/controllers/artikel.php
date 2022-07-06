<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Artikel extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        //$this->config->set_item('global_xss_filtering', FALSE);
        $this->load->model('Artikel_Model');
		$this->load->model('album_galeri_model');
        $this->load->model('artikel_model');
	}
    
    function index() 
    {
        $this->load->library('grid');
        //$grid['foto'] = $this->Artikel_Model->galeri();
        $grid = $this->grid->set_properties(array('model' => 'Artikel_Model', 'controller' => 'artikel', 'options' => array('id' => 'artikel', 'pagination', 'rownumber')))->load_model()->set_grid();
        $view = $this->load->view('artikel/index', array('grid' => $grid), true);
        echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
    }
    
    function datagrid() 
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
            $page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
            $offset = $row * ($page - 1);
            
            if(isset($_POST['id_kategori']) && !empty($_POST['id_kategori']))
			{
                if($_POST['id_kategori']==0){
                    $where['id_kategori LIKE'] = '%%';
                }else{
                    $where['id_kategori ='] = $this->input->post('id_kategori');
                }
			}
            
            $data = array();
            $params = array('_return' => 'data');
            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->Artikel_Model->count_by($where) : $this->Artikel_Model->count_all();
            $this->Artikel_Model->limit($row, $offset);
            $order = $this->Artikel_Model->get_params('_order');
            $rows = $this->Artikel_Model->set_params($params)->with(array('kategori', 'id_kategori'));
            //$rows = isset($where) ? $this->Artikel_Model->order_by($order)->get_many_by($where) : $this->Artikel_Model->order_by($order)->get_all();
            $data['rows'] = $this->Artikel_Model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else
        {
            block_access_method();
        }
    }
    
    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $data = $this->Artikel_Model->set_validation()->validate();
            if ($data !== false) {
                if ($this->Artikel_Model->check_unique($data)) {
                   
                    if ($this->Artikel_Model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->Artikel_Model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $this->load->model('Artikel_Kategori_Model');
            $kategori = $this->Artikel_Kategori_Model->dropdown('id', 'kategori');

            $view = $this->load->view('artikel/add', array('kategori' => $kategori,'url' => base_url() . 'artikel/upload'), TRUE);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        }
    }
    
    function upload() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $show_image = isset($_POST['show_image']) ? '1' : '0';
            $data = $this->Artikel_Model->set_validation()->validate();
            if ($data !== false) {
                if ($this->Artikel_Model->check_unique($data)) {
                    if (isset($_FILES['fileToUpload']['tmp_name']) && !empty($_FILES['fileToUpload']['tmp_name'])) {
                        $data['foto'] = str_replace(' ', '_', $_FILES['fileToUpload']['name']);
                        $config['upload_path'] = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/files/artikel/';
                        $config['allowed_types'] = 'bmp|jpg|png|gif|jpeg';
                        $config['max_size'] = '512000000';

                        $this->load->library('upload', $config);

                        if (!$this->upload->do_upload('fileToUpload')) {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => $this->upload->display_errors()));
                            exit();
                        }
                    } else {
						$data['foto'] = "";
					}
                    $data['show_image'] = $show_image;
                    if ($this->Artikel_Model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data Berhasil Disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", strip_tag($this->Artikel_Model->get_validation()))));
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
            $data = $this->Artikel_Model->set_validation()->validate();
            if ($data !== false) {
                if ($this->Artikel_Model->check_unique($data, intval($id))) {
                    $artikelUpdate = $this->Artikel_Model->update(intval($id), $data);
                    if ($artikelUpdate !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !','hasil' => $artikelUpdate));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->Artikel_Model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $con_method = $this->Artikel_Model->get(intval($id));
            if (sizeof($con_method) == 1) {
                $this->load->model('Artikel_Kategori_Model');
                $kategori = $this->Artikel_Kategori_Model->dropdown('id', 'kategori');

                $data = $this->Artikel_Model->get_single($con_method);
                $view = $this->load->view('artikel/edit', array('kategori' => $kategori, 'data' => $data,
                'url' => base_url() . 'artikel/edit_upload/' . $id), TRUE);
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
            $show_image = isset($_POST['show_image']) ? '1' : '0';
            $data = $this->Artikel_Model->set_validation()->validate();
            if ($data !== false) {
                if ($this->Artikel_Model->check_unique($data, intval($id))) {
                    if (isset($_FILES['fileToUpload']['tmp_name']) && !empty($_FILES['fileToUpload']['tmp_name'])) {
                        $siswa = $this->Artikel_Model->get(intval($id));
                        $data['foto'] = rand().str_replace(' ', '_', $_FILES['fileToUpload']['name']);
                        $config['upload_path'] = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/files/artikel/';
                        $config['allowed_types'] = 'bmp|jpg|png|gif|jpeg';
                        $config['file_name'] = $data['foto'];
                        $config['max_size'] = '51200000';

                        $this->load->library('upload', $config);

                        if ($this->upload->do_upload('fileToUpload')) {
                            $current_file = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/files/artikel/' . $siswa->foto;
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
                    $data['show_image'] = $show_image;
                    if ($this->Artikel_Model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->Artikel_Model->get_validation())));
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
            $roles = $this->Artikel_Model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->Artikel_Model->delete(intval($id))) {
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
    
    function search() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            
            $this->load->model('artikel_kategori_model');
            $kategori = $this->artikel_kategori_model->dropdown('id', 'kategori');
            array_unshift($kategori,"-Semua Kategori-");
            
            $view = $this->load->view('artikel/search', array('kategori' => $kategori, 'hidden' => true), TRUE);
            //var_dump($view); die();
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));

        } else {
            block_access_method();
        }
    }
    
    function view_artikel()
    {
        $data['value'] = $this->Artikel_Model->artikel();

		$this->load->view('artikel/v_artikel',$data);
    }
    
    function view($id)
    {
        $data['data'] = $this->artikel_model->detail($id);
        $data['berita_lainnya'] = $this->artikel_model->berita_lainnya();
        $data['berita_lsp_list'] = $this->artikel_model->berita_lsp_list(); 

        $data_header['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row(); 
        $this->load->view('templates/bootstraps/header',$data_header);
        $this->load->view('artikel/view',$data);
        $this->load->view('templates/bootstraps/bottom',$data);
    }
    
    function galeri_foto()
    {
        $data['value'] = $this->Artikel_Model->get_gallery();
        $this->load->view('artikel/v_galeri', $data);
    }
    
    function mitra_kerja()
    {
        $data['value'] = $this->Artikel_Model->get_mitra();
        $this->load->view('artikel/mitra', $data);
    }
    // function view($id=false) {
    //         $data['value'] = $this->Artikel_Model->media_lsp();
    //         $data['berita_lsp2'] = $this->Artikel_Model->berita_lsp2();
    //         $data['berita_bnsp'] = $this->Artikel_Model->berita_bnsp();
            
    //         $data_header['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row(); 
    //         $this->load->view('templates/bootstraps/header',$data_header);
    //         $this->load->view('artikel/view',$data);
    //         $this->load->view('templates/bootstraps/bottom');
    // }  
    function proses(){

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $this->input->post('id');
            $isi = $this->input->post('isi');
             $data = array(
               'isi' => $isi,
               
            );

            $this->db->where('id', $id);
            $this->db->update(kode_tbl().'artikel', $data);
            echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil di simpan'));
        }else{
            echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data gagal disimpan'));
        }
    }
	
	function berita_lsp($id=false) {
            $data['berita_lsp'] = $this->Artikel_Model->berita_lsp();
            $data['berita_lsp2'] = $this->Artikel_Model->berita_lsp2();
            $data['berita_bnsp'] = $this->Artikel_Model->berita_bnsp();
            
            $data_header['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row(); 
            $this->load->view('templates/bootstraps/header',$data_header);
            $this->load->view('artikel/vcategory',$data);
            $this->load->view('templates/bootstraps/bottom');
    }
	
	function media_album() {
        $data['berita_lainnya'] = $this->artikel_model->berita_lainnya();
        $data['value'] = $this->album_galeri_model->get_media_album();
        $data_header['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
        $this->load->view('templates/bootstraps/header',$data_header);
        $this->load->view('artikel/view', $data);
        $this->load->view('templates/bootstraps/bottom');;
    }
	
	function media($id)
    {
		$data['berita_lainnya'] = $this->artikel_model->berita_lainnya();
        $data['value'] = $this->album_galeri_model->detail($id);
        $data_header['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
        $this->load->view('templates/bootstraps/header',$data_header);
        $this->load->view('galeri/v_galeri', $data);
        $this->load->view('templates/bootstraps/bottom');
    }
	
    
//    function visi_misi()
//    {
//        $data['value'] = $this->Artikel_Model->get_visi_misi();
//        $this->load->view('artikel/visi_misi', $data);
//    }
//    
//    function latarbelakang()
//    {
//        $data['value'] = $this->Artikel_Model->get_latarbelakang();
//        $this->load->view('artikel/latarbelakang', $data);
//    }
//    
//    function sambutan()
//    {
//        $data['value'] = $this->Artikel_Model->get_sambutan();
//        $this->load->view('artikel/sambutan', $data);
//    }
    
}