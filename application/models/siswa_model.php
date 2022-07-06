<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Siswa_model extends MY_Model {

    protected $_table = 't_siswa';
    protected $table_label = 'Data Siswa';
    protected $_columns = array(
        'nis' => array(
            'label' => 'NIS',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 80
        ),
        'nama' => array(
            'label' => 'Nama',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'batch_id' => array(
            'label' => 'Batch',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'batch_name',
            'save_formatter' => 'string',
            'width' => 80
        ),
        'base' => array(
            'label' => 'Base',
            'rule' => 'trim|required|xss_clean',
            'formatter' => array('','BTO','CBN','BKS'),
            'save_formatter' => 'string',
            'width' => 80
        ),
        'program_id' => array(
            'label' => 'Program Study',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'program_study',
            'save_formatter' => 'string',
            'width' => 80
        ),
        'current_program' => array(
            'label' => 'Current',
            'rule' => 'trim|required|xss_clean',
            'formatter' => array('-','PPL Ground', 'CPL-IR Ground', 'PPL Flight', 'CPL Flight','IR','ME','CRM','Avsec','DG'),
            'save_formatter' => 'string',
            'width' => 100
        ),
        'spl' => array(
            'label' => 'Lisence Number',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 100
        ),
        'gender' => array(
            'label' => 'Gender',
            'rule' => 'trim|required|xss_clean',
            'formatter' => array('laki-laki','perempuan'),
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => true
        ),
        'agama' => array(
            'label' => 'Agama',
            'rule' => 'trim|required|xss_clean',
            'formatter' => array('Islam','Kristen','Katholik','Hindu','Budha','Khonghucu'),
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => true
        ),
        'tempat_lahir' => array(
            'label' => 'Tempat Lahir',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => true
        ),
        'tgl_lahir' => array(
            'label' => 'Tanggal Lahir',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'general_date',
            'save_formatter' => 'date',
            'width' => 150
        ),
        'alamat' => array(
            'label' => 'Alamat',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => true
        ),
        'email_siswa' => array(
            'label' => 'Email',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'telepon' => array(
            'label' => 'Telepon',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'orang_tua' => array(
            'label' => 'Nama Orang Tua',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => true
        ),
        'kerja_orang_tua' => array(
            'label' => 'Pekerjaan Orang Tua',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => true
        ),
        'telepon_orang_tua' => array(
            'label' => 'Pekerjaan Orang Tua',
            'rule' => 'trim|xss_clean',
            'formatter' => 'linkview',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => true
           
        ),
        'email_orang_tua' => array(
            'label' => 'Pekerjaan Orang Tua',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => true
        ),
        'foto' => array(
            'label' => 'Foto',
            'rule' => 'trim|xss_clean',
            'formatter' => 'url2images',
            'save_formatter' => 'string',
            'width' => 90,
            'align' => 'center'
        )
    );
    protected $_order = array("id" => "ASC");

     	protected $belongs_to = array(
            'batch_name' =>  array(
              'model' => 'angkatan_model',
              'primary_key' => 'batch_id',
              'retrieve_columns' => array('batch_name')
            ),
            'program_study' =>  array(
              'model' => 'program_model',
              'primary_key' => 'program_id',
              'retrieve_columns' => array('program_study')
            )
      );
     
	 
	function url2images($url)
	{
		if(!is_null($url) && !empty($url)) {
			return "<img width=80px height=80px src='" . base_url() . "assets/img/siswa/" . $url . "' class='img-circle' />";
		} else {
			return "<img width=80px height=80px src='" . base_url() . "assets/img/siswa/person_default.jpg' class='img-circle' />";
		}
	}
    function linkview($url)
	{
			return "<img src='" . base_url() . "assets/img/icons/check.png'"." onclick='alert(ok)' />";
		
	}
    
    protected $_unique = array('unique' => array('nis'), 'group' => false);

    function __construct() {
        parent::__construct();
    }

    function siswa_profil($id){
        $this->db->select('a.*,b.batch_name,c.program_study');
        $this->db->from('t_siswa a');
        $this->db->join('t_angkatan b','b.id=a.batch_id');
        $this->db->join('t_program c','c.id=a.program_id');
        $this->db->where('a.id',$id);
        $query = $this->db->get()->row();
        return $query;
    }
    
    function siswa_program($id){
        $this->db->select("a.program_id,b.program_study,d.subject_name,d.general");
        $this->db->from('t_siswa a');
        $this->db->join('t_program b','b.id=a.program_id');
        $this->db->join('t_program_detail c','c.program_id=b.id');
        $this->db->join('t_subject d','d.id=c.program_id');
        $query = $this->db->get()->result();
        return $query;
    }

    function siswa_schedule($id){
        $this->db->select("a.*");
        $this->db->from('t_schedule a');
//        $this->db->join('t_program b','b.id=a.program_id');
//        $this->db->join('t_program_detail c','c.program_id=b.id');
//        $this->db->join('t_subject d','d.id=c.program_id');
//        $this->db->join('t_schedule b','a.id=b.siswa_id');
        $query = $this->db->get()->result();
        return $query;
    }

}
