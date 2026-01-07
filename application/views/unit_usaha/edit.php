<div class="container-fluid">

<h1 class="h3 mb-4">Edit Unit Usaha</h1>

<form method="post">
    <div class="form-group">
        <label>Kode Unit</label>
        <input type="text" name="kode" class="form-control" value="<?= $unit->kode ?>" required>
    </div>

    <div class="form-group">
        <label>Nama Unit Usaha</label>
        <input type="text" name="nama" class="form-control" value="<?= $unit->nama ?>" required>
    </div>

    <div class="form-group">
        <label>Keterangan</label>
        <textarea name="keterangan" class="form-control"><?= $unit->keterangan ?></textarea>
    </div>

    <div class="form-group">
        <label>Status</label>
        <select name="aktif" class="form-control">
            <option value="1" <?= $unit->aktif ? 'selected':'' ?>>Aktif</option>
            <option value="0" <?= !$unit->aktif ? 'selected':'' ?>>Nonaktif</option>
        </select>
    </div>

    <button class="btn btn-success">Update</button>
    <a href="<?= base_url('unit_usaha') ?>" class="btn btn-secondary">Kembali</a>
</form>

</div>
