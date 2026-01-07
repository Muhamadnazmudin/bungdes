<div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">Neraca</h1>

<div class="row">

<!-- ASET -->
<div class="col-md-6">
    <h5>ASET</h5>
    <table class="table table-bordered">
        <tbody>
        <?php $total_aset = 0; ?>
        <?php foreach ($aset as $a): ?>
            <?php $total_aset += $a->saldo; ?>
            <tr>
                <td><?= $a->kode ?> - <?= $a->nama ?></td>
                <td class="text-right"><?= number_format($a->saldo,0,',','.') ?></td>
            </tr>
        <?php endforeach ?>
        <tr class="font-weight-bold">
            <td>Total Aset</td>
            <td class="text-right"><?= number_format($total_aset,0,',','.') ?></td>
        </tr>
        </tbody>
    </table>
</div>

<!-- KEWAJIBAN + MODAL -->
<div class="col-md-6">
    <h5>KEWAJIBAN</h5>
    <table class="table table-bordered">
        <tbody>
        <?php $total_kewajiban = 0; ?>
        <?php foreach ($kewajiban as $k): ?>
            <?php $total_kewajiban += $k->saldo; ?>
            <tr>
                <td><?= $k->kode ?> - <?= $k->nama ?></td>
                <td class="text-right"><?= number_format($k->saldo,0,',','.') ?></td>
            </tr>
        <?php endforeach ?>
        <tr class="font-weight-bold">
            <td>Total Kewajiban</td>
            <td class="text-right"><?= number_format($total_kewajiban,0,',','.') ?></td>
        </tr>
        </tbody>
    </table>

    <h5 class="mt-4">MODAL</h5>
<table class="table table-bordered">
    <tbody>

    <?php $total_modal_awal = 0; ?>
    <?php foreach ($modal as $m): ?>
        <?php $total_modal_awal += $m->saldo; ?>
        <tr>
            <td><?= $m->kode ?> - <?= $m->nama ?></td>
            <td class="text-right">
                <?= number_format($m->saldo, 0, ',', '.') ?>
            </td>
        </tr>
    <?php endforeach; ?>

    <!-- LABA / RUGI BERJALAN -->
    <tr>
        <td>Laba / Rugi Berjalan</td>
        <td class="text-right">
            <?= number_format($laba_ditahan, 0, ',', '.') ?>
        </td>
    </tr>

    <!-- TOTAL MODAL AKHIR -->
    <?php $total_modal_akhir = $total_modal_awal + $laba_ditahan; ?>
    <tr class="font-weight-bold">
        <td>Total Modal</td>
        <td class="text-right">
            <?= number_format($total_modal_akhir, 0, ',', '.') ?>
        </td>
    </tr>

    </tbody>
</table>

<h5 class="font-weight-bold mt-3">
    Total Kewajiban + Modal :
    <?= number_format($total_kewajiban + $total_modal_akhir, 0, ',', '.') ?>
</h5>


</div>
