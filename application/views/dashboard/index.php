<div class="container-fluid">

<!-- ======================================================
    PAGE HEADER
======================================================= -->

<div class="d-sm-flex align-items-center justify-content-between mb-4">

    <div>

        <h1 class="h3 text-gray-800 font-weight-bold">

            Dashboard BUMDes

        </h1>

        <p class="mb-0 text-muted">

            Selamat Datang,

            <b><?= $this->session->userdata('nama'); ?></b>

            | <?= date('d F Y'); ?>

        </p>

    </div>

</div>


<!-- ======================================================
    SUMMARY CARD
======================================================= -->

<div class="row">

    <!-- Populasi -->

    <div class="col-xl-3 col-md-6 mb-4">

        <div class="card border-left-success shadow h-100 py-2">

            <div class="card-body">

                <div class="row no-gutters align-items-center">

                    <div class="col mr-2">

                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">

                            Populasi Aktif

                        </div>

                        <div class="h3 font-weight-bold text-gray-800">

                            <?= number_format($populasi) ?>

                        </div>

                        <small>Ekor</small>

                    </div>

                    <div class="col-auto">

                        <i class="fas fa-kiwi-bird fa-3x text-gray-300"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- Stok -->

    <div class="col-xl-3 col-md-6 mb-4">

        <div class="card border-left-warning shadow h-100 py-2">

            <div class="card-body">

                <div class="row no-gutters align-items-center">

                    <div class="col mr-2">

                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">

                            Stok Telur

                        </div>

                        <div class="h3 font-weight-bold text-gray-800">

                            <?= number_format($stok,2) ?>

                        </div>

                        <small>Kg</small>

                    </div>

                    <div class="col-auto">

                        <i class="fas fa-egg fa-3x text-gray-300"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- Pendapatan -->

    <div class="col-xl-3 col-md-6 mb-4">

        <div class="card border-left-primary shadow h-100 py-2">

            <div class="card-body">

                <div class="row no-gutters align-items-center">

                    <div class="col mr-2">

                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">

                            Pendapatan

                        </div>

                        <div class="h4 font-weight-bold text-gray-800">

                            Rp <?= number_format($pendapatan,0,',','.') ?>

                        </div>

                    </div>

                    <div class="col-auto">

                        <i class="fas fa-wallet fa-3x text-gray-300"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- Saldo -->

    <div class="col-xl-3 col-md-6 mb-4">

        <div class="card border-left-info shadow h-100 py-2">

            <div class="card-body">

                <div class="row no-gutters align-items-center">

                    <div class="col mr-2">

                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">

                            Saldo Kas

                        </div>

                        <div class="h4 font-weight-bold text-gray-800">

                            Rp <?= number_format($saldo,0,',','.') ?>

                        </div>

                    </div>

                    <div class="col-auto">

                        <i class="fas fa-coins fa-3x text-gray-300"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



<!-- ======================================================
    ROW 2
======================================================= -->

<div class="row">


<!-- Ringkasan Peternakan -->

<div class="col-lg-6">

<div class="card shadow mb-4">

<div class="card-header py-3">

<h6 class="m-0 font-weight-bold text-success">

<i class="fas fa-dove"></i>

Ringkasan Peternakan

</h6>

</div>

<div class="card-body">

<table class="table table-bordered">

<tr>

<th width="60%">

Populasi Awal

</th>

<td class="text-right">

<?= number_format($populasi_awal) ?>

Ekor

</td>

</tr>

<tr>

<th>

Ayam Mati

</th>

<td class="text-right text-danger">

<?= number_format($ayam_mati) ?>

Ekor

</td>

</tr>

<tr>

<th>

Ayam Sakit

</th>

<td class="text-right text-warning">

<?= number_format($ayam_sakit) ?>

Ekor

</td>

</tr>

<tr class="table-success">

<th>

Populasi Aktif

</th>

<td class="text-right font-weight-bold">

<?= number_format($populasi) ?>

Ekor

</td>

</tr>

</table>

</div>

</div>

</div>



<!-- Ringkasan Produksi -->

<div class="col-lg-6">

<div class="card shadow mb-4">

<div class="card-header py-3">

