<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class CI_acl
{

	protected $controller;
	protected $method;
	protected $role;

	function __construct()
	{
		$this->ci =& get_instance();
		$this->config =& get_config();
	}

	function check_permission($vars)
	{
		$this->ci->load->model('Vacl_Model');
		$permission = $this->ci->Vacl_Model->get_by($vars);

		$permissions = array($permission);

		// var_dump($vars); die();

		if(count($permissions) == 0)
		{
			if($vars['role_id'] == 1)
			{
				return false;
			}
			else
			{
				$vars['role_id'] = 2;

				$permissions = $this->ci->Vacl_Model->get_by($vars);

				if(count($permissions) == 0)
				{
					return false;
				}
				else
				{
					return true;
				}
			}
		}
		else
		{
			return true;
		}
	}

}
