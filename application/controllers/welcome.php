    <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Welcome extends MY_Controller {
        function __construct()
        {
            parent::__construct();
            // $skema = kode_tbl().'skema';
            // $skema_detail = kode_tbl().'skema_detail';
            // $unit_kompetensi = kode_tbl().'unit_kompetensi';
            // $elemen_kompetensi = kode_tbl().'elemen_kompetensi';
            // $kuk = kode_tbl().'kuk';
            // $asesi = kode_tbl().'asesi';
            // $asesi_detail = kode_tbl().'asesi_detail';

            $this->load->model('welcome_model');
            // $this->load->model('artikel_model');
            // $this->load->model('album_galeri_model');
            $this->load->helper('text');
            $this->load->model('repositori_model');
            // $this->load->model('jadwal_asesmen_model');
            $this->load->helper('cookie');
            $this->load->library('curl');
            $this->load->model('slider_model');
        }

        // public function tutorial($id=false) {
        //     $data['class_active'] = 'tutorial';
        //     $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
        //
        //     $this->load->view('templates/bootstraps/header',$data);
        //     if($id==1){
        //         $view = 'alamat_website';
        //     }elseif($id==2){
        //         $view = 'pendaftaran';
        //     }else{
        //         $view = 'tutorial';
        //     }
        //     $this->load->view('tutorial/'.$view,$data);
        //     $this->load->view('templates/bootstraps/bottom');
        // }

        // public function kontak($id=false) {
        //     $data['marquee'] = $this->artikel_model->marquee();
        //     $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
        //     $data['class_active'] = 'kontak';
        //     $this->load->view('templates/bootstraps/header',$data);
        //     $this->load->view('tutorial/kontak',$data);
        //     $this->load->view('templates/bootstraps/bottom');
        // }

        // public function faq($id=false) {
        //     $data['marquee'] = $this->artikel_model->marquee();
        //     $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
        //     $data['class_active'] = 'faq';
        //     $data['faq'] = $this->welcome_model->get_data_faq();
        //     $this->load->view('templates/bootstraps/header',$data);
        //     $this->load->view('tutorial/faq',$data);
        //     $this->load->view('templates/bootstraps/bottom');
        // }

        // public function link_terkait($id=false) {
        //     $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
        //     $data['marquee'] = $this->artikel_model->marquee();
        //
        //     $data['faq'] = $this->welcome_model->get_data_faq();
        //     $data['class_active'] = 'link_terkait';
        //     $this->load->view('templates/bootstraps/header',$data);
        //     $this->load->view('tutorial/link_terkait',$data);
        //     $this->load->view('templates/bootstraps/bottom');
        // }

        function update_counter($slug) {
    // return current article views
            $this->db->where('article_slug', urldecode($slug));
            $this->db->select('article_views');
            $count = $this->db->get('articles')->row();
    // then increase by one
            $this->db->where('article_slug', urldecode($slug));
            $this->db->set('article_views', ($count->article_views + 1));
            $this->db->update('articles');
        }

        public function index() {

          // $capca = $this->captcha();
          // var_dump($capca); die();

            if(!$this->auth->is_logged_in())
            {

                // var_dump(kode_tbl()); die();

                $visitor = $this->initCounter();
                $data['coba'] = array();

                // batas

                $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();

                // $data['class_active'] = 'home';

                $data['pengunjung'] = $this->welcome_model->dataPengunjung();
                $data['total'] = $this->welcome_model->totalPengunjung();
                $data['rst'] = array();

                $data['slide_count'] = $this->welcome_model->slide_total();
                $data['slideshow'] = $this->welcome_model->slide_show();
                $data['showiklan'] = $this->welcome_model->show_iklan();

                $data['show_product_terbaru'] = $this->welcome_model->show_product_terbaru();
                $show_product_terbaru = $data['show_product_terbaru'];

                foreach ($show_product_terbaru as $keyspt => $spt) {
                  $data['file_product_terbaru'] = $this->welcome_model->file_product_terbaru($spt->id);

                  // var_dump($show_product_terbaru); die();
                }

                // var_dump($show_product_terbaru->id); die();

                $data['menu'] = $this->welcome_model->menu();
                $data['kategori'] = $this->welcome_model->kategori();
                $data['sub_kategori'] = $this->welcome_model->sub_kategori();

                // var_dump($data['menu']); die();

                $this->load->view('templates/bootstraps/header',$data);
                $this->load->view('templates/bootstraps/body',$data);
                $this->load->view('templates/bootstraps/bottom',$data);
            }
            else
            {
                redirect(base_url() . 'home');
            }
        }

       //  private function _api_ongkir_post($origin,$des,$qty,$cour)
       // {
       //
       //   // var_dump($cour); die();
       //
      	//   $curl = curl_init();
      	//   curl_setopt_array($curl , array(
       //    CURLOPT_SSL_VERIFYPEER => 0,
       //    CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
      	//   CURLOPT_RETURNTRANSFER => true,
      	//   CURLOPT_ENCODING => "",
      	//   CURLOPT_MAXREDIRS => 10,
      	//   CURLOPT_TIMEOUT => 30,
      	//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      	//   CURLOPT_CUSTOMREQUEST => "POST",
      	//   CURLOPT_POSTFIELDS => "origin=".$origin."&destination=".$des."&weight=".$qty."&courier=".$cour,
      	//   CURLOPT_HTTPHEADER => array(
    	 //    "content-type: application/x-www-form-urlencoded",
    	 //    /* masukan api key disini*/
    	 //    // "key: 2211ef2ed169124a1ebc6f4a502073cf"
       //    // "key: 8a6d401055ec5f0df6e31aad625a2e41"
       //    "key: 413f3069e69eb48279c31d3a2ca55200"
       //    // "key: d16c153b1f9cb2d662e1b872c6da9042"
       //    // "key: 863d42799c01fe60f3cbeb06735b849f"
       //    // "key: e314668b23cc7563c789b7d0f9eca598"
       //    // "key: 05e209faf8bc57773b22b00e60004ed0"
       //
    		//   ),
    		// ));
       //
    		// $response = curl_exec($curl);
    		// $err = curl_error($curl);
       //
       //  // var_dump($err); die();
       //
    		// // curl_close($curl);
       //
    		// if ($err) {
    		//   return $err;
    		// } else {
    		//   return $response;
    		// }
       //
       // }

        function _api_ongkir($data) {

          // var_dump($data); die();

          $curl = curl_init();
     		  curl_setopt_array($curl, array(
     		  //CURLOPT_URL => "https://api.rajaongkir.com/starter/province?id=12",
     		  //CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
     		  CURLOPT_URL => "http://api.rajaongkir.com/starter/".$data,
     		  CURLOPT_RETURNTRANSFER => true,
     		  CURLOPT_ENCODING => "",
     		  CURLOPT_MAXREDIRS => 10,
     		  CURLOPT_TIMEOUT => 30,
     		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
     		  CURLOPT_CUSTOMREQUEST => "GET",
     		  CURLOPT_HTTPHEADER => array(
     		  	/* masukan api key disini*/
     		    // "key: 2211ef2ed169124a1ebc6f4a502073cf"
             // "key: 8a6d401055ec5f0df6e31aad625a2e41"
             "key: 413f3069e69eb48279c31d3a2ca55200"
             // "key: d16c153b1f9cb2d662e1b872c6da9042"
             // "key: 863d42799c01fe60f3cbeb06735b849f"
             // "key: e314668b23cc7563c789b7d0f9eca598"
             // "key: 05e209faf8bc57773b22b00e60004ed0"
     		  ),
     		));

     		$response = curl_exec($curl);
     		$err = curl_error($curl);

     		curl_close($curl);
     		if ($err) {
     		  return  $err;
     		} else {
     		  return $response;
     		}

      }

      public function provinsi_ro()
    	{
    		$provinsi = $this->_api_ongkir('province');
    		$data = json_decode($provinsi, true);
    		// return json_encode($data['rajaongkir']['results']);

        return ($data['rajaongkir']['results']);

        // var_dump(($data['rajaongkir']['results'])); die();

        // return "xxx";
    	}

      public function kota_ro($kota)
    	{

        // var_dump($kota); die();

    		if(!empty($kota)) {
    			if(is_numeric($kota)) {
    				$kota = $this->_api_ongkir('city?province='.$kota);
    				$data_kro = json_decode($kota, true);
    				return json_encode($data_kro['rajaongkir']['results']);

            // $datak_json = json_encode($data_kro['rajaongkir']['results']);
            // $kota_array = unserialize($datak_json);
            //
            // $data = "<option value=''>- Pilih Kabupaten -</option>";
            // foreach ($kota_array as $value) {
            //     $data .= "<option value='".$value->city_id."'>".$value->city_name."</option>";
            // }
            // // echo $data;
            //
            // var_dump($data); die();
    			} else {
    				show_404();
    			}
    		} else {
    	   	show_404();
    	  }

    	}

      // function get_kabupaten($id){
      //   // var_dump($id); die();
      //
      //   $query = $this->db->get_where('m_kabupaten',array('id_provinsi'=>$id));
      //   $data = "<option value=''>- Pilih Kabupaten -</option>";
      //   foreach ($query->result() as $value) {
      //       $data .= "<option value='".$value->id."'>".$value->nm_kabupaten."</option>";
      //   }
      //   echo $data;
      // }

      function get_kota($id){
        // var_dump($id); die();

        $query = $this->db->get_where('m_ro_kota',array('province_id'=>$id));
        $data = "<option value=''>- Pilih Kabupaten / Kota -</option>";
        foreach ($query->result() as $value) {
            $data .= "<option value='".$value->city_id."'>".$value->city_name."</option>";
        }
        echo $data;
      }

      // function get_kota($id){
      //
      //   // var_dump($id); die();
      //
      //   $kota_ro = $this->kota_ro($id);
      //
      //   // var_dump($ikota_rod); die();
      //   echo $kota_ro;
      // }

        public function daftar()
        {
            $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();

            $data['provinsi'] = $this->welcome_model->provinsi();
            // $data['provinsi_ro'] = $this->provinsi_ro();

            // $provinsi_ro = $this->provinsi_ro();

            // var_dump($provinsi_ro); die();
            // var_dump($data['provinsi']); die();

            $this->load->view('templates/bootstraps/header',$data);
            $this->load->view('templates/pendaftaran/daftar',$data);
            $this->load->view('templates/bootstraps/bottom',$data);
        }

        function save_pendaftaran(){

          $buyer =  kode_tbl().'buyer';
          $buyer_alamat =  kode_tbl().'buyer_alamat';


          $nm_buyer = $this->input->post('nm_buyer');
          $klamin_buyer = $this->input->post('klamin_buyer');
          $hp_buyer = $this->input->post('hp_buyer');
          $email_buyer = $this->input->post('email_buyer');
          $tgl_lahir_buyer = $this->input->post('tgl_lahir_buyer');
          $label_alamat = $this->input->post('label_alamat');
          $alamat_buyer = $this->input->post('alamat_buyer');
          $id_provinsi = $this->input->post('id_provinsi');
          $id_kabupaten = $this->input->post('id_kabupaten');
          $kode_pos = $this->input->post('kode_pos');
          $pass1 = $this->input->post('pass1');
          $pass2 = $this->input->post('pass2');

          $this->db->where('akun',$email_buyer);
          $query_user = $this->db->get("t_users");

          // var_dump($email_buyer); die();

          if($query_user->num_rows() > 0){
            $this->session->set_flashdata('result', 'Pendaftaran Gagal. email sudah terdaftar.');
            $this->session->set_flashdata('mode_alert', 'warning');
            redirect('welcome/sukses');
            die();
          }

          $data = array(
            'nm_buyer' => $nm_buyer,
            'klamin_buyer' => $klamin_buyer,
            'hp_buyer' => $hp_buyer,
            'email_buyer' => $email_buyer,
            'tgl_lahir_buyer' => $tgl_lahir_buyer,
            // 'klamin_buyer' => $xxx,
            'status_buyer' => '1'
          );

          if ($this->db->insert($buyer, $data)) {

            $id = $this->db->insert_id();

            $data_alamat = array(
              'id_buyer' => $id,
              'label_alamat' => $label_alamat,
              'nm_penerima' => $nm_buyer,
              'tlp_penerima' => $hp_buyer,
              'alamat_buyer' => $alamat_buyer,
              'id_provinsi' => $id_provinsi,
              'id_kabupaten' => $id_kabupaten,
              'kode_pos' => $kode_pos,
              'jenis_alamat' => '1',
              'stts_alamat' => '1',
            );
            $this->db->insert($buyer_alamat, $data_alamat);

            // $datax['sender_id'] = 1;
            // $datax['reciepent_id'] = 1;
            // $datax['title'] = 'Pendaftaran Uji Kompetensi';
            // $datax['message'] = 'Pendaftaran UJK atas nama ' . $nama_lengkap . ' No HP ' . $no_telp;
            //
            // $this->load->model('Pesan_Model');
            // $this->Pesan_Model->insert($datax);
            // $admin = $this->db->get('r_konfigurasi_aplikasi')->row();
            //
            // $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
            // $nama = str_replace(' ', '', strtolower($nama_lengkap));
            //
            // if (strlen($nama) > 4) {
            //   $dataxy['akun'] = substr($nama, 0, 4) . rand(1, 9999);
            // } else {
            //   $dataxy['akun'] = $nama . rand(1, 9999);
            // }

            $dataxy['akun'] = $email_buyer;
            $dataxy['email'] = $email_buyer;
            $dataxy['hp'] = $hp_buyer;
            $dataxy['nama_user'] = $nm_buyer;
            $dataxy['jenis_user'] = '3';
            $dataxy['sandi'] = $pass1;
            $dataxy['sandi_asli'] = $pass1;
            $dataxy['aktif'] = '1';
            $dataxy['id_member'] = $id;

            $this->load->model('User_Model');
            $this->User_Model->insert($dataxy);
            $user_id = $this->db->insert_id();

            $datayy['user_id'] = $user_id;
            $datayy['role_id'] = 5;
            $this->load->model('User_Role_Model');
            $this->User_Role_Model->insert($datayy);

            // $dataxyz = array(
            //   'id_users' => $user_id
            // );
            // $this->db->where('id', $id);
            // $this->db->update(kode_tbl() . 'asesi', $dataxyz);

            $this->session->set_flashdata('result', '<b> Pendaftaran Berhasil. silahkan <a href="#" id="login-btn" data-toggle="modal" data-target="#myModal" class="">login</a> menggunakan email yg didaftarkan sebagai username dan password yg anda tentukan. </b>');
            $this->session->set_flashdata('mode_alert', 'success');
            redirect('welcome/sukses');

          }else {

            $this->session->set_flashdata('result', 'Pendaftaran Gagal. Ada kesalahan dalam pengisian database. Atau email sudah terdaftar.');
            $this->session->set_flashdata('mode_alert', 'warning');
            redirect('welcome/sukses');

          }

          // var_dump($data); die();
        }

        function daftar_merchant(){
          $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();

          $data['provinsi'] = $this->welcome_model->provinsi();
          // $data['provinsi_ro'] = $this->provinsi_ro();

          // $provinsi_ro = $this->provinsi_ro();

          // var_dump($provinsi_ro); die();
          // var_dump($data['provinsi']); die();

          $this->load->view('templates/bootstraps/header',$data);
          $this->load->view('templates/pendaftaran/daftar_merchant',$data);
          $this->load->view('templates/bootstraps/bottom',$data);
        }

        function sukses(){
            $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
            // $data['marquee'] = $this->artikel_model->marquee();

            $this->load->view('templates/bootstraps/header',$data);
            $this->load->view('templates/bootstraps/sukses',$data);
            // $this->load->view('templates/bootstraps/bottom',$data);
        }

        function sukses_pembayaran(){
            $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
            // $data['marquee'] = $this->artikel_model->marquee();

            $this->load->view('templates/bootstraps/header',$data);
            $this->load->view('templates/bootstraps/sukses_pembayaran',$data);
            // $this->load->view('templates/bootstraps/bottom',$data);
        }






        // function uji_kompetensi_save() {
        //     $this->load->helper('postinger');
        //     $this->load->library('upload');
        //
        //     $skema = kode_tbl() . 'skema';
        //     $skema_detail = kode_tbl() . 'skema_detail';
        //     $unit_kompetensi = kode_tbl() . 'unit_kompetensi';
        //     $elemen_kompetensi = kode_tbl() . 'elemen_kompetensi';
        //     $kuk = kode_tbl() . 'kuk';
        //     $asesi = kode_tbl() . 'asesi';
        //     $asesi_detail = kode_tbl() . 'asesi_detail';
        //
        //     $no_identitas = $this->input->post('no_identitas', true);
        //     $nama_lengkap = $this->input->post('nama_lengkap', true);
        //     $pilihan_bukti_pendukung = @serialize($_POST['pilih_array']);
        //     $email = $this->input->post('email');
        //     $skema_yang_dipilih = $this->input->post('skema_yang_dipilih', true);
        //
        //             // Data Upload Bukti Pendukung
        //     $post = $_FILES['file_data'];
        //             // Nama Bukti Pendukung
        //     $nama_dokumen = $this->input->post('nama_dokumen', true);
        //     //var_dump($nama_dokumen);die();
        //     $marketing = $this->input->post('marketing');
        //             //var_dump($post);die();
        //             // Extract Files POST
        //     foreach ($nama_dokumen as $key => $nmdokumen) {
        //         $file_data = array("name" => $post['name'][$key], "type" => $post['type'][$key], "tmp_name" => $post['tmp_name'][$key], "error" => $post['error'][$key], "size" => $post['size'][$key]);
        //         $dataUpload[$nmdokumen][] = $file_data;
        //         $nama_filenya[] = $nmdokumen . "-" . time() . "-" . str_replace(" ", "_", $post['name'][$key]);
        //                 //$nama_filenya[] = $nmdokumen . "-" . time() . "-" . $post['name'][$key];
        //         $dataName[$nmdokumen][] = $nama_filenya[$key];
        //
        //         $_FILES[$nama_filenya[$key]] = $file_data;
        //
        //         $fileupload[$nmdokumen][] = $this->upload_file($nama_filenya[$key], $nama_filenya[$key]);
        //     }
        //     $bukti_pendukung = json_encode($dataName);
        //
        //     $aplikasi = $this->db->get('r_konfigurasi_aplikasi')->row();
        //
        //     if ($nama_lengkap == "") {
        //         $this->session->set_flashdata('result', $aplikasi->pesan_gagal_browser);
        //         echo '<div class="alert alert-warning" role="alert">' . $this->session->flashdata('result') . '</div>';
        //         die();
        //     }
        //     $this->db->where('nama_lengkap', $nama_lengkap);
        //     $this->db->where('email', $email);
        //     $this->db->where('skema_sertifikasi', $skema_yang_dipilih);
        //
        //     $query = $this->db->get("$asesi");
        //
        //     if ($query->num_rows() > 0) {
        //         $this->session->set_flashdata('result', $aplikasi->pesan_gagal_double);
        //         $this->session->set_flashdata('mode_alert', 'warning');
        //         redirect('welcome/sukses');
        //         $datax['sender_id'] = 1;
        //         $datax['reciepent_id'] = 1;
        //         $datax['title'] = 'Email Terdaftar';
        //         $datax['message'] = 'Email Telah terdaftar atas nama ' . $nama_lengkap . ', Email ' . $email;
        //
        //         $this->load->model('Pesan_Model');
        //         $this->Pesan_Model->insert($datax);
        //
        //         $admin = $this->db->get('r_konfigurasi_aplikasi')->row();
        //         smssend($admin->sms_center, $datax['message']);
        //         die();
        //     }
        //
        //
        //     $tempat_lahir = $this->input->post('tempat_lahir', true);
        //     $tanggal_lahir = $this->input->post('tanggal_lahir', true);
        //     $dates = array_reverse(explode("/", $tanggal_lahir));
        //     $tanggal_lahir = implode('-', $dates);
        //     $jenis_kelamin = $this->input->post('jenis_kelamin', true);
        //     $kewarganegaraan = $this->input->post('kewarganegaraan', true);
        //     $alamat = $this->input->post('alamat', true);
        //     $no_telp = $this->input->post('no_telp', true);
        //     $email = $this->input->post('email', true);
        //     $pend_terakhir = $this->input->post('pend_terakhir', true);
        //     $perg_tinggi = $this->input->post('perg_tinggi', true);
        //     $jurusan = $this->input->post('jurusan', true);
        //     $jabatan = $this->input->post('jabatan', true);
        //     $alamat_perusahaan = $this->input->post('alamat_perusahaan', true);
        //     $no_telp_company = $this->input->post('no_telp_company', true);
        //     $email_company = $this->input->post('email_companny', true);
        //     $tujuan_asesmen = $this->input->post('tujuan_asesmen', true);
        //     $skema_okupasi = $this->input->post('skema_okupasi', true);
        //     $kontak_tuktetap = $this->input->post('kontak_tuktetap', true);
        //     $acuan_standarkomp = $this->input->post('acuan_standarkomp', true);
        //
        //     $organisasi = $this->input->post('organisasi', true);
        //
        //             //$id= $this->generate_code();
        //     $pilih = $this->input->post('pilih', true);
        //     $is_kompeten = $this->input->post('is_kompeten', true);
        //     $folder = $this->input->post('folder', true);
        //     $id_provinsi = $this->input->post('id_provinsi');
        //     $kode_random = rand(1, 1000000);
        //             //var_dump($is_kompeten);die();
        //     $data = array(
        //         'no_identitas' => $no_identitas,
        //         'nama_lengkap' => $nama_lengkap,
        //         'tempat_lahir' => $tempat_lahir,
        //         'tgl_lahir' => $tanggal_lahir,
        //         'jenis_kelamin' => $jenis_kelamin,
        //         'kewarganegaraan' => $kewarganegaraan,
        //         'alamat' => $alamat,
        //         'telp' => $no_telp,
        //         'email' => $email,
        //         'pendidikan_terakhir' => $pend_terakhir,
        //         'jurusan' => $jurusan,
        //         'jabatan' => $jabatan,
        //         'alamat_company' => $alamat_perusahaan,
        //         'telp_company' => $no_telp_company,
        //         'email_company' => $email_company,
        //         'id_provinsi' => $id_provinsi,
        //         'skema_sertifikasi' => $skema_yang_dipilih,
        //         'kode_random' => $kode_random,
        //         'pilihan_bukti_pendukung' => $pilihan_bukti_pendukung,
        //         'organisasi' => $organisasi,
        //         'bukti_pendukung' => json_encode($dataName),//$bukti_pendukung
        //         'marketing' => $marketing
        //             );
        //     $bukti = unserialize($pilihan_bukti_pendukung);
        //
        //     if ($this->db->insert($asesi, $data)) {
        //         $id = $this->db->insert_id();
        //         //$this->db->insert($asesi, $data);
        //         //$this->send_email($kode_random,$email,$id,$nama_lengkap); //temp modified
        //         $this->load->model('asesi_model');
        //         $detail_elemen_kuk = $this->asesi_model->detail_elemen_kuk($skema_yang_dipilih);
        //         foreach ($detail_elemen_kuk as $key => $value) {
        //             $data_detail = array(
        //                 'asesi_id' => $id,
        //                 'unit_kompetensi_id' => $value->id_unit_kompetensi,
        //                 'jenis_bukti' => $bukti[$key],
        //                 'is_kompeten' => 'k',
        //                 'elemen' => $value->elemen_kompetensi,
        //             );
        //             $this->db->insert($asesi_detail, $data_detail);
        //         }
        //
        //         $datax['sender_id'] = 1;
        //         $datax['reciepent_id'] = 1;
        //         $datax['title'] = 'Pendaftaran Uji Kompetensi';
        //         $datax['message'] = 'Pendaftaran UJK atas nama ' . $nama_lengkap . ' No HP ' . $no_telp;
        //
        //         $this->load->model('Pesan_Model');
        //         $this->Pesan_Model->insert($datax);
        //         $admin = $this->db->get('r_konfigurasi_aplikasi')->row();
        //
        //         $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
        //         $nama = str_replace(' ', '', strtolower($nama_lengkap));
        //         if (strlen($nama) > 4) {
        //             $dataxy['akun'] = substr($nama, 0, 4) . rand(1, 9999);
        //         } else {
        //             $dataxy['akun'] = $nama . rand(1, 9999);
        //         }
        //
        //
        //         $dataxy['email'] = $email;
        //         $dataxy['hp'] = $no_telp;
        //         $dataxy['nama_user'] = $nama_lengkap;
        //         $dataxy['jenis_user'] = '1';
        //                                 //$datax['sandi'] = '123456';
        //         $dataxy['sandi_asli'] = '123456';
        //         $dataxy['aktif'] = '1';
        //         $dataxy['id_member'] = $id;
        //
        //         $this->load->model('User_Model');
        //         $this->User_Model->insert($dataxy);
        //         $user_id = $this->db->insert_id();
        //
        //         $datayy['user_id'] = $user_id;
        //         $datayy['role_id'] = 17;
        //         $this->load->model('User_Role_Model');
        //         $this->User_Role_Model->insert($datayy);
        //
        //         $dataxyz = array(
        //             'id_users' => $user_id
        //         );
        //         $this->db->where('id', $id);
        //         $this->db->update(kode_tbl() . 'asesi', $dataxyz);
        //
        //         $jenis_dokumen_array = array(
        //             'foto'=>'1',
        //             'ktp'=>'1',
        //             'ijazah'=>'1',
        //             'skkd'=>'1',
        //             'cp'=>'5',
        //             'surat_pelatihan'=>'3',
        //             'surat_referensi'=>'6',
        //             'job_description'=>'5',
        //             'demonstrasi_pekerjaan'=>'5',
        //             'pengalaman_industri'=>'5',
        //             'bukti_relevan'=>'5',
        //             'sertifikat_expired'=>'2',
        //         );
        //         foreach ($nama_dokumen as $key => $value) {
        //             $array_repositori = array(
        //                 'nama_dokumen'=> $value,
        //                 'nama_file'=> $nama_filenya[$key],
        //                 'jenis_portofolio'=> $jenis_dokumen_array[$value],
        //                 'id_asesi'=>$user_id
        //             );
        //             $this->db->insert('t_repositori',$array_repositori);
        //         }
        //         $rootPath = realpath($data['aplikasi']->path . $folder);
        //
        //         $this->session->set_flashdata('result', $aplikasi->pesan_sukses_pendaftaran);
        //         $this->session->set_flashdata('mode_alert', 'success');
        //         redirect('welcome/sukses');
        //     } else {
        //
        //         $this->session->set_flashdata('result', 'Pengisian Formulir APL 01 dan 02 Gagal. Ada kesalahan dalam pengisian database. Hubungi bagian admin.');
        //         $this->session->set_flashdata('mode_alert', 'warning');
        //         redirect('welcome/sukses');
        //     }
        //
        // }






        function get_kabupaten($id){
          // var_dump($id); die();

          $query = $this->db->get_where('m_kabupaten',array('id_provinsi'=>$id));
          $data = "<option value=''>- Pilih Kabupaten -</option>";
          foreach ($query->result() as $value) {
              $data .= "<option value='".$value->id."'>".$value->nm_kabupaten."</option>";
          }
          echo $data;
        }

        function f($id){
          $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();

          $this->load->model('welcome_model');
          $idlsp = kode_tbl();
          $data['data_skema'] = $this->welcome_model->data_skema($idlsp);
          $data['data_tuk'] = $this->welcome_model->data_tuk($idlsp);
          $data['data_jadwal'] = $this->welcome_model->data_jadwal($idlsp);
          $data['marquee'] = $this->artikel_model->marquee();
          $data['prodi'] = $this->db->get('t_prodi')->result();

          $data['uri'] = $id;
          $this->load->view('uji_kompetensi/ujikom',$data);
        }

        function send_email($kode_random,$email,$id,$nama_lengkap) {
            $this->load->library('email');
            $this->email->from('info@lspteknisiakuntansi.or.id', 'Sekretariat LSP Teknisi Akuntansi');
            $this->email->to($email);

            $this->email->subject('LSP Teknisi Akuntansi');
            $data['id'] = $id;
            $data['email'] = $email;
            $data['kode_random'] = $kode_random;
            $data['nama_lengkap'] = $nama_lengkap;
            $pesan = $this->load->view('com_lsp/vemail', $data, true);
                    //$pesan = 'OKOK';

            $this->email->message($pesan);

            if ($this->email->send()) {
                return 'ok';
            } else {
                return 'nok';
            }
                    //echo $this->email->print_debugger();
        }

        function about(){
            $email = $this->input->post('validasi_email');
            $this->db->where('email',$email);
            $data = $this->db->get(kode_tbl().'asesi')->row();
            echo count($data);
        }

        function removeDirectory($path) {
            $files = glob($path . '/*');
            foreach ($files as $file) {
                is_dir($file) ? removeDirectory($file) : unlink($file);
            }
            rmdir($path);
            return;
        }

        function initCounter() {
            $res = $this->db->query("SELECT * FROM t_counter")->num_rows();

            $ip = $this->input->ip_address();
            $location = $this->input->server();
            $tanggal = date("Ymd");
            $hits = 1;
            $waktu = time();

            $data = array(
                'ip' => $ip,
                'location' => $location,
                'tanggal' => $tanggal,
                'hits' => $hits,
                'waktu' => $waktu,
            );

            if ($res == 0) {
                $this->db->insert('t_counter',$data);
                    //echo "data di input";
            } else {
                    //var_dump($visitor); die();
                $this->db->query("UPDATE t_counter SET hits=hits+1, waktu='$waktu' WHERE ip='$ip' AND tanggal='$tanggal'");
                    //echo "data di update";
            }
          }

          public function upload() {
              if (!empty($_FILES)) {
                  $tempFile = $_FILES['file']['tmp_name'];
                  $fileName = $_FILES['file']['name'];
                  $folder = $this->input->post('folder');
                  $targetPath = getcwd() . '/share/temp/'.$folder.'/';
                  $targetFile = $targetPath . $fileName ;
                  move_uploaded_file($tempFile, $targetFile);
              }
          }

          // function uploads($source,$destination){
          //     $this->load->library('ftp');
          //         //FTP configuration
          //     $ftp_config['hostname'] = '128.199.121.184';
          //     $ftp_config['username'] = 'sammy';
          //     $ftp_config['password'] = '400485Aa';
          //     $ftp_config['debug']    = TRUE;
          //         //Connect to the remote server
          //     $this->ftp->connect($ftp_config);
          //     $this->ftp->upload($source,$destination,'ascii', 0775);
          //         //Close FTP connection
          //     $this->ftp->close();
          // }

        //   function generate_code(){
        //     $tahun = date('Y');
        //     $bulan = date('M');
        //     $tanggal = date('d');
        //     $docnumber=$this->db->query("select id from $asesi order by id desc limit 1")->row();
        //
        //     if(count($docnumber) > 0){
        //         $maxdigitx=  substr($docnumber->id, -7)+1;
        //         if($maxdigitx < 10){
        //             $maxdigit="000000".$maxdigitx;
        //         }elseif($maxdigitx < 100){
        //             $maxdigit="00000".$maxdigitx;
        //         }elseif($maxdigitx < 1000){
        //             $maxdigit="0000".$maxdigitx;
        //         }elseif($maxdigitx < 10000){
        //             $maxdigit="000".$maxdigitx;
        //         }elseif($maxdigitx < 100000){
        //             $maxdigit="00".$maxdigitx;
        //         }elseif($maxdigitx < 1000000){
        //             $maxdigit="0".$maxdigitx;
        //         }elseif($maxdigitx < 10000000){
        //             $maxdigit=$maxdigitx;
        //         }
        //         return "APL/".$tanggal."/".$bulan."/".$tahun."/".$maxdigit;
        //     }else{
        //      return "APL/".$tanggal."/".$bulan."/".$tahun."/"."0000001";
        //  }
        // }











        // function uji_kompetensi($id=""){
	      //    if($this->input->get('keyword') == "")
        //     {
        //
        //     $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
        //
        //     $this->load->model('welcome_model');
        //     $idlsp = kode_tbl();
        //     $data['data_skema'] = $this->welcome_model->data_skema($idlsp);
        //     $data['data_tuk'] = $this->welcome_model->data_tuk($idlsp);
        //     $data['data_jadwal'] = $this->welcome_model->data_jadwal($idlsp);
        //     $data['marquee'] = $this->artikel_model->marquee();
        //     $data['prodi'] = $this->db->get('t_prodi')->result();
        //
        //     $data['uri'] = $id;
        //     $this->load->view('uji_kompetensi/ujikom',$data);
	      //    } else {
	      //       $data['aplikasi'] = $this->db->get('r_konfigurasi_aplikasi')->row();
        //
        //       $this->load->model('welcome_model');
        //       $idlsp = kode_tbl();
	      //       $keyword = $this->input->get('keyword'); //cek form di views/ujikompetensi/step_1.php
        //       $data['data_skema'] = $this->welcome_model->search_skema($idlsp, $keyword);
        //       $data['data_tuk'] = $this->welcome_model->data_tuk($idlsp);
        //       $data['data_jadwal'] = $this->welcome_model->data_jadwal($idlsp);
        //       $data['marquee'] = $this->artikel_model->marquee();
        //
        //       $data['uri'] = $id;
        //       $this->load->view('uji_kompetensi/ujikom',$data);
	      //      }
        // }

//         function uji_kompetensi_skema(){
//            $skema = kode_tbl().'skema';
//            $skema_detail = kode_tbl().'skema_detail';
//            $unit_kompetensi = kode_tbl().'unit_kompetensi';
//            $elemen_kompetensi = kode_tbl().'elemen_kompetensi';
//            $kuk = kode_tbl().'kuk';
//            $asesi = kode_tbl().'asesi';
//            $asesi_detail = kode_tbl().'asesi_detail';
//            $id = $this->input->post('id');
//
//            $this->db->select("a.*,c.id_unit_kompetensi,c.unit_kompetensi,d.elemen_kompetensi,e.id_elemen_kompetensi,e.kuk",false);
//            $this->db->from("$skema a");
//            $this->db->join("$skema_detail b","b.id_skema=a.id");
//            $this->db->join("$unit_kompetensi c","c.id=b.id_unit_kompetensi");
//            $this->db->join("$elemen_kompetensi d","d.id_unit_kompetensi=c.id");
//            $this->db->join("$kuk e","e.id_elemen_kompetensi=d.id");
//            $this->db->where("a.id",$id);
//            $d = $this->db->get()->result();
//            $table='<table  width="100%" class="table table-stripped table-bordered" border="1">
//            <tr align="center" style="font-weight:bold;">
//            <td  align="center"> No </td>
//            <td> Kode Unit </td>
//            <td> Judul Unit Kompetensi / Elemen Kompetensi / <br/> Kriteria Unjuk Kerja(KUK)</td>
//            <td width="30px" align="center"> K<br/>
//            <input type="checkbox" id="all_k" name="all_k" />
//            </td>
//            <td width="30px" align="center"> BK<br/>
//            <input type="checkbox" id="all_bk" name="all_k" /> </td>
//            <td> Bukti Pendukung </td>
//            </tr>';
//            $no=1;
//            $real_unit = "";
//            $real_elemen = "";
//            foreach($d as $key=>$value){
//              if($real_unit == $value->id_unit_kompetensi){
//                 if($real_elemen != $value->id_elemen_kompetensi){
//                    $table.=' <tr style="font-weight:normal;">
//                    <td align="center"></td>
//                    <td></td>
//                    <td> <b>'.ltrim($value->elemen_kompetensi).'</b> </td>
//                    <td> </td>
//                    <td> </td>
//                    <td>
//                    </td>
//                    </tr>';
//                           //if($real_elemen == $value->id_elemen_kompetensi){
//                    $table.=' <tr style="font-weight:normal;">
//                    <td align="center"></td>
//                    <td></td>
//                    <td> '.ltrim($value->kuk).' </td>
//                    <td align="center"> <input type="radio" required name="is_kompeten[]['.$key.']"  value="k" class="value_k"/> </td>
//                    <td align="center"> <input type="radio" required name="is_kompeten[]['.$key.']" value="bk" class="value_bk"/></td>
//                    <td class="select_bukti">
//                    </td>
//                    </tr>';
//                }else{
//
//                 $table.=' <tr style="font-weight:normal;">
//                 <td align="center"></td>
//                 <td></td>
//                 <td> '.ltrim($value->kuk).' </td>
//                 <td align="center"> <input type="radio" required name="is_kompeten[]['.$key.']"  value="k" class="value_k"/> </td>
//                 <td align="center"> <input type="radio" required name="is_kompeten[]['.$key.']" value="bk" class="value_bk"/></td>
//                 <td class="select_bukti">
//                 </td>
//                 </tr>';
//             }
//         }else{
//             $table.=' <tr>
//             <td align="center"> '.$no.' </td>
//             <td> '.$value->id_unit_kompetensi.' </td>
//             <td> <b>'.$value->unit_kompetensi.'</b> </td>
//             <td align="center"> </td>
//             <td align="center"> </td>
//             <td>
//             </td>
//             </tr>';
//             $table.=' <tr style="font-weight:normal;">
//             <td align="center"></td>
//             <td></td>
//             <td> <b>'.ltrim($value->elemen_kompetensi).'</b> </td>
//             <td> </td>
//             <td> </td>
//             <td>
//             </td>
//             </tr>';
//             $table.=' <tr style="font-weight:normal;">
//             <td align="center"></td>
//             <td></td>
//             <td> '.ltrim($value->kuk).' </td>
//             <td align="center"> <input type="radio" required name="is_kompeten[]['.$key.']"  value="k" class="value_k"/> </td>
//             <td align="center"> <input type="radio" required name="is_kompeten[]['.$key.']" value="bk" class="value_bk"/></td>
//             <td class="select_bukti">
//             </td>
//             </tr>';
//             $no++;
//
//         }
//         $real_unit = $value->id_unit_kompetensi;
//         $real_elemen = $value->id_elemen_kompetensi;
//     }
//     $table .= '</table>';
//     echo $table;
// }

// function detail(){
//     $skema = kode_tbl().'skema';
//     $skema_detail = kode_tbl().'skema_detail';
//     $unit_kompetensi = kode_tbl().'unit_kompetensi';
//     $elemen_kompetensi = kode_tbl().'elemen_kompetensi';
//     $kuk = kode_tbl().'kuk';
//     $asesi = kode_tbl().'asesi';
//     $asesi_detail = kode_tbl().'asesi_detail';
//     $id = $this->input->post('id');
//
//     $this->db->select("a.*,c.id_unit_kompetensi,c.unit_kompetensi,c.translate",false);
//     $this->db->from("$skema a");
//     $this->db->join("$skema_detail b","b.id_skema=a.id");
//     $this->db->join("$unit_kompetensi c","c.id=b.id_unit_kompetensi");
//         //$this->db->join("$elemen_kompetensi d","d.id_unit_kompetensi=c.id");
//     $this->db->where("a.id",$id);
//     $this->db->order_by("c.id_unit_kompetensi","ASC");
//     $d = $this->db->get()->result();
//     $table='<h3>'.$d[0]->skema.'</h3><table  width="100%" class="table table-stripped table-bordered" border="1">
//     <tr align="center" style="font-weight:bold;">
//     <td  align="center"> No </td>
//     <td> Kode Unit </td>
//     <td> Judul Unit Kompetensi</td>
//
//     </tr>';
//     $no=1;
//
//     foreach($d as $key=>$value){
//
//         $table.=' <tr>
//         <td align="center"> '.$no.' </td>
//         <td align="center"> '.$value->id_unit_kompetensi.' </td>
//         <td>
//           <b>'.$value->unit_kompetensi.'</b><br><hr style=margin:0; padding:0; color:#999>
//           <font>'.$value->translate.'</font>
//         </td>
//
//         </tr>';
//         $no++;
//
//
//     }
//     $table .= '</table>';
//     echo $table;
// }

}
