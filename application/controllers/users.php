<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('User_Model');

	}
	function index()
	{
		$this->load->library('grid');
		$grid = $this->grid->set_properties(array('model'=>'User_Model', 'controller'=>'users', 'rownumber', 'options'=>array('id'=>'users', 'pagination')))->load_model()->set_grid();

		$view = $this->load->view('users/index', array('grid'=>$grid), true);

		echo json_encode(array('msgType'=>'success', 'msgValue'=>$view));

	}

	function form_daftar(){
		$data['aplikasi'] = $this->aplikasi;
		$this->load->view('templates/bootstraps/header',$data);
		$this->load->view('form_daftar/form_daftar_v',$data);
		$this->load->view('templates/bootstraps/bottom');
	}
	function proses($to, $subject, $message, $headers) {
                $data = $this->db->get('r_konfigurasi_aplikasi')->row();
    		    $this->load->library('email');
    			$this->email->from($data->alamat_email, $data->singkatan_unit);
                $this->email->to($to);

    			$this->email->subject($subject);
    			$this->email->message($message);

    			$this->email->send();
		}
	function daftar(){
		$this->load->model('Daftar_model');
		$simpan = $this->Daftar_model->daftar_user();
		//var_dump($simpan);die();

		if($simpan != false){
			$to      = $this->input->post('email'); // Send email to our user
			$subject = 'Pendaftaran | Verifikasi User Baru'; // Give the email a subject
			$message = $this->aplikasi->format_register_user;
			$message = str_replace('#USERNAME#',$simpan['akun'],$message);
			$message = str_replace('#URL#',$this->aplikasi->url_aplikasi,$message);
			$message = str_replace('#PASSWORD#',$simpan['sandi_asli'],$message);
			$message = str_replace('#HASH#',$simpan['hash'],$message);
			$subject = "Konfirmasi Registrasi Akun di LSP Lingkungan Hidup Inkalindo";
			//$headers = 'From:noreply@mbs.web.id' . "\r\n"; // Set from headers
			kirim_email_gmail($message, $to,$this->aplikasi->alamat_email,$subject); // Send our email

			$datax['sender_id'] = 1;
            $datax['reciepent_id'] = $simpan['id'] ;
            $datax['title'] = $subject ;
            $datax['message'] = $message ;

            $this->load->model('Pesan_Model');
            $this->Pesan_Model->insert($datax);


			die("{\"total\":1, \"status\": \"Berhasil\","
					. "\"results\":[{"
					. "\"message\":\"Konfirmasi registrasi telah dikirim via email. \""
					. "}]}");

			} else {
			die("{\"total\":1, \"status\": \"Gagal\","
					. "\"results\":[{"
					. "\"message\":\"Pendaftaran Gagal, Akun sudah terdaftar. \""
					. "}]}");
			}
	}


	function verifikasi_daftar(){
			$this->load->model('Daftar_model');
			$email = $this->uri->segment(3);
			$hash = $this->uri->segment(4);
			if(isset($email) && !empty($email)){
				$email = $this->uri->segment(3);
				$hash = $this->uri->segment(4);

				$result = $this->Daftar_model->get_user_daftar($email,$hash);
				if(count($result) > 0){
					$akun = $result->akun;
					$id = $result->id;
					$this->Daftar_model->upd_aktif($akun,$id);

					$this->session->set_flashdata('result', 'Akun Anda telah aktif, silahkan login untuk memperbaharui data');
		            $this->session->set_flashdata('mode_alert', 'success');
		            redirect('welcome/sukses');
				}else{
					$this->session->set_flashdata('result', 'Akun anda tidak dikenali, atau sudah di konfirmasi. Silahkan login dengan  menggunakan username dan password yang telah di kirim via email atau menghubungi admin jika masih ada kendala');
           			 $this->session->set_flashdata('mode_alert', 'warning');
           			 redirect('welcome/sukses');
				}

			}else{

			}
	}
	function sukses(){
		$data['aplikasi'] = $this->aplikasi;
		$this->load->view('templates/bootstraps/header',$data);
		$this->load->view('templates/bootstraps/sukses',$data);
		$this->load->view('templates/bootstraps/bottom');
	}

	function datagrid()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows')) ;
			$page = intval($this->input->post('page'))== 0 ? 1 : intval($this->input->post('page'));
			$offset = $row * ($page - 1);
			$data = array();
			if(isset($_POST['nama_user']) && !empty($_POST['nama_user']))
			{
				$where['nama_user LIKE'] = '%' . $this->input->post('nama_user') . '%';
			}
			if(isset($_POST['akun']) && !empty($_POST['akun']))
			{
				$where['akun LIKE'] = '%' . $this->input->post('akun') . '%';
			}
			if(isset($_POST['jenis_user']) && !empty($_POST['jenis_user']))
			{
				$where['jenis_user ='] = $this->input->post('jenis_user') ;
			}
			$where['aktif'] = 1;
			$params = array('_return'=>'data');
			if($where) $params['_where'] = $where;
			$data['total'] = $where ? $this->User_Model->count_by($where) : $this->User_Model->count_all();
			$this->User_Model->limit($row, $offset);
			$order = $this->User_Model->get_params('_order');
			$rows = $this->User_Model->set_params($params)->with('pegawai');
			$data['rows'] = $this->User_Model->get_selected()->data_formatter($rows);
			echo json_encode($data);
		}
		else
		{
			block_access_method();
		}
	}

	function login(){

		if($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			$this->load->model('Auth_Config');
			$auth_config = $this->Auth_Config->get(1);
			if($this->auth->get_login_attempts() >= $auth_config->max_attempts)
			{

				if($this->auth->get_time_last_attempts() < $auth_config->time_to_wait)
				{
					echo json_encode(array('msgType'=>'error', 'msgValue'=>'Anda sudah melampaui batas kesalahan login, silakan tunggu beberapa saat untuk login kembali'));
					exit;
				}
				else
				{
					$this->auth->reset_attempts();
				}
			}

			$users = $this->User_Model->get_by(
				array(
					'akun'=>$this->input->post('username'),
					'sandi'=>md5($this->User_Model->salt_formatter($this->input->post('password')))
				)
			);
			if(count($users) == 1)
			{
				if($users->aktif != 1)
				{
					$this->auth->reset_attempts();
					echo json_encode(
						array('msgType'=>'error',
						'msgValue'=>'Akun anda belum diaktifkan, silakan hubungi administrator untuk mengaktifkan akun anda')
					);
				}
				else
				{

					$this->load->model('User_Role_Model');

					$roles = $this->User_Role_Model->get_by(array('user_id'=>$users->id));

					$sess = array(
						'is_logged_in'=>1,
						'id'=>$users->id,
						'role_id'=>$roles->role_id,
						'email'=>$users->email,
						'username'=>$users->akun,
						'jenis_user' => $users->jenis_user
					);
                    /*session_start();
                    $_SESSION['username'] = $users->nama_user;
                    $_SESSION['role_id'] = $roles->role_id;
                    $_SESSION['users_id'] = $users->id;
                    $_SESSION['id_member'] = $users->id_member;*/


					//edit by NN
                      $this->load->library( 'nativesession' );
                      $_SESSION["isLogin"] = 'Yes';


					$ips = $_SERVER['REMOTE_ADDR'];
					if($ips == '::1') $ips = '127.0.0.1';

					$this->auth->update_session($sess);

					$this->User_Model->update(
						$users->id,
						array(
							'status_login'=>1,
							'login_terakhir'=>date('Y-m-d H:i:s'),
							'alamat_ip_terakhir'=>ip2long($ips)
						),
						TRUE
					);
					echo json_encode(array('msgType'=>'success', 'msgValue'=>base_url()));
					return;
				}
			}
			else
			{
				$this->auth->error_attempts();
				echo json_encode(array('msgType'=>'error', 'msgValue'=>'Username / password anda salah. Silakan ulangi kembali.'));
			}
		}
		else
		{
			block_access_method();
		}
	}
	
	function login_apps()
	{

		if($_SERVER['REQUEST_METHOD'] === 'GET')
		{
		    header('Access-Control-Allow-Origin:*');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
        header('Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding');

			$this->load->model('Auth_Config');
			$auth_config = $this->Auth_Config->get(1);
			if($this->auth->get_login_attempts() >= $auth_config->max_attempts)
			{

				if($this->auth->get_time_last_attempts() < $auth_config->time_to_wait)
				{
					echo json_encode(array('msgType'=>'error', 'msgValue'=>'Anda sudah melampaui batas kesalahan login, silakan tunggu beberapa saat untuk login kembali'));
					exit;
				}
				else
				{
					$this->auth->reset_attempts();
				}
			}

			$users = $this->User_Model->get_by(
				array(
					'akun'=>$this->input->get('username'),
					'sandi'=>md5($this->User_Model->salt_formatter($this->input->get('password')))
				)
			);
			if(count($users) == 1)
			{
				if($users->aktif != 1)
				{
					$this->auth->reset_attempts();
					echo json_encode(
						array('msgType'=>'error',
						'msgValue'=>'Akun anda belum diaktifkan, silakan hubungi administrator untuk mengaktifkan akun anda')
					);
				}
				else
				{

					$this->load->model('User_Role_Model');

					$roles = $this->User_Role_Model->get_by(array('user_id'=>$users->id));

					$sess = array(
						'is_logged_in'=>1,
						'id'=>$users->id,
						'role_id'=>$roles->role_id,
						'email'=>$users->email,
						'username'=>$users->akun
					);

					$ips = $_SERVER['REMOTE_ADDR'];
					if($ips == '::1') $ips = '127.0.0.1';

					$this->auth->update_session($sess);

					$this->User_Model->update(
						$users->id,
						array(
							'status_login'=>1,
							'login_terakhir'=>date('Y-m-d H:i:s'),
							'alamat_ip_terakhir'=>ip2long($ips)
						),
						TRUE
					);
					//echo json_encode(array('msgType'=>'success', 'msgValue'=>base_url()));
                    echo json_encode(1);
					//return;
				}
			}
			else
			{
				$this->auth->error_attempts();
				//echo json_encode(array('msgType'=>'error', 'msgValue'=>'Username / password anda salah. Silakan ulangi kembali.'));
                echo json_encode(0);
			}
		}
		else
		{
			block_access_method();
		}
	}
	function logout()
	{
		if($_SERVER['REQUEST_METHOD'] == 'GET')
		{
			$users = $this->User_Model->get($this->auth->get_user_id());
			//var_dump($users->status_login);die();
			//if(count($users) == 1 && $users->status_login == 1){
			if(count($users) == 1){
				$data['status_login'] = 0;
				$this->User_Model->update($users->id, $data, TRUE);
				$sess = array('is_logged_in'=>'', 'id'=>'', 'role_id'=>'', 'email'=>'', 'username'=>'');
				$this->session->unset_userdata($sess);
				$this->session->sess_destroy();
			}
			redirect(base_url());
		}
		else
		{
			block_access_method();
		}
	}

	function change_password()

	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if($this->User_Model->get_validate(array('sandi'=>'new_pwd')))
			{

				$current_user = $this->User_Model->get($this->auth->get_user_id());
				if($current_user->sandi == md5($this->User_Model->salt_formatter($this->input->post('old_pwd'))))
				{
					$data['sandi'] = md5($this->User_Model->salt_formatter($this->input->post('new_pwd')));
					$this->User_Model->update($this->auth->get_user_id(), $data, TRUE);
					echo json_encode(array('msgType'=>'success', 'msgValue'=>'Password berhasil diubah'));
					$users = $this->User_Model->get($this->auth->get_user_id());
					if(count($users) == 1 && $users->status_login == 1){
						$data['status_login'] = 0;
						$this->User_Model->update($users->id, $data, TRUE);
						$sess = array('is_logged_in'=>'', 'id'=>'', 'role_id'=>'', 'email'=>'', 'username'=>'');
						$this->session->unset_userdata($sess);
						$this->session->sess_destroy();
					}
					redirect(base_url());
				}
				else
				{
					echo json_encode(array('msgType'=>'error', 'msgValue'=>'Password lama anda salah'));
				}

			}
			else
			{
				echo json_encode(array('msgType'=>'error', 'msgValue'=>validation_errors()));
			}

		}
		else
		{
			$view = $this->load->view('users/change_password', '', TRUE);
			echo json_encode(array('msgType'=>'success', 'msgValue'=>$view));
		}
	}

	function add()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$data = $this->User_Model->set_validation()->validate();
			if($data !== false)
			{
				if($this->User_Model->check_unique($data))
				{
				    $data['sandi_asli'] = $this->input->post('sandi');
					if($this->User_Model->insert($data) !== false)
					{
						echo json_encode(array('msgType'=>'success', 'msgValue'=>'Data berhasil disimpan !'));
                        $jenis_user = $this->input->post('jenis_user');
                        $id_asesi = $this->input->post('id_member');
                        if($jenis_user == '1'){
                            $id_users = $this->db->insert_id();
                            $data = array(
                                           'id_users' => $id_users
                                        );

                            $this->db->where('id', $id_asesi);
                            $this->db->update(kode_tbl().'asesi', $data);

                        }
					}
					else
					{
						echo json_encode(array('msgType'=>'error', 'msgValue'=>'Data tidak dapat disimpan !'));
					}
				}
				else
				{
					echo json_encode(array('msgType'=>'error', 'msgValue'=>implode("<br/>", $this->User_Model->get_validation())));
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
			//$siswa_grid = $this->combogrid->set_properties(array('model'=>'v_siswa_model', 'controller'=>'siswa', 'fields'=>array('nis', 'nama'), 'options'=>array('id'=>'id_member', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama', 'panelWidth'=>400)))->load_model()->set_grid();
			$jenis_user = array(0=>'Harus dipilih', 1=>'Pemegang Sertifikat', 2=>'Asesor', 3=>'TUK');

			echo json_encode(array('msgType'=>'success', 'msgValue'=>$this->load->view('users/add',array('jenis_user'=>$jenis_user), TRUE)));
		}
	}

	function edit($id = false)
	{
		if(!$id){
			data_not_found();
			exit;
		}
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if(isset($_POST['new_pwd']) && !empty($_POST['new_pwd']))
			{
				$_POST['sandi'] = md5($this->User_Model->salt_formatter($this->input->post('new_pwd')));
			}
			$data = $this->User_Model->set_validation()->validate();
			if($data !== false)
			{
				if($this->User_Model->check_unique($data, intval($id)))
				{
					if($this->User_Model->update(intval($id), $data) !== false)
					{
						echo json_encode(array('msgType'=>'success', 'msgValue'=>'Data berhasil disimpan !'));
					}
					else
					{
						echo json_encode(array('msgType'=>'error', 'msgValue'=>'Data tidak dapat disimpan !'));
					}
				}
				else
				{
					echo json_encode(array('msgType'=>'error', 'msgValue'=>implode("<br/>", $this->User_Model->get_validation())));
				}
			}
			else
			{
				echo json_encode(array('msgType'=>'error', 'msgValue'=>validation_errors()));
			}
		}
		else
		{
			$users = $this->User_Model->get(intval($id));
			if(sizeof($users) == 1)
			{
				$this->load->library('combogrid');
				$this->load->Model('User_Role_Model');
				$user = $this->User_Model->get_single($users);
				$jenis_user = array(0=>'Harus dipilih', 1=>'Siswa', 2=>'Orang Tua Siswa', 3=>'Pegawai');
				$pegawai_grid = $this->combogrid->set_properties(array('model'=>'Pegawai_Model', 'value'=>$user->id_member, 'controller'=>'pegawai','fields'=>array('nip', 'nama_pegawai'), 'options'=>array('id'=>'id_member', 'pagination', 'rownumber', 'idField'=>'id', 'textField'=>'nama_pegawai', 'panelWidth'=>400)))->load_model()->set_grid();
				$roles = $this->User_Role_Model->get_single($this->User_Role_Model->get_by(array('user_id'=>$user->id)));
				$view = $this->load->view('users/edit', array('jenis_user'=>$jenis_user, 'roles'=>$roles , 'data'=>$user, 'pegawai_grid'=>$pegawai_grid), TRUE);
				echo json_encode(array('msgType'=>'success', 'msgValue'=>$view));
			}
			else
			{
				echo json_encode(array('msgType'=>'error', 'msgValue'=>'Data tidak dapat ditemukan !'));
			}
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
			$users = $this->User_Model->get(intval($id));
			if(sizeof($users) == 1)
			{
				if($this->User_Model->delete(intval($id)))
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

	function combogrid($id = false)
	{
		$this->load->model('Combo_Users_Model');
		$row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows')) ;
		$page = intval($this->input->post('page'))== 0 ? 1 : intval($this->input->post('page'));
		$offset = $row * ($page - 1);
		$data = array();
		$params = array('_return'=>'data');
		if(isset($_POST['q']))
		{
			$where['nama_user LIKE'] = "%" . $this->input->post('q') . "%";
		}
		if(isset($where)) $params['_where'] = $where;
		$data['total'] = isset($where) ? $this->Combo_Users_Model->count_by($where) : $this->Combo_Users_Model->count_all();
		$this->Combo_Users_Model->limit($row, $offset);
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
			$order = $this->Combo_Users_Model->get_params('_order');
		}
		$rows = isset($where) ? $this->Combo_Users_Model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->Combo_Users_Model->order_by($order, $order_criteria, $_order_escape)->get_all();
		$data['rows'] = $this->Combo_Users_Model->get_selected()->data_formatter($rows);
		echo json_encode($data);
	}
	function sms($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        $this->db->where('id', $id);
        $row = $this->db->get('t_users')->row();
        $username = $row->akun;
        $password = $row->sandi_asli;
        //var_dump($password);die();
        $admin = $this->db->get('r_konfigurasi_aplikasi')->row();
        $pesan = 'Login ' . $admin->url_aplikasi . ' User: ' . $username . ' Pass: ' . $password;
        $data['sender_id'] = $this->auth->get_user_data()->id;
        $data['reciepent_id'] = $id;
        $data['title'] = 'Akses Login Aplikasi';
        $data['message'] = $pesan;

        $this->load->model('Pesan_Model');
        $this->Pesan_Model->insert($data);
        $hasil = smssend_zenziva($row->hp, $pesan);

        $post = '{"personalizations": [{"to": [{"email": "'.$row->email.'"}],"subject": "Akses Login Aplikasi LSP"}],"from": {"email": "'.$admin->alamat_email.'"},"content": [{"type": "text/plain","value": "'.$pesan.'"}]}';
        //var_dump($post);die();
        sendgrid_api_text('https://api.sendgrid.com/v3/mail/send',$post);

        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Notifikasi Terkirim !'));
    }

	function search()
	{
		if($_SERVER['REQUEST_METHOD'] == 'GET')

		{
			$jenis_users = array(0=>'-', 1=>'Pemegang Sertifikat', 2=>'Asesor', 3=>'TUK', 4=>'Administrator');

			echo json_encode(array('msgType'=>'success', 'msgValue'=>$this->load->view('users/search',array('jenis_user'=>$jenis_users), TRUE)));
		}
		else
		{
			block_access_method();
		}
	}
}
