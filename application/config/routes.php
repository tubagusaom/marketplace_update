<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$host = $_SERVER['HTTP_HOST'];

//if($host=='www.jmkp.local' || $host=='jmkp.local' || $host=='jmkp.bnsp.go.id' || $host=='www.jmkp.bnsp.go.id'){
//	$route['default_controller'] = "welcome";
//
//}else{
//	$route['default_controller'] = "mobile";
//}

$route['default_controller'] = "welcome";
$route['404_override'] = '';
$route['gambar/(:any)'] = "welcome/$1";

// $route['uji_kompetensi/(:any)'] = "welcome/uji_kompetensi/$1";

// $route['uji_kompetensi'] = "welcome/uji_kompetensi/1";
// $route['dasar_hukum_pendirian_lsp_bnsp.html'] = "profile/index/111";
// $route['proses_sertifikasi_lsp_jmkp.html'] = "profile/index/118";
// $route['uji_kompetensi.html'] = "welcome/uji_kompetensi";

$route['daftar_merchant'] = "welcome/daftar_merchant";

$route['f/(:any)'] = "search/filter/$1";


/* End of file routes.php */
/* Location: ./application/config/routes.php */
