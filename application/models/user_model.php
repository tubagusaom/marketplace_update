<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Model extends MY_Model
{
	protected $_table = 't_users';

	protected $table_label = 'Data User';

	protected $_columns = array(
		'akun'	=>	array(
			'label'	=> 'Username',
			'rule'	=>	'trim|required|min_length[8]|max_length[20]|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string',
			'width' => 75,
			'input_name' => 'username'
		),
		'email'		=>	array(
			'label'	=>	'Email',
			'rule'	=>	'trim|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string',
			'width' => 150
		),
		'hp'		=>	array(
			'label'	=>	'HP',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string',
			'width' => 100
		),
		'nama_user' => array(
		  'label'	=>	'Shortname',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string',
			'width' => 100
		),
		'jenis_user' => array(
		  'label'	=>	'User Category',
			'rule'	=>	'trim|xss_clean',
			'formatter'	=>	array(''=>'',0=>'-', 1=>'Pemegang Sertifikat', 2=>'Seller', 3=>'Buyer', 4=>'Administrator', 99=>'SuperUser'),
			'save_formatter' => 'string',
			'width' => 90
		),
		'sandi'	=> 	array(
			'label'	=>	'Password',
			'rule'	=>	'trim|xss_clean',
			'hidden'=>	true,
			'formatter'	=>	'string',
			'save_formatter' => 'string',
			'visible' => false,
			'input_name' => 'password'
		),
		'sandi_asli'	=> 	array(
			'label'	=>	'Tanggal Lahir',
			'rule'	=>	'trim|xss_clean',
			'hidden'=>	true,
			'formatter'	=>	'string',
			'save_formatter' => 'string',

		),

		// 'status_login'	=>	array(
		// 	'label'	=>	'Login',
		// 	'auto'	=>	true,
		// 	'formatter'	=>	"fn_icon_convert(check, no-check)",
		// 	'save_formatter'	=>	'int',
		// 	'width' => 25,
    //         'align' => 'center'
		// ),
		'login_terakhir'=>	array(
			'label'	=>	'Last Login',
			'auto'	=> 	true,
			'formatter'	=>	'datetime',
			'save_formatter' => 'datetime',
			'width' => 125
		),
		'alamat_ip_terakhir'	=>	array(
			'label'	=>	'Last IP',
			'auto'	=>	true,
			'formatter'	=>	'long2ip_formatter',
			'save_formatter' => 'ip2long_formatter',
			'width' => 75
		),
		// 'aktif'	=>	array(
		// 	'label'	=>	'Active',
		// 	'rule'	=>	'trim|xss_clean',
		// 	'formatter'	=>	"fn_icon_convert(check, no-check)",
		// 	'save_formatter' => 'int',
		// 	'width' => 75,
    //         'align' => 'center'
		// ),
		'id_member'	=>	array(
			'label'	=>	'ID Employee',
			'rule'	=>	'trim|xss_clean',
			'formatter'	=>	"int",
			'save_formatter' => 'int',
			'width' => 75,
      'hidden' => 'true'
 		)
	);

	protected $_unique = array('unique'=>array('akun'), 'group'=>false);
	protected $_abandoned_columns = array('status_login', 'login_terakhir', 'alamat_ip_terakhir');
	protected $_salt = '5ebe2294ecd0e0f08eab7690d2a6ee69';
	protected $protected_attributes = array('id');
	protected $before_create = array('salt_password', 'add_callback', 'update_callback');
	protected $before_update = array('update_callback');

	protected $has_one = array(
		'role'=>array(
			'model'=>'User_Role',
			'primary_key'=>'user_id',
			'retrieve_columns'=>array('role_id')
		)
	);

	protected $_order = array("id" => "DESC");

	public function __construct()
	{
		parent::__construct();
	}

	function salt_password($data)
	{
		$data['sandi'] = md5($this->User_Model->salt_formatter($data['sandi']));
		return $data;
	}

	function ip2long_formatter($ip_addr)
	{
		return ip2long($ip_addr);
	}

	function long2ip_formatter($ip_addr)
	{
		return long2ip($ip_addr);
	}

	function salt_formatter($password){
		if(isset($this->_salt))
		{
			return $this->_salt . $password;
		}
	}

}
