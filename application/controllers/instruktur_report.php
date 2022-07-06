<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


							class Instruktur_report extends MY_Controller {


								function __construct()

								{
									parent::__construct();

								}
                                function index() {  
        $query = $this->db->query("SELECT COUNT(id) as total,status FROM t_instruktur
        GROUP BY status");
        $query_jam_terbang = $this->db->query("
SELECT a.schedule_id,SEC_TO_TIME( SUM( TIME_TO_SEC( a.time_lesson ) ) ) AS total_hours
,c.instruktur_code,c.instruktur_name
FROM t_evaluation a
JOIN t_schedule b ON b.id=a.schedule_id
JOIN t_instruktur c ON c.id=b.instruktur_id
GROUP BY c.id
ORDER BY total_hours DESC");
        $data['query']=$query->result_array();
        $data['query_jam_terbang']=$query_jam_terbang->result_array();
        $view = $this->load->view('report/report_instruktur', $data, true);
	    echo json_encode(array('msgType'=>'success', 'msgValue'=>$view));
    }
							}