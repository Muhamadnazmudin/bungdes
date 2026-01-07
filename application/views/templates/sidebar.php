<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard') ?>">
        <div class="sidebar-brand-icon">
            <i class="fas fa-store"></i>
        </div>
        <div class="sidebar-brand-text mx-3">BUMDes</div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item <?= ($this->uri->segment(1) == 'dashboard') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('dashboard') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- ================= MASTER DATA ================= -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#masterData"
           aria-expanded="true" aria-controls="masterData">
            <i class="fas fa-fw fa-database"></i>
            <span>Master Data</span>
        </a>
        <div id="masterData" class="collapse">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= base_url('unit_usaha') ?>">Unit Usaha</a>
                <a class="collapse-item" href="<?= base_url('akun') ?>">Akun (COA)</a>
                <a class="collapse-item" href="<?= base_url('pajak') ?>">Pajak</a>
                <a class="collapse-item" href="<?= base_url('kandang') ?>">Kandang</a>
                <a class="collapse-item" href="<?= base_url('populasi_ayam') ?>">Populasi Ayam</a>
            </div>
        </div>
    </li>

    <!-- ================= OPERASIONAL ================= -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#operasional"
           aria-expanded="true" aria-controls="operasional">
            <i class="fas fa-fw fa-industry"></i>
            <span>Operasional Usaha</span>
        </a>
        <div id="operasional" class="collapse">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= base_url('produksi_telur') ?>">Produksi Telur</a>
                <a class="collapse-item" href="<?= base_url('ayam_sakit') ?>">Ayam Sakit</a>
                <a class="collapse-item" href="<?= base_url('ayam_mati') ?>">Ayam Mati</a>
            </div>
        </div>
    </li>

    <!-- ================= KEUANGAN ================= -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#keuangan"
           aria-expanded="true" aria-controls="keuangan">
            <i class="fas fa-fw fa-wallet"></i>
            <span>Keuangan</span>
        </a>
        <div id="keuangan" class="collapse">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= base_url('kas') ?>">Kas & Bank</a>
                <a class="collapse-item" href="<?= base_url('transaksi_keuangan') ?>">Transaksi Keuangan</a>
                <a class="collapse-item" href="<?= base_url('jurnal_umum') ?>">Jurnal Umum</a>
            </div>
        </div>
    </li>

    <!-- ================= LAPORAN ================= -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#laporan"
           aria-expanded="true" aria-controls="laporan">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Laporan</span>
        </a>
        <div id="laporan" class="collapse">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= base_url('ayam_hidup') ?>">Laporan Ayam</a>
                <a class="collapse-item" href="<?= base_url('buku_kas_umum') ?>">Buku Kas Umum</a>
                <a class="collapse-item" href="<?= base_url('neraca') ?>">Neraca</a>
                <a class="collapse-item" href="<?= base_url('laba_rugi') ?>">Laba Rugi</a>
                <a class="collapse-item" href="<?= base_url('buku_besar') ?>">Buku Besar</a>
                <a class="collapse-item" href="<?= base_url('arus_kas') ?>">Arus Kas</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <!-- ================= SISTEM ================= -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('auth/logout') ?>">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggle (Desktop Only) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
