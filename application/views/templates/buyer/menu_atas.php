<style media="screen">
  @media (max-width: 767px) {
    #header .top-menu li a{
      color: red!important;
      float: left;
      line-height: 1.5;
      font-weight: bold;
      font-size: 10px;
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
              <i class="fa fa-user"></i> <?=$nama_user?>
            </a>
          </li>

          <li>
            <?php if (isset($nama_user)) { ?>

              <a href="<?php echo base_url() ?>users/logout" class="a-decoration-none">
                <i class="fa fa-sign-in"></i> Logout
              </a>

            <?php }else{ ?>

              <a href="#" id="login-btn" data-toggle="modal" data-target="#myModal" class="a-decoration-none">
                <i class="fa fa-sign-in"></i> Masuk
              </a>

            <?php } ?>
        </li>

        <?php }else{ ?>

        <li>
          <a href="#" id="login-btn" data-toggle="modal" data-target="#myModal">
            <i class="fa fa-sign-in"></i> Masuk
          </a>
        </li>

        <?php } ?>

        </li>
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
