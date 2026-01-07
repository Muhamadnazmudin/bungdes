<div class="container-fluid page-content">

<h1 class="h3 mb-4 text-gray-800">Ayam Sakit</h1>

<a href="<?= base_url('ayam_sakit/tambah') ?>" class="btn btn-primary mb-3">
    Input Ayam Sakit
</a>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Unit Usaha</th>
            <th>Kandang</th>
            <th>Jumlah</th>
            <th>Gejala</th>
            <th>Tindakan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $d): ?>
        <tr>
            <td><?= $d->tanggal ?></td>
            <td><?= $d->nama_unit ?></td>
            <td><?= $d->nama_kandang ?></td>
            <td><?= $d->jumlah ?></td>
            <td><?= $d->gejala ?></td>
            <td><?= $d->tindakan ?></td>
            <td>
                <a href="<?= base_url('ayam_sakit/edit/'.$d->id) ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="<?= base_url('ayam_sakit/hapus/'.$d->id) ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Yakin hapus data?')">
                   Hapus
                </a>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

</div>