<h6 class="m-0 font-weight-bold text-warning">

<i class="fas fa-egg"></i>

Ringkasan Produksi

</h6>

</div>

<div class="card-body">

<table class="table table-bordered">

<tr>

<th width="60%">

Total Produksi

</th>

<td class="text-right">

<?= number_format($produksi,2) ?>

Kg

</td>

</tr>

<tr>

<th>

Total Penjualan

</th>

<td class="text-right">

<?= number_format($penjualan,2) ?>

Kg

</td>

</tr>

<tr class="table-warning">

<th>

Stok Telur

</th>

<td class="text-right font-weight-bold">

<?= number_format($stok,2) ?>

Kg

</td>

</tr>

</table>

</div>

</div>

</div>

</div>
<!-- ======================================================
    ROW 3
======================================================= -->

<div class="row">

<!-- ================= KEUANGAN ================= -->

<div class="col-lg-6">

<div class="card shadow mb-4">

<div class="card-header py-3">

<h6 class="m-0 font-weight-bold text-primary">

<i class="fas fa-wallet"></i>

Ringkasan Keuangan

</h6>

</div>

<div class="card-body">

<table class="table table-bordered table-striped">

<tr>

<th width="60%">

Pendapatan

</th>

<td class="text-right text-success font-weight-bold">

Rp <?= number_format($pendapatan,0,',','.') ?>

</td>

</tr>

<tr>

<th>

Pengeluaran

</th>

<td class="text-right text-danger font-weight-bold">

Rp <?= number_format($pengeluaran,0,',','.') ?>

</td>

</tr>

<tr class="table-primary">

<th>

Saldo Kas

</th>

<td class="text-right font-weight-bold">

Rp <?= number_format($saldo,0,',','.') ?>

</td>

</tr>

</table>

</div>

</div>

</div>



<!-- ================= AKTIVITAS ================= -->

<div class="col-lg-6">

<div class="card shadow mb-4">

<div class="card-header py-3">

<h6 class="m-0 font-weight-bold text-info">

<i class="fas fa-history"></i>

Transaksi Terbaru

</h6>

</div>

<div class="card-body p-0">

<table class="table table-sm table-hover mb-0">

<thead class="bg-light">

<tr>

<th>Tanggal</th>

<th>Jenis</th>

<th class="text-right">Nominal</th>

</tr>

</thead>

<tbody>

<?php if(count($transaksi)==0): ?>

<tr>

<td colspan="3" class="text-center text-muted">

Belum ada transaksi

</td>

</tr>

<?php endif; ?>

<?php foreach($transaksi as $t): ?>

<tr>

<td>

<?= date('d/m/Y',strtotime($t->tanggal)) ?>

</td>

<td>

<?php if($t->jenis=="MASUK"): ?>

<span class="badge badge-success">

MASUK

</span>

<?php else: ?>

<span class="badge badge-danger">

KELUAR

</span>

<?php endif; ?>

</td>

<td class="text-right">

<?= number_format($t->nominal,0,',','.') ?>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</div>

</div>

</div>



<!-- ======================================================
    QUICK MENU
======================================================= -->

<div class="row">

<div class="col-lg-12">

<div class="card shadow">

<div class="card-header py-3">

<h6 class="m-0 font-weight-bold text-secondary">

<i class="fas fa-bolt"></i>

Menu Cepat

</h6>

</div>

<div class="card-body">

<div class="row text-center">

<div class="col-md-3 mb-3">

<a href="<?= base_url('produksi_telur') ?>" class="btn btn-success btn-block p-4">

<i class="fas fa-egg fa-3x mb-3"></i>

<br>

Produksi Telur

</a>

</div>

<div class="col-md-3 mb-3">

<a href="<?= base_url('penjualan_telur') ?>" class="btn btn-warning btn-block p-4">

<i class="fas fa-shopping-cart fa-3x mb-3"></i>

<br>

Penjualan

</a>

</div>

<div class="col-md-3 mb-3">

<a href="<?= base_url('transaksi_keuangan') ?>" class="btn btn-primary btn-block p-4">

<i class="fas fa-wallet fa-3x mb-3"></i>

<br>

Keuangan

</a>

</div>

