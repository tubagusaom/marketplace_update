<style>
    .asterisk{
        font-weight: bold;
        color: red;
    }
    .TeBe{
      cursor: help;
    }
</style>

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
                    <span>Jadwal</span>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Pendaftaran</span>
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
            if ($this->session->flashdata('result') != '') {
                ?>
                <div class="alert alert-<?= $this->session->flashdata('mode_alert') ?>" role="alert"><?php echo $this->session->flashdata('result'); ?></div>
                <?php
            }
            ?>


            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form action="<?= base_url() . 'detail_pendukung/edit_bukti_pendukung' ?>" method="POST" class="form-horizontal form-bordered form-row-stripped" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?=$id?>">
                    <div class="form-body">

                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation">
                              <a><b>Detail Bukti Pendukung</b></a>
                            </li>
                        </ul>
                                <?php foreach ($data['syarat_skema'] as $key => $value) {
                                    ?>
                                    <div class="form-group">
                                        <label class="control-labelx col-md-3"><?= $jenis_bukti[$value->jenis_bukti]; ?> <span class="asterisk">*</span></label>
                                        <div class="col-md-9 ">
                                            <input type="hidden" name="nama_dokumen[]" value="<?= $value->jenis_bukti ?>"/>

                    <!-- <input type="file" name="file_data[]" class="form-control" required />-->


                                            <select id="mySelect" name="file_data[]" class="form-control databukti TeBe" required oninvalid="this.setCustomValidity('Mohon pilih salah satu')" oninput="setCustomValidity('')" data-toggle="tooltip" title="Pilih dokumen yang berbeda !">

                                                <?php
                                                foreach ($trepositori as $keys => $repo) {
                                                    if($repo->jenis_portofolio == $value->jenis_bukti){

                                                        if($repo->id == $array_portofolio[$key]){
                                                            $selected="selected";
                                                        }else{
                                                            $selected="";
                                                        }
                                                        echo '<option value='.$repo->id.' '.$selected.'>'.$repo->nama_dokumen.'</option>';
                                                    }
                                                }
                                                ?>
                                            </select>

                                        </div>
                                    </div>
                                <?php } ?>
                                <?php
                                  echo '<button type="submit" name="btn_addmore" id="btn_addmore" class="btn btn-info pull-right" style="margin-right: 20px; display:none;">Update Dokumen</button>';
                                ?>
                                <button type="submit" name="btn_addmore" id="btn_addmore" class="btn btn-info pull-right" style="margin-right: 20px;">Update Dokumen</button>
                                <div style="clear:both;margin-bottom: 20px;"></div>
                            </div>
                        </div>


                </form>
                <!-- END FORM-->
            </div>
        </div>
    </div>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
