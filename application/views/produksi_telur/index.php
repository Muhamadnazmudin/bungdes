<div class="container-fluid">

<?php
$total_butir = 0;
$total_kg    = 0;

foreach ($data as $d) {
    $total_butir += $d->jumlah_telur;
    $total_kg    += $d->berat_kg;
}

$rata = 0;
if ($total_butir > 0) {
    $rata = ($total_kg * 1000) / $total_butir;
}
?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">

    <h1 class="h3 mb-0 text-gray-800">
        <?= $title ?>
    </h1>

    <a href="<?= base_url('produksi_telur/tambah') ?>"
       class="btn btn-primary shadow-sm">

        <i class="fas fa-plus"></i>

        Input Produksi

    </a>

</div>

<?php if($this->session->flashdata('success')) : ?>

<div class="alert alert-success alert-dismissible fade show">

    <?= $this->session->flashdata('success'); ?>

    <button class="close" data-dismiss="alert">

        &times;

    </button>

</div>

<?php endif; ?>


<div class="row">

    <div class="col-lg-4 mb-4">

        <div class="card border-left-success shadow h-100">

            <div class="card-body">

                <div class="text-xs font-weight-bold text-success text-uppercase mb-2">

                    Total Produksi

                </div>

                <div class="h3 font-weight-bold text-gray-800">

                    <?= number_format($total_kg,3,',','.') ?>

                    Kg

                </div>

            </div>

        </div>

    </div>


    <div class="col-lg-4 mb-4">

        <div class="card border-left-primary shadow h-100">

            <div class="card-body">

                <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">

                    Total Telur

                </div>

                <div class="h3 font-weight-bold text-gray-800">

                    <?= number_format($total_butir,0,',','.') ?>

                    Butir

                </div>

            </div>

        </div>

    </div>


    <div class="col-lg-4 mb-4">

        <div class="card border-left-warning shadow h-100">

            <div class="card-body">

                <div class="text-xs font-weight-bold text-warning text-uppercase mb-2">

                    Rata-rata Berat

                </div>

                <div class="h3 font-weight-bold text-gray-800">

                    <?= number_format($rata,2,',','.') ?>

                    gr/butir

                </div>

            </div>

        </div>

    </div>

</div>



<div class="card shadow mb-4">

    <div class="card-header py-3">

        <h6 class="m-0 font-weight-bold text-primary">

            Data Produksi Telur

        </h6>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered table-hover" id="dataTable">

                <thead class="bg-primary text-white">

                <tr>

                    <th width="50">No</th>

                    <th>Tanggal</th>

                    <th>Unit Usaha</th>

                    <th>Kandang</th>

                    <th class="text-center">

                        Jumlah Telur

                    </th>

                    <th class="text-center">

                        Berat (Kg)

                    </th>

                    <th>Keterangan</th>

                    <th width="120" class="text-center">

                        Aksi

                    </th>

                </tr>

                </thead>

                <tbody>

                <?php

                $no=1;

                foreach($data as $d):

                ?>

                <tr>

                    <td>

                        <?= $no++ ?>

                    </td>

                    <td>

                        <?= date('d-m-Y',strtotime($d->tanggal)); ?>

                    </td>

                    <td>

                        <?= $d->kode_unit ?>

                        -

                        <?= $d->nama_unit ?>

                    </td>

                    <td>

                        <?= $d->kode_kandang ?>

                        -

                        <?= $d->nama_kandang ?>

                    </td>

                    <td class="text-center">

                        <?= number_format($d->jumlah_telur,0,',','.') ?>

                    </td>

                    <td class="text-center">

                        <?= number_format($d->berat_kg,3,',','.') ?>

                        Kg

                    </td>

                    <td>

                        <?= $d->keterangan ?>

                    </td>

                    <td class="text-center">

                        <a href="<?= base_url('produksi_telur/edit/'.$d->id) ?>"
                           class="btn btn-warning btn-sm">

                            <i class="fas fa-edit"></i>

                        </a>

                        <a href="<?= base_url('produksi_telur/hapus/'.$d->id) ?>"
                           onclick="return confirm('Hapus data produksi ini?')"
                           class="btn btn-danger btn-sm">

                            <i class="fas fa-trash"></i>

                        </a>

                    </td>

                </tr>

                <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

</div>