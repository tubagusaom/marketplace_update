<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class CI_grid
{
	
	protected $ci;
	protected $config;
	protected $model;
	protected $columns;
	protected $fields;
	protected $controller;
	protected $toolbars;
	protected $gridtype;
	protected $title;
	protected $options =  array();
	
	function __construct()
	{
		$this->ci =& get_instance();
		$this->config =&  get_config();
		$this->ci->load->library('auth');
	}
	
	public function set_properties()
	{
		$properties = func_get_args();
		
		if(count($properties) == 1 && is_array($properties[0]))
		{
		
			foreach($properties[0] as $property=>$value)
			{
				if(property_exists(get_class($this), $property))
				{
					$this->{$property} = $value;
				}
			}
			
		}
		return $this;
	}
	
	public function get_property($property)
	{
		if(property_exists(get_class($this), $property))
		{
			return $this->{$property};
		}
		else
		{
			return false;
		}
	}
	
	public function load_model()
	{
		$this->ci->load->model($this->model);
		return $this;
	}
	
	public function set_columns()
	{
		$this->columns = array();
		
		$columns = $this->ci->{$this->model}->get_params('_columns');
		
		if(!isset($this->fields))
		{
			$this->fields = array_keys($columns);
		}
				
		$grid_column = array();
		
		$grid_column[] =  "{ field: '" . $this->ci->{$this->model}->get_params('primary_key') . "', hidden: true }";		
		
		foreach($this->fields as $field)
		{
			if(array_key_exists($field, $columns)) {
				if(!array_key_exists('hidden', $columns[$field]))
				{
					$align = array_key_exists('align', $columns[$field]) ? ", align: '" . $columns[$field]['align'] . "'" : "";
					$grid_column[] = "{ field: '" . $field . "', title: '" . $columns[$field]['label'] . "', width: " . $columns[$field]['width'] . $align . "}";
				}
			} else {
				$in_relation_status = false;
				$belongs = $this->ci->{$this->model}->get_params("belongs_to");
				if($belongs !== false) {
					foreach($belongs as $key_belong=>$val_belong) {
						if(!$in_relation_status){
							if(!isset($this->ci->{$key_belong})) {
								$this->ci->load->model($val_belong['model'], $key_belong);
							}		
							$bel_columns = $this->ci->{$key_belong}->get_params("_columns");
							if(array_key_exists($field, $bel_columns)){
								$align = array_key_exists('align', $bel_columns[$field]) ? ", align: '" . $bel_columns[$field]['align'] . "'" : "";
								$grid_column[] = "{ field: '" . $field . "', title: '" . $bel_columns[$field]['label'] . "', width: " . $bel_columns[$field]['width'] . $align . "}";
								$in_relation_status = true;
								break;
							}
						} else {
							break;
						}
					}
				}
				$has_many = $this->ci->{$this->model}->get_params("has_many");
				if(!$in_relation_status && $has_many !== false){
					foreach($has_many as $key_many=>$val_many){
						if(!isset($this->ci->{$key_many})) {
							$this->load->model($val_many['model'], $key_many);
						}						
						if(array_key_exists($field, $this->ci->{$key_many}->_columns)){
							$select[] = $field;
							$formatter[] = $this->ci->{$key_many}->_columns[$field]['formatter'];
							$in_relation_status = true;
							break;
						}						
					}
				}
			}
		}
		$this->columns = $grid_column;
	}
	
	public function set_toolbar()
	{
		$title = isset($this->title) ? $this->title : $this->ci->{$this->model}->get_params('table_label');
		
		$this->ci->load->model('V_Toolbar_Model');
		
		$this->toolbars = array();
		
		$where = array('controller_name'=>$this->controller, 'role_id'=>array($this->ci->auth->get_role_id(), 2));
		
		/* get many by toolbar dengan criteria controller name dan role id */
		$toolbars_data = $this->ci->V_Toolbar_Model->order_by($this->ci->V_Toolbar_Model->get_params('_order'))->get_many_by($where);
		
		foreach($toolbars_data as $toolbar)
		{
			$button = "{iconCls: 'icon-" . $toolbar->icon_name . "', text: '" . $toolbar->toolbar_name . "', handler: function(){" . $toolbar->function_type . "({";
			
			$button .= $toolbar->grid_type == 1 ? "" : "gridtype: true,";
			
			$button .= is_null($toolbar->target_grid) ? "" : "target_grid: '" . $toolbar->target_grid . "',"; 
			
			$button .= is_null($toolbar->parent_grid) ? "" : "parent: '" . $toolbar->parent_grid . "',";
			
			$button .= "id: '" . $this->options['id'] . "', href: '" . $this->ci->config->item('base_url') . $toolbar->controller_name . "/" . $toolbar->method_name . "',";
			
			$button .= is_null($toolbar->modal_width) ? "" : "width: " . $toolbar->modal_width . ",";
			
			$button .= is_null($toolbar->modal_height) ? "" : "height: " . $toolbar->modal_height . ",";
			
			$button .= "title:'" . $title . "'});}}";
			
			$this->toolbars[] = $button;
		}
		
	}
	
	public function set_grid()
	{
		$this->set_columns();
		$this->set_toolbar();
		$title = isset($this->title) ? $this->title : $this->ci->{$this->model}->get_params('table_label');
		$list = "list_({ 
			title: '" . $title . "',
			id: '" . $this->options['id'] . "',";
			
		if(!in_array("child", $this->options))
		{
			$list .= "url: '" . $this->ci->config->item('base_url') . $this->controller . "/',";
		}
		
		if(in_array("pagination", $this->options))
		{
			$list .= "pagination: true,";
		}
		
		if(in_array("fit", $this->options))
		{
			$list .= "fit: true,";
		}
		
		if(in_array("multi", $this->options))
		{
			$list .= "multi: true,";
			array_unshift($this->columns, "{field: 'ck', checkbox: true}");
		}
		
		if(in_array("nowrap", $this->options))
		{
			$list .= "noWrap: false,";
		}
		
		if(in_array("rownumber", $this->options))
		{
			$list .= "rownumber: true,";
		}
		
		if(sizeof($this->toolbars) > 0){
			$list .= "toolbar: [" . implode(',', $this->toolbars) . "],";
		}
		$list .= "columns: [[" . implode(',', $this->columns) . "]]";
		
		if(array_key_exists("target", $this->options))
		{
			$list .= ", clickRow: function(i, data){
				if(typeof i !== 'undefined'){
					$('#" . $this->options['target']['id'] . "').datagrid({
						url: '" . $this->config['base_url'] . $this->options['target']['controller'] . "/datagrid/' + data.id 
					})
				  }
				}, onLoadSuccess: function(data){
					$('#" . $this->options['target']['id'] . "').datagrid({
						url: '" . $this->config['base_url'] . $this->options['target']['controller'] . "/datagrid'
					})
				}";
		}
			
		$list .= "});\n";
		
		if(in_array("page_list", $this->options)){
			$list .= $this->options['id'] . "_pager = $('#".$this->options['id']."').datagrid('getPager');\n" . $this->options['id'] . "_pager.pagination({\nshowPageList:false\n
			});\n";
		}
		$this->columns = array();
		$this->toolbars = array();
		unset($this->model);
		unset($this->fields);
		return $list;
	}
	
}