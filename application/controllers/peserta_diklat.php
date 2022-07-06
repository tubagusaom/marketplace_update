<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Peserta_diklat extends MY_Controller {

	function __construct()
	{
		parent::__construct();
	}

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'peserta_diklat_model', 'controller' => 'peserta_diklat', 'options' => array('id' => 'peserta_diklat','pagination','rownumber')))->load_model()->set_grid();
            $view = $this->load->view('peserta_diklat/index', array('grid' => $grid), true);
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
            if (isset($where))
                $params['_where'] = $where;
            $url = "https://www.jimlyschool.com/jadwal-kegiatan/api_peserta/10/".$offset;
            $conn = json_decode(file_get_contents($url));

            $url_count = "https://www.jimlyschool.com/jadwal-kegiatan/api_peserta/1000/0";
            $conn_count = json_decode(file_get_contents($url_count));

            $rowx = array();
            $rowxs = array();
            foreach ($conn as $key => $value) {
                $rowx[] = array(
                    'id'=>$value->id,
                    'kg_id_ref'=>$value->kg_id_ref,
                    'dk_name_full'=>$value->dk_name_full,
                    'dk_born_place'=>$value->dk_born_place,
                    'dk_born_date'=>$value->dk_born_date,
                    'dk_address'=>$value->dk_address,
                    'dk_office_name'=>$value->dk_office_name,
                    'dk_office_position'=>$value->dk_office_position,
                    'dk_edu'=>$value->dk_edu,
                    'dk_tel'=>$value->dk_tel,
                    'dk_hp'=>$value->dk_hp,
                    'dk_fax'=>$value->dk_fax,
                    'dk_email'=>$value->dk_email,
                    'dk_date_create'=>$value->dk_date_create,
                    'dk_status_paid'=>$value->dk_status_paid,
                    'akses_login'=>$value->akses_login
                );
            }
            $rowxs[] = $rowx;
            //var_dump((object)$conn);

            $data['total'] = count($conn_count);
            //$rows = (object)$conn;
            $data['rows'] = $rowx;
            echo json_encode($data);
        }
        else {
            block_access_method();
        }
    }

    function edit($id = false) {
    	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    		 $akses_login = isset($_POST['akses_login']) ? $this->input->post('akses_login') : "";
    		if ($akses_login != "" || $akses_login != "0") {
                $data['nama_lengkap'] = $this->input->post('dk_name_full');
                $data['tempat_lahir'] = $this->input->post('dk_born_place');
                $data['tgl_lahir'] = $this->input->post('dk_born_date');
                $data['alamat'] = $this->input->post('dk_address');
                $data['organisasi'] = $this->input->post('dk_office_name');
                $data['jabatan'] = $this->input->post('dk_office_position');
                $data['pendidikan_terakhir'] = $this->input->post('dk_edu');
                $data['telp'] = $this->input->post('dk_hp');
                $data['email'] = $this->input->post('dk_email');
                $data['skema_sertifikasi'] = '1';
                $data['id_tuk'] = '1';
                $this->load->model('asesi_model');
                if ($this->asesi_model->insert($data) !== false) {
                	$id_asesi = $this->db->insert_id();
                	$nama = str_replace(' ', '', strtolower($data['nama_lengkap']));
	                if (strlen($nama) > 4) {
	                    $datax['akun'] = substr($nama, 0, 4) . rand(1, 9999);
	                } else {
	                    $datax['akun'] = $nama . rand(1, 9999);
	                }
				    $datax['email'] = $data['email'];
	                $datax['hp'] = $data['telp'];
	                $datax['nama_user'] = $data['nama_lengkap'];
	                $datax['jenis_user'] = '1';
	                $datax['sandi'] = '123456';
	                $datax['sandi_asli'] = '123456';
	                $datax['aktif'] = '1';
	                $datax['pegawai_id'] = $id_asesi;

	                $this->load->model('User_Model');
	                $this->User_Model->insert($datax);
	                $user_id = $this->db->insert_id();

	                $datay['user_id'] = $user_id;
	                $datay['role_id'] = 17;
	                $this->load->model('User_Role_Model');
	                $this->User_Role_Model->insert($datay);
					  $dataxy = array(
	                    'id_users' => $user_id
	                );
	                $this->db->where('id', $id);
	                $this->db->update(kode_tbl() . 'asesi', $dataxy);

	                $post = [
							    'id_peserta' => $id,

							];

		    		 $post = json_encode($post,true);

					 $ch = curl_init('https://www.jimlyschool.com/jadwal-kegiatan/api_peserta_update'); //
					 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					 curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

			         $result = curl_exec($ch);
			         curl_close($ch);

			         $admin = $this->db->get('r_konfigurasi_aplikasi')->row();
			         $pesan = 'Akses untuk uji kompetensi. Login ' . $admin->url_aplikasi . ' User:' . $datax['akun'] . ' Pass: 123456';
	                //$checked = $this->input->post('pra_asesmen_checked');
	                smssend_zenziva($datax['hp'], $pesan);
	                $post = '{"personalizations": [{"to": [{"email": "'.$datax['email'].'"}],"subject": "Akses Login Aplikasi"}],"from": {"email": "'.$admin->alamat_email.'"},"content": [{"type": "text/plain","value": "'.$pesan.'"}]}';
                        sendgrid_api_text('https://api.sendgrid.com/v3/mail/send',$post);

	                echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                }else{
                	echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                }

            }


    	}else{
        $url = "https://www.jimlyschool.com/jadwal-kegiatan/api_peserta_detail/".$id;
        $conn = json_decode(file_get_contents($url));
			if (sizeof($conn) == 1) {
                if($conn->dk_status_paid == "N"){
                    echo json_encode(array('msgType' => 'error', 'msgValue' => 'Status Peserta Unpaid !'));
                    die();
                }
                $view = $this->load->view('peserta_diklat/edit', array('data' => $conn,'url' => base_url() . 'peserta_diklat/edit_upload/' . $id), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }

    }


}
