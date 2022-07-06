<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Maping_skema extends MY_Controller {

	function __construct(){
		parent::__construct();
			$this->load->model('maping_skema_model');
	}

	function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'maping_skema_model', 'controller' => 'maping_skema', 'options' => array('id' => 'maping_skema','pagination','rownumber')))->load_model()->set_grid();
            $view = $this->load->view('maping_skema/index', array('grid' => $grid), true);
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
            if(isset($_POST['id_jadwal']) && !empty($_POST['id_jadwal']))
            {
                $where['id_jadwal'] = $this->input->post('id_jadwal');
            }
            if(isset($_POST['id_skema']) && !empty($_POST['id_skema']))
            {
                 $where['id_skema'] = $this->input->post('id_skema');
            }
            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->maping_skema_model->count_by($where) : $this->maping_skema_model->count_all();
            $this->maping_skema_model->limit($row, $offset);
            $rows = $this->maping_skema_model->set_params($params)->with(array('jadual', 'skema'));
            $data['rows'] = $this->maping_skema_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else {
            block_access_method();
        }
    }

	function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //$jenis_asesmen = $this->input->post('jenis_asesmen');
            //var_dump($jenis_asesmen); die();
            $data = $this->maping_skema_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->maping_skema_model->check_unique($data)) {
                    if ($this->maping_skema_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->maping_skema_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $this->load->library('combogrid');
                $jadwal_grid = $this->combogrid->set_properties(array('model' => 'jadwal_asesmen_model', 'controller' => 'jadwal_asesmen', 'fields' => array('jadual', 'tanggal'), 'options' => array('id' => 'id_jadwal', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'jadual', 'panelWidth' => 500)))->load_model()->set_grid();
                $skema_grid = $this->combogrid->set_properties(array('model' => 'skema_model', 'controller' => 'skema', 'fields' => array('skema', 'jumlah_unit'), 'options' => array('id' => 'id_skema', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'skema', 'panelWidth' => 500)))->load_model()->set_grid();



            echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('maping_skema/add', array('jadwal_grid' => $jadwal_grid
                ,'skema_grid' => $skema_grid), TRUE)));
        }
    }

		function delete($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $roles = $this->maping_skema_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->maping_skema_model->delete(intval($id))) {
                    echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil dihapus'));
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak berhasil dihapus !'));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        } else {
            block_access_method();
        }
    }
    function search() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('combogrid');
                $jadwal_grid = $this->combogrid->set_properties(array('model' => 'jadwal_asesmen_model', 'controller' => 'jadwal_asesmen', 'fields' => array('jadual', 'tanggal'), 'options' => array('id' => 'id_jadwal', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'jadual', 'panelWidth' => 500)))->load_model()->set_grid();
                 $skema_grid = $this->combogrid->set_properties(array('model' => 'skema_model', 'controller' => 'skema', 'fields' => array('skema', 'jumlah_unit'), 'options' => array('id' => 'id_skema', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'skema', 'panelWidth' => 500)))->load_model()->set_grid();
            $view = $this->load->view('maping_skema/search', array('jadwal_grid' => $jadwal_grid
                ,'skema_grid' => $skema_grid), TRUE);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));

        } else {
            block_access_method();
        }
    }

}
