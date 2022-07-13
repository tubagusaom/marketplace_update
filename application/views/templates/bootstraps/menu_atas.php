<div class="header-top">
  <div class="container">
    <div class="top-menu-area">
      <a href="#">
        <i class="fa fa-user"></i> &nbsp; <?=$nama_user?> <i class="fa fa-caret-down"></i>
      </a>
      <ul class="top-menu">

        <?php if (isset($nama_user)) { ?>

          <!-- <li><a href="#" class="a-decoration-none">Buka Toko</a></li> -->
          <!-- <li><a href="#">Daily Deal</a></li> -->
          <li><a href="#" class="a-decoration-none">Akun Saya</a></li>

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
