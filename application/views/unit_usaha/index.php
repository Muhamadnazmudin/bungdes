<div class="container-fluid page-content">


    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <h1 class="h4 mb-2 mb-md-0 text-white">
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
                            <span class="badge badge-<?= $u->aktif ? 'success':'secondary' ?>">
                                <?= $u->aktif ? 'Aktif':'Nonaktif' ?>
                            </span>
                        </td>
                        <td>
                            <a href="<?= base_url('unit_usaha/edit/'.$u->id) ?>"
                               class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <?php if ($u->aktif): ?>
                                <a href="<?= base_url('unit_usaha/delete/'.$u->id) ?>"
                                   onclick="return confirm('Nonaktifkan unit usaha ini?')"
                                   class="btn btn-sm btn-danger">
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
            <div class="card mb-3">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <strong><?= $u->nama ?></strong>
                        <span class="badge badge-<?= $u->aktif ? 'success':'secondary' ?>">
                            <?= $u->aktif ? 'Aktif':'Nonaktif' ?>
                        </span>
                    </div>

                    <div class="text-muted mb-3">
                        Kode: <?= $u->kode ?>
                    </div>

                    <div class="d-flex">
                        <a href="<?= base_url('unit_usaha/edit/'.$u->id) ?>"
                           class="btn btn-sm btn-warning mr-2">
                            Edit
                        </a>

                        <?php if ($u->aktif): ?>
                            <a href="<?= base_url('unit_usaha/delete/'.$u->id) ?>"
                               onclick="return confirm('Nonaktifkan unit usaha ini?')"
                               class="btn btn-sm btn-danger">
                                Nonaktifkan
                            </a>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        <?php endforeach ?>

    </div>

</div>
