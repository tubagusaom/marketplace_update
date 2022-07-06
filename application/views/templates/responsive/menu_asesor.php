<ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
    <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
    <li class="sidebar-toggler-wrapper hide">
        <div class="sidebar-toggler">
            <span></span>
        </div>
    </li>
    <!-- END SIDEBAR TOGGLER BUTTON -->
    <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->

    <li class="nav-item start <?= $this->uri->segment(1) == 'home' ? 'active' : '' ?>">
        <a href="<?= base_url() ?>" class="nav-link ">
            <i class="icon-home"></i>

            <span class="title">Beranda</span>

        </a>
    </li>

    <li class="nav-item start <?= $this->uri->segment(1) == 'persiapan' ? 'active' : '' ?>">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-envelope-letter"></i>
            <span class="title">Persiapan</span>
            <span class="arrow <?= $this->uri->segment(1) == 'persiapan' ? 'surat_tugas' : '' ?>"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item <?= $this->uri->segment(1) == 'persiapan' && $this->uri->segment(2) == 'surat_tugas' ? 'active' : '' ?>">
                <a href="<?= base_url() . 'persiapan/surat_tugas' ?>" class="nav-link ">
                    <span class="title">Surat Tugas</span>

                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item <?= $this->uri->segment(1) == 'sertifikasi' ? 'active' : '' ?>">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-note"></i>
            <span class="title">Sertifikasi</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item <?= $this->uri->segment(1) == 'sertifikasi' && $this->uri->segment(2) == 'pra_asesmen' ? 'active' : '' ?>">
                <a href="<?= base_url() . 'pra_asesmen/index_asesor' ?>" class="nav-link ">
                    <span class="title">Pra Asesmen</span>
                </a>
            </li>
            <li class="nav-item <?= $this->uri->segment(1) == 'sertifikasi' && $this->uri->segment(2) == 'penilaian_asesor' ? 'active' : '' ?>">
                <a href="<?= base_url() . 'penilaian_asesor/index_asesor' ?>" class="nav-link ">
                    <span class="title">Rekomendadsi Asesor</span>
                </a>
            </li>

        </ul>
    </li>

    <li class="nav-item <?= $this->uri->segment(1) == 'perangkat' ? 'active' : '' ?> ">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-bar-chart"></i>
            <span class="title">Perangkat Asesmen</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item">
                <a href="<?= base_url() . 'hasil/index_asesor' ?>" class="nav-link ">
                    <span class="title">Hasil Jawaban</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item <?= $this->uri->segment(1) == 'manajemen' ? 'active' : '' ?>">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-drawer"></i>
            <span class="title">Manajemen Files</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item <?= $this->uri->segment(1) == 'manajemen' && $this->uri->segment(2) == 'data_pribadi' ? 'active' : '' ?>">
                <a href="<?= base_url() . 'manajemen/data_pribadi' ?>" class="nav-link ">
                    <span class="title">Profil Asesor</span>
                </a>
            </li>
            <li class="nav-item <?= $this->uri->segment(1) == 'manajemen' && $this->uri->segment(2) == 'repositori' ? 'active' : '' ?>">
                <a href="<?= base_url() . 'manajemen/repositori' ?>" class="nav-link ">
                    <span class="title">Dokumen Asesor</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item <?= $this->uri->segment(1) == 'pesan' ? 'active' : '' ?> ">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-envelope"></i>
            <span class="title">Utility</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item  ">
                <a href="<?= base_url() . 'pesan/index' ?>" class="nav-link ">
                    <span class="title">Ticket Support</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item <?= $this->uri->segment(1) == 'knowledge_base' ? 'active' : '' ?> ">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-film"></i>
            <span class="title">Knowledge Base</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item  ">
                <a href="<?= base_url() . 'knowledge_base/index' ?>" class="nav-link ">
                    <span class="title">Tutorial</span>
                </a>
            </li>
        </ul>
    </li>
</ul>
