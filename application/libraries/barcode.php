<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class CI_barcode
{
	protected $ci;
	protected $config;
	
	function __construct()
	{
		$this->ci =& get_instance();
		$this->config =& get_config();
	}
	
	function generate($data)
	{
		$bar_fonts = str_replace('application/libraries', '', dirname(__FILE__)) . 'assets/fonts/barcode/free3of9.ttf';
		$sans_fonts = str_replace('application/libraries', '', dirname(__FILE__)) . 'assets/fonts/open-sans/OpenSans-Regular.ttf';
		$width = 200;
		$height = 60;

		$img = imagecreate($width, $height);

		// First call to imagecolorallocate is the background color
		$white = imagecolorallocate($img, 255, 255, 255);
		$black = imagecolorallocate($img, 0, 0, 0);

		// Reference for the imagettftext() function
		// imagettftext($img, $fontsize, $angle, $xpos, $ypos, $color, $fontfile, $text);
		imagettftext($img, 36, 0, 0, 30, $black, $bar_fonts, $data);

		imagettftext($img, 8, 0, 60, 40, $black, $sans_fonts, $data);
		ob_start();
			//header('Content-type: image/png');
			imagepng($img);
			$barcode = ob_get_contents();
		ob_end_clean();
		imagedestroy($img);
		return base64_encode($barcode);
	}
}