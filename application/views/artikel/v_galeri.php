<?php
    //var_dump($value); die;
?>

<?php $this->load->view('templates/bootstraps/header'); ?>
    <div class="mainContent">
    
        <section id="welcomeSite" class="container">
        <h3 style="padding-left: 50px;"><p class="text-justify">Galeri Foto LSP</p></h3> 
            <div class="col-sm-8 content">
                <?php $this->load->view('artikel/detail_galeri'); ?>
            </div><!--close col-sm-8-->
            
            <div class="col-sm-4 content">
                <?php $this->load->view('templates/bootstraps/sidebar'); ?>
            </div><!--close col-sm-4-->
        </section>
      
    <section id="contactUs" class="container-fluid">
      <div class="row greyOverlayBox">
        <h3 class="text-center">CONTACT US</h3>
          <p class="text-center">Rukan Gading Bukit Indah Blok U No.7</p>
          <p class="text-center">Jl. Bukit Gading Raya, DKI Jakarta</p>

          <form class="form-horizontal container" style="width:70%;margin-top:30px;">
            <div class="form-group">
              <div class="col-sm-6">
                <input type="name" class="form-control" placeholder="Full Name"/>
              </div>
              <div class="col-sm-6">
                <input type="address" class="form-control" placeholder="Home Address"/>
              </div>          
            </div>
            <div class="form-group">
              <div class="col-sm-6">
                <input type="email" class="form-control" placeholder="Email"/>
              </div>
              <div class="col-sm-6">
                <input type="phone" class="form-control" placeholder="Phone Number"/>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <textarea type="message" rows="7" class="form-control" placeholder="Message"></textarea>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12 text-center">
                <button type="submit" class="btn btnSubmit">SEND MESSAGE</button>
              </div>
            </div>
          </form>
      </div>
    </section>

    </div>
<?php $this->load->view('templates/bootstraps/footer'); ?>

<script>
    //===============http://kutubaru.blogspot.co.id/2015/03/responsive-photo-galeri-bootstrap.html=======
    // Untuk menjalankan lightbox atau modal
    $(document).ready(function(){
    $('li img').on('click',function(){
    var src = $(this).attr('src');
    var img = '<img src="' + src + '" class="img-responsive"/>';
    
    //Show
    var index = $(this).parent('li').index();
    
    var html = '';
    html += img;
    html += '<div style="height:25px;clear:both;display:block;">';
    html += '<a class="controls next" href="'+ (index+2) + '">next &raquo;</a>';
    html += '<a class="controls previous" href="' + (index) + '">&laquo; prev</a>';
    html += '</div>';
    
    $('#KutubaruModal').modal();
    $('#KutubaruModal').on('shown.bs.modal', function(){
    $('#KutubaruModal .modal-body').html(html);
    
    //new code
    $('a.controls').trigger('click');
    })
    $('#KutubaruModal').on('hidden.bs.modal', function(){
    $('#KutubaruModal .modal-body').html('');
    });
    });
    })
    
    //button controls
    $(document).on('click', 'a.controls', function(){
    var index = $(this).attr('href');
    var src = $('ul.row li:nth-child('+ index +') img').attr('src');
    $('.modal-body img').attr('src', src);
    var newPrevIndex = parseInt(index) - 1;
    var newNextIndex = parseInt(newPrevIndex) + 2;
    if($(this).hasClass('previous')){
    $(this).attr('href', newPrevIndex);
    $('a.next').attr('href', newNextIndex);
    }else{
    $(this).attr('href', newNextIndex);
    $('a.previous').attr('href', newPrevIndex);
    }
    var total = $('ul.row li').length + 1;
    
    //hide next button
    if(total === newNextIndex){
    $('a.next').hide();
    }else{
    $('a.next').show()
    }
    
    //hide previous button
    if(newPrevIndex === 0){
    $('a.previous').hide();
    }else{
    $('a.previous').show()
    }
    return false;
    });
</script>
