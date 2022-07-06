<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Real_asesmen extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('real_asesmen_model');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'real_asesmen_model', 'controller' => 'real_asesmen', 'options' => array('id' => 'real_asesmen', 'pagination', 'rownumber')))->load_model()->set_grid();
            $view = $this->load->view('real_asesmen/index', array('grid' => $grid), true);
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
                $where[kode_tbl().'asesi.id_tuk ='] = $asesi_id;
            }else if($jenis_user == 1){
                $asesi_id = $this->auth->get_user_data()->id;
                $where[kode_tbl().'asesi.id_users ='] = $asesi_id;
            }

            if(isset($_POST['nama_lengkap']) && !empty($_POST['nama_lengkap']))
            {
                $where['nama_lengkap like'] = '%' . $this->input->post('nama_lengkap') . '%';
            }

            $where['pra_asesmen ='] = '1';
            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->real_asesmen_model->count_by($where) : $this->real_asesmen_model->count_all();
            $this->real_asesmen_model->limit($row, $offset);
            $order = $this->real_asesmen_model->get_params('_order');
            $rows = $this->real_asesmen_model->set_params($params)->with(array('skema','user','jadwal_asesmen','tuk','asesor'));
            $data['rows'] = $this->real_asesmen_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        } else {
            block_access_method();
        }
    }

    function search() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            //$this->load->model('pra_asesmen_model');
            $this->load->library('combogrid');
                $users = $this->combogrid->set_properties(array('model'=>'real_asesmen_model', 'controller'=>'combo_pra_asesmen', 'fields'=>array('nama_user','email','jenis_user'), 'options'=>array('id'=>'pra_asesmen_checked', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama_user', 'panelWidth'=>500,
                    'queryParams'=>array('name'=>'easui')
                    )))->load_model()->set_grid();

            $view = $this->load->view('real_asesmen/search', array('pra_asesmen_grid' => $users), TRUE);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));

        } else {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->real_asesmen_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->real_asesmen_model->check_unique($data)) {
                    if ($this->real_asesmen_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->real_asesmen_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('asesi/add', array('real_asesmen' => array('-Pilih-', 'Lanjut', 'Tidak Lanjut')), TRUE)));
        }
    }

     function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->real_asesmen_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->real_asesmen_model->check_unique($data, intval($id))) {
                    if ($this->real_asesmen_model->update(intval($id), $data) !== false) {
                        $sms = isset($_POST['notifikasi']) ? $this->input->post('notifikasi') : "";
                         if($sms != ""){
                             $nama_lengkap = $this->input->post('nama_lengkap');
                             $telp = $this->input->post('telp');
                             $id_users = $this->input->post('id_users');

                             $this->sms($nama_lengkap,$telp,$id_users);
                         }
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->real_asesmen_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $asesi = $this->real_asesmen_model->get(intval($id));
            //$this->db->where()
            $pra_asesmen_checked = $this->real_asesmen_model->pra_asesmen_checked($asesi->pra_asesmen_checked);
            $checked = $pra_asesmen_checked->nama_user;
            $id_checked = $pra_asesmen_checked->pegawai_id;

            if($pra_asesmen_checked->jenis_user == 2){
                $kategori_checked = 'Asesor';
            }else if($pra_asesmen_checked->jenis_user == 3){
                $kategori_checked = 'TUK';
            }else{
                $kategori_checked = 'Administrator';
            }

            //var_dump($pra_asesmen_checked);
            //die();
            if (sizeof($asesi) == 1) {
                $data = $this->real_asesmen_model->get_single($asesi);
                $this->load->library('combogrid');
                $jadwal_grid = $this->combogrid->set_properties(array('model' => 'jadwal_asesmen_model', 'controller' => 'jadwal_asesmen', 'fields' => array('jadual', 'tanggal'), 'options' => array('id' => 'jadwal_id', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'jadual', 'panelWidth' => 500)))->load_model()->set_grid();
                $asesor_grid = $this->combogrid->set_properties(array('model' => 'asesor_model', 'controller' => 'asesor', 'fields' => array('users', 'no_reg'), 'options' => array('id' => 'id_asesor', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'users', 'panelWidth' => 500)))->load_model()->set_grid();
                $tuk_grid = $this->combogrid->set_properties(array('model' => 'tuk_model', 'controller' => 'tuk', 'fields' => array('tuk', 'alamat'), 'options' => array('id' => 'id_tuk', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'tuk', 'panelWidth' => 500)))->load_model()->set_grid();
                $jenis_user = $this->auth->get_user_data()->jenis_user;
                if($jenis_user == 3){
                    if($data->jadwal_id == "0" || empty($data->jadwal_id)){
                        $this->load->model('jadwal_asesmen_model');
                        $id_tuk = $this->auth->get_user_data()->pegawai_id;
                        $jadwal = $this->jadwal_asesmen_model->get_jadwal_tuk($id_tuk);
                        //var_dump($id_tuk);
                        $id_jadwal = $jadwal->id;
                        $jadual = $jadwal->jadual;

                    }else{
                        $this->load->model('jadwal_asesmen_model');
                        $jadwal = $this->jadwal_asesmen_model->get_jadwal_isi($data->jadwal_id);
                        //var_dump($jadwal);
                        $id_jadwal = $jadwal->id;
                        $jadual = $jadwal->jadual;
                    }
                }else{
                        $id_jadwal = "";
                        $jadual = "";
                }
                //var_dump($jadwal);
                $view = $this->load->view('real_asesmen/edit', array('data' => $this->real_asesmen_model->get_single($asesi)
                ,'checked' => $checked
                ,'id_checked' => $id_checked
                ,'kategori_checked' => $kategori_checked
                ,'jadwal_grid' => $jadwal_grid
                ,'asesor_grid' => $asesor_grid
                ,'tuk_grid' => $tuk_grid,
                'jadual' => $jadual,
                'id_jadual' => $id_jadwal
                ), TRUE);
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
            $data = $this->real_asesmen_model->set_validation()->validate();

            if ($data !== false) {
                if ($this->real_asesmen_model->check_unique($data, intval($id))) {
                    if (isset($_FILES['fileToUpload']['tmp_name']) && !empty($_FILES['fileToUpload']['tmp_name'])) {
                        $siswa = $this->real_asesmen_model->get(intval($id));
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
                    if ($this->real_asesmen_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->real_asesmen_model->get_validation())));
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
            $roles = $this->real_asesmen_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->real_asesmen_model->delete(intval($id))) {
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
        $this->load->model('v_real_asesmen_model');
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
        $data['total'] = isset($where) ? $this->v_real_asesmen_model->count_by($where) : $this->v_real_asesmen_model->count_all();
        $this->v_real_asesmen_model->limit($row, $offset);
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
            $order = $this->v_real_asesmen_model->get_params('_order');
        }
        $rows = isset($where) ? $this->v_real_asesmen_model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->v_real_asesmen_model->order_by($order, $order_criteria, $_order_escape)->get_all();
        $data['rows'] = $this->v_real_asesmen_model->get_selected()->data_formatter($rows);
        //var_dump($data);
        echo json_encode($data);
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
    function sms($nama_lengkap,$telp,$id_users){
        //var dt = {id_users:id_users,rekomendasi:rekomendasi,pra_asesmen_description:pra_asesmen_description};
            $datax['sender_id'] = 1;
            $datax['reciepent_id'] = $id_users ;
            $datax['title'] = 'Jadwal Uji Kompetensi' ;
            $datax['message'] = 'Anda telah di jadwalkan untuk Uji Kompetensi. Silahkan cek aplikasi online' ;

            $this->load->model('Pesan_Model');
            $this->Pesan_Model->insert($datax);
            return smssend($telp,$datax['message']);
        //return smssend($row->hp,$pesan);
    }
    function generate_number(){
        $id = $this->input->post('id');
        $jadwal = kode_tbl().'jadual_asesmen';
        $asesi = kode_tbl().'asesi';
        $data = $this->db->query("SELECT
        DATE_FORMAT(a.tanggal,'%m-%Y') as tanggal
         FROM $jadwal a
        WHERE a.id=$id")->row();
        $data_asesi = $this->db->query("SELECT count(a.id) as total
            FROM $asesi a
            WHERE a.jadwal_id =  $id
            ")->row();

        $prefix = "UJK-".$id."-";
        $digits = 3;
        $start = $data_asesi->total + 1;

        for ($i = $start; $i < $start + 1; $i++) {
            $result = str_pad($i, $digits, "0", STR_PAD_LEFT);
        }
        $no = $prefix.$result;

        echo $no.'-'.$data->tanggal;
    }

}
