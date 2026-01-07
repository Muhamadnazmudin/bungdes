<div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">Ayam Mati</h1>

<a href="<?= base_url('ayam_mati/tambah') ?>" class="btn btn-danger mb-3">
    Input Ayam Mati
</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Kandang</th>
            <th>Jumlah</th>
            <th>Sebab</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $d): ?>
        <tr>
            <td><?= $d->tanggal ?></td>
            <td><?= $d->nama_kandang ?></td>
            <td><?= $d->jumlah ?></td>
            <td><?= $d->sebab ?></td>
            <td>
                <a href="<?= base_url('ayam_mati/edit/'.$d->id) ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="<?= base_url('ayam_mati/hapus/'.$d->id) ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Yakin hapus?')">Hapus</a>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>


</div>
