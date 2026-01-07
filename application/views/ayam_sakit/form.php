<div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">
    <?= isset($row) ? 'Edit Ayam Sakit' : 'Input Ayam Sakit' ?>
</h1>

<form method="post">

    <div class="form-group">
        <label>Tanggal</label>
        <input type="date" name="tanggal" class="form-control"
               value="<?= isset($row) ? $row->tanggal : '' ?>" required>
    </div>

    <div class="form-group">
        <label>Unit Usaha</label>
        <select name="unit_usaha_id" class="form-control" required>
            <?php foreach ($unit as $u): ?>
            <option value="<?= $u->id ?>"
                <?= isset($row) && $row->unit_usaha_id == $u->id ? 'selected' : '' ?>>
                <?= $u->nama ?>
            </option>
            <?php endforeach ?>
        </select>
    </div>

    <div class="form-group">
        <label>Kandang</label>
        <select name="kandang_id" class="form-control" required>
            <?php foreach ($kandang as $k): ?>
            <option value="<?= $k->id ?>"
                <?= isset($row) && $row->kandang_id == $k->id ? 'selected' : '' ?>>
                <?= $k->nama ?>
            </option>
            <?php endforeach ?>
        </select>
    </div>

    <div class="form-group">
        <label>Jumlah Ayam Sakit</label>
        <input type="number" name="jumlah" class="form-control"
               value="<?= isset($row) ? $row->jumlah : '' ?>" required>
    </div>

    <div class="form-group">
        <label>Gejala</label>
        <textarea name="gejala" class="form-control"><?= isset($row) ? $row->gejala : '' ?></textarea>
    </div>

    <div class="form-group">
        <label>Tindakan</label>
        <textarea name="tindakan" class="form-control"><?= isset($row) ? $row->tindakan : '' ?></textarea>
    </div>

    <div class="form-group">
        <label>Keterangan</label>
        <textarea name="keterangan" class="form-control"><?= isset($row) ? $row->keterangan : '' ?></textarea>
    </div>

    <button class="btn btn-success">Simpan</button>
    <a href="<?= base_url('ayam_sakit') ?>" class="btn btn-secondary">Kembali</a>

</form>

</div>
