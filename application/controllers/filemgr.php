<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Filemgr extends MY_Controller {


        function __construct()
		{
			parent::__construct();
			
		}
        
        function index() {            
		
		    $view = $this->load->view('filemgr/index', array(), true);
		
		    echo json_encode(array('msgType'=>'success', 'msgValue'=>$view));
        }
		
        public function filemgr_init()
        {
			$this->load->helper('path');
			$opts = array(
				'roots' => array(
				  array( 
					'uploadAllow' => array('image', 'application/pdf', 'application/msword', 'application/excel'),
					'driver' => 'LocalFileSystem', 
					'path'   => set_realpath(realpath(APPPATH.'../assets/files/')), 
					'URL'    => base_url('assets/files') . '/'
				  ) 
			    )
			);
			$this->load->library('elfinder_lib', $opts);
        }
		
		function upload(){
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$this->load->helper('path');
				$opts = array(
					'roots' => array(
					  array( 
						'uploadAllow' => array('image', 'application/pdf', 'application/msword', 'application/excel'),
						'driver' => 'LocalFileSystem', 
						'path'   => set_realpath(realpath(APPPATH.'../assets/files/')), 
						'URL'    => base_url('assets/files') . '/'
					  ) 
					)
				);
				$this->load->library('elfinder_lib', $opts);
			} else {
				block_access_method();
			}
		}
}