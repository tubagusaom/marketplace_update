<?php
    //var_dump($value); die;
?>
    <!-- END NAVIGATION -->
<?php $this->load->view('templates/bootstraps/header'); ?>
    <div class="mainContent">
    
        <section id="welcomeSite" class="container">
            <div class="col-sm-8 content">
                <?php  foreach($value as $row){ ?>
                    <h3><p class="text-justify"><?php echo $row->judul ?></p></h3> 
                    <br />
                    <p class="text-justify">
                        <img src="<?php echo base_url().'uploads/slide/'.$row->foto ?>" />
                    </p>
                    <p class="text-justify"><?php echo $row->headline ?></p>
                    <p class="text-justify"><?php echo $row->isi ?>
                    </p>
                <?php } ?>
            </div>
            <div class="col-sm-4 content">
                <?php $this->load->view('templates/bootstraps/sidebar'); ?>
            </div>
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
