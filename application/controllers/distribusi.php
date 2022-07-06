<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Distribusi extends MY_Controller {
function __construct() {
        parent::__construct();
        $this->load->model('distribusi_model');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'distribusi_model', 'controller' => 'distribusi', 'options' => array('id' => 'distribusi', 'pagination', 'rownumber')))->load_model()->set_grid();
            $view = $this->load->view('distribusi/index', array('grid' => $grid), true);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        } else {
            block_access_method();
        }
    }

    function datagrid() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
            $page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
            $offset = $row * ($page - 1);
            $data = array();
            $params = array('_return' => 'data');
            $jenis_user = $this->auth->get_user_data()->jenis_user;
            if($jenis_user == 3){
                $asesi_id = $this->auth->get_user_data()->id;
                $where['id ='] = $asesi_id;
            }else if($jenis_user == 2){
                $asesi_id = $this->auth->get_user_data()->pegawai_id;
                $where['id_asesor ='] = $asesi_id;
            }else if($jenis_user == 1){
                $asesi_id = $this->auth->get_user_data()->id;
                $where[kode_tbl().'asesi.id_users ='] = $asesi_id;
            }
            $where['no_seri !='] = '';

            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->distribusi_model->count_by($where) : $this->distribusi_model->count_all();
            $this->distribusi_model->limit($row, $offset);
            $order = $this->distribusi_model->get_params('_order');
            $rows = $this->distribusi_model->set_params($params)->with(array('skema','user','jadwal_asesmen','tuk','asesor'));
            $data['rows'] = $this->distribusi_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        } else {
            block_access_method();
        }
    }

    function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->distribusi_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->distribusi_model->check_unique($data, intval($id))) {
                	$tertuju = $this->input->post('tertuju');
                	if($tertuju != ""){
                		$data['complete_pengiriman'] = '1';
                	}
                   if ($this->distribusi_model->update(intval($id), $data) !== false) {

                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->distribusi_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $asesi = $this->distribusi_model->get(intval($id));
            if (sizeof($asesi) == 1) {

                //var_dump($mak04);die();
                $view = $this->load->view('distribusi/edit', array('data' => $this->distribusi_model->get_single($asesi)

                ), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
    }

}
