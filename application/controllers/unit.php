<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Unit extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('unit_model');
        $this->load->model('vunit_model');
        
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'unit_model', 'controller' => 'unit', 'options' => array('id' => 'unit', 'pagination', 'rownumber')))->load_model()->set_grid();
            $view = $this->load->view('unit/index', array('grid' => $grid), true);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        } else {
            block_access_method();
        }
    }

    function datagrid() 
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
            $page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
            $offset = $row * ($page - 1);
            
            $data = array();
            $params = array('_return' => 'data');
            if(isset($_POST['id_unit_kompetensi']) && !empty($_POST['id_unit_kompetensi']))
            {
                $where['id_unit_kompetensi like'] = '%' . $this->input->post('id_unit_kompetensi') . '%';
            }
            if(isset($_POST['unit_kompetensi']) && !empty($_POST['unit_kompetensi']))
            {
                $where['unit_kompetensi like'] = '%' . $this->input->post('unit_kompetensi') . '%';
            }
            if(isset($_POST['id_skema']) && !empty($_POST['id_skema']))
            {
                $where['id_skema'] = $this->input->post('id_skema');
            }
            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->unit_model->count_by($where) : $this->unit_model->count_all();
            $this->unit_model->limit($row, $offset);
            $order = $this->unit_model->get_params('_order');
            $rows = $this->unit_model->set_params($params)->with(array());
            //$rows = isset($where) ? $this->unit_model->order_by($order)->get_many_by($where) : $this->unit_model->order_by($order)->get_all();
            $data['rows'] = $this->unit_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else
        {
            block_access_method();
        }
    }

    function add() {
       if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->unit_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->unit_model->check_unique($data)) {
                    if ($this->unit_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->unit_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $this->load->model('skema_model');
            $skema = $this->skema_model->dropdown('id', 'skema');

            $view = $this->load->view('unit/add', array('skema' => $skema), TRUE);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        }
    }

    function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->unit_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->unit_model->check_unique($data, intval($id))) {
                    if ($this->unit_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->unit_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $con_method = $this->unit_model->get(intval($id));
            if (sizeof($con_method) == 1) {
                $this->load->model('skema_model');
                $skema = $this->skema_model->dropdown('id', 'skema');

                $data = $this->unit_model->get_single($con_method);
                $view = $this->load->view('unit/edit', array('skema' => $skema, 'data' => $data), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
    }

    function delete($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->db->where('id',$id);
            $skema_detail = $this->db->get(kode_tbl().'skema_detail')->row();
            
            $this->db->where('id',$skema_detail->id_unit_kompetensi);
            $this->db->delete(kode_tbl().'unit_kompetensi');
            echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil dihapus'));

        } else {
            block_access_method();
        }
    }
    function search() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->model('skema_model');
            $skema = $this->skema_model->dropdown('id', 'skema');
            //$skema = array_unshift($skema, array(""=>"Pilih"));
            $skema['']="-Pilih-";
            $view = $this->load->view('unit/search', array('skema'=>$skema), TRUE);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));

        } else {
            block_access_method();
        }
    }
    function combogrid($id = false)
    {
        $this->load->model('unit_model');
        $row = intval($this->input->post('rows')) == 0 ? 200 : intval($this->input->post('rows')) ;
        $page = intval($this->input->post('page'))== 0 ? 1 : intval($this->input->post('page'));
        $offset = $row * ($page - 1);
        $data = array();
        $params = array('_return'=>'data');
        if(isset($_POST['q']))
        {
            $where['unit_kompetensi LIKE'] = "%" . $this->input->post('q') . "%";
        }
        if(isset($where)) $params['_where'] = $where;
        $data['total'] = isset($where) ? $this->unit_model->count_by($where) : $this->unit_model->count_all();
        $this->unit_model->limit($row, $offset);
        $order_criteria = "ASC";
        $_order_escape = TRUE;
        if($id)
        {
            $order = "FIELD(id, " . intval($id) . ")";
            $order_criteria = "DESC";
            $_order_escape = FALSE;
        }
        else
        {
            $order = $this->unit_model->get_params('_order');
        }       
        $rows = isset($where) ? $this->unit_model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->unit_model->order_by($order, $order_criteria, $_order_escape)->get_all();
        $data['rows'] = $this->unit_model->get_selected()->data_formatter($rows);
        //var_dump($data);
        echo json_encode($data);
    }
}