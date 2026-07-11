<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>

        <a href="<?= base_url('penjualan_telur/tambah') ?>" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus"></i> Tambah Penjualan
        </a>
    </div>

    <?php if($this->session->flashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= $this->session->flashdata('success'); ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php endif; ?>

    <?php if($this->session->flashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <?= $this->session->flashdata('error'); ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php endif; ?>


    <div class="row">

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">

                <div class="card-body">

                    <div class="row no-gutters align-items-center">

                        <div class="col mr-2">

                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Produksi
                            </div>

                            <div class="h4 mb-0 font-weight-bold text-gray-800">

                                <?= number_format($total_produksi,2,',','.') ?> Kg

                            </div>

                        </div>

                        <div class="col-auto">

                            <i class="fas fa-egg fa-2x text-gray-300"></i>

                        </div>

                    </div>

                </div>

            </div>
        </div>


        <div class="col-xl-4 col-md-6 mb-4">

            <div class="card border-left-primary shadow h-100 py-2">

                <div class="card-body">

                    <div class="row no-gutters align-items-center">

                        <div class="col mr-2">

                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Terjual
                            </div>

                            <div class="h4 mb-0 font-weight-bold text-gray-800">

                                <?= number_format($total_penjualan,2,',','.') ?> Kg

                            </div>

                        </div>

                        <div class="col-auto">

                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <div class="col-xl-4 col-md-6 mb-4">

            <div class="card border-left-danger shadow h-100 py-2">

                <div class="card-body">

                    <div class="row no-gutters align-items-center">

                        <div class="col mr-2">

                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Sisa Stok
                            </div>

                            <div class="h4 mb-0 font-weight-bold text-gray-800">

                                <?= number_format($stok,2,',','.') ?> Kg

                            </div>

                        </div>

                        <div class="col-auto">

                            <i class="fas fa-box-open fa-2x text-gray-300"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="card shadow mb-4">

        <div class="card-header py-3">

            <h6 class="m-0 font-weight-bold text-primary">

                Data Penjualan Telur

            </h6>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover" id="dataTable">

                    <thead class="bg-primary text-white">

                    <tr>

                        <th width="50">No</th>

                        <th>Tanggal</th>

                        <th>Pembeli</th>

                        <th class="text-center">Berat (Kg)</th>

                        <th class="text-right">Harga / Kg</th>

                        <th class="text-right">Total</th>

                        <th>Keterangan</th>

                        <th width="130" class="text-center">Aksi</th>

                    </tr>

                    </thead>

                    <tbody>

                    <?php
                    $no=1;
                    foreach($data as $d):
                    ?>

                    <tr>

                        <td><?= $no++ ?></td>

                        <td><?= date('d-m-Y',strtotime($d->tanggal)); ?></td>

                        <td><?= $d->pembeli; ?></td>

                        <td class="text-center">

                            <?= number_format($d->berat_kg,2,',','.'); ?>

                        </td>

                        <td class="text-right">

                            Rp <?= number_format($d->harga_kg,0,',','.'); ?>

                        </td>

                        <td class="text-right">

                            <strong>

                                Rp <?= number_format($d->total,0,',','.'); ?>

                            </strong>

                        </td>

                        <td><?= $d->keterangan; ?></td>

                        <td class="text-center">

                            <a href="<?= base_url('penjualan_telur/edit/'.$d->id); ?>"
                               class="btn btn-warning btn-sm">

                                <i class="fas fa-edit"></i>

                            </a>

                            <a href="<?= base_url('penjualan_telur/hapus/'.$d->id); ?>"
                               onclick="return confirm('Yakin ingin menghapus data ini?')"
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