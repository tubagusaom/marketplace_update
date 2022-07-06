<?php
    //var_dump($value); die();
?>

<style>
.modal-open{overflow:hidden}
.modal{display:none;overflow:hidden;position:fixed;top:60px;right:0;bottom:0;left:0;z-index:1050;-webkit-overflow-scrolling:touch;outline:0}
.modal.fade .modal-dialog{-webkit-transform:translate(0, -25%);-ms-transform:translate(0, -25%);-o-transform:translate(0, -25%);transform:translate(0, -25%);-webkit-transition:-webkit-transform 0.3s ease-out;-o-transition:-o-transform 0.3s ease-out;transition:transform 0.3s ease-out}
.modal.in .modal-dialog{-webkit-transform:translate(0, 0);-ms-transform:translate(0, 0);-o-transform:translate(0, 0);transform:translate(0, 0)}
.modal-open .modal{overflow-x:hidden;overflow-y:auto}
.modal-dialog{position:relative;width:auto;margin:10px}
.modal-content{position:relative;background-color:#1e1e1e;border:1px solid #131313;border:1px solid rgba(0,0,0,0.2);border-radius:6px;-webkit-box-shadow:0 3px 9px rgba(0,0,0,0.5);box-shadow:0 3px 9px rgba(0,0,0,0.5);-webkit-background-clip:padding-box;background-clip:padding-box;outline:0}
.modal-backdrop{position:fixed;top:0;right:0;bottom:0;left:0;z-index:1040;background-color:#000} .modal-backdrop.fade{opacity:0;filter:alpha(opacity=0)}
.modal-backdrop.in{opacity:.5;filter:alpha(opacity=50)}
.modal-header{padding:15px;border-bottom:1px solid #e5e5e5;min-height:16.42857143px}
.modal-header .close{margin-top:-2px}.modal-title{margin:0;line-height:1.42857143}
.modal-body{position:relative;padding:15px}
.modal-footer{padding:15px;text-align:right;border-top:1px solid #e5e5e5}
.modal-footer .btn+.btn{margin-left:5px;margin-bottom:0}
.modal-footer .btn-group .btn+.btn{margin-left:-1px}
.modal-footer .btn-block+.btn-block{margin-left:0}
.modal-scrollbar-measure{position:absolute;top:-9999px;width:50px;height:50px;overflow:scroll}
@media (min-width:768px){
.modal-dialog{width:500px;margin:30px auto}
.modal-content{-webkit-box-shadow:0 5px 15px rgba(0,0,0,0.5);box-shadow:0 5px 15px rgba(0,0,0,0.5)}
.modal-sm{width:300px}}
@media (min-width:992px){
.modal-lg{width:900px}}

/* untuk menghilangkan list style dan pointer pada img */
ul {
padding:0 0 0 0;
margin:0 0 0 0;
}
ul li {
list-style:none;

}
ul li img {
cursor: pointer;
}

/* Untuk style next dan prev button */
.controls{
width:50px;
display:block;
font-size:11px;
padding-top:8px;
font-weight:bold; 
}
.next {
float:right;
text-align:right;
}

</style>

<div class="content fadeInRight">
<ul class="item">
    
    <div id="partnerSlider" class="owl-carousel owl-theme">
    <?php  
        foreach($value as $row){
    ?>
    <li class="col-lg-20 col-md-20 col-sm-30 col-xs-40 thumbnail" style="margin: 5px;">
        <img src="<?php echo base_url()."uploads/gallery/".$row->foto ?>" alt="slide01" class="img-responsive"/>
    </li>
    <?php } ?>
   
    </div>
</ul>
</div>

<!-- bootstrap modal -->
<div class="modal fade" id="KutubaruModal" tabindex="-1" role="dialog" aria-labelledby="KutubaruModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-body">
</div>
</div><!-- modal-content -->
</div><!-- modal-dialog -->
</div><!-- modal -->
