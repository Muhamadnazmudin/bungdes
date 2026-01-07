<div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">Buku Kas Umum</h1>

<form method="get" class="form-inline mb-3">
    <label class="mr-2">Pilih Kas / Bank</label>
    <select name="kas_id" class="form-control mr-2" required>
        <option value="">-- Pilih --</option>
        <?php foreach ($kas as $k): ?>
            <option value="<?= $k->id ?>"
                <?= $this->input->get('kas_id') == $k->id ? 'selected' : '' ?>>
                <?= $k->kode ?> - <?= $k->nama ?>
            </option>
        <?php endforeach ?>
    </select>
    <button class="btn btn-primary">Tampilkan</button>
</form>

<?php if (!empty($data)): ?>

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

<?php $saldo = 0; ?>
<?php foreach ($data as $d): ?>
<?php $saldo += ($d->debit - $d->kredit); ?>
<tr>
    <td><?= $d->tanggal ?></td>
    <td><?= $d->no_bukti ?></td>
    <td><?= $d->keterangan ?></td>
    <td class="text-right"><?= $d->debit ? number_format($d->debit,0,',','.') : '' ?></td>
    <td class="text-right"><?= $d->kredit ? number_format($d->kredit,0,',','.') : '' ?></td>
    <td class="text-right"><?= number_format($saldo,0,',','.') ?></td>
</tr>
<?php endforeach ?>

</tbody>
</table>

<?php endif ?>

</div>
