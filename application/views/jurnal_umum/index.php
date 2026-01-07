<div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">Jurnal Umum</h1>

<table class="table table-bordered table-striped">
<thead>
<tr>
    <th>Tanggal</th>
    <th>No Bukti</th>
    <th>Uraian</th>
    <th>Unit Usaha</th>
    <th>Akun</th>
    <th class="text-right">Debit</th>
    <th class="text-right">Kredit</th>
</tr>
</thead>
<tbody>

<?php if (empty($jurnal)): ?>
<tr>
    <td colspan="7" class="text-center text-muted">
        Belum ada data jurnal
    </td>
</tr>
<?php endif; ?>

<?php foreach ($jurnal as $j): ?>
<tr>
    <td><?= $j->tanggal ?></td>
    <td><?= $j->no_bukti ?></td>
    <td><?= $j->keterangan ?></td>
    <td><?= $j->nama_unit ?? '-' ?></td>
    <td><?= $j->kode_akun ?> - <?= $j->nama_akun ?></td>
    <td class="text-right">
        <?= $j->debit > 0 ? number_format($j->debit,0,',','.') : '' ?>
    </td>
    <td class="text-right">
        <?= $j->kredit > 0 ? number_format($j->kredit,0,',','.') : '' ?>
    </td>
</tr>
<?php endforeach; ?>

</tbody>
</table>

</div>
