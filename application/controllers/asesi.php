<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Asesi extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('artikel_model');
        $this->load->model('asesi_model');
        $this->load->model('Sertifikasi_Model');
        $this->load->model('User_Model');
        $this->load->library('pagination');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'asesi_model', 'controller' => 'asesi', 'options' => array('id' => 'asesi', 'pagination', 'rownumber')))->load_model()->set_grid();
            $view = $this->load->view('asesi/index', array('grid' => $grid), true);
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

            if($jenis_user == 3){
                $user_id = $this->auth->get_user_data()->pegawai_id;
                $where['id_tuk ='] = $user_id;
            }else {
              $user_id = $this->auth->get_user_data()->pegawai_id;
              $where['id_tuk ='] != '';
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
            $data['total'] = isset($where) ? $this->asesi_model->count_by($where) : $this->asesi_model->count_all();
            $this->asesi_model->limit($row, $offset);
            $order = $this->asesi_model->get_params('_order');
            //$rows = isset($where) ? $this->asesi_model->order_by($order)->get_many_by($where) : $this->asesi_model->order_by($order)->get_all();
            $rows = $this->asesi_model->set_params($params)->with(array('tuk','skema','user'));

            $data['rows'] = $this->asesi_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        } else {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->asesi_model->set_validation()->validate();
            if ($data !== false) {
                $nama_lengkap = $this->input->post('nama_lengkap');
                            $email = $this->input->post('email');
                            $hp = $this->input->post('telp');
                            $nama = str_replace(' ', '', strtolower($nama_lengkap));
                            if (strlen($nama) > 4) {
                                $datax['akun'] = substr($nama, 0, 4) . rand(1, 9999);
                            } else {
                                $datax['akun'] = $nama . rand(1, 9999);
                            }


                            $datax['email'] = $email;
                            $datax['hp'] = $hp;
                            $datax['nama_user'] = $nama_lengkap;
                            $datax['jenis_user'] = '1';
                            //$datax['sandi'] = '123456';
                            $datax['sandi_asli'] = '123456';
                            $datax['aktif'] = '1';
                            $datax['pegawai_id'] = $id;

                            $no_identitas = $this->input->post('no_identitas');
                            $organisasi = $this->input->post('organisasi');
                            $tempat_lahir = $this->input->post('tempat_lahir');
                            $tgl_lahir = $this->input->post('hidden_tanggaL_lahir');
                            $jenis_kelamin = $this->input->post('jenis_kelamin');
                            $alamat = $this->input->post('alamat');

                            $datax['no_identitas'] = $no_identitas;
                            $datax['organisasi'] = $organisasi;
                            $datax['tempat_lahir'] = $tempat_lahir;
                            $datax['tgl_lahir'] = $tgl_lahir;
                            $datax['jenis_kelamin'] = $jenis_kelamin;
                            $datax['alamat'] = $alamat;
                            $datax['id_asesi'] = $id;

                            $this->db->insert('t_users', $datax);
                            //$this->load->model('User_Model');
                            //$this->User_Model->insert($datax);
                            $user_id = $this->db->insert_id();

                            $datay['user_id'] = $user_id;
                            $datay['role_id'] = 17;
                            $this->load->model('User_Role_Model');
                            $this->User_Role_Model->insert($datay);
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $this->load->library('combogrid');
            $users = $this->combogrid->set_properties(array('model'=>'User_Model', 'controller'=>'users', 'fields'=>array('nama_user','email'), 'options'=>array('id'=>'user_id', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama_user', 'panelWidth'=>400)))->load_model()->set_grid();

            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('asesi/add', array('pra_asesmen' => array('-Pilih-', 'Lanjut', 'Tidak Lanjut'),'pra_asesmen_checked' => $users), TRUE)));
        }
    }

   function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $checked = $this->input->post('pra_asesmen_checked');


            $data = $this->asesi_model->set_validation()->validate();
            //var_dump($data['id_users']);die();
            $buktiPendukung = str_replace("|", '"', $data['bukti_pendukung']);
            //$buktiPendukung = json_decode($buktiPendukung);
            //var_dump($buktiPendukung);die();
            if ($data !== false) {
                if ($this->asesi_model->check_unique($data, intval($id))) {
                    $post_bukti = $this->input->post('bukti_pendukung');
                    $validitas_dokumen = $_POST['validitas_dokumen'];
                    $catatan_validitas_dokumen = $this->input->post('catatan_validitas_dokumen');
                     //var_dump($catatan_validitas_dokumen);
                    $data['bukti_pendukung'] =str_replace('|', '"', $post_bukti);
                    $data['validitas_dokumen'] =serialize($validitas_dokumen);
                    $data['catatan_validitas_dokumen'] = serialize($catatan_validitas_dokumen);

                    if ($this->asesi_model->update(intval($id), $data) !== false) {
                        // $sms = isset($_POST['kirim_notifikasi']) ? $this->input->post('kirim_notifikasi') : "";
                        $akses_login = isset($_POST['akses_login']) ? $this->input->post('akses_login') : "";

                        if ($akses_login != "") {
                            // $checked = $this->input->post('pra_asesmen_checked');
                            // $this->sms($checked, $data['id_users']);

                            $admin = $this->db->get('r_konfigurasi_aplikasi')->row();

                            $catatan_rekomendasi_apl01 = $this->input->post('catatan_rekomendasi_apl01');
                            $nama_lengkap = $this->input->post('nama_lengkap');

                            $pesan = 'Home Depo Menyatakan Bahwa ' . $nama_lengkap . 'Telah ' . $catatan_rekomendasi_apl01. ' Uji Kompetensi';
                            $email = $this->input->post('email');

                            $telp = $this->input->post('telp');

                            $post = '{"personalizations": [{"to": [{"email": "'.$email.'"}],"subject": "Catatan Rekomendasi APL 01 Pendaftaran UJK"}],"from": {"email": "'.$admin->alamat_email.'"},"content": [{"type": "text/plain","value": "'.$pesan.'"}]}';
                            sendgrid_api_text('https://api.sendgrid.com/v3/mail/send',$post);
                        }

                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->asesi_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $asesi = $this->asesi_model->get(intval($id));
            if (sizeof($asesi) == 1) {
                $data_aplikasi = $this->db->get('r_konfigurasi_aplikasi')->row();
                $this->load->library('combogrid');
                $users = $this->combogrid->set_properties(array('model'=>'Vasesi_Users_Model', 'controller'=>'combo_pra_asesmen', 'fields'=>array('nama_user','email','jenis_user'), 'options'=>array('id'=>'pra_asesmen_checked', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama_user', 'panelWidth'=>500,
                    'queryParams'=>array('name'=>'easui')
                    )))->load_model()->set_grid();
                $skema = $this->combogrid->set_properties(array('value'=>$asesi->skema_sertifikasi,'model'=>'skema_model', 'controller'=>'skema', 'fields'=>array('skema'), 'options'=>array('id'=>'skema_sertifikasi', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'skema', 'panelWidth'=>500,
                    'queryParams'=>array('name'=>'easui')
                    )))->load_model()->set_grid();

                $this->load->model('tuk_model');
                //var_dump($asesi->pra_asesmen_checked);
                if($asesi->pra_asesmen_checked == "0" || empty($asesi->pra_asesmen_checked)){
                    $nama_asesor = '';
                }else{
                    $asesor = $this->User_Model->get($asesi->pra_asesmen_checked);
                    $nama_asesor = $asesor->nama_user;
                }
                 $tuk = $this->tuk_model->dropdown('id', 'tuk');
                 //var_dump($tuk);die();
                 $asesi->bukti_pendukung =str_replace('"', '|', $asesi->bukti_pendukung);
                 //var_dump($asesi->bukti_pendukung);die();
                 $this->load->model('skema_model');
                //$skema = $this->skema_model->dropdown('id', 'skema');

                //$user_id = $this->auth->get_user_data()->id;
               // $id_asesi = $this->id_asesi($id);
                // $this->db->where('pegawai_id',$id);
                // $this->db->where('jenis_user','1');
                // $row = $this->db->get('t_users')->row();
                // if(count($row) > 0){
                //     $files_asesi = $this->asesi_model->files_asesi($row->id);
                // }else{
                //     $files_asesi = array();
                // }

                $this->load->model('asesi_model');

                $this->db->select('b.id');
                $this->db->from(kode_tbl().'asesi a');
                $this->db->join('t_users b','a.id_users=b.pegawai_id');
                $this->db->where('a.id',$id);
                $row = $this->db->get()->row();
                // var_dump($row->id);

                $files_asesi = $this->asesi_model->files_asesi($row->id);

                $this->load->model('pra_asesmen_model');
                $jadwal = $this->pra_asesmen_model->jadwal($asesi->jadwal_id);

                //Opsi Rekomendasi APL 01
                $array_opsi_apl01 =  explode('|',$data_aplikasi->opsi_rekomendasi_apl1);
                $array_opsi_apl01[''] = '-Pilih-';
                $array_catatan_apl01 =  explode('|',$data_aplikasi->default_rekomendasi_apl1);
                //var_dump($array_opsi_apl01);
                //var_dump($files_asesi);

                $this->db->select('b.foto_profil');
                $this->db->from(kode_tbl().'asesi a');
                $this->db->join('t_users b','a.id_users=b.pegawai_id');
                $this->db->where('a.id',$id);
                $foto = $this->db->get()->row();

                // $foto = $this->asesi_model->foto($id);
                //var_dump($foto);die();
                $view = $this->load->view('asesi/edit', array('jadwal'=>$jadwal,'skema_grid' => $skema,'files_asesi'=>$files_asesi,'data_aplikasi'=>$data_aplikasi,'skema'=>$skema,'data' => $this->asesi_model->get_single($asesi),'pra_asesmen_grid' => $users,'tuk'=>$tuk,'pra_asesmen' => array('-Pilih-', 'Lanjut', 'Tidak Lanjut'),'jenis_kelamin'=>array('-Pilih-','Pria','Wanita'),'nama_asesor'=>$nama_asesor,'array_opsi_apl01'=>$array_opsi_apl01,'array_catatan_apl01'=>$array_catatan_apl01,'foto'=>$foto), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
    }
    function id_asesi($id){
        $query = $this->db->query("SELECT id from t_users WHERE pegawai_id=$id AND jenis_user='1'");
        return $query->row()->id;
    }
    function delete($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $roles = $this->asesi_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->asesi_model->delete(intval($id))) {
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
        //$this->load->model('asesi_model');
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
        $data['total'] = isset($where) ? $this->asesi_model->count_by($where) : $this->asesi_model->count_all();
        $this->asesi_model->limit($row, $offset);
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
            $order = $this->asesi_model->get_params('_order');
        }
        $rows = isset($where) ? $this->asesi_model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->asesi_model->order_by($order, $order_criteria, $_order_escape)->get_all();
        $data['rows'] = $this->asesi_model->get_selected()->data_formatter($rows);
        //var_dump($data);
        echo json_encode($data);
    }
    function cetak($id,$type = "pdf") {
        ini_set('memory_limit', '51208M');
        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
        $asesi = $this->asesi_model->data_asesi($id);
        $data['data_asesi'] = $asesi;
        $this->db->select('b.*');
        $this->db->from(kode_tbl().'asesi a');
        $this->db->join('t_users b','a.id_users=b.id');
        $data['profil_asesi'] = $this->db->get()->row();

        $this->db->select('b.*');
        $this->db->from(kode_tbl().'asesi a');
        $this->db->join('t_users_pekerjaan b','a.id_users=b.id_users');
        $this->db->where('a.id',$id);
        $this->db->where('b.is_work','1');
        $data['pekerjaan_asesi'] = $this->db->get()->result();
        //var_dump($data['pekerjaan_asesi']);die();
        $this->db->where('id_asesi',$asesi->id_users);
        $portofolio = $this->db->get('t_repositori')->result();

    //var_dump($portofolio);die();
        if(count($portofolio)>0){
            foreach ($portofolio as $key => $value) {
                $array_portofolio[] = $value->nama_dokumen ;
            }
            $data['implode_portofolio'] = implode(',', $array_portofolio);
        }else{
            $data['implode_portofolio'] = "";
        }
        $unit_kompetensi = $this->asesi_model->data_unit_kompetensi($asesi->skema_sertifikasi);
        $data['unit_kompetensi'] = $unit_kompetensi;
        $asesi_detail = $this->asesi_model->asesi_detail($id);
        $data['asesi_detail'] = $asesi_detail;
        //var_dump($data['asesi_detail']);die();
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
        //$this->apl02($unit_kompetensi);
        //die();

        //'.//$detail_elemen.'
        $data['unit_mak'] = $unit_mak;
        $data['elemen_kuk'] = $elemen_kuk;
        foreach($asesi_detail as $key=>$value){
            $jenis_bukti[]=$value->jenis_bukti;
        }
        $bukti = unserialize($asesi->bukti_pendukung);
        $jenis_bukti = @implode(',',$bukti);
        $data['jenis_bukti'] = $jenis_bukti;

        $data['apl02'] = $this->apl02($unit_kompetensi,$data['implode_portofolio']);


        $data['kode_unit'] = $kode_unit;
        $data['unit'] = $unit;
        $data['msg'] = $asesi->nama_lengkap."\r\n\n\n".$data['aplikasi']->url_aplikasi."/qrcode/asesi/".$id;

        $view = $this->load->view('asesi/cetak_asesi',$data , true);
        if($type=="pdf") {
            $this->load->library("htm12pdf");
            $this->htm12pdf->pdf_create($view, "data_asesi" . date('YmdHis') . ".pdf", false, true);

        }
    }
    function apl02($unit_kompetensi,$jenis_bukti){
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
                    $detail_kuk.='
                <tr>
                    <td style="width:7%;text-align:center;">'.($keys+1).'.'.($k+1).'</td>
                    <td style="width: 48%;" >'.$v->kuk.'</td>
                    <td style="text-align: center;width: 5%;">K</td>
                    <td style="text-align: center;width: 5%;"></td>
                    <td style="text-align: center;width: 15%;">'.$jenis_bukti.'</td>
                    <td style="width:5%;"> </td>
                    <td style="width:5%;"> </td>
                    <td style="width:5%;"> </td>
                    <td style="width:5%;"> </td>
                </tr>';
                }
                }
                $detail_elemen .= '  <tr>

    <td colspan="9"><b>Elemen Kompetensi</b> : '.($keys+1).'. '.$values->elemen_kompetensi.'</td>
</tr>
<tr  nobr="true">
    <td rowspan="2" style="text-align: center;font-weight: bold;width: 7%;background-color: #7375D8;">Nomor <br/> KUK</td>
    <td rowspan="2" style="text-align: center;font-weight: bold;width: 48%;background-color: #7375D8;">Daftar Pertanyaan <br/> (Assesmen Mandiri/Self Assesment)</td>
    <td colspan="2" style="text-align: center;font-weight: bold;width: 8%;background-color: #7375D8;">Penilaian</td>
    <td rowspan="2" style="text-align: center;font-weight: bold;width: 25%;background-color: #7375D8;">Bukti-bukti Pendukung</td>
    <td colspan="4" style="text-align: center;font-weight: bold;width: 10%;background-color: #7375D8;">Diisi Asesor</td>
</tr>
<tr  nobr="true">
    <td style="text-align: center;font-weight: bold;background-color: #7375D8;width: 4%;">K</td>
    <td style="text-align: center;font-weight: bold;background-color: #7375D8;width: 4%;">BK</td>
    <td style="text-align: center;font-weight: bold;background-color: #7375D8;width: 5%;">V</td>
    <td style="text-align: center;font-weight: bold;background-color: #7375D8;width: 5%;">A</td>
    <td style="text-align: center;font-weight: bold;background-color: #7375D8;width: 5%;">T</td>
    <td style="text-align: center;font-weight: bold;background-color: #7375D8;width: 5%;">M</td>
</tr>'.$detail_kuk;
            }
            }else{
                $detail_elemen .= '';
            }
            $elemen_kuk .= '<table style="width:100%;font-size:10px;border-collapse: collapse;" border="1" >

                          <tr>
                            <td colspan="2" style="width:45%;font-weight:bold;"> Kode Unit Kompetensi </td>
                            <td colspan="7" style="width:55%;">'.$value->id_unit_kompetensi.'</td>
                          </tr>
                          <tr>
                            <td colspan="2" style="width:45%;font-weight:bold;"> Unit Kompetensi </td>
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
        return $elemen_kuk;
    }
    function cetak_pencarian($par1="",$par2="",$par3="",$type = "pdf") {
        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
        $this->db->select('a.*,b.skema');
        $this->db->from(kode_tbl().'asesi a');
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
        $data['data_asesi'] = $this->db->get()->result();
        $view = $this->load->view('asesi/cetak_pencarian_asesi',$data , true);
        if($type=="pdf") {
            $this->load->library("htm12pdf");
            $this->htm12pdf->pdf_create($view, "data_asesi" . date('YmdHis') . ".pdf", false, true,'L');

        }
    }
    function search() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->model('asesi_model');
            $view = $this->load->view('asesi/search', array(), TRUE);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));

        } else {
            block_access_method();
        }
    }
    function sms( $checked, $users) {
       $this->db->where('id', $users);
       $row = $this->db->get('t_users')->row();
       $username = $row->akun;
       $password = $row->sandi_asli;
        //var_dump($password);die();
       $admin = $this->db->get('r_konfigurasi_aplikasi')->row();
       $pesan = 'Login ' . $admin->url_aplikasi . ' User:' . $username . ' Pass:' . $password;
       $data['sender_id'] = $this->auth->get_user_data()->id;
       $data['reciepent_id'] = $users;
       $data['title'] = 'Akses Login Aplikasi';
       $data['message'] = $pesan;

       $this->load->model('Pesan_Model');
       $this->Pesan_Model->insert($data);
       $hasil = smssend_zenziva($row->hp, $pesan, 'login');
       $post = '{"personalizations": [{"to": [{"email": "'.$row->email.'"}],"subject": "'.$data['title'].'"}],"from": {"email": "'.$admin->alamat_email.'"},"content": [{"type": "text/plain","value": "'.$pesan.'"}]}';
        //var_dump($post);die();
       sendgrid_api_text('https://api.sendgrid.com/v3/mail/send',$post);

       $pesan = 'Anda Mendapat Tugas untuk memeriksa Dokumen pra asesmen atas nama ' . $row->nama_user;

       $this->db->where('id', $checked);
       $row = $this->db->get('t_users')->row();

       $data['sender_id'] = 1;
       $data['reciepent_id'] = $checked;
       $data['title'] = 'Tugas Check Pra Asesmen';
       $data['message'] = $pesan;

       $this->load->model('Pesan_Model');
       $this->Pesan_Model->insert($data);
       smssend($row->hp, $pesan);
       $post = '{"personalizations": [{"to": [{"email": "'.$row->email.'"}],"subject": "'.$data['title'].'"}],"from": {"email": "'.$admin->alamat_email.'"},"content": [{"type": "text/plain","value": "'.$pesan.'"}]}';
       sendgrid_api_text('https://api.sendgrid.com/v3/mail/send',$post);
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



        $files = substr(_dir,0, strpos( __dir,"application")) . 'assets/files/asesi/lampiran'.$id.'.zip';
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
    function view($id = 0, $offset = 0){
      $this->load->model('artikel_model');
      $this->load->model('Sertifikasi_model');
      $data['marquee'] = $this->artikel_model->marquee();
      $data['berita_lsp_pilihan'] = $this->artikel_model->berita_lsp_pilihan();

      $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();

      $keyword = $this->input->get('keyword');
      if ($keyword == "") {
          $offset = $this->uri->segment(4);
          //$this->db->where('a.*,c.skema');
          $this->db->where('terbitkan_sertifikat', 'on');
          //$this->db->from(kode_tbl().'asesi a');
          $jml = $this->db->get(kode_tbl() . 'asesi a');
          $data['jmldata'] = $jml->num_rows();
          //pengaturan pagination
          $config['enable_query_strings'] = true;
          $config['base_url'] = base_url() . 'asesi/view/' . $id;
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
          $data['data'] = $this->Sertifikasi_Model->get_asesi($config['per_page'], $offset);
      } else {
          $offset = $this->uri->segment(3);

          $this->db->like('a.nama_lengkap', $keyword);
          $this->db->where('terbitkan_sertifikat', 'on');
          $jml = $this->db->get(kode_tbl() . 'asesi a');

          $data['jmldata'] = $jml->num_rows();

          //pengaturan pagination
          $config['enable_query_strings'] = true;
          if (!empty($keyword)) {
              $config['suffix'] = "?keyword=" . $keyword;
          }

          $config['base_url'] = base_url() . 'asesi/view/' . $id;
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
          $data['data'] = $this->Sertifikasi_Model->get_asesi($config['per_page'], $offset, $keyword);
      }
      // var_dump($data['data']);die();

      $this->load->view('templates/bootstraps/header', $data);
      $this->load->view('sertifikasi/vasesi', $data);
      $this->load->view('templates/bootstraps/bottom', $data);
    }


    function view_user($id = 0, $offset = 0){
      // $this->load->model('artikel_model');
      $this->load->model('Sertifikasi_model');
      // $data['marquee'] = $this->artikel_model->marquee();
      // $data['berita_lsp_pilihan'] = $this->artikel_model->berita_lsp_pilihan();

      $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();

      $keyword = $this->input->get('keyword');
      if ($keyword == "") {
          $offset = $this->uri->segment(4);
          //$this->db->where('a.*,c.skema');
          $this->db->where('a.jenis_user', 1);
          //$this->db->from(kode_tbl().'asesi a');
          $jml = $this->db->get('t_users a');
          $data['jmldata'] = $jml->num_rows();
          //pengaturan pagination
          $config['enable_query_strings'] = true;
          $config['base_url'] = base_url() . 'asesi/view_user/' . $id;
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
          $data['data'] = $this->Sertifikasi_Model->get_user($config['per_page'], $offset);
      } else {
          $offset = $this->uri->segment(3);

          $this->db->like('a.nama_user', $keyword);
          $this->db->where('jenis_user', 1);
          $jml = $this->db->get('t_users a');

          $data['jmldata'] = $jml->num_rows();

          //pengaturan pagination
          $config['enable_query_strings'] = true;
          if (!empty($keyword)) {
              $config['suffix'] = "?keyword=" . $keyword;
          }

          $config['base_url'] = base_url() . 'asesi/view_user/' . $id;
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
          $data['data'] = $this->Sertifikasi_Model->get_user($config['per_page'], $offset, $keyword);
      }
      // var_dump($data['data']);die();

      $this->load->view('templates/bootstraps/header', $data);
      $this->load->view('sertifikasi/vuser', $data);
      $this->load->view('templates/bootstraps/bottom', $data);
    }

    function show_file() {
        $nmfile = $this->input->get('nmfile');
        $data['extension'] = strtolower(substr($nmfile, -3));
        $data['nmfile'] = $nmfile;
        $this->load->view('asesi/view_image', $data);
    }

    function pendaftaran() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama_lengkap = $this->input->post('nama_lengkap');
                            $email = $this->input->post('email');
                            $hp = $this->input->post('telp');
                            $nama = str_replace(' ', '', strtolower($nama_lengkap));
                            if (strlen($nama) > 4) {
                                $datax['akun'] = substr($nama, 0, 4) . rand(1, 9999);
                            } else {
                                $datax['akun'] = $nama . rand(1, 9999);
                            }


                            $datax['email'] = $email;
                            $datax['hp'] = $hp;
                            $datax['nama_user'] = $nama_lengkap;
                            $datax['jenis_user'] = '1';
                            $datax['sandi'] = 'fb27fb1d9ef87fdcac983bcad3eafd86';
                            $datax['sandi_asli'] = '123456';
                            $datax['aktif'] = '1';
                            $datax['pegawai_id'] = '0';


                            $this->db->insert('t_users', $datax);
                            //$this->load->model('User_Model');
                            //$this->User_Model->insert($datax);
                            $user_id = $this->db->insert_id();

                            $datay['user_id'] = $user_id;
                            $datay['role_id'] = 17;
                            $this->load->model('User_Role_Model');
                            $this->User_Role_Model->insert($datay);
                            echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
        } else {
            $this->load->model('skema_model');
            $skema = $this->skema_model->dropdown('id', 'skema');
            $view = $this->load->view('asesi/daftar', array('skema' => $skema), TRUE);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        }
    }

}
