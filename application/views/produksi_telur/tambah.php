<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <h1 class="h3 mb-0 text-gray-800">
            <?= $title ?>
        </h1>

        <a href="<?= base_url('produksi_telur') ?>"
           class="btn btn-secondary">

            <i class="fas fa-arrow-left"></i>
            Kembali

        </a>

    </div>

    <div class="card shadow mb-4">

        <div class="card-header py-3">

            <h6 class="m-0 font-weight-bold text-primary">

                Form Input Produksi Telur

            </h6>

        </div>

        <div class="card-body">

            <form action="<?= base_url('produksi_telur/simpan') ?>" method="post">

                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>Tanggal Produksi</label>

                            <input
                                type="date"
                                name="tanggal"
                                class="form-control"
                                value="<?= date('Y-m-d') ?>"
                                required>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>Unit Usaha</label>

                            <select
                                name="unit_usaha_id"
                                class="form-control"
                                required>

                                <option value="">-- Pilih Unit Usaha --</option>

                                <?php foreach($unit_usaha as $u): ?>

                                    <option value="<?= $u->id ?>">

                                        <?= $u->kode ?> - <?= $u->nama ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                    </div>

                </div>


                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>Kandang</label>

                            <select
                                name="kandang_id"
                                class="form-control"
                                required>

                                <option value="">-- Pilih Kandang --</option>

                                <?php foreach($kandang as $k): ?>

                                    <option value="<?= $k->id ?>">

                                        <?= $k->kode ?> - <?= $k->nama ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>Jumlah Telur (Butir)</label>

                            <input
                                type="number"
                                name="jumlah_telur"
                                class="form-control"
                                min="1"
                                placeholder="Contoh : 11366"
                                required>

                        </div>

                    </div>

                </div>


                <div class="form-group">

                    <label>Berat Produksi (Kg)</label>

                    <input
                        type="number"
                        name="berat_kg"
                        class="form-control"
                        step="0.001"
                        min="0.001"
                        placeholder="Contoh : 568.325"
                        required>

                    <small class="text-muted">

                        Gunakan titik (.) untuk angka desimal.
                        Contoh:
                        <strong>568.325</strong> berarti 568,325 Kg.

                    </small>

                </div>


                <div class="form-group">

                    <label>Keterangan</label>

                    <textarea
                        name="keterangan"
                        class="form-control"
                        rows="4"
                        placeholder="Masukkan keterangan jika ada..."></textarea>

                </div>

                <hr>

                <button
                    type="submit"
                    class="btn btn-success">

                    <i class="fas fa-save"></i>

                    Simpan

                </button>

                <a href="<?= base_url('produksi_telur') ?>"
                   class="btn btn-secondary">

                    Batal

                </a>

            </form>

        </div>

    </div>

</div>