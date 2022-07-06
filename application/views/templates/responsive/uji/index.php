<link href="<?= base_url() ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />

<style>
    .carousel-indicators .active{ background: #31708f; } .content{ margin-top:20px; } 
    .adjust1{ float:left; width:100%; margin-bottom:0; } 
    .adjust2{ margin:0; } .carousel-indicators li{ border :1px solid #ccc; } 
    .carousel-control{ color:#31708f; width:5%; } 
    .carousel-control:hover, .carousel-control:focus{ color:#31708f; } 
    .carousel-control.left, .carousel-control.right { background-image: none; } 
    .media-object{ margin:auto; margin-top:15%; } 
    @media screen and (max-width: 768px) { .media-object{ margin-top:0; } }
</style>

<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">
        <div class="page-sidebar navbar-collapse collapse">
            <?php $this->load->view('templates/responsive/menu'); ?>
            <!-- END SIDEBAR MENU -->
            <!-- END SIDEBAR MENU -->
        </div>
        <!-- END SIDEBAR -->
    </div>
    <!-- END SIDEBAR -->
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
                        <a href="<?= base_url(); ?>">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Uji</span>
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
                    <style type="text/css">
                        .required_span{
                            color: red;
                            font-weight: bold;
                        }
                    </style>

                    <div class="col-md-12 col-xs-12 table-responsive">
                        <h2>UJI KOMPETENSI ONLINE LSP TRAINER INDONESIA</h2>
                        <div class="col-md-2 col-xs-8">Skema Sertifikasi </div>
                        <div class="col-md-6 col-xs-12">: Membuat Materi Pelatihan</div>
                        <div class="clearfix"></div>

                        <div class="col-md-2 col-xs-8">Jenis Perangkat Uji </div>
                        <div class="col-md-6 col-xs-12">: Pilihan Ganda</div>
                        <div class="clearfix"></div>

                        <div class="col-md-2 col-xs-8">Jumlah Soal </div>
                        <div class="col-md-6 col-xs-12">: 50</div>
                        <div class="clearfix"></div>

                        <div class="col-md-2 col-xs-8">Waktu </div>
                        <div class="col-md-6 col-xs-12">: 60 Menit</div>
                        <div class="col-md-3 col-xs-12" style="font-weight:bold;text-align: right;">Nama : Roy Buana</div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                    <hr style="border:1px solid #000;"/>

                    <div class="col-md-12 col-xs-12" id="startUji">
                        <button type="button" id="mulaiUji" class="btn btn-success col-md-12 col-xs-12">Mulai Uji</button>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?= base_url() ?>assets/global/plugins/jquery-repeater/jquery.repeater.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?= base_url() ?>assets/global/scripts/app.min.js" type="text/javascript"></script>

<script src="<?= base_url() ?>assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>

<script type="text/javascript">

$("#mulaiUji").click(function(){
    $("#startUji").empty();
    
    var urlUji = "<?=base_url();?>uji/view";
    $("#startUji").load(urlUji);
    return false;
})

</script>