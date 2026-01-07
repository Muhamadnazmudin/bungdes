<div class="container-fluid">

<h1 class="h3 mb-4">Tambah Pajak</h1>

<form method="post">
    <div class="form-group">
        <label>Kode Pajak</label>
        <input type="text" name="kode" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Nama Pajak</label>
        <input type="text" name="nama" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Tarif (%)</label>
        <input type="number" step="0.01" name="tarif" class="form-control" required>
    </div>

    <button class="btn btn-success">Simpan</button>
    <a href="<?= base_url('pajak') ?>" class="btn btn-secondary">Kembali</a>
</form>

</div>
