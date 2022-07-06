<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Acc_group_akun extends MY_Controller {


	function __construct()

	{
		parent::__construct();
        //$this->config->set_item('global_xss_filtering', FALSE);

        $this->load->model('Akuntansi_Model');

	}
	
	 function index() 
    {
        $this->load->library('grid');
        //$grid['foto'] = $this->Artikel_Model->galeri();
        $grid = $this->grid->set_properties(array('model' => 'Akuntansi_Model', 'controller' => 'Acc_group_akun', 'options' => array('id' => 'Acc_group_akun', 'pagination', 'rownumber')))->load_model()->set_grid();
        $view = $this->load->view('akuntansi/index', array('grid' => $grid), true);
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
            $data['total'] = isset($where) ? $this->Akuntansi_Model->count_by($where) : $this->Akuntansi_Model->count_all();
            $this->Akuntansi_Model->limit($row, $offset);
            $order = $this->Akuntansi_Model->get_params('_order');
            $rows = $this->Akuntansi_Model->set_params($params)->with(array('kode_group ASC'));
            //$rows = isset($where) ? $this->Akuntansi_Model->order_by($order)->get_many_by($where) : $this->Akuntansi_Model->order_by($order)->get_all();
            $data['rows'] = $this->Akuntansi_Model->get_selected()->data_formatter($rows);
            echo json_encode($data);
        }
        else
        {
            block_access_method();
        }
    }

    function add(){

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            echo json_encode(array('msgType' => 'error', 'msgValue' => "Tidak dapat menambah Group baru."));
          
        } else {
            $this->load->model('Artikel_Kategori_Model');
            $kategori = $this->Artikel_Kategori_Model->dropdown('id', 'kategori');

            $view = $this->load->view('akuntansi/add', array('kategori' => $kategori,'url' => base_url() . 'artikel/upload'), TRUE);
            echo json_encode(array('msgType' => 'success', 'msgValue' => $view));
        }
    }
    
}