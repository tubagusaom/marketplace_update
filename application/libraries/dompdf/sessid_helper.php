<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('UID')){
 	function UID(){
  		$ci = &get_instance();
  		$ci->load->library('auth');
  		return $ci->auth->getUID();  		
 	}
}