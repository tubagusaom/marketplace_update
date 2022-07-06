<div class="panel-group" id="accordion">
<div class="panel panel-default">
<div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="glyphicon glyphicon-folder-close">
                                </span> Informasi</a>
                        </h4>
                    </div>
<nav class="nav-sidebar" style="margin-top: 0px;">
    <ul class="nav">
       <!-- <li class="<?php //echo isset($class_active) && $class_active=='home'?'active':''; ?>"><a href="<?//=base_url()?>">Home</a></li>-->
        <li class="<?php echo isset($class_active) && $class_active=='tutorial'?'active':''; ?>"><a href="<?=base_url().'knowledge_base/view'?>">Tutorial</a></li>
        <li class="<?php echo isset($class_active) && $class_active=='kontak'?'active':''; ?>"><a href="<?=base_url().'welcome/kontak'?>">Kontak</a></li>
        <li class="<?php echo isset($class_active) && $class_active=='faq'?'active':''; ?>"><a href="<?=base_url().'welcome/faq'?>">FAQ</a></li>
        <!--<li class="<?php //echo isset($class_active) && $class_active=='uji_kompetensi'?'active':''; ?>"><a href="<?//=base_url().'welcome/uji_kompetensi'?>">Uji Kompetensi</a></li>-->
        <li><a href="#" target="_blank">Website</a></li>
        <li class="<?php echo isset($class_active) && $class_active=='link_terkait'?'active':''; ?>"><a href="<?=base_url().'welcome/link_terkait'?>"  >Link Terkait</a></li>
        <li class="nav-divider"></li>
        <li><a href="javascript:;"><i class="fa fa-list fa-xs"></i> Forum</a></li>
        <li><a href="javascript:;"><i class="fa fa-list fa-xs"></i> Industri Terkait</a></li>
    </ul>
</nav>
</div>
</div>