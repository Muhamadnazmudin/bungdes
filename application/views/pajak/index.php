<div class="container-fluid page-content">

    <!-- ================= PAGE HEADING ================= -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
        <h1 class="h4 mb-3 mb-md-0 page-title">
            Master Pajak
        </h1>

        <a href="<?= base_url('pajak/tambah') ?>" class="btn btn-primary btn-sm">
            <i class="fas fa-plus mr-1"></i> Tambah Pajak
        </a>
    </div>

    <!-- ================= DESKTOP TABLE ================= -->
    <div class="card d-none d-md-block">
        <div class="card-body table-responsive">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th width="120">Kode</th>
                        <th>Nama Pajak</th>
                        <th width="120">Tarif (%)</th>
                        <th width="140">Status</th>
                        <th width="140">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($pajak as $p): ?>
                    <tr>
                        <td><?= $p->kode ?></td>
                        <td><?= $p->nama ?></td>
                        <td>
                            <span class="badge badge-primary">
                                <?= number_format($p->tarif, 2) ?> %
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-<?= $p->aktif ? 'success' : 'secondary' ?>">
                                <?= $p->aktif ? 'Aktif' : 'Nonaktif' ?>
                            </span>
                        </td>
                        <td>
                            <a href="<?= base_url('pajak/edit/'.$p->id) ?>"
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

        <?php foreach ($pajak as $p): ?>
            <div class="card mb-3 shadow-sm">
                <div class="card-body p-3">

                    <!-- TITLE & STATUS -->
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <div class="font-weight-bold mb-1">
                                <?= $p->nama ?>
                            </div>
                            <small class="text-muted">
                                Kode: <?= $p->kode ?>
                            </small>
                        </div>

                        <span class="badge badge-<?= $p->aktif ? 'success' : 'secondary' ?>">
                            <?= $p->aktif ? 'Aktif' : 'Nonaktif' ?>
                        </span>
                    </div>

                    <!-- TARIF -->
                    <div class="mb-3">
                        <span class="badge badge-primary">
                            Tarif: <?= number_format($p->tarif, 2) ?> %
                        </span>
                    </div>

                    <hr class="my-3">

                    <!-- ACTION BUTTON -->
                    <div class="d-flex">
                        <a href="<?= base_url('pajak/edit/'.$p->id) ?>"
                           class="btn btn-warning btn-sm flex-fill">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </a>
                    </div>

                </div>
            </div>
        <?php endforeach ?>

    </div>

</div>
