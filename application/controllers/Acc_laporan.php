<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acc_laporan extends MY_Controller {
        
    function __construct()

    {
        parent::__construct();

    }
     
     function index() 
    {
        $view = $this->load->view('akuntansi/index_laporan', array(), true);
        echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
    }
    
}