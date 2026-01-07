<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Edit Kandang</h1>

    <form method="post">

        <div class="form-group">
            <label>Kode Kandang</label>
            <input type="text"
                   name="kode"
                   class="form-control"
                   value="<?= $kandang->kode ?>"
                   required>
        </div>

        <div class="form-group">
            <label>Nama Kandang</label>
            <input type="text"
                   name="nama"
                   class="form-control"
                   value="<?= $kandang->nama ?>"
                   required>
        </div>

        <div class="form-group">
            <label>Kapasitas Ayam</label>
            <input type="number"
                   name="kapasitas"
                   class="form-control"
                   value="<?= $kandang->kapasitas ?>"
                   required>
        </div>

        <div class="form-group">
            <label>Keterangan</label>
            <textarea name="keterangan"
                      class="form-control"><?= $kandang->keterangan ?></textarea>
        </div>

        <div class="form-group">
            <label>Status Kandang</label>
            <select name="aktif" class="form-control" required>
                <option value="1" <?= $kandang->aktif == 1 ? 'selected' : '' ?>>
                    Aktif
                </option>
                <option value="0" <?= $kandang->aktif == 0 ? 'selected' : '' ?>>
                    Nonaktif
                </option>
            </select>
        </div>

        <button class="btn btn-success">
            Update
        </button>

        <a href="<?= base_url('kandang') ?>" class="btn btn-secondary">
            Kembali
        </a>

    </form>

</div>
