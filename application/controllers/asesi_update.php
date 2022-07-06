<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class asesi_update extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('asesi_update_model');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'asesi_update_model', 'controller' => 'asesi_update', 'options' => array('id' => 'asesi_update', 'pagination', 'rownumber')))->load_model()->set_grid();
            $view = $this->load->view('asesi_update/index', array('grid' => $grid), true);
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
            $user_id = $this->auth->get_user_data()->id;
            $where['id_users ='] = $user_id;
            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->asesi_update_model->count_by($where) : $this->asesi_update_model->count_all();
            $this->asesi_update_model->limit($row, $offset);
            $order = $this->asesi_update_model->get_params('_order');
            //$rows = isset($where) ? $this->asesi_update_model->order_by($order)->get_many_by($where) : $this->asesi_update_model->order_by($order)->get_all();
            $rows = $this->asesi_update_model->set_params($params)->with(array('skema','user'));
            $data['rows'] = $this->asesi_update_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        } else {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->asesi_update_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->asesi_update_model->check_unique($data)) {
                    if ($this->asesi_update_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->asesi_update_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $this->load->library('combogrid');
            $users = $this->combogrid->set_properties(array('model'=>'User_Model', 'controller'=>'users', 'fields'=>array('nama_user','email'), 'options'=>array('id'=>'user_id', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama_user', 'panelWidth'=>400)))->load_model()->set_grid();

            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('asesi_update/add', array('pra_asesmen' => array('-Pilih-', 'Lanjut', 'Tidak Lanjut'),'pra_asesmen_checked' => $users), TRUE)));
        }
    }

    function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->asesi_update_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->asesi_update_model->check_unique($data, intval($id))) {
                    if ($this->asesi_update_model->update(intval($id), $data) !== false) {
                        $is_kompeten = $this->input->post('is_kompeten');

                        foreach($is_kompeten as $key=>$value){
                            $data = array(
                                       'is_kompeten' => $value
                                    );

                            $this->db->where('id', $key);
                            $this->db->update(kode_tbl().'asesi_detail', $data);
                        }
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->asesi_update_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $asesi_update = $this->asesi_update_model->get(intval($id));
            if (sizeof($asesi_update) == 1) {
                $this->db->where('asesi_id',$id);
                $detail_asesi = $this->db->get(kode_tbl().'asesi_detail')->result_array();
                // Menampilkan jenis bukti dan disambung dengan tanda koma
                foreach($detail_asesi as $key=>$value){
                    $jenis_bukti[]=$value['jenis_bukti'];
                }

                $jenis_bukti = implode(',',array_unique($jenis_bukti));
                // Membuat combo untuk pilihan update jenis buktu
                $combo_jenis_bukti = '<select name="jenis_bukti[]" class="jenis_bukti">';
                $explode_combo_jenis = explode(',',$jenis_bukti);
                foreach($explode_combo_jenis as $val){
                    $combo_jenis_bukti .= '<option value="'.$val.'">'.$val.'</option>';
                }
                $this->load->library('combogrid');
                 $users = $this->combogrid->set_properties(array('model'=>'Vasesi_Users_Model', 'controller'=>'combo_pra_asesmen', 'fields'=>array('nama_user','email','jenis_user'), 'options'=>array('id'=>'pra_asesmen_checked', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama_user', 'panelWidth'=>500,
                    'queryParams'=>array('name'=>'easui')
                    )))->load_model()->set_grid();

                if($asesi_update->pra_asesmen_checked == "0" || empty($asesi_update->pra_asesmen_checked)){
                    $nama_asesor = '';
                }else{
                    $this->load->model('User_Model');
                    $asesor = $this->User_Model->get($asesi_update->pra_asesmen_checked);
                    $nama_asesor = $asesor->nama_user;
                }

                $view = $this->load->view('asesi_update/edit', array('url' => base_url() . 'asesi_update/edit_upload/' . $id,'combo_jenis_bukti'=>$combo_jenis_bukti,'jenis_bukti'=>$jenis_bukti,'detail_asesi'=>$detail_asesi,'data' => $this->asesi_update_model->get_single($asesi_update),'pra_asesmen_grid' => $users,'pra_asesmen' => array('-Pilih-', 'Lanjut', 'Tidak Lanjut'),'jenis_kelamin'=>array('-Pilih-','Pria','Wanita'),'nama_asesor'=>$nama_asesor), TRUE);
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
            $roles = $this->asesi_update_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->asesi_update_model->delete(intval($id))) {
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
		//$this->load->model('asesi_update_model');
		$row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows')) ;
		$page = intval($this->input->post('page'))== 0 ? 1 : intval($this->input->post('page'));
		$offset = $row * ($page - 1);
		$data = array();
		$params = array('_return'=>'data');
		if(isset($_POST['q']))
		{
			$where['nama_lengkap LIKE'] = "%" . $this->input->post('q') . "%";
		}
		if(isset($where)) $params['_where'] = $where;
		$data['total'] = isset($where) ? $this->asesi_update_model->count_by($where) : $this->asesi_update_model->count_all();
		$this->asesi_update_model->limit($row, $offset);
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
			$order = $this->asesi_update_model->get_params('_order');
		}
		$rows = isset($where) ? $this->asesi_update_model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->asesi_update_model->order_by($order, $order_criteria, $_order_escape)->get_all();
		$data['rows'] = $this->asesi_update_model->get_selected()->data_formatter($rows);
        //var_dump($data);
		echo json_encode($data);
	}
    function edit_upload($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $is_kompeten = $this->input->post('is_kompeten');
            $jenis_bukti = $this->input->post('jenis_bukti');
            $file_bukti_pendukung2 = $_POST['file_bukti_pendukung2'];
            $r = implode(',',$is_kompeten);
            $data = $this->asesi_update_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->asesi_update_model->check_unique($data, intval($id))) {
                    if (isset($_FILES['fileToUpload']['tmp_name']) && !empty($_FILES['fileToUpload']['tmp_name'])) {
                        $siswa = $this->asesi_update_model->get(intval($id));

                        $datax['sender_id'] = $this->auth->get_user_data()->id;
                    $this->db->where('id',$datax['sender_id']);
                        $data_users = $this->db->get('t_users')->row();
                        $datax['reciepent_id'] = $siswa->pra_asesmen_checked ;
                        $datax['title'] = 'Perbaikan Pra Asesmen' ;
                        $datax['message'] = 'Perbaikan pra asesmen atas nama '.$data_users->nama_user.', Email '.$data_users->email ;

                        $this->load->model('Pesan_Model');
                        $this->Pesan_Model->insert($datax);

                        $admin = $this->db->get('r_konfigurasi_aplikasi')->row();
                        smssend($admin->sms_center,$datax['message']);
                        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();

                        $data['file_revisi_pra'] = 'lampiran_revisi_'.$id.'.zip';
                        $save_folder = $data['aplikasi']->path.$id;

                        if (!file_exists($save_folder)) {
                           mkdir($data['aplikasi']->path.$id);
                        }
                        $config['upload_path'] = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/temp/'.$id;
                        $config['allowed_types'] = '*';
                        $config['file_name'] = date("Y-m-dHis").'_'. str_replace(' ', '_', $_FILES['fileToUpload']['name']);
                        $config['max_size'] = '5120000000';

                        $this->load->library('upload', $config);

                        if ($this->upload->do_upload('fileToUpload')) {
                            $rootPath = realpath($data['aplikasi']->path.$id);
                        $zip = new ZipArchive();
                        $zip->open('assets/files/asesi/lampiran_revisi_'.$id.'.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);
                       $files = new RecursiveIteratorIterator(
                                    new RecursiveDirectoryIterator($rootPath),
                                    RecursiveIteratorIterator::LEAVES_ONLY
                                );

                        foreach ($files as $name => $file)
                        {
                            // Skip directories (they would be added automatically)
                            if (!$file->isDir())
                            {
                                // Get real and relative path for current file
                                $filePath = $file->getRealPath();
                                $relativePath = substr($filePath, strlen($rootPath) + 1);

                                // Add current file to archive
                                $zip->addFile($filePath, $relativePath);
                            }
                        }
                         $zip->close();

                        } else {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => strip_tags($this->upload->display_errors())));
                            exit();
                        }
                    }else{
                        $data['file_bukti_pendukung'] = $this->input->post('file_bukti_pendukung');
                    }
                    if ($this->asesi_update_model->update(intval($id), $data) !== false) {

                        foreach($is_kompeten as $key=>$value){
                            $data_update = array(
                                       'is_kompeten' => $value,
                                       'jenis_bukti' => $jenis_bukti[$key]
                                    );

                            $this->db->where('id', $key);
                            $this->db->update(kode_tbl().'asesi_detail', $data_update);
                        }
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan!'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->asesi_update_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        }
    }
    function cetak($id,$type = "pdf") {
        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
        //var_dump($data['aplikasi']);die();
        $this->load->model('asesi_model');
        $asesi = $this->asesi_model->data_asesi($id);
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

        $view = $this->load->view('asesi/cetak_asesi',$data , true);
		if($type=="pdf") {
			$this->load->library("htm12pdf");
			$this->htm12pdf->pdf_create($view, "data_asesi" . date('YmdHis') . ".pdf", false, true);

		}
	}
}
