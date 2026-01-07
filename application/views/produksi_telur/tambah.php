<div class="container-fluid">

<h1 class="h3 mb-4">Input Produksi Telur</h1>

<form method="post">

    <div class="form-group">
        <label>Tanggal</label>
        <input type="date" name="tanggal" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Unit Usaha</label>
        <select name="unit_usaha_id" class="form-control" required>
            <option value="">-- Pilih Unit Usaha --</option>
            <?php foreach ($unit_usaha as $u): ?>
                <option value="<?= $u->id ?>">
                    <?= $u->kode ?> - <?= $u->nama ?>
                </option>
            <?php endforeach ?>
        </select>
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
    <label>Jumlah Telur (Butir)</label>
    <input type="number"
           name="jumlah_telur"
           class="form-control"
           required>
</div>

<div class="form-group">
    <label>Berat Telur</label>
    <div class="row">
        <div class="col-md-6">
            <input type="number"
                   name="berat_kg"
                   class="form-control"
                   placeholder="Kg"
                   min="0"
                   required>
        </div>
        <div class="col-md-6">
            <input type="number"
                   name="berat_gram"
                   class="form-control"
                   placeholder="Gram"
                   min="0"
                   max="999"
                   required>
        </div>
    </div>
</div>


    <div class="form-group">
        <label>Keterangan</label>
        <textarea name="keterangan" class="form-control"></textarea>
    </div>

    <button class="btn btn-success">Simpan</button>
    <a href="<?= base_url('produksi_telur') ?>" class="btn btn-secondary">Kembali</a>

</form>

</div>
