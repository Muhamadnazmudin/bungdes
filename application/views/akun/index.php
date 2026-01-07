<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Master Akun</h1>

    <a href="<?= base_url('akun/tambah') ?>" class="btn btn-primary mb-3">
        Tambah Akun
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Akun</th>
                <th>Jenis</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($akun as $a): ?>
            <tr>
                <td><?= $a->kode ?></td>
                <td><?= $a->nama ?></td>
                <td><?= $a->jenis ?></td>
                <td>
    <span class="badge badge-<?= $a->aktif ? 'success':'secondary' ?>">
        <?= $a->aktif ? 'Aktif':'Nonaktif' ?>
    </span>
</td>

<td>
    <a href="<?= base_url('akun/edit/'.$a->id) ?>" class="btn btn-sm btn-warning">
        Edit
    </a>

    <?php if ($a->aktif && $this->session->userdata('role_id') == 1): ?>
        <a href="<?= base_url('akun/delete/'.$a->id) ?>"
           onclick="return confirm('Nonaktifkan akun ini?')"
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
