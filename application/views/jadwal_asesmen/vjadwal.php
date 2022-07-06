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

  <section class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li><a href="<?=base_url()?>">Home</a></li>
                    <li class="active">Sertifikasi</li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h1>JADWAL ASESMEN</h1>
                </div>
            </div>
        </div>
    </section>

<div class="container" style="margin-top: 15px;">
<div class="col-md-12" style="background: white;padding: 5px;border-bottom: 0px solid #ccc;">

<!-- <ol class="breadcrumb" style="margin-bottom: 5px; background-color: #00AEEF;">
  <li><a href="<?=base_url()?>">Home</a></li>
  <li style="color:white;">Jadwal Uji Kompetensi</li>
</ol> -->

    <div class="panel panel-default panel-table">
              <div class="panel-heading">
                <div class="row">
                  <div class="col col-md-7">
                    <h3 class="panel-title">Daftar Jadwal Uji Kompetensi <?=$aplikasi->singkatan_unit?></h3>
                  </div>
                  <div class="col col-md-5 text-right">
                    <form action="" class="search-form" method="GET">
                        <div class="form-group has-feedback">
                    		<label for="search" class="sr-only">Search</label>
                    		<input type="text" class="form-control" name="keyword" id="keyword" placeholder="Cari berdasarkan nama jadwal">
                      		<span class="glyphicon glyphicon-search form-control-feedback"></span>
                    	</div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="panel-body">
                <table class="table table-striped table-bordered table-list">
                  <thead>
                    <tr>
                        <th style="width: 5%;"><em class="fa fa-cog"></em></th>
                        <th style="width: 32%;">Nama Jadwal</th>
                        <th style="width: 28%;">Tanggal Pelaksanaan</th>
                        <th style="width: 35%;">Persyaratan</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php if($data): ?>
                  <?php                    
                    foreach($data as $key=>$value){?>
                      <tr>
                        <td align="center">
                          <a href="<?=base_url().'welcome/uji_kompetensi'?>" class="btn btn-default btn-xs"><em class="fa fa-search"></em></a>

                        </td>
                        <td><?=$value->jadual?></td>
                        <td><?=tgl_indo($value->tanggal).' s/d '.tgl_indo($value->tanggal_akhir)?></td>
                        <td><?=$value->persyaratan?></td>
                      </tr>
                 <?php
                    }
                 ?>
                 <?php else: ?>
                   <tr>
                     <td colspan="4" class="text-center">Belum ada jadwal.</td>
                   </tr>
                 <?php endif; ?>
                    </tbody>
                </table>

              </div>
              <div class="col-md-3">

    </div>
    <div class="col-md-9">
        <div class="halaman">
            <ul class="pager">
                <li class="previous">
                    Halaman :<?php echo rtrim($halaman)."/ <b>".ceil($jmldata/10)." dari ".$jmldata." Jadwal</b>";?>
                </li>
            </ul>
        </div>
    </div>
            </div>
</div>
</div>
