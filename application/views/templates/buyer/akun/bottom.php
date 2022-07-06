<style media="screen">
body{
  padding-bottom: 80px;
}
#footer {
 position:fixed;
 bottom:0;
 width:100%;
 z-index: 5;
 padding-top: 15px;
}
</style>

<!-- <footer id="footer">
  <div class="container">
    <div class="row">
      <div class="footer-ribbon">
        <span><?=$aplikasi->singkatan_unit?></span>
      </div>

      <div class="col-md-3">
        <h4>My Account</h4>
        <ul class="links">
          <li>
            <i class="fa fa-caret-right text-color-primary"></i>
            <a href="demo-shop-8-about-us.html">About Us</a>
          </li>
          <li>
            <i class="fa fa-caret-right text-color-primary"></i>
            <a href="demo-shop-8-contact-us.html">Contact Us</a>
          </li>
          <li>
            <i class="fa fa-caret-right text-color-primary"></i>
            <a href="demo-shop-8-myaccount.html">My account</a>
          </li>
          <li>
            <i class="fa fa-caret-right text-color-primary"></i>
            <a href="#">Orders history</a>
          </li>
          <li>
            <i class="fa fa-caret-right text-color-primary"></i>
            <a href="#">Advanced search</a>
          </li>
        </ul>
      </div>
      <div class="col-md-3">
        <div class="contact-details">
          <h4>Contact Information</h4>
          <ul class="contact">
            <li><p><i class="fa fa-map-marker"></i> <strong>Address:</strong><br> <?=$aplikasi->alamat?></p></li>
            <li><p><i class="fa fa-phone"></i> <strong>Phone:</strong><br> <?=$aplikasi->no_telpon?></p></li>
            <li><p><i class="fa fa-envelope-o"></i> <strong>Email:</strong><br> <a href="<?=$aplikasi->alamat_email?>"><?=$aplikasi->alamat_email?></a></p></li>
            <li><p><i class="fa fa-clock-o"></i> <strong>Working Days/Hours:</strong><br> Mon - Sun / 9:00AM - 8:00PM</p></li>
          </ul>
        </div>
      </div>
      <div class="col-md-3">
        <h4>Main Features</h4>
        <ul class="features">
          <li>
            <i class="fa fa-check text-color-primary"></i>
            <a href="#">Super Fast Template</a>
          </li>
          <li>
            <i class="fa fa-check text-color-primary"></i>
            <a href="#">1st Seller Template</a>
          </li>
          <li>
            <i class="fa fa-check text-color-primary"></i>
            <a href="#">19 Unique Shop Layouts</a>
          </li>
          <li>
            <i class="fa fa-check text-color-primary"></i>
            <a href="#">Powerful Template Features</a>
          </li>
          <li>
            <i class="fa fa-check text-color-primary"></i>
            <a href="#">Mobile &amp; Retina Optimized</a>
          </li>
        </ul>
      </div>

      <div class="col-md-3">

        <div class="newsletter">
          <h4>Be the First to Know</h4>
          <p class="newsletter-info">Get all the latest information on Events,<br> Sales and Offers. Sign up for newsletter today.</p>

          <div class="alert alert-success hidden" id="newsletterSuccess">
            <strong>Success!</strong> You've been added to our email list.
          </div>

          <div class="alert alert-danger hidden" id="newsletterError"></div>


          <p>Enter your e-mail Address:</p>
          <form id="newsletterForm" action="../php/newsletter-subscribe.php" method="POST">
            <div class="input-group">
              <input class="form-control" placeholder="Email Address" name="newsletterEmail" id="newsletterEmail" type="text">
              <span class="input-group-btn">
                <button class="btn btn-primary" type="submit">Submit</button>
              </span>
            </div>
          </form>
        </div>

        <div class="newsletter">
          <h4>Be the First to Know</h4>
          <p class="newsletter-info">Get all the latest information on Events,<br> Sales and Offers. Sign up for newsletter today.</p>

          <div class="alert alert-success hidden" id="newsletterSuccess">
            <strong>Success!</strong> You've been added to our email list.
          </div>

          <div class="alert alert-danger hidden" id="newsletterError"></div>


          <p>Enter your e-mail Address:</p>
          <form id="newsletterForm" action="../php/newsletter-subscribe.php" method="POST">
            <div class="input-group">
              <input class="form-control" placeholder="Email Address" name="newsletterEmail" id="newsletterEmail" type="text">
              <span class="input-group-btn">
                <button class="btn btn-primary" type="submit">Submit</button>
              </span>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>



  <div class="footer-copyright">
    <div class="container">
      <a href="<?=base_url()?>" class="logo">
        <img alt="Porto Website Template" class="img-responsive" src="<?=base_url()?>assets/img/demos/logo-footer.png">
      </a>
      <ul class="social-icons">
        <li class="social-icons-facebook"><a href="http://www.facebook.com/" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
        <li class="social-icons-twitter"><a href="http://www.twitter.com/" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
        <li class="social-icons-linkedin"><a href="http://www.linkedin.com/" target="_blank" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
      </ul>
      <img alt="Payments" src="<?=base_url()?>assets/img/demos/payments.png" class="footer-payment">
      <p class="copyright-text">© Copyright 2021. All Rights Reserved.</p>
    </div>
  </div>
</footer> -->

<footer id="footer">
  <!-- <div class="homepage-bar"> -->
    <div class="container">
      <!-- <div class="footer-ribbon">
        <span><?=$aplikasi->singkatan_unit?></span>
      </div> -->
      <div class="row">
        <!-- <div class="col col-md-4 col-sm-4"> -->
          <!-- <?=$aplikasi->singkatan_unit?> -->
          <!-- <img src="<?=base_url()?>assets/img/homedepo_icon.jpg" alt="homedepo" style="width:25px;"> -->
          <!-- <a href="https://www.homedepo.co.id/" style="font-size:11px;">
            &nbsp; <?=$aplikasi->singkatan_unit?>
          </a> -->
        <!-- </div> -->

        <!-- <div class="col col-md-8 col-sm-8 text-right"> -->
          <!-- © Copyright 2022. All Rights Reserved. -->
        <!-- </div> -->
        <p class="copyright-text pull-right" style="padding-right:15px;">
          ©Copyright <a href="https://www.homedepo.co.id/" target="_blank"><?=$aplikasi->singkatan_unit?></a> 2022
          <!-- . All Rights Reserved. -->
        </p>
      </div>
    </div>
  <!-- </div> -->
</footer>

</div>


<!-- Vendor -->
<script src="<?php echo base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/jquery.appear/jquery.appear.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/jquery-cookie/jquery-cookie.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/common/common.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/jquery.validation/jquery.validation.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/jquery.gmap/jquery.gmap.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/jquery.lazyload/jquery.lazyload.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/isotope/jquery.isotope.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/vide/vide.min.js"></script>

<!-- Theme Base, Components and Settings -->
<script src="<?php echo base_url() ?>assets/js/theme.js"></script>


<script src="<?php echo base_url() ?>assets/vendor/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

<!-- Current Page Vendor and Views -->
<script src="<?php echo base_url() ?>assets/js/views/view.contact.js"></script>



<!-- Demo -->
<script src="<?php echo base_url() ?>assets/js/demos/demo-shop-8.js"></script>

<!-- Theme Custom -->
<script src="<?php echo base_url() ?>assets/js/custom.js"></script>

<!-- Theme Initialization Files -->
<script src="<?php echo base_url() ?>assets/js/theme.init.js"></script>






<!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information.
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-12345678-1', 'auto');
  ga('send', 'pageview');
</script>
 -->


</body>
</html>
