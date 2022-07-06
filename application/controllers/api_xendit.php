<?php

// namespace XenditClient;

if (!defined('BASEPATH')) exit('No direct script access allowed');



class Api_xendit extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('product_model');
        $this->load->model('welcome_model');
        // $this->load->Xendit('Xendit');

        // $this->load->library('calendar');
        // $this->load->library('vendor/xendits');
        $this->load->library('xendit');

    }

    function test(){

      // echo phpinfo();

      // $saldo    = $this->xendit->getBalance();
      // $bank_va  = $this->xendit->getVirtualAccountBanks();
      // $pc  = $this->xendit->payment_channels();

      // print_r($response);

      // var_dump($response[0]['is_activated']); die();
      // var_dump($pc); die();

      // $external_id = $argv[1];
      // $bank_code = $argv[2];
      // $name = $argv[3];

      // $argv = array('demo_1475459775872' , 'BNI' , 'Tera Byte' );

      // var_dump($argv[0]); die();

      $id = '61dba0151654fd7230461938';
      $external_id = 'tb-085737744383';
      $bank_code = 'PERMATA';
      $name = 'Homedepo';

      $virtual_account_number = '';
      // $virtual_account_number = '886088772670038';

      // $external_id = '';
      // $bank_code = '';
      // $name = '';

      // va BNI
      // 8808877203958287

      // va MANDIRI
      // 886088772792033

      // $params = [
      //   0 => "demo-1475804036622",
      //   1 => "MANDIRI",
      //   2 => "Tera Byte"
      // ];

      $get_bank = $this->xendit->getVirtualAccountBanks();

      // $va = $this->xendit->createCallbackVirtualAccount($external_id, $bank_code, $name);
      // $cva = $this->xendit->checkCallbackVirtualAccount($id,$external_id, $bank_code, $name, $virtual_account_number);

      // $cr_va = $this->xendit->createVirtualAccount($external_id, $bank_code, $name);

      var_dump($get_bank); die();

    }

    function testx() {

      define('SECRET_API_KEY', 'xnd_development_b6zpvplD066MyTLCadSn8pPJKJiVEntqTF2k3wQtawDBDW3Y6UfXHf7BCHBRod+rSiCwZ3jw==');
      $options['secret_api_key'] = constant('SECRET_API_KEY');

      // $xenditPHPClient = new XenditClient\XenditPHPClient($options);
      //
      // $response = $xenditPHPClient->getBalance();
      // print_r($response);
      $xenditPHPClient = $this->xendit($options);

      $response = $xenditPHPClient->getBalance();
      print_r($response);

      // echo "string";

    }

}
