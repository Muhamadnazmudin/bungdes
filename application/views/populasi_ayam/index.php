<div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">Populasi Ayam</h1>

<a href="<?= base_url('populasi_ayam/tambah') ?>" class="btn btn-primary mb-3">
    Input Populasi
</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Kandang</th>
            <th>Jumlah Ayam</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $d): ?>
        <tr>
            <td><?= $d->tanggal ?></td>
            <td><?= $d->nama_kandang ?></td>
            <td><?= $d->jumlah ?></td>
            <td><?= $d->keterangan ?></td>
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
