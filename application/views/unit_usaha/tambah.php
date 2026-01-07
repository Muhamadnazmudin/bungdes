<div class="container-fluid">

<h1 class="h3 mb-4">Tambah Unit Usaha</h1>

<form method="post">
    <div class="form-group">
        <label>Kode Unit</label>
        <input type="text" name="kode" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Nama Unit Usaha</label>
        <input type="text" name="nama" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Keterangan</label>
        <textarea name="keterangan" class="form-control"></textarea>
    </div>

    <button class="btn btn-success">Simpan</button>
    <a href="<?= base_url('unit_usaha') ?>" class="btn btn-secondary">Kembali</a>
</form>

</div>
