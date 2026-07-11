<div class="container-fluid page-content">

    <!-- ================= PAGE HEADING ================= -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
        <h1 class="h4 mb-3 mb-md-0 page-title">
            Kandang
        </h1>

        <a href="<?= base_url('kandang/tambah') ?>" class="btn btn-primary btn-sm">
            <i class="fas fa-plus mr-1"></i> Tambah Kandang
        </a>
    </div>

    <!-- ================= DESKTOP TABLE ================= -->
    <div class="card d-none d-md-block">
        <div class="card-body table-responsive">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th width="120">Kode</th>
                        <th>Nama</th>
                        <th width="160">Kapasitas</th>
                        <th width="140">Status</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($kandang as $k): ?>
                    <tr>
                        <td><?= $k->kode ?></td>
                        <td><?= $k->nama ?></td>
                        <td>
                            <span class="badge badge-info">
                                <?= number_format($k->kapasitas) ?>
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-<?= $k->aktif ? 'success' : 'secondary' ?>">
                                <?= $k->aktif ? 'Aktif' : 'Nonaktif' ?>
                            </span>
                        </td>
                        <td>
                            <a href="<?= base_url('kandang/edit/'.$k->id) ?>"
                               class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <?php if ($k->aktif && $this->session->userdata('role_id') == 1): ?>
                                <a href="<?= base_url('kandang/delete/'.$k->id) ?>"
                                   onclick="return confirm('Nonaktifkan kandang ini?')"
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

        <?php foreach ($kandang as $k): ?>
            <div class="card mb-3 shadow-sm">
                <div class="card-body p-3">

                    <!-- TITLE & STATUS -->
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <div class="font-weight-bold mb-1">
                                <?= $k->nama ?>
                            </div>
                            <small class="text-muted">
                                Kode: <?= $k->kode ?>
                            </small>
                        </div>

                        <span class="badge badge-<?= $k->aktif ? 'success' : 'secondary' ?>">
                            <?= $k->aktif ? 'Aktif' : 'Nonaktif' ?>
                        </span>
                    </div>

                    <!-- KAPASITAS -->
                    <div class="mb-3">
                        <span class="badge badge-info">
                            Kapasitas: <?= number_format($k->kapasitas) ?>
                        </span>
                    </div>

                    <hr class="my-3">

                    <!-- ACTION BUTTON -->
                    <div class="d-flex">
                        <a href="<?= base_url('kandang/edit/'.$k->id) ?>"
                           class="btn btn-warning btn-sm flex-fill mr-2">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </a>

                        <?php if ($k->aktif && $this->session->userdata('role_id') == 1): ?>
                            <a href="<?= base_url('kandang/delete/'.$k->id) ?>"
                               onclick="return confirm('Nonaktifkan kandang ini?')"
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
