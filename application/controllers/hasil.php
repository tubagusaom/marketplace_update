<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hasil extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('hasil_model');
          $this->load->model('User_Model');
    }
    function show_file() {
        $nmfile = $this->input->get('nmfile');
        $extension = strtolower(substr($nmfile, -3));
        switch ($extension) {
            case "pdf":
            echo '<object type="application/pdf" data="' . base_url('assets/files/jawaban/' . $nmfile) . '" width="100%" height="600" style="height: 85vh;">No Support</object>';
            break;
            default:
            echo "<img src='" . base_url('assets/files/jawaban/' . $nmfile) . "' />";
            break;
        }
    }
    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'hasil_model', 'controller' => 'hasil', 'options' => array('id' => 'hasil', 'pagination', 'rows_number')))->load_model()->set_grid();
            $view = $this->load->view('hasil/index', array('grid' => $grid), true);
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

                $keyword = $this->input->get('keyword');
                if ($keyword == "") {
                        $offset = $this->uri->segment(4);

                        $this->db->where('id_asesor', $id_asesor);
                        $jml = $this->db->get('t_uji');
                        $data['jmldata'] = $jml->num_rows();
                        //pengaturan pagination
                        $config['enable_query_strings'] = true;
                        $config['base_url'] = base_url() . 'hasil/index_asesor/' . $id;
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
                        $data['data'] = $this->hasil_model->index($config['per_page'], $offset, $id_asesor);
                } else {
                        $offset = $this->uri->segment(3);
                        
                        $this->db->select('a.*, b.nama_lengkap');
                        $this->db->from('t_uji a');
                        $this->db->join(kode_tbl().'asesi b', 'a.id_asesi = b.id');                        
                        $this->db->where('a.id_asesor', $id_asesor);                                                
                        $this->db->like('b.nama_lengkap', $keyword);         
                        $jml = $this->db->get();

                        $data['jmldata'] = $jml->num_rows();

                        //pengaturan pagination
                        $config['enable_query_strings'] = true;
                        if (!empty($keyword)) {
                                $config['suffix'] = "?keyword=" . $keyword;
                        }

                        $config['base_url'] = base_url() . 'hasil/index_asesor/' . $id;
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
                        $data['data'] = $this->hasil_model->index($config['per_page'], $offset, $id_asesor, $keyword);
                }             
                
                //var_dump($data['data']); die();
                $this->load->view('templates/responsive/header', $data);
                $this->load->view('hasil/index_asesor', $data);
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
            //            var_dump($jenis_user);
            if($jenis_user == 1){
                $user_id = $this->auth->get_user_data()->pegawai_id;
                $where['id_asesi ='] = $user_id;
            }else if($jenis_user == 2){
            	$user_id = $this->auth->get_user_data()->pegawai_id;
                $where['t_uji.id_asesor ='] = $user_id;
            }
            if(isset($_POST['nama_lengkap']) && !empty($_POST['nama_lengkap']))
            {
                $where['nama_lengkap like'] = '%' . $this->input->post('nama_lengkap') . '%';
            }
             if(isset($_POST['no_identitas']) && !empty($_POST['no_identitas']))
            {
                $where['no_identitas like'] = '%' . $this->input->post('no_identitas') . '%';
            }
            if(isset($_POST['no_uji_kompetensi']) && !empty($_POST['no_uji_kompetensi']))
            {
                $where['no_uji_kompetensi like'] = '%' . $this->input->post('no_uji_kompetensi') . '%';
            }
            if(isset($_POST['from_time']) && !empty($_POST['from_time']))
            {
                $from_time = mysql_date($this->input->post('from_time'));
                $to_time = mysql_date($this->input->post('to_time')); 
                $where['u_date_create BETWEEN "'.$from_time.'" AND'] = $to_time;
            }
            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->hasil_model->count_by($where) : $this->hasil_model->count_all();
            $this->hasil_model->limit($row, $offset);
            $order = $this->hasil_model->get_params('_order');
            //$rows = isset($where) ? $this->hasil_model->order_by($order)->get_many_by($where) : $this->hasil_model->order_by($order)->get_all();
            $rows = $this->hasil_model->set_params($params)->with(array('asesi','asesor','skema','perangkat_detail'));
            $data['rows'] = $this->hasil_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        } else {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->hasil_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->hasil_model->check_unique($data)) {
                    if ($this->hasil_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->hasil_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $this->load->library('combogrid');
            $users = $this->combogrid->set_properties(array('model'=>'User_Model', 'controller'=>'users', 'fields'=>array('nama_user','email'), 'options'=>array('id'=>'user_id', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama_user', 'panelWidth'=>400)))->load_model()->set_grid();
    
            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('hasil/add', array('pra_asesmen' => array('-Pilih-', 'Lanjut', 'Tidak Lanjut'),'pra_asesmen_checked' => $users), TRUE)));
        }
    }

    function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->hasil_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->hasil_model->check_unique($data, intval($id))) {
                    $post_bukti = $this->input->post('jawaban_asesi');
                    $data['jawaban_asesi'] =str_replace('|', '"', $post_bukti);

                    if ($this->hasil_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->hasil_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {

            $hasil = $this->hasil_model->get(intval($id));

            $this->db->where('id_perangkat_detail',$hasil->id_perangkat_detail);
            $soal = $this->db->get(kode_tbl().'soal')->result();
            $this->load->model('perangkat_asesmen_detail_model');
            $this->load->model('perangkat_asesmen_model');

            $perangkat = $this->perangkat_asesmen_detail_model->get(intval($hasil->id_perangkat_detail));   

           // $detail_perangkat = $this->perangkat_asesmen_model->detail_soal($hasil->id_perangkat_detail);

            //$this->db->where()
            //var_dump($perangkat->jenis_perangkat);
            if($perangkat->jenis_perangkat == '6'){
                $view_file = 'hasil/edit_portofolio';
                $jawaban_yang_benar = "";
                


                $perangkat_asesmen = $this->perangkat_asesmen_model->get(intval($perangkat->id_perangkat_asesmen));
            //var_dump($perangkat);
                $kuk = $this->uji_kompetensi_skema($perangkat_asesmen->skema_perangkat,$soal,$hasil);
            //var_dump($kuk);
            }else if($perangkat->jenis_perangkat == '4'){
                $view_file = 'hasil/edit_wawancara';
                 $perangkat_asesmen = $this->perangkat_asesmen_model->get(intval($perangkat->id_perangkat_asesmen));
                $kuk = '';
                $jawaban_yang_benar = "";
                //var_dump('expression');
            }else{
                $view_file = 'hasil/edit';
                $kuk= "";
                //var_dump($perangkat);
                foreach ($soal as $key => $value) {
                    if($value->jawaban_a==$value->jawaban_benar){
                        $jawaban_yang_benar[] ='A'; 
                    //$jawaban_peserta[] = 
                    }elseif($value->jawaban_b==$value->jawaban_benar){
                        $jawaban_yang_benar[] ='B';
                    }elseif($value->jawaban_c==$value->jawaban_benar){
                        $jawaban_yang_benar[] ='C';
                    }elseif($value->jawaban_d==$value->jawaban_benar){
                        $jawaban_yang_benar[] ='D';
                    }else{
                        $jawaban_yang_benar[] ='E';
                    }
                }

                
            }  
            $hasil->jawaban_asesi =str_replace('"', '|', $hasil->jawaban_asesi); 
            $hasil->file_jawaban =str_replace('"', '|', $hasil->file_jawaban);
            if (sizeof($hasil) == 1) {
                $view = $this->load->view($view_file, array('data' => $this->hasil_model->get_single($hasil),'soal'=>$soal,'jawaban_yang_benar'=>$jawaban_yang_benar,'koreksi_asesor' => array('-','Y','N'),'kuk'=>$kuk), TRUE);
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
            $roles = $this->hasil_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->hasil_model->delete(intval($id))) {
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
        //$this->load->model('hasil_model');
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
        $data['total'] = isset($where) ? $this->hasil_model->count_by($where) : $this->hasil_model->count_all();
        $this->hasil_model->limit($row, $offset);
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
            $order = $this->hasil_model->get_params('_order');
        }       
        $rows = isset($where) ? $this->hasil_model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->hasil_model->order_by($order, $order_criteria, $_order_escape)->get_all();
        $data['rows'] = $this->hasil_model->get_selected()->data_formatter($rows);
        //var_dump($data);
        echo json_encode($data);
    }
    function cetak($id,$type = "pdf") {
        ini_set('memory_limit', '51208M');
        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
        $hasil = $this->hasil_model->data_hasil($id);
        $data['data_hasil'] = $hasil;
        $unit_kompetensi = $this->hasil_model->data_unit_kompetensi($hasil->skema_sertifikasi);
        $data['unit_kompetensi'] = $unit_kompetensi;
        $hasil_detail = $this->hasil_model->hasil_detail($id);
        $data['hasil_detail'] = $hasil_detail;
            
        $kode_unit = '';
        $unit = '';
        $elemen_kuk ="";
        $unit_mak ="";
        //var_dump($unit_kompetensi);die();
        foreach($unit_kompetensi as $key=>$value){
            $kode_unit.=($key+1).'. '.$value->id_unit_kompetensi.'<br/>';
            $unit.=($key+1).'. '.$value->unit_kompetensi.'<br/>';
            $query_elemen = $this->hasil_model->elemen($value->id_unit_kompetensi);
            $detail_elemen = "";
            if(count($query_elemen) > 0){
            foreach($query_elemen as $keys=>$values){
               $query_kuk = $this->hasil_model->kuk($values->id);
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
        foreach($hasil_detail as $key=>$value){
            $jenis_bukti[]=$value->jenis_bukti;        
        }
        $bukti = unserialize($hasil->bukti_pendukung);
        $jenis_bukti = implode(',',$bukti);
        $data['jenis_bukti'] = $jenis_bukti;
        $data['kode_unit'] = $kode_unit;
        $data['unit'] = $unit;
        $data['msg'] = $hasil->nama_lengkap."\r\n\n\n".$data['aplikasi']->url_aplikasi."/qrcode/hasil/".$id;
        
        $view = $this->load->view('hasil/cetak_hasil',$data , true);
        if($type=="pdf") {
            $this->load->library("htm12pdf");
            $this->htm12pdf->pdf_create($view, "data_hasil" . date('YmdHis') . ".pdf", false, true);
           
        }
    }
    function cetak_pencarian($par1="",$par2="",$par3="",$type = "pdf") {
        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
        $this->db->select('a.*,b.skema');
        $this->db->from(kode_tbl().'hasil a');
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
        $data['data_hasil'] = $this->db->get()->result();
        $view = $this->load->view('hasil/cetak_pencarian_hasil',$data , true);
        if($type=="pdf") {
            $this->load->library("htm12pdf");
            $this->htm12pdf->pdf_create($view, "data_hasil" . date('YmdHis') . ".pdf", false, true,'L');
           
        }
    }
    function search() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->model('hasil_model');
            $view = $this->load->view('hasil/search', array(), TRUE);
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
        $data['title'] = 'Akses Login Aplikasi' ;
        $data['message'] = $pesan ;
        
        $this->load->model('Pesan_Model');
        $this->Pesan_Model->insert($data);
        $hasil = smssend($row->hp,$pesan);
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
                
                    
                    
        $files = substr(__dir__,0, strpos( __dir__,"application")) . 'assets/files/hasil/lampiran_'.$id.'.zip';
                    var_dump($files);
                    if(file_exists($files))
                    {
                        header('Cache-Control: public'); 
                        header('Content-Disposition: attachment; filename="lampiran_' . $id . '.zip"');
                        readfile($files);
                        die(); 
                    } else {
                        echo json_encode(array('msgType'=>'error', 'msgValue'=>'File tidak ditemukan'));
                    }
                
            }
        }
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
    function uji_kompetensi_skema($id,$detail_perangkat,$hasil) {
    $jawaban_asesi =unserialize($hasil->jawaban_asesi); 
    $is_kompeten = unserialize($jawaban_asesi['is_kompeten']);
    $list_bukti = unserialize($jawaban_asesi['list_bukti']);
    
    //var_dump($is_kompeten);
    $combo = '<select name="list_bukti[]">';
    foreach ($detail_perangkat as $key => $value) {
        $combo .= '<option value='.$key.'>'.($key + 1).'</option>';
    }
    $combo .= '</select>';

    $skema = kode_tbl() . 'skema';
    $skema_detail = kode_tbl() . 'skema_detail';
    $unit_kompetensi = kode_tbl() . 'unit_kompetensi';
    $elemen_kompetensi = kode_tbl() . 'elemen_kompetensi';
    $kuk = kode_tbl() . 'kuk';
    $asesi = kode_tbl() . 'asesi';
    $asesi_detail = kode_tbl() . 'asesi_detail';
        //$id = $this->input->post('id');

    $this->db->select("a.*,c.id_unit_kompetensi,c.unit_kompetensi,d.elemen_kompetensi,e.id_elemen_kompetensi,e.kuk", false);
    $this->db->from("$skema a");
    $this->db->join("$skema_detail b", "b.id_skema=a.id");
    $this->db->join("$unit_kompetensi c", "c.id=b.id_unit_kompetensi");
    $this->db->join("$elemen_kompetensi d", "d.id_unit_kompetensi=c.id");
    $this->db->join("$kuk e", "e.id_elemen_kompetensi=d.id");
    $this->db->where("a.id", $id);
    $d = $this->db->get()->result();
    $table = '<table  width="100%" class="table table-stripped table-bordered" border="1">
    <tr align="center" style="font-weight:bold;">
        <td  align="center"> No </td>
        <td> Kode Unit </td>
        <td> Judul Unit Kompetensi / Elemen Kompetensi / <br/> Kriteria Unjuk Kerja(KUK)</td>
        <td width="30px" align="center"> Y<br/>

        </td>
        <td width="30px" align="center"> N<br/>
        </td>
        <td> Bukti No </td>
    </tr>';
    $no = 1;
    $real_unit = "";
    $real_elemen = "";
    foreach ($d as $key => $value) {
        if($is_kompeten[$key] =='k'){
            $k = 'Y'; 
            $bk='';
        }else{
            $k = ''; 
            $bk='N';
        }

        if ($real_unit == $value->id_unit_kompetensi) {
            if ($real_elemen != $value->id_elemen_kompetensi) {
                $table .= ' <tr style="font-weight:normal;">
                <td align="center"></td>
                <td></td>
                <td> <b>' . ltrim($value->elemen_kompetensi) . '</b> </td>
                <td> </td>
                <td> </td>
                <td> 
                </td>
            </tr>';
                    //if($real_elemen == $value->id_elemen_kompetensi){
            $table .= ' <tr style="font-weight:normal;">
            <td align="center"></td>
            <td></td>
            <td> ' . ltrim($value->kuk) . ' </td>
            <td align="center">'.$k.' </td>
            <td align="center"> '.$bk.'</td>
            <td align="center"> '.($list_bukti[$key] + 1).'
            </td>
        </tr>';
    } else {

        $table .= ' <tr style="font-weight:normal;">
        <td align="center"></td>
        <td></td>
        <td> ' . ltrim($value->kuk) . ' </td>
        <td align="center"> '.$k.' </td>
        <td align="center"> '.$bk.'</td>
        <td align="center"> '.($list_bukti[$key] + 1).'
        </td>
    </tr>';
}
} else {
    $table .= ' <tr>
    <td align="center"> ' . $no . ' </td>
    <td> ' . $value->id_unit_kompetensi . ' </td>
    <td> <b>' . $value->unit_kompetensi . '</b> </td>
    <td align="center"> </td>
    <td align="center"> </td>
    <td> 
    </td>
</tr>';
$table .= ' <tr style="font-weight:normal;">
<td align="center"></td>
<td></td>
<td> <b>' . ltrim($value->elemen_kompetensi) . '</b> </td>
<td> </td>
<td> </td>
<td> 
</td>
</tr>';
$table .= ' <tr style="font-weight:normal;">
<td align="center"></td>
<td></td>
<td> ' . ltrim($value->kuk) . ' </td>
<td align="center"> '.$k.'</td>
<td align="center"> '.$bk.'</td>
<td align="center"> '.($list_bukti[$key] + 1).'
</td>
</tr>';
$no++;
}
$real_unit = $value->id_unit_kompetensi;
$real_elemen = $value->id_elemen_kompetensi;
}
$table .= '</table>';
return $table;
}

    function proses_dpl($id_asesi, $id_perangkat) {

        $this->db->where('id_asesi',$id_asesi);
        $this->db->order_by('id','DESC');
        $query_hasil = $this->db->get('t_uji')->row();
        if(count($query_hasil) > 0){
            $jawaban_asesi =unserialize(str_replace('|', '"', $query_hasil->jawaban_asesi));
        }else{
            $jawaban_asesi = array();
        }
        
        //$this->db->where('a.skema_perangkat',$id);
        $this->db->select('d.id,d.id_unit_kompetensi,d.unit_kompetensi,c.pertanyaan,c.jawaban_benar');
        $this->db->where('b.id',$id_perangkat);
        $this->db->from(kode_tbl().'soal c');
        $this->db->join(kode_tbl().'perangkat_asesmen_detail b','b.id=c.id_perangkat_detail');
        $this->db->join(kode_tbl().'perangkat_asesmen a','a.id=b.id_perangkat_asesmen');
        $this->db->join(kode_tbl().'unit_kompetensi d','d.id=c.id_unit_kompetensi');
        $this->db->order_by('c.urutan');
        $this->db->order_by('d.id');
        $query = $this->db->get()->result();
        
        
        $table = '<input id="hidden_jenis_perangkat" type="hidden" value="2" /><table class="table table-bordered"><tr>'
                . '<th>No</th><th>Unit Kompetensi</th>'
                . '<th>Pertanyaan</th><th>Jawaban<br/>Benar</th><th>Jawaban<br/>Asesi</th></tr>';
        $unit_kompetensi = "";
        $jawaban_yang_benar = 0;
        $jawaban_yang_salah = 0;
        foreach ($query as $key => $value) {
            $option_jawaban = unserialize($value->jawaban_benar);
            $bs = $value->jawaban_benar == $jawaban_asesi[$key] ? 'green' : 'red';
            
            if($unit_kompetensi != $value->id){
                $jumlah_soal = 0;
                //dump($jumlah_soal);
                $jawaban_benar = 0;
                $jumlah_soal = 1 + $jumlah_soal;
                if($value->jawaban_benar == $jawaban_asesi[$key]){
                    $jawaban_yang_benar++;
                    $jawaban_benar = 1 + $jawaban_benar;
                    $array_unit[$value->id_unit_kompetensi] = array('judul_unit'=>$value->unit_kompetensi,'jumlah_soal'=>$jumlah_soal,'jawaban_benar'=>$jawaban_benar);
                }else{
                    $jawaban_yang_salah++;
                    $array_unit[$value->id_unit_kompetensi] = array('judul_unit'=>$value->unit_kompetensi,'jumlah_soal'=>$jumlah_soal,'jawaban_benar'=>$jawaban_benar);
                }
                //  $jawaban_benar = $value->jawaban_benar == $jawaban_asesi[$key] ? $jawaban_benar++ : $jawaban_benar;
                //$array_unit[$value->id_unit_kompetensi] = array('judul_unit'=>$value->unit_kompetensi,'jumlah_soal'=>$jumlah_soal++,'jawaban_benar'=>$jawaban_benar);
                $color = rand(100000,1000000);
                //var_dump($color);
            }else{
                $jumlah_soal = 1 + $jumlah_soal;
                if($value->jawaban_benar == $jawaban_asesi[$key]){
                    $jawaban_yang_benar++;
                    $jawaban_benar = 1 + $jawaban_benar;
                    $array_unit[$value->id_unit_kompetensi] = array('judul_unit'=>$value->unit_kompetensi,'jumlah_soal'=>$jumlah_soal,'jawaban_benar'=>$jawaban_benar);
                }else{
                    $jawaban_yang_salah++;
                    $array_unit[$value->id_unit_kompetensi] = array('judul_unit'=>$value->unit_kompetensi,'jumlah_soal'=>$jumlah_soal,'jawaban_benar'=>$jawaban_benar);
                }
                //$jawaban_benar =$value->jawaban_benar == $jawaban_asesi[$key] ? $jawaban_benar++ : $jawaban_benar;
                //$array_unit[$value->id_unit_kompetensi] = array('judul_unit'=>$value->unit_kompetensi,'jumlah_soal'=>$jumlah_soal++,'jawaban_benar'=>$jawaban_benar);
                //$color = $color;
            }
            //$bs_color = $jawaban == $jawaban_peserta ? '' : 'red';
            
            $table .= '<tr style="color:white;background-color:#'.$color.'">'
                    . '<td>'.($key + 1).'</td>'
                    . '<td>'.$value->unit_kompetensi.'</td>'
                    . '<td>'.$value->pertanyaan.'</td>
            <td style="text-align:center">'.$value->jawaban_benar.'</td>'
                    . '<td style="text-align:center;background-color: '.$bs.';">'.$jawaban_asesi[$key].'</td></tr>';
            $unit_kompetensi = $value->id;



        }
        $persentasi_keseluruhan = round($jawaban_yang_benar / count($query) * 100) ;
        $table .='</table> <h3>Jawaban Benar : '.$jawaban_yang_benar.', Jawaban Salah: '.$jawaban_yang_salah.', Persentasi '.$persentasi_keseluruhan.'%</h3>';
        // Buat table untuk menampilkan summary dari jawaban peserta sesuai dengan unit kompetensinya
        $table_summary = '<br/><table class="table-borders-dark" ><tr>'
                . '<th>No</th><th>Kode Unit</th>'
                . '<th>Judul Unit</th><th style="text-align:center">Jumlah Soal</th><th style="text-align:center">Jawaban<br/>Benar</th><th style="text-align:center">Persentasi</th></tr>';
        $no_unit= 1;
        foreach ($array_unit as $keys => $values) {
            $persentasi = round($values['jawaban_benar'] / $values['jumlah_soal'] * 100) ;
            $table_summary .= '<tr>'
                    . '<td>'.$no_unit.'</td>'
                    . '<td>'.$keys.'</td>'
                    . '<td>'.$values['judul_unit'].'</td>'
                    . '<td style="text-align:center">'.$values['jumlah_soal'].'</td>'
                    . '<td style="text-align:center">'.$values['jawaban_benar'].'</td>'
                    . '<td style="text-align:center">'.$persentasi.'%</td></tr>';
            $no_unit++;
        }
        $table_summary .='</table>';
        $table .=$table_summary;
        //dump($array_unit);
        $data = array('table' => $table);
        $this->load->view('templates/responsive/header', $data);
        $this->load->view('hasil/view', $data);
        $this->load->view('templates/responsive/footer', $data);
    }
}
