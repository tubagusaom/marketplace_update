<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class CI_auth
{
	/*
		Global variabel untuk loading config dan ci instance
	*/
	protected $ci;
	protected $config;

	public function __construct()
	{
		$this->ci =& get_instance();
		$this->config =& get_config();
		$this->ci->load->library('session');
	}

	/*
		update session dengan nilai baru
	*/
	public function update_session($data)
	{
		$this->ci->session->set_userdata($data);
	}

	/*
		Periksa apakah user sedang login
	*/
	public function is_logged_in()
	{
		return $this->ci->session->userdata('is_logged_in');
	}

	/*
		Periksa id dari user yang sedang login
	*/
	public function get_user_id()
	{
		return $this->ci->session->userdata('id');
	}

	/*
		Periksa kelompok role, anonymous atau valid user
	*/
	public function get_group_role()
	{
		if(intval($this->is_logged_in()) == 0)
		{
			return 1;
		}
		else
		{
			return 2;
		}
	}

	/*
		Periksa role id, jika anonymouse akan diberi nilai 1
	*/
	public function get_role_id()
	{
		if(intval($this->is_logged_in()) == 0 || intval($this->ci->session->userdata('role_id')) == 0)
		{
			return 1;
		}
		else
		{
			return $this->ci->session->userdata('role_id');
		}
	}

	public function get_rolename()
	{
		$this->ci->load->model('Role_Model');
		$roles = $this->ci->Role_Model->get_single($this->ci->Role_Model->get($this->get_role_id()));
		return $roles->nama_peran;
	}

	public function get_employee_name()
	{
		$this->ci->load->model('Pegawai_Model');
		$this->ci->load->model('User_Model');
		$user = $this->ci->User_Model->get_single($this->ci->User_Model->get($this->get_user_id()));
		$employee = $this->ci->Pegawai_Model->get_single($this->ci->Pegawai_Model->get($user->pegawai_id));
		return $employee->nama_pegawai;
	}

	/*
		Periksa alamat email dari user yang sedang login
	*/
	public function get_email()
	{
		return $this->ci->session->userdata('email');
	}

	/*
		Periksa username dari user yang sedang login
	*/
	public function get_username()
	{
		return $this->ci->session->userdata('username');
	}

	/*
		Periksa module dari user yang sedang login
	*/
	public function get_module()
	{
		return $this->ci->session->userdata('module');
	}

	/*
		Proteksi dari percobaan login. (Bruteforce protection)
	*/

	/*
		Periksa percobaan login yg ke sekian kalinya
	*/
	public function get_login_attempts()
	{
		return $this->ci->session->userdata('attempts');
	}

	/*
		Periksa waktu percobaan login yg terakhir kali
	*/
	public function get_last_attempts()
	{
		return $this->ci->session->userdata('last_attempts');
	}

	/*
		Tambahkan jumlah percobaan ke session
	*/
	public function insert_attempts($counter)
	{
		$this->ci->session->set_userdata(array('attempts'=>$counter,  'last_attempts'=>date('Y-m-d H:i:s')));
	}

	/*
		Tambahkan jumlah percobaan setiap terjadi kesalahan login
	*/
	public function error_attempts()
	{
		$counter = intval($this->get_login_attempts());
		$counter++;
		$this->insert_attempts($counter);
	}

	/*
		Dapatkan waktu percobaan setelah sekian lama
	*/
	public function get_time_last_attempts()
	{
		$diff = date_diff(date_create($this->get_last_attempts()), date_create());
		return $diff->format('%i');
	}

	/*
		Reset attempts ke 1 setelah jeda waktu sekian menit
	*/
	public function reset_attempts()
	{
		$this->insert_attempts(1);
	}

	public function get_user_data()
	{
		$this->ci->load->model('V_Users_Model');
		$data_users = $this->ci->V_Users_Model->get_single($this->ci->V_Users_Model->get($this->get_user_id()));
		// return $this->ci->V_Users_Model->get_single($this->ci->V_Users_Model->get($this->get_user_id()));
		return $data_users;

		// if (json_decode($data_users) == '') {
		// 	return $data_users;
		// }else {
		// 	return false;
		// }

		// var_dump(json_decode($data_users)); die();
	}

}
