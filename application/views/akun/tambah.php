<div class="container-fluid">

<h1 class="h3 mb-4">Tambah Akun</h1>

<form method="post">
    <div class="form-group">
        <label>Kode Akun</label>
        <input type="text" name="kode" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Nama Akun</label>
        <input type="text" name="nama" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Jenis Akun</label>
        <select name="jenis" class="form-control" required>
            <option value="ASET">ASET</option>
            <option value="KEWAJIBAN">KEWAJIBAN</option>
            <option value="MODAL">MODAL</option>
            <option value="PENDAPATAN">PENDAPATAN</option>
            <option value="BEBAN">BEBAN</option>
        </select>
    </div>

    <div class="form-group">
        <label>Parent Akun (Opsional)</label>
        <select name="parent_id" class="form-control">
            <option value="">-- Tidak Ada --</option>
            <?php foreach($parent as $p): ?>
                <option value="<?= $p->id ?>">
                    <?= $p->kode ?> - <?= $p->nama ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>

    <button class="btn btn-success">Simpan</button>
    <a href="<?= base_url('akun') ?>" class="btn btn-secondary">Kembali</a>
</form>

</div>
