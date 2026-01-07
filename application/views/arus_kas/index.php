<div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">Laporan Arus Kas</h1>

<?php
function nilai_kas($r) {
    return $r->debit > 0 ? $r->debit : -$r->kredit;
}
?>

<!-- ================= OPERASIONAL ================= -->
<h5>Arus Kas dari Aktivitas Operasional</h5>
<table class="table table-bordered">
<thead>
<tr>
    <th>Tanggal</th>
    <th>Keterangan</th>
    <th class="text-right">Jumlah</th>
</tr>
</thead>
<tbody>
<?php $total_op = 0; ?>
<?php foreach ($operasional as $o): ?>
<?php
    $kas = nilai_kas($o);
    $total_op += $kas;
?>
<tr>
    <td><?= $o->tanggal ?></td>
    <td><?= $o->keterangan ?></td>
    <td class="text-right"><?= number_format($kas,0,',','.') ?></td>
</tr>
<?php endforeach ?>
<tr class="font-weight-bold">
    <td colspan="2">Total Operasional</td>
    <td class="text-right"><?= number_format($total_op,0,',','.') ?></td>
</tr>
</tbody>
</table>

<!-- ================= INVESTASI ================= -->
<h5>Arus Kas dari Aktivitas Investasi / Pengembangan Usaha</h5>
<table class="table table-bordered">
<thead>
<tr>
    <th>Tanggal</th>
    <th>Keterangan</th>
    <th class="text-right">Jumlah</th>
</tr>
</thead>
<tbody>
<?php $total_inv = 0; ?>
<?php foreach ($investasi as $i): ?>
<?php
    $kas = nilai_kas($i);
    $total_inv += $kas;
?>
<tr>
    <td><?= $i->tanggal ?></td>
    <td><?= $i->keterangan ?></td>
    <td class="text-right"><?= number_format($kas,0,',','.') ?></td>
</tr>
<?php endforeach ?>
<tr class="font-weight-bold">
    <td colspan="2">Total Investasi</td>
    <td class="text-right"><?= number_format($total_inv,0,',','.') ?></td>
</tr>
</tbody>
</table>

<!-- ================= PENDANAAN ================= -->
<h5>Arus Kas dari Aktivitas Pendanaan</h5>
<table class="table table-bordered">
<thead>
<tr>
    <th>Tanggal</th>
    <th>Keterangan</th>
    <th class="text-right">Jumlah</th>
</tr>
</thead>
<tbody>
<?php $total_pen = 0; ?>
<?php foreach ($pendanaan as $p): ?>
<?php
    $kas = nilai_kas($p);
    $total_pen += $kas;
?>
<tr>
    <td><?= $p->tanggal ?></td>
    <td><?= $p->keterangan ?></td>
    <td class="text-right"><?= number_format($kas,0,',','.') ?></td>
</tr>
<?php endforeach ?>
<tr class="font-weight-bold">
    <td colspan="2">Total Pendanaan</td>
    <td class="text-right"><?= number_format($total_pen,0,',','.') ?></td>
</tr>
</tbody>
</table>

<!-- ================= TOTAL ================= -->
<h4 class="mt-4">
    Kenaikan / Penurunan Kas Bersih :
    <?= number_format($total_op + $total_inv + $total_pen,0,',','.') ?>
</h4>

</div>
