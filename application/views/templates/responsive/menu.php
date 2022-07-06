<ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
    <li class="sidebar-toggler-wrapper hide">
        <div class="sidebar-toggler">
            <span></span>
        </div>
    </li>
   
    <li class="nav-item start <?= $this->uri->segment(1) == 'home' ? 'active' : '' ?>">
        <a href="<?= base_url() ?>" class="nav-link ">
            <i class="fa fa-home"></i>

            <span class="title">Home</span>

        </a>
    </li>
    <li class="nav-item start <?= $this->uri->segment(1) == 'profil' ? 'active' : '' ?>">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-user"></i>
            <span class="title">Profil</span>
            <span class="arrow <?= $this->uri->segment(1) == 'profil' ? 'open' : '' ?>"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item <?= $this->uri->segment(1) == 'profil' && $this->uri->segment(2) == 'index' ? 'active' : '' ?>">
                <a href="<?= base_url() . 'profil/index' ?>" class="nav-link ">
                    <span class="title">Biodata</span>

                </a>
            </li>
            <!-- <li class="nav-item <?= $this->uri->segment(1) == 'profil' && $this->uri->segment(2) == 'pekerjaan' ? 'active' : '' ?>">
                <a href="<?= base_url() . 'profil/pekerjaan' ?>" class="nav-link ">
                    <span class="title">Pekerjaan</span>
                </a>
            </li> -->
            <li class="nav-item <?= $this->uri->segment(1) == 'profil' && $this->uri->segment(2) == 'foto' ? 'active' : '' ?>">
                <a href="<?= base_url() . 'profil/foto' ?>" class="nav-link ">
                    <span class="title">Pasfoto</span>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item <?= $this->uri->segment(1) == 'sertifikasi' ? 'active' : '' ?>">
      <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-edit"></i>
            <span class="title">Sertifikasi</span>
            <span class="arrow"></span>
            <!-- tubagus aom -->
        </a>
        <ul class="sub-menu">
            <li class="nav-item  ">
                <a href="<?= base_url() . 'sertifikasi/view' ?>" class="nav-link ">
                    <span class="title">Riwayat Sertifikasi</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="<?= base_url() . 'sertifikasi/proses' ?>" class="nav-link ">
                    <span class="title">Proses Sertifikasi</span>
                </a>
            </li>
        </ul>
    </li>
    
    <li class="nav-item <?= $this->uri->segment(1) == 'bukti_pendukung' ? 'active' : '' ?> ">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-camera-retro"></i>
            <span class="title">Bukti Pendukung</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item <?= $this->uri->segment(1) == 'bukti_pendukung' && $this->uri->segment(2) == 'upload' ? 'active' : '' ?>">
                <a href="<?= base_url() . 'bukti_pendukung/upload' ?>" class="nav-link ">
                    <span class="title">Upload Bukti Pendukung</span>
                </a>
            </li>
            <li class="nav-item  <?= $this->uri->segment(1) == 'bukti_pendukung' && $this->uri->segment(2) == 'index' ? 'active' : '' ?>">
                <a href="<?= base_url() . 'bukti_pendukung/index' ?>" class="nav-link ">
                    <span class="title">Arsip Bukti Pendukung</span>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item  ">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-info"></i>
            <span class="title">Bantuan</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <!--
            <li class="nav-item  ">
                <a href="#" class="nav-link ">
                    <span class="title">Buka Tiket Support</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="#" class="nav-link ">
                    <span class="title">Daftar Tiket Support</span>
                </a>
            </li>
            //-->
            <li class="nav-item  ">
                <a href="<?= base_url() . 'bantuan/kontak_back' ?>" class="nav-link ">
                    <span class="title">Kontak</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="<?= base_url() . 'knowledge_base/view' ?>" class="nav-link ">
                    <span class="title">Panduan</span>
                </a>
            </li>
        </ul>
    </li>
</ul>
