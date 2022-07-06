<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Perangkat_asesmen_detail extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('perangkat_asesmen_detail_model');
       // $this->load->model('User_Model');
        //$this->load->model('perangkat_asesmen_detail_model');
       // $this->load->model('Sertifikasi_Model');
        //$this->load->library('pagination');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'perangkat_asesmen_detail_model', 'controller' => 'perangkat_asesmen_detail', 'options' => array('id' => 'perangkat_asesmen_detail', 'pagination', 'rownumber')))->load_model()->set_grid();
            $view = $this->load->view('perangkat_asesmen_detail/index', array('grid' => $grid), true);
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
            if(isset($_POST['perangkat_detail']) && !empty($_POST['perangkat_detail']))
            {
                $where['perangkat_detail like'] = '%' . $this->input->post('perangkat_detail') . '%';
            }

            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->perangkat_asesmen_detail_model->count_by($where) : $this->perangkat_asesmen_detail_model->count_all();
            $this->perangkat_asesmen_detail_model->limit($row, $offset);
            $order = $this->perangkat_asesmen_detail_model->get_params('_order');
            //$rows = isset($where) ? $this->perangkat_asesmen_detail_model->order_by($order)->get_many_by($where) : $this->perangkat_asesmen_detail_model->order_by($order)->get_all();
            $rows = $this->perangkat_asesmen_detail_model->set_params($params)->with(array('master_perangkat'));
            $data['rows'] = $this->perangkat_asesmen_detail_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        } else {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->perangkat_asesmen_detail_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->perangkat_asesmen_detail_model->check_unique($data)) {
                    if ($this->perangkat_asesmen_detail_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->perangkat_asesmen_detail_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $this->load->model('perangkat_asesmen_model');
            $nama_perangkat = $this->perangkat_asesmen_model->dropdown('id', 'nama_perangkat');

            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('perangkat_asesmen_detail/add', array('nama_perangkat'=>$nama_perangkat,'jenis_perangkat'=>array('','Uji Teori','Observasi','Tes Lisan','Wawancara','Studi Kasus')), TRUE)));
        }
    }

    function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->perangkat_asesmen_detail_model->set_validation()->validate();

        } else {
            $perangkat_asesmen_detail = $this->perangkat_asesmen_detail_model->get(intval($id));
            if (sizeof($perangkat_asesmen_detail) == 1) {
                $data_aplikasi = $this->db->get('r_konfigurasi_aplikasi')->row();
                $this->load->model('perangkat_asesmen_model');
                $nama_perangkat = $this->perangkat_asesmen_model->dropdown('id', 'nama_perangkat');


               $view = $this->load->view('perangkat_asesmen_detail/edit', array('data_aplikasi'=>$data_aplikasi,'nama_perangkat'=>$nama_perangkat,'data' => $this->perangkat_asesmen_detail_model->get_single($perangkat_asesmen_detail),'jenis_perangkat'=>array('','Uji Teori','Observasi','Tes Lisan','Wawancara','Studi Kasus'),'url' => base_url() . 'perangkat_asesmen_detail/edit_upload/' . $id), TRUE);
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
            $roles = $this->perangkat_asesmen_detail_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->perangkat_asesmen_detail_model->delete(intval($id))) {
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
        //$this->load->model('perangkat_asesmen_detail_model');
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
        $data['total'] = isset($where) ? $this->perangkat_asesmen_detail_model->count_by($where) : $this->perangkat_asesmen_detail_model->count_all();
        $this->perangkat_asesmen_detail_model->limit($row, $offset);
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
            $order = $this->perangkat_asesmen_detail_model->get_params('_order');
        }
        $rows = isset($where) ? $this->perangkat_asesmen_detail_model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->perangkat_asesmen_detail_model->order_by($order, $order_criteria, $_order_escape)->get_all();
        $data['rows'] = $this->perangkat_asesmen_detail_model->get_selected()->data_formatter($rows);
        //var_dump($data);
        echo json_encode($data);
    }
    function cetak($id,$type = "pdf") {
        ini_set('memory_limit', '51208M');
        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
        $perangkat_asesmen_detail = $this->perangkat_asesmen_detail_model->data_perangkat_asesmen_detail($id);
        $data['data_perangkat_asesmen_detail'] = $perangkat_asesmen_detail;
        $unit_kompetensi = $this->perangkat_asesmen_detail_model->data_unit_kompetensi($perangkat_asesmen_detail->skema_sertifikasi);
        $data['unit_kompetensi'] = $unit_kompetensi;
        $perangkat_asesmen_detail_detail = $this->perangkat_asesmen_detail_model->perangkat_asesmen_detail_detail($id);
        $data['perangkat_asesmen_detail_detail'] = $perangkat_asesmen_detail_detail;

        $kode_unit = '';
        $unit = '';
        $elemen_kuk ="";
        $unit_mak ="";
        //var_dump($unit_kompetensi);die();
        foreach($unit_kompetensi as $key=>$value){
            $kode_unit.=($key+1).'. '.$value->id_unit_kompetensi.'<br/>';
            $unit.=($key+1).'. '.$value->unit_kompetensi.'<br/>';
            $query_elemen = $this->perangkat_asesmen_detail_model->elemen($value->id_unit_kompetensi);
            $detail_elemen = "";
            if(count($query_elemen) > 0){
            foreach($query_elemen as $keys=>$values){
               $query_kuk = $this->perangkat_asesmen_detail_model->kuk($values->id);
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
        foreach($perangkat_asesmen_detail_detail as $key=>$value){
            $jenis_bukti[]=$value->jenis_bukti;
        }
        $bukti = unserialize($perangkat_asesmen_detail->bukti_pendukung);
        $jenis_bukti = implode(',',$bukti);
        $data['jenis_bukti'] = $jenis_bukti;
        $data['kode_unit'] = $kode_unit;
        $data['unit'] = $unit;
        $data['msg'] = $perangkat_asesmen_detail->nama_lengkap."\r\n\n\n".$data['aplikasi']->url_aplikasi."/qrcode/perangkat_asesmen_detail/".$id;

        $view = $this->load->view('perangkat_asesmen_detail/cetak_perangkat_asesmen_detail',$data , true);
        if($type=="pdf") {
            $this->load->library("htm12pdf");
            $this->htm12pdf->pdf_create($view, "data_perangkat_asesmen_detail" . date('YmdHis') . ".pdf", false, true);

        }
    }
    function cetak_pencarian($par1="",$par2="",$par3="",$type = "pdf") {
        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
        $this->db->select('a.*,b.skema');
        $this->db->from(kode_tbl().'perangkat_asesmen_detail a');
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
        $data['data_perangkat_asesmen_detail'] = $this->db->get()->result();
        $view = $this->load->view('perangkat_asesmen_detail/cetak_pencarian_perangkat_asesmen_detail',$data , true);
        if($type=="pdf") {
            $this->load->library("htm12pdf");
            $this->htm12pdf->pdf_create($view, "data_perangkat_asesmen_detail" . date('YmdHis') . ".pdf", false, true,'L');

        }
    }
    function search() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->model('perangkat_asesmen_detail_model');
            $view = $this->load->view('perangkat_asesmen_detail/search', array(), TRUE);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));

        } else {
            block_access_method();
        }
    }

    function upload() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = $this->perangkat_asesmen_detail_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->perangkat_asesmen_detail_model->check_unique($data)) {
                    if (isset($_FILES['fileToUpload']['tmp_name']) && !empty($_FILES['fileToUpload']['tmp_name'])) {
                        $data['file_detail'] = date('Y-m-d').str_replace(' ', '_', $_FILES['fileToUpload']['name']);
                        $config['upload_path'] = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/files/perangkat_asesmen/';
                        $config['allowed_types'] = '*';
                        $config['max_size'] = '512000000';
                        $config['file_name'] = $data['file_detail'];
                        $this->load->library('upload', $config);

                        if (!$this->upload->do_upload('fileToUpload')) {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => $this->upload->display_errors()));
                            exit();
                        }
                    } else {
                        $data['file_detail'] = "";
                    }
                   // $data['author'] = $this->auth->get_user_data()->id;
                    if ($this->perangkat_asesmen_detail_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", strip_tag($this->perangkat_asesmen_detail_model->get_validation()))));
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
                $docs = $this->perangkat_asesmen_detail_model->get(intval($id));
                if(sizeof($docs) == 1)
                {
                    $doc = $this->perangkat_asesmen_detail_model->get_single($docs);
                    $files = substr(__dir__,0, strpos( __dir__,"application")) . 'assets/files/perangkat_asesmen/' . $doc->file_detail;
                    if(file_exists($files))
                    {
                        header('Cache-Control: public');
                        header('Content-Disposition: attachment; filename="' . $doc->file_detail . '"');
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
    function edit_upload($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = $this->perangkat_asesmen_detail_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->perangkat_asesmen_detail_model->check_unique($data, intval($id))) {
                    if (isset($_FILES['fileToUpload']['tmp_name']) && !empty($_FILES['fileToUpload']['tmp_name'])) {
                        $siswa = $this->perangkat_asesmen_detail_model->get(intval($id));
                        $data['foto'] = rand().str_replace(' ', '_', $_FILES['fileToUpload']['name']);
                        $config['upload_path'] = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/files/perangkat_asesmen/';
                        $config['allowed_types'] = '*';
                        $config['file_name'] = $data['foto'];
                        $config['max_size'] = '51200000';

                        $this->load->library('upload', $config);

                        if ($this->upload->do_upload('fileToUpload')) {
                            $current_file = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/files/perangkat_asesmen/' . $siswa->file_detail;
                            if (is_file($current_file)) {
                                unlink($current_file);
                            }
                        } else {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => strip_tags($this->upload->display_errors())));
                            exit();
                        }
                    }else{
                        $data['file_detail'] = $this->input->post('foto_hidden');
                    }

                    if ($this->perangkat_asesmen_detail_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->perangkat_asesmen_detail_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        }
    }

}
