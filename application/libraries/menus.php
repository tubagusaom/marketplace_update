<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class CI_menus
{
	
	protected $ci;
	protected $options =  array();
	
	function __construct()
	{
		$this->ci =& get_instance();
		$this->ci->load->model('V_Menu_Model');
		$this->ci->load->library('auth');
		$this->config =& get_config();
	}
	
	function display_menu()
	{
		$where['role_id'] = array(intval($this->ci->auth->get_role_id()), 2);
		$this->ci->db->select('group_name, count(menu_name) as total');
		$this->ci->db->group_by('group_name');
		$this->ci->db->where_in('role_id', $where['role_id']);
        $query = $this->ci->db->get($this->ci->V_Menu_Model->get_params('_table'));
		$groups_order = array();
		
		foreach($query->result() as $rows)
		{
			$groups_order[$rows->group_name] = $rows->total;
		}
		$this->ci->V_Menu_Model->order_by($this->ci->V_Menu_Model->get_params('_order'));
		$menus = $this->ci->V_Menu_Model->get_many_by($where);
		
		
		
		$display = "";
		
		$group_name = "";
		
		$menu_name = "";
		
		foreach($menus as $menu)
		{
			if($group_name == "" || $group_name !== $menu->group_name)
			{
				if($group_name !== "")
				{
					$display .= "</ul></div>";
				}
				$group_name = $menu->group_name;
				$display .= "<div title=\"" . $menu->group_name . " <small class='label-group bg-blue pull-right'>" . $groups_order[$menu->group_name] . "</small>\" data-options=\"iconCls:'icon-view'\" style=\"overflow:auto;padding:0;\">\n<ul class=\"sidebar-group-menu\">\n";
			}
			
			$display .= "<li>\n<a href=\"" . $this->config['base_url'] . $menu->controller_name . "/" . $menu->method_name . "\"><i class=\"fa fa-" . $menu->icon_name . "\"></i>&nbsp;&nbsp;" . $menu->menu_name . "</a>\n</li>\n";
		}
		
		if(sizeof($menus) > 0)
		{
			$display .= "</ul>\n</div>";
		}
		
		return $display;
		
	}
	
}