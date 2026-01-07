<div class="container-fluid">

<h1 class="h3 mb-4">Edit Pajak</h1>

<form method="post">
    <div class="form-group">
        <label>Kode Pajak</label>
        <input type="text" name="kode" class="form-control" value="<?= $pajak->kode ?>" required>
    </div>

    <div class="form-group">
        <label>Nama Pajak</label>
        <input type="text" name="nama" class="form-control" value="<?= $pajak->nama ?>" required>
    </div>

    <div class="form-group">
        <label>Tarif (%)</label>
        <input type="number" step="0.01" name="tarif" class="form-control" value="<?= $pajak->tarif ?>" required>
    </div>

    <div class="form-group">
        <label>Status</label>
        <select name="aktif" class="form-control">
            <option value="1" <?= $pajak->aktif ? 'selected':'' ?>>Aktif</option>
            <option value="0" <?= !$pajak->aktif ? 'selected':'' ?>>Nonaktif</option>
        </select>
    </div>

    <button class="btn btn-success">Update</button>
    <a href="<?= base_url('pajak') ?>" class="btn btn-secondary">Kembali</a>
</form>

</div>
