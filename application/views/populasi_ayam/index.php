<div class="container-fluid page-content">

    <!-- ================= PAGE HEADING ================= -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
        <h1 class="h4 mb-3 mb-md-0 page-title">
            Populasi Ayam
        </h1>

        <a href="<?= base_url('populasi_ayam/tambah') ?>" class="btn btn-primary btn-sm">
            <i class="fas fa-plus mr-1"></i> Input Populasi
        </a>
    </div>

    <!-- ================= DESKTOP TABLE ================= -->
    <div class="card d-none d-md-block">
        <div class="card-body table-responsive">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th width="140">Tanggal</th>
                        <th>Kandang</th>
                        <th width="160">Jumlah Ayam</th>
                        <th>Keterangan</th>
                        <th width="140">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($data as $d): ?>
                    <tr>
                        <td><?= date('d-m-Y', strtotime($d->tanggal)) ?></td>
                        <td><?= $d->nama_kandang ?></td>
                        <td>
                            <span class="badge badge-info">
                                <?= number_format($d->jumlah) ?>
                            </span>
                        </td>
                        <td><?= $d->keterangan ?: '-' ?></td>
                        <td>
                            <a href="<?= base_url('populasi_ayam/edit/'.$d->id) ?>"
                               class="btn btn-sm btn-warning">
                                Edit
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ================= MOBILE CARD VIEW ================= -->
    <div class="d-md-none">

        <?php foreach ($data as $d): ?>
            <div class="card mb-3 shadow-sm">
                <div class="card-body p-3">

                    <!-- judul dan waktu -->
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <div class="font-weight-bold mb-1">
                                <?= $d->nama_kandang ?>
                            </div>
                            <small class="text-muted">
                                <?= date('d-m-Y', strtotime($d->tanggal)) ?>
                            </small>
                        </div>

                        <span class="badge badge-info">
                            <?= number_format($d->jumlah) ?>
                        </span>
                    </div>

                    <!-- KETERANGAN -->
                    <?php if (!empty($d->keterangan)): ?>
                        <div class="mb-3 text-muted">
                            <?= $d->keterangan ?>
                        </div>
                    <?php endif; ?>

                    <hr class="my-3">

                    <!-- ACTION BUTTON -->
                    <div class="d-flex">
                        <a href="<?= base_url('populasi_ayam/edit/'.$d->id) ?>"
                           class="btn btn-warning btn-sm flex-fill">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </a>
                    </div>

                </div>
            </div>
        <?php endforeach ?>

    </div>

</div>
