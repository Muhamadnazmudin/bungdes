
<div class="container-fluid page-content">

    <!-- ================= PAGE HEADING ================= -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
        <h1 class="h4 mb-3 mb-md-0 page-title">
            Unit Usaha
        </h1>

        <a href="<?= base_url('unit_usaha/tambah') ?>" class="btn btn-primary btn-sm">
            <i class="fas fa-plus mr-1"></i> Tambah Unit
        </a>
    </div>

    <!-- ================= DESKTOP TABLE ================= -->
    <div class="card d-none d-md-block">
        <div class="card-body table-responsive">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Unit</th>
                        <th>Status</th>
                        <th width="160">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($unit as $u): ?>
                    <tr>
                        <td><?= $u->kode ?></td>
                        <td><?= $u->nama ?></td>
                        <td>
                            <span class="badge badge-<?= $u->aktif ? 'success' : 'secondary' ?>">
                                <?= $u->aktif ? 'Aktif' : 'Nonaktif' ?>
                            </span>
                        </td>
                        <td>
                            <a href="<?= base_url('unit_usaha/edit/'.$u->id) ?>"
                               class="btn btn-sm btn-warning mb-1">
                                Edit
                            </a>

                            <?php if ($u->aktif): ?>
                                <a href="<?= base_url('unit_usaha/delete/'.$u->id) ?>"
                                   onclick="return confirm('Nonaktifkan unit usaha ini?')"
                                   class="btn btn-sm btn-danger mb-1">
                                    Nonaktifkan
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ================= MOBILE CARD VIEW ================= -->
    <div class="d-md-none">

        <?php foreach ($unit as $u): ?>
            <div class="card mb-3 shadow-sm">
                <div class="card-body p-3">

                    <!-- TITLE & STATUS -->
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <div class="font-weight-bold mb-1">
                                <?= $u->nama ?>
                            </div>
                            <small class="text-muted">
                                Kode: <?= $u->kode ?>
                            </small>
                        </div>

                        <span class="badge badge-<?= $u->aktif ? 'success' : 'secondary' ?>">
                            <?= $u->aktif ? 'Aktif' : 'Nonaktif' ?>
                        </span>
                    </div>

                    <hr class="my-3">

                    <!-- ACTION BUTTON -->
                    <div class="d-flex">
                        <a href="<?= base_url('unit_usaha/edit/'.$u->id) ?>"
                           class="btn btn-warning btn-sm flex-fill mr-2">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </a>

                        <?php if ($u->aktif): ?>
                            <a href="<?= base_url('unit_usaha/delete/'.$u->id) ?>"
                               onclick="return confirm('Nonaktifkan unit usaha ini?')"
                               class="btn btn-danger btn-sm flex-fill">
                                <i class="fas fa-ban mr-1"></i> Nonaktif
                            </a>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        <?php endforeach ?>

    </div>

</div>
