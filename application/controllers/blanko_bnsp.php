    <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Blanko_bnsp extends MY_Controller {

    	function __construct()
    	{
    		parent::__construct();
            $this->load->model('blanko_bnsp_model');

    	}

        function index() {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $this->load->library('grid');
                $grid = $this->grid->set_properties(array('model' => 'blanko_bnsp_model', 'controller' => 'blanko_bnsp', 'options' => array('id' => 'blanko_bnsp','pagination','rownumber')))->load_model()->set_grid();
                $view = $this->load->view('blanko_bnsp/index', array('grid' => $grid), true);
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
                $data['total'] = isset($where) ? $this->blanko_bnsp_model->count_by($where) : $this->blanko_bnsp_model->count_all();
                $this->blanko_bnsp_model->limit($row, $offset);
                $rows = $this->blanko_bnsp_model->set_params($params)->with(array(''));
                $data['rows'] = $this->blanko_bnsp_model->get_selected()->data_formatter($rows);
                echo json_encode($data);
            }
            else {
                block_access_method();
            }
        }

        function add() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $data = $this->blanko_bnsp_model->set_validation()->validate();
                if ($data !== false) {
                    if ($this->blanko_bnsp_model->check_unique($data)) {
                        if ($this->blanko_bnsp_model->insert($data) !== false) {
                        	$no_awal = $this->input->post('no_seri_awal');
                        	$no_akhir = $this->input->post('no_seri_akhir');
                        	$jumlah = $no_akhir - $no_awal + 2;
                        	for($i=1;$i < $jumlah;$i++){
                        		$data_insert = array('no_seri_blanko' => $no_awal);
                        		$this->db->insert('t_blanko_detail', $data_insert);
                        		$no_awal++;
                        	}

                            echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                        } else {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                        }
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->blanko_bnsp_model->get_validation())));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
                }
            } else {
                echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('blanko_bnsp/add', '', TRUE)));
            }
        }

        function edit($id = false) {
            if (!$id) {
                data_not_found();
                exit;
            }
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $data = $this->blanko_bnsp_model->set_validation()->validate();
                if ($data !== false) {
                    if ($this->blanko_bnsp_model->check_unique($data, intval($id))) {
                        if ($this->blanko_bnsp_model->update(intval($id), $data) !== false) {
                            echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                        } else {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                        }
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->blanko_bnsp_model->get_validation())));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
                }
            } else {
                $value = $this->blanko_bnsp_model->get(intval($id));
                if (sizeof($value) == 1) {
                    $view = $this->load->view('blanko_bnsp/edit', array('data' => $this->blanko_bnsp_model->get_single($value)), TRUE);
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
                $roles = $this->blanko_bnsp_model->get(intval($id));
                if (sizeof($roles) == 1) {
                    if ($this->blanko_bnsp_model->delete(intval($id))) {
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

        function view_blanko_bnsp($id=0,$offset=0)
        {
            $data['berita_lainnya'] = $this->artikel_model->berita_lainnya();
            $data_header['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
            $data['aplikasi'] = $data_header['aplikasi'] ;
            $keyword=$this->input->get('keyword');
            if($keyword==""){
                $offset = $this->uri->segment(4);
                //$this->db->where('id_group_users',7);
                $jml = $this->db->get('t_blanko_bnsp');
                $data['jmldata'] = $jml->num_rows();
                //pengaturan pagination
                $config['enable_query_strings'] = true;
                $config['base_url'] = base_url().'blanko_bnsp/view_blanko_bnsp/'.$id;
                $config['total_rows'] = $jml->num_rows();
                $config['per_page'] = 5;
                $config['first_page'] = 'Awal';
                $config['last_page'] = 'Akhir';
                $config['next_page'] = '&laquo;';
                $config['prev_page'] = '&raquo;';
                $config['uri_segment'] = 4;
                //inisialisasi config
                $this->pagination->initialize($config);
                //buat pagination
                $data['halaman'] = $this->pagination->create_links();
                $data['data'] = $this->blanko_bnsp_model->get_blanko_bnsp($config['per_page'],$offset);
            }else{
                $offset = $this->uri->segment(3);
                //$this->db->where('id_group_users',7);
                $this->db->like('users', $keyword);
                $jml = $this->db->get('t_blanko_bnsp');
                $data['jmldata'] = $jml->num_rows();

                        //pengaturan pagination
                $config['enable_query_strings'] = true;
                if(!empty($keyword)){
                    $config['suffix'] = "?keyword=".$keyword;
                }

                $config['base_url'] = base_url().'blanko_bnsp/view_blanko_bnsp/'.$id;
                $config['total_rows'] = $jml->num_rows();
                $config['per_page'] = 5;
                $config['first_page'] = 'Awal';
                $config['last_page'] = 'Akhir';
                $config['next_page'] = '&laquo;';
                $config['prev_page'] = '&raquo;';
                $config['uri_segment'] = 4;
                //inisialisasi config
                $this->pagination->initialize($config);
                //buat pagination
                $data['halaman'] = $this->pagination->create_links();
                $data['data'] = $this->blanko_bnsp_model->get_blanko_bnsp($config['per_page'],$offset,$keyword);
            }
            $this->load->view('templates/bootstraps/header',$data_header);
            $this->load->view('blanko_bnsp/v_blanko_bnsp',$data);
            $this->load->view('templates/bootstraps/bottom');
        }

    }
