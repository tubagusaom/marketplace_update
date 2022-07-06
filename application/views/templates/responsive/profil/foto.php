<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?= base_url() ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL STYLES -->
<link href="<?= base_url() ?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
<link href="<?= base_url() ?>assets/pages/css/profile-2.min.css" rel="stylesheet" type="text/css" />




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
                    <span>Pasfoto</span>
                </li>
            </ul>
            <div class="page-toolbar">
                <div><?= tgl_indo(date('Y-m-d')) ?>
                    <i class="icon-calendar"></i>&nbsp;
                    <span class="thin uppercase hidden-xs"></span>&nbsp;
                </div>
            </div>
        </div>


        <div class="tab-pane" id="tab_1_3" style="margin-top: 10px">
            <div class="row profile-account">
                <div class="col-md-9">
                    <form action="<?= base_url() . 'profil/photo_update' ?>" role="form" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                    <img src="<?= base_url() . 'repo/profil/' . $biodata->foto_profil ?>" alt="" /> </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                <div>
                                    <span class="btn default btn-file">
                                        <span class="fileinput-new"> Select image </span>
                                        <span class="fileinput-exists"> Change </span>
                                        <input type="file" name="foto_profil"> </span>
                                    <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                </div>
                            </div>
                            <div class="clearfix margin-top-10">
                                <span class="label label-danger"> NOTE! </span>
                                <span> Unggah Pasfoto anda. Dengan ukuran <b>3 X 4 cm</b> atau <b>354 X 472 pixel</b>. </span>
                            </div>
                        </div>
                        <div class="margin-top-10">
                            <input type="submit" class="btn green" value="Unggah Foto">
                            <a href="javascript:;" class="btn default"> Cancel </a>
                        </div>
                    </form>
                </div>
                <!--end col-md-9s-->
            </div>
        </div>
        <script src="<?= base_url() ?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?= base_url() ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
