<div class="menu-scroll">
    <div class="sidebar-icons">
        <a href="#" class="close-menu"><i class="fa-fw fa fa-times"></i></a>
    </div>

    <div class="container content-padding">
        <div class="above-overlay">
            <h6 class="uppercase ultrabold top-5 color-blue"><?= $this->auth->get_user_data()->nama_user ?></h6>
            <p class="bottom-5 color-blue opacity-60">
                <?= $this->auth->get_user_data()->email ?>
            </p>
        </div>
        <div class="overlay bg-white opacity-90"></div>
        <!-- <div class="overlay-image preload-image" data-src="_assets_mobile/images/pictures_vertical/bg10.jpg"></div> -->
    </div>

    <div class="menu-items menu-icons bottom-440">

        <a class="menu-item-active submenu-has-numbers" href="#" data-submenu="submenu-xxx" ><i class="color-blue-light fa fa-user" style="color:#1a8fb7!important;"></i>Profil</a>
        <div class="submenu" id="submenu-xxx">
            <a id="cpass" href="<?php echo base_url().'users/ubah_password' ?>">Ubah Password</a>
        </div>

        <a class="menu-item-active" href="<?= base_url() . 'users/logout' ?>" ><i class="color-light fas fa-power-off"></i>Logout</a>
    </div>

    <p class="sidebar-copyright">Copyright <span class="copyright-year"></span> Enabled. All Rights Reserved</p>
</div>
