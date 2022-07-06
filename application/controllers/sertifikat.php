<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Sertifikat extends MY_Controller {
function __construct() {
        parent::__construct();
        $this->load->model('sertifikat_model');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'sertifikat_model', 'controller' => 'sertifikat', 'options' => array('id' => 'sertifikat', 'pagination', 'rownumber')))->load_model()->set_grid();
            $view = $this->load->view('sertifikat/index', array('grid' => $grid), true);
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
                $asesi_id = $this->auth->get_user_data()->id;
                $where['id ='] = $asesi_id;
            }else if($jenis_user == 2){
                $asesi_id = $this->auth->get_user_data()->pegawai_id;
                $where['id_asesor ='] = $asesi_id;
            }else if($jenis_user == 1){
                $asesi_id = $this->auth->get_user_data()->id;
                $where[kode_tbl().'asesi.id_users ='] = $asesi_id;
            }
            $where['terbitkan_sertifikat ='] = 'on';

            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->sertifikat_model->count_by($where) : $this->sertifikat_model->count_all();
            $this->sertifikat_model->limit($row, $offset);
            $order = $this->sertifikat_model->get_params('_order');
            $rows = $this->sertifikat_model->set_params($params)->with(array('skema','user','jadwal_asesmen','tuk','asesor'));
            $data['rows'] = $this->sertifikat_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        } else {
            block_access_method();
        }
    }

    function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->sertifikat_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->sertifikat_model->check_unique($data, intval($id))) {
                    $data['mak01'] = serialize($this->input->post('mak01'));
                    $data['mak02'] = serialize($this->input->post('mak02'));
                    $data['mak02a'] = serialize($this->input->post('mak02a'));
                    $data['mak03'] = serialize($this->input->post('mak03'));
                    $data['mak04'] = serialize($this->input->post('mak04'));
                    $data['mak04a'] = serialize($this->input->post('mak04a'));
                    $data['mak05'] = serialize($this->input->post('mak05'));
                    $data['mak05a'] = serialize($this->input->post('mak05a'));
                    $data['mak06'] = serialize($this->input->post('mak06'));
                    $data['mak06a'] = serialize($this->input->post('mak06a'));
                    $data['mak06b'] = serialize($this->input->post('mak06b'));
                    $data['mak07'] = serialize($this->input->post('mak07'));

                    if ($this->sertifikat_model->update(intval($id), $data) !== false) {
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
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->sertifikat_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $asesi = $this->sertifikat_model->get(intval($id));
            if (sizeof($asesi) == 1) {
                $this->load->model('asesi_model');
                $this->load->library('combogrid');
                $jadwal_grid = $this->combogrid->set_properties(array('model' => 'jadwal_asesmen_model', 'controller' => 'jadwal_asesmen', 'fields' => array('jadual', 'tanggal'), 'options' => array('id' => 'jadwal_id', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'jadual', 'panelWidth' => 500)))->load_model()->set_grid();
                $asesor_grid = $this->combogrid->set_properties(array('model' => 'asesor_model', 'controller' => 'asesor', 'fields' => array('users', 'no_reg'), 'options' => array('id' => 'id_asesor', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'users', 'panelWidth' => 500)))->load_model()->set_grid();
                $tuk_grid = $this->combogrid->set_properties(array('model' => 'tuk_model', 'controller' => 'tuk', 'fields' => array('tuk', 'alamat'), 'options' => array('id' => 'id_tuk', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'tuk', 'panelWidth' => 500)))->load_model()->set_grid();
                $this->db->where('asesi_id',$id);
                $detail_asesi = $this->db->get(kode_tbl().'asesi_detail')->result_array();
                foreach($detail_asesi as $key=>$value){
                    $jenis_bukti[]=$value['jenis_bukti'];
                }
                $jenis_bukti = implode(',',array_unique($jenis_bukti));

                $unit_kompetensi = $this->asesi_model->data_unit_kompetensi($asesi->skema_sertifikasi);
                //unserialize data mak
                $mak01 = unserialize($asesi->mak01);
                $mak02 = unserialize($asesi->mak02);
                $mak02a = unserialize($asesi->mak02a);
                $mak03 = unserialize($asesi->mak03);
                $mak04 = unserialize($asesi->mak04);
                $mak04a = unserialize($asesi->mak04a);
                $mak05 = unserialize($asesi->mak05);
                $mak05a = unserialize($asesi->mak05a);
                $mak06 = @unserialize($asesi->mak06);
                $mak06a = @unserialize($asesi->mak06a);
                $mak06b = @unserialize($asesi->mak06b);
                $mak07 = @unserialize($asesi->mak07);
                //var_dump($mak04);die();
                $view = $this->load->view('sertifikat/edit', array('detail_asesi'=>$detail_asesi,'data' => $this->sertifikat_model->get_single($asesi)
                ,'jadwal_grid' => $jadwal_grid
                ,'asesor_grid' => $asesor_grid
                ,'tuk_grid' => $tuk_grid
                ,'mak01' => $mak01
                ,'mak02' => $mak02
                ,'mak02a' => $mak02a
                ,'mak03' => $mak03
                ,'mak04' => $mak04
                ,'mak04a' => $mak04a
                ,'mak05' => $mak05
                ,'mak05a' => $mak05a
                ,'mak06' => $mak06
                ,'mak06a' => $mak06a
                ,'mak06b' => $mak06b
                ,'mak07' => $mak07
                ,'jenis_bukti' => $jenis_bukti
                ,'unit_kompetensi' => $unit_kompetensi
                ,'rekomendasi_asesor' => array('-Pilih-','Kompeten','Belum Kompeten')
                ,'metode_terima_sertifikat' => array('-Pilih-','Di ambil langsung di LSP','Di ambil langsung di TUK','Di kirim melalui POS','Dititipkan kepada pemegang sertifikat yang lain')
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
            $data = $this->sertifikat_model->set_validation()->validate();

            if ($data !== false) {
                if ($this->sertifikat_model->check_unique($data, intval($id))) {
                    if (isset($_FILES['fileToUpload']['tmp_name']) && !empty($_FILES['fileToUpload']['tmp_name'])) {
                        $siswa = $this->sertifikat_model->get(intval($id));
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
                    if ($this->sertifikat_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->sertifikat_model->get_validation())));
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
            $roles = $this->sertifikat_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->sertifikat_model->delete(intval($id))) {
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
		$this->load->model('v_sertifikat_model');
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
		$data['total'] = isset($where) ? $this->v_sertifikat_model->count_by($where) : $this->v_sertifikat_model->count_all();
		$this->v_sertifikat_model->limit($row, $offset);
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
			$order = $this->v_sertifikat_model->get_params('_order');
		}
		$rows = isset($where) ? $this->v_sertifikat_model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->v_sertifikat_model->order_by($order, $order_criteria, $_order_escape)->get_all();
		$data['rows'] = $this->v_sertifikat_model->get_selected()->data_formatter($rows);
        //var_dump($data);
		echo json_encode($data);
	}
    function cetak($id) {
        $data['sertifikat'] = $this->sertifikat_model->sertifikat($id);
        $this->load->model('asesi_model');
        $data['unit'] = $this->asesi_model->data_unit_kompetensi($data['sertifikat']->skema_sertifikasi);

        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
        $this->load->view('sertifikat/view',$data);

    }
    function file()
        {
            $segment_array = $this->uri->segment_array();

            // first and second segments are the controller and method
            $controller = array_shift( $segment_array );
            $method = array_shift( $segment_array );

            // absolute path using additional segments
            $path_in_url = 'assets/files/repositori/';
            foreach ( $segment_array as $segment ) $path_in_url.= $segment.'/';
            $absolute_path = getcwd().'/'.$path_in_url;
            $absolute_path = rtrim( $absolute_path ,'/' );

            // check if it is a path or file
            if ( is_dir( $absolute_path ))
            {
                // link generation helper
                $this->load->helper('url');

                $dirs = array();
                $files = array();
                // fetching directory
                if ( $handle = @opendir( $absolute_path ))
                {
                    while ( false !== ($file = readdir( $handle )))
                    {
                        if (( $file != "." AND $file != ".." ))
                        {
                            if ( is_dir( $absolute_path.'/'.$file ))
                            {
                                $dirs[]['name'] = $file;
                            }
                            else
                            {
                                $files[]['name'] = $file;
                            }
                        }
                    }
                    closedir( $handle );
                    sort( $dirs );
                    sort( $files );

                }
                // parent folder
                // ensure it exists and is the first in array
                if ( $path_in_url != '' )
                    array_unshift ( $dirs, array( 'name' => '..' ));

                // view data
                $file = array(
                    'controller' => $controller,
                    'method' => $method,
                    'virtual_root' => getcwd(),
                    'path_in_url' => $path_in_url,
                    'dirs' => $dirs,
                    'files' => $files,
                    );
                $data['file'] = $file;
                $view = $this->load->view('sertifikat/file',$file);
                return $view;
            }
            else
            {
                // is it a file?
                if ( is_file($absolute_path) )
                {
                    // open it
                    header ('Cache-Control: no-store, no-cache, must-revalidate');
                    header ('Cache-Control: pre-check=0, post-check=0, max-age=0');
                    header ('Pragma: no-cache');

                    $text_types = array(
                        'php', 'css', 'js', 'html', 'txt', 'htaccess', 'xml'
                        );
                    $path_parts = pathinfo($absolute_path);
                    // download necessary ?
                    if( isset($path_parts['extension']) && in_array( $path_parts['extension'], $text_types) ) {
                        header('Content-Type: text/plain');
                    } else {
                        header('Content-Type: application/x-download');
                        header('Content-Length: ' . filesize( $absolute_path ));
                        header('Content-Disposition: attachment; filename=' . basename( $absolute_path ));
                    }

                    @readfile( $absolute_path );
                }
                else
                {
                    show_404();
                }
            }
        }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            //$this->load->model('asesi_model');
            $view = $this->load->view('sertifikat/search', array(), TRUE);
            echo json_encode(array('msgType'=>'success', 'msgValue'=>$view, 'title'=>'Cetak Data Blanko', 'width'=>600, 'height'=>400));

        } else {
            block_access_method();
        }
    }
    function elfinder($start,$end)
    {
        $this->load->library("phpexcel/PHPExcel");
        $this->load->library("phpexcel/PHPExcel/IOFactory");
        $asesi = kode_tbl().'asesi';
        $users = kode_tbl().'users';
        $tuk = kode_tbl().'tuk';
        $skema = kode_tbl().'skema';

        $data['default']=$this->db->query("SELECT a.id,a.nama_lengkap,a.tempat_lahir,a.tgl_lahir,a.organisasi,a.rekomendasi_asesor,
            CASE a.rekomendasi_asesor WHEN '1' THEN 'K' WHEN '2' THEN 'BK' ELSE ' NULL' END as kondisi,
            b.users,
            c.tuk,
            d.skema
            FROM $asesi a
            LEFT JOIN $users b ON b.id=a.id_asesor
            LEFT JOIN $tuk c ON c.id=a.id_tuk
            JOIN $skema d ON d.id=a.skema_sertifikasi WHERE a.u_date_create BETWEEN '$start' AND '$end'")->result_array();
        $excel = new PHPExcel();
        $excel->setActiveSheetIndex(0);
        $page = $excel->getActiveSheet();
        $page->setTitle("Rekap Sertifikasi");
        $header_style = array(
                            "borders" => array(
                                "allborders" => array(
                                    "style" => PHPExcel_Style_Border::BORDER_THIN
                                )
                            ),
                            "alignment" => array(
                                "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                            ),
                            "font" => array(
                                "bold" => true
                            ),
                            'fill' => array(
                                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array('rgb' => '#5bc0de')
                            )
        );
        $body_style_huruf = array(
                                "borders" => array(
                                    "allborders" => array(
                                        "style" => PHPExcel_Style_Border::BORDER_THIN
                                        )
                                    ),
                                    "alignment" => array(
                                        "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                                        "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                                    )
        );
        $italic_center = array(
                            "borders" => array(
                                "allborders" => array(
                                    "style" => PHPExcel_Style_Border::BORDER_THIN
                            )
                                ),
                            "alignment" => array(
                                "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                            ),
                            "font" => array(
                                "italic" => true,
                                "bold" => false
                            )
        );
        $center = array(
                    "borders" => array(
                        "allborders" => array(
                            "style" => PHPExcel_Style_Border::BORDER_THIN
                        )
                    ),
                    "alignment" => array(
                        "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                    )
        );
        $bordered = array(
                        "borders" => array(
                            "allborders" => array(
                            "style" => PHPExcel_Style_Border::BORDER_THIN
                            )
                        )
        );
        $page->getColumnDimension("A")->setWidth(9);
        $a="A";
        for($i=0;$i<=8;$i++){
                $a++;
                $page->getColumnDimension("$a")->setWidth(20);;
        }
        $page->setCellValue("A1","No");
        //$page->mergeCells("A1:A1");
        $a="A";
        $abc=array(
            "Nama Lengkap",
            "Tempat Lahir",
            "Tanggal Lahir",
            "Keputusan",
            "Organisasi",
            "Skema Sertifikasi",
            "Tempat Uji Kompetensi",
            "Nama Asesor"
        );
        for($i=0;$i<=7;$i++){
            $a++;
            $page->setCellValue($a."1",$abc[$i]);
            $page->mergeCells($a."1:".$a."1");
        }
        $page->getStyle("A1:I1")->applyFromArray($header_style);
        $pos = 2;
        $no=0;
        for($i=0;$i<count($data['default']);$i++){
        $no++;
            $page->setCellValue("A".($i+2), $i + 1);
            $page->setCellValue("B".($i+2), $data['default'][$i]['nama_lengkap']);
            $page->setCellValue("C".($i+2), $data['default'][$i]['tempat_lahir']);
            $page->setCellValue("D".($i+2), tgl_indo($data['default'][$i]['tgl_lahir']));
            $page->setCellValue("E".($i+2), $data['default'][$i]['kondisi']);
            $page->setCellValue("F".($i+2), $data['default'][$i]['organisasi']);
            $page->setCellValue("G".($i+2), $data['default'][$i]['skema']);
            $page->setCellValue("H".($i+2), $data['default'][$i]['tuk']);
            $page->setCellValue("I".($i+2), $data['default'][$i]['users']);
            $pos++;
        }
        $page->getStyle("A1:I".($pos-1))->applyFromArray($bordered);
        //$date_export = date('Y-m-d H:i:s');
        $objWriter = IOFactory::createWriter($excel, 'Excel5');
        $objWriter->save("assets/sertifikasi.xls");
        redirect ("assets/sertifikasi.xls");
    }
    function cetak_sertifikat($id,$type = "pdf") {
        $data['sertifikat'] = $this->sertifikat_model->sertifikat($id);
        $this->load->model('asesi_model');
        $data['unit'] = $this->asesi_model->data_unit_kompetensi($data['sertifikat']->skema_sertifikasi);
        //var_dump($data['unit']);die();
        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
        //$this->load->view('sertifikat/tanda_terima',$data);
        $view = $this->load->view('sertifikat/vtanda_terima',$data , true);
        if($type=="pdf") {
            $this->load->library("htm12pdf");
            $this->htm12pdf->pdf_create($view, "tanda_terima" . date('YmdHis') . ".pdf", false, true,'P');

        }
    }
}
