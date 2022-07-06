<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('product_model');
        $this->load->model('welcome_model');

    }

    function tambah() {
        $template_header = 'templates/seller/header';
        $template_body = 'templates/responsive/product/tambah';
        $template_bottom = 'templates/seller/bottom_seller';

        $menu = $this->welcome_model->menu();

        $this->load->view($template_header, array(
          'aplikasi' => $this->aplikasi,
          'query_pesan' => $this->query_pesan,
          'query_pesan_unread' => $this->query_pesan_unread,
          'rolename' => $this->auth->get_rolename(),
          'nama_user' => $this->auth->get_user_data()->nama,
        ));
        $this->load->view($template_body, array(
          'aplikasi' => $this->aplikasi,
          'unread_message' => $this->unread_message,
          'menus' => $this->menus,

          'jenis' => $menu,

          'rolename' => $this->auth->get_rolename(),
          'nama_user' => $this->auth->get_user_data()->nama,
          'id_user' => $this->auth->get_user_data()->id,
          'id_member' => $this->auth->get_user_data()->id_member
        ));
        $this->load->view($template_bottom, array('aplikasi' => $this->aplikasi));
    }

    function add(){

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data['id_member'] = $this->input->post('id_member');
        $data['id_menu_kategori'] = $this->input->post('id_menu_kategori');
        $data['id_kategori'] = $this->input->post('id_kategori');
        $data['id_sub_kategori'] = $this->input->post('id_sub_kategori');
        $data['nama_product'] = $this->input->post('nama_product');
        $data['kondisi_product'] = $this->input->post('kondisi_product');
        $data['ket_product'] = $this->input->post('ket_product');
        $data['link_product'] = $this->input->post('link_product');
        $data['harga_product'] = $this->input->post('harga_product');
        $data['berat_product'] = $this->input->post('berat_product');
        $data['jumlah_product'] = $this->input->post('jumlah_product');
        $data['min_pesan_product'] = $this->input->post('min_pesan_product');
        $data['tag_product'] = $this->input->post('tag_product');
        $data['created_by'] = $this->id;
        $data['updated_by'] = $this->id;
        date_default_timezone_set("Asia/jakarta");
        $data['created_when'] = date("Y-m-d H:i:s");
        $data['updated_when'] = date("Y-m-d H:i:s");

        $this->db->insert(kode_tbl().'product', $data);

        $data_product['id_product'] = $this->db->insert_id();
        $data_file = $this->input->post('file_upload');

        foreach ($data_file as $key => $namafiles) {
          $this->db->where('nama_file',$namafiles);
          $this->db->update('t_repositori', $data_product);
        }

        // var_dump(date("Y-m-d H:i:s")); die();
        redirect('product/data');
      }else {
        redirect(base_url());
      }

    }

    function tambah_product() {
        $template_header = 'templates/seller/header';
        $template_body = 'templates/responsive/product/tambah_banyak';
        $template_bottom = 'templates/seller/bottom_seller';

        $menu = $this->welcome_model->menu();

        $this->load->view($template_header, array(
          'aplikasi' => $this->aplikasi,
          'query_pesan' => $this->query_pesan,
          'query_pesan_unread' => $this->query_pesan_unread,
          'rolename' => $this->auth->get_rolename(),
          'nama_user' => $this->auth->get_user_data()->nama,
        ));
        $this->load->view($template_body, array(
          'aplikasi' => $this->aplikasi,
          'unread_message' => $this->unread_message,
          'menus' => $this->menus,

          'jenis' => $menu,

          'rolename' => $this->auth->get_rolename(),
          'nama_user' => $this->auth->get_user_data()->nama,
          'id_user' => $this->auth->get_user_data()->id,
          'id_member' => $this->auth->get_user_data()->id_member
        ));
        $this->load->view($template_bottom, array('aplikasi' => $this->aplikasi));
    }

    function add_product(){
      // var_dump('MAINTENANCE'); die();
      // echo "MAINTENANCE";

      // $skema_temp = kode_lsp().'product';

      // $config['upload_path'] = substr(__dir__,0, strpos( __dir__,"application")) . 'assets/files/excels';

      // var_dump($config['upload_path']); die();

      $id_member = $this->input->post('id_member');
      $product = kode_tbl().'product';

      if($_SERVER['REQUEST_METHOD'] == 'POST') {

          $this->load->helper('postinger');
          $this->load->library('upload');

          $file_s = $_FILES['file_1'];
          $nama = str_replace(array(" ", "'", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "-", "+", "=", ":", ";", "/", "?", "<", ">", "~", "`", "[", "]"), "", $file_s['name']);

          $array_ext = explode(".", $nama); // Split file name into an array using the dot
          $fileExt = end($array_ext);
          $nama = str_replace($fileExt, '',$nama);
          //var_dump($fileExt);die();
          $nama_filenya= str_replace('.', '', $nama) . '.' . $fileExt;
          $namafile = time().'_'.$id_member.'_'.$nama_filenya;
          // var_dump($namafile);die();
          // $fileupload = $this->upload_product_all('file_1', $namafile);



          // var_dump($config['upload_path']); die();
          // var_dump($fileupload); die();

      //     $config['allowed_types'] = 'xlsx|xls';
      //     $config['max_size'] = '1024';
      //
      //     // $this->load->library('upload', $config);
          $do_upload = $this->upload_product_all('file_1', $namafile);
      //
          if ( ! $do_upload )
          {
              echo json_encode(array('msgType'=>'error','msgValue'=>$this->upload->display_errors()));
          }
          else
          {
              $uploaded = $this->upload->data();

              $files = substr(__dir__,0, strpos( __dir__,"application")) . 'assets/files/excels/' . $uploaded['file_name'];

              // var_dump($files); die();

              $this->load->library('excel');
              $objReader = $this->load->library('PHPExcel/Reader/PHPExcel_Reader_Excel5', $files);
              $objReader = new PHPExcel_Reader_Excel5();
              $objReader->setReadDataOnly(true);
              $objPHPExcel = $objReader->load($files);
              $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
              // $this->db->query("TRUNCATE TABLE $skema_temp");

              for($x=2; $x <= sizeof($sheetData); $x++) {
                $data = array();
                $data['id_member'] = $id_member;
                // $data['id_menu_kategori'] = '10';
                // $data['id_kategori'] = '124';
                // $data['id_sub_kategori'] = '426';
                $data['is_product'] = '1';
                $data['kode_product'] = $sheetData[$x]['A'];
                $data['nama_product'] = $sheetData[$x]['B'];

                $data['id_menu_kategori'] = $sheetData[$x]['C'];
                $data['id_kategori'] = $sheetData[$x]['D'];
                $data['id_sub_kategori'] = $sheetData[$x]['E'];

                $data['ket_product'] = $sheetData[$x]['F'];
                $data['min_pesan_product'] = $sheetData[$x]['G'];
                $data['jumlah_product'] = $sheetData[$x]['H'];
                $data['harga_product'] = $sheetData[$x]['I'];
                $data['link_product'] = $sheetData[$x]['J'];
                $data['berat_product'] = $sheetData[$x]['K'];
                $data['foto_product'] = $sheetData[$x]['L'];
                $data['foto_product_1'] = $sheetData[$x]['M'];
                $data['foto_product_2'] = $sheetData[$x]['N'];
                $data['foto_product_3'] = $sheetData[$x]['O'];
                $this->db->insert($product,$data);
              }
              // echo json_encode(array('msgType'=>'success','msgValue'=>"Data sukses diimport"));
              redirect('product/data');

          }
      } else {
        block_access_method();
      }

    }

    public function upload_ajax($jenis,$id) {

        //error_reporting(E_ALL ^ E_DEPRECATED);
		    //ini_set('display_errors', '1');

        $this->load->helper('postinger');
        $this->load->library('upload');

        $files = $_FILES['file'];
        $nama = str_replace(array(" ", "'", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "-", "+", "=", ":", ";", "/", "?", "<", ">", "~", "`", "[", "]"), "", $files['name']);

        $array_ext = explode(".", $nama); // Split file name into an array using the dot
        $fileExt = end($array_ext);
        $nama = str_replace($fileExt, '',$nama);
        //var_dump($fileExt);die();
        $nama_filenya= str_replace('.', '', $nama) . '.' . $fileExt;
        $namafile = $jenis . "_" . time().'_'.$nama_filenya;
        //var_dump($namafile);die();
        $fileupload = $this->upload_product('file', $namafile);
        $var_dump=json_decode($fileupload);

        $file_size = round(($var_dump->upload_data->file_size / 1024), 2) . ' MB';
        $extension = str_replace('.', '', $var_dump->upload_data->file_ext);
        // $array_jenis_portofolio = array('npwp'=>'1','ktp'=>'2','nib'=>'3');

        $array_repositori = array(
            'id_users' => $id,
            'nama_dokumen' => $jenis,
            'nama_file' => $namafile,
            'jenis_dokumen' => 7,
            'file_size' => $file_size,
            'extension' => $extension,
        );
        $this->db->insert('t_repositori', $array_repositori);

        echo $fileupload;
    }

    function hapus_file(){
      $nama_file = $this->input->post('nama_file');
      $this->db->where('nama_file',$nama_file);

      if (!$this->db->delete('t_repositori')) {
        $error = array('error' => 'Gagal Menghapus');

        $result = json_encode($error);
      } else {

        $current_file = substr(__dir__, 0, strpos(__dir__, "application")) . 'assets/img/product/' . $nama_file;
        if (is_file($current_file)) {
            unlink($current_file);
        }

        $data = array('upload_data' => 'Berhasil Menghapus');

        $result = json_encode($data);
      }
    }

    function data(){
      $template_header = ('templates/seller/header');
      $template_body = 'templates/responsive/product/data';
      $template_bottom = 'templates/seller/bottom_seller';

      // $menu = $this->welcome_model->menu();
      $id_member = $this->auth->get_user_data()->id_member;
      $product = $this->product_model->get_product($id_member);

      // var_dump($product); die();

      $this->load->view($template_header, array(
        'aplikasi' => $this->aplikasi,
        'query_pesan' => $this->query_pesan,
        'query_pesan_unread' => $this->query_pesan_unread,
        'rolename' => $this->auth->get_rolename(),
      ));
      $this->load->view($template_body, array(
        'aplikasi' => $this->aplikasi,
        'unread_message' => $this->unread_message,
        'menus' => $this->menus,

        // 'jenis' => $menu,
        'data' => $product,

        'rolename' => $this->auth->get_rolename(),
        'nama_user' => $this->auth->get_user_data()->nama,
        'id_user' => $this->auth->get_user_data()->id,
        'id_member' => $id_member
      ));
      $this->load->view($template_bottom, array('aplikasi' => $this->aplikasi));
    }

    function get_kategori($id_menu)
    {
      // var_dump(); die($id_menu);

        $query = $this->db->get_where(kode_tbl().'kategori',array('id_menu'=>$id_menu));
        $data = "<option value=''>- Pilih Kategori -</option>";
        foreach ($query->result() as $value) {
            $data .= "<option value='".$value->id."'>".$value->kategori."</option>";
        }
        echo $data;

        // var_dump($data); die();
    }

    function get_subkategori($id_kategori)
    {
      // var_dump(); die($id_menu);

        $query = $this->db->get_where(kode_tbl().'sub_kategori',array('id_kategori'=>$id_kategori));
        $data = "<option value=''>- Pilih Sub Kategori -</option>";
        foreach ($query->result() as $value) {
            $data .= "<option value='".$value->id."'>".$value->sub_kategori."</option>";
        }
        echo $data;

        // var_dump($data); die();
    }

    function detail($id_product,$file_product){

      $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();

      // var_dump($nm_product); die();
      $data['file_product'] = $file_product;

      $data['jenis_user'] = $this->auth->get_user_data()->jenis_user;
      $data['nama_user'] = $this->auth->get_user_data()->nama;
      $data['id_user'] = $this->auth->get_user_data()->id;
      $data['id_member'] = $this->auth->get_user_data()->id_member;
      $id_member = $data['id_member'];

      // var_dump($id_member); die();
      // echo phpinfo();

      // $ch = curl_init();
      // curl_setopt($ch, CURLOPT_URL, "https://www.google.co.id/");
      // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      // $output = curl_exec($ch);
      //
      // var_dump($output); die();

      $data['menu'] = $this->welcome_model->menu();
      $data['kategori'] = $this->welcome_model->kategori();
      $data['sub_kategori'] = $this->welcome_model->sub_kategori();

      $data['keranjang_get_member'] = $this->welcome_model->keranjang_get_member($id_member);
      $data['product_favorite'] = $this->welcome_model->product_favorite($id_member);
      $data['keranjang_buyer'] = $this->welcome_model->keranjang_buyer($id_member);

      $keranjang_buyer = $data['keranjang_buyer'];

      $data_toko = "";
      $total_keranjang ="";
      foreach ($keranjang_buyer as $key => $keranjang) {
        $total_keranjang += $keranjang->jumlah_product;
      }

      if ($total_keranjang == "") {
        $data['total_keranjang'] = '0';
      }else {
        $data['total_keranjang'] = $total_keranjang;
      }

      $data['detail_product'] = $this->product_model->detail_product($id_product);
      $data['file_product_detail'] = $this->product_model->file_product_detail($id_product);

      // var_dump($data['detail_product']->nama_product); die();
      // var_dump($id_product); die();

      $data['ket_filter'] = $data['detail_product']->nama_product;




      if (empty($id_member)) {
        $this->load->view('templates/bootstraps/header',$data);
      }else {
        $this->load->view('templates/buyer/header',$data);
      }

      $this->load->view('product/detail_product',$data);
      $this->load->view('templates/buyer/bottom_buyer',$data);

    }

}
