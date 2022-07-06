<style>
.search-form .form-group {
  float: right !important;
  transition: all 0.35s, border-radius 0s;
  width: 32px;
  height: 32px;
  background-color: #fff;
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
  border-radius: 25px;
  border: 1px solid #ccc;
}
.search-form .form-group input.form-control {
  padding-right: 20px;
  border: 0 none;
  background: transparent;
  box-shadow: none;
  display:block;
}
.search-form .form-group input.form-control::-webkit-input-placeholder {
  display: none;
}
.search-form .form-group input.form-control:-moz-placeholder {
  /* Firefox 18- */
  display: none;
}
.search-form .form-group input.form-control::-moz-placeholder {
  /* Firefox 19+ */
  display: none;
}
.search-form .form-group input.form-control:-ms-input-placeholder {
  display: none;
}
.search-form .form-group:hover,
.search-form .form-group.hover {
  width: 100%;
  border-radius: 4px 25px 25px 4px;
}
.search-form .form-group span.form-control-feedback {
  position: absolute;
  top: -1px;
  right: -2px;
  z-index: 2;
  display: block;
  width: 34px;
  height: 34px;
  line-height: 34px;
  text-align: center;
  color: #3596e0;
  left: initial;
  font-size: 14px;
}

.panel-table .panel-body{
  padding:0;
}

.panel-table .panel-body .table-bordered{
  border-style: none;
  margin:0;
}

.panel-table .panel-body .table-bordered > thead > tr > th:first-of-type {
    text-align:center;
    width: 100px;
}

.panel-table .panel-body .table-bordered > thead > tr > th:last-of-type,
.panel-table .panel-body .table-bordered > tbody > tr > td:last-of-type {
  border-right: 0px;
}

.panel-table .panel-body .table-bordered > thead > tr > th:first-of-type,
.panel-table .panel-body .table-bordered > tbody > tr > td:first-of-type {
  border-left: 0px;
}

.panel-table .panel-body .table-bordered > tbody > tr:first-of-type > td{
  border-bottom: 0px;
}

.panel-table .panel-body .table-bordered > thead > tr:first-of-type > th{
  border-top: 0px;
}

.panel-table .panel-footer .pagination{
  margin:0; 
}

/*
used to vertically center elements, may need modification if you're not using default sizes.
*/
.panel-table .panel-footer .col{
 line-height: 34px;
 height: 34px;
}

.panel-table .panel-heading .col h3{
 line-height: 30px;
 height: 30px;
}

.panel-table .panel-body .table-bordered > tbody > tr > td{
  line-height: 19px;
}


</style>
<div class="pageSection container-fluid-full">
    <div class="bannerPage container">
        <img class="img-thumbnail" src="<?=base_url().'assets/img/spa.png'?>">
    </div> <!-- class="bannerPage container" -->
    <div class="container" style="margin-top: 15px;"></div>
<div class="bannerPage container">
	<div class="col-md-12 well" style="background-color: #FFFFFF;">
      <div class="col-md-3">
		<?php $this->load->view('sertifikasi/left_menu_sertifikasi');?>
	</div>
<div class="col-md-9">

     <h3>Konfirmasi Pembayaran</h3>
            <div class="col-md-12">
            <?php
            if($this->session->flashdata('result')!=''){
        ?>
        <div class="alert alert-<?=$this->session->flashdata('mode_alert')?>" role="alert"><?php echo $this->session->flashdata('result'); ?></div>
        <?php
        }
        ?></div>
            <form id="main-contact-form" class="contact-form" name="contact-form" method="post" action="<?php echo base_url();?>sertifikasi/simpan_konfirmasi" enctype="multipart/form-data">
                    <div class="col-md-5">
                        <label>Jumlah Pembayaran</label>
                        <input type="text" class="form-control" name="txtjumlah_pembayaran" id="txtjumlah_pembayaran" required="required" placeholder="sesuaikan dengan nominal invoice">
                        <label>Tanggal Transfer</label>
                        <input type="text" class="form-control" name="txttgl_transfer" id="txttgl_transfer" required="required" placeholder="Tanggal Transfer (Ex : 05 Oktober 2016">
                        <label>Nama Pengirim</label>
                        <input type="text" class="form-control" name="txtemail" id="txtemail" required="required" placeholder="Nama Sesuai No Rekening Pengirim">
                         <label>Bukti Pembayaran</label>
                        <input class="form-control input-sm width-auto" name="namafile" type="file">
                         <label>Validasi Input ( <?php echo $a.' + '.$b.' )' ; ?></label>
                        <input type="text" class="form-control" name="txtcaptcha" id="txtcaptcha" required="required" placeholder="Hasil Penjumlahan">
                    </div>
                    <div class="col-md-7">
                        <label>Catatan</label>
                        <textarea name="txtmessage" name="txtmessage" id="txtmessage"  class="form-control" rows="8"></textarea>
                        <br />
                        <button type="submit" class="btn btn-primary btn-large pull-right">Konfirmasi</button>
                    </div>
                </form>
            

</div> <!-- class="col-md-9" style="background: white;padding: 5px;border-bottom: 0px solid #ccc;" -->

</div> <!-- class="container" style="margin-top: 15px;" -->

</div> <!-- class="row" -->

</div> <!-- class="pageSection container-fluid-full" -->