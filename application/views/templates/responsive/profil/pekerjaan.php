<link href="<?= base_url() ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<script src="<?= base_url() ?>assets/assets/datepicker.js"></script>

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
<!-- BEGIN CONTENT BODY -->
<div class="page-content">
<!-- BEGIN PAGE HEADER-->
<!-- BEGIN THEME PANEL -->

<!-- END THEME PANEL -->
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
<ul class="page-breadcrumb">
<li>
<a href="<?= base_url() ?>">Home</a>
<i class="fa fa-circle"></i>
</li>
<li>
<span>Profil</span>
<i class="fa fa-circle"></i>
</li>
<li>
<span>Pekerjaan</span>
</li>
</ul>
<div class="page-toolbar">
<div><?= tgl_indo(date('Y-m-d')) ?>
<i class="icon-calendar"></i>&nbsp;
<span class="thin uppercase hidden-xs"></span>&nbsp;
</div>
</div>
</div>

<div class="row" style="margin-top: 10px;">
<?php
if($this->session->flashdata('result')!=''){
?>
<div class="alert alert-<?=$this->session->flashdata('mode_alert')?>" role="alert"><?php echo $this->session->flashdata('result'); ?></div>
<?php
}
?>
<div class="portlet box green">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-gift"></i>Data Pekerjaan </div>

</div>

<div class="portlet-body form">
<div class="form-body">
    <div class="form-group">
        <form method="POST" action="<?= base_url() . 'profil/pekerjaan_update' ?>" class="mt-repeater form-horizontal">
            <h3 class="mt-repeater-title">Pengalaman Kerja</h3>
            <div style="clear: both;margin-bottom: 30px;"></div>

            <div class="col-md-3">Status Pekerjaan</div>
            <div class="col-md-9" style="margin-bottom: 5px;"><?php  echo form_dropdown('is_work', array(''=>'-Pilih','0' => 'Tidak Aktif', '1' => 'Masih Aktif Bekerja'), '', 'class="form-control classIsWork" id="classIsWork" ');  ?>
            </div>

            <div class="col-md-3">Jabatan</div>
            <div class="col-md-9" style="margin-bottom: 5px;"><input placeholder="Jabatan" type="text" name="nama_pekerjaan" class="form-control" />
            </div>

            <div class="col-md-3">Perusahaan</div>
            <div class="col-md-9" style="margin-bottom: 5px;"><input placeholder="Perusahaan / Lembaga" type="text" name="nama_perusahaan" class="form-control" />
            </div>

            <div class="col-md-3">Provinsi</div>
            <div class="col-md-9" style="margin-bottom: 5px;"><?php echo form_dropdown('id_provinsi', $provinsi, '', 'class="form-control"'); ?>
            </div>

            <div class="col-md-3">Rentang Bekerja</div>
            <div class="col-md-9" style="margin-bottom: 5px;"><input class="input-group form-control form-control-inline date date-picker" size="16" type="text"  name="tanggal_bergabung" data-date-format="dd/mm/yyyy" /> S/D <input id="tanggal_berhenti" class="input-group form-control form-control-inline date date-picker" size="16" type="text"  name="tanggal_berhenti" data-date-format="dd/mm/yyyy" />
            </div>

            <hr/>
            <button type="submit" class="btn green"><i class="fa fa-save"></i> TAMBAH PENGALAMAN KERJA</button>

          </form>

        </div>
      </div>
    </div>


                    </div>
                </div>


<!-- ___________________________________ data pekerjaan ___________________________________ -->

<div class="table-responsive">
  <table class="table table-striped table-bordered table-hover " >
    <thead>
      <tr>
        <th> Jabatan </th>
        <th> Status </th>
        <th> Perusahaan </th>
        <th> Provinsi </th>
        <th> Rentang Bekerja </th>
        <th>-</th>
      </tr>
    </thead>

    <tbody>

    <?php
      $status = array(''=>'-Pilih','0' => 'Tidak Aktif', '1' => 'Masih Aktif Bekerja');
      foreach ($pekerjaan as $key => $value) {
    ?>

    <tr>
      <td> <?= $value->nama_pekerjaan ?> </td>
      <td> <?= $status[$value->is_work] ?> </td>
      <td> <?= $value->nama_perusahaan ?> </td>
      <td> <?= $provinsi[$value->id_provinsi] ?> </td>
      <td>
        <?= tgl_indo($value->tanggal_bergabung) ?> S/D
        <?= tgl_indo($value->tanggal_berhenti) ?>
      </td>
      <td>

        <a
            href="javascript:;"
            data-id="<?php echo $value->id ?>"
            data-is_work="<?php echo $value->is_work ?>"
            data-nama_pekerjaan="<?php echo $value->nama_pekerjaan ?>"
            data-nama_perusahaan="<?php echo $value->nama_perusahaan ?>"
            data-id_provinsi="<?php echo $value->id_provinsi ?>"
            data-tanggal_bergabung="<?php echo $value->tanggal_bergabung ?>"
            data-tanggal_berhenti="<?php echo $value->tanggal_berhenti ?>"
            data-toggle="modal" data-target="#edit-data">
            <button  data-toggle="modal" data-target="#ubah-data" class="btn btn-info btn-sm">
              <i class="icon-pencil"></i>
            </button>
        </a>
        <a href="<?= base_url() . 'profil/hapus/' . $value->id ?>">
          <button type="button" class="btn btn-danger btn-sm"><i class="icon-ban"></i></button>
        </a>
      </td>
    </tr>

    <?php } ?>
    </tbody>

  </table>
