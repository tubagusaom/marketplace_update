<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kurikulum_detail extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('kurikulum_detail_model');
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->library('grid');
            $grid = $this->grid->set_properties(array('model' => 'kurikulum_detail_model','fields' => array('nama_kurikulum', 'hours','subject_name'), 'controller' => 'kurikulum_detail', 'options' => array('id' => 'kurikulum_detail', 'pagination', 'rownumber')))->load_model()->set_grid();
            $view = $this->load->view('kurikulum_detail/index', array('grid' => $grid), true);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        } else {
            block_access_method();
        }
    }

    function datagrid($id = false) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($id !== false) {
                $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
                $page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
                $offset = $row * ($page - 1);
                $data = array();
                $where['subject_id'] = intval($id);
                $params = array('_return' => 'data');
                if (isset($where))
                    $params['_where'] = $where;
                $data['total'] = isset($where) ? $this->kurikulum_detail_model->count_by($where) : $this->kurikulum_detail_model->count_all();
                $this->kurikulum_detail_model->limit($row, $offset);
                $rows = $this->kurikulum_detail_model->set_params($params)->with(array('nama_kurikulum','subject_name'));
                $data['rows'] = $this->kurikulum_detail_model->fields_selected(array('nama_kurikulum', 'hours','subject_name'))->data_formatter($rows);
                echo json_encode($data);
            }
            else {
                echo json_encode(array('total' => 0, 'rows' => array()));
            }
        } else {
            block_access_method();
        }
    }

    function add($id = false) {
       // $this->load->model('kurikulum_model');
        if (!$id) {
            echo json_encode(array('msgType' => 'error', 'msgValue' => 'Anda belum memilih data Kurikulum !'));
            exit;
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST['subject_id'] = intval($id);
                $data = $this->kurikulum_detail_model->set_validation()->validate();
                //var_dump($data);
                //die();
                if ($data !== false) {
                    if ($this->kurikulum_detail_model->check_unique($data)) {
                        if ($this->kurikulum_detail_model->insert($data) !== false) {
                            echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                        } else {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                        }
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->kurikulum_detail_model->get_validation())));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
                }
            } else {
               //echo json_encode(array('msgType' => 'success', 'msgValue' => $this->load->view('siswa/add', array('angkatan' => $angkatan,'url'=>base_url() . 'siswa/upload'), TRUE)));

                $this->load->model('kurikulum_model');
                $this->load->model('subjek_model');
                $kurikulum_dropdown = $this->kurikulum_model->dropdown('id', 'nama_kurikulum');

                $subjek= $this->subjek_model->get_single($this->subjek_model->get($id));
                //var_dump($kurikulum);die();
                $view = $this->load->view('kurikulum_detail/add', array('kurikulum_dropdown'=>$kurikulum_dropdown,'subject_name'=>$subjek->subject_name), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            }
        }
    }

    function edit($id = false) {

        if (!$id) {
            data_not_found();
            exit;
        } else {
            $this->load->model('kurikulum_model');

            $sub_subjek = $this->kurikulum_detail_model->get(intval($id));
            if (sizeof($sub_subjek) == 1) {

                $sub = $this->kurikulum_detail_model->get_single($sub_subjek);

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $_POST['kurikulum_id'] = $sub->kurikulum_id;

                    $data = $this->kurikulum_detail_model->set_validation()->validate();
                    if ($data !== false) {
                        if ($this->kurikulum_detail_model->check_unique($data, intval($id))) {
                            if ($this->kurikulum_detail_model->update(intval($id), $data) !== false) {
                                echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                            } else {
                                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                            }
                        } else {
                            echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->Menu_Model->get_validation())));
                        }
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
                    }
                } else {

                    $group = $this->kurikulum_model->get_single($this->kurikulum_model->get(intval($sub_subjek->kurikulum_id)));
                    $view = $this->load->view('sub_subjek/edit', array('data' => $sub_subjek, 'nama_kurikulum' => $group->nama_kurikulum), TRUE);
                    echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
    }

    function delete($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $acls = $this->kurikulum_detail_model->get(intval($id));
                if (sizeof($acls) == 1) {
                    if ($this->kurikulum_detail_model->delete(intval($id))) {
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
    }
}
