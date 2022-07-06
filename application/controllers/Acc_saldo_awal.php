<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 
class Acc_saldo_awal extends MY_Controller {


        
    function __construct()

    {
        parent::__construct();
        //$this->config->set_item('global_xss_filtering', FALSE);

        $this->load->model('Akuntansi_saldoawal_model');
        $this->load->model('Vakuntansi_saldoawal_model');

    }
    
     function index() 
    {
        $this->load->library('grid');
        //$grid['foto'] = $this->Artikel_Model->galeri();
        $grid = $this->grid->set_properties(array('model' => 'Vakuntansi_saldoawal_model', 'controller' => 'Acc_saldo_awal', 'options' => array('id' => 'Acc_saldo_awal', 'pagination', 'rownumber')))->load_model()->set_grid();
        $view = $this->load->view('akuntansi/index_saldoawal', array('grid' => $grid), true);
        echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
    }
    
    function datagrid() 
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
            $page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
            $offset = $row * ($page - 1);
            
            if(isset($_POST['id_group']) && !empty($_POST['id_group']))
            {
                if($_POST['id_group']==0){
                    $where['id_group LIKE'] = '%%';
                }else{
                    $where['id_group ='] = $this->input->post('id_group');
                }
            }
            
            $data = array();
            $params = array('_return' => 'data');
            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->Vakuntansi_saldoawal_model->count_by($where) : $this->Vakuntansi_saldoawal_model->count_all();
            $this->Vakuntansi_saldoawal_model->limit($row, $offset);
            $order = $this->Vakuntansi_saldoawal_model->get_params('_order');
            $rows = $this->Vakuntansi_saldoawal_model->set_params($params)->with(array('akun'));
            $spasi = array('','','-','--','---','----');
            /* foreach ($rows as $key => $value) {
                foreach ($value as $keys=>$values) {
                    if($keys == 'nama_akun'){
                        $panjangakun = strlen($value->kode_akun);
                        $rows_baru[$key]->nama_akun = $spasi[$panjangakun].' '.$value->nama_akun;
                    }
                    else{
                        $rows_baru[$key]->$keys = $value->$keys;
                    }
                    
                }
            } */    

            $data['rows'] = $this->Vakuntansi_saldoawal_model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else
        {
            block_access_method();
        }
    }

    function add(){

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->Akuntansi_saldoawal_model->set_validation()->validate();
            if ($data !== false) {
                if ($this->Akuntansi_saldoawal_model->check_unique($data)) {
                    if ($this->Akuntansi_saldoawal_model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->Akuntansi_saldoawal_model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
          
        } else {
             $this->load->library('combogrid');
               $akun_grid = $this->combogrid->set_properties(array('model' => 'Akuntansi_Coa_Model', 'controller' => 'Acc_akun', 'fields' => array('kode_akun', 'nama_akun'), 'options' => array('id' => 'kode_akun', 'pagination', 'rownumber', 'idField' => 'kode_akun', 'textField' => 'nama_akun', 'panelWidth' => 500)))->load_model()->set_grid();
                

            $view = $this->load->view('akuntansi/add_saldowal', array('akun_grid' => $akun_grid), TRUE);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        }
    }

    function delete($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $roles = $this->Akuntansi_saldoawal_model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->Akuntansi_saldoawal_model->delete(intval($id))) {
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

     function combogrid($segmen = false, $id = false) {
        $this->load->model('Akuntansi_Coa_Model');
        $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows'));
        $page = intval($this->input->post('page')) == 0 ? 1 : intval($this->input->post('page'));
        $offset = $row * ($page - 1);
        $data = array();
        $params = array('_return' => 'data');

            //$where['kode_akun NOT LIKE'] = "%0000";

        if (isset($_POST['q'])) {
            $where['nama_akun LIKE'] = "%" . $this->input->post('q') . "%";
        }
        if ($segmen != false) {
            $where['id_users IS NULL AND id !='] = "";
        }

        if (isset($where))
            $params['_where'] = $where;
        $data['total'] = isset($where) ? $this->akuntansi_coa_model->count_by($where) : $this->akuntansi_coa_model->count_all();
        $this->akuntansi_coa_model->limit($row, $offset);
        $order_criteria = "ASC";
        $_order_escape = TRUE;
        if ($id) {
            $order = "FIELD(id, " . intval($id) . ")";
            $order_criteria = "DESC";
            $_order_escape = FALSE;
        } else {
            $order = $this->akuntansi_coa_model->get_params('_order');
        }
        $rows = isset($where) ? $this->akuntansi_coa_model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->akuntansi_coa_model->order_by($order, $order_criteria, $_order_escape)->get_all();
        $data['rows'] = $this->akuntansi_coa_model->get_selected()->data_formatter($rows);
        //var_dump($data);
        echo json_encode($data);
    }
    
}