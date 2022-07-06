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
    <ol class="breadcrumb">
        <li><a href="<?=base_url()?>">Home</a></li>
            <li><a href="<?=base_url().'asesor/view'?>">Asesor Kompetensi</a></li>
            <li class="active">Detail Profil</li>
      </ol>
        <div class="panel panel-default panel-table">
                  <div class="panel-heading">
                    <div class="row">
                      <div class="col col-md-12">
                        <h3 class="panel-title"><?=$detail_asesor->users?></h3>
                      </div>
                     
                    </div>
                  </div>
                  <div class="panel-body">
                <table class="table">
                    <tr>
                        <td width="20%" rowspan="8" align="center"><img width="100px" src="<?php echo base_url()."assets/files/artikel/".$detail_asesor->foto_user ?>" class="img-responsive"></td>
                        <td>No Registrasi : </td>
                        <td><?php echo '<b>'.$detail_asesor->no_reg.'</b>' ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Menjadi Asesor : </td>
                        <td><?=$detail_asesor->tahun_menjadi_asesor?></td>
                    </tr>
                    <tr>
                        <td>Description Bidang Keahlian : </td>
                        <td><?=$detail_asesor->deskripsi_bidang_asesor?></td>
                    </tr>
                    <tr>
                        <td>Domisili : </td>
                        <td><?=$detail_asesor->alamat?></td>
                    </tr>
                   

                </table>
               

                <div class="contain">
              <ul id="tabStyle" class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#daftarLsp" role="tab" data-toggle="tab">KOMPETENSI TEKNIS</a></li>
                <li role="presentation"><a href="#JadwalLsp" role="tab" data-toggle="tab">SURAT TUGAS</a></li>
              </ul>

              <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="daftarLsp">
                  <ul class="bnspListing">
                  <?php
                    foreach ($kompetensi_teknis as $key => $value) {
                  ?>
                    <li><a href="<?=base_url().'sertifikasi/vskema_detail/1/'.$value->id_skema?>"><?=$value->skema?></a></li>
                  <?php } ?>
                  </ul>
                </div>
                <div role="tabpanel" class="tab-pane" id="JadwalLsp">
                  <ul class="jadwalListing">
                  <?php if(count($menguji) > 0){
                    echo'<table class="table table-striped table-bordered table-list">
                <tr><th>Nama Asesi</th><th>Skema Sertifikasi</th><th>Tanggal Registrasi</th></tr>';
                    foreach ($menguji as $keys => $values) {
                    echo'<tr><td>'.$values->nama_lengkap.'</td><td>'.$values->skema.'</td><td>'.tgl_indo($values->u_date_create).'</td><tr>';
                    }
                    echo'</table>';
                  }else{
                    echo"Belum ada data asesmen";
                  }
                  ?>
                  </ul>
                </div>
              </div>
            </div>
                  </div>
        <div class="col-md-3">
        </div>

        </div>
    

</div> <!-- class="col-md-9" style="background: white;padding: 5px;border-bottom: 0px solid #ccc;" -->

</div> <!-- class="container" style="margin-top: 15px;" -->

</div> <!-- class="row" -->

</div> <!-- class="pageSection container-fluid-full" -->