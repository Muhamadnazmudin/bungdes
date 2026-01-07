<div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">Kas & Bank</h1>

<a href="<?= base_url('kas/tambah') ?>" class="btn btn-primary mb-3">
    Tambah Kas
</a>

<table class="table table-bordered">
<thead>
<tr>
    <th>Kode</th>
    <th>Nama</th>
    <th>Tipe</th>
    <th>Akun Kas</th>
    <th>Saldo Awal</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>
</thead>
<tbody>
<?php foreach($kas as $k): ?>
<tr>
    <td><?= $k->kode ?></td>
    <td><?= $k->nama ?></td>
    <td><?= $k->tipe ?></td>
    <td><?= $k->kode_akun ?> - <?= $k->nama_akun ?></td>
    <td><?= number_format($k->saldo_awal,0,',','.') ?></td>
    <td><?= $k->aktif ? 'Aktif':'Nonaktif' ?></td>
    <td>
        <a href="<?= base_url('kas/edit/'.$k->id) ?>" class="btn btn-sm btn-warning">
            Edit
        </a>
    </td>
</tr>
<?php endforeach ?>
</tbody>
</table>

</div>
