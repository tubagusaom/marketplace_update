<style media="screen">
  @media (max-width: 767px) {
    #header .top-menu li a{
      color: red!important;
      float: left;
      line-height: 2;
      font-weight: bold;
      font-size: 12px;
    }

    #header .top-menu li a:hover{
      color: rgb(198, 155, 152);
    }
  }
</style>

<div class="header-top">
  <div class="container">

    <!-- <div class="header-dropdown cur-dropdown">
      <a href="#">USD <i class="fa fa-caret-down"></i></a>

      <ul class="header-dropdownmenu">
        <li><a href="#">EUR</a></li>
        <li><a href="#">USD</a></li>
      </ul>
    </div> -->

    <div class="top-menu-area">
      <a href="#">
        <i class="fa fa-user-o"></i> &nbsp; <?=$nama_user?> <i class="fa fa-caret-down"></i>
      </a>
      <ul class="top-menu">

        <?php if (isset($nama_user)) { ?>

          <!-- <li><a href="#" class="a-decoration-none">Buka Toko</a></li> -->
          <!-- <li><a href="#">Daily Deal</a></li> -->
          <li>
            <a href="<?=base_url()?>buyer" class="a-decoration-none">
              <i class="fa fa-user"></i> Saya
            </a>
          </li>

          <li>
          <a href="<?php echo base_url() ?>users/logout" class="a-decoration-none">

              <i class="fa fa-sign-in"></i> Keluar

          </a>
          </li>

        <?php }else{ ?>

        <a href="#" id="login-btn" data-toggle="modal" data-target="#myModal">
          <li>
            <i class="fa fa-sign-in"></i> Masuk
          </li>
        </a>

        <?php } ?>

      </ul>
    </div>
    <p class="welcome-msg">
      <?php
        if (isset($nama_user)) {
          echo "<b class='tb-name'>HAI ".$nama_user."</b>";
        }else {
          echo "Selamat Datang";
        }
      ?>
    </p>
  </div>
</div>
