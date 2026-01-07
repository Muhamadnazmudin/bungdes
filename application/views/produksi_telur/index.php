<div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">Produksi Telur</h1>

<a href="<?= base_url('produksi_telur/tambah') ?>" class="btn btn-primary mb-3">
    Input Produksi
</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Unit Usaha</th>
            <th>Kandang</th>
            <th>Jumlah Telur</th>
            <th>Berat</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $d): ?>
        <tr>
            <td><?= $d->tanggal ?></td>
            <td><?= $d->nama_unit ?></td>
            <td><?= $d->nama_kandang ?></td>
            <td><?= $d->jumlah_telur ?></td>
            <td>
<?php
    $totalKg = $d->berat_kg + ($d->berat_gram / 1000);

    // jika bilangan bulat, tampil tanpa desimal
    if (floor($totalKg) == $totalKg) {
        echo number_format($totalKg, 0, ',', '.') . ' kg';
    } else {
        echo rtrim(rtrim(number_format($totalKg, 3, ',', '.'), '0'), ',') . ' kg';
    }
?>
</td>

            <td><?= $d->keterangan ?></td>
            <td>
                <a href="<?= base_url('produksi_telur/edit/'.$d->id) ?>"
                   class="btn btn-sm btn-warning">
                    Edit
                </a>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>

</div>
