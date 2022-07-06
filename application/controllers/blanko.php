<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Blanko extends MY_Controller {


	function __construct()

	{
		parent::__construct();

	}
	function search() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            //$this->load->model('asesi_model');
            $view = $this->load->view('blanko/search', array(), TRUE);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));

        } else {
            block_access_method();
        }
    }
     function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            //$this->load->model('asesi_model');
            $view = $this->load->view('blanko/search', array(), TRUE);
            echo json_encode(array('msgType'=>'success', 'msgValue'=>$view, 'title'=>'Cetak Data Blanko', 'width'=>600, 'height'=>400));

        } else {
            block_access_method();
        }
    }
}