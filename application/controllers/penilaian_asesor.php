<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Penilaian_asesor extends MY_Controller {
function __construct() {
        parent::__construct();
        $this->load->model('penilaian_asesor_model');
        $this->load->model('real_asesmen_model');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'penilaian_asesor_model', 'controller' => 'penilaian_asesor', 'options' => array('id' => 'penilaian_asesor', 'pagination', 'rows_number')))->load_model()->set_grid();
            $view = $this->load->view('penilaian_asesor/index', array('grid' => $grid), true);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        } else {
            block_access_method();
        }
    }

    function index_asesor($id = 0, $offset = 0){
        $this->load->library('pagination');
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $id_asesor = $this->auth->get_user_data()->pegawai_id;

                $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
                $data['rekomendasi'] = array('-','K','BK');

                $keyword = $this->input->get('keyword');
                if ($keyword == "") {
                        $offset = $this->uri->segment(4);

                        $this->db->where('id_asesor', $id_asesor);
                        $jml = $this->db->get(kode_tbl().'detail_jadwal');
                        $data['jmldata'] = $jml->num_rows();
                        //pengaturan pagination
                        $config['enable_query_strings'] = true;
                        $config['base_url'] = base_url() . 'penilaian_asesor/index_asesor/' . $id;
                        $config['total_rows'] = $jml->num_rows();
                        $config['per_page'] = 10;
                        $config['first_page'] = 'Awal';
                        $config['last_page'] = 'Akhir';
                        $config['next_page'] = '&laquo;';
                        $config['prev_page'] = '&raquo;';
                        $config['uri_segment'] = 4;
                        //inisialisasi config
                        $this->pagination->initialize($config);
                        //buat pagination
                        $data['halaman'] = $this->pagination->create_links();
                        $data['offset'] = $this->uri->segment(4);
                        $data['data'] = $this->penilaian_asesor_model->index($config['per_page'], $offset, $id_asesor);
                } else {
                        $offset = $this->uri->segment(3);

                        $this->db->where('id_asesor', $id_asesor);
                        $jml = $this->db->get(kode_tbl().'detail_jadwal');

                        $data['jmldata'] = $jml->num_rows();

                        //pengaturan pagination
                        $config['enable_query_strings'] = true;
                        if (!empty($keyword)) {
                                $config['suffix'] = "?keyword=" . $keyword;
                        }

                        $config['base_url'] = base_url() . 'penilaian_asesor/index_asesor/' . $id;
                        $config['total_rows'] = $jml->num_rows();
                        $config['per_page'] = 10;
                        $config['first_page'] = 'Awal';
                        $config['last_page'] = 'Akhir';
                        $config['next_page'] = '&laquo;';
                        $config['prev_page'] = '&raquo;';
                        $config['uri_segment'] = 4;
                        //inisialisasi config
                        $this->pagination->initialize($config);
                        //buat pagination
                        $data['halaman'] = $this->pagination->create_links();
                        $data['offset'] = $this->uri->segment(3);
                        $data['data'] = $this->penilaian_asesor_model->index($config['per_page'], $offset, $id_asesor, $keyword);
                }
                $this->load->view('templates/responsive//header', $data);
                $this->load->view('penilaian_asesor/index_asesor', $data);
                $this->load->view('templates/responsive/footer', $data);
            }else {
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
            if($jenis_user == 3){
                $asesi_id = $this->auth->get_user_data()->pegawai_id;
                $where[kode_tbl().'asesi.id_tuk ='] = $asesi_id;
                //$where['administrasi_ujk ='] = '1';
            }else if($jenis_user == 2){
                $asesi_id = $this->auth->get_user_data()->pegawai_id;
                $where['id_asesor ='] = $asesi_id;

                // var_dump($asesi_id); die();
            }else if($jenis_user == 1){
                $asesi_id = $this->auth->get_user_data()->id;
                $where[kode_tbl().'asesi.id_users ='] = $asesi_id;
            }
            //$where['administrasi_ujk ='] = '1';
            if(isset($_POST['id_mahasiswa']) && !empty($_POST['id_mahasiswa']))
            {
                $where['id_mahasiswa like'] = '%' . $this->input->post('id_mahasiswa') . '%';
            }
             if(isset($_POST['id_asesor']) && !empty($_POST['id_asesor']))
            {
                $where['id_asesor'] = $this->input->post('id_asesor') ;
            }
             if(isset($_POST['id_jadwal']) && !empty($_POST['id_jadwal']))
            {
                $where['id_jadwal'] = $this->input->post('id_jadwal') ;
            }
            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->penilaian_asesor_model->count_by($where) : $this->penilaian_asesor_model->count_all();
            $this->penilaian_asesor_model->limit($row, $offset);
            $order = $this->penilaian_asesor_model->get_params('_order');
            $rows = $this->penilaian_asesor_model->set_params($params)->with(array('mahasiswa','jadwal','asesor'));
            $data['rows'] = $this->penilaian_asesor_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        } else {
            block_access_method();
        }
    }

    function search() {

        $jenis_user = $this->auth->get_user_data()->jenis_user;

        if ($jenis_user == 2) {
            $method="search_asesor";
        }else{
            $method="search";
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('combogrid');
            $asesor_grid = $this->combogrid->set_properties(array('model' => 'asesor_model', 'controller' => 'asesor', 'fields' => array('users', 'no_reg'), 'options' => array('id' => 'id_asesor', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'users', 'panelWidth' => 500)))->load_model()->set_grid();

            // $asesi_grid = $this->combogrid->set_properties(array('model' => 'mahasiswa_model', 'controller' => 'mahasiswa', 'fields' => array('nama_calon'), 'options' => array('id' => 'nama_calon', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'nama_calon', 'panelWidth' => 500)))->load_model()->set_grid();

            $asesi_grid = $this->combogrid->set_properties(array('model' => 'V_penilaian_asesor_model', 'controller' => 'penilaian_asesor', 'fields' => array('nama_calon'), 'options' => array('id' => 'id_mahasiswa', 'pagination', 'rownumber', 'idField' => 'id_mahasiswa', 'textField' => 'nama_calon', 'panelWidth' => 500)))->load_model()->set_grid();

            $jadwal_grid = $this->combogrid->set_properties(array('value'=>$asesi->jadwal_id,'model' => 'jadwal_asesmen_model', 'controller' => 'jadwal_asesmen', 'fields' => array('jadual', 'tanggal'), 'options' => array('id' => 'jadwal_id', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'jadual', 'panelWidth' => 500)))->load_model()->set_grid();
            
            if ($jenis_user == 2) {
                $view = $this->load->view('penilaian_asesor/search_asesor', array('asesi_grid' => $asesi_grid,'jadwal_grid' => $jadwal_grid), TRUE);
            }else{
                $view = $this->load->view('penilaian_asesor/search', array('asesor_grid' => $asesor_grid, 'jadwal_grid' => $jadwal_grid), TRUE);
            }
            
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));

        } else {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->penilaian_asesor_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->penilaian_asesor_model->check_unique($data)) {
                    if ($this->penilaian_asesor_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->penilaian_asesor_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('asesi/add', array('penilaian_asesor' => array('-Pilih-', 'Lanjut', 'Tidak Lanjut')), TRUE)));
        }
    }
