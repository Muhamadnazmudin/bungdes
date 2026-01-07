<div class="container-fluid">

<h1 class="h3 mb-4">Input Populasi Ayam</h1>

<form method="post">

    <div class="form-group">
        <label>Tanggal</label>
        <input type="date" name="tanggal" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Kandang</label>
        <select name="kandang_id" class="form-control" required>
            <option value="">-- Pilih Kandang --</option>
            <?php foreach ($kandang as $k): ?>
                <option value="<?= $k->id ?>">
                    <?= $k->kode ?> - <?= $k->nama ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>

    <div class="form-group">
        <label>Jumlah Ayam</label>
        <input type="number" name="jumlah" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Keterangan</label>
        <textarea name="keterangan" class="form-control"></textarea>
    </div>

    <button class="btn btn-success">Simpan</button>
    <a href="<?= base_url('populasi_ayam') ?>" class="btn btn-secondary">Kembali</a>

</form>

</div>
