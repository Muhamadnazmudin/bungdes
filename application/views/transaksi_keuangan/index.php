<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <h1 class="h3 mb-0 text-gray-800">
            <?= $title ?>
        </h1>

        <a href="<?= base_url('transaksi_keuangan/tambah') ?>"
           class="btn btn-primary shadow-sm">

            <i class="fas fa-plus"></i>
            Tambah Transaksi

        </a>

    </div>

    <?php if($this->session->flashdata('success')) : ?>

        <div class="alert alert-success alert-dismissible fade show">

            <?= $this->session->flashdata('success'); ?>

            <button type="button"
                    class="close"
                    data-dismiss="alert">

                &times;

            </button>

        </div>

    <?php endif; ?>


    <?php if($this->session->flashdata('error')) : ?>

        <div class="alert alert-danger alert-dismissible fade show">

            <?= $this->session->flashdata('error'); ?>

            <button type="button"
                    class="close"
                    data-dismiss="alert">

                &times;

            </button>

        </div>

    <?php endif; ?>


    <?php

    $masuk = 0;
    $keluar = 0;

    foreach($data as $r){

        if($r->jenis=='MASUK'){

            $masuk += $r->nominal;

        }else{

            $keluar += $r->nominal;

        }

    }

    ?>

    <div class="row">

        <div class="col-lg-4 mb-4">

            <div class="card border-left-success shadow h-100">

                <div class="card-body">

                    <div class="text-xs font-weight-bold text-success text-uppercase mb-2">

                        Total Kas Masuk

                    </div>

                    <div class="h4 font-weight-bold text-gray-800">

                        Rp <?= number_format($masuk,0,',','.') ?>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-4 mb-4">

            <div class="card border-left-danger shadow h-100">

                <div class="card-body">

                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-2">

                        Total Kas Keluar

                    </div>

                    <div class="h4 font-weight-bold text-gray-800">

                        Rp <?= number_format($keluar,0,',','.') ?>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-4 mb-4">

            <div class="card border-left-primary shadow h-100">

                <div class="card-body">

                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">

                        Saldo

                    </div>

                    <div class="h4 font-weight-bold text-gray-800">

                        Rp <?= number_format($masuk-$keluar,0,',','.') ?>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <div class="card shadow mb-4">

        <div class="card-header py-3">

            <h6 class="m-0 font-weight-bold text-primary">

                Data Transaksi Keuangan

            </h6>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover" id="dataTable">

                    <thead class="bg-primary text-white">

                    <tr>

                        <th width="50">No</th>

                        <th>Tanggal</th>

                        <th>Jenis</th>

                        <th>Kas / Bank</th>

                        <th>Akun</th>

                        <th>Unit Usaha</th>

                        <th class="text-right">Nominal</th>

                        <th>Keterangan</th>

                        <th width="130" class="text-center">

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

                        <td><?= $no++ ?></td>

                        <td>

                            <?= date('d-m-Y',strtotime($d->tanggal)); ?>

                        </td>

                        <td>

                            <?php if($d->jenis=='MASUK'): ?>

                                <span class="badge badge-success">

                                    MASUK

                                </span>

                            <?php else: ?>

                                <span class="badge badge-danger">

                                    KELUAR

                                </span>

                            <?php endif; ?>

                        </td>

                        <td>

                            <?= $d->nama_kas ?>

                        </td>

                        <td>

                            <?= $d->kode_akun ?>

                            -

                            <?= $d->nama_akun ?>

                        </td>

                        <td>

                            <?= $d->nama_unit ?>

                        </td>

                        <td class="text-right">

                            Rp <?= number_format($d->nominal,0,',','.') ?>

                        </td>

                        <td>

                            <?= $d->keterangan ?>

                        </td>

                        <td class="text-center">

                            <a href="<?= base_url('transaksi_keuangan/edit/'.$d->id) ?>"
                               class="btn btn-warning btn-sm">

                                <i class="fas fa-edit"></i>

                            </a>

                            <a href="<?= base_url('transaksi_keuangan/hapus/'.$d->id) ?>"
                               onclick="return confirm('Hapus transaksi ini?')"
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