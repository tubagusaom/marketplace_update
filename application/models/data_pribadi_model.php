<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Data_pribadi_model extends MY_Model {
     public function __construct() {
        $this->_table = kode_tbl()."users"; 
        parent::__construct($this->_table);
    }
    protected $_table;
   
    protected $table_label = 'Data asesor';
    protected $_columns = array(
        'no_reg' => array(
            'label' => 'NIS',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 80
        ),
        'users' => array(
            'label' => 'Nama',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'tahun_menjadi_asesor' => array(
            'label' => 'Lisence Number',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 100
        ),
        'sex' => array(
            'label' => 'Gender',
            'rule' => 'trim|xss_clean',
            'formatter' => array('','Laki-Laki','Perempuan'),
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => true
        ),
        'tempat_lahir' => array(
            'label' => 'Tempat Lahir',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => true
        ),
        'tgl_lahir' => array(
            'label' => 'Tanggal Lahir',
            'rule' => 'trim|xss_clean',
            'formatter' => 'general_date',
            'save_formatter' => 'date',
            'width' => 150
        ),
        'alamat' => array(
            'label' => 'Alamat',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => true
        ),
        'email' => array(
            'label' => 'Email',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'hp' => array(
            'label' => 'Telepon',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150
        ),
        'identity_number' => array(
            'label' => 'Nama Orang Tua',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => true
        ),
        'identity_type' => array(
            'label' => 'Pekerjaan Orang Tua',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => true
        ),
        'pos_code' => array(
            'label' => 'Pekerjaan Orang Tua',
            'rule' => 'trim|xss_clean',
            'formatter' => 'linkview',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => true
           
        ),
        'nationality' => array(
            'label' => 'Pekerjaan Orang Tua',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => true
        ),
        'province' => array(
            'label' => 'Pekerjaan Orang Tua',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => true
        ),
        'district' => array(
            'label' => 'Pekerjaan Orang Tua',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => true
        ),
        'sub_district' => array(
            'label' => 'Pekerjaan Orang Tua',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => true
        ),
        'village' => array(
            'label' => 'Pekerjaan Orang Tua',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => true
        ),
        'rt' => array(
            'label' => 'Pekerjaan Orang Tua',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => true
        ),
        'rw' => array(
            'label' => 'Pekerjaan Orang Tua',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => true
        ),
        'deskripsi_bidang_asesor' => array(
            'label' => 'Pekerjaan Orang Tua',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
            'hidden' => true
        ),
        'foto_user' => array(
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

    function profil_asesor($id){
        $this->db->where('id',$id);
        $query = $this->db->get(kode_tbl().'users')->row();
        return $query;
    }

}
