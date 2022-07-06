<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	if(!function_exists('forbidden')){
		function forbidden($ajaxReq){
			$ci = &get_instance();
			header('HTTP/1.1 403 Forbidden');
			if($ajaxReq){					
				echo json_encode(array('msgType'=>'Error 403','msgValue'=>'Forbidden'));
			}else{
				$ci->load->view('template/403.php');
			}
		}
	}
	
	if(!function_exists('is_ajax_request')){
		function is_ajax_request(){
			if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
				return true;
			}else return false;
		}
	}
	
	if(!function_exists('getUserFn')){
		function getUserFn($func){
			$ci = &get_instance();
			$ci->load->library('auth');
			return $ci->auth->{$func}();
		}
	}
	
	if(!function_exists('roman')){
		function roman($num)
		{
			// Make sure that we only use the integer portion of the value
			 $n = intval($num);
			 $result = '';
		 
			 // Declare a lookup array that we will use to traverse the number:
			 $lookup = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
			 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
			 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
		 
			 foreach ($lookup as $roman => $value) 
			 {
				 // Determine the number of matches
				 $matches = intval($n / $value);
		 
				 // Store that many characters
				 $result .= str_repeat($roman, $matches);
		 
				 // Substract that from the number
				 $n = $n % $value;
			 }
		 
			 // The Roman numeral should be built, return it
			 return $result;
		}
	}
	
	if(!function_exists('get_day_of_week'))
	{
		function get_day_of_week($var_time)
		{
			$day = date('w', strtotime($var_time));
			$day_name = array(
				0=>'Minggu', 
				1=>'Senin', 
				2=>'Selasa', 
				3=>'Rabu', 
				4=>'Kamis', 
				5=>'Jumat', 
				6=>'Sabtu'
			);
			return $day_name[$day];
		}
	}
	
	if(!function_exists('get_month_of_year'))
	{
		function get_month_of_year($var_time = false)
		{
			if($var_time)
			{
				$month = date('n', strtotime($var_time));
			}
			else
			{
				$month = date('n');
			}
			$month_name = array(
				1=>'Januari', 
				2=>'Pebruari', 
				3=>'Maret', 
				4=>'April', 
				5=>'Mei', 
				6=>'Juni', 
				7=>'Juli',
				8=>'Agustus',
				9=>'September',
				10=>'Oktober',
				11=>'November',
				12=>'Desember'
			);
			return $month_name[$month];
		}
	}
	
	if(!function_exists('get_general_date'))
	{
		function get_general_date($var_time)
		{
			$date = strtotime($var_time);
			return date('j', $date) . " " . get_month_of_year($var_time) . " " . date('Y', $date);
		}
	}	
	
	if(!function_exists('get_long_date'))
	{
		function get_long_date($var_time)
		{
			$date = strtotime($var_time);
			return get_day_of_week($var_time) . ', ' . date('j', $date) . " " . get_month_of_year($var_time) . " " . date('Y', $date);
		}
	}
	
	if(!function_exists('get_long_datetime'))
	{
		function get_long_datetime($var_time)
		{
			$date = strtotime($var_time);
			return get_day_of_week($var_time) . ', ' . date('j', $date) . " " . get_month_of_year($var_time) . " " . date('Y', $date) . " " . date('H:i:s', $date);
		}
	}
	
	if(!function_exists('icon_convert'))
	{
		function icon_convert($value, $principal, $alternate)
		{
			$img = "<i class='icons-";
			$img .= (bool) $value ? trim($principal) : trim($alternate);
			$img .= "'></i>";
			return $img;
		}
	}
	
	if(!function_exists('data_not_found'))
	{
		function data_not_found()
		{
			echo json_encode(array('msgType'=>'error', 'msgValue'=>'Data tidak dapat ditemukan'));
		}
	}
	
	if(!function_exists('access_forbidden'))
	{
		function access_forbidden()
		{
			echo json_encode(array('msgType'=>'error', 'msgValue'=>'Anda tidak diijinkan mengakses halaman ini'));
		}
	}
	
	if(!function_exists('block_access_method'))
	{
		function block_access_method()
		{
			if(is_ajax_request())
			{
				$ci = &get_instance();
				$id = $ci->session->userdata('id');
				if($id)
				{
					echo json_encode(array('msgType'=>'error', 'msgValue'=>'Anda tidak diijinkan mengakses halaman ini'));
					exit;
				}
				else
				{
					header("HTTP/1.0 419 Authentication Timeout");
					return;
				}				
			}
			else
			{
				
				redirect(base_url());
			}
		}
	}
	
	if(!function_exists('app_config'))
	{
		function app_config()
		{
			$ci = &get_instance();
			$ci->load->model('Konfigurasi_Model');
			$data = array('nama_unit'=>'Belum Ditentukan', 'alamat'=>'Belum Ditentukan', 'no_telpon'=>'Belum Ditentukan', 'no_fax'=>'Belum Ditentukan', 'alamat_email'=>'Belum Ditentukan', 'sms_center'=>'Belum Ditentukan');
			$configs = $ci->Konfigurasi_Model->get(1);
			if(sizeof($configs) == 1)
			{
				$config = $ci->Konfigurasi_Model->get_single($configs);
				$data['nama_unit'] = $config->nama_unit;
				$data['alamat'] = $config->alamat;
				$data['no_telpon'] = $config->no_telpon;
				$data['no_fax'] = $config->no_fax;
				$data['alamat_email'] = $config->alamat_email;
				$data['sms_center'] = $config->sms_center;
			}
			return $data;
		}
	}

	if(!function_exists('app_db_exist'))
	{
		function app_db_exist($db_set){
			$path = realpath(APPPATH . 'config/database.php');
			$handle = fopen($path, 'r');
			$hostname = "";
			$valid = TRUE;
			if($handle !== false){
				while ($valid) {
				    $contents = fgets($handle);
				    if(strpos($contents, "\$db['" . $db_set . "']['hostname']") !== false){
				    	$hostname = str_replace(array("'", "\$db", $db_set, "hostname", "=", "[", "]", ";"), "", $contents);
				    	$valid = FALSE;
				    	break;
				    }
				}
				fclose($handle);
				return $hostname;
			}
		}
	}

	if(!function_exists('see'))
	{
		function see($anything, $die = false)
		{
			echo '<pre>';
			print_r($anything);
			echo '</pre>';

			if($die)
			{
				die();
			}
		}
	}
    if(!function_exists('mysql_date'))
	{
		function mysql_date($date='00/00/0000')
		{
			$dates = array_reverse(explode("/", $date));
            $result = implode('-', $dates);
            return $result;
		}
	}