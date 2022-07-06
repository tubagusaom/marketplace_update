<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class V_report_student_model extends MY_Model {

    protected $_table = 'v_report_student';
    protected $table_label = 'Report Log Book Student';
    protected $_columns = array(
        'batch_name' => array(
            'label' => 'Batch',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 90,
            'align' => 'center'
        ),
        'nama' => array(
            'label' => 'Student Name',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 210
        ),
        'siswa_id' => array(
            'label' => 'Student Name',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 210,
            'hidden' => 'true'
        ),
        'nis' => array(
            'label' => 'NIS',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 90
        ),
        'abr' => array(
            'label' => 'Program',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 90
        ),
        'dual_flight' => array(
            'label' => 'DUAL',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 100,
            'align' => 'center'
        ),
        'solo_flight' => array(
            'label' => 'SOLO',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 100,
            'align' => 'center'
        ),
        'simulator' => array(
            'label' => 'Simulator',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 100,
            'align' => 'center'
        ),
        'remain_flight' => array(
            'label' => 'Remain Flight',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 100,
            'align' => 'center'
        ),
        'remain_simulator' => array(
            'label' => 'Remain Simulator',
            'rule' => 'trim|required|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 100,
            'align' => 'center'
        )
    );
    protected $_order = "batch_name";
    protected $_unique = array('unique' => array('id'), 'group' => false);

    function __construct() {
        parent::__construct();
    }
    function report_all(){
        $query = $this->db->query("SELECT c.batch_name,b.nama,d.abr,b.nis,a.siswa_id,b.batch_id,b.id,
sec_to_time(sum(IF(a.category_evaluation = 1,time_to_sec(a.time_lesson),0))) dual_flight,
sec_to_time(sum(IF(a.category_evaluation = 2,time_to_sec(a.time_lesson),0))) solo_flight,
sec_to_time(sum(IF(a.category_evaluation = 3,time_to_sec(a.time_lesson),0))) simulator,
TIMEDIFF((SELECT total_flight 
FROM t_siswa 
JOIN t_program  ON t_program.id=t_siswa.program_id
WHERE t_siswa.id=b.id),sec_to_time(sum(IF(a.category_evaluation IN(1,2),time_to_sec(a.time_lesson),0)))) as remain_flight,
TIMEDIFF((SELECT total_simulator 
FROM t_siswa 
JOIN t_program  ON t_program.id=t_siswa.program_id
WHERE t_siswa.id=b.id),sec_to_time(sum(IF(a.category_evaluation = 3,time_to_sec(a.time_lesson),0)))) as remain_simulator

FROM t_evaluation a
JOIN t_siswa b ON b.id=a.siswa_id
JOIN t_program d ON d.id=b.program_id
JOIN t_angkatan c ON c.id=b.batch_id
GROUP BY a.siswa_id ");
        return $query->result();
    }
}
