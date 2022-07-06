<style>
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
<div class="container" style="margin-top: 15px;">
<div class="col-md-12" style="background: white;padding: 5px;border-bottom: 0px solid #ccc;">
<ol class="breadcrumb" style="margin-bottom: 5px;">
  <li><a href="<?=base_url()?>"><em class="fa fa-home"></em></a></li>
  <li><a href="<?=base_url().'sertifikasi/vskema/0'?>">TUK</a></li>
  <li class="active"><?=$tempat_uji->tuk?></li>
</ol>
<div class="col-md-12 well">
    <div class="col-md-2" style="text-align: right;"><b>Kode TUK :</b></div><div style="text-align: left;" class="col-md-10"><?=$tempat_uji->no_cab?></div>
    <div class="col-md-2" style="text-align: right;"><b>Nama TUK :</b></div><div style="text-align: left;" class="col-md-10"><?=$tempat_uji->tuk?></div>
    <div class="col-md-2" style="text-align: right;"><b>Alamat :</b></div><div style="text-align: left;" class="col-md-10"><?=$tempat_uji->alamat?></div>
    <div class="col-md-2" style="text-align: right;"><b>Provinsi :</b></div><div style="text-align: left;" class="col-md-10"><?=$tempat_uji->provinsi?></div>
    <div class="col-md-2" style="text-align: right;"><b>Kabupaten :</b></div><div style="text-align: left;" class="col-md-10"><?=$tempat_uji->kabupaten?></div>


    
    
</div>
    <div class="bannerPage img-thumbnail">
    <iframe
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15830.334816342243!2d112.75547482042941!3d-7.288113931403205!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fa36cd34ba1b%3A0x4c46a494dfb6d413!2sLembaga+Sertifikasi+Profesi+Chospa!5e0!3m2!1sen!2s!4v1463371565635" 
      width="100%" 
      height="200px" 
      frameborder="0" 
      style="border:0">
     </iframe>
  </div>
</div>
</div>
</div>