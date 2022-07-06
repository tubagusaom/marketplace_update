<style>
.nav-sidebar { 
    width: 100%;
    padding: 8px 0; 
    border-right: 1px solid #ddd;
}
.nav-sidebar a {
    color: #333;
    -webkit-transition: all 0.08s linear;
    -moz-transition: all 0.08s linear;
    -o-transition: all 0.08s linear;
    transition: all 0.08s linear;
    border-radius: 0; 
}
.nav-sidebar .active a { 
    cursor: default;
    background-color: #428bca; 
    color: #fff;
    text-shadow: 1px 1px 1px #666; 
}
.nav-sidebar .active a:hover {
    background-color: #428bca;   
}
.nav-sidebar .text-overflow a,
.nav-sidebar .text-overflow .media-body {
    white-space: nowrap;
    overflow: hidden;
    -o-text-overflow: ellipsis;
    text-overflow: ellipsis; 
}
.box-categories .fa-ul > li > * {
    line-height: inherit;
    margin: 0;
}
</style>
<div class="pageSection container-fluid-full">
	<div class="bannerPage container">
		<img class="img-thumbnail" src="<?=base_url().'assets/img/spa2.jpg'?>">
	</div>
	<div class="container" style="margin-top: 15px;"></div>
	<div class="bannerPage container">
		 <div class="col-md-12 well" style="background-color: #FFFFFF;">
    <div class="col-md-2">
        <?php
            $this->load->view('templates/bootstraps/left_menu');
        ?>
    </div>
    <div class="col-md-10">
        <div class="col-md-12">
       	<ol class="breadcrumb well well-sm">
    		<li><a href="<?=base_url()?>">Home</a></li>
    		<li class="active">Frequently Asked Questions</li>
    	</ol>
        </div>
        <div class="col-md-12">
             <h3>Frequently asked questions(FAQ)</h3>
            <div class="panel-group" id="accordion">
                <?php 
                    $no=1;
                    foreach($faq as $key=>$faqx){
                        if($key == 0){
                            $in = 'in';
                        }else{
                            $in = '';
                        }
                ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $no;?>"><span class="glyphicon glyphicon-film">
                            </span> <?php echo $faqx->pertanyaan;?></a>
                        </h4>
                    </div>
                    <div id="collapse<?php echo $no;?>" class="panel-collapse collapse <?=$in?>">
                        <div class="panel-body">
                            <?php echo $faqx->jawaban;?>
                        </div>
                    </div>
                </div>
                <?php $no++; } ?>
            </div>
           
        </div>
    </div>
	</div>
</div>
	