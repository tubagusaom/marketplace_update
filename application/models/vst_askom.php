<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vst_askom extends MY_Model
{
	protected $_table = 'vst_askom';

	protected $table_label = 'Surat Tugas Asesor Kompetensi';

	protected $_columns = array(
		'jadual'	=>	array(
			'label'	=> 	'Nama Jadwal',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string',
			'width' => 350
		),
		'tanggal'	=>	array(
			'label'	=> 	'Tanggal',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string',
			'width' => 100
		),
		'nama_asesor'	=>	array(
			'label'	=> 	'Asesor Kompetensi',
			'rule'	=>	'trim|required|xss_clean',
			'formatter'	=>	'string',
			'save_formatter' => 'string',
			'width' => 250
		)
	);

	protected $_order = array("id"=>"ASC");

	public function __construct()
	{
		parent::__construct();
	}
	function skema_sertifikasi($id){
		$this->db->select('b.skema');
		$this->db->from(kode_tbl().'mapping_skema a');
		$this->db->join(kode_tbl().'skema b','a.id_skema=b.id');
		$this->db->where('id_jadwal',$id);
		$rows = $this->db->get()->result();
		if(count($rows) > 0){
			foreach ($rows as $key => $value) {
				$array[] = $value->skema;
			}
			return implode(',',$array);
		}else{
			return '-';
		}
	}
	function unit_kompetensi($id_skema){

		$skema = kode_tbl().'skema';
        $skema_detail = kode_tbl().'skema_detail';
        $unit_kompetensi = kode_tbl().'unit_kompetensi';

        $this->db->select("a.*,c.id_unit_kompetensi,c.unit_kompetensi",false);
        $this->db->from("$skema a");
        $this->db->join("$skema_detail b","b.id_skema=a.id");
        $this->db->join("$unit_kompetensi c","c.id=b.id_unit_kompetensi");
        $this->db->where("a.skema",$id_skema);
        $d = $this->db->get()->result_array();
        return $d;
	}

}
