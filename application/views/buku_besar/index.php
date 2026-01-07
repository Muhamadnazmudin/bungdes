<div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">Buku Besar</h1>

<form method="get" class="form-inline mb-3">
    <select name="akun_id" class="form-control mr-2" required>
        <option value="">-- Pilih Akun --</option>
        <?php foreach ($akun as $a): ?>
            <option value="<?= $a->id ?>"
                <?= ($this->input->get('akun_id') == $a->id) ? 'selected' : '' ?>>
                <?= $a->kode ?> - <?= $a->nama ?>
            </option>
        <?php endforeach ?>
    </select>
    <button class="btn btn-primary">Tampilkan</button>
</form>

<?php if ($akun_aktif): ?>
<h5>
    Akun: <?= $akun_aktif->kode ?> - <?= $akun_aktif->nama ?>
</h5>
<?php endif ?>

<table class="table table-bordered">
<thead>
<tr>
    <th>Tanggal</th>
    <th>No Bukti</th>
    <th>Uraian</th>
    <th class="text-right">Debit</th>
    <th class="text-right">Kredit</th>
    <th class="text-right">Saldo</th>
</tr>
</thead>
<tbody>

<?php foreach ($data as $d): ?>
<tr>
    <td><?= $d->tanggal ?></td>
    <td><?= $d->no_bukti ?></td>
    <td><?= $d->keterangan ?></td>
    <td class="text-right"><?= number_format($d->debit,0,',','.') ?></td>
    <td class="text-right"><?= number_format($d->kredit,0,',','.') ?></td>
    <td class="text-right"><?= number_format($d->saldo,0,',','.') ?></td>
</tr>
<?php endforeach ?>

<?php if (empty($data)): ?>
<tr>
    <td colspan="6" class="text-center">Belum ada transaksi</td>
</tr>
<?php endif ?>

</tbody>
</table>

</div>
