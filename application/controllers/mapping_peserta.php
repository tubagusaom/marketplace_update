<?php


if (!defined('BASEPATH'))

    exit('No direct script access allowed');


class Mapping_peserta extends MY_Controller {


    function __construct() {


        parent::__construct();

        $this->load->model('mapping_peserta_model');

    }


    function index() {

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            $this->load->library('grid');

            $grid = $this->grid->set_properties(array('model' => 'mapping_peserta_model', 'controller' => 'mapping_peserta', 'options' => array('id' => 'mapping_peserta', 'pagination', 'rows_number')))->load_model()->set_grid();

            $view = $this->load->view('mapping_peserta/index', array('grid' => $grid), true);

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

            //$where['t_mapping_peserta.id !='] = "";
            if (isset($_POST['id_asesor']) && !empty($_POST['id_asesor'])) {
                $where['id_asesor'] = $this->input->post('id_asesor');
            }

            if (isset($_POST['id_mahasiswa']) && !empty($_POST['id_mahasiswa'])) {
                $where['id_mahasiswa'] = $this->input->post('id_mahasiswa');
            }

            if (isset($_POST['id_jadwal']) && !empty($_POST['id_jadwal'])) {
                $where['id_jadwal'] = $this->input->post('id_jadwal');
            }



            if (isset($where))
                $params['_where'] = $where;

            $data['total'] = isset($where) ? $this->mapping_peserta_model->count_by($where) : $this->mapping_peserta_model->count_all();

            $this->mapping_peserta_model->limit($row, $offset);

            $order = $this->mapping_peserta_model->get_params('_order');

            //$rows = isset($where) ? $this->mapping_peserta_model->order_by($order)->get_many_by($where) : $this->mapping_peserta_model->order_by($order)->get_all();

            $rows = $this->mapping_peserta_model->set_params($params)->with(array('mahasiswa', 'jadwal'));

            $data['rows'] = $this->mapping_peserta_model->get_selected()->data_formatter($rows);

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
            $data = $this->mapping_peserta_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->mapping_peserta_model->check_unique($data, intval($id))) {
                    $this->db->select('users');
                    $this->db->from(kode_tbl().'users');
                    $this->db->where('id', $data['id_asesor']);
                    $result = $this->db->get()->row()->users;

                    $data['nama_asesor'] = $result;

                    if ($this->mapping_peserta_model->update(intval($id), $data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->mapping_peserta_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
        } else {
            $mapping_peserta = $this->mapping_peserta_model->get(intval($id));
            if (sizeof($mapping_peserta) == 1) {
                $this->load->library('combogrid');
                $data_aplikasi = $this->db->get('r_konfigurasi_aplikasi')->row();

                $data = $this->mapping_peserta_model->get_single($mapping_peserta);

                $this->load->model('asesor_model');
                $asesor = $this->asesor_model->dropdown('id', 'users');

                $view = $this->load->view('mapping_peserta/edit', array('data_aplikasi' => $data_aplikasi, 'data' => $data, 'asesor' => $asesor), TRUE);
                echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat ditemukan !'));
            }
        }
    }

    function search() {

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
             $this->load->library('combogrid');

             $asesi_grid = $this->combogrid->set_properties(array('model' => 'mahasiswa_model', 'controller' => 'mahasiswa', 'fields' => array('nim_calon', 'nama_calon'), 'options' => array('id' => 'id_mahasiswa', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'nama_calon', 'panelWidth' => 500)))->load_model()->set_grid();
             $asesor_grid = $this->combogrid->set_properties(array('model' => 'asesor_model', 'controller' => 'asesor', 'fields' => array('users', 'no_reg'), 'options' => array('id' => 'id_asesor', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'users', 'panelWidth' => 500)))->load_model()->set_grid();
             $jadwal_grid = $this->combogrid->set_properties(array('model' => 'jadwal_asesmen_model', 'controller' => 'jadwal_asesmen', 'fields' => array('jadual', 'tanggal'), 'options' => array('id' => 'id_jadwal', 'pagination', 'rownumber', 'idField' => 'id', 'textField' => 'jadual', 'panelWidth' => 500)))->load_model()->set_grid();
             $view = $this->load->view('mapping_peserta/search', array('jadwal' => $jadwal_grid, 'asesor' => $asesor_grid, 'asesi' => $asesi_grid), TRUE);


            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));


        } else {

            block_access_method();

        }

    }

    function delete($id = false) {

        if (!$id) {

            data_not_found();

            exit;

        }


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $roles = $this->mapping_peserta_model->get(intval($id));

            if (sizeof($roles) == 1) {

                if ($this->mapping_peserta_model->delete(intval($id))) {

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
