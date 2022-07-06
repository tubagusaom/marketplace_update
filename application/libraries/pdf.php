<?php

class CI_Pdf {

	function pdf_create($html, $filename, $attachment = TRUE, $stream=TRUE, $portrait = TRUE)
	{
		ini_set("memory_limit", "64M"); 
		require_once("dompdf/dompdf_config.inc.php");
		spl_autoload_register('DOMPDF_autoload');
		
		$dompdf = new DOMPDF();
		
		if($portrait === TRUE) $dompdf->set_paper("A4");
		else $dompdf->set_paper('A4', 'landscape');
		
		$dompdf->load_html($html);
		
		
		$dompdf->render();
		
		if ($stream) {
			$dompdf->stream($filename.".pdf", array("Attachment" => $attachment));	
		} else {
			
			$CI =& get_instance();
			
			$CI->load->helper('file');
			
			write_file($filename, $dompdf->output());
			
		}
	}
}