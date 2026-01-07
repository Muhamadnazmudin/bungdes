<div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">Laporan Laba Rugi</h1>

<div class="row">

<!-- PENDAPATAN -->
<div class="col-md-6">
    <h5>PENDAPATAN</h5>
    <table class="table table-bordered">
        <tbody>
        <?php $total_pendapatan = 0; ?>
        <?php foreach ($pendapatan as $p): ?>
            <?php $total_pendapatan += $p->total; ?>
            <tr>
                <td><?= $p->kode ?> - <?= $p->nama ?></td>
                <td class="text-right"><?= number_format($p->total,0,',','.') ?></td>
            </tr>
        <?php endforeach ?>
        <tr class="font-weight-bold">
            <td>Total Pendapatan</td>
            <td class="text-right"><?= number_format($total_pendapatan,0,',','.') ?></td>
        </tr>
        </tbody>
    </table>
</div>

<!-- BEBAN -->
<div class="col-md-6">
    <h5>BEBAN</h5>
    <table class="table table-bordered">
        <tbody>
        <?php $total_beban = 0; ?>
        <?php foreach ($beban as $b): ?>
            <?php $total_beban += $b->total; ?>
            <tr>
                <td><?= $b->kode ?> - <?= $b->nama ?></td>
                <td class="text-right"><?= number_format($b->total,0,',','.') ?></td>
            </tr>
        <?php endforeach ?>
        <tr class="font-weight-bold">
            <td>Total Beban</td>
            <td class="text-right"><?= number_format($total_beban,0,',','.') ?></td>
        </tr>
        </tbody>
    </table>
</div>

</div>

<hr>

<?php
$laba_rugi = $total_pendapatan - $total_beban;
?>

<h4 class="text-center">
    <?php if ($laba_rugi >= 0): ?>
        LABA BERSIH :
        <span class="text-success">
            <?= number_format($laba_rugi,0,',','.') ?>
        </span>
    <?php else: ?>
        RUGI BERSIH :
        <span class="text-danger">
            <?= number_format(abs($laba_rugi),0,',','.') ?>
        </span>
    <?php endif ?>
</h4>

</div>
