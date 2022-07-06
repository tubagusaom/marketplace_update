<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class CI_combogrid
{
	
	protected $ci;
	protected $config;
	protected $model;
	protected $columns;
	protected $fields;
	protected $controller;
	protected $gridtype;
	protected $_with;
	protected $options =  array();
	protected $value;
	
	function __construct()
	{
		$this->ci =& get_instance();
		$this->config =&  get_config();
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
			if(array_key_exists($field, $columns)){
				if(!array_key_exists('hidden', $columns[$field]))
				{
					$grid_column[] = "{ field: '" . $field . "', title: '" . $columns[$field]['label'] . "', width: " . $columns[$field]['width'] . "}";
				}
			} else {
				$in_relation_status = false;
				$belongs = $this->ci->{$this->model}->get_params('belongs_to');
				$has_many = $this->ci->{$this->model}->get_params('has_many');
				if(!$in_relation_status && $belongs !== false){
					foreach($belongs as $key_belong=>$val_belong){
						if(!isset($this->ci->{$key_belong})){
							$this->ci->load->model($val_belong['model'], $key_belong);
						}
						$bel_columns = $this->ci->{$key_belong}->get_params('_columns');
						if(array_key_exists($field, $bel_columns)){
							$grid_column[] = "{ field: '" . $field . "', title: '" . $bel_columns[$field]['label'] . "', width: " . $bel_columns[$field]['width'] . "}";
							$in_relation_status = true;
							break;
						}
					}
				}
				if(!$in_relation_status && $has_many !== false){
					foreach($has_many as $key_many=>$val_many){
						if(!$in_relation_status){
							if(!isset($this->ci->{$key_many})){
								$this->ci->load->model($val_many['model'], $key_many);
							}
							$has_columns = $this->ci->{$has_many}->get_params('_columns');
							if(array_key_exists($field, $has_columns)){
								$grid_column[] = "{ field: '" . $field . "', title: '" . $has_columns[$field]['label'] . "', width: " . $has_columns[$field]['width'] . "}";
								$in_relation_status = true;
								break;
							}
						} else {
							break;
						}
					}
				}
			}
		}
		$this->columns = $grid_column;
	}
	
	public function set_grid()
	{
		$this->set_columns();
		$combo = "combo_({ 
			id: '" . $this->options['id'] . "',
			url: '" . $this->ci->config->item('base_url') . $this->controller . "/',
			idField: '" . $this->options['idField'] . "',
			textField: '" . $this->options['textField'] . "'";
		
		if(in_array("pagination", $this->options))
		{
			$combo .= ",pagination: true";
		}
		
		if(in_array("fit", $this->options))
		{
			$combo .= ",fit: true";
		}
		
		if(in_array("rownumber", $this->options))
		{
			$combo .= ",rownumber: true";
		}
		
		$combo .= ",panelWidth: " . $this->options['panelWidth'];
		
		$combo .= ",columns: [[" . implode(',', $this->columns) . "]]";
		
		if(isset($this->value))
		{
			if(is_numeric($this->value))
			{
				$combo .= ",value:" . $this->value;
			}
			else
			{
				$combo .= ",value:'" . $this->value . "'";
			}
		}
		
		if(array_key_exists('onchange', $this->options))
		{
			if($this->options['onchange']['type'] == 'combogrid')
			{
				$combo .= ",onChange: function(newValue, oldValue){
					if(newValue != ''){			
						$('#" . $this->options['onchange']['target'] . "').combogrid('setValue','');
						var g_" . $this->options['onchange']['target'] . " = $('#" . $this->options['onchange']['target'] . "').combogrid('grid');	
						g_" . $this->options['onchange']['target'] . ".datagrid('load', {
							'" . $this->options['onchange']['q_field'] . "': newValue
						});
					}
				}";
			}
		}
		
		$combo .= ",fitColumns : true,nowrap: false});\n";
		
		if(in_array("no_page_list", $this->options)){
			$combo .= $this->options['id'] . "_pager = $('#".$this->options['id']."').datagrid('getPager');\n" . $this->options['id'] . "_pager.pagination({\nshowPageList:false\n
			});\n";
		}
		$this->columns = array();
		$this->fields = array();
		unset($this->model);
		return $combo;
	}
	
}