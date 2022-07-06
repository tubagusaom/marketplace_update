<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Skema_Unit extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('skema_unit_model');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'skema_unit_model', 'controller' => 'skema_unit', 'options' => array('id' => 'skema_unit', 'pagination', 'rows_number')))->load_model()->set_grid();
            $view = $this->load->view('skema_unit/index', array('grid' => $grid), true);
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
            if (isset($_POST['id_unit_kompetensi']) && !empty($_POST['id_unit_kompetensi'])) {
                $where['id_unit_kompetensi like'] = '%' . $this->input->post('id_unit_kompetensi') . '%';
            }
            if (isset($_POST['unit_kompetensi']) && !empty($_POST['unit_kompetensi'])) {
                $where['unit_kompetensi like'] = '%' . $this->input->post('unit_kompetensi') . '%';
            }
            if (isset($_POST['id_skema']) && !empty($_POST['id_skema'])) {
                $where['id_skema'] = $this->input->post('id_skema');
            }
            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->skema_unit_model->count_by($where) : $this->skema_unit_model->count_all();
            $this->skema_unit_model->limit($row, $offset);
            $order = $this->skema_unit_model->get_params('_order');
            $rows = $this->skema_unit_model->set_params($params)->with(array('skema', 'unit'));
            $data['rows'] = $this->skema_unit_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else {
            block_access_method();
        }
    }

    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->skema_unit_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->skema_unit_model->check_unique($data)) {
                    if ($this->skema_unit_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->skema_unit_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {

            $this->load->model('skema_model');
            $skema = $this->skema_model->dropdown('id', 'skema');
            $this->load->library('combogrid');
            $unit = $this->combogrid->set_properties(array('model' => 'unit_model', 'controller' => 'unit', 'fields' => array('id_unit_kompetensi', 'unit_kompetensi', 'kode_translate', 'unit_translate'), 'options' => array('id' => 'id_unit_kompetensi', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'unit_kompetensi', 'panelWidth' => 800,
                            'queryParams' => array('name' => 'easui')
                )))->load_model()->set_grid();


            $view = $this->load->view('skema_unit/add', array('skema' => $skema, 'unit_kompetensi' => $unit), TRUE);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        }
    }

    function edit($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->skema_unit_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->skema_unit_model->check_unique($data, intval($id))) {
                    if ($this->skema_unit_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->skema_unit_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $value = $this->skema_unit_model->get(intval($id));
            $this->load->model('skema_model');
            $skema = $this->skema_model->dropdown('id', 'skema');
            $this->load->library('combogrid');
            $unit = $this->combogrid->set_properties(array('model' => 'unit_model', 'controller' => 'unit', 'fields' => array('id_unit_kompetensi', 'unit_kompetensi', 'kode_translate', 'unit_translate'), 'options' => array('id' => 'id_unit_kompetensi', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'unit_kompetensi', 'panelWidth' => 800,
                            'queryParams' => array('name' => 'easui')
                )))->load_model()->set_grid();

            if (sizeof($value) == 1) {
                $view = $this->load->view('skema_unit/edit', array('skema' => $skema, 'unit_kompetensi' => $unit, 'data' => $this->skema_unit_model->get_single($value)), TRUE);
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
            $roles = $this->skema_unit_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->skema_unit_model->delete(intval($id))) {
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
            $this->load->model('skema_model');
            $skema = $this->skema_model->dropdown('id', 'skema');
            //$skema = array_unshift($skema, array(""=>"Pilih"));
            $skema[''] = "-Pilih-";
            $view = $this->load->view('skema_unit/search', array('skema' => $skema), TRUE);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        } else {
            block_access_method();
        }
    }

    function view($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        $con_method = $this->skema_unit_model->get(intval($id));
        if (sizeof($con_method) == 1) {
            $this->db->where('id_unit_kompetensi', $con_method->id_unit_kompetensi);
            $data_elemen = $this->db->get(kode_tbl() . 'elemen_kompetensi')->result_array();

            $view = $this->load->view('skema_unit/view', array(
                'elemen' => $data_elemen,
                //'angkatan' => $angkatan,
                'data' => $data,
                    //'url' => base_url() . 'siswa/edit_upload/' . $id
                    ), TRUE);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        } else {
            echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
        }
    }

    function posting() {
        $data = $this->input->post('data');
        //var_dump($data[0 * 7 ]['value']);die();
        $jumlah_data = count($data);
        if ($jumlah_data > 0) {
            for ($i = 0; $i < $jumlah_data; $i++) {
                // if(int()$data[$i]['name']){
                // }
                if ($i % 7 == 0) {
                    $data_array[] = $data[$i]['name'];
                    //var_dump($data[$i]['name']);
                }
            }
            foreach ($data_array as $key => $value) {
                $query_array = array(
                    'elemen_kompetensi' => $data[$key * 7]['value'],
                    'bukti_dpl' => $data[$key * 7 + 1]['value'],
                    'perangkat_bukti_tambahan' => $data[$key * 7 + 2]['value'],
                    'no_kuk' => $data[$key * 7 + 3]['value'],
                    'dimensi_kompetensi' => $data[$key * 7 + 4]['value'],
                    'pertanyaan' => $data[$key * 7 + 5]['value'],
                    'jawaban' => $data[$key * 7 + 6]['value'],
                );
                $this->db->where('id', $value);
                $this->db->update(kode_tbl() . 'elemen_kompetensi', $query_array);
            }
        }
    }

    function remove() {
        $data = $this->input->post('data');
        foreach ($data as $key => $value) {
            if ($value['name'] == 'ch_elemen') {
                $this->db->where('id',$value['value']);
                $this->db->delete(kode_tbl().'elemen_kompetensi');
            }
        }
    }

}
