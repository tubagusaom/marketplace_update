<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Administrasi_ujk extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('administrasi_ujk_model');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'administrasi_ujk_model', 'controller' => 'administrasi_ujk', 'options' => array('id' => 'administrasi_ujk_grid', 'pagination', 'rownumber')))->load_model()->set_grid();
            $view = $this->load->view('administrasi_ujk/index', array('grid' => $grid), true);
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
            if($jenis_user == 2 || $jenis_user == 3){
                $asesi_id = $this->auth->get_user_data()->pegawai_id;
                $where['id_tuk ='] = $asesi_id;
            }else if($jenis_user == 1){
                $asesi_id = $this->auth->get_user_data()->id;
                $where['id_users ='] = $asesi_id;
            }
            $where['pra_asesmen ='] = '1';
            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->administrasi_ujk_model->count_by($where) : $this->administrasi_ujk_model->count_all();
            $this->administrasi_ujk_model->limit($row, $offset);
            $order = $this->administrasi_ujk_model->get_params('_order');
            $rows = $this->administrasi_ujk_model->set_params($params)->with(array('skema','user'));
            $data['rows'] = $this->administrasi_ujk_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        } else {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->administrasi_ujk_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->administrasi_ujk_model->check_unique($data)) {
                    if ($this->administrasi_ujk_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->administrasi_ujk_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('asesi/add', array('administrasi_ujk' => array('-Pilih-', 'Lanjut', 'Tidak Lanjut')), TRUE)));
        }
    }

    function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->administrasi_ujk_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->administrasi_ujk_model->check_unique($data, intval($id))) {
                    if ($this->administrasi_ujk_model->update(intval($id), $data) !== false) {

                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->administrasi_ujk_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $asesi = $this->administrasi_ujk_model->get(intval($id));
             if (sizeof($asesi) == 1) {
                $this->db->where('asesi_id',$id);
                $view = $this->load->view('administrasi_ujk/edit', array('data' => $this->administrasi_ujk_model->get_single($asesi),'administrasi_ujk' => array('-','Selesai','Belum Selesai','Kirim Invoice')
                ,'sumber_pendanaan' => array('-','Subsidi BNSP','Mandiri','Lain-lain')
                ,'metode_pembayaran' => array('-','Tunai','Transfer Bank'), 'url' => base_url() . 'administrasi_ujk/edit_upload/' . $id, 'id_hidden' => $id
                ), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            }else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
    }
    function edit_uploadX($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->administrasi_ujk_model->set_validation()->validate();

            if ($data !== false) {
                if ($this->administrasi_ujk_model->check_unique($data, intval($id))) {
                    if (isset($_FILES['fileToUpload']['tmp_name']) && !empty($_FILES['fileToUpload']['tmp_name'])) {
                        $siswa = $this->administrasi_ujk_model->get(intval($id));
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
                    if ($this->administrasi_ujk_model->update(intval($id), $data) !== false) {
                         $sms = isset($_POST['notifikasi']) ? $this->input->post('notifikasi') : "";
                         if($sms != ""){
                             $nama_lengkap = $this->input->post('nama_lengkap');
                             $telp = $this->input->post('telp');
                             $administrasi_ujk = $this->input->post('administrasi_ujk');
                             $id_users = $this->input->post('id_users');

                             $this->sms($nama_lengkap,$telp,$administrasi_ujk,$id_users);
                         }
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->administrasi_ujk_model->get_validation())));
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
            $data = $this->administrasi_ujk_model->set_validation()->validate();

            if ($data !== false) {
                if ($this->administrasi_ujk_model->check_unique($data, intval($id))) {
                    if (isset($_FILES['fileToUpload']['tmp_name']) && !empty($_FILES['fileToUpload']['tmp_name'])) {
                        $siswa = $this->administrasi_ujk_model->get(intval($id));
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
                    if ($this->administrasi_ujk_model->update(intval($id), $data) !== false) {
                         $sms = isset($_POST['notifikasi']) ? $this->input->post('notifikasi') : "";
                         if($sms != ""){
                             $nama_lengkap = $this->input->post('nama_lengkap');
                             $telp = $this->input->post('telp');
                             $administrasi_ujk = $this->input->post('administrasi_ujk');
                             $id_users = $this->input->post('id_users');
                             //$id_users = $this->input->post('administrasi_ujk');
                             $query = $this->administrasi_ujk_model->get_biaya($id);
                             $this->sms($nama_lengkap,$telp,$administrasi_ujk,$id_users,($query->biaya_skema + $id),$id);
                             $this->invoice($id,($query->biaya_skema + $id),$this->no_invoice($id));

                         }
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->administrasi_ujk_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        }
    }
    function invoice($id,$biaya_skema,$no_invoice){
        $jumlah_desimal ="0";
        $pemisah_desimal =",";
        $pemisah_ribuan =".";
        $data['asesi'] = $this->administrasi_ujk_model->get_asesi($id);
        //var_dump($data['asesi']);
        $biaya_skema = number_format($biaya_skema, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
        $data['biaya_skema']=$biaya_skema;
        $data['no_invoice']=$no_invoice;
        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
        $view = $this->load->view('administrasi_ujk/invoice',$data, true);
       //if($type=="pdf") {
            $this->load->library("htm12pdf");
            $this->htm12pdf->pdf_create($view, $no_invoice.".pdf", false, true);
        //

    }
    function delete($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $roles = $this->administrasi_ujk_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->administrasi_ujk_model->delete(intval($id))) {
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
        $this->load->model('v_administrasi_ujk_model');
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
        $data['total'] = isset($where) ? $this->v_administrasi_ujk_model->count_by($where) : $this->v_administrasi_ujk_model->count_all();
        $this->v_administrasi_ujk_model->limit($row, $offset);
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
            $order = $this->v_administrasi_ujk_model->get_params('_order');
        }
        $rows = isset($where) ? $this->v_administrasi_ujk_model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->v_administrasi_ujk_model->order_by($order, $order_criteria, $_order_escape)->get_all();
        $data['rows'] = $this->v_administrasi_ujk_model->get_selected()->data_formatter($rows);
        //var_dump($data);
        echo json_encode($data);
    }
    function view($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        $asesi = $this->administrasi_ujk_model->get(intval($id));
            if (sizeof($asesi) == 1) {
                $this->db->where('asesi_id',$id);
                $view = $this->load->view('administrasi_ujk/view', array('data' => $this->administrasi_ujk_model->get_single($asesi),'administrasi_ujk' => array('-','Selesai','Belum Selesai')
                ,'sumber_pendanaan' => array('-','Subsidi BNSP','Mandiri','Lain-lain')
                ,'metode_pembayaran' => array('-','Tunai','Transfer Bank'), 'url' => base_url() . 'administrasi_ujk/edit_upload/' . $id
                ), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
    }
     function sms($nama_lengkap,$telp,$administrasi_ujk,$id_users,$biaya_skema,$id){
        //var dt = {id_users:id_users,rekomendasi:rekomendasi,pra_asesmen_description:pra_asesmen_description};

        if($administrasi_ujk==1){
            $datax['sender_id'] = 1;
            $datax['reciepent_id'] = $id_users ;
            $datax['title'] = 'Lunas Biaya Administrasi' ;
            $datax['message'] = 'Terimakasih, Biaya administrasi sudah LUNAS. Anda akan di jadwalkan untuk Uji Kompetensi' ;

            $this->load->model('Pesan_Model');
            $this->Pesan_Model->insert($datax);
            smssend($telp,$datax['message']);
        }else if($administrasi_ujk==3){
            $datax['sender_id'] = 1;
            $datax['reciepent_id'] = $id_users ;
            $datax['title'] = 'Invoice LSP' ;
            $no_invoice=$this->no_invoice($id);

            $jumlah_desimal ="2";
            $pemisah_desimal =",";
            $pemisah_ribuan =".";

            $biaya_skema = number_format($biaya_skema, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);

            $datax['message'] = 'Invoice '.$no_invoice.'. Sebesar Rp. '.$biaya_skema.' untuk biaya Uji Kompetensi. Pembayaran melalui rekening LSP' ;

            $this->load->model('Pesan_Model');
            $this->Pesan_Model->insert($datax);
            smssend($telp,$datax['message']);
        }

        //return smssend($row->hp,$pesan);
    }
    function no_invoice($id){


        $prefix = "#INVOICE-";
        $digits = 6;
        $start = $id;

        for ($i = $start; $i < $start + 1; $i++) {
            $result = str_pad($i, $digits, "0", STR_PAD_LEFT);
        }
        $no = $prefix.$result;

        return $no;
    }
    function generate_number(){
        $id = $this->input->post('id');
        $query = $this->administrasi_ujk_model->get_biaya($id);
        //var_dump($query);
        echo ($query->biaya_skema + $id);
    }
}
