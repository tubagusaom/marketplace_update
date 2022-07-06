<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jadwal_asesmen extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('jadwal_asesmen_model');
        $this->load->model('artikel_model');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'jadwal_asesmen_model', 'controller' => 'jadwal_asesmen', 'options' => array('id' => 'jadwal_asesmen', 'pagination', 'rownumber')))->load_model()->set_grid();
            $view = $this->load->view('jadwal_asesmen/index', array('grid' => $grid), true);
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
            if ($jenis_user == 3) {
                $asesi_id = $this->auth->get_user_data()->pegawai_id;
                $where['tbl007_jadual_asesmen.id_tuk ='] = $asesi_id;
            } else {
                $asesi_id = $this->auth->get_user_data()->pegawai_id;
                $where['tbl007_jadual_asesmen.id_tuk ='] != '';
            }


            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->jadwal_asesmen_model->count_by($where) : $this->jadwal_asesmen_model->count_all();
            $this->jadwal_asesmen_model->limit($row, $offset);
            $order = $this->jadwal_asesmen_model->get_params('_order');
            //$rows = isset($where) ? $this->jadwal_asesmen_model->order_by($order)->get_many_by($where) : $this->jadwal_asesmen_model->order_by($order)->get_all();
            $rows = $this->jadwal_asesmen_model->set_params($params)->with(array('angkatan', 'prodi'));
            $data['rows'] = $this->jadwal_asesmen_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        } else {
            block_access_method();
        }
    }

    function add() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ch_mahasiswa = $this->input->post('ch_mahasiswa');
            if (count($ch_mahasiswa) > 0) {
                $nama_mahasiswa = serialize($ch_mahasiswa);
            } else {
                $nama_mahasiswa = '';
            }

            //var_dump($nama_mahasiswa);die();
            $data = $this->jadwal_asesmen_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->jadwal_asesmen_model->check_unique($data)) {
                    $id_tuk = $this->auth->get_user_data()->pegawai_id;
                    $jenis_user = $this->auth->get_user_data()->jenis_user;
                    // var_dump($jenis_user); die();

                    $id_skema = $this->input->post('id_skema');
                    $tanggal = $this->input->post('tanggal');

                    // $data['jadual'] = $this->nama_jadwal($id_tuk, $id_skema, $tanggal);

                    $data['nama_mahasiswa'] = $nama_mahasiswa;
                    $data['id_tuk'] = $id_tuk;
                    //var_dump($data['jadual']);die();
                    if ($this->jadwal_asesmen_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->jadwal_asesmen_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {


            $jenis_user = $this->auth->get_user_data()->jenis_user;

            if ($jenis_user == 3) {

                $this->load->model('angkatan_model');
                $angkatan = $this->angkatan_model->dropdown('id', 'angkatan');
                $jenis_user = $this->auth->get_user_data()->jenis_user;

                $id_tuk = $this->auth->get_user_data()->pegawai_id;
                $this->db->where('id', $id_tuk);
                $row_prodi = $this->db->get(kode_tbl() . 'tuk')->row();

                //var_dump($prodi);die();
                echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('jadwal_asesmen/add', array('angkatan' => $angkatan, 'jenis_user' => $jenis_user , 'id_prodi' => $row_prodi->id_prodi), TRUE)));

            }else {

            $this->load->library('combogrid');

            $tuk = $this->combogrid->set_properties(array('model' => 'tuk_model', 'controller' => 'tuk', 'fields' => array('tuk', 'alamat'), 'options' => array('id' => 'id_tuk', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'tuk', 'panelWidth' => 500)))->load_model()->set_grid();

            $skema = $this->combogrid->set_properties(array('model' => 'skema_model', 'controller' => 'skema', 'fields' => array('skema'), 'options' => array('id' => 'id_skema', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'skema', 'panelWidth' => 500,
                                'queryParams' => array('name' => 'easui')
                    )))->load_model()->set_grid();

            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('jadwal_asesmen/add_adm', array('skema_grid' => $skema, 'tuk_grid' => $tuk ,  'url' => base_url() . 'jadwal_asesmen/upload'), TRUE)));

            }

        }
    }

    function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $this->db->where('id_jadwal', $id);
            $query_jadwal = $this->db->get(kode_tbl() . 'mapping_asesor')->result();
            $status_jadwal = $this->input->post('status_jadwal');
            $status_jadwal_hidden = $this->input->post('status_jadwal_hidden');
            $asesor_pilihan = $this->input->post('asesor_pilihan');
            //var_dump($asesor_pilihan);die();
            if ($status_jadwal == '1') {
                if ($status_jadwal_hidden == '0') {
                    if (count($query_jadwal) > 0) {
                        $data = $this->jadwal_asesmen_model->set_validation()->validate();
                        //dump($data);
                        if ($data !== false) {
                            if ($this->jadwal_asesmen_model->check_unique($data, intval($id))) {

                                $nama_mahasiswa_hidden = $this->input->post('nama_mahasiswa_hidden');
                                $data['nama_mahasiswa'] = str_replace('|', '"', $nama_mahasiswa_hidden);
                                $mahasiswa = unserialize($data['nama_mahasiswa']);
                                //dump($mahasiswa);
                                if ($this->jadwal_asesmen_model->update(intval($id), $data) !== false) {
                                    $unit_kompetensi = $this->jadwal_asesmen_model->unit_kompetensi($data['id_skema']);
                                    $index_mahasiswa = 0;
                                    foreach ($mahasiswa as $key => $value) {
                                        $this->db->where('id', $value);
                                        $row_mahasiswa = $this->db->get(kode_tbl() . 'calon_asesi')->row();
                                        $no_uji_kompetensi = $this->generate_number($id);

                                        $query_asesor_jadwal = $this->db->query('SELECT a.id_asesor,b.users,(SELECT COUNT(c.id) FROM tbl007_asesi c WHERE c.id_asesor=a.id_asesor) as jumlah_asesi
                                FROM tbl007_mapping_asesor a
                                JOIN tbl007_users b ON a.id_asesor=b.id
                                WHERE id_jadwal=' . $id . '
                                ORDER BY jumlah_asesi ASC
                                LIMIT 1')->row();

                                        $this->db->where('pegawai_id', $query_asesor_jadwal->id_asesor);
                                        $this->db->where('jenis_user', '2');
                                        $query_asesor = $this->db->get('t_users')->row();

                                        $data_asesi = array(
                                            'pra_asesmen_date' => date('Y-m-d'),
                                            'no_uji_kompetensi' => $no_uji_kompetensi,
                                            'pra_asesmen_checked' => $query_asesor->id,
                                            'pra_asesmen_description' => 'Di rekomendasi menjadi peserta uji kompetensi',
                                            'pra_asesmen' => '1',
                                            'perangkat' => 'a:2:{i:0;s:1:"1";i:1;s:1:"2";}',
                                            'jadwal_id' => $id,
                                            'id_asesor' => $query_asesor_jadwal->id_asesor,
                                            'no_identitas' => $row_mahasiswa->nim_calon,
                                            'nama_lengkap' => $row_mahasiswa->nama_calon,
                                            'tempat_lahir' => $row_mahasiswa->tempat_lahir,
                                            'tgl_lahir' => $row_mahasiswa->tanggal_lahir,
                                            'jenis_kelamin' => $row_mahasiswa->kelamin_calon,
                                            'kewarganegaraan' => 'WNI',
                                            'alamat' => $row_mahasiswa->alamat,
                                            'telp' => $row_mahasiswa->hp_calon,
                                            'email' => $row_mahasiswa->email_calon,
                                            'pendidikan_terakhir' => $row_mahasiswa->pendidikan_terakhir,
                                            'skema_sertifikasi' => $data['id_skema'],
                                            'id_users' => $row_mahasiswa->id,
                                            'id_tuk' => $data['id_tuk'],
                                        );
                                        $this->db->insert(kode_tbl() . 'asesi', $data_asesi);

                                        //dump($ch_mapping);
                                        //var_dump($asesor_pilihan[$index_mahasiswa]);die();
                                        foreach ($unit_kompetensi as $keys => $values) {
                                            $array_asesor_pilihan = explode('|', $asesor_pilihan[$keys]);
                                            $data_jadwal_asesi = array(
                                                'tanggal_uji' => $data['tanggal'],
                                                'id_jadwal' => $id,
                                                'id_mahasiswa' => $row_mahasiswa->id,
                                                'nama_asesor' => $array_asesor_pilihan[1],
                                                'kode_unit' => $values->id_unit_kompetensi,
                                                'judul_unit' => $values->unit_kompetensi,
                                                'id_asesor' => $array_asesor_pilihan[0]
                                            );
                                            //var_dump($data_jadwal_asesi);die();
                                            $this->db->insert(kode_tbl().'detail_jadwal', $data_jadwal_asesi);
                                        }

                                        $index_mahasiswa++;
                                    }
                                    echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                                } else {
                                    echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                                }
                            } else {
                                echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->jadwal_asesmen_model->get_validation())));
                            }
                        } else {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
                        }
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Belum ada asesor yang ditugaskan!'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => 'Jadwal tidak bisa dirubah. Sudah di setujui!'));
                }
            } else {
                echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
            }
        } else {
            $con_method = $this->jadwal_asesmen_model->get(intval($id));
            if (sizeof($con_method) == 1) {
                $data = $this->jadwal_asesmen_model->get_single($con_method);
                //Ambil data asesor yang bertugas
                $skema = kode_tbl() . 'skema';
                $skema_detail = kode_tbl() . 'skema_detail';
                $unit_kompetensi = kode_tbl() . 'unit_kompetensi';


                $unit_kompetensi = $this->jadwal_asesmen_model->unit_kompetensi($data->id_skema);

                $this->db->select('b.id,b.users');
                $this->db->from(kode_tbl() . 'mapping_asesor a');
                $this->db->join(kode_tbl() . 'users b', 'a.id_asesor=b.id');
                $this->db->where('id_jadwal', $id);
                $asesor = $this->db->get()->result();
                $select_asesor = "<select required='required' name='asesor_pilihan[]'><option value=''>-Pilih-</option>";
                //$array_asesor[''] = 'Pilih Asesor';
                // if (!empty($array_asesor)) {
                foreach ($asesor as $key => $value) {
                    $array_asesor[$value->id] = $value->users;
                    $select_asesor .= "<option value='" . $value->id . "|" . $value->users . "'>" . ($key + 1) . '. ' . $value->users . "</option>";
                }

                // $data['array_asesor'] = $array_asesor;
                // };

                $select_asesor .= "</select>";
                $asesor = $select_asesor;
                $array_asesor = $array_asesor;


                $nama_string_mahasiswa = str_replace('"', '|', $data->nama_mahasiswa);
                $this->db->where('id', $data->id_skema);
                $row_skema = $this->db->get(kode_tbl() . 'skema')->row();
                //dump($nama_string_mahasiswa);
                $this->load->model('angkatan_model');
                $angkatan = $this->angkatan_model->dropdown('id', 'angkatan');

                $this->load->model('skema_model');
                $skema_grid = $this->skema_model->dropdown('id', 'skema');

                $id_tuk = $this->auth->get_user_data()->pegawai_id;

                $this->db->where('id_tuk', $data->id_tuk);
                $query_tuk = $this->db->get('t_prodi')->result();
                if (count($query_tuk) > 0) {
                    foreach ($query_tuk as $key => $value) {
                        $array_prodi[$value->id] = $value->program_studi;
                    }
                } else {
                    $array_prodi = array();
                }
                //dump($query_tuk);
                //dump($data->nama_mahasiswa);
                $nama_mahasiswa = unserialize($data->nama_mahasiswa);
                $this->db->where_in('id', $nama_mahasiswa);


                $nama_mahasiswa = $this->db->get(kode_tbl() . 'calon_asesi')->result();
                $table = '<table border="1" style="width:99%;"><tr>
            <th style="text-align:center;">NIM</th>
            <th>Nama Lengkap</th>
            <th style="text-align:center;">Kelas</th>
            <th style="text-align:center;">Semester</th>
           </tr>';
                foreach ($nama_mahasiswa as $key => $value) {
                    $table .= '<tr><td style="text-align:center;">' . $value->nim_calon . '</td>
                <td>' . $value->nama_calon . '</td>
                <td style="text-align:center;">' . $value->kelas_calon . '</td>
                <td style="text-align:center;">' . $value->semester_calon . '</td>
               </tr>';
                }
                $table .= '</table>';
                $this->load->model('prodi_model');
                $prodi = $this->prodi_model->dropdown('id', 'program_studi');

                $view = $this->load->view('jadwal_asesmen/edit', array('asesor' => $asesor, 'array_asesor' => $array_asesor, 'unit_kompetensi' => $unit_kompetensi, 'row_skema' => $row_skema, 'nama_string_mahasiswa' => $nama_string_mahasiswa, 'nama_mahasiswa' => $table, 'angkatan' => $angkatan, 'skema_grid' => $skema_grid, 'prodi' => $prodi, 'data' => $data), TRUE);
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

            $this->db->select('a.status_jadwal');
                $this->db->from(kode_tbl() . 'jadual_asesmen a');
                $this->db->where('id', $id);
                $query_jadwal = $this->db->get()->row();

            if ($query_jadwal->status_jadwal == '1') {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Jadwal tidak bisa dihapus. Sudah di setujui!'));
            }else {
                $roles = $this->jadwal_asesmen_model->get(intval($id));
                if (sizeof($roles) == 1) {
                    if ($this->jadwal_asesmen_model->delete(intval($id))) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil dihapus'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak berhasil dihapus !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
                }
            }
        } else {
            block_access_method();
        }
    }

    function combogrid($id = false) {
        $this->load->model('jadwal_asesmen_model');
        $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
        $page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
        $offset = $row * ($page - 1);
        $data = array();
        $params = array('_return' => 'data');
        if (isset($_POST['q'])) {
            $where['jadual LIKE'] = "%" . $this->input->post('q') . "%";
        }
        if (isset($where))
            $params['_where'] = $where;
        $data['total'] = isset($where) ? $this->jadwal_asesmen_model->count_by($where) : $this->jadwal_asesmen_model->count_all();
        $this->jadwal_asesmen_model->limit($row, $offset);
        $order_criteria = "ASC";
        $_order_escape = TRUE;
        if ($id) {
            $order = "FIELD(id, " . intval($id) . ")";
            $order_criteria = "DESC";
            $_order_escape = FALSE;
        } else {
            $order = $this->jadwal_asesmen_model->get_params('_order');
        }
        $rows = isset($where) ? $this->jadwal_asesmen_model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->jadwal_asesmen_model->order_by($order, $order_criteria, $_order_escape)->get_all();
        $data['rows'] = $this->jadwal_asesmen_model->get_selected()->data_formatter($rows);
        //var_dump($data);
        echo json_encode($data);
    }

    function view($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        $con_method = $this->jadwal_asesmen_model->get(intval($id));
        if (sizeof($con_method) == 1) {
            $this->db->where('jadwal_id', $id);
            $detail_asesi = $this->db->get(kode_tbl() . 'asesi')->result_array();

            //$this->load->model('angkatan_model');
            //$this->load->model('program_model');
            //$angkatan = $this->angkatan_model->dropdown('id', 'batch_name');
            //$program = $this->program_model->dropdown('id', 'program_study');

            $data = $this->jadwal_asesmen_model->get_single($con_method);
            $view = $this->load->view('jadwal_asesmen/view', array(
                'peserta' => $detail_asesi,
                //'angkatan' => $angkatan,
                'data' => $data,
                    //'url' => base_url() . 'siswa/edit_upload/' . $id
                    ), TRUE);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        } else {
            echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
        }
    }

    function cetak($id, $type = "pdf") {
        //echo $_SERVER['DOCUMENT_ROOT'];
        //die();
        $ju = $this->auth->get_user_data()->jenis_user;
        $data['konfigurasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
        $this->db->where('id', $id);
        $data['jadwal'] = $this->db->get(kode_tbl() . 'jadual_asesmen')->row();
        $nama_mahasiswa = unserialize($data['jadwal']->nama_mahasiswa);
        $this->db->where_in('id', $nama_mahasiswa);
        $data['nama_mahasiswa'] = $this->db->get(kode_tbl() . 'calon_asesi')->result();

        $get_asesor = $this->db->get_where(kode_tbl() . 'mapping_asesor', array('id_jadwal' => $id))->result();
        foreach ($get_asesor as $value) {
            $id_asesor[] = $value->id_asesor;
        }

        $this->db->where_in('id', $id_asesor);
        $data['asesor'] = $this->db->get(kode_tbl() . 'users')->result();
        //dump($data_query_mahasiswa);die();
        //$data['daftar'] = $this->jadwal_asesmen_model->daftar_hadir($id);
        //$data['daftar_hadir_asesor'] = $this->jadwal_asesmen_model->daftar_hadir_asesor($id);
        if ($ju !== '3') {

            $view = $this->load->view('jadwal_asesmen/cetak', $data, true);

            if ($type == "pdf") {
                $this->load->library("htm12pdf");

                $this->htm12pdf->pdf_create($view, "jadwal_asesmen" . date('YmdHis') . ".pdf", false, true);
            }
        } else {
            if ($data['jadwal']->status_jadwal !== '1') {
                echo 'Maaf, jadwal asesmen belum disetujui oleh admin lsp. Silahkan hubungi admin lsp.';
            } else {
                //var_dump($id_asesor); die();
                $view = $this->load->view('jadwal_asesmen/cetak_tuk', $data, true);

                if ($type == "pdf") {
                    $this->load->library("htm12pdf");

                    $this->htm12pdf->pdf_create($view, "jadwal_asesmen" . date('YmdHis') . ".pdf", false, true);
                }
            }
        }

        return false;
    }

    function cetak_clo($id, $type = "pdf") {
        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();

        $jadwal = $this->jadwal_asesmen_model->get(intval($id));


        $this->db->select('a.*');
        $this->db->from(kode_tbl() . 'mapping_asesor a');
        $this->db->where('a.id_jadwal', $id);
        $mapping_aesor = $this->db->get()->result();

        foreach ($mapping_aesor as $value) {
            $id_asesor[] = $value->id_asesor;
        }

        //var_dump($maping_skema); die();
        $this->db->select('a.*');
        $this->db->from(kode_tbl() . 'skema a');
        $this->db->where('a.id', $jadwal->id_skema);
        $skema = $this->db->get()->row();

        //var_dump($skema); die();

        $this->db->select('a.*');
        $this->db->from(kode_tbl() . 'users a');
        $this->db->where_in('a.id', $id_asesor);
        $asesor = $this->db->get()->result();
        //var_dump($asesor);die();

        $this->db->select('a.*, c.id_unit_kompetensi, c.unit_kompetensi, d.elemen_kompetensi');
        $this->db->from(kode_tbl() . 'skema a');
        $this->db->join(kode_tbl() . 'skema_detail b', 'b.id_skema = a.id');
        $this->db->join(kode_tbl() . 'unit_kompetensi c', 'b.id_unit_kompetensi = c.id');
        $this->db->join(kode_tbl() . 'elemen_kompetensi d', 'd.id_unit_kompetensi = c.id');
        $this->db->where('a.id', $jadwal->id_skema);
        $result_elemen = $this->db->get()->result();

        $data['elemen_clo'] = $result_elemen;
        $data['asesor'] = $asesor;
        $data['id_jadwal'] = $id;
        $data['tgl_uji'] = $jadwal->tanggal;
        $data['skema'] = $skema->skema;
//        $this->db->select('nama_lengkap');
//        $this->db->where('jadwal_id',$id);
        //$data['asesi'] = $this->db->get(kode_tbl().'asesi')->result();
        //var_dump($data['asesi']);die();
        $view = $this->load->view('jadwal_asesmen/cetak_clo', $data, TRUE);
        if ($type == "pdf") {
            $this->load->library("htm12pdf");
            $this->htm12pdf->pdf_create($view, "clo" . date('YmdHis') . ".pdf", false, true, 'L');
        }
    }

    function upload() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->jadwal_asesmen_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->jadwal_asesmen_model->check_unique($data)) {
                    if (isset($_FILES['fileToUpload']['tmp_name']) && !empty($_FILES['fileToUpload']['tmp_name'])) {
                        $data['file_jadual'] = str_replace(' ', '_', $_FILES['fileToUpload']['name']);
                        $config['upload_path'] = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/files/jadwal_asesmen/';
                        $config['allowed_types'] = 'bmp|jpg|png|gif|jpeg|pdf|doc|docx|xls|xlsx|rar|zip';
                        $config['max_size'] = '5120000000';

                        $this->load->library('upload', $config);

                        if (!$this->upload->do_upload('fileToUpload')) {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => $this->upload->display_errors()));
                            exit();
                        }
                    }
                    $id_tuk = $this->input->post('id_tuk');
                    $id_skema = $this->input->post('id_skema');
                    $tanggal = $this->input->post('tanggal');

                    //$data['jadual'] = $this->nama_jadwal($id_tuk,$id_skema,$tanggal);

                    if ($this->jadwal_asesmen_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", strip_tag($this->jadwal_asesmen_model->get_validation()))));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        }
    }

    function nama_jadwal($id_tuk, $id_skema, $tanggal) {
        $this->db->where('id', $id_tuk);
        $nama_tuk = $this->db->get(kode_tbl() . 'tuk')->row()->tuk;
        $this->db->where('id', $id_skema);
        $nama_skema = $this->db->get(kode_tbl() . 'skema')->row()->skema;
        return 'Uji Kompetensi ' . $nama_skema . ' di ' . $nama_tuk . ' tanggal ' . tgl_indo($tanggal);
    }

    function download($id = false) {
        if (!$id) {
            block_access_method();
        } else {
            if ($_SERVER['REQUEST_METHOD'] == "GET") {
                $docs = $this->jadwal_asesmen_model->get(intval($id));
                if (sizeof($docs) == 1) {
                    $doc = $this->jadwal_asesmen_model->get_single($docs);

                    $val1 = $doc->tanggal . ' ' . $doc->download_time;
                    date_default_timezone_set('Asia/Jakarta');
                    $val2 = date('Y-m-d H:i:s');
                    $datetime1 = new DateTime($val1);
                    $datetime2 = new DateTime($val2);

                    if ($datetime1 < $datetime2) {
                        $files = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/files/jadwal_asesmen/' . $doc->file_jadual;
                        if (file_exists($files)) {
                            header('Cache-Control: public');
                            header('Content-Disposition: attachment; filename="' . $doc->file_jadual . '"');
                            readfile($files);
                            die();
                        } else {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => 'File tidak dapat ditemukan'));
                        }
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Anda Belum diizinkan Mengakses File Ini'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan'));
                }
            }
        }
    }

    function detail($id = 0, $offset = 0) {
        $data['marquee'] = $this->artikel_model->marquee();

        $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();

        $keyword = $this->input->get('keyword');
        if ($keyword == "") {
            $offset = $this->uri->segment(4);
            $jml = $this->db->get(kode_tbl() . 'jadual_asesmen');
            $data['jmldata'] = $jml->num_rows();
            //pengaturan pagination
            $config['enable_query_strings'] = true;
            $config['base_url'] = base_url() . 'jadwal_asesmen/detail/' . $id;
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
            $data['data'] = $this->jadwal_asesmen_model->get_all_jadwal($config['per_page'], $offset);
        } else {
            $offset = $this->uri->segment(3);
            $jml = $this->db->get(kode_tbl() . 'jadual_asesmen');
            $data['jmldata'] = $jml->num_rows();

            //pengaturan pagination
            $config['enable_query_strings'] = true;
            if (!empty($keyword)) {
                $config['suffix'] = "?keyword=" . $keyword;
            }

            $config['base_url'] = base_url() . 'jadwal_asesmen/detail/' . $id;
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
            $data['data'] = $this->jadwal_asesmen_model->get_all_jadwal($config['per_page'], $offset, $keyword);
        }
        $this->load->view('templates/bootstraps/header', $data);
        $this->load->view('jadwal_asesmen/vjadwal', $data);
        $this->load->view('templates/bootstraps/bottom');
    }

    function mahasiswa($id = "") {
        $angkatan = $this->input->post('id_angkatan');
        $kelas_calon = $this->input->post('kelas_calon');
        $semester_calon = $this->input->post('semester_calon');
        $prodi = $this->input->post('prodi');

        // $this->db->where('id_angkatan', $angkatan);
        $this->db->where('id_prodi', $prodi);
        $this->db->like('kelas_calon', $kelas_calon);
        $this->db->like('semester_calon', $semester_calon);
        $data_mahasiswa = $this->db->get(kode_tbl() . 'calon_asesi')->result();
        if (count($data_mahasiswa) > 0) {
            // $this->db->like('semester', $semester_calon);
            // $this->db->where('id_prodi', $prodi);
            $data_skema = $this->db->get(kode_tbl() . 'skema')->result();
            foreach ($data_skema as $key => $value) {
                $array_skema[$value->id] = $value->skema;
            }
            $combo_skema = form_dropdown('id_skema', $array_skema, '', 'id="id_skema" style="width:500px; margin-bottom: 20px"  class="easyui-combobox"  data-options="required: true"');

            $table = '<br/>Skema Sertifikasi: ' . $combo_skema . '<br/><table border="1" style="width:99%;"><tr>
            <th style="text-align:center;">NIM</th>
            <th>Nama Lengkap</th>
            <th style="text-align:center;">Kelas</th>
            <th style="text-align:center;">Semester</th>
            <th style="text-align:center;"><input type="checkbox" id="v_all_mhs" onclick="ch_all_mahasiswa()" /></th></tr>';
            foreach ($data_mahasiswa as $key => $value) {
                $table .= '<tr><td style="text-align:center;">' . $value->nim_calon . '</td>
                <td>' . $value->nama_calon . '</td>
                <td style="text-align:center;">' . $value->kelas_calon . '</td>
                <td style="text-align:center;">' . $value->semester_calon . '</td>
                <td style="text-align:center;"><input value="' . $value->id . '" class="v_all_mhs" type="checkbox" name="ch_mahasiswa[' . $value->id . ']" /></td></tr>';
            }
            $table .= '</table>';
        } else {
            $table = '<label style="margin-left:150px;font-wei">Tidak Ada Data Mahasiswa</label>';
        }
        echo $table;
    }

    function generate_number($kode_jadwal) {
        //$id = $this->input->post('id');
        $jadwal = kode_tbl() . 'jadual_asesmen';
        $asesi = kode_tbl() . 'asesi';
        $data = $this->db->query("SELECT
        DATE_FORMAT(a.tanggal,'%m-%Y') as tanggal
         FROM $jadwal a
        WHERE a.id=$kode_jadwal")->row();
        $data_asesi = $this->db->query("SELECT count(a.id) as total
            FROM $asesi a
            WHERE a.jadwal_id =  $kode_jadwal
            ")->row();

        $prefix = "UJK-" . $kode_jadwal . "-";
        $digits = 3;
        $start = $data_asesi->total + 1;

        for ($i = $start; $i < $start + 1; $i++) {
            $result = str_pad($i, $digits, "0", STR_PAD_LEFT);
        }
        $no = $prefix . $result;

        return $no . '-' . $data->tanggal;
    }

}
