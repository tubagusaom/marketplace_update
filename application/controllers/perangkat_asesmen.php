<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Perangkat_asesmen extends MY_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('perangkat_asesmen_model');
        // $this->load->model('t_pertanyaan');
        $this->load->model('artikel_model');
        // $this->load->model('Tryout_model');
		$this->load->helper('text');
        // $this->load->model('User_Model');
        //$this->load->model('artikel_model');
        // $this->load->model('Sertifikasi_Model');
        //$this->load->library('pagination');
    }
    function upload() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = $this->perangkat_asesmen_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->perangkat_asesmen_model->check_unique($data)) {
                    if (isset($_FILES['fileToUpload']['tmp_name']) && !empty($_FILES['fileToUpload']['tmp_name'])) {
                        $data['file_perangkat'] = str_replace(' ', '_', $_FILES['fileToUpload']['name']);
                        $config['upload_path'] = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/files/perangkat_asesmen/';
                        $config['allowed_types'] = '*';
                        $config['max_size'] = '512000000';

                        $this->load->library('upload', $config);

                        if (!$this->upload->do_upload('fileToUpload')) {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => $this->upload->display_errors()));
                            exit();
                        }
                    } else {
                        $data['file_perangkat'] = "";
                    }
                    $data['author'] = $this->auth->get_user_data()->id;
                    if ($this->perangkat_asesmen_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", strip_tag($this->perangkat_asesmen_model->get_validation()))));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        }
    }

    function upload_ajax() {
        $deskripsi = $this->input->post('deskripsi');
        $file = $_FILES['file'];

        $id_asesor = $this->auth->get_user_data()->pegawai_id;
        $id_perangkat_detail = $this->input->post('id_perangkat_detail');

        $data = array('deskripsi' => $deskripsi, 'Files' => $file);

        echo json_encode($data);
    }

    function download($id = false) {
        if (!$id) {
            block_access_method();
        } else {
            if ($_SERVER['REQUEST_METHOD'] == "GET") {
                $docs = $this->perangkat_asesmen_model->get(intval($id));
                if (sizeof($docs) == 1) {
                    $doc = $this->perangkat_asesmen_model->get_single($docs);
                    $files = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/files/perangkat_asesmen/' . $doc->file_perangkat;
                    if (file_exists($files)) {
                        header('Cache-Control: public');
                        header('Content-Disposition: attachment; filename="' . $doc->file_perangkat . '"');
                        readfile($files);
                        //$this->db->query("UPDATE t_repositori SET jumlah_download=jumlah_download+1 WHERE id= $id");
                        //
                        //redirect(base_url());
                        die();
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'File tidak dapat ditemukan'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan'));
                }
            }
        }
    }
    function detail($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        $this->load->model('perangkat_asesmen_detail_model');
        $con_method = $this->perangkat_asesmen_detail_model->get(intval($id));
        if (sizeof($con_method) == 1) {
            $data_user = $this->auth->get_user_data();

            $detail_perangkat = $this->perangkat_asesmen_model->detail_soal($id);

            $this->db->select('id_asesor,skema_sertifikasi');
            $this->db->where('id', $data_user->pegawai_id);
            $detail_asesi = $this->db->get(kode_tbl() . 'asesi')->row();
            //var_dump($detail_asesi);
            //$this->load->model('angkatan_model');
            //$this->load->model('program_model');
            //$angkatan = $this->angkatan_model->dropdown('id', 'batch_name');
            //$program = $this->program_model->dropdown('id', 'program_study');


            $jenis_user = $this->auth->get_user_data()->jenis_user;
            if ($jenis_user == 1) {
                $views = 'detail';
            } else {
                $views = 'detail';
            }
            //$views = 'detail_asesi';

            $data = $this->perangkat_asesmen_detail_model->get_single($con_method);
//var_dump($detail_perangkat);die();
            $peserta_uji = $this->perangkat_asesmen_model->peserta_uji($id, $data_user->pegawai_id);
//var_dump($peserta_uji);
//die();

            $this->load->view('perangkat_asesmen/' . $views, array(
                'detail_perangkat' => $detail_perangkat,
                'data_user' => $data_user,
                'peserta_uji' => $peserta_uji,
                'id' => $id,
                'jenis_soal' => array('', 'Uji Teori', 'Observasi', 'Tes Lisan', 'Wawancara', 'Studi Kasus'),
                'detail_asesi' => $detail_asesi,
                'data' => $data,
                    //'url' => base_url() . 'siswa/edit_upload/' . $id
            ));
        } else {
            $this->load->view('perangkat_asesmen/detail', array(), TRUE);
        }
    }

    function uji($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        $this->load->model('perangkat_asesmen_detail_model');
        $con_method = $this->perangkat_asesmen_detail_model->get(intval($id));
        if (sizeof($con_method) == 1) {
            $data_user = $this->auth->get_user_data();

            $detail_perangkat = $this->perangkat_asesmen_model->detail_soal($id);
            //$perangkat = $this->perangkat_asesmen_detail_model->get(intval($id));
            //var_dump($perangkat);die();
            $this->db->select('id,id_asesor,skema_sertifikasi');
            $this->db->where('id_users', $data_user->pegawai_id);
            $detail_asesi = $this->db->get(kode_tbl() . 'asesi')->row();

            $jenis_user = $this->auth->get_user_data()->jenis_user;
            if ($jenis_user == 1) {
                $views = 'templates/responsive/uji/start_uji'; //detail_asesi
            } else {
                $views = 'perangkat_asesmen/detail';
            }

            $data = $this->perangkat_asesmen_detail_model->get_single($con_method);

            $peserta_uji = $this->perangkat_asesmen_model->peserta_uji($id, $data_user->pegawai_id);

//            $data['data'] = $this->artikel_model->detail(@$id);
//            $data['berita_lainnya'] = $this->artikel_model->berita_lainnya();
//            $data['marquee'] = $this->artikel_model->marquee();
            //var_dump($detail_asesi); die();
            $this->load->view($views, array(
                'aplikasi' => $this->db->get('r_konfigurasi_aplikasi')->row(),
                'detail_perangkat' => $detail_perangkat,
                'data_user' => $data_user,
                'peserta_uji' => $peserta_uji,
                'id' => $id,
                'jenis_soal' => array('', 'Uji Teori', 'Observasi', 'Tes Lisan', 'Wawancara', 'Studi Kasus'),
                'detail_asesi' => $detail_asesi,
                'data' => $data,
                    //'url' => base_url() . 'siswa/edit_upload/' . $id
            ));
        } else {
            $this->load->view('perangkat_asesmen/detail', array(), TRUE);
        }
    }

    function view_uji($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        $this->load->model('perangkat_asesmen_detail_model');
        $con_method = $this->perangkat_asesmen_detail_model->get(intval($id));
        if (sizeof($con_method) == 1) {

            $data['pertanyaan'] = $this->db->get('t_pertanyaan')->result();
            $data['detail_perangkat'] = $this->perangkat_asesmen_model->detail_soal($id);
            $data['data'] = $this->perangkat_asesmen_detail_model->get_single($con_method);
            $data_user = $this->auth->get_user_data();
            $this->db->where('id_users', $data_user->pegawai_id);
            $data['data_asesi'] = $this->db->get(kode_tbl() . 'asesi')->row();
            //$this->load->view('templates/responsive/uji/view', $data);
            $this->load->view('templates/responsive/uji/view_uji', $data);
        } else {
            $this->load->view('perangkat_asesmen/detail', array(), TRUE);
        }
    }

    function proses_uji() {
        $this->load->helper('postinger');
        $post = $this->input->post();

        //var_dump($post); die();

        $jawab_benar = 0;
        $jawab_salah = 0;
        $data = array();
        foreach ($post['idsoal'] as $key => $idsoal) {
            $cek_soal = $this->db
                            ->where('id', $idsoal)
                            ->where('jawaban', $post['opsi_' . $key])
                            ->get('t_pertanyaan')->num_rows();
            if ($cek_soal > 0) {
                $jawab_benar++;
            } else {
                $jawab_salah++;
            }

            $data[] = array('id_soal' => $idsoal, 'opsi_asesi' => $post['opsi_' . $key]);
        }

        $data_soal = serialize($data);

        $dt['jawaban_asesi'] = $data_soal;
        $dt['jawaban_benar'] = $jawab_benar;
        $dt['jawaban_salah'] = $jawab_salah;
        $dt['tanggal_posting'] = date('Y-m-d H:i:s');
        $dt['created_by'] = 0;
        $dt['created_when'] = date('Y-m-d H:i:s');

        $result = $this->db->insert('t_uji', $dt);
        if ($result) {
            echo json_encode(array('msgType' => true, 'msgValue' => 'Terima kasih sudah melakukan Uji !'));
        } else {
            echo json_encode(array('msgType' => false, 'mshValue' => 'Maaf data Uji anda gagal disimpan !'));
        }
    }

    function save() {
        //$namafile = $this->input->post('namafile');
        $id_asesi = $this->input->post('id_asesi');
        $id_asesor = $this->input->post('id_asesor');
        $id_skema = $this->input->post('id_skema');
        $id_perangkat_detail = $this->input->post('id_perangkat_detail');

        if ($_FILES['namafile']['name'] != '') {

            $ukuran_file = $_FILES['namafile']['size'];

            if ($ukuran_file > 90728640) {
                $size_in_mb = round($ukuran_file / 1024000, 2) . ' MB';
                echo 'Maximum file upload 90 MB. ! File anda ' . $size_in_mb;
                die();
            }
            $config['upload_path'] = "assets/files/hasil_uji/";
            $config['upload_url'] = "assets/files/hasil_uji/";
            $config['allowed_types'] = '*';
            $config['max_size'] = '90728640';
            $config['remove_spaces'] = TRUE;
            $file_name = $id_asesi . time() . str_replace(' ', '_', $_FILES['namafile']['name']);
            $config['file_name'] = $file_name;

            $this->load->library('upload');
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('namafile')) {
                echo"Upload Gagal";
                die();
            }

            $data_update = array(
                'file_jawaban' => $file_name,
                'id_asesi' => $id_asesi,
                'id_asesor' => $id_asesor,
                'id_skema' => $id_skema,
                'id_perangkat_detail' => $id_perangkat_detail,
                'jawaban_benar' => '0',
                'jawaban_salah' => '0'
            );

            //$this->db->where('id',$id_asesi);
            if ($this->db->insert('t_uji', $data_update)) {
                echo"Upload Jawaban Sukses";
            }
        } else {
            $opsi = $this->input->post('opsi');
            //var_dump($id_asesi);die();
            if (isset($opsi)) {
                $jumlah_soal = count($opsi);
                $jawaban = $this->perangkat_asesmen_model->jawaban($id_perangkat_detail);

                //var_dump($jawaban);die();
                $jawaban_benar = 0;
                foreach ($opsi as $key => $value) {
                    if ($value == $jawaban[$key]['jawaban_benar']) {
                        $jawaban_benar++;
                    }
                }

                //var_dump($jawaban_benar);die();
                $jawaban_salah = $jumlah_soal - $jawaban_benar;

                $array_opsi = serialize($opsi);
                $data_update = array(
                    'id_asesi' => $id_asesi,
                    'id_asesor' => $id_asesor,
                    'id_skema' => $id_skema,
                    'id_perangkat_detail' => $id_perangkat_detail,
                    'jawaban_asesi' => $array_opsi,
                    'jawaban_benar' => $jawaban_benar,
                    'jawaban_salah' => $jawaban_salah
                );
            } else {
                $data_update = array(
                    'id_asesi' => $id_asesi,
                    'id_asesor' => $id_asesor,
                    'id_skema' => $id_skema,
                    'id_perangkat_detail' => $id_perangkat_detail,
                );
            }
            //$this->db->where('id',$id_asesi);
            if ($this->db->insert('t_uji', $data_update)) {
                //echo"Upload Jawaban Sukses";
                echo json_encode(array('msgType' => true, 'msgValue' => 'Upload Jawaban Sukses'));
            } else {
                echo json_encode(array('msgType' => false, 'msgValue' => 'Upload Jawaban Gagal'));
            }
        }
    }

    function edit_upload($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->perangkat_asesmen_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->perangkat_asesmen_model->check_unique($data, intval($id))) {
                    if (isset($_FILES['fileToUpload']['tmp_name']) && !empty($_FILES['fileToUpload']['tmp_name'])) {
                        $schedule = $this->perangkat_asesmen_model->get(intval($id));
                        $data['file_perangkat'] = rand() . '_' . str_replace(' ', '_', $_FILES['fileToUpload']['name']);
                        $config['upload_path'] = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/files/perangkat_asesmen/';
                        $config['allowed_types'] = '*';
                        $config['file_name'] = $data['file_perangkat'];
                        $config['max_size'] = '0';

                        $this->load->library('upload', $config);

                        if ($this->upload->do_upload('fileToUpload')) {
                            $current_file = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/files/perangkat_asesmen/' . $schedule->file_perangkat;
                            if (is_file($current_file)) {
                                unlink($current_file);
                            }
                            $data_upload = $this->upload->data();
                        } else {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => strip_tags($this->upload->display_errors())));
                            exit();
                        }
                    } else {
                        $data['file_perangkat'] = $this->input->post('foto_hidden');
                    }
                    if ($this->perangkat_asesmen_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->perangkat_asesmen_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        }
    }

    function save_asesor() {
        $jawaban = $this->input->post('jawaban');
        $jawaban_benar = 0;
        $jawaban_salah = 0;
        foreach ($jawaban as $value) {
            $value == 'K' ? $jawaban_benar++ : $jawaban_salah++;
        }
        //var_dump($jawaban);die();
        $array_opsi = serialize($jawaban);

        $asesiarray = $this->input->post('asesiarray');
        // var_dump($asesiarray);
        //die();
        $selectrekomendasi = $this->input->post('selectrekomendasi');
        $id_asesor = $this->auth->get_user_data()->pegawai_id;
        $id_skema = $this->input->post('id_skema');
        $id_perangkat_detail = $this->input->post('id_perangkat_detail');
        foreach ($asesiarray as $key => $value) {
            $this->db->select('id_asesor,skema_sertifikasi');
            $this->db->where('id', $value);
            $detail_asesi = $this->db->get(kode_tbl() . 'asesi')->row();

            $data_update = array(
                'id_asesi' => $value,
                'id_asesor' => $id_asesor,
                'id_skema' => $detail_asesi->skema_sertifikasi,
                'id_perangkat_detail' => $id_perangkat_detail,
                'jawaban_asesi' => $array_opsi,
                'jawaban_benar' => $jawaban_benar,
                'jawaban_salah' => $jawaban_salah,
                'penilaian_asesor' => $selectrekomendasi
            );
            $this->db->insert('t_uji', $data_update);
        }
        echo "Penilaian Sukses. Silahkan tutup halaman ini";
    }
    function portofolio($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        $this->load->model('perangkat_asesmen_detail_model');
        $con_method = $this->perangkat_asesmen_detail_model->get(intval($id));
        if (sizeof($con_method) == 1) {
            $data_user = $this->auth->get_user_data();

            $detail_perangkat = $this->perangkat_asesmen_model->detail_soal($id);
            $perangkat = $this->perangkat_asesmen_model->get(intval($con_method->id_perangkat_asesmen));
            $kuk = $this->uji_kompetensi_skema($perangkat->skema_perangkat,$detail_perangkat);

            $this->db->select('id_asesor,skema_sertifikasi');
            $this->db->where('id', $data_user->pegawai_id);
            $detail_asesi = $this->db->get(kode_tbl() . 'asesi')->row();

            //var_dump($kuk);die();

             $jenis_user = $this->auth->get_user_data()->jenis_user;
            if ($jenis_user == 1) {
                $views = 'detail_portofolio_asesi';
            } else {
                $views = 'detail_portofolio';
            }

            $data = $this->perangkat_asesmen_detail_model->get_single($con_method);
            $peserta_uji = $this->perangkat_asesmen_model->peserta_uji($id, $data_user->pegawai_id);
            $this->load->view('perangkat_asesmen/' . $views, array(
                'detail_perangkat' => $detail_perangkat,
                'data_user' => $data_user,
                'peserta_uji' => $peserta_uji,
                'id' => $id,
                'jenis_soal' => array('', 'Uji Teori', 'Observasi', 'Tes Lisan', 'Wawancara', 'Studi Kasus','Cek Portofolio'),
                'data' => $data,
                'kuk' => $kuk,
             ));
        } else {
            $this->load->view('perangkat_asesmen/detail', array(), TRUE);
        }
    }
    function save_asesor_portofolio() {
        $valid = $this->input->post('valid');
        $asli = $this->input->post('asli');
        $terkini = $this->input->post('terkini');
        $is_kompeten = $this->input->post('is_kompeten');
        $list_bukti = $this->input->post('list_bukti');
        $jawaban = array(
            "valid"=>serialize($valid),
            "asli"=>serialize($asli),
            "terkini"=>serialize($terkini),
            "is_kompeten"=>serialize($is_kompeten),
            "list_bukti"=>serialize($list_bukti),

            );
        $jawaban = serialize($jawaban);
        $asesiarray = $this->input->post('asesiarray');
        $selectrekomendasi = $this->input->post('selectrekomendasi');
        $id_asesor = $this->auth->get_user_data()->pegawai_id;
        //$id_skema = $this->input->post('id_skema');
        $id_perangkat_detail = $this->input->post('id_perangkat_detail');
        //var_dump($asesiarray); die();
        foreach ($asesiarray as $key => $value) {
            $this->db->select('id_asesor,skema_sertifikasi');
            $this->db->where('id', $value);
            $detail_asesi = $this->db->get(kode_tbl() . 'asesi')->row();

            $data_update = array(
                'id_asesi' => $value,
                'id_asesor' => $id_asesor,
                'id_skema' => $detail_asesi->skema_sertifikasi,
                'id_perangkat_detail' => $id_perangkat_detail,
                'jawaban_asesi' => $jawaban,
                'jawaban_salah' => "",
                'penilaian_asesor' => $selectrekomendasi
            );
            $this->db->insert('t_uji', $data_update);
        }
        echo "Penilaian Sukses. Silahkan tutup halaman ini";
    }
    function uji_kompetensi_skema($id,$detail_perangkat) {
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
                            <input type="checkbox" id="all_k" name="all_k" />
                            </td>
                            <td width="30px" align="center"> N<br/>
                            <input type="checkbox" id="all_bk" name="all_k" /> </td>
                            <td> Bukti No </td>
                        </tr>';
        $no = 1;
        $real_unit = "";
        $real_elemen = "";
        foreach ($d as $key => $value) {
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
                            <td align="center"> <input type="radio" required name="is_kompeten[' . $key . ']"  value="k" class="value_k"/> </td>
                            <td align="center"> <input type="radio" required name="is_kompeten[' . $key . ']" value="bk" class="value_bk"/></td>
                            <td class="select_bukti"> '.$combo.'
                            </td>
                          </tr>';
                } else {

                    $table .= ' <tr style="font-weight:normal;">
                            <td align="center"></td>
                            <td></td>
                            <td> ' . ltrim($value->kuk) . ' </td>
                            <td align="center"> <input type="radio" required name="is_kompeten[' . $key . ']"  value="k" class="value_k"/> </td>
                            <td align="center"> <input type="radio" required name="is_kompeten[' . $key . ']" value="bk" class="value_bk"/></td>
                            <td class="select_bukti"> '.$combo.'
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
                            <td align="center"> <input type="radio" required name="is_kompeten[' . $key . ']"  value="k" class="value_k"/> </td>
                            <td align="center"> <input type="radio" required name="is_kompeten[' . $key . ']" value="bk" class="value_bk"/></td>
                            <td class="select_bukti"> '.$combo.'
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
    function wawancara($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        $this->load->model('perangkat_asesmen_detail_model');
        $con_method = $this->perangkat_asesmen_detail_model->get(intval($id));
        if (sizeof($con_method) == 1) {
            $data_user = $this->auth->get_user_data();

            $detail_perangkat = $this->perangkat_asesmen_model->detail_soal($id);
            $perangkat = $this->perangkat_asesmen_model->get(intval($con_method->id_perangkat_asesmen));
            $kuk = $this->uji_kompetensi_skema($perangkat->skema_perangkat,$detail_perangkat);

            $this->db->select('id_asesor,skema_sertifikasi');
            $this->db->where('id', $data_user->pegawai_id);
            $detail_asesi = $this->db->get(kode_tbl() . 'asesi')->row();

            //var_dump($kuk);die();

             $jenis_user = $this->auth->get_user_data()->jenis_user;
            if ($jenis_user == 1) {
                $views = 'detail_wawancara_asesi';
            } else {
                $views = 'detail_wawancara';
            }

            $data = $this->perangkat_asesmen_detail_model->get_single($con_method);
            $peserta_uji = $this->perangkat_asesmen_model->peserta_uji($id, $data_user->pegawai_id);
            $this->load->view('perangkat_asesmen/' . $views, array(
                'detail_perangkat' => $detail_perangkat,
                'data_user' => $data_user,
                'peserta_uji' => $peserta_uji,
                'id' => $id,
                'jenis_soal' => array('', 'Uji Teori', 'Observasi', 'Tes Lisan', 'Wawancara', 'Studi Kasus','Cek Portofolio'),
                'data' => $data,
                'kuk' => $kuk,
             ));
        } else {
            $this->load->view('perangkat_asesmen/detail', array(), TRUE);
        }
    }
    function save_asesor_wawancara() {
        $jawaban_peserta = $this->input->post('jawaban_peserta');
        $is_kompeten = $this->input->post('is_kompeten');
        $jawaban = array(
            "jawaban_peserta"=>serialize($jawaban_peserta),
             "is_kompeten"=>serialize($is_kompeten),

            );
        $jawaban = serialize($jawaban);
        $asesiarray = $this->input->post('asesiarray');
        $selectrekomendasi = $this->input->post('selectrekomendasi');
        $id_asesor = $this->auth->get_user_data()->pegawai_id;
        //$id_skema = $this->input->post('id_skema');
        $id_perangkat_detail = $this->input->post('id_perangkat_detail');
        //var_dump($asesiarray); die();
        foreach ($asesiarray as $key => $value) {
            $this->db->select('id_asesor,skema_sertifikasi');
            $this->db->where('id', $value);
            $detail_asesi = $this->db->get(kode_tbl() . 'asesi')->row();

            $data_update = array(
                'id_asesi' => $value,
                'id_asesor' => $id_asesor,
                'id_skema' => $detail_asesi->skema_sertifikasi,
                'id_perangkat_detail' => $id_perangkat_detail,
                'jawaban_asesi' => $jawaban,
                'jawaban_salah' => "0",
                'jawaban_salah' => "0",
                'penilaian_asesor' => $selectrekomendasi
            );
            $this->db->insert('t_uji', $data_update);
        }
        echo "Penilaian Sukses. Silahkan tutup halaman ini";
    }
    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'perangkat_asesmen_model', 'controller' => 'perangkat_asesmen', 'options' => array('id' => 'perangkat_asesmen', 'pagination', 'rownumber')))->load_model()->set_grid();
            $view = $this->load->view('perangkat_asesmen/index', array('grid' => $grid), true);
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
            $id_asesor = $this->auth->get_user_data()->pegawai_id;

            //var_dump($jenis_user);
            if ($jenis_user == 2) {
                $array_asesor = $this->perangkat_asesmen_model->get_id_asesor($id_asesor);

                $user_id = $this->auth->get_user_data()->id;
                $where[kode_tbl() . 'perangkat_asesmen.id IN (' . $array_asesor . ') AND ' . kode_tbl() . 'perangkat_asesmen.id !='] = '';
            } else if ($jenis_user == 1) {

                $user_id = $this->auth->get_user_data()->pegawai_id;
                $query_asesi = $this->db->query("SELECT b.id,c.nama_lengkap,a.tanggal,a.download_time
								FROM tbl007_jadual_asesmen a
								JOIN tbl007_perangkat_asesmen b ON a.id_perangkat=b.id
								JOIN tbl007_asesi c ON c.jadwal_id=a.id WHERE c.id=$user_id")->row();
                //$this->db->where('id',$query_asesi->id)
                $val1 = $query_asesi->tanggal.' '.$query_asesi->download_time;
                    date_default_timezone_set('Asia/Jakarta');
                    $val2 = date('Y-m-d H:i:s');
                    $datetime1 = new DateTime($val1);
                    $datetime2 = new DateTime($val2);

                    if($datetime1 < $datetime2){

                $where[kode_tbl() . 'perangkat_asesmen.id'] = $query_asesi->id;
                    }else{
                        $where[kode_tbl() . 'perangkat_asesmen.id'] = "";
                    }
            }

            if (isset($_POST['nama_perangkat']) && !empty($_POST['nama_perangkat'])) {
                $where['nama_perangkat like'] = '%' . $this->input->post('nama_perangkat') . '%';
            }


            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->perangkat_asesmen_model->count_by($where) : $this->perangkat_asesmen_model->count_all();
            $this->perangkat_asesmen_model->limit($row, $offset);
            $order = $this->perangkat_asesmen_model->get_params('_order');
            //$rows = isset($where) ? $this->perangkat_asesmen_model->order_by($order)->get_many_by($where) : $this->perangkat_asesmen_model->order_by($order)->get_all();
            $rows = $this->perangkat_asesmen_model->set_params($params)->with(array('pembuat', 'skema'));
            $data['rows'] = $this->perangkat_asesmen_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        } else {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->perangkat_asesmen_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->perangkat_asesmen_model->check_unique($data)) {
                    if ($this->perangkat_asesmen_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->perangkat_asesmen_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $this->load->model('skema_model');
            $skema = $this->skema_model->dropdown('id', 'skema');

            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('perangkat_asesmen/add', array('skema_perangkat' => $skema), TRUE)));
        }
    }

    function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->perangkat_asesmen_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->perangkat_asesmen_model->check_unique($data, intval($id))) {
                    $post_bukti = $this->input->post('bukti_pendukung');
                    $data['bukti_pendukung'] = str_replace('|', '"', $post_bukti);

                    if ($this->perangkat_asesmen_model->update(intval($id), $data) !== false) {
                        $sms = isset($_POST['kirim_notifikasi']) ? $this->input->post('kirim_notifikasi') : "";
                        $akses_login = isset($_POST['akses_login']) ? $this->input->post('akses_login') : "";

                        if ($akses_login != "") {
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
                            $datax['sandi'] = '123456';
                            $datax['sandi_asli'] = '123456';
                            $datax['aktif'] = '1';
                            $datax['pegawai_id'] = $id;

                            $this->load->model('User_Model');
                            $this->User_Model->insert($datax);
                            $user_id = $this->db->insert_id();

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
                            $this->db->update(kode_tbl() . 'perangkat_asesmen', $dataxy);

                            //}

                            $checked = $this->input->post('pra_asesmen_checked');
                            $this->sms($nama_lengkap, $checked, $user_id);
                        }

                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->perangkat_asesmen_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $perangkat_asesmen = $this->perangkat_asesmen_model->get(intval($id));
            if (sizeof($perangkat_asesmen) == 1) {
                $data_aplikasi = $this->db->get('r_konfigurasi_aplikasi')->row();
                $this->load->model('skema_model');
                $skema = $this->skema_model->dropdown('id', 'skema');

                $view = $this->load->view('perangkat_asesmen/edit', array('data_aplikasi' => $data_aplikasi, 'skema_perangkat' => $skema, 'data' => $this->perangkat_asesmen_model->get_single($perangkat_asesmen)), TRUE);
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
            $roles = $this->perangkat_asesmen_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->perangkat_asesmen_model->delete(intval($id))) {
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

    function combogrid($segmen = false, $id = false) {
        //$this->load->model('perangkat_asesmen_model');
        $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
        $page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
        $offset = $row * ($page - 1);
        $data = array();
        $params = array('_return' => 'data');
        if (isset($_POST['q'])) {
            $where['nama_lengkap LIKE'] = "%" . $this->input->post('q') . "%";
        }
        if ($segmen != false) {
            $where['id_users IS NULL AND id !='] = "";
        }

        if (isset($where))
            $params['_where'] = $where;
        $data['total'] = isset($where) ? $this->perangkat_asesmen_model->count_by($where) : $this->perangkat_asesmen_model->count_all();
        $this->perangkat_asesmen_model->limit($row, $offset);
        $order_criteria = "ASC";
        $_order_escape = TRUE;
        if ($id) {
            $order = "FIELD(id, " . intval($id) . ")";
            $order_criteria = "DESC";
            $_order_escape = FALSE;
        } else {
            $order = $this->perangkat_asesmen_model->get_params('_order');
        }
        $rows = isset($where) ? $this->perangkat_asesmen_model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->perangkat_asesmen_model->order_by($order, $order_criteria, $_order_escape)->get_all();
        $data['rows'] = $this->perangkat_asesmen_model->get_selected()->data_formatter($rows);
        //var_dump($data);
        echo json_encode($data);
    }

	function view()
    {
        $template_header = 'templates/responsive/header';
        $template_body = 'templates/responsive/perangkat_asesmen/view';
        $template_bottom = 'templates/responsive/footer';

        $this->db->where('id',$this->id);
        $row_user = $this->db->get('t_users')->row();
        $id = $row_user->pegawai_id;

        $perangkat_asesmen_detail = $this->db->query("SELECT a.*,b.nama_perangkat
		FROM lsp602_perangkat_asesmen_detail a
		JOIN lsp602_perangkat_asesmen b ON a.id_perangkat_asesmen=b.id
		JOIN lsp602_jadual_asesmen c ON c.id_perangkat=b.id
		JOIN lsp602_asesi d ON d.jadwal_id=c.id
		WHERE d.id=$id")->result();
        //var_dump($query);die();
        //$riwayat_sertifikasi = $this->Sertifikasi_Model->riwayat_sertifikasi($this->id);
        //var_dump($riwayat_sertifikasi);die();
        $this->load->view($template_header, array('aplikasi'=>$this->aplikasi,'query_pesan'=>$this->query_pesan,'query_pesan_unread'=>$this->query_pesan_unread));
        $this->load->view($template_body, array('aplikasi'=>$this->aplikasi,'unread_message'=>$this->unread_message,'menus'=>$this->menus, 'rolename'=>$this->auth->get_rolename(),'perangkat_asesmen_detail' => $perangkat_asesmen_detail, 'nama_user'=>$this->auth->get_user_data()->nama));
        $this->load->view($template_bottom, array('aplikasi'=>$this->aplikasi));
    }
    function pilihan($jenis = 0){
        $template_header = 'templates/responsive/header';
        $template_body = 'templates/responsive/perangkat_asesmen/pilihan';
        $template_bottom = 'templates/responsive/footer';

        //$riwayat_sertifikasi = $this->Sertifikasi_Model->riwayat_sertifikasi($this->id);
        //var_dump($riwayat_sertifikasi);die();
        $this->load->view($template_header, array('aplikasi'=>$this->aplikasi,'query_pesan'=>$this->query_pesan,'query_pesan_unread'=>$this->query_pesan_unread));
        $this->load->view($template_body, array('aplikasi'=>$this->aplikasi,'unread_message'=>$this->unread_message,'menus'=>$this->menus, 'rolename'=>$this->auth->get_rolename(),'id'=>$jenis, 'nama_user'=>$this->auth->get_user_data()->nama));
        $this->load->view($template_bottom, array('aplikasi'=>$this->aplikasi));

    }
    public function soal($perangkat_detail = 0,$jenis_perangkat = 0){
        $pertanyaan = $this->Tryout_model->get_soal_by_option($perangkat_detail);
        //var_dump($pertanyaan); die();
        $template_header = 'templates/responsive/header';
        $this->load->view($template_header, array('aplikasi'=>$this->aplikasi,'query_pesan'=>$this->query_pesan,'query_pesan_unread'=>$this->query_pesan_unread));
        if(count($pertanyaan) > 0){
        	if($jenis_perangkat==2){
        		$template_body = 'templates/responsive/perangkat_asesmen/esay';
        	}else{
        		$template_body = 'templates/responsive/perangkat_asesmen/tes';

        	}
        	$this->load->view($template_body, array('aplikasi'=>$this->aplikasi,'unread_message'=>$this->unread_message,'menus'=>$this->menus, 'rolename'=>$this->auth->get_rolename(),'pertanyaan'=>$pertanyaan, 'nama_user'=>$this->auth->get_user_data()->nama));
        } else {
        	$template_body = 'templates/responsive/perangkat_asesmen/error';
        }
        $template_bottom = 'templates/responsive/footer';
        $this->load->view($template_bottom, array('aplikasi'=>$this->aplikasi));

	}
	public function proses(){
		//echo "FDSFDF";die();
		$benar = 0;
		$salah = 0;
		$soal = 0;
		$pertanyaan = [];
		$jawaban_benar = [];
		if($this->input->post()){
			$post = $this->input->post();
			foreach ($post as $p => $a) {
				$soal ++;
				$explode = explode('_', $p);
				$id = (int) $explode[1];
				if(is_numeric($id)){
					if($id !== 0){
						$result = $this->Tryout_model->check_answer($id,$a);
						if($result === TRUE){
							$benar ++;
						} else {
							$resultion = $result->row_array();
							array_push($pertanyaan, $resultion['pertanyaan']);
							array_push($jawaban_benar, $resultion['jawaban_benar']);
						}
					}
				}
			}
		}
		if($soal == 0){
			redirect(base_url('Tryout'),'refresh');
		}
        $template_header = 'templates/responsive/header';
        $template_body = 'templates/responsive/perangkat_asesmen/result';
        $template_bottom = 'templates/responsive/footer';

        //$riwayat_sertifikasi = $this->Sertifikasi_Model->riwayat_sertifikasi($this->id);
        //var_dump($riwayat_sertifikasi);die();
        $this->load->view($template_header, array('aplikasi'=>$this->aplikasi,'query_pesan'=>$this->query_pesan,'query_pesan_unread'=>$this->query_pesan_unread));
        $this->load->view($template_body, array('aplikasi'=>$this->aplikasi,'unread_message'=>$this->unread_message,'menus'=>$this->menus, 'rolename'=>$this->auth->get_rolename(),'benar'=>$benar,'salah'=>$salah,'soal'=>$soal,'pertanyaan'=>$pertanyaan,'jawaban_benar'=>$jawaban_benar, 'nama_user'=>$this->auth->get_user_data()->nama));
        $this->load->view($template_bottom, array('aplikasi'=>$this->aplikasi));
	}
	public function esay($unit = 0){
        $pertanyaan = $this->Tryout_model->get_soal_by_option($unit,2);
        $template_header = 'templates/responsive/header';
        $this->load->view($template_header, array('aplikasi'=>$this->aplikasi,'query_pesan'=>$this->query_pesan,'query_pesan_unread'=>$this->query_pesan_unread));
        if($pertanyaan->num_rows() > 0){
        	$template_body = 'templates/responsive/perangkat_asesmen/esay';
        	$this->load->view($template_body, array('aplikasi'=>$this->aplikasi,'unread_message'=>$this->unread_message,'menus'=>$this->menus, 'rolename'=>$this->auth->get_rolename(),'pertanyaan'=>$pertanyaan,'unit'=>$this->Tryout_model->get_unit_kategori_by_id($unit), 'nama_user'=>$this->auth->get_user_data()->nama));
        } else {
        	$template_body = 'templates/responsive/perangkat_asesmen/error';
        }
        $template_bottom = 'templates/responsive/footer';
        $this->load->view($template_bottom, array('aplikasi'=>$this->aplikasi));
	}
	public function proses_esay()
	{
		$result = serialize($this->input->post());
		$data = array('result'	=>	$result);
		//$this->tryout_model->insert_essay($data);

		if($this->db->insert('tbl007_result', $data)){
        $template_header = 'templates/responsive/header';
        $template_body = 'templates/responsive/perangkat_asesmen/success_esay';
        $template_bottom = 'templates/responsive/footer';

        //$riwayat_sertifikasi = $this->Sertifikasi_Model->riwayat_sertifikasi($this->id);
        //var_dump($riwayat_sertifikasi);die();
        $this->load->view($template_header, array('aplikasi'=>$this->aplikasi,'query_pesan'=>$this->query_pesan,'query_pesan_unread'=>$this->query_pesan_unread));
        $this->load->view($template_body, array('aplikasi'=>$this->aplikasi,'unread_message'=>$this->unread_message,'menus'=>$this->menus, 'rolename'=>$this->auth->get_rolename(), 'nama_user'=>$this->auth->get_user_data()->nama));
        $this->load->view($template_bottom, array('aplikasi'=>$this->aplikasi));
		} else {
                        echo $this->db->_error_message();
        	       //$this->load->view('tryout/error_esay');
		}
		/*
		echo "Serialize => ".$result."<br>";
		$unresult = unserialize($result);
		for ($i=0; $i < count($unresult['soal']) ; $i++) {
			echo $unresult['soal'][$i]." => ".$unresult['jawaban'][$i];
		}
		*/
	}

}
