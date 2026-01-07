<div class="container-fluid">

<h1 class="h3 mb-4">Edit Produksi Telur</h1>

<form method="post">

    <div class="form-group">
        <label>Tanggal</label>
        <input type="date"
               name="tanggal"
               class="form-control"
               value="<?= $data->tanggal ?>"
               required>
    </div>

    <div class="form-group">
        <label>Unit Usaha</label>
        <select name="unit_usaha_id" class="form-control" required>
            <?php foreach ($unit_usaha as $u): ?>
                <option value="<?= $u->id ?>"
                    <?= $data->unit_usaha_id == $u->id ? 'selected' : '' ?>>
                    <?= $u->kode ?> - <?= $u->nama ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>

    <div class="form-group">
        <label>Kandang</label>
        <select name="kandang_id" class="form-control" required>
            <?php foreach ($kandang as $k): ?>
                <option value="<?= $k->id ?>"
                    <?= $data->kandang_id == $k->id ? 'selected' : '' ?>>
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
           value="<?= $data->jumlah_telur ?>"
           required>
</div>

<div class="form-group">
    <label>Berat Telur</label>
    <div class="row">
        <div class="col-md-6">
            <input type="number"
                   name="berat_kg"
                   class="form-control"
                   value="<?= $data->berat_kg ?>"
                   min="0"
                   required>
        </div>
        <div class="col-md-6">
            <input type="number"
                   name="berat_gram"
                   class="form-control"
                   value="<?= $data->berat_gram ?>"
                   min="0"
                   max="999"
                   required>
        </div>
    </div>
</div>


    <div class="form-group">
        <label>Keterangan</label>
        <textarea name="keterangan"
                  class="form-control"><?= $data->keterangan ?></textarea>
    </div>

    <button class="btn btn-success">Update</button>
    <a href="<?= base_url('produksi_telur') ?>" class="btn btn-secondary">Kembali</a>

</form>

</div>