<div class="col-md-3 mb-3">

<a href="<?= base_url('laba_rugi') ?>" class="btn btn-danger btn-block p-4">

<i class="fas fa-chart-line fa-3x mb-3"></i>

<br>

Laba Rugi

</a>

</div>

</div>

</div>

</div>

</div>

</div>
<!-- ======================================================
    ROW 4
======================================================= -->

<div class="row">

<!-- GRAFIK PRODUKSI -->

<div class="col-lg-8">

<div class="card shadow mb-4">

<div class="card-header py-3">

<h6 class="m-0 font-weight-bold text-success">

<i class="fas fa-chart-line"></i>

Grafik Produksi vs Penjualan

</h6>

</div>

<div class="card-body">

<canvas id="grafikProduksi" height="120"></canvas>

</div>

</div>

</div>



<!-- STATUS USAHA -->

<div class="col-lg-4">

<div class="card shadow mb-4">

<div class="card-header py-3">

<h6 class="m-0 font-weight-bold text-primary">

<i class="fas fa-chart-pie"></i>

Status Usaha

</h6>

</div>

<div class="card-body">

<h6 class="small font-weight-bold">

Stok Telur

<span class="float-right">

<?= number_format($stok,2) ?> Kg

</span>

</h6>

<div class="progress mb-3">

<div class="progress-bar bg-warning"

style="width:<?= min(100,$stok) ?>%">

</div>

</div>


<h6 class="small font-weight-bold">

Populasi Aktif

<span class="float-right">

<?= number_format($populasi) ?>

Ekor

</span>

</h6>

<div class="progress mb-3">

<div class="progress-bar bg-success"

style="width:100%">

</div>

</div>


<h6 class="small font-weight-bold">

Saldo Kas

<span class="float-right">

Rp <?= number_format($saldo,0,',','.') ?>

</span>

</h6>

<div class="progress">

<div class="progress-bar bg-info"

style="width:100%">

</div>

</div>

</div>

</div>

</div>

</div>



<!-- ======================================================
    ROW 5
======================================================= -->

<div class="row">

<div class="col-lg-12">

<div class="card shadow">

<div class="card-header py-3">

<h6 class="m-0 font-weight-bold text-danger">

<i class="fas fa-bell"></i>

Informasi Sistem

</h6>

</div>

<div class="card-body">

<div class="row">

<div class="col-md-3">

<?php if($stok<=20): ?>

<div class="alert alert-warning mb-2">

🥚

Stok telur mulai menipis.

</div>

<?php else: ?>

<div class="alert alert-success mb-2">

🥚

Stok telur aman.

</div>

<?php endif; ?>

</div>



<div class="col-md-3">

<?php if($ayam_sakit>0): ?>

<div class="alert alert-danger mb-2">

🤒

Ada

<b><?= $ayam_sakit ?></b>

ayam sakit.

</div>

<?php else: ?>

<div class="alert alert-success mb-2">

🤒

Tidak ada ayam sakit.

</div>

<?php endif; ?>

</div>



<div class="col-md-3">

<?php if($ayam_mati>0): ?>

<div class="alert alert-warning mb-2">

💀

Total ayam mati

<b><?= $ayam_mati ?></b>

ekor.

</div>

<?php else: ?>

<div class="alert alert-success mb-2">

💀

Tidak ada ayam mati.

</div>

<?php endif; ?>

</div>



<div class="col-md-3">

<?php if($saldo>0): ?>

<div class="alert alert-primary mb-2">

💰

Kas tersedia

<b>

Rp <?= number_format($saldo,0,',','.') ?>

</b>

</div>

<?php else: ?>

<div class="alert alert-danger mb-2">

Kas kosong.

</div>

<?php endif; ?>

</div>

</div>

</div>

</div>

</div>

</div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx=document.getElementById('grafikProduksi');

new Chart(ctx,{

type:'bar',

data:{

labels:['Produksi','Penjualan','Stok'],

datasets:[{

label:'Kg',

data:[

<?= $produksi ?>,

<?= $penjualan ?>,

<?= $stok ?>

]

}]

},

options:{

responsive:true,

plugins:{

legend:{

display:false

}

}

}

});

</script>