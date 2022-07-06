<?php
class Daftar_model extends CI_Model {

public function daftar_user()
	{
			$hash = md5( rand(0,1000) ); // Generate random 32 character hash and assign it to a local variable.
			// Example output: f4552671f8909587cf485ea990207f3b
			$password = rand(1000,5000); // Generate random number between 1000 and 5000 and assign it to a local variable.
			// Example output: 4568
			$waktu = date('Y-m-d H:i:s');

			$username = $this->input->post('username');
			$this->db->where('akun',$username);
			$query = $this->db->get('t_users')->row();
			if(count($query) > 0){
				return false;
			}else{

				$data = array(
					'akun' => $this->input->post('username'),
					'email' => $this->input->post('email'),
					'sandi' => md5($this->salt_formatter($password)),
					'sandi_asli' => $password,
					'created_when' => $waktu,
					'hash' => $hash,
					'jenis_user' => '1'
				);
				$this->db->insert('t_users', $data);
				$user_id= $this->db->insert_id();
                $data['id'] = $user_id;
				return $data;
			}
		}

	public function get_user_daftar($email, $hash){
		$query = $this->db->get_where('t_users',array('akun' => $email,'hash' => $hash,'aktif' => '0'));
        return $result = $query->row();
	}
	
	
		
	
	public function upd_aktif($username,$id){
		$data = array(
			'aktif' => '1' 
		);
		$this->db->where('akun', $username);
		$this->db->update('t_users', $data);

		$datay['user_id'] = $id; 
		$datay['role_id'] = 17;
        $this->load->model('User_Role_Model');
        return $this->User_Role_Model->insert($datay);
	}
	function salt_password($data)
	{
		$ok = md5($this->salt_formatter($data));
		return $ok;
	}
	protected $_salt = '5ebe2294ecd0e0f08eab7690d2a6ee69';
	function salt_formatter($password){
		if(isset($this->_salt))
		{
			return $this->_salt . $password;
		}
	}
	

	
}