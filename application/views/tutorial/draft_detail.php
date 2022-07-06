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
<div class="container">
	<div class="row">
    <div class="col-md-2">
        <?php
            $this->load->view('templates/bootstraps/left_menu');
        ?>
    </div>
    <div class="col-md-10" style="padding-top: 15px;">
    <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="<?=base_url()?>">Home</a></li>
                    <li><a href="<?=base_url().'knowledge_base/view'?>">Tutorial</a></li>
                    <li class="active"><?=$rows_category[0]['kbc_id']?></li>
                </ol>
                </div>
            <div class="col-md-12">
                <section class="box-categories well">
                    <h1 class="section-title h5 clearfix">
                    <i class="line"></i>
                    <i class="fa fa-folder-open-o fa-fw text-muted"></i>
                    <small class="pull-right">
                    <i class="fa fa-hdd-o fa-fw"></i>
                    <?=count($rows_category)?>
                    </small>
                    <?=$rows_category[0]['kbc_id']?>
                    </h1>
                    <ul class="fa-ul">
                        <?php foreach ($rows_category as $key => $value) {
                        ?>
                        <li>
                        <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                        <h3 class="h5">
                        <a href="<?=base_url().'knowledge_base/detail/'.$value['id']?>"><?=$value['title']?></a>
                        </h3>
                        <?=$value['summary']?>
                        </li>
                        <?php } ?>
                       
                    
                </section>
            </div>  
	       
            
    </div>
	</div>
</div>