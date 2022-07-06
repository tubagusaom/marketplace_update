<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Withdraw_model extends MY_Model {

   // protected $_table = 'lsp029_asesi';
    public function __construct() {
        $this->_table = kode_tbl()."withdraw_member";
        parent::__construct($this->_table);
    }
    protected $_table;

    protected $table_label = 'Data Withdraw';
    protected $_columns = array(
        'id_member' => array(
            'label' => 'Merchant',
            'rule' => 'trim|xss_clean',
            // 'formatter' => 'string',
            'formatter' => 'member',
            'save_formatter' => 'string',
            'width' => 150,
        ),
        'created_when' => array(
            'label' => 'Tgl Withdraw',
            'rule' => 'trim|xss_clean',
            'formatter' => 'datetime',
            'save_formatter' => 'string',
            'width' => 100,
        ),
        'stts_withdraw' => array(
            'label' => 'Status',
            'rule' => 'trim|xss_clean',
            'formatter'	=>	array(''=>'-',0=>'<b style="background:orange;padding:3px;border-radius:5px;color:#fff;">Withdraw</div>', 1=>'<b style="background:green;padding:3px;border-radius:5px;color:#fff;">Dikirim</b>'),
            'save_formatter' => 'string',
            'width' => 70,
        ),
    );

      protected $belongs_to = array(
          // 'buyer' =>  array(
          //   'model' => 'buyer_model',
          //   'primary_key' => 'id_buyer',
          //   'retrieve_columns' => array('nm_buyer'),
          //   'join_type' => 'left'
          // ),
          'member' =>  array(
            'model' => 'member_model',
            'primary_key' => 'id_member',
            'retrieve_columns' => array('member'),
            'join_type' => 'left'
          ),
      );

    protected $_order = array("stts_withdraw" => "ASC","id"=>"DESC");

    protected $_unique = array('unique' => array('id'), 'group' => false);


    function saldo_member($id){
        $member = kode_tbl().'members';

        $this->db->select('
          a.*,
          b.nama_pemilik_bank,
          b.nama_bank,
          b.norek_bank,
          b.cabang_bank,
          b.nama_pic,
          b.jabatan_pic,
          b.hp_pic,
          b.email_pic,
          c.total_saldo
        ');

        $this->db->from($member.' a');
        $this->db->join(kode_tbl().'member_detail b', 'a.id = b.id_member', 'left');
        $this->db->join(kode_tbl().'saldo_member c', 'a.id = c.id_member', 'left');
        $this->db->where('a.id',$id);
        $detail_member = $this->db->get()->row();
        return $detail_member;
    }

    function saldo_wd($id){
        $withdraw_member = kode_tbl().'withdraw_member';

        $this->db->select(
          'total_withdraw'
        );

        $this->db->from($withdraw_member.' a');
        $this->db->where('a.id_member',$id);
        $this->db->where('a.stts_withdraw','1');
        $detail_wd = $this->db->get()->row();
        return $detail_wd;
    }

    function data_buyer($id){
        $buyer = kode_tbl().'buyer';
        $this->db->select('a.*');
        $this->db->from($buyer.' a');
        $this->db->where('a.id',$id);
        $detail_buyer = $this->db->get()->row();
        return $detail_buyer;
    }

    function data_transaksi($id){
        $transaksi = kode_tbl().'transaksi_buyer';
        $this->db->select('a.*');
        $this->db->from($transaksi.' a');
        $this->db->where('a.id',$id);
        $detail_transaksi = $this->db->get()->row();
        return $detail_transaksi;
    }

    function data_kurir($id){
        $kurir = kode_tbl().'kurir_pengiriman_buyer';
        $this->db->select('a.*');
        $this->db->from($kurir.' a');
        $this->db->where('a.id_keranjang',$id);
        $detail_kurir = $this->db->get()->row();
        return $detail_kurir;
    }

}
