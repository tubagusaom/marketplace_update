<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Bidang_model extends MY_Model {


    protected $_table = 't_bidang';
    protected $table_label = 'Data Bidang Asesor';
    protected $_columns = array(
         'id_asesor' => array(
            'label' => 'Nama Asesor',
            'rule' => 'trim|xss_clean',
            'formatter' => 'users',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'id_skema' => array(
            'label' => 'Skema Sertifikasi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'skema',
            'save_formatter' => 'string',
            'width' => 250,

        ),
        'sertifikat_teknis' => array(
            'label' => 'Sertifikat Teknis',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 100,

        ),
    );


    protected $_order = array("id" => "DESC","id_skema"=>"ASC");

    //protected $_unique = array('unique' => array('id'), 'group' => false);
     protected $belongs_to = array(
          'skema' =>  array(
          'model' => 'skema_model',
          'primary_key' => 'id_skema',
          'retrieve_columns' => array('skema'),
          'join_type' => 'left'
          ),
          'users' =>  array(
          'model' => 'asesor_model',
          'primary_key' => 'id_asesor',
          'retrieve_columns' => array('users','no_reg'),

          )
      );
}
