<link href="<?=base_url()?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />

        <div class="page-container">
                <!-- BEGIN SIDEBAR -->
                <div class="page-sidebar-wrapper">
                     <div class="page-sidebar navbar-collapse collapse">
                       <?php $this->load->view('templates/responsive/menu');?>
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
                                    <a href="<?= base_url() ?>">Home</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                <li>
                                    <span>Notifikasi</span>
                                </li>

                            </ul>
                            <div class="page-toolbar">
                                <div><?=tgl_indo(date('Y-m-d'))?>
                                    <i class="icon-calendar"></i>&nbsp;
                                    <span class="thin uppercase hidden-xs"></span>&nbsp;
                                </div>
                            </div>
                        </div>


<div class="row" style="margin-top: 10px;">
<div class="col-md-12" style="background-color: white;padding-top: 10px;padding-bottom: 10px;width: 96%;margin-left: 15px;padding-left: 2px;padding-right: 2px"><?php
            if($this->session->flashdata('result')!=''){
        ?>
        <div class="alert alert-<?=$this->session->flashdata('mode_alert')?>" role="alert"><?php echo $this->session->flashdata('result'); ?></div>
        <?php
        }
        ?>
 </div>
