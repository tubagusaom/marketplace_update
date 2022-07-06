<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pra_asesmen extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('pra_asesmen_model');
        $this->load->model('asesi_model');
        $this->load->library('pagination');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'pra_asesmen_model', 'controller' => 'pra_asesmen','datepra' => 'pra_asesmen_date', 'options' => array('id' => 'pra_asesmen', 'pagination', 'rownumber')))->load_model()->set_grid();
            $view = $this->load->view('pra_asesmen/index', array('grid' => $grid), true);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        } else {
            block_access_method();
        }
    }

    function index_asesor($id = 0, $offset = 0){
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $id_asesor = $this->auth->get_user_data()->pegawai_id;

                $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
                $data['status'] = array('-','L','TL');

                $keyword = $this->input->get('keyword');
                if ($keyword == "") {
                        $offset = $this->uri->segment(4);

                        $this->db->where('id_asesor', $id_asesor);
                        $jml = $this->db->get(kode_tbl().'detail_jadwal');
                        $data['jmldata'] = $jml->num_rows();
                        //pengaturan pagination
                        $config['enable_query_strings'] = true;
                        $config['base_url'] = base_url() . 'pra_asesmen/index_asesor/' . $id;
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
                        $data['data'] = $this->pra_asesmen_model->index($config['per_page'], $offset, $id_asesor);
                } else {
                        $offset = $this->uri->segment(3);

            $this->db->select('b.nama_calon, a.id_asesor');
            $this->db->from(kode_tbl().'detail_jadwal a');
            $this->db->join(kode_tbl().'calon_asesi b', 'a.id_mahasiswa = b.id');
                        $this->db->where('a.id_asesor', $id_asesor);
            $this->db->like('b.nama_calon', $keyword);
                        $jml = $this->db->get();

                        $data['jmldata'] = $jml->num_rows();

                        //pengaturan pagination
                        $config['enable_query_strings'] = true;
                        if (!empty($keyword)) {
                                $config['suffix'] = "?keyword=" . $keyword;
                        }

                        $config['base_url'] = base_url() . 'pra_asesmen/index_asesor/' . $id;
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
                        $data['data'] = $this->pra_asesmen_model->index($config['per_page'], $offset, $id_asesor, $keyword);
                }
                $this->load->view('templates/responsive/header', $data);
                $this->load->view('pra_asesmen/index_asesor', $data);
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
            // var_dump($jenis_user);die();
            if($jenis_user == 2){
                $asesi_id = $this->auth->get_user_data()->id;
                $where['pra_asesmen_checked ='] = $asesi_id;
            }else if($jenis_user == 1){
                $asesi_id = $this->auth->get_user_data()->id;
                $where['id_users ='] = $asesi_id;
            }else if($jenis_user == 3){
                $user_id = $this->auth->get_user_data()->pegawai_id;
                $where['id_tuk ='] = $user_id;
            }

            if(isset($_POST['nama_lengkap']) && !empty($_POST['nama_lengkap']))
            {
                $where['nama_lengkap like'] = '%' . $this->input->post('nama_lengkap') . '%';
            }
            if(isset($_POST['pra_asesmen_checked']) && !empty($_POST['pra_asesmen_checked']))
            {
                $where['pra_asesmen_checked'] =  $this->input->post('pra_asesmen_checked');
            }
            if(isset($_POST['id_tuk']) && !empty($_POST['id_tuk']))
            {
                $where['id_tuk like'] = '%' . $this->input->post('id_tuk') . '%';
            }

            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->pra_asesmen_model->count_by($where) : $this->pra_asesmen_model->count_all();
            $this->pra_asesmen_model->limit($row, $offset);
            $order = $this->pra_asesmen_model->get_params('_order');
            $rows = $this->pra_asesmen_model->set_params($params)->with(array('skema','user','tuk'));

             foreach ($rows as $key => $value) {
                foreach ($value as $keys=>$values) {
                    if($keys == 'skema'){
                        $rows_baru[$key]->skema = str_replace('MANAJEMEN RISIKO PERBANKAN','MRP',$value->skema);
                    }else if($keys == 'nama_lengkap'){
                         $rows_baru[$key]->$keys = strtoupper($value->$keys);
                    }else{
                        $rows_baru[$key]->$keys = $value->$keys;
                    }

                }
            }

            $data['rows'] = $this->pra_asesmen_model->get_selected()->data_formatter($rows_baru);
            echo json_encode($data);
        } else {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->pra_asesmen_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->pra_asesmen_model->check_unique($data)) {
                    if ($this->pra_asesmen_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->pra_asesmen_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('asesi/add', array('pra_asesmen' => array('-Pilih-', 'Lanjut', 'Tidak Lanjut')), TRUE)));
        }
    }

    function save_asesor()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->load->library('form_validation');
            $id_asesi = $this->input->post('id');
            //$pra_asesmen_date = $this->input->post('pra_asesmen_date');
            $pra_asesmen= $this->input->post('pra_asesmen');
            $pra_asesmen_desc= $this->input->post('pra_asesmen_description');
            $validitas_dokumen = serialize($this->input->post('validitas_dokumen'));

            $perangkat = isset($_POST['perangkat']) ? serialize($_POST['perangkat']) : '';

            $this->form_validation->set_rules('pra_asesmen', 'Hasil Rekomendasi', 'required');
            //$this->form_validation->set_rules('pra_asesmen_date', 'Pra Asesmen Date', 'required');

                if ($this->form_validation->run() != FALSE) {
                    $data['pra_asesmen_date'] = date('Y-m-d');
                    $data['pra_asesmen'] = $pra_asesmen;
                    $data['perangkat'] = $perangkat;
                    $data['validitas_dokumen'] = $validitas_dokumen;
                    $data['pra_asesmen_description'] = $pra_asesmen_desc;


                    //var_dump($data); die();

                    $this->db->where('id', $id_asesi);
                    if ($this->db->update(kode_tbl().'detail_jadwal', $data)) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data Berhasil Disimpan!'));
                    }
                }else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
                }
        }else {
            '';
        }
    }    

    function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $pra_asesmen = $this->input->post('pra_asesmen');
            if($pra_asesmen == "" || $pra_asesmen =="0"){
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan, Validasi dokumen terlebih dahulu atau Rekomendasi tidak boleh kosong !'));
                die();
            }
            $data = $this->pra_asesmen_model->set_validation()->validate();

            if ($data !== false) {
                if ($this->pra_asesmen_model->check_unique($data, intval($id))) {
                    $validitas_dokumen_pra_asesmen = $_POST['validitas_dokumen_pra_asesmen'];
                    $data['validitas_dokumen_pra_asesmen'] =serialize($validitas_dokumen_pra_asesmen);
                    $validitas_dokumen = $_POST['validitas_dokumen'];
                    $data['validitas_dokumen'] =serialize($validitas_dokumen);

                    $perangkat = $_POST['perangkat'];
                    $data['perangkat'] =serialize($perangkat);

                    // $data['perangkat'] = isset($_POST['perangkat']) ? serialize($_POST['perangkat']) : '';

                    $data['pra_asesmen_datetime'] = date('Y-m-d H-i-s');
                    if ($this->pra_asesmen_model->update(intval($id), $data) !== false) {
                        $this->db->where('asesi_id',$id);
                        $asesi= $this->db->get(kode_tbl().'asesi_detail')->result_array();
                        $v = $this->input->post('v');
                        $a = $this->input->post('a');
                        $t = $this->input->post('t');
                        $m = $this->input->post('m');

                        foreach($asesi as $key=>$value){
                            if(isset($v[$value['id']])){
                                $v_value = '1';
                            }else{
                                $v_value = '0';
                            }
                            if(isset($a[$value['id']])){
                                $a_value = '1';
                            }else{
                                $a_value = '0';
                            }
                            if(isset($t[$value['id']])){
                                $t_value = '1';
                            }else{
                                $t_value = '0';
                            }
                            if(isset($m[$value['id']])){
                                $m_value = '1';
                            }else{
                                $m_value = '0';
                            }
                            $data_update = array(
                                       'v' => $v_value,
                                       'a' => $a_value,
                                       't' => $t_value,
                                       'm' => $m_value,
                                    );

                            $this->db->where('id', $value['id']);
                            $this->db->update(kode_tbl().'asesi_detail', $data_update);
                        }

                        $sms = isset($_POST['kirim_notifikasi']) ? $this->input->post('kirim_notifikasi') : "";
                        if($sms != ""){
                            $id_users = $this->input->post('id_users');
                            $rekomendasi = $this->input->post('pra_asesmen_description');
                            $pra_asesmen = $this->input->post('pra_asesmen');

                            $this->sms($id_users,$rekomendasi,$pra_asesmen);
                        }
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->pra_asesmen_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $asesi = $this->pra_asesmen_model->get(intval($id));
            // var_dump($asesi); die();
            if (sizeof($asesi) == 1) {

                $this->db->where('asesi_id',$id);
                $detail_asesi = $this->db->get(kode_tbl().'asesi_detail')->result_array();
                
                // $this->db->where('id_mahasiswa',$asesi->id_users);
                // $detail_asesi = $this->db->get(kode_tbl().'detail_jadwal')->result_array();

                // var_dump($asesi->id_users);die();
                $data = $this->pra_asesmen_model->get_single($asesi);

                $this->load->model('asesi_model');

                $this->db->select('b.pegawai_id,b.id');
                $this->db->from(kode_tbl().'asesi a');
                $this->db->join('t_users b','a.id_users=b.pegawai_id');
                $this->db->where('a.id',$id);
                $row = $this->db->get()->row();
                // var_dump($row->id);

                $this->load->model('pra_asesmen_model');
                $jadwal = $this->pra_asesmen_model->jadwal($asesi->jadwal_id);

                $bukti_pendukung = "<ul style=''>";
                foreach($files_asesi as $value){
                    $bukti_pendukung .= "<li>".$value->nama_dokumen."</li>";
                    //$bukti[]=$value->nama_dokumen;
                }
                $bukti_pendukung .= "</ul>";
                //$bukti_pendukung = implode(',',$bukti);
                //var_dump($files_asesi);die();
                $perangkat_ygdipakai = $this->pra_asesmen_model->perangkat_ygdipakai($asesi->skema_sertifikasi);
                //var_dump($data);

                $validitas_dokumen_pra_asesmen=unserialize($asesi->validitas_dokumen_pra_asesmen);
                 // var_dump($asesi->validitas_dokumen_pra_asesmen);die();
                if(is_array($validitas_dokumen_pra_asesmen) && count($files_asesi) == count($validitas_dokumen_pra_asesmen)){
                    $checklit_valid = 'Y';

                }else{
                    $checklit_valid = 'N';

                }

                $user_asesi=$asesi->id_users;

                $files_asesi = $this->asesi_model->files_asesi($row->id);
                //var_dump($files_asesi);

                $this->db->select('b.foto_profil');
                $this->db->from(kode_tbl().'asesi a');
                $this->db->join('t_users b','a.id_users=b.pegawai_id');
                $this->db->where('a.id',$id);
                $foto = $this->db->get()->row();

                // var_dump($foto); die();

                // $foto = $this->asesi_model->foto($id);
                //var_dump($checklit_valid);
                $view = $this->load->view('pra_asesmen/edit', array('foto'=>$foto,'checklit_valid'=>$checklit_valid,'jadwal'=>$jadwal,'files_asesi'=>$files_asesi,'xxx'=>$asesi,'bukti_pendukung'=>$bukti_pendukung,'detail_asesi'=>$detail_asesi,'data' => $data,'pra_asesmen' => array('-Pilih-', 'Lanjut', 'Tidak Lanjut'),'jenis_kelamin'=>array('-Pilih-','Pria','Wanita'),'perangkat_ygdipakai'=>$perangkat_ygdipakai,'validitas_dokumen_pra_asesmen'=>$validitas_dokumen_pra_asesmen), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
    }

    function edit_asesor($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->model('asesi_model');
            $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
            //$id_asesor = $this->auth->get_user_data()->pegawai_id;

            $this->db->where('id', $id);
            $asesi = $this->db->get(kode_tbl().'detail_jadwal')->row();

            $biodata = $this->db->get_where('t_users', array('pegawai_id' => $asesi->id_mahasiswa))->row();
            //fdump($asesi);

            //var_dump($biodata); die();
            $data['data'] = $asesi;
            $data['biodata'] = $biodata;


            $data['apl02'] = $this->apl02($asesi->kode_unit, '');
            $data['data_perangkat'] = array('Pertanyaan Lisan','Pertanyaan Tulisan','Observasi / Praktek','Wawancara','Cek Portofolio');
            //data upload dokumen asesi
            $users = $this->db->get_where('t_users', array('pegawai_id' => $asesi->id_mahasiswa))->row();
            $data['dokumen_asesi'] = $this->db->get_where('t_repositori', array('id_asesi' => $users->id))->result();

            //var_dump($data['dokumen_asesi']); die();
            //dump($data['dokumen_asesi']);
            $this->load->view('templates/responsive/header', $data);
            $this->load->view('pra_asesmen/edit_asesor', $data);
            $this->load->view('templates/responsive/footer', $data);
        }else{
            block_access_method();
        }
    }

    function delete($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $roles = $this->pra_asesmen_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->pra_asesmen_model->delete(intval($id))) {
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
        $this->load->model('v_pra_asesmen_model');
        $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows')) ;
        $page = intval($this->input->post('page'))== 0 ? 1 : intval($this->input->post('page'));
        $offset = $row * ($page - 1);
        $data = array();
        $params = array('_return'=>'data');
        if(isset($_POST['q']))
        {
            $where['asesi_name LIKE'] = "%" . $this->input->post('q') . "%";
        }
        if(isset($where)) $params['_where'] = $where;
        $data['total'] = isset($where) ? $this->v_pra_asesmen_model->count_by($where) : $this->v_pra_asesmen_model->count_all();
        $this->v_pra_asesmen_model->limit($row, $offset);
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
            $order = $this->v_pra_asesmen_model->get_params('_order');
        }
        $rows = isset($where) ? $this->v_pra_asesmen_model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->v_pra_asesmen_model->order_by($order, $order_criteria, $_order_escape)->get_all();
        $data['rows'] = $this->v_pra_asesmen_model->get_selected()->data_formatter($rows);
        //var_dump($data);
        echo json_encode($data);
    }
    function view($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }


            $asesi = $this->pra_asesmen_model->get(intval($id));
            if (sizeof($asesi) == 1) {
                $this->db->where('asesi_id',$id);
                $detail_asesi = $this->db->get(kode_tbl().'asesi_detail')->result_array();
                //$bukti_pendukung = array_unique($detail_asesi); 'bukti_pendukung'=>$bukti_pendukung,
                $view = $this->load->view('pra_asesmen/view', array('detail_asesi'=>$detail_asesi,'data' => $this->pra_asesmen_model->get_single($asesi),'pra_asesmen' => array('-Pilih-', 'Lanjut', 'Tidak Lanjut'),'jenis_kelamin'=>array('-Pilih-','Pria','Wanita')), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
    function sms($id_users,$pesan,$rekomendasi){
        //var dt = {id_users:id_users,rekomendasi:rekomendasi,pra_asesmen_description:pra_asesmen_description};

         if($rekomendasi==1){
            $rekomendasi_asesor = 'Lanjut';
            //Pesan untuk admin

            $datax['sender_id'] = $id_users;
            $datax['reciepent_id'] = 1 ;
            $datax['title'] = 'Hasil Pra Asesmen Lanjut' ;
            $datax['message'] = 'Hasil Pra Asesmen Lanjut dan masuk ke tahap administrasi' ;

            $this->load->model('Pesan_Model');
            $this->Pesan_Model->insert($datax);
            $admin = $this->db->get('r_konfigurasi_aplikasi')->row();
            smssend($admin->sms_center,$datax['message']);
        }else if($rekomendasi==2){
            $rekomendasi_asesor = 'Tidak Lanjut';
        }else{
            $rekomendasi_asesor = 'Belum ada rekomendasi';
        }

        $pesan = 'Hasil Pra Asesmen anda adalah '.$rekomendasi_asesor.'. '.$pesan;

        $this->db->where('id',$id_users);
        $row = $this->db->get('t_users')->row();

        $data['sender_id'] = $this->auth->get_user_data()->id;
        $data['reciepent_id'] = $id_users ;
        $data['title'] = 'Hasil Pra Asesmen' ;
        $data['message'] = $pesan ;

        $this->load->model('Pesan_Model');
        $this->Pesan_Model->insert($data);
        return smssend($row->hp,$pesan);

        //return smssend($row->hp,$pesan);
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
                $zip = new ZipArchive();
                $zip->open('share/asesi/lampiran_' . $id . '.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);
                $files_asesi = $this->asesi_model->files_asesi($id);
                foreach ($files_asesi as $key => $pendukung) {
                             $zip->addFile('/var/www/lspkeuangansyariah.com/public_html/share/asesi/'.$pendukung->nama_file, $pendukung->nama_file);
                }
                $zip->close();
                $nama_files = substr(__dir__,0, strpos( __dir__,"application")) . 'share/asesi/lampiran_' . $id.'.zip';
                header('Cache-Control: public');
                header('Content-Disposition: attachment; filename="lampiran_' . $id . '.zip"');
                readfile($nama_files);
                die();

            }
        }
    }
    public function upload($id) {
        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();

        if (!empty($_FILES)) {
        $tempFile = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $save_folder = $data['aplikasi']->path.$id;

        if (!file_exists($save_folder)) {
           mkdir($data['aplikasi']->path.$id);
        }



        $targetPath = getcwd() . '/assets/temp/'.$id.'/';
        $targetFile = $targetPath . $fileName ;
        move_uploaded_file($tempFile, $targetFile);
        }
    }
    function cetak($id,$type = "pdf",$rekomendasi) {
          if($rekomendasi==1){
          $hasil_rekomendasi_asesor = 'Lanjut ke Proses Asesmen!';
        }else if($rekomendasi==2){
          $hasil_rekomendasi_asesor = 'Tidak Lanjut ke Proses Asesmen!';
        }else {
          $hasil_rekomendasi_asesor = '';
        }

        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
        $data['array_catatan_apl01'] =  explode('|',$data['aplikasi']->opsi_rekomendasi_apl1);

        $this->load->model('asesi_model');
        //$this->load->model('real_asesmen_model');
        $this->db->select('a.*,b.skema,b.kode_skema,c.alamat as alamat_tuk,c.telp as telp_tuk,c.tuk,d.tanggal as tanggal_mulai,d.tanggal_akhir,e.*');
        $this->db->from(kode_tbl().'asesi a');
          $this->db->where('a.id',$id);
        $this->db->join(kode_tbl().'skema b','a.skema_sertifikasi=b.id');
        $this->db->join(kode_tbl().'jadual_asesmen d','a.jadwal_id=d.id');
        $this->db->join(kode_tbl().'tuk c','d.id_tuk=c.id','LEFT');
        $this->db->join('t_users e','e.id=a.id_users');
        $asesi = $this->db->get()->row();

        $data['data_asesi'] = $asesi;

        $this->db->where('id_users',$asesi->id_users);
        $this->db->where('is_work','1');

        $data_pekerjaan = $this->db->get('t_users_pekerjaan')->row();
        if(count($data_pekerjaan) > 0){
          $data['data_pekerjaan'] = $data_pekerjaan ;
        }else{
          $data['data_pekerjaan'] = "";
        }

        $this->db->where('prov_id',$data_pekerjaan->id_provinsi);
        $data_provinsi = $this->db->get('mst_provinsi')->row();
        $data['data_provinsi'] = $data_provinsi ;

        //$this->db->where('id_asesi',$this->id);
        //$portofolio = $this->db->get('t_asesi_portofolio')->result();
        //var_dump($asesi->skema_sertifikasi); die();
        //$data[] = $this
        $unit_kompetensi = $this->asesi_model->data_unit_kompetensi($asesi->skema_sertifikasi);
        $data['unit_kompetensi'] = $unit_kompetensi;
        $asesi_detail = $this->asesi_model->asesi_detail($id);
        $data['asesi_detail'] = $asesi_detail;
/*        echo "<pre>";
        print_r($data['asesi_detail']);
        echo "</pre>";*/
        //Nama Asesor dan No reg
        $this->db->where('id',$asesi->id_asesor);
        $data_asesor = $this->db->get(kode_tbl().'users')->row();

        $this->db->where('id',$id);
        $data['unit_res'] = $this->db->get(kode_tbl().'unit_kompetensi')->row();
        //var_dump($data['unit_res']); die();
        $this->db->select('b.nama_dokumen');
        $this->db->from('t_asesi_portofolio a');
        $this->db->join('t_repositori b','a.id_repositori=b.id');
        $this->db->where('a.id_asesi',$id);
        $this->db->group_by('b.nama_dokumen');
        $portofolio = $this->db->get()->result();
        //var_dump($portofolio);die();
        if(count($portofolio)>0){
                $bukti_pendukung = "<div style='width:150px'><ol style='margin-left:-5px; padding:-10px'> ";
                foreach($portofolio as $value){
                    $bukti_pendukung .= "<li>".$value->nama_dokumen."</li>";
                    //$bukti[]=$value->nama_dokumen;
                }
                $bukti_pendukung .= "</ol></div>";

            //foreach ($portofolio as $key => $value) {
            //    $array_portofolio[] = $value->nama_dokumen ;
            //}
            $data['implode_portofolio'] = $bukti_pendukung;
        }else{
            $data['implode_portofolio'] = "";
        }
        //var_dump($data['implode_portofolio']);die();
        $data['nama_asesor'] = $data_asesor->users;
        $data['no_reg_asesor'] = $data_asesor->no_reg;
        $kode_unit = '';
        $unit = '';
        $elemen_kuk ="";
        $unit_mak ="";

        $this->db->select('v,a,t,m');
        $this->db->where('asesi_id',$id);
        $detail_asesi = $this->db->get(kode_tbl().'asesi_detail')->result_array();
        //dp($detail_asesi[0]['v']);die();
        $data['apl02'] = $this->apl02($unit_kompetensi,$data['implode_portofolio'],$id,$detail_asesi);

        $data['kode_unit'] = $kode_unit;
        $data['unit'] = $unit;
        $data['qr_asesi'] = $asesi->nama_lengkap." - ".$asesi->no_uji_kompetensi."\r\n\n\n".$data['aplikasi']->url_aplikasi."/qrcode/asesi/".$id;
        $this->load->model('pra_asesmen_model');
        $data['asesor_pra_asesmen'] = $this->pra_asesmen_model->asesor_pra_asesmen($asesi->pra_asesmen_checked);
        $data['ttd_asesor'] = $data['asesor_pra_asesmen']->users." - ".$data['asesor_pra_asesmen']->no_reg."\r\n\n\n".$data['aplikasi']->url_aplikasi."/qrcode/asesor/".$asesi->pra_asesmen_checked;


        $view = $this->load->view('pra_asesmen/cetak_asesi',$data , true);
       if($type=="pdf") {
            $this->load->library("htm12pdf");
            $this->htm12pdf->pdf_create($view, "data_asesi" . date('YmdHis') . ".pdf", false, true);

        }
    }
        function apl02($id,$bukti_pendukung) {
        $bukti = is_array($bukti_pendukung) && count($bukti_pendukung) > 0 ? implode(',', $bukti_pendukung) : '-';
        $skema = kode_tbl() . 'skema';
        $skema_detail = kode_tbl() . 'skema_detail';
        $unit_kompetensi = kode_tbl() . 'unit_kompetensi';
        $elemen_kompetensi = kode_tbl() . 'elemen_kompetensi';
        $kuk = kode_tbl() . 'kuk';
        $asesi = kode_tbl() . 'asesi';
        $asesi_detail = kode_tbl() . 'asesi_detail';

        $this->db->select("c.id_unit_kompetensi,c.unit_kompetensi,d.elemen_kompetensi,e.id_elemen_kompetensi,e.kuk,e.pertanyaan", false);
        $this->db->from("$unit_kompetensi c");
        $this->db->join("$elemen_kompetensi d", "d.id_unit_kompetensi=c.id");
        $this->db->join("$kuk e", "e.id_elemen_kompetensi=d.id");
        $this->db->where("c.id_unit_kompetensi", $id);
        $d = $this->db->get()->result();
        $table = '<table  width="100%" id="apl02" class="table table-bordered">
        <tr align="center" style="font-weight:bold;">
        <td> Kode Unit </td>
        <td> Judul Unit Kompetensi / Elemen Kompetensi / <br/> Kriteria Unjuk Kerja(KUK)</td>
        <td width="30px" align="center"> V<br/>
        <input type="checkbox" id="v_all" onclick="alertsv()"  /> </td>
        <td width="30px" align="center"> A<br/>
        <input type="checkbox" id="a_all" onclick="alertsa()"  /> </td>
        <td width="30px" align="center"> T<br/>
        <input type="checkbox" id="t_all" onclick="alertst()" /> </td>
        <td width="30px" align="center"> M<br/>
        <input type="checkbox" id="m_all" onclick="alertsm()"  /> </td>

        </tr>';
        $no = 1;
        $real_unit = "";
        $real_elemen = "";
        foreach ($d as $key => $value) {
            if ($real_unit == $value->id_unit_kompetensi) {
                if ($real_elemen != $value->id_elemen_kompetensi) {
                    $table .= ' <tr style="font-weight:normal;">
                    <td></td>
                    <td> <b>' . ltrim($value->elemen_kompetensi) . '</b> </td>
                    <td> </td>
                    <td> </td>
                    <td>
                    </td>
                    </tr>';
                        //if($real_elemen == $value->id_elemen_kompetensi){
                    $table .= ' <tr style="font-weight:normal;">
                    <td></td>
                    <td> ' . ltrim($value->kuk) . ' </td>
                    <td align="center"> <input checked type="checkbox" name="is_v[' . $key . ']"  value="1" class="v_all"/> </td>
                    <td align="center"> <input checked type="checkbox" name="is_a[' . $key . ']"  value="1" class="a_all"/> </td>
                    <td align="center"> <input checked type="checkbox" name="is_t[' . $key . ']"  value="1" class="t_all"/> </td>
                    <td align="center"> <input type="checkbox" name="is_m[' . $key . ']"  value="1" class="m_all"/> </td>

                    </tr>';
                } else {

                    $table .= ' <tr style="font-weight:normal;">
                    <td></td>
                    <td> ' . ltrim($value->kuk) . ' </td>
                    <td align="center"> <input checked type="checkbox" name="is_v[' . $key . ']"  value="1" class="v_all"/> </td>
                    <td align="center"> <input checked type="checkbox" name="is_a[' . $key . ']"  value="1" class="a_all"/> </td>
                    <td align="center"> <input checked type="checkbox" name="is_t[' . $key . ']"  value="1" class="t_all"/> </td>
                    <td align="center"> <input type="checkbox" name="is_m[' . $key . ']"  value="1" class="m_all"/> </td>

                    </tr>';
                }
            } else {
                $table .= ' <tr>
                <td> ' . $value->id_unit_kompetensi . ' </td>
                <td> <b>' . $value->unit_kompetensi . '</b> </td>
                <td align="center"> </td>
                <td align="center"> </td>
                <td align="center"> </td>
                <td>
                </td>
                </tr>';
                $table .= ' <tr style="font-weight:normal;">
                <td></td>
                <td> <b>' . ltrim($value->elemen_kompetensi) . '</b> </td>
                <td> </td>
                <td> </td>
                <td align="center"> </td>
                <td>
                </td>
                </tr>';
                $table .= ' <tr style="font-weight:normal;">
                <td></td>
                <td> ' . ltrim($value->kuk) . ' </td>

                <td align="center"> <input checked type="checkbox" name="is_v[' . $key . ']"  value="1" class="v_all"/> </td>
                <td align="center"> <input checked type="checkbox" name="is_a[' . $key . ']"  value="1" class="a_all"/> </td>
                <td align="center"> <input checked type="checkbox" name="is_t[' . $key . ']"  value="1" class="t_all"/> </td>
                <td align="center"> <input type="checkbox" name="is_m[' . $key . ']"  value="1" class="m_all"/> </td>

                </tr>';
                $no++;
            }
            $real_unit = $value->id_unit_kompetensi;
            $real_elemen = $value->id_elemen_kompetensi;
        }
        $table .= '</table>';
        return $table;
    }

    function search() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            //$this->load->model('pra_asesmen_model');
            $this->load->library('combogrid');
                $prodi = $this->combogrid->set_properties(array('model' => 'tuk_model', 'controller' => 'tuk', 'fields' => array('tuk'), 'options' => array('id' => 'id_tuk', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'tuk', 'panelWidth' => 500)))->load_model()->set_grid();


            $view = $this->load->view('pra_asesmen/search', array('prodi' => $prodi), TRUE);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));

        } else {
            block_access_method();
        }
    }
}
