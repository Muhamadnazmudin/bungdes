<div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">Ayam Hidup</h1>
<a href="<?= site_url('ayam_hidup/cetak_pdf') ?>"
   class="btn btn-danger btn-sm mb-3">
   Cetak PDF
</a>


<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Kandang</th>
            <th>Keterangan</th>
            <th>Jumlah</th>
            <th>Masuk (Hidup)</th>
            <th>Keluar (Mati)</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $d): ?>
        <tr>
            <td><?= $d['tanggal'] ?></td>
            <td><?= $d['kandang'] ?></td>
            <td><?= $d['keterangan'] ?></td>
            <td><?= $d['jumlah'] ?></td>
            <td><?= $d['masuk'] ?></td>
            <td><?= $d['keluar'] ?></td>
            <td><strong><?= $d['total'] ?></strong></td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

</div>