function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->penilaian_asesor_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->penilaian_asesor_model->check_unique($data, intval($id))) {
                    if ($this->penilaian_asesor_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->penilaian_asesor_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $asesi = $this->penilaian_asesor_model->get(intval($id));
            // var_dump($asesi);die();

            $this->db->select('a.*,b.no_uji_kompetensi,b.id_tuk,c.tuk');
            $this->db->from(kode_tbl().'calon_asesi a');
            $this->db->join(kode_tbl().'asesi b','a.id=b.id_users');
            $this->db->join(kode_tbl().'tuk c','b.id_tuk=c.id', 'left');
            $this->db->where('a.id',$asesi->id_mahasiswa);
            $row_mahasiswa = $this->db->get()->row();

            // var_dump($row_mahasiswa);die();

            $this->db->select('a.*,b.skema');
            $this->db->from(kode_tbl().'jadual_asesmen a');
            $this->db->join(kode_tbl().'skema b','a.id_skema=b.id');
            $this->db->where('a.id',$asesi->id_jadwal);
            $row_jadwal = $this->db->get()->row();
            // var_dump($row_jadwal);die();
            if (sizeof($asesi) == 1) {
                $this->db->select('a.id');
                $this->db->from(kode_tbl().'unit_kompetensi a');
                $this->db->join(kode_tbl().'soal b','a.id=b.id_unit_kompetensi');
                $this->db->where('a.id_unit_kompetensi',$asesi->kode_unit);
                $unit = $this->db->get()->row();
                // var_dump($unit->id);die();

                // $this->db->where('id_unit_kompetensi',$unit->id);
                // $this->db->where('id_unit_kompetensi',$unit->id);
                // $detail_asesi = $this->db->get(kode_tbl().'elemen_kompetensi')->result_array();
                // var_dump($detail_asesi);die();

                $this->db->where('id_unit_kompetensi',$unit->id);
                $this->db->where('jenis_soal','1');
                $soal_observasi = $this->db->get(kode_tbl().'soal')->result();

                $this->db->where('id_unit_kompetensi',$unit->id);
                $this->db->where('jenis_soal','2');
                $soal_wawancara = $this->db->get(kode_tbl().'soal')->result();

                $this->db->where('id_unit_kompetensi',$unit->id);
                $this->db->where('jenis_soal','3');
                $soal_tertulis = $this->db->get(kode_tbl().'soal')->result();
                //dump($soal_observasi);
                $view = $this->load->view('penilaian_asesor/edit', array(
                  'mahasiswa'=>$row_mahasiswa,
                  'row_jadwal'=>$row_jadwal,
                  'data' => $this->penilaian_asesor_model->get_single($asesi),
                  'rekomendasi_asesor' => array('-Pilih-','Kompeten','Belum Kompeten','Asesmen Lanjut'),
                  'soal_observasi'=>$soal_observasi,
                  'soal_wawancara'=>$soal_wawancara,
                  'soal_tertulis'=>$soal_tertulis,
                  'detail_asesi'=>$detail_asesi
                ), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
    }

    function edit_asesor($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();

            $this->db->where('id', $id);
            $result = $this->db->get(kode_tbl().'detail_jadwal')->row();

            $this->db->where('id_unit_kompetensi', $result->kode_unit);
            $unit_kompetensi = $this->db->get(kode_tbl().'unit_kompetensi')->row();

            $this->db->select('a.id_skema, b.skema');
            $this->db->from(kode_tbl().'jadual_asesmen a');
            $this->db->join(kode_tbl().'skema b','a.id_skema=b.id');
            $this->db->where('a.id',$result->id_jadwal);
            $data['jadwal'] = $this->db->get()->row();

            $data['data'] = $result;
            $data['elemen'] = $this->penilaian_asesor_model->get_elemen_kompetensi($unit_kompetensi->id);

            $this->db->select('a.id');
            $this->db->from(kode_tbl().'unit_kompetensi a');
            $this->db->join(kode_tbl().'soal b','a.id=b.id_unit_kompetensi');
            $this->db->where('a.id_unit_kompetensi',$result->kode_unit);
            $unit = $this->db->get()->row();


            if (count($unit) > 0){
                $this->db->where('id_unit_kompetensi',$unit->id);
                $this->db->where('jenis_soal','1');
                $data['soal_observasi'] = $this->db->get(kode_tbl().'soal')->result();

                $this->db->where('id_unit_kompetensi',$unit->id);
                $this->db->where('jenis_soal','2');
                $data['soal_wawancara'] = $this->db->get(kode_tbl().'soal')->result();

                $this->db->where('id_unit_kompetensi',$unit->id);
                $this->db->where('jenis_soal','3');
                $data['soal_tertulis'] = $this->db->get(kode_tbl().'soal')->result();
            }else{
               $data['soal_observasi'] = array();
               $data['soal_wawancara'] = array();
               $data['soal_tertulis'] = array();
            }

                $array_kesenjangan_kuk = explode('#', $result->kesenjangan_kuk);
                $table_pilihan = '';
                if ($result->tindak_lanjut != "y") {

                    $unit_kom = "";
                    $table_pilihan = '<table border="1" style="width:95%;" cellpadding="2" cellsapcing="2"><tr><td><b>Unit Kompetensi</b></td><td><b>Aspek Kritis</b></td></tr>';
                    foreach ($array_kesenjangan_kuk as $key => $value) {
                        $result = "";
                        $result = explode('|', $value);
                        //var_dump($result);
                        if ($unit_kom != $result[0]) {
                            $table_pilihan .= '<tr><td><b>' . $result[0] . '</b></td><td>' . $result[2] . '</td></tr><tr><td colspan="2">' . $result[1] . '</td></tr>';
                        } else {
                            $table_pilihan .= '<tr><td colspan="2">' . @$result[1] . '</td></tr>';
                        }
                        $unit_kom = $result[0];
                    };
                    $table_pilihan .= '</table>';
                }else{
                    $table_pilihan = '';
                }
            $data['table_pilihan'] = $table_pilihan;

            $this->load->view('templates/responsive/header', $data);
            $this->load->view('penilaian_asesor/edit_asesor', $data);
            $this->load->view('templates/responsive/footer', $data);
        }else{
            block_access_method();
        }
    }

    function save_asesor()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->load->library('form_validation');
            $id = $this->input->post('id');
            $catatan_rekomendasi = $this->input->post('catatan_rekomendasi');
            $rekomendasi_asesor = $this->input->post('rekomendasi_asesor');
            $pencapaian = serialize($this->input->post('pencapaian_l'));
            $keputusan = serialize($this->input->post('keputusan_l'));


            $this->form_validation->set_rules('rekomendasi_asesor', 'Hasil Rekomendasi', 'required');

                if ($this->form_validation->run() != FALSE) {
                    $data['rekomendasi_asesor'] = $rekomendasi_asesor;
                    $data['catatan_rekomendasi'] = $catatan_rekomendasi;
                    $data['pencapaian_mak02'] = $pencapaian;
                    $data['keputusan_mak02'] = $keputusan;


                    //var_dump($data); die();


                    //var_dump($data); die();

                    $this->db->where('id', $id);
                    if ($this->db->update(kode_tbl().'detail_jadwal', $data)) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data Berhasil Disimpan!'));
                    }
                }else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
                }
        }else {
            block_access_method();
        }
    }

    function format_unit($kode_unit){
        $unit = unserialize($kode_unit);
        //var_dump($unit);
        $this->db->where_in('id_unit_kompetensi',$unit);
        $query = $this->db->get(kode_tbl().'unit_kompetensi')->result();
        foreach ($query as $key => $value) {
            $unit_kompetensi[] = $value->unit_kompetensi;
        }
        return  $unit_kompetensi;
    }
    function edit_upload($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->penilaian_asesor_model->set_validation()->validate();

            if ($data !== false) {
                if ($this->penilaian_asesor_model->check_unique($data, intval($id))) {
                    if (isset($_FILES['fileToUpload']['tmp_name']) && !empty($_FILES['fileToUpload']['tmp_name'])) {
                        $siswa = $this->penilaian_asesor_model->get(intval($id));
                        $data['bukti_pembayaran'] = $siswa->no_identitas. '_' . str_replace(' ', '_', $_FILES['fileToUpload']['name']);
                        $config['upload_path'] = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/files/administrasi/';
                        $config['allowed_types'] = 'bmp|jpg|png|gif|jpeg|pdf|doc|docx';
                        $config['file_name'] = $data['bukti_pembayaran'];
                        $config['max_size'] = '51200000';

                        $this->load->library('upload', $config);

                        if ($this->upload->do_upload('fileToUpload')) {
                            $current_file = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/files/administrasi/' . $siswa->bukti_pembayaran;
                            if (is_file($current_file)) {
                                unlink($current_file);
                            }
                        } else {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => strip_tags($this->upload->display_errors())));
                            exit();
                        }
                    }else{
                        $data['bukti_pembayaran'] = $this->input->post('foto_hidden');
                    }
                    if ($this->penilaian_asesor_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->penilaian_asesor_model->get_validation())));
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
            $roles = $this->penilaian_asesor_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->penilaian_asesor_model->delete(intval($id))) {
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
    function combogrid($id = false)
    {
        $this->load->model('V_penilaian_asesor_model');
        $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows')) ;
        $page = intval($this->input->post('page'))== 0 ? 1 : intval($this->input->post('page'));
        $offset = $row * ($page - 1);
        $data = array();
        $params = array('_return'=>'data');

        $asesor_id = $this->auth->get_user_data()->pegawai_id;
        $where['id_asesor ='] = $asesor_id;

        if(isset($_POST['q']))
        {
            $where['nama_calon LIKE'] = "%" . $this->input->post('q') . "%";
        }

        if(isset($where)) $params['_where'] = $where;
        $data['total'] = isset($where) ? $this->V_penilaian_asesor_model->count_by($where) : $this->V_penilaian_asesor_model->count_all();
        $this->V_penilaian_asesor_model->limit($row, $offset);
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
            $order = $this->V_penilaian_asesor_model->get_params('_order');
        }
        $rows = isset($where) ? $this->V_penilaian_asesor_model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->V_penilaian_asesor_model->order_by($order, $order_criteria, $_order_escape)->get_all();
        $data['rows'] = $this->V_penilaian_asesor_model->get_selected()->data_formatter($rows);
        //var_dump($data);
        echo json_encode($data);
    }
     function cetakss($id,$type = "pdf") {
        $this->load->model('asesi_model');
        $asesi = $this->penilaian_asesor_model->data_asesi($id);
        $data['data_asesi'] = $asesi;
        $unit_kompetensi = $this->asesi_model->data_unit_kompetensi($asesi->skema_sertifikasi);
        $data['unit_kompetensi'] = $unit_kompetensi;
        $asesi_detail = $this->asesi_model->asesi_detail($id);
        $data['asesi_detail'] = $asesi_detail;

        $kode_unit = '';
        $unit = '';
        $elemen_kuk ="";
        $unit_mak ="";
        //var_dump($unit_kompetensi);die();
        foreach($unit_kompetensi as $key=>$value){
            $kode_unit.=($key+1).'. '.$value->id_unit_kompetensi.'<br/>';
            $unit.=($key+1).'. '.$value->unit_kompetensi.'<br/>';
            $query_elemen = $this->asesi_model->elemen($value->id_unit_kompetensi);
            $detail_elemen = "";
            if(count($query_elemen) > 0){
            foreach($query_elemen as $keys=>$values){
                $query_kuk = $this->asesi_model->kuk($values->id);
                if(count($query_kuk)>0){
                $detail_kuk="";
                foreach($query_kuk as $k=>$v){
                    $detail_kuk.='<tr>
                            <td style="width:45%;">'.($k+1).'. '.$v->kuk.'</td>
                            <td style="width:13%;"></td>
                            <td style="width:13%;"></td>
                            <td style="width:13%;"></td>
                            <td style="width:5%;"></td>
                            <td style="width:5%;"></td>
                            <td style="width:5%;"></td>
                          </tr>';
                }
                }else{
                    $detail_kuk.='<tr>
                            <td></td>
                            <td style="width:13%"></td>
                            <td style="width:13%"></td>
                            <td style="width:13%"></td>
                            <td style="width:5%"></td>
                            <td style="width:5%"></td>
                            <td style="width:5%"></td>
                          </tr>';
                }
                $detail_elemen .= '<tr>
                            <td style="width:45%;font-weight:bold;"> Elemen Kompetensi </td>
                            <td colspan="7" style="width:55%;">'.($keys+1).'. '.$values->elemen_kompetensi.'</td>
                          </tr>
                          <tr>
                            <td rowspan="2" style="width:45%;text-align:center;background-color:grey;font-weight:bold;"> Kriteria Unjuk Kerja </td>
                            <td colspan="3" style="width:40%;text-align:center;background-color:grey;font-weight:bold;">Jenis Bukti</td>
                            <td colspan="3" style="width:15%;text-align:center;background-color:grey;font-weight:bold;">Keputusan</td>

                          </tr>
                          <tr>

                            <td style="width:13%;text-align:center;text-align:center;background-color:grey;font-weight:bold;">Bukti Langsung</td>
                            <td style="width:13%;text-align:center;text-align:center;background-color:grey;font-weight:bold;">Bukti Tidak Langsung</td>
                            <td style="width:13%;text-align:center;background-color:grey;font-weight:bold;">Bukti Tambahan</td>
                            <td style="width:5%;text-align:center;background-color:grey;font-weight:bold;">K</td>
                            <td style="width:5%;text-align:center;background-color:grey;font-weight:bold;">BK</td>
                            <td style="width:5%;text-align:center;background-color:grey;font-weight:bold;">AL</td>
                          </tr>
                          '.$detail_kuk;
            }
            }else{
                $detail_elemen .= '<tr>
                            <td style="width:45%;font-weight:bold;"> Elemen Kompetensi </td>
                            <td colspan="7" style="width:55%;"></td>
                          </tr>
                          <tr>
                            <td rowspan="2" style="width:45%;text-align:center;background-color:grey;font-weight:bold;"> Kriteria Unjuk Kerja </td>
                            <td colspan="3" style="width:40%;text-align:center;background-color:grey;font-weight:bold;">Jenis Bukti</td>
                            <td colspan="3" style="width:15%;text-align:center;background-color:grey;font-weight:bold;">Keputusan</td>

                          </tr>
                          <tr>

                            <td style="width:13%;text-align:center;text-align:center;background-color:grey;font-weight:bold;">Bukti Langsung</td>
                            <td style="width:13%;text-align:center;text-align:center;background-color:grey;font-weight:bold;">Bukti Tidak Langsung</td>
                            <td style="width:13%;text-align:center;background-color:grey;font-weight:bold;">Bukti Tambahan</td>
                            <td style="width:5%;text-align:center;background-color:grey;font-weight:bold;">K</td>
                            <td style="width:5%;text-align:center;background-color:grey;font-weight:bold;">BK</td>
                            <td style="width:5%;text-align:center;background-color:grey;font-weight:bold;">AL</td>
                          </tr>';
            }
            $elemen_kuk .= '<table style="width:100%;font-size:10px;border-collapse: collapse;" border="1" >
                          <tr>
                            <td style="width:45%;font-weight:bold;"> Kode Unit Kompetensi </td>
                            <td colspan="7" style="width:55%;">'.$value->id_unit_kompetensi.'</td>
                          </tr>
                          <tr>
                            <td style="width:45%;font-weight:bold;"> Unit Kompetensi </td>
                            <td colspan="7" style="width:55%;">'.$value->unit_kompetensi.'</td>
                          </tr>
                          '.$detail_elemen.'
                        </table><br/>';
            $unit_mak.='<tr>
                            <td colspan="2" style="width:45%">
                            '.$value->unit_kompetensi.'
                            </td>
                            <td style="width:10%">  </td>
                            <td style="width:10%">  </td>
                            <td style="width:35%">  </td>
                          </tr>';

        }
        //'.//$detail_elemen.'
        $data['unit_mak'] = $unit_mak;
        $data['elemen_kuk'] = $elemen_kuk;
        foreach($asesi_detail as $key=>$value){
            $jenis_bukti[]=$value->jenis_bukti;
        }

        $jenis_bukti = implode(',',array_unique($jenis_bukti));
        $data['jenis_bukti'] = $jenis_bukti;
        $data['kode_unit'] = $kode_unit;
        $data['unit'] = $unit;

        $view = $this->load->view('penilaian_asesor/cetak',$data , true);
        if($type=="pdf") {
            $this->load->library("htm12pdf");
            $this->htm12pdf->pdf_create($view, "data_asesi" . date('YmdHis') . ".pdf", false, true);

        }
    }
    function sms($rekomendasi_description,$telp,$id_users,$rekomendasi_asesor){
        //var dt = {id_users:id_users,rekomendasi:rekomendasi,pra_asesmen_description:pra_asesmen_description};
            if($rekomendasi_asesor ==1){
                $hasil_rekomendasi_asesor = 'Kompeten';
            }else if($rekomendasi_asesor ==2){
                $hasil_rekomendasi_asesor = 'Belum Kompeten';
            }else{
                $hasil_rekomendasi_asesor = 'Belum ada hasil';
            }

            $datax['sender_id'] = $this->auth->get_user_data()->id;
            $datax['reciepent_id'] = $id_users ;
            $datax['title'] = 'Hasil Rekomendasi Asesor' ;
            $datax['message'] = 'Rekomendasi Asesor adalah '.$hasil_rekomendasi_asesor.'.  '.$rekomendasi_description ;

            $this->load->model('Pesan_Model');
            $this->Pesan_Model->insert($datax);

            return smssend($telp,$datax['message'],'login');
    }
    function cetak($id,$type = "pdf") {
        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();

        $this->load->model('asesi_model');
        $asesi = $this->real_asesmen_model->data_asesi($id);
        if($asesi->no_uji_kompetensi == ""){
            echo json_encode(array('msgType' => 'error', 'msgValue' => 'Belum di jadwalkan. Edit terlebih dahulu !'));
            exit;
        }
        $data['data_asesi'] = $asesi;
        $unit_kompetensi = $this->asesi_model->data_unit_kompetensi($asesi->skema_sertifikasi);
        $data['unit_kompetensi'] = $unit_kompetensi;
        $asesi_detail = $this->asesi_model->asesi_detail($id);
        $data['asesi_detail'] = $asesi_detail;
        //Nama Asesor dan No reg
        $this->db->where('id',$asesi->id_asesor);
        $data_asesor = $this->db->get(kode_tbl().'users')->row();
        $data['nama_asesor'] = $data_asesor->users;
        $data['no_reg_asesor'] = $data_asesor->no_reg;
        $kode_unit = '';
        $unit = '';
        $elemen_kuk ="";
        $unit_mak ="";
        //var_dump($unit_kompetensi);die();
        foreach($unit_kompetensi as $key=>$value){
            $kode_unit.=($key+1).'. '.$value->id_unit_kompetensi.'<br/>';
            $unit.='<label style="font-size:10px;">'.($key+1).'. '.$value->unit_kompetensi.'</label><br/>';
            $query_elemen = $this->asesi_model->elemen($value->id_unit_kompetensi);
            $detail_elemen = "";
            if(count($query_elemen) > 0){
            foreach($query_elemen as $keys=>$values){
                $query_kuk = $this->asesi_model->kuk($values->id);
                if(count($query_kuk)>0){
                $detail_kuk="";
                foreach($query_kuk as $k=>$v){
                    $detail_kuk.='<tr>
                            <td style="width:45%;">'.($k+1).'. '.$v->kuk.'</td>
                            <td style="width:13%;"></td>
                            <td style="width:13%;"></td>
                            <td style="width:13%;"></td>
                            <td style="width:5%;"></td>
                            <td style="width:5%;"></td>
                            <td style="width:5%;"></td>
                          </tr>';
                }
                }else{
                    $detail_kuk.='<tr>
                            <td></td>
                            <td style="width:13%"></td>
                            <td style="width:13%"></td>
                            <td style="width:13%"></td>
                            <td style="width:5%"></td>
                            <td style="width:5%"></td>
                            <td style="width:5%"></td>
                          </tr>';
                }
                $detail_elemen .= '<tr>
                            <td style="width:45%;font-weight:bold;"> Elemen Kompetensi </td>
                            <td colspan="7" style="width:55%;">'.($keys+1).'. '.$values->elemen_kompetensi.'</td>
                          </tr>
                          <tr>
                            <td rowspan="2" style="width:45%;text-align:center;background-color:grey;font-weight:bold;"> Kriteria Unjuk Kerja </td>
                            <td colspan="3" style="width:40%;text-align:center;background-color:grey;font-weight:bold;">Jenis Bukti</td>
                            <td colspan="3" style="width:15%;text-align:center;background-color:grey;font-weight:bold;">Keputusan</td>

                          </tr>
                          <tr>

                            <td style="width:13%;text-align:center;text-align:center;background-color:grey;font-weight:bold;">Bukti Langsung</td>
                            <td style="width:13%;text-align:center;text-align:center;background-color:grey;font-weight:bold;">Bukti Tidak Langsung</td>
                            <td style="width:13%;text-align:center;background-color:grey;font-weight:bold;">Bukti Tambahan</td>
                            <td style="width:5%;text-align:center;background-color:grey;font-weight:bold;">K</td>
                            <td style="width:5%;text-align:center;background-color:grey;font-weight:bold;">BK</td>
                            <td style="width:5%;text-align:center;background-color:grey;font-weight:bold;">AL</td>
                          </tr>
                          '.$detail_kuk;
            }
            }else{
                $detail_elemen .= '<tr>
                            <td style="width:45%;font-weight:bold;"> Elemen Kompetensi </td>
                            <td colspan="7" style="width:55%;"></td>
                          </tr>
                          <tr>
                            <td rowspan="2" style="width:45%;text-align:center;background-color:grey;font-weight:bold;"> Kriteria Unjuk Kerja </td>
                            <td colspan="3" style="width:40%;text-align:center;background-color:grey;font-weight:bold;">Jenis Bukti</td>
                            <td colspan="3" style="width:15%;text-align:center;background-color:grey;font-weight:bold;">Keputusan</td>

                          </tr>
                          <tr>

                            <td style="width:13%;text-align:center;text-align:center;background-color:grey;font-weight:bold;">Bukti Langsung</td>
                            <td style="width:13%;text-align:center;text-align:center;background-color:grey;font-weight:bold;">Bukti Tidak Langsung</td>
                            <td style="width:13%;text-align:center;background-color:grey;font-weight:bold;">Bukti Tambahan</td>
                            <td style="width:5%;text-align:center;background-color:grey;font-weight:bold;">K</td>
                            <td style="width:5%;text-align:center;background-color:grey;font-weight:bold;">BK</td>
                            <td style="width:5%;text-align:center;background-color:grey;font-weight:bold;">AL</td>
                          </tr>';
            }
            $elemen_kuk .= '<table style="width:100%;font-size:10px;border-collapse: collapse;" border="1" >
                          <tr>
                            <td style="width:45%;font-weight:bold;"> Kode Unit Kompetensi </td>
                            <td colspan="7" style="width:55%;">'.$value->id_unit_kompetensi.'</td>
                          </tr>
                          <tr>
                            <td style="width:45%;font-weight:bold;"> Unit Kompetensi </td>
                            <td colspan="7" style="width:55%;">'.$value->unit_kompetensi.'</td>
                          </tr>
                          '.$detail_elemen.'
                        </table><br/>';
            $unit_mak.='<tr>
                            <td colspan="2" style="width:45%">
                            '.$value->unit_kompetensi.'
                            </td>
                            <td style="width:10%">  </td>
                            <td style="width:10%">  </td>
                            <td style="width:35%">  </td>
                          </tr>';

        }
        //'.//$detail_elemen.'
        $data['unit_mak'] = $unit_mak;
        $data['elemen_kuk'] = $elemen_kuk;
        foreach($asesi_detail as $key=>$value){
            $jenis_bukti[]=$value->jenis_bukti;
        }

        $jenis_bukti = implode(',',array_unique($jenis_bukti));
        $data['jenis_bukti'] = $jenis_bukti;
        $data['kode_unit'] = $kode_unit;
        $data['unit'] = $unit;
        $data['qr_asesi'] = $asesi->nama_lengkap." - ".$asesi->no_uji_kompetensi."\r\n\n\n".$data['aplikasi']->url_aplikasi."/qrcode/asesi/".$id;
        $this->load->model('pra_asesmen_model');
        $data['asesor_pra_asesmen'] = $this->pra_asesmen_model->asesor_pra_asesmen($asesi->pra_asesmen_checked);
        $data['ttd_asesor'] = $data['asesor_pra_asesmen']->users." - ".$data['asesor_pra_asesmen']->no_reg."\r\n\n\n".$data['aplikasi']->url_aplikasi."/qrcode/asesor/".$asesi->pra_asesmen_checked;

        $data['ttd_asesor_uji'] = $data['nama_asesor']." - ".$data['no_reg_asesor']."\r\n\n\n".$data['aplikasi']->url_aplikasi."/qrcode/asesor_uji/".$asesi->id_asesor;
        $view = $this->load->view('real_asesmen/cetak',$data , true);
       if($type=="pdf") {
            $this->load->library("htm12pdf");
            $this->htm12pdf->pdf_create($view, "data_asesi" . date('YmdHis') . ".pdf", false, true);

        }
    }
}