</div>

                            <!-- Modal -->
                            <!-- <div id="myModal" class="modal fade" role="dialog" style="background-color:rgba(0,0,0, 0.4)"> -->
                              <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="edit-data" class="modal fade" style="background-color:rgba(0,0,0, 0.4)">
                              <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">UBAH PENGALAMAN KERJA</h4>
                                  </div>

                                  <form action="<?= base_url() . 'profil/pekerjaan_edit' ?>" method="post">
                                    <div class="modal-body">
                                      <div class="form-group">
                                        <label for="text">Status Pekerjaan:</label>
                                        <input type="hidden" id="id" name="id">
                                        <?php
                                          $acuan=$value->is_work;
                                          if ($acuan == '0') {
                                            $status_kerja="Tidak Aktif";
                                          }else {
                                            $status_kerja="Masih Aktif Bekerja";
                                          }

                                          echo form_dropdown('is_work', array($acuan=>$status_kerja,'0' => 'Tidak Aktif', '1' => 'Masih Aktif Bekerja'), '', 'class="form-control classIsWork" id="classIsWork" ');
                                        ?>
                                      </div>
                                      <div class="form-group">
                                        <label for="text">Jabatan:</label>
                                        <input type="text" class="form-control" name="nama_pekerjaan" id="nama_pekerjaan">
                                      </div>
                                      <div class="form-group">
                                        <label for="text">Perusahaan:</label>
                                        <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan">
                                      </div>
                                      <div class="form-group">
                                        <label for="text">Provinsi:</label>
                                        <?php echo form_dropdown('id_provinsi', $provinsi, '', 'class="form-control" id="id_provinsi"'); ?>
                                      </div>
                                      <div class="form-group">
                                        <label for="text">Rentang Bekerja:</label>
                                        <input class="input-group form-control form-control-inline date date-picker" size="16" type="text" id="tanggal_bergabung" name="tanggal_bergabung" data-date-format="dd/mm/yyyy" />
                                        S/D
                                        <input id="tanggal_berhenti" class="input-group form-control form-control-inline date date-picker" size="16" type="text"  name="tanggal_berhenti" data-date-format="dd/mm/yyyy" />
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="submit" class="btn btn-primary">Simpan</button>
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                  </form>

                                </div>

                              </div>
                            </div>

                <script>
                   $(function () {
                    $(".date-picker").datepicker({
                        format: 'dd/mm/yyyy',

                    });
                })
            </script>

            <!-- BEGIN PAGE LEVEL PLUGINS -->
            <script src="<?= base_url() ?>assets/global/plugins/jquery-repeater/jquery.repeater.js" type="text/javascript"></script>
            <script src="<?= base_url() ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
            <script src="<?= base_url() ?>assets/pages/scripts/form-repeater.min.js" type="text/javascript"></script>
            <script src="<?= base_url() ?>assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>


            <script>
                $(function () {
                    $(".date-picker").datepicker({
                        format: 'yyyy-mm-dd',

                    });
                    $("#classIsWork").change(function () {
                        //alert('ok');
                        //var idElement = $(this).attr('name');
                        //alert(idElement);
                        //var idElement = $(this).attr('id');
                         //$('#tanggal'+idElement).attr('disabled','disabled');
                        var end = this.value;
                        if(end == '1'){
                            $('#tanggal_berhenti').attr('disabled','disabled');
                        }else{
                            $('#tanggal_berhenti').removeAttr('disabled');
                        }
                    });
                 //   $('.classIsWork').onCha
                })
                function ssetTanggal(){
                    var idElement = $(this).attr('name');
                    alert(idElement);
                }

                $(document).ready(function() {
                    // Untuk sunting
                    $('#edit-data').on('show.bs.modal', function (event) {
                        var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
                        var modal          = $(this)

                        // Isi nilai pada field
                        modal.find('#id').attr("value",div.data('id'));
                        modal.find('#is_work').attr("value",div.data('is_work'));
                        modal.find('#nama_pekerjaan').attr("value",div.data('nama_pekerjaan'));
                        modal.find('#nama_perusahaan').attr("value",div.data('nama_perusahaan'));
                        modal.find('#id_provinsi').attr("value",div.data('id_provinsi'));
                        modal.find('#tanggal_bergabung').attr("value",div.data('tanggal_bergabung'));
                        modal.find('#tanggal_berhenti').attr("value",div.data('tanggal_berhenti'));
                    });
                });
            </script>
