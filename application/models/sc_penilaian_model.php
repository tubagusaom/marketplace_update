<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Sc_penilaian_model extends MY_Model {

    protected $_table = 't_schedule';
    protected $table_label = 'Data Schedule';
    protected $_columns = array(
        'siswa_id' => array(
            'label' => 'Student Name',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'nama',
            'save_formatter' => 'string',
            'width' => 120
        ),
        'instruktur_id' => array(
            'label' => 'Instructors',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'instruktur_name',
            'save_formatter' => 'string',
            'width' => 120
        ),
        'schedule_date' => array(
            'label' => 'Date',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'general_date',
            'save_formatter' => 'date',
            'width' => 120
        ),
        'plane_id' => array(
            'label' => 'Plane/Simulator',
            'rule' => 'trim|xss_clean',
            'formatter' => 'plane_name',
            'save_formatter' => 'string',
            'width' => 100
        ),
        'from_airport' => array(
            'label' => 'Departure',
            'rule' => 'trim|xss_clean',
            'formatter' => 'nama_airport',
            'save_formatter' => 'string',
            'width' => 120
        ),
        'to_airport' => array(
            'label' => 'Destination',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 120
        ),
        'from_time' => array(
            'label' => 'Start Period',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 90
        ),
        'to_time' => array(
            'label' => 'End Period',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 90
        ),
        'subject_category' => array(
            'label' => 'End Period',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 90
        ),
        'revision' => array(
            'label' => 'Revise',
            'rule' => 'trim|required|xss_clean',
            'formatter' => array("New","Revise 1","Revisi 2","Revisi 3"),
            'save_formatter' => 'string',
            'width' => 90
        )
    );
    protected $_order = array("id" => "ASC");

     	protected $belongs_to = array(
            'nama' =>  array(
              'model' => 'siswa_model',
              'primary_key' => 'siswa_id',
              'retrieve_columns' => array('nama')
            ),
            'instruktur_name' =>  array(
              'model' => 'instruktur_model',
              'primary_key' => 'instruktur_id',
              'retrieve_columns' => array('instruktur_name')
            ),
            'plane_name' =>  array(
              'model' => 'plane_model',
              'primary_key' => 'plane_id',
              'retrieve_columns' => array('plane_name')
            ),
            'nama_airport' =>  array(
              'model' => 'airport_model',
              'primary_key' => 'from_airport',
              'retrieve_columns' => array('nama_airport')
            )
      );
    protected $_unique = array('unique' => array('id','schedule_date'), 'group' => true);

    function __construct() {
        parent::__construct();
    }
	function data_asesi($id_asesi,$id_asesi2,$id_tuk,$pra_asesmen_checked){
		$jenis_user = $this->auth->get_user_data()->jenis_user;
        if($jenis_user == 3){
			$this->db->where('id_tuk',$this->auth->get_user_data()->pegawai_id);
		}else{
			$this->db->where('id_tuk',$id_tuk);
		}
		$this->db->select('id,nama_lengkap,email,telp,id_users');
		$this->db->where('id >=',$id_asesi);
		$this->db->where('id <=',$id_asesi2);
		$this->db->where('pra_asesmen_checked !=',"");
        
		$query = $this->db->get(kode_tbl().'asesi');
		return $query->result();
	}

}