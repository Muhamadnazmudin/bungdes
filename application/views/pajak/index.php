<div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">Master Pajak</h1>

<a href="<?= base_url('pajak/tambah') ?>" class="btn btn-primary mb-3">
    Tambah Pajak
</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Kode</th>
            <th>Nama Pajak</th>
            <th>Tarif (%)</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($pajak as $p): ?>
        <tr>
            <td><?= $p->kode ?></td>
            <td><?= $p->nama ?></td>
            <td><?= $p->tarif ?></td>
            <td>
                <span class="badge badge-<?= $p->aktif ? 'success':'secondary' ?>">
                    <?= $p->aktif ? 'Aktif':'Nonaktif' ?>
                </span>
            </td>
            <td>
                <a href="<?= base_url('pajak/edit/'.$p->id) ?>" class="btn btn-sm btn-warning">
                    Edit
                </a>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>

</div>
