<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class My_shop extends MY_Controller {

		function __construct() {
			parent::__construct();

			$this->load->model('my_shop_model');
		}

		function new_order(){

			$aplikasi = $this->db->get('r_konfigurasi_aplikasi')->row();
			$jenis_user = $this->auth->get_user_data()->jenis_user;
			$id_user = $this->auth->get_user_data()->id;
			$id_member = $this->auth->get_user_data()->id_member;

			$pesanan_baru = $this->my_shop_model->keranjang_order($id_member);

			// var_dump($pesanan_baru); die();

			if ($jenis_user == 2) { //seller

				// data order

				$template_header = ('templates/seller/header');
				$template_body = 'templates/responsive/toko/order_baru';
				$template_bottom = 'templates/seller/bottom_seller';

			}else {
				block_access_method();
			}

			$this->load->view(
				$template_header,
				array(
					'aplikasi' => $this->aplikasi,
					'rolename' => $this->auth->get_rolename(),
					'nama_user' => $this->auth->get_user_data()->nama,
					'id_user' => $this->auth->get_user_data()->id,
					'id_member' => $this->auth->get_user_data()->id_member,

					'_css_tag' => array(
						_Asset_JS_ . 'cleditor/jquery.cleditor',
						_Asset_CSS_ . 'default',
						_Asset_CSS_ . 'themes/default/easyui',
						_Asset_CSS_ . 'themes/icon',
						_Asset_CSS_ . 'bootstraps/font-awesome.min'),
						'query_pesan' => $this->query_pesan,
						'query_pesan_unread' => $this->query_pesan_unread,
						'_script_tag' => array(
							_Asset_JS_ . 'jquery.min',
							_Asset_JS_ . 'jquery-ui/jquery-ui.min',
							_Asset_JS_ . 'elfinder/elfinder.min',
							_Asset_JS_ . 'jquery.easyui.min')
				)
			);

			$this->load->view(
				$template_body,
				array(
					'aplikasi' => $this->aplikasi,
					'id_member' => $this->auth->get_user_data()->id_member,

					'unread_message' => $this->unread_message,
					'menus' => $this->menus,
					'rolename' => $this->auth->get_rolename(),
					'nama_user' => $this->auth->get_user_data()->nama,
					'pesanan_baru' => $pesanan_baru
				)
			);

			$this->load->view(
				$template_bottom,
				array(
					'aplikasi' => $this->aplikasi,
					'pengunjung' => $data['pengunjung'],
					'total' => $data['total'],
					'rst' => $data['rst'],
					'_bottom_JS_' => array(
						_Asset_JS_ . 'member/jscript',
						_Asset_JS_ . 'member/default',
						_Asset_JS_ . 'easyui.form.extend',
						_Asset_JS_ . 'jquery.extend',
						_Asset_JS_ . 'member/serializeObject',
						_Asset_JS_ . 'jquery.easyui.lang.id',
						_Asset_JS_ . 'member/ajaxfileupload',
						_Asset_JS_ . 'cleditor/jquery.cleditor.min')
				)
			);

		}

	}
