<div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">
    <?= isset($row) ? 'Edit Ayam Mati' : 'Input Ayam Mati' ?>
</h1>

<form method="post">

    <div class="form-group">
        <label>Tanggal</label>
        <input type="date" name="tanggal" class="form-control"
               value="<?= isset($row) ? $row->tanggal : '' ?>" required>
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
        <label>Jumlah Ayam Mati</label>
        <input type="number" name="jumlah" class="form-control"
               value="<?= isset($row) ? $row->jumlah : '' ?>" required>
    </div>

    <div class="form-group">
        <label>Sebab</label>
        <textarea name="sebab" class="form-control"><?= isset($row) ? $row->sebab : '' ?></textarea>
    </div>

    <button class="btn btn-success">Simpan</button>
    <a href="<?= base_url('ayam_mati') ?>" class="btn btn-secondary">Kembali</a>

</form>

</div>
