<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Soal extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('soal_model');
       // $this->load->model('User_Model');
        //$this->load->model('artikel_model');
       // $this->load->model('Sertifikasi_Model');
        //$this->load->library('pagination');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'soal_model', 'controller' => 'soal', 'options' => array('id' => 'soal', 'pagination', 'rownumber')))->load_model()->set_grid();
            $view = $this->load->view('soal/index', array('grid' => $grid), true);
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

            //if($jenis_user == 2){
            //    $user_id = $this->auth->get_user_data()->id;
            //    $where['author ='] = $user_id;
            //}
            if(isset($_POST['nama_perangkat']) && !empty($_POST['nama_perangkat']))
            {
                $where['nama_perangkat like'] = '%' . $this->input->post('nama_perangkat') . '%';
            }


            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->soal_model->count_by($where) : $this->soal_model->count_all();
            $this->soal_model->limit($row, $offset);
            $order = $this->soal_model->get_params('_order');
            //$rows = isset($where) ? $this->soal_model->order_by($order)->get_many_by($where) : $this->soal_model->order_by($order)->get_all();
            $rows = $this->soal_model->set_params($params)->with(array('master_perangkat_detail','master_unit_kompetensi'));
            $data['rows'] = $this->soal_model->get_selected()->data_formatter($rows);
            //var_dump($data['rows']);
            echo json_encode($data);
        } else {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$jawaban_benar = isset($_POST['jawaban_benar']) ? $_POST['jawaban_benar'] : ''; ;
			


            $data = $this->soal_model->set_validation()->validate();
            $data['jawaban_benar'] = $jawaban_benar[0];
            //var_dump($data); die();
            if ($data !== false) {
				//var_dump($data); die();
                if ($this->soal_model->check_unique($data)) {
                    if ($this->soal_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->soal_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $this->load->model('skema_model');
            $skema = $this->skema_model->dropdown('id', 'skema');
             $this->load->library('combogrid');
                $perangkat = $this->combogrid->set_properties(array(
                  'model' => 'perangkat_asesmen_detail_model',
                  'controller' => 'perangkat_asesmen_detail',
                  'fields' => array('no_perangkat_detail', 'perangkat_detail'),
                  'options' => array('id' => 'id_perangkat_detail', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'perangkat_detail', 'panelWidth' => 500)))->load_model()->set_grid();
                $unit = $this->combogrid->set_properties(array(
                    'model' => 'unit_model',
                    'controller' => 'unit',
                    'fields' => array('id_unit_kompetensi', 'unit_kompetensi'),
                    'options' => array('id' => 'id_unit_kompetensi', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'id_unit_kompetensi', 'panelWidth' => 500)))->load_model()->set_grid();

            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('soal/add2', array('skema_perangkat'=>$skema,'perangkat'=>$perangkat,'unit'=>$unit,'jenis_soal'=>array('-','Pilihan Ganda','Essay','Menjodohkan')), TRUE)));
        }
    }

    function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->soal_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->soal_model->check_unique($data, intval($id))) {
                     $post_bukti = $this->input->post('bukti_pendukung');
                    $data['bukti_pendukung'] =str_replace('|', '"', $post_bukti);

                    if ($this->soal_model->update(intval($id), $data) !== false) {
                        $sms = isset($_POST['kirim_notifikasi']) ? $this->input->post('kirim_notifikasi') : "";
                        $akses_login = isset($_POST['akses_login']) ? $this->input->post('akses_login') : "";

                        if($akses_login != ""){
                            $nama_lengkap = $this->input->post('nama_lengkap');
                            $email = $this->input->post('email');
                            $hp = $this->input->post('telp');
                            $nama =   str_replace(' ','',strtolower($nama_lengkap));
                            if(strlen($nama) > 4){
                                $datax['akun'] =  substr($nama, 0, 4).rand(1,9999);
                            }else{
                                $datax['akun'] =  $nama.rand(1,9999);
                            }


                            $datax['email'] = $email ;
                            $datax['hp'] = $hp ;
                            $datax['nama_user'] = $nama_lengkap ;
                            $datax['jenis_user'] = '1' ;
                            $datax['sandi'] = '123456' ;
                            $datax['sandi_asli'] = '123456' ;
                            $datax['aktif'] = '1' ;
                            $datax['pegawai_id'] = $id ;

                            $this->load->model('User_Model');
                            $this->User_Model->insert($datax);
                            $user_id= $this->db->insert_id();

                            $datay['user_id'] = $user_id;
                            $datay['role_id'] = 17;
                            $this->load->model('User_Role_Model');
                            $this->User_Role_Model->insert($datay);

                            //if($jenis_user == '1'){
                                //$id_users = $this->db->insert_id();
                                $dataxy = array(
                                               'id_users' => $user_id
                                            );
                                $this->db->where('id', $id);
                                $this->db->update(kode_tbl().'soal', $dataxy);

                            //}

                            $checked = $this->input->post('pra_asesmen_checked');
                            $this->sms($nama_lengkap,$checked,$user_id);
                        }

                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->soal_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $soal = $this->soal_model->get(intval($id));
            if (sizeof($soal) == 1) {
                $data_aplikasi = $this->db->get('r_konfigurasi_aplikasi')->row();
               $this->load->model('skema_model');
            $skema = $this->skema_model->dropdown('id', 'skema');
             $this->load->library('combogrid');
                $perangkat = $this->combogrid->set_properties(array('model' => 'perangkat_asesmen_detail_model', 'controller' => 'perangkat_asesmen_detail', 'fields' => array('no_perangkat_detail', 'perangkat_detail'), 'options' => array('id' => 'id_perangkat_detail', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'perangkat_detail', 'panelWidth' => 500)))->load_model()->set_grid();
                $unit = $this->combogrid->set_properties(array('model' => 'unit_model', 'controller' => 'unit', 'fields' => array('id_unit_kompetensi', 'unit_kompetensi'), 'options' => array('id' => 'id_unit_kompetensi', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'id_unit_kompetensi', 'panelWidth' => 500)))->load_model()->set_grid();
                $view = $this->load->view('soal/edit', array('data' => $this->soal_model->get_single($soal),'skema_perangkat'=>$skema,'perangkat'=>$perangkat,'unit'=>$unit,'jenis_soal'=>array('-','Cheklist Observasi','Wawancara','Test Tulis'),'url' => base_url() . 'soal/edit_upload/' . $id), TRUE);
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
            $roles = $this->soal_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->soal_model->delete(intval($id))) {
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
    function combogrid($segmen = false,$id = false)
    {
        //$this->load->model('soal_model');
        $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows')) ;
        $page = intval($this->input->post('page'))== 0 ? 1 : intval($this->input->post('page'));
        $offset = $row * ($page - 1);
        $data = array();
        $params = array('_return'=>'data');
        if(isset($_POST['q']))
        {
            $where['nama_lengkap LIKE'] = "%" . $this->input->post('q') . "%";
        }
        if($segmen != false)
        {
            $where['id_users IS NULL AND id !='] = "";
        }

        if(isset($where)) $params['_where'] = $where;
        $data['total'] = isset($where) ? $this->soal_model->count_by($where) : $this->soal_model->count_all();
        $this->soal_model->limit($row, $offset);
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
            $order = $this->soal_model->get_params('_order');
        }
        $rows = isset($where) ? $this->soal_model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->soal_model->order_by($order, $order_criteria, $_order_escape)->get_all();
        $data['rows'] = $this->soal_model->get_selected()->data_formatter($rows);
        //var_dump($data);
        echo json_encode($data);
    }
    function cetak($id,$type = "pdf") {
        ini_set('memory_limit', '51208M');
        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
        $soal = $this->soal_model->data_soal($id);
        $data['data_soal'] = $soal;
        $unit_kompetensi = $this->soal_model->data_unit_kompetensi($soal->skema_sertifikasi);
        $data['unit_kompetensi'] = $unit_kompetensi;
        $soal_detail = $this->soal_model->soal_detail($id);
        $data['soal_detail'] = $soal_detail;

        $kode_unit = '';
        $unit = '';
        $elemen_kuk ="";
        $unit_mak ="";
        //var_dump($unit_kompetensi);die();
        foreach($unit_kompetensi as $key=>$value){
            $kode_unit.=($key+1).'. '.$value->id_unit_kompetensi.'<br/>';
            $unit.=($key+1).'. '.$value->unit_kompetensi.'<br/>';
            $query_elemen = $this->soal_model->elemen($value->id_unit_kompetensi);
            $detail_elemen = "";
            if(count($query_elemen) > 0){
            foreach($query_elemen as $keys=>$values){
               $query_kuk = $this->soal_model->kuk($values->id);
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
        foreach($soal_detail as $key=>$value){
            $jenis_bukti[]=$value->jenis_bukti;
        }
        $bukti = unserialize($soal->bukti_pendukung);
        $jenis_bukti = implode(',',$bukti);
        $data['jenis_bukti'] = $jenis_bukti;
        $data['kode_unit'] = $kode_unit;
        $data['unit'] = $unit;
        $data['msg'] = $soal->nama_lengkap."\r\n\n\n".$data['aplikasi']->url_aplikasi."/qrcode/soal/".$id;

        $view = $this->load->view('soal/cetak_soal',$data , true);
        if($type=="pdf") {
            $this->load->library("htm12pdf");
            $this->htm12pdf->pdf_create($view, "data_soal" . date('YmdHis') . ".pdf", false, true);

        }
    }
    function cetak_pencarian($par1="",$par2="",$par3="",$type = "pdf") {
        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
        $this->db->select('a.*,b.skema');
        $this->db->from(kode_tbl().'soal a');
        $this->db->join(kode_tbl().'skema b','a.skema_sertifikasi=b.id');
        if($par1 != "" && $par1 != "nama_lengkap"){
            $this->db->like('nama_lengkap', $par1);
        }
        if($par2 != "" && $par1 == "nama_lengkap"){
            $this->db->where('u_date_create BETWEEN "'.$par2. '" and "'.$par3.'"');
        }
        if($par2 != "" && $par1 != "nama_lengkap"){
            $this->db->where('u_date_create BETWEEN "'.$par2. '" and "'.$par3.'"');
            $this->db->like('nama_lengkap', $par1);
        }
        $data['data_soal'] = $this->db->get()->result();
        $view = $this->load->view('soal/cetak_pencarian_soal',$data , true);
        if($type=="pdf") {
            $this->load->library("htm12pdf");
            $this->htm12pdf->pdf_create($view, "data_soal" . date('YmdHis') . ".pdf", false, true,'L');

        }
    }
    function search() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->model('soal_model');
            $view = $this->load->view('soal/search', array(), TRUE);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));

        } else {
            block_access_method();
        }
    }
     function sms($nama_lengkap,$checked,$users){
        $pesan = 'Anda Mendapat Tugas untuk memeriksa Dokumen pra asesmen atas nama '.$nama_lengkap;

        $this->db->where('id',$checked);
        $row = $this->db->get('t_users')->row();

        $data['sender_id'] = 1;
        $data['reciepent_id'] = $checked ;
        $data['title'] = 'Tugas Check Pra Asesmen' ;
        $data['message'] = $pesan ;

        $this->load->model('Pesan_Model');
        $this->Pesan_Model->insert($data);
        smssend($row->hp,$pesan);


        $this->db->where('id',$users);
        $row = $this->db->get('t_users')->row();
        $username = $row->akun;
        $password = $row->sandi_asli;
        //var_dump($password);die();
        $admin = $this->db->get('r_konfigurasi_aplikasi')->row();
        $pesan = 'Login '.$admin->url_aplikasi.' User:'.$username.' Pass:'.$password;
        $data['sender_id'] = $this->auth->get_user_data()->id;
        $data['reciepent_id'] = $users ;
        $data['title'] = 'Akses Login Aplikasi Sertifikasi Online' ;
        $data['message'] = $pesan ;

        $this->load->model('Pesan_Model');
        $this->Pesan_Model->insert($data);
        $hasil = smssend($row->hp,$pesan);
    }

    function email() {
            $data = $this->db->get('r_konfigurasi_aplikasi')->row();
            $this->load->library('email');
            $this->email->from($data->alamat_email, 'Sekretariat '.$data->singkatan_unit);
            $this->email->to('buana_roy@yahoo.co.id');

            $this->email->subject($data->singkatan_unit);
            $pesan = 'OKOK';

            $this->email->message($pesan);

            if ($this->email->send()) {
                echo 'ok';
            } else {
                echo 'nok';
            }
            //echo $this->email->print_debugger();
    }

    function view($id=0,$offset=0){
        $data['marquee'] = $this->artikel_model->marquee();

        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();

        $keyword=$this->input->get('keyword');
        if($keyword==""){
            $offset = $this->uri->segment(4);
            //$this->db->where('a.*,c.skema');
            $this->db->where('terbitkan_sertifikat','on');
            //$this->db->from(kode_tbl().'soal a');
            $jml = $this->db->get(kode_tbl().'soal a');
            $data['jmldata'] = $jml->num_rows();
            //pengaturan pagination
            $config['enable_query_strings'] = true;
            $config['base_url'] = base_url().'soal/view/'.$id;
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
            $data['data'] = $this->Sertifikasi_Model->get_all_soal($config['per_page'],$offset);
        }else{
            $offset = $this->uri->segment(3);

            $this->db->like('a.nama_lengkap', $keyword);
            $this->db->where('terbitkan_sertifikat','on');
            $jml = $this->db->get(kode_tbl().'soal a');

            $data['jmldata'] = $jml->num_rows();

                    //pengaturan pagination
            $config['enable_query_strings'] = true;
            if(!empty($keyword)){
                $config['suffix'] = "?keyword=".$keyword;
            }

            $config['base_url'] = base_url().'soal/view/'.$id;
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
            $data['data'] = $this->Sertifikasi_Model->get_all_soal($config['per_page'],$offset,$keyword);
        }
        $this->load->view('templates/bootstraps/header',$data);
        $this->load->view('sertifikasi/vsoal',$data);
        $this->load->view('templates/bootstraps/bottom');
    }
    function upload() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = $this->soal_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->soal_model->check_unique($data)) {
                    if (isset($_FILES['fileToUpload']['tmp_name']) && !empty($_FILES['fileToUpload']['tmp_name'])) {
                        $data['file_soal'] = 'soal'.date('Y-m-d').str_replace(' ', '_', $_FILES['fileToUpload']['name']);
                        $config['upload_path'] = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/files/soal/';
                        $config['allowed_types'] = '*';
                        $config['max_size'] = '512000000';
                        $config['file_name'] = $data['file_soal'];

                        $this->load->library('upload', $config);

                        if (!$this->upload->do_upload('fileToUpload')) {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => $this->upload->display_errors()));
                            exit();
                        }
                    } else {
                        $data['file_soal'] = "";
                    }

                    if ($this->soal_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", strip_tag($this->soal_model->get_validation()))));
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
                $docs = $this->soal_model->get(intval($id));
                if(sizeof($docs) == 1)
                {
                    $doc = $this->soal_model->get_single($docs);
                    $files = substr(__dir__,0, strpos( __dir__,"application")) . 'assets/files/soal/' . $doc->file_perangkat;
                    if(file_exists($files))
                    {
                        header('Cache-Control: public');
                        header('Content-Disposition: attachment; filename="' . $doc->file_perangkat . '"');
                        readfile($files);
                        //$this->db->query("UPDATE t_repositori SET jumlah_download=jumlah_download+1 WHERE id= $id");
                        //
                        //redirect(base_url());
                        die();
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
    function edit_upload($id = false){
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->soal_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->soal_model->check_unique($data, intval($id))) {
                    if (isset($_FILES['fileToUpload']['tmp_name']) && !empty($_FILES['fileToUpload']['tmp_name'])) {
                        $schedule = $this->soal_model->get(intval($id));
                        $data['file_soal'] = rand() . '_' . str_replace(' ', '_', $_FILES['fileToUpload']['name']);
                        $config['upload_path'] = substr(__dir__,0, strpos( __dir__,"application")) . 'assets/files/soal/';
                        $config['allowed_types'] = '*';
                        $config['file_name'] = $data['file_soal'];
                        $config['max_size'] = '0';

                        $this->load->library('upload', $config);

                        if ($this->upload->do_upload('fileToUpload')) {
                            $current_file = substr(__dir__,0, strpos( __dir__,"application")) . 'assets/files/soal/' . $schedule->file_soal;
                            if(is_file($current_file)){
                                unlink($current_file);
                            }

                        }else {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => strip_tags($this->upload->display_errors())));
                            exit();
                        }
                    }else{
                        $data['file_soal'] = $this->input->post('foto_hidden');

                    }
                    if ($this->soal_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->soal_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        }
    }
    
	function get_unit(){
		$id = $this->input->post('id');
		$perangkat_asesmen_detail = kode_tbl().'perangkat_asesmen_detail';
		$perangkat_asesmen = kode_tbl().'perangkat_asesmen';

		$row_perangkat = $this->db->query("SELECT b.skema_perangkat
			FROM $perangkat_asesmen_detail a
			JOIN $perangkat_asesmen b ON a.id_perangkat_asesmen=b.id
			WHERE a.id=$id")->row();
		$this->db->select('b.id,b.unit_kompetensi');
		$this->db->from(kode_tbl().'skema_detail a');
		$this->db->join(kode_tbl().'unit_kompetensi b','a.id_unit_kompetensi=b.id');
		$this->db->where('id_skema',$row_perangkat->skema_perangkat);
		$data = $this->db->get()->result();
		echo json_encode($data);
	}    
}
