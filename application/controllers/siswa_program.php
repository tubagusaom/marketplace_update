<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Siswa_program extends MY_Controller {


	function __construct()
	{
		parent::__construct();
        $this->load->model('siswa_model');

	}
    
    function index() 
    {    
        $id = 1;
        $parsing_data['data_siswa'] = $this->siswa_model->siswa_program($id);
        $view = $this->load->view('siswa/siswa_program', $parsing_data, true);
        
	    echo json_encode(array('msgType'=>'success', 'msgValue'=>$view));
    }

    
}