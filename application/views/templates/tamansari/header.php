

<html>
  <head>
    <title>Tamansari Garden</title>


    <style media="screen">
      @media (max-width: 179px) {
        #display-tb-hp{
          display: block!important;
          text-align: center!important;
        }
        #display-tb-desktop{
          display: none!important;
        }
      }

      @media (min-width: 980px) {
        #display-tb-hp{
          display: none!important;
        }
        #display-tb-desktop{
          display: block!important;
          width: 925px!important;
        }
      }

      @media only screen and (min-width: 600px) {
        /* For tablets: */

      }
      @media only screen and (min-width: 768px) {
        /* For desktop: */

      }

    </style>

  </head>
  <body>
    <!-- <h1>PDF Example with iframe</h1> -->
    <!-- <iframe src="<?=base_url('assets/tamansari/brosur_tamansari_garden.PDF')?>" width="100%" height="675px">
    </iframe> -->

    <div id="display-tb-hp" class="container resume"  style="padding-bottom: 70px">
      <h2>My HP</h2>
      <!-- <h3 style="padding: 5px">You can download my resume for your reference and I hope that we will meet very soon! &#128521;</h3> -->

      <!-- <div class="btn-center"> -->
        <a href="<?=base_url('assets/tamansari/brosur_tamansari_garden.PDF')?>" target="_blank" class="hire-me">
        <!-- <a href="#" onClick="alert('HELLO WORLD &#128521;')" class="hire-me"> -->
          <i class="fa fa-download"></i> Download Resume
        </a>
        <!-- <h2>127 KB</h2> -->
      <!-- </div> -->
    </div>

    <div id="display-tb-desktop" class="container resume" style="">
      <h2>My Desktop</h2>
      <!-- <h3 style="font-size: 23.5px!important">You can view my resume for your reference and I hope that we will meet very soon! &#128521;</h3> -->

      <div id="display-tb-desktop" class="btn-center">
        <iframe src="<?=base_url('assets/tamansari/brosur_tamansari_garden.PDF')?>" width="100%" height="675px">
        </iframe>
      </div>
    </div>

  </body>
</html>
