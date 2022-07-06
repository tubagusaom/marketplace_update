<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Batch_report extends MY_Controller {


	function __construct()

	{
		parent::__construct();
        $this->load->model('Report_Template_Model');

	}
    function index() {  
        $view = $this->load->view('report/batch_report', $this->Report_Template_Model->batch_report(), true);
		echo json_encode(array('msgType'=>'success', 'msgValue'=>$view));
	}
	
}