<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Acc_akun extends MY_Controller {


	function __construct()

	{
		parent::__construct();
        //$this->config->set_item('global_xss_filtering', FALSE);

        $this->load->model('Akuntansi_Coa_Model');

	}
	
	 function index() 
    {
        $this->load->library('grid');
        //$grid['foto'] = $this->Artikel_Model->galeri();
        $grid = $this->grid->set_properties(array('model' => 'Akuntansi_Coa_Model', 'controller' => 'Acc_akun', 'options' => array('id' => 'Acc_akun', 'pagination', 'rownumber')))->load_model()->set_grid();
        $view = $this->load->view('akuntansi/index_akun', array('grid' => $grid), true);
        echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
    }
    
    function search() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->load->model('Akuntansi_Coa_Model');
            $view = $this->load->view('akuntansi/search', array(), TRUE);
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
            
            if (isset($_POST['kode_akun']) && !empty($_POST['kode_akun'])) {
                $where['kode_akun like'] = '%' . $this->input->post('kode_akun') . '%';
            }
            if (isset($_POST['nama_akun']) && !empty($_POST['nama_akun'])) {
                $where['nama_akun like'] = '%' . $this->input->post('nama_akun') . '%';
            }
            
            $data = array();
            $params = array('_return' => 'data');
            if (isset($where))
                $params['_where'] = $where;
            $data['total'] = isset($where) ? $this->Akuntansi_Coa_Model->count_by($where) : $this->Akuntansi_Coa_Model->count_all();
            $this->Akuntansi_Coa_Model->limit($row, $offset);
            $order = $this->Akuntansi_Coa_Model->get_params('_order');
            $rows = $this->Akuntansi_Coa_Model->set_params($params)->with(array());
            $spasi = array('','','-','--','---','----');
           /*  foreach ($rows as $key => $value) {
                foreach ($value as $keys=>$values) {
                    if($keys == 'nama_akun'){
                        $panjangakun = strlen($value->kode_akun);
                        $rows_baru[$key]->nama_akun = $spasi[$panjangakun].' '.$value->nama_akun;
                    }
                    else{
                        $rows_baru[$key]->$keys = $value->$keys;
                    }
                    
                }
            }    
 */
            $data['rows'] = $this->Akuntansi_Coa_Model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else
        {
            block_access_method();
        }
    }

    function add(){

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->Akuntansi_Coa_Model->set_validation()->validate();
            if ($data !== false) {
                if ($this->Akuntansi_Coa_Model->check_unique($data)) {
                    if ($this->Akuntansi_Coa_Model->insert($data) !== false) {
                        echo json_encode(array('msgType' => 'success', 'msgValue' => 'Data berhasil disimpan !'));
                    } else {
                        echo json_encode(array('msgType' => 'error', 'msgValue' => 'Data tidak dapat disimpan !'));
                    }
                } else {
                    echo json_encode(array('msgType' => 'error', 'msgValue' => implode("<br/>", $this->Akuntansi_Coa_Model->get_validation())));
                }
            } else {
                echo json_encode(array('msgType' => 'error', 'msgValue' => validation_errors()));
            }
          
        } else {
            $this->load->model('Artikel_Kategori_Model');
            $kategori = $this->Artikel_Kategori_Model->dropdown('id', 'kategori');

            $view = $this->load->view('akuntansi/add_akun', array('kategori' => $kategori,'url' => base_url() . 'artikel/upload'), TRUE);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        }
    }
    function combogrid($id = false)
    {
        $this->load->model('Akuntansi_Coa_Model');
        $row = intval($this->input->post('rows')) == 0 ? 20 : intval($this->input->post('rows')) ;
        $page = intval($this->input->post('page'))== 0 ? 1 : intval($this->input->post('page'));
        $offset = $row * ($page - 1);
        $data = array();
        $params = array('_return'=>'data');

        $where['level'] = "4";
        
        if(isset($_POST['q']))
        {
            $where['nama_akun LIKE'] = "%" . $this->input->post('q') . "%";
        }
        if(isset($where)) $params['_where'] = $where;
        $data['total'] = isset($where) ? $this->Akuntansi_Coa_Model->count_by($where) : $this->Akuntansi_Coa_Model->count_all();
        $this->Akuntansi_Coa_Model->limit($row, $offset);
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
            $order = $this->Akuntansi_Coa_Model->get_params('_order');
        }       
        $rows = isset($where) ? $this->Akuntansi_Coa_Model->order_by($order, $order_criteria, $_order_escape)->get_many_by($where) : $this->Akuntansi_Coa_Model->order_by($order, $order_criteria, $_order_escape)->get_all();
        $data['rows'] = $this->Akuntansi_Coa_Model->get_selected()->data_formatter($rows);
        //var_dump($data);
        echo json_encode($data);
    }   
    function delete($id = false) {
        if (!$id) {
            data_not_found();
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $roles = $this->Akuntansi_Coa_Model->get(intval($id));
            if (sizeof($roles) == 1) {
                if ($this->Akuntansi_Coa_Model->delete(intval($id))) {
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