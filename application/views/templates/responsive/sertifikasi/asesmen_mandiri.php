
<link href="<?= base_url() ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" type="text/css"/>

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
                    <span>Sertifikasi</span>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Detail Sertifikasi</span>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Detail Asesmen Mandiri</span>
                </li>
            </ul>
            <div class="page-toolbar">
                <div><?= tgl_indo(date('Y-m-d')) ?>
                    <i class="icon-calendar"></i>&nbsp;
                    <span class="thin uppercase hidden-xs"></span>&nbsp;
                </div>
            </div>
        </div>

        <form method="POST" action="<?= base_url() . 'sertifikasi/save_mandiri' ?>">
            <div class="table-responsive col-md-12" style="margin-top: 10px;">
                <?= $table_asesmen_mandiri ?>
            </div>


            <div class="well"  style="background-color:#fff">Halaman asesmen mandiri adalah pengakuan dari Asesi atas kompetensi yang dimiliki. Sudah sesuai dengan Standar kompetensi yang ada di dalam Skema sertifikasi yang di ambil
                <br><input type="submit" value="Kirim Asesmen Mandiri" class="btn btn-primary" style="float: right"><br><br>
                <label style="font-size: 10px;color: red;float: right">Pastikan semua Kriteria unjuk kerja kompeten sesuai dengan bukti pendukung yang telah di upload</label>
            </div>

        </form>

        <script src="<?= base_url() ?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?= base_url() ?>assets/global/plugins/jquery-repeater/jquery.repeater.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?= base_url() ?>assets/pages/scripts/form-repeater.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?= base_url() ?>assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>

        <script type="text/javascript">
            $('#all_k').change(function () {
                $('#all_bk').attr('checked', false);
                $('.value_k').prop('checked', $(this).prop("checked"));
            })
            $('#all_bk').click(function () {
                $('#all_k').attr('checked', false);
                $('.value_bk').prop('checked', $(this).prop("checked"));
            })

//            $(".select2").select2({
//                placeholder: "Pilih Bukti Pendukung"
//            });
        </script>
