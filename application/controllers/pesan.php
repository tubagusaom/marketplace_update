<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pesan extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Pesan_Model');
        $this->load->model('V_Pesan_Model');
        
    }
    
    function index()
    {
        if($_SERVER['REQUEST_METHOD'] == 'GET')
            {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model'=>'V_Pesan_Model', 'controller'=>'pesan', 'options'=>array('id'=>'pesan', 'pagination')))->load_model()->set_grid();
            
            $view = $this->load->view('pesan/index', array('grid'=>$grid), true);
            
            echo json_encode(array('msgType'=>'success', 'msgValue'=>$view));
        }
        else
        {
            block_access_method();
        }
    }
    
    function datagrid()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows')) ;
            $page = intval($this->input->post('page'))== 0 ? 1 : intval($this->input->post('page'));
            $offset = $row * ($page - 1);
            $data = array();
            $params = array('_return'=>'data');
            //$where['parent_id'] = '0';
            $jenis_user = $this->auth->get_user_data()->jenis_user;
            if($jenis_user == 1){
                $user_id = $this->auth->get_user_data()->id;
                $where['parent_id = 0 AND sender_id ='.$user_id.' OR parent_id = 0 AND reciepent_id ='] = $user_id;    
            }else if($jenis_user == 2){
                $user_id = $this->auth->get_user_data()->id;
                $where['parent_id = 0 AND sender_id ='.$user_id.' OR parent_id = 0 AND reciepent_id ='] = $user_id;    
            }else if($jenis_user == 3){
                $user_id = $this->auth->get_user_data()->id;
                $where['parent_id = 0 AND sender_id ='.$user_id.' OR parent_id = 0 AND reciepent_id ='] = $user_id;    
            }else{
                $where['parent_id'] = '0';
            }
            if(isset($_POST['message']) && !empty($_POST['message']))
            {
                $where['message LIKE '] = '%' . $this->input->post('message') . '%';
            }
            if(isset($where)) $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->V_Pesan_Model->count_by($where) : $this->V_Pesan_Model->count_all();
            $this->V_Pesan_Model->limit($row, $offset);
            $rows = $this->V_Pesan_Model->set_params($params)->with(array());
            $data['rows'] = $this->V_Pesan_Model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else
        {
            block_access_method();
        }
    }
    
    function add()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $data = $this->Pesan_Model->set_validation()->validate();
            if($data !== false)
            {
                if($this->Pesan_Model->check_unique($data))
                {
                    if($this->Pesan_Model->insert($data) !== false)
                    {
                        $reciepent_id = $this->input->post('reciepent_id');
                        $message = $this->input->post('message');
                        
                        $this->db->where('id',$reciepent_id);
                        $users = $this->db->get('t_users')->row();                         
                        smssend($users->hp,$message);
                        echo json_encode(array('msgType'=>'success', 'msgValue'=>'Data berhasil disimpan !'));
                    }
                    else
                    {
                        echo json_encode(array('msgType'=>'error', 'msgValue'=>'Data tidak dapat disimpan !'));
                    }
                }
                else
                {
                    echo json_encode(array('msgType'=>'error', 'msgValue'=>implode("<br/>", $this->Pesan_Model->get_validation())));
                }
            }
            else
            {
                echo json_encode(array('msgType'=>'error', 'msgValue'=>validation_errors()));
            }
        }
        else
        {
               $this->load->library('combogrid');
               $sender_id = $this->auth->get_user_data()->id;
               $users = $this->combogrid->set_properties(array('model'=>'User_Model', 'controller'=>'users', 'fields'=>array('nama_user','email'), 'options'=>array('id'=>'reciepent_id', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama_user', 'panelWidth'=>400)))->load_model()->set_grid();
               echo json_encode(array('msgType'=>'success', 'msgValue'=>$this->load->view('pesan/add',array('users_grid'=>$users,'sender_id'=>$sender_id ), TRUE)));
        }
    }
    function delete($id = false)
    {
        if(!$id){
            data_not_found();
            exit;
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $gols = $this->Pesan_Model->get(intval($id));
            if(sizeof($gols) == 1)
            {
                if($this->Pesan_Model->delete(intval($id)))
                {
                    echo json_encode(array('msgType'=>'success', 'msgValue'=>'Data berhasil dihapus'));
                }
                else
                {
                    echo json_encode(array('msgType'=>'error', 'msgValue'=>'Data tidak berhasil dihapus !'));
                }
            }
            else
            {
                echo json_encode(array('msgType'=>'error', 'msgValue'=>'Data tidak dapat ditemukan !'));
            }
        }
        else
        {
            block_access_method();
        }
    }
    function upload() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->Pesan_Model->set_validation()->validate();
            if ($data !== false) {
                if ($this->Pesan_Model->check_unique($data)) {
                    if (isset($_FILES['fileToUpload']['tmp_name']) && !empty($_FILES['fileToUpload']['tmp_name'])) {
                        $data['attachment'] = date("Y-m-dHis").str_replace(' ', '_', $_FILES['fileToUpload']['name']);
                        $config['upload_path'] = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/files/pesan/';
                        $config['allowed_types'] = 'bmp|jpg|png|gif|jpeg|zip|rar|docx|doc|xls|xlsx';
                        $config['max_size'] = '51200000';
                        $config['file_name'] = $data['attachment'];
                        $this->load->library('upload', $config);

                        if (!$this->upload->do_upload('fileToUpload')) {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => $this->upload->display_errors()));
                            exit();
                        }
                    } else {
                        $data['attachment'] = "";
                    }
                    if ($this->Pesan_Model->insert($data) !== false) {
                        $reciepent_id = $this->input->post('reciepent_id');
                        $message = $this->input->post('message');
                        
                        $this->db->where('id',$reciepent_id);
                        $users = $this->db->get('t_users')->row();                         
                        smssend($users->hp,$message);
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", strip_tag($this->Pesan_Model->get_validation()))));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        }
    }
    function combogrid($id = false)
    {
        $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows')) ;
        $page = intval($this->input->post('page'))== 0 ? 1 : intval($this->input->post('page'));
        $offset = $row * ($page - 1);
        $data = array();
        $params = array('_return'=>'data');
        if(isset($_POST['q']))
        {
            $where['nama_Pesan LIKE'] = "%" . $this->input->post('q') . "%";
        }
        if(isset($where)) $params['_where'] = $where;
        $data['total'] = isset($where) ? $this->Pesan_Model->count_by($where) : $this->Pesan_Model->count_all();
        $this->Pesan_Model->limit($row, $offset);
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
            $order = $this->Pesan_Model->get_params('_order');
        }       
        $rows = isset($where) ? $this->Pesan_Model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->Pesan_Model->order_by($order, $order_criteria, $_order_escape)->get_all();
        $data['rows'] = $this->Pesan_Model->fields_selected(array('nip', 'nama_Pesan'))->data_formatter($rows);
        echo json_encode($data);
    }
    function view($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
            $con_method = $this->Pesan_Model->get(intval($id));
            if (sizeof($con_method) == 1) {
                $sender_id = $this->auth->get_user_data()->id;
                
                $pesan = $this->Pesan_Model->comment($id);
                $data = $this->Pesan_Model->get_single($con_method);
                if($sender_id == $data->sender_id){
                    $recepient = $data->reciepent_id;
                }else{
                    $recepient = $data->sender_id;
                }
                // Cari id pesan terakhir apakah penerima nya sama
                $this->db->where('parent_id',$id);
                $this->db->order_by('id','DESC');
                //$this->db->limit(1);
                $pesan_terakhir = $this->db->get('t_pesan',1)->row();
                //var_dump($pesan_terakhir);die();
                if(count($pesan_terakhir) > 0){
                    if($pesan_terakhir->reciepent_id ==$sender_id ){
                    $data_pesan = array(
                        'status_read_recepient' => '1'
                    );
                    $this->db->where('id',$id);
                    $this->db->update('t_pesan',$data_pesan);
                }    
                }else{
                    if($sender_id == $data->reciepent_id){
                    $data_pesan = array(
                        'status_read_recepient' => '1'
                    );
                    $this->db->where('id',$id);
                    $this->db->update('t_pesan',$data_pesan);
                }   
                }
                //var_dump($pesan_terakhir);die();
                
                
                $view = $this->load->view('pesan/view', array('parent_id'=>$id,'sender_id'=>$sender_id,'recepient'=>$recepient,'data' => $data,'pesan'=>$pesan , 'url' => base_url() . 'pesan/edit_upload/' . $id), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
    function edit_upload($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->Pesan_Model->set_validation()->validate();
            if ($data !== false) {
                if ($this->Pesan_Model->check_unique($data)) {
                    if (isset($_FILES['fileToUpload']['tmp_name']) && !empty($_FILES['fileToUpload']['tmp_name'])) {
                        $data['attachment'] = date("Y-m-dHis").str_replace(' ', '_', $_FILES['fileToUpload']['name']);
                        $config['upload_path'] = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/files/pesan/';
                        $config['allowed_types'] = '*';
                        $config['max_size'] = '0';
                        $config['file_name'] = $data['attachment'];
                        $this->load->library('upload', $config);

                        if (!$this->upload->do_upload('fileToUpload')) {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => $this->upload->display_errors()));
                            exit();
                        }
                    } else {
                        $data['attachment'] = "";
                    }
                    if ($this->Pesan_Model->insert($data) !== false) {
                        //if($sender_id == $data->reciepent_id){
                            $data_pesan = array(
                                'status_read_recepient' => '0'
                            );
                            $this->db->where('id',$id);
                            $this->db->update('t_pesan',$data_pesan);
                            
                            $reciepent_id = $this->input->post('reciepent_id');
                            $message = $this->input->post('message');
                            
                            $this->db->where('id',$reciepent_id);
                            $users = $this->db->get('t_users')->row();                         
                            smssend($users->hp,$message);
                        //}
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", strip_tag($this->Pesan_Model->get_validation()))));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        }
    }
   function proses($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        $con_method = $this->Pesan_Model->get(intval($id));
            if (sizeof($con_method) == 1) {
                $data = $this->db->get('r_konfigurasi_aplikasi')->row();
                $this->load->library('email');
                $this->email->from($data->alamat_email, $data->singkatan_unit);
                
                $this->db->where('id',$con_method->reciepent_id);
                $users = $this->db->get('t_users')->row();
                $this->email->to($users->email);
    
                $this->email->subject($con_method->title);
                $pesan = '<p>'.$con_method->message.'</p>';
                $header = '<h3>Dear '.$users->nama_user.' </h3><br/>';
                $footer = '<br/><span id="yui_3_16_0_ym19_1_1469402382195_8369" style="color:rgb(7,55,99);">LSP Cohespa</span></b></font><br></span></div><div id="yui_3_16_0_ym19_1_1469402382195_8367"><span style="font-family:georgia, serif;"><br></span></div><span style="font-family:georgia, serif;"></span></div><span id="yui_3_16_0_ym19_1_1469402382195_8365" style="font-family:georgia, serif;"><span id="yui_3_16_0_ym19_1_1469402382195_8364" style="color:rgb(0,0,0);">Website : <span style="color:rgb(0,0,255);"><a rel="nofollow" target="_blank" href="http://www.lspcohespa.org">www.lspcohespa.org</a></span></span></span><br><span id="yui_3_16_0_ym19_1_1469402382195_8358" style="font-family:georgia, serif;"><span id="yui_3_16_0_ym19_1_1469402382195_8357" style="color:rgb(0,0,0);"><span id="yui_3_16_0_ym19_1_1469402382195_8362"><span id="yui_3_16_0_ym19_1_1469402382195_8361" style="font-family:georgia, serif;"><span id="yui_3_16_0_ym19_1_1469402382195_8360" style="color:rgb(0,0,0);">E-mail :&nbsp;&nbsp;</span></span><span id="yui_3_16_0_ym19_1_1469402382195_8376" style="color:rgb(0,0,255);"><u id="yui_3_16_0_ym19_1_1469402382195_8375"><a id="yui_3_16_0_ym19_1_1469402382195_8374" rel="nofollow" ymailto="mailto:info@cohespa.org" target="_blank" href="mailto:info@cohespa.org">info@cohespa.org</a><br></u></span></span>Contact Person : +628175010106</span>';
                if($con_method->title == 'Perbaikan Pra Asesmen Dari Asesi'){
                        $tutor = '<p>Langkah - langkah verifikasi bukti revisi dari asesi</p>
                        <ol>
                        <li>Login sebagai Asesor</li>
                        <li>Klik menu utama Sertifikasi -> Pra asesmen </li>
                        <li>Pilih nama asesi yang melakukan update data pra asesmen </li>
                        <li>Klik Tombol Edit</li>
                        <li>Klik Link download <b>Revisi File bukti pendukung</b></li>
                        <li>Apabila file sudah sesuai dengan minimal persyaratan skema, rekomendasi lanjut</li>
                        <li>Klik tombol Save</li>
                        <li>Note : Disarankan Rekomendasi lanjut dan pada notifikasi diingatkan kembali untuk membawa seluruh bukti pendukung yang relevan dengan skema sertifikasi yang di ambil</li>
                        </ol>';
                    }else if($con_method->title =='Akses Login Aplikasi Sertifikasi Online'){
                        $tutor = '<p>Selamat anda sudah memiliki akses login ke aplikasi sertifikasi,  anda bisa login untuk melakukan aktifitas memperbaiki data, mengajukan banding dari rekomendasi asesor, umpan balik dll. Untuk selanjutnya silahkan menunggu sampai asesor/admin memverifikasi data APL 01 dan 02 anda. Langkah-langkah untuk login adalah</p>
                        <ol>
                        <li>Masuk ke website LSP</li>
                        <li>Klik menu login </li>
                        <li>Masukkan username dan password yang sudah di kirim via email dan sms. (Jangan balas SMS atau telpon ke no tersebut karena itu no SMS Server)</li>
                        <li>Klik tombol login atau tekan tombol enter</li>
                        <li>Note : Disarankan untuk mengganti password pada menu profile pojok kanan atas</li>
                        </ol>';
                    }else if($con_method->title =='Akses Login Aplikasi'){
                        $tutor = '<p>Selamat anda sudah memiliki akses login ke aplikasi sertifikasi,  anda bisa login untuk melakukan aktifitas memperbaiki data, mengajukan banding dari rekomendasi asesor, umpan balik dll. Untuk selanjutnya silahkan menunggu sampai asesor/admin memverifikasi data APL 01 dan 02 anda. Langkah-langkah untuk login adalah</p>
                        <ol>
                        <li>Masuk ke website LSP</li>
                        <li>Klik menu login </li>
                        <li>Masukkan username dan password yang sudah di kirim via email dan sms. (Jangan balas SMS atau telpon ke no tersebut karena itu no SMS Server)</li>
                        <li>Klik tombol login atau tekan tombol enter</li>
                        <li>Note : Disarankan untuk mengganti password pada menu profile pojok kanan atas</li>
                        </ol>';
                    }else if($con_method->title =='Tugas Check Pra Asesmen'){
                        $tutor = '<p>Bapak / Ibu asesor, anda telah di tugaskan LSP untuk memverifikasi data pribadi terutama bukti pendukung yang di upload. Periksa apakah sudah sesuai dengan persyartan skema. Apabila file yang di upload asesi kurang karena alasan File terlalu besar, rekomendasi lanjut dengan syarat dokumen di bawa pada saat uji kompetensi untuk di verifikasi kembali. Apabila memang banyak kekurangan bukti pendukung, silahkan di rekomendasi TIDAK LANJUT dan centang notifikasi untuk proses reminder ke asesi. Asesor di harapkan kontak calon asesi by phone atau email untuk lebih jelas nya. Langkah - langkah melakukan pra asesmen adalah sebagai berikut</p>
                        <ol>
                        <li>Login sebagai asesor</li>
                        <li>Klik menu utama Sertifikasi -> Pra Asesmen </li>
                        <li>Klik nama yang akan di lakukan pra asesmen dan kemudian klik tombol edit</li>
                        <li>Download bukti pendukung yang telah di upload</li>
                        <li>Tentukan perangkat asesmen yang akan di gunakan</li>
                        <li>Scroll kebawah untuk Checklist VATM</li>
                        <li>Rekomendasi calon asesi untuk LANJUT atau TIDAK LANJUT</li>
                        <li>Centang notifikasi agar calon asesi dapat pemberitahuan melalui sms dan email</li>
                        <li>Klik tombol save pada bagian bawah untuk menyimpan</li>
                        
                        </ol>';
                    }else if($con_method->title =='Hasil Pra Asesmen Lanjut'){
                        $tutor = '<p>Selamat aplikasi pendaftaran anda sudah di verifikasi oleh Asesor dan dinyatakan lanjut ke tahapan berikutnya yaitu proses administrasi dan penentuan jadwal uji kompetensi. Anda akan segera di follow up by phone atau email oleh Admin LSP</p>
                        ';
                    }else if($con_method->title =='Hasil Pra Asesmen Tidak Lanjut'){
                        $tutor = '<p>Mungkin ada dokumen bukti pendukung yang tidak lengkap. Silahkan melengkapi dengan langkah-langkah sebagai berikut</p>
                        <ol>
                        <li>Login sebagai calon pemegang sertifikat dengan username dan password yang dikirim by email / sms</li>
                        <li>Klik menu utama Sertifikasi -> Pendafaran UJK </li>
                        <li>Klik data anda dan kemudian klik tombol edit</li>
                        <li>Scroll kebawah dan cari bagian <b>Revisi file bukti pendukung</b></li>
                        <li>Browse File (bukti pendukung yang dipersyaratkan oleh asesor)terbaru dari komputer / laptop anda</li>
                        <li>Klik tombol save pada bagian bawah untuk menyimpan</li>
                        <li>Asesor akan menerima notifikasi dan segera mereview ulang bukti baru tersebut</li>
                        <li>Tunggu response dari asesor atau hubungi admin jika belum ada jawaban dari asesor</li>
                        
                        </ol>';
                    }else if($con_method->title =='Hasil Pra Asesmen Belum ada rekomendasi'){
                        $tutor = '<p>Asesor belum memberi rekomendasi. Tunggu response dari asesor atau hubungi admin jika belum ada jawaban dari asesor</p>
                       ';
                    }else{
                        $tutor = '<ol>
                        <li>-</li>
                        </ol>';
                    }
                    $pesan = $header.$pesan.$tutor.$footer;
                //var_dump($pesan);die();
                $this->email->message($pesan);
    
                if ($this->email->send()) {
                    $data_email = array(
                        'status_email' => '1'
                    );
                    $this->db->where('id',$id);
                    $this->db->update('t_pesan',$data_email);
                    
                    echo json_encode(array('msgType' => 'success', 'msgValue' => 'Email Terkirim !'));
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => 'Gagal Mengirim !'));
                }
            }else{
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
            //echo $this->email->print_debugger();
        }
        function email($id = false) {
        $querys = $this->db->query("SELECT * FROM t_pesan WHERE reciepent_id !='1' AND status_email='0'  OR
         reciepent_id !='1' AND status_email='2'    
         ORDER BY id DESC LIMIT 1 ");

        
        $con_method= $querys->row();
            if (count($con_method) == 1) {
                
                $data = $this->db->get('r_konfigurasi_aplikasi')->row();
                $this->load->library('email');
                $this->email->from($data->alamat_email, $data->singkatan_unit);
                
                $this->db->where('id',$con_method->reciepent_id);
                $users = $this->db->get('t_users')->row();
                
                $this->load->helper('email');

                if (valid_email($users->email))
                {
                    $this->email->to($users->email);
    
                    $this->email->subject($con_method->title);
                    //$pesan = $query->message;
                    $pesan = '<p>'.$query->message.'</p>';
                    $header = '<h3>Dear '.$users->nama_user.' </h3><br/>';
                    $footer = '<br/><span id="yui_3_16_0_ym19_1_1469402382195_8369" style="color:rgb(7,55,99);">LSP Cohespa</span></b></font><br></span></div><div id="yui_3_16_0_ym19_1_1469402382195_8367"><span style="font-family:georgia, serif;"><br></span></div><span style="font-family:georgia, serif;"></span></div><span id="yui_3_16_0_ym19_1_1469402382195_8365" style="font-family:georgia, serif;"><span id="yui_3_16_0_ym19_1_1469402382195_8364" style="color:rgb(0,0,0);">Website : <span style="color:rgb(0,0,255);"><a rel="nofollow" target="_blank" href="http://www.lspcohespa.org">www.lspcohespa.org</a></span></span></span><br><span id="yui_3_16_0_ym19_1_1469402382195_8358" style="font-family:georgia, serif;"><span id="yui_3_16_0_ym19_1_1469402382195_8357" style="color:rgb(0,0,0);"><span id="yui_3_16_0_ym19_1_1469402382195_8362"><span id="yui_3_16_0_ym19_1_1469402382195_8361" style="font-family:georgia, serif;"><span id="yui_3_16_0_ym19_1_1469402382195_8360" style="color:rgb(0,0,0);">E-mail :&nbsp;&nbsp;</span></span><span id="yui_3_16_0_ym19_1_1469402382195_8376" style="color:rgb(0,0,255);"><u id="yui_3_16_0_ym19_1_1469402382195_8375"><a id="yui_3_16_0_ym19_1_1469402382195_8374" rel="nofollow" ymailto="mailto:info@cohespa.org" target="_blank" href="mailto:info@cohespa.org">info@cohespa.org</a><br></u></span></span>Contact Person : +628175010106</span>';
                     if($con_method->title == 'Perbaikan Pra Asesmen Dari Asesi'){
                        $tutor = '<p>Langkah - langkah verifikasi bukti revisi dari asesi</p>
                        <ol>
                        <li>Login sebagai Asesor</li>
                        <li>Klik menu utama Sertifikasi -> Pra asesmen </li>
                        <li>Pilih nama asesi yang melakukan update data pra asesmen </li>
                        <li>Klik Tombol Edit</li>
                        <li>Klik Link download <b>Revisi File bukti pendukung</b></li>
                        <li>Apabila file sudah sesuai dengan minimal persyaratan skema, rekomendasi lanjut</li>
                        <li>Klik tombol Save</li>
                        <li>Note : Disarankan Rekomendasi lanjut dan pada notifikasi diingatkan kembali untuk membawa seluruh bukti pendukung yang relevan dengan skema sertifikasi yang di ambil</li>
                        </ol>';
                    }else if($con_method->title =='Akses Login Aplikasi'){
                        $tutor = '<p>Selamat anda sudah memiliki akses login ke aplikasi sertifikasi,  anda bisa login untuk melakukan aktifitas memperbaiki data, mengajukan banding dari rekomendasi asesor, umpan balik dll. Untuk selanjutnya silahkan menunggu sampai asesor/admin memverifikasi data APL 01 dan 02 anda. Langkah-langkah untuk login adalah</p>
                        <ol>
                        <li>Masuk ke website LSP</li>
                        <li>Klik menu login </li>
                        <li>Masukkan username dan password yang sudah di kirim via email dan sms. (Jangan balas SMS atau telpon ke no tersebut karena itu no SMS Server)</li>
                        <li>Klik tombol login atau tekan tombol enter</li>
                        <li>Note : Disarankan untuk mengganti password pada menu profile pojok kanan atas</li>
                        </ol>';
                    }else if($con_method->title =='Akses Login Aplikasi Sertifikasi Online'){
                        $tutor = '<p>Selamat anda sudah memiliki akses login ke aplikasi sertifikasi,  anda bisa login untuk melakukan aktifitas memperbaiki data, mengajukan banding dari rekomendasi asesor, umpan balik dll. Untuk selanjutnya silahkan menunggu sampai asesor/admin memverifikasi data APL 01 dan 02 anda. Langkah-langkah untuk login adalah</p>
                        <ol>
                        <li>Masuk ke website LSP</li>
                        <li>Klik menu login </li>
                        <li>Masukkan username dan password yang sudah di kirim via email dan sms. (Jangan balas SMS atau telpon ke no tersebut karena itu no SMS Server)</li>
                        <li>Klik tombol login atau tekan tombol enter</li>
                        <li>Note : Disarankan untuk mengganti password pada menu profile pojok kanan atas</li>
                        </ol>';
                    }else if($con_method->title =='Tugas Check Pra Asesmen'){
                        $tutor = '<p>Bapak / Ibu asesor, anda telah di tugaskan LSP untuk memverifikasi data pribadi terutama bukti pendukung yang di upload. Periksa apakah sudah sesuai dengan persyartan skema. Apabila file yang di upload asesi kurang karena alasan File terlalu besar, rekomendasi lanjut dengan syarat dokumen di bawa pada saat uji kompetensi untuk di verifikasi kembali. Apabila memang banyak kekurangan bukti pendukung, silahkan di rekomendasi TIDAK LANJUT dan centang notifikasi untuk proses reminder ke asesi. Asesor di harapkan kontak calon asesi by phone atau email untuk lebih jelas nya. Langkah - langkah melakukan pra asesmen adalah sebagai berikut</p>
                        <ol>
                        <li>Login sebagai asesor</li>
                        <li>Klik menu utama Sertifikasi -> Pra Asesmen </li>
                        <li>Klik nama yang akan di lakukan pra asesmen dan kemudian klik tombol edit</li>
                        <li>Download bukti pendukung yang telah di upload</li>
                        <li>Tentukan perangkat asesmen yang akan di gunakan</li>
                        <li>Scroll kebawah untuk Checklist VATM</li>
                        <li>Rekomendasi calon asesi untuk LANJUT atau TIDAK LANJUT</li>
                        <li>Centang notifikasi agar calon asesi dapat pemberitahuan melalui sms dan email</li>
                        <li>Klik tombol save pada bagian bawah untuk menyimpan</li>
                        
                        </ol>';
                    }else if($con_method->title =='Hasil Pra Asesmen Lanjut'){
                        $tutor = '<p>Selamat aplikasi pendaftaran anda sudah di verifikasi oleh Asesor dan dinyatakan lanjut ke tahapan berikutnya yaitu proses administrasi dan penentuan jadwal uji kompetensi. Anda akan segera di follow up by phone atau email oleh Admin LSP</p>
                        ';
                    }else if($con_method->title =='Hasil Pra Asesmen Tidak Lanjut'){
                        $tutor = '<p>Mungkin ada dokumen bukti pendukung yang tidak lengkap. Silahkan melengkapi dengan langkah-langkah sebagai berikut</p>
                        <ol>
                        <li>Login sebagai calon pemegang sertifikat dengan username dan password yang dikirim by email / sms</li>
                        <li>Klik menu utama Sertifikasi -> Pendafaran UJK </li>
                        <li>Klik data anda dan kemudian klik tombol edit</li>
                        <li>Scroll kebawah dan cari bagian <b>Revisi file bukti pendukung</b></li>
                        <li>Browse File (bukti pendukung yang dipersyaratkan oleh asesor)terbaru dari komputer / laptop anda</li>
                        <li>Klik tombol save pada bagian bawah untuk menyimpan</li>
                        <li>Asesor akan menerima notifikasi dan segera mereview ulang bukti baru tersebut</li>
                        <li>Tunggu response dari asesor atau hubungi admin jika belum ada jawaban dari asesor</li>
                        
                        </ol>';
                    }else if($con_method->title =='Hasil Pra Asesmen Belum ada rekomendasi'){
                        $tutor = '<p>Asesor belum memberi rekomendasi. Tunggu response dari asesor atau hubungi admin jika belum ada jawaban dari asesor</p>
                       ';
                    }else{
                        $tutor = '<ol>
                        <li>-</li>
                        </ol>';
                    }
                    $pesan = $header.$pesan.$tutor.$footer;

                    $this->email->message($pesan);
        
                    if ($this->email->send()) {
                         $status_email = '1';
                    }else{
                         $status_email = '3';
                    }
                    //echo $this->email->print_debugger();
                    $data_email = array(
                        'status_email' => $status_email
                    );
                    $this->db->where('id',$con_method->id);
                    $this->db->update('t_pesan',$data_email);
                }
                else
                {
                    $data_email = array(
                        'status_email' => '3'
                    );
                    $this->db->where('id',$con_method->id);
                    $this->db->update('t_pesan',$data_email);
                }
                
                
                    //$this->db->update('t_pesan',$data_email);
            }
            //echo $this->email->print_debugger();
        }
        function search() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            //$this->load->library('combogrid');
            //$schedule_grid = $this->combogrid->set_properties(array('model' => 'v_siswa_model', 'controller' => 'siswa', 'options' => array('id' => 'siswa_id', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'nama', 'panelWidth' => 400)))->load_model()->set_grid();
            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('pesan/search', array(), TRUE)));
        } else {
            block_access_method();
        }
    }
}