<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Transaksi_model extends MY_Model {

   // protected $_table = 'lsp029_asesi';
    public function __construct() {
        $this->_table = kode_tbl()."product_keranjang";
        parent::__construct($this->_table);
    }
    protected $_table;

    protected $table_label = 'Data Transaksi';
    protected $_columns = array(
        'id_member' => array(
            'label' => 'Merchant',
            'rule' => 'trim|xss_clean',
            // 'formatter' => 'string',
            'formatter' => 'member',
            'save_formatter' => 'string',
            'width' => 150,
        ),
        'id_buyer' => array(
            'label' => 'Buyer',
            'rule' => 'trim|xss_clean',
            'formatter' => 'nm_buyer',
            // 'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 150,
        ),
        'created_when' => array(
            'label' => 'Tgl Transaksi',
            'rule' => 'trim|xss_clean',
            'formatter' => 'datetime',
            'save_formatter' => 'string',
            'width' => 100,
        ),
        'stts_keranjang' => array(
            'label' => 'Status',
            'rule' => 'trim|xss_clean',
            'formatter'	=>	array(''=>'',0=>'-', 1=>'Proses', 2=>'Dikirim', 3=>'Selesai'),
            'save_formatter' => 'string',
            'width' => 70,
            'hidden' => 'true'
        ),
        'id_product' => array(
            'label' => 'Product',
            'rule' => 'trim|xss_clean',
            'formatter' => 'skema',
            'save_formatter' => 'string',
            'width' => 200,
            'hidden' => 'true'
        ),
        'jumlah_product' => array(
            'label' => 'xxx',
            'rule' => 'trim|xss_clean',
            'formatter' => 'tuk',
            'save_formatter' => 'string',
            'width' => 170,
            'hidden' => 'true'
        ),
        'komisi' => array(
            'label' => 'Status',
            'rule' => 'trim|xss_clean',
            'formatter'	=>	array(''=>'',0=>'-', 1=>'Proses', 2=>'Dikirim', 3=>'Selesai'),
            'save_formatter' => 'string',
            'width' => 70,
            'hidden' => 'true'
        ),
        'ppn' => array(
            'label' => 'ppn',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'hidden' => 'true'
        ),
        'pph' => array(
            'label' => 'pph',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'hidden' => 'true'
        ),
        'saldo_akhir' => array(
            'label' => 'saldo_akhir',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'hidden' => 'true'
        ),
        'stts_pajak' => array(
            'label' => 'Status Perhitungan',
            'rule' => 'trim|xss_clean',
            // 'formatter' => 'string',
            'formatter'	=>	array(''=>'-',0=>'<b style="background:red;padding:3px;border-radius:5px;color:#fff;">&#215;</b>', 1=>'<b style="background:green;padding:3px;border-radius:5px;color:#fff;">&#10003;</b>'),
            // 'formatter'	=>	"fn_icon_convert(check, no-check)",
            'save_formatter' => 'string',
            'align' => 'center',
            'width' => 70,
        ),
        'id_transaksi' => array(
            'label' => 'UJK Number',
            'rule' => 'trim|xss_clean',
            'formatter' => 'string',
            'save_formatter' => 'string',
            'width' => 170,
            'hidden' => 'true'
        ),
    );

      protected $belongs_to = array(
          'nm_buyer' =>  array(
            'model' => 'buyer_model',
            'primary_key' => 'id_buyer',
            'retrieve_columns' => array('nm_buyer'),
            'join_type' => 'left'
          ),
          'member' => array(
              'model' => 'member_model',
              'primary_key' => 'id_member',
              'retrieve_columns' => array('member'),
              'join_type' => 'left'
          ),
      );

    protected $_order = array("stts_keranjang" => "DESC","id"=>"DESC");

    protected $_unique = array('unique' => array('id'), 'group' => false);


    function data_member($id){
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
          c.stts_saldo,
          c.total_saldo
        ');

        $this->db->from($member.' a');
        $this->db->join(kode_tbl().'member_detail b', 'a.id = b.id_member', 'left');
        $this->db->join(kode_tbl().'saldo_member c', 'a.id = c.id_member', 'left');
        $this->db->where('a.id',$id);
        $detail_member = $this->db->get()->row();
        return $detail_member;
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
