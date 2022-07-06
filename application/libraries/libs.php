<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class CI_libs
{
	protected $ci;
	function __construct()
	{
		$this->ci =& get_instance();
	}
	
	function forbidden($ajaxReq){
		header('HTTP/1.1 403 Forbidden');
		if($ajaxReq){					
			echo json_encode(array('error'=>'403','msg'=>'Forbidden'));
		}else{
			$this->ci->load->view('template/403.php');
		}
	}
	
	function is_ajax_request()
	{
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'))
		{
			return true;
		}
		else 
		{
			return false;
		}
	}
	
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
	
	function get_general_date($var_time)
	{
		$date = strtotime($var_time);
		return date('j', $date) . " " . get_month_of_year($var_time) . " " . date('Y', $date);
	}
	
	function get_long_date($var_time)
	{
		$date = strtotime($var_time);
		return get_day_of_week($var_time) . ', ' . date('j', $date) . " " . get_month_of_year($var_time) . " " . date('Y', $date);
	}
	
	function access_forbidden()
	{
		echo json_encode(array('msgType'=>'error', 'msgValue'=>'Anda tidak diijinkan mengakses halaman ini'));
	}
	
	function block_access_method()
	{
		if($this->is_ajax_request())
		{
			echo json_encode(array('msgType'=>'error', 'msgValue'=>'Anda tidak diijinkan mengakses halaman ini'));
			exit;
		}
		else
		{
			
			redirect(base_url());
		}
	}
	
}