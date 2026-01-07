<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Tambah Kandang</h1>

    <form method="post">

        <div class="form-group">
            <label>Kode Kandang</label>
            <input type="text"
                   name="kode"
                   class="form-control"
                   placeholder="KD-01"
                   required>
        </div>

        <div class="form-group">
            <label>Nama Kandang</label>
            <input type="text"
                   name="nama"
                   class="form-control"
                   placeholder="Kandang Utama"
                   required>
        </div>

        <div class="form-group">
            <label>Kapasitas Ayam</label>
            <input type="number"
                   name="kapasitas"
                   class="form-control"
                   placeholder="1000"
                   required>
        </div>

        <div class="form-group">
            <label>Keterangan</label>
            <textarea name="keterangan"
                      class="form-control"
                      placeholder="Opsional"></textarea>
        </div>

        <button class="btn btn-success">
            Simpan
        </button>

        <a href="<?= base_url('kandang') ?>" class="btn btn-secondary">
            Kembali
        </a>

    </form>

</div>
