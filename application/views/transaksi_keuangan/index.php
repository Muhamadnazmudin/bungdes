<div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">Transaksi Keuangan</h1>

<a href="<?= base_url('transaksi_keuangan/tambah') ?>" class="btn btn-primary mb-3">
    Input Transaksi
</a>

<table class="table table-bordered">
<thead>
<tr>
    <th>Tanggal</th>
    <th>Jenis</th>
    <th>Kas</th>
    <th>Akun</th>
    <th>Unit Usaha</th>
    <th>Nominal</th>
    <th>Keterangan</th>
    <th width="120">Aksi</th>
</tr>
</thead>
<tbody>
<?php foreach($data as $d): ?>
<tr>
    <td><?= $d->tanggal ?></td>
    <td>
        <span class="badge badge-<?= $d->jenis=='MASUK'?'success':'danger' ?>">
            <?= $d->jenis ?>
        </span>
    </td>
    <td><?= $d->nama_kas ?></td>
    <td><?= $d->nama_akun ?></td>
    <td><?= $d->nama_unit ?></td>
    <td><?= number_format($d->nominal,0,',','.') ?></td>
    <td><?= $d->keterangan ?></td>
    <td>
        <a href="<?= base_url('transaksi_keuangan/edit/'.$d->id) ?>"
           class="btn btn-sm btn-warning">
            Edit
        </a>
    </td>
</tr>
<?php endforeach ?>
</tbody>
</table>

</div>
