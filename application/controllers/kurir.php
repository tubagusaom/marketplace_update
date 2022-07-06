<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kurir extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('kurir_model');
        $this->load->model('welcome_model');

    }

    function tambah() {
        $template_header = 'templates/seller/header';
        $template_body = 'templates/responsive/kurir/tambah';
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

    function data(){
      $template_header = ('templates/seller/header');
      $template_body = 'templates/responsive/kurir/data';
      $template_bottom = 'templates/seller/bottom_seller';

      // $menu = $this->welcome_model->menu();
      $kurir = array("jne", "tiki", "pos");

      $id_member = $this->auth->get_user_data()->id_member;
      $seller = $this->kurir_model->get_seller($id_member);
      $seller_member = unserialize($seller->jasa_kirim_member);

      // var_dump(unserialize($seller->jasa_kirim_member)); die();
      // var_dump($seller_member); die();

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

        'kurir' => $kurir,
        'data' => $seller,
        'seller_member' => $seller_member,

        'rolename' => $this->auth->get_rolename(),
        'nama_user' => $this->auth->get_user_data()->nama,
        'id_user' => $this->auth->get_user_data()->id,
        'id_member' => $id_member
      ));
      $this->load->view($template_bottom, array('aplikasi' => $this->aplikasi));
    }

    function ubah(){
      $idseller = $this->input->post('idseller');
      $jasa     = $this->input->post('jasakirim');

      // var_dump(@serialize($jasa)); die();

      $data_update = array(
          'jasa_kirim_member' => @serialize($jasa),
      );
      $this->db->where_in('id', $idseller);
      // $this->db->update(kode_tbl().'members', $data_update);

      if ($this->db->update(kode_tbl().'members', $data_update)) {
        redirect('kurir/data');
      }

    }

}
