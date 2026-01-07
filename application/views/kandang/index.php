<div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">Kandang</h1>

<a href="<?= base_url('kandang/tambah') ?>" class="btn btn-primary mb-3">
    Tambah Kandang
</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Kapasitas</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($kandang as $k): ?>
        <tr>
            <td><?= $k->kode ?></td>
            <td><?= $k->nama ?></td>
            <td><?= $k->kapasitas ?></td>
            <td>
                <span class="badge badge-<?= $k->aktif ? 'success':'secondary' ?>">
                    <?= $k->aktif ? 'Aktif':'Nonaktif' ?>
                </span>
            </td>
            <td>
                <a href="<?= base_url('kandang/edit/'.$k->id) ?>" class="btn btn-sm btn-warning">
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
