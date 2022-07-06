<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Api extends MY_Controller {


	function __construct()

	{
		parent::__construct();
    }
    function index(){
        echo json_encode("OK");
    }
    function schedule_all(){
        header('Access-Control-Allow-Origin:*');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
        header('Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding');
    
        $this->db->get('t_schedule');
        echo json_encode($this->db->get('v_schedule')->result());
    }
}