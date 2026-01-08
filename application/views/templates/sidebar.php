<?php
$is_mobile = $this->agent->is_mobile();
$seg1 = $this->uri->segment(1);

/* ================= MASTER DATA ================= */
$master_active = in_array($seg1, [
    'unit_usaha','akun','pajak','kandang','populasi_ayam'
]);

/* ================= OPERASIONAL ================= */
$operasional_active = in_array($seg1, [
    'produksi_telur','ayam_sakit','ayam_mati'
]);

/* ================= KEUANGAN ================= */
$keuangan_active = in_array($seg1, [
    'kas','transaksi_keuangan','jurnal_umum'
]);

/* ================= LAPORAN ================= */
$laporan_active = in_array($seg1, [
    'ayam_hidup','buku_kas_umum','neraca','laba_rugi','buku_besar','arus_kas'
]);
?>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- BRAND -->
   <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard') ?>">
    <img src="<?= base_url('assets/img/logo_bumdes.png') ?>"
         alt="BUMDes"
         class="sidebar-logo mr-2">
    <span class="sidebar-brand-text">BUMDes</span>
</a>


    <hr class="sidebar-divider my-0">

    <!-- DASHBOARD -->
    <li class="nav-item <?= ($seg1 == 'dashboard') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('dashboard') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- ================= MASTER DATA ================= -->
    <li class="nav-item <?= (!$is_mobile && $master_active) ? 'active' : '' ?>">
        <a class="nav-link <?= (!$is_mobile && $master_active) ? '' : 'collapsed' ?>"
           href="#"
           data-toggle="collapse"
           data-target="#masterData"
           aria-expanded="<?= (!$is_mobile && $master_active) ? 'true' : 'false' ?>">
            <i class="fas fa-fw fa-database"></i>
            <span>Master Data</span>
        </a>

        <div id="masterData"
             class="collapse <?= (!$is_mobile && $master_active) ? 'show' : '' ?>">
            <div class="collapse-inner rounded">
                <a class="collapse-item <?= ($seg1 == 'unit_usaha') ? 'active' : '' ?>" href="<?= base_url('unit_usaha') ?>">Unit Usaha</a>
                <a class="collapse-item <?= ($seg1 == 'akun') ? 'active' : '' ?>" href="<?= base_url('akun') ?>">Akun (COA)</a>
                <a class="collapse-item <?= ($seg1 == 'pajak') ? 'active' : '' ?>" href="<?= base_url('pajak') ?>">Pajak</a>
                <a class="collapse-item <?= ($seg1 == 'kandang') ? 'active' : '' ?>" href="<?= base_url('kandang') ?>">Kandang</a>
                <a class="collapse-item <?= ($seg1 == 'populasi_ayam') ? 'active' : '' ?>" href="<?= base_url('populasi_ayam') ?>">Populasi Ayam</a>
            </div>
        </div>
    </li>

    <!-- ================= OPERASIONAL ================= -->
    <li class="nav-item <?= (!$is_mobile && $operasional_active) ? 'active' : '' ?>">
        <a class="nav-link <?= (!$is_mobile && $operasional_active) ? '' : 'collapsed' ?>"
           href="#"
           data-toggle="collapse"
           data-target="#operasional"
           aria-expanded="<?= (!$is_mobile && $operasional_active) ? 'true' : 'false' ?>">
            <i class="fas fa-fw fa-industry"></i>
            <span>Operasional Usaha</span>
        </a>

        <div id="operasional"
             class="collapse <?= (!$is_mobile && $operasional_active) ? 'show' : '' ?>">
            <div class="collapse-inner rounded">
                <a class="collapse-item <?= ($seg1 == 'produksi_telur') ? 'active' : '' ?>" href="<?= base_url('produksi_telur') ?>">Produksi Telur</a>
                <a class="collapse-item <?= ($seg1 == 'ayam_sakit') ? 'active' : '' ?>" href="<?= base_url('ayam_sakit') ?>">Ayam Sakit</a>
                <a class="collapse-item <?= ($seg1 == 'ayam_mati') ? 'active' : '' ?>" href="<?= base_url('ayam_mati') ?>">Ayam Mati</a>
            </div>
        </div>
    </li>

    <!-- ================= KEUANGAN ================= -->
    <li class="nav-item <?= (!$is_mobile && $keuangan_active) ? 'active' : '' ?>">
        <a class="nav-link <?= (!$is_mobile && $keuangan_active) ? '' : 'collapsed' ?>"
           href="#"
           data-toggle="collapse"
           data-target="#keuangan"
           aria-expanded="<?= (!$is_mobile && $keuangan_active) ? 'true' : 'false' ?>">
            <i class="fas fa-fw fa-wallet"></i>
            <span>Keuangan</span>
        </a>

        <div id="keuangan"
             class="collapse <?= (!$is_mobile && $keuangan_active) ? 'show' : '' ?>">
            <div class="collapse-inner rounded">
                <a class="collapse-item <?= ($seg1 == 'kas') ? 'active' : '' ?>" href="<?= base_url('kas') ?>">Kas & Bank</a>
                <a class="collapse-item <?= ($seg1 == 'transaksi_keuangan') ? 'active' : '' ?>" href="<?= base_url('transaksi_keuangan') ?>">Transaksi Keuangan</a>
                <a class="collapse-item <?= ($seg1 == 'jurnal_umum') ? 'active' : '' ?>" href="<?= base_url('jurnal_umum') ?>">Jurnal Umum</a>
            </div>
        </div>
    </li>

    <!-- ================= LAPORAN ================= -->
    <li class="nav-item <?= (!$is_mobile && $laporan_active) ? 'active' : '' ?>">
        <a class="nav-link <?= (!$is_mobile && $laporan_active) ? '' : 'collapsed' ?>"
           href="#"
           data-toggle="collapse"
           data-target="#laporan"
           aria-expanded="<?= (!$is_mobile && $laporan_active) ? 'true' : 'false' ?>">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Laporan</span>
        </a>

        <div id="laporan"
             class="collapse <?= (!$is_mobile && $laporan_active) ? 'show' : '' ?>">
            <div class="collapse-inner rounded">
                <a class="collapse-item <?= ($seg1 == 'ayam_hidup') ? 'active' : '' ?>" href="<?= base_url('ayam_hidup') ?>">Laporan Ayam</a>
                <a class="collapse-item <?= ($seg1 == 'buku_kas_umum') ? 'active' : '' ?>" href="<?= base_url('buku_kas_umum') ?>">Buku Kas Umum</a>
                <a class="collapse-item <?= ($seg1 == 'neraca') ? 'active' : '' ?>" href="<?= base_url('neraca') ?>">Neraca</a>
                <a class="collapse-item <?= ($seg1 == 'laba_rugi') ? 'active' : '' ?>" href="<?= base_url('laba_rugi') ?>">Laba Rugi</a>
                <a class="collapse-item <?= ($seg1 == 'buku_besar') ? 'active' : '' ?>" href="<?= base_url('buku_besar') ?>">Buku Besar</a>
                <a class="collapse-item <?= ($seg1 == 'arus_kas') ? 'active' : '' ?>" href="<?= base_url('arus_kas') ?>">Arus Kas</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <!-- LOGOUT -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('auth/logout') ?>">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <!-- SIDEBAR TOGGLE (DESKTOP) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
