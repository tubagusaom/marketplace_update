<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Berita_acara extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('berita_acara_model');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'berita_acara_model', 'controller' => 'berita_acara', 'options' => array('id' => 'berita_acara', 'pagination', 'rownumber')))->load_model()->set_grid();
            $view = $this->load->view('berita_acara/index', array('grid' => $grid), true);
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
            $data['total'] = isset($where) ? $this->berita_acara_model->count_by($where) : $this->berita_acara_model->count_all();
            $this->berita_acara_model->limit($row, $offset);
            $order = $this->berita_acara_model->get_params('_order');
            //$rows = isset($where) ? $this->berita_acara_model->order_by($order)->get_many_by($where) : $this->berita_acara_model->order_by($order)->get_all();
            $rows = $this->berita_acara_model->set_params($params)->with(array('skema','user'));
            $data['rows'] = $this->berita_acara_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        } else {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->berita_acara_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->berita_acara_model->check_unique($data)) {
                    if ($this->berita_acara_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->berita_acara_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $this->load->library('combogrid');

            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('berita_acara/add', array(), TRUE)));
        }
    }

    function edit($id = false) {

        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->berita_acara_model->update(intval($id), $data) !== false) {
                        $status_jadwal = $this->input->post('status_jadwal_hidden');
                        if($status_jadwal == '0' || $status_jadwal == '1'){
                            $terbitkan_sertifikat = $this->input->post('terbitkan_sertifikat');
                                foreach($terbitkan_sertifikat as $key=>$value){
                                    $no_registrasi =$this->berita_acara_model->no_registrasi($key);
                                    $no_sertifikat = $this->berita_acara_model->no_sertifikat($key);
                                    $dataa = array(
                                                   'terbitkan_sertifikat' => $value,
                                                   'tanggal_terbit' => date('Y-m-d'),
                                                   'tanggal_rcc' => date('Y-m-d', strtotime('+3 year')),
                                                   'no_registrasi' => $no_registrasi,
                                                   'no_sertifikat' => $no_sertifikat,

                                                   'tahun_penerbitan_sertifikat' => date('Y')
                                            );
                                    $this->db->where('id', $key);
                                    $this->db->update(kode_tbl().'asesi', $dataa);
                            }
                        }
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
        } else {
            $berita_acara = $this->berita_acara_model->get(intval($id));
            if (sizeof($berita_acara) == 1) {
                $this->load->library('combogrid');
                $users = $this->combogrid->set_properties(array('model'=>'User_Model', 'controller'=>'users', 'fields'=>array('nama_user','email'), 'options'=>array('id'=>'pra_asesmen_checked', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama_user', 'panelWidth'=>400)))->load_model()->set_grid();


                //$this->db->where('rekomendasi_asesor','1');
                $this->db->where('jadwal_id',$id);
                $this->db->order_by('rekomendasi_asesor','DESC');
                $asesi_kompeten = $this->db->get(kode_tbl().'asesi')->result();
                //var_dump($asesi_kompeten);

                $view = $this->load->view('berita_acara/edit', array(
                'data' => $this->berita_acara_model->get_single($berita_acara),
                'pra_asesmen_grid' => $users,
                'asesi_kompeten' => $asesi_kompeten,
                'status_jadwal' => array('-','Sudah Selesai','Dibatalkan','Pending'), 'url' => base_url() . 'berita_acara/edit_upload/' . $id), TRUE);
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
            $roles = $this->berita_acara_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->berita_acara_model->delete(intval($id))) {
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
        $this->load->model('berita_acara_model');
        $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows')) ;
        $page = intval($this->input->post('page'))== 0 ? 1 : intval($this->input->post('page'));
        $offset = $row * ($page - 1);
        $data = array();
        $params = array('_return'=>'data');
        if(isset($_POST['q']))
        {
            $where['jadual LIKE'] = "%" . $this->input->post('q') . "%";
        }
        if(isset($where)) $params['_where'] = $where;
        $data['total'] = isset($where) ? $this->berita_acara_model->count_by($where) : $this->berita_acara_model->count_all();
        $this->berita_acara_model->limit($row, $offset);
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
            $order = $this->berita_acara_model->get_params('_order');
        }
        $rows = isset($where) ? $this->berita_acara_model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->berita_acara_model->order_by($order, $order_criteria, $_order_escape)->get_all();
        $data['rows'] = $this->berita_acara_model->get_selected()->data_formatter($rows);
        //var_dump($data);
        echo json_encode($data);
    }
    function view($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        $con_method = $this->berita_acara_model->get(intval($id));
        if (sizeof($con_method) == 1) {
            $this->db->where('jadwal_id',$id);
            $detail_asesi = $this->db->get('lsp029_asesi')->result_array();

            //$this->load->model('angkatan_model');
            //$this->load->model('program_model');
            //$angkatan = $this->angkatan_model->dropdown('id', 'batch_name');
            //$program = $this->program_model->dropdown('id', 'program_study');

            $data = $this->berita_acara_model->get_single($con_method);
            $view = $this->load->view('berita_acara/view', array(
                'peserta' => $detail_asesi,
                //'angkatan' => $angkatan,
                'data' => $data,
                //'url' => base_url() . 'siswa/edit_upload/' . $id
                ), TRUE);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        } else {
            echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
        }
    }
    function cetak($id,$type = "pdf") {
        $this->db->where('jadwal_id',$id);
        $asesi_kompeten = $this->db->get(kode_tbl().'asesi')->result();

        $data['asesi_kompeten'] = $asesi_kompeten;
        $view = $this->load->view('berita_acara/cetak_ba',$data , true);
        if($type=="pdf") {
            $this->load->library("htm12pdf");
            $this->htm12pdf->pdf_create($view, "berita_acara" . date('YmdHis') . ".pdf", false, true);
        }
    }
     function edit_upload($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->berita_acara_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->berita_acara_model->check_unique($data, intval($id))) {
                    if (isset($_FILES['fileToUpload']['tmp_name']) && !empty($_FILES['fileToUpload']['tmp_name'])) {
                        $siswa = $this->berita_acara_model->get(intval($id));
                        $data['dokumen_berita_acara'] = $siswa->id . '_' . str_replace(' ', '_', $_FILES['fileToUpload']['name']);
                        $config['upload_path'] = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/files/berita_acara/';
                        $config['allowed_types'] = '*';
                        $config['file_name'] = $data['dokumen_berita_acara'];
                        $config['max_size'] = '512000';

                        $this->load->library('upload', $config);

                        if ($this->upload->do_upload('fileToUpload')) {
                            $current_file = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/files/berita_acara/' . $siswa->dokumen_berita_acara;
                            if (is_file($current_file)) {
                                unlink($current_file);
                            }
                        } else {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => strip_tags($this->upload->display_errors())));
                            exit();
                        }
                    }else{
                        $data['dokumen_berita_acara'] = $this->input->post('dokumen_berita_acara');
                    }
                    if ($this->berita_acara_model->update(intval($id), $data) !== false) {
                        $status_jadwal = $this->input->post('status_jadwal_hidden');
                        if($status_jadwal == '0'){
                            $terbitkan_sertifikat = $this->input->post('terbitkan_sertifikat');
                                foreach($terbitkan_sertifikat as $key=>$value){
                                    $no_registrasi =$this->berita_acara_model->no_registrasi($key);
                                    $no_sertifikat = $this->berita_acara_model->no_sertifikat($key);
                                    $dataa = array(
                                                   'terbitkan_sertifikat' => $value,
                                                   'tanggal_terbit' => date('Y-m-d'),
                                                   'tanggal_rcc' => date('Y-m-d', strtotime('+3 year')),
                                                   'no_registrasi' => $no_registrasi,
                                                   'no_sertifikat' => $no_sertifikat,
                                                   'no_urut_sertifikat' => substr($no_sertifikat,13),
                                                   'tahun_penerbitan_sertifikat' => date('Y')
                                            );
                                    $this->db->where('id', $key);
                                    $this->db->update(kode_tbl().'asesi', $dataa);
                            }
                        }
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->berita_acara_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        }
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
                $docs = $this->berita_acara_model->get(intval($id));
                if(sizeof($docs) == 1)
                {
                    $doc = $this->berita_acara_model->get_single($docs);
                    $files = substr(__dir__,0, strpos( __dir__,"application")) . '/assets/files/berita_acara/' . $doc->dokumen_berita_acara;
                    if(file_exists($files))
                    {
                        header('Cache-Control: public');
                         header('Content-Disposition: attachment; filename="' . $doc->dokumen_berita_acara . '"');
                         readfile($files);
                         die();
                    }
                    else
                    {
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
    function  cetak_sertifikat($id,$type = "pdf") {
        ini_set('memory_limit', '51208M');
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $path = base_url();
        } else if (strtoupper(substr(PHP_OS, 0, 3)) === 'DAR') {
            $path = base_url();
        } else {
            $path = '/var/www/asahi.or.id/public_html/';
        }
        $data['path_image'] = $path;

        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
        $data['konfigurasi'] = $data['aplikasi'];
        $this->load->model('asesi_model');
        $this->load->model('sertifikat_model');
        $this->db->where('jadwal_id',$id);
        $this->db->where('terbitkan_sertifikat','on');
        $this->db->order_by('no_registrasi','ASC');
        $peserta = $this->db->get(kode_tbl().'asesi')->result();
        $data['peserta'] = $peserta;
        //var_dump($data['peserta']);die();
        foreach ($peserta as $key => $value) {
            $data['sertifikat'][$key] = $this->sertifikat_model->sertifikat($value->id);
            $data['unit'] = $this->asesi_model->data_unit_kompetensi($value->skema_sertifikasi);
        }
        //var_dump($peserta);die();
        //$this->load->view('berita_acara/cetak_sertifikat',$data);
        $this->load->model('jadwal_asesmen_model');
        $data['daftar_hadir'] = $this->jadwal_asesmen_model->daftar_hadir($id);

        $data['daftar_kompeten'] = $this->jadwal_asesmen_model->daftar_kompeten($id);
        $this->db->where('id',$id);
        $data['jadwal'] = $this->db->get(kode_tbl().'jadual_asesmen')->row();
        $data['skema'] = $this->jadwal_asesmen_model->get_skema($id);
        $data['jumlah_peserta'] = count($data['daftar_hadir']);

        $data['kompeten'] = $this->jadwal_asesmen_model->kompeten($id);
        $view = $this->load->view('berita_acara/cetak_sertifikat',$data , true);

        if($type=="pdf") {
            $this->load->library("htm12pdf");
            $this->htm12pdf->pdf_create($view, "sertifikat" . date('YmdHis') . ".pdf", false, true);

        }
    }
    function pesan($pesan,$id,$hp){
        $admin = $this->db->get('r_konfigurasi_aplikasi')->row();
       // $pesan = 'Anda Mendapat Tugas untuk memeriksa Dokumen pra asesmen atas nama '.$nama_lengkap;

        $data['sender_id'] = 1;
        $data['reciepent_id'] = $id ;
        $data['title'] = 'Keputusan Pleno Asesmen' ;
        $data['message'] = $pesan ;

        $this->load->model('Pesan_Model');
        $this->Pesan_Model->insert($data);
       // smssend($hp,$pesan);


    }
    function pesan_email($pesan,$id,$hp){
        $admin = $this->db->get('r_konfigurasi_aplikasi')->row();
       // $pesan = 'Anda Mendapat Tugas untuk memeriksa Dokumen pra asesmen atas nama '.$nama_lengkap;

        $data['sender_id'] = 1;
        $data['reciepent_id'] = $id ;
        $data['title'] = 'Keputusan Pleno Asesmen' ;
        $data['message'] = $pesan ;

        $this->load->model('Pesan_Model');
        $this->Pesan_Model->insert($data);
        //smssend($hp,$pesan);


    }
    function detail($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        $this->load->model('asesi_model');
        $con_method = $this->asesi_model->get(intval($id));
        if (sizeof($con_method) == 1) {
            //$detail_asesi = $this->db->get()->row();

            //$this->load->model('angkatan_model');
            //$this->load->model('program_model');
            //$angkatan = $this->angkatan_model->dropdown('id', 'batch_name');
            //$program = $this->program_model->dropdown('id', 'program_study');

            $data = $this->asesi_model->get_single($con_method);

            if($data->jenis_kelamin == '1'){
                $nama_lengkap = '<b>Bapak/Sdr '.strtoupper($data->nama_lengkap).' ('.$data->no_uji_kompetensi.')</b>';
                $nama = '<b>Bapak/Sdr '.strtoupper($data->nama_lengkap).'</b>';
            }else{
                $nama_lengkap = '<b>Ibu/Sdri '.strtoupper($data->nama_lengkap).' ('.$data->no_uji_kompetensi.')</b>';;
                $nama = '<b>Bapak/Sdr '.strtoupper($data->nama_lengkap).'</b>';
            }
            if($data->rekomendasi_asesor == '1'){
                $rekomendasi = 'KOMPETEN';
            }else{
                $rekomendasi = 'BELUM KOMPETEN';
            }
            //var_dump($data);
            $this->db->where('id',$data->skema_sertifikasi);
            $data_skema = $this->db->get(kode_tbl().'skema')->row();
            $skema = $data_skema->skema;
            $this->db->where('id_skema',$data->skema_sertifikasi);
            $jumlah_unit = count($this->db->get(kode_tbl().'skema_detail')->result());
            $this->load->model('jadwal_asesmen_model');
            $unit_kompetensi = $this->jadwal_asesmen_model->unit_kompetensi('4');
            var_dump($unit_kompetensi);
            $array_hasil_bk = unserialize('a:6:{i:3;s:2:"BK";i:5;s:2:"BK";i:6;s:2:"BK";i:7;s:2:"BK";i:8;s:2:"BK";i:9;s:2:"BK";}');
            //$array_hasil_bk = unserialize($value_bk->mak04);

            $view = $this->load->view('berita_acara/format_email_bk', array(
                'tanggal' => tgl_indo(date('Y-m-d')),
                'tanggal_uji' => tgl_indo(date('Y-m-d')),
                'nama_lengkap' => $nama_lengkap,
                'data' => $data,
                'nama' => $nama,
                'skema' => $skema,
                'jumlah_unit' => $jumlah_unit,
                'rekomendasi' => $rekomendasi,
                'src_ttd' => base_url().'uploads/src_ttd.jpg',
                'tanggal_uji' => 'Surabaya, '.tgl_indo(date('Y-m-d')),
                'tuk' => 'NAMA TUK',
                                                    'unit_kompetensi'=>$unit_kompetensi,
                                                    'array_hasil_bk'=>$array_hasil_bk
                //'url' => base_url() . 'siswa/edit_upload/' . $id
                ));
            //echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        } else {
            echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
        }
    }
}
