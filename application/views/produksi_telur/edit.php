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

                Form Edit Produksi Telur

            </h6>

        </div>

        <div class="card-body">

            <form action="<?= base_url('produksi_telur/update/'.$data->id) ?>" method="post">

                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>Tanggal Produksi</label>

                            <input
                                type="date"
                                name="tanggal"
                                class="form-control"
                                value="<?= $data->tanggal ?>"
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

                                <?php foreach($unit_usaha as $u): ?>

                                    <option value="<?= $u->id ?>"
                                        <?= ($u->id==$data->unit_usaha_id)?'selected':'' ?>>

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

                                <?php foreach($kandang as $k): ?>

                                    <option value="<?= $k->id ?>"
                                        <?= ($k->id==$data->kandang_id)?'selected':'' ?>>

                                        <?= $k->kode ?> - <?= $k->nama ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>Jumlah Produksi (Butir)</label>

                            <input
                                type="number"
                                name="jumlah_telur"
                                class="form-control"
                                min="1"
                                value="<?= $data->jumlah_telur ?>"
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
                        value="<?= number_format($data->berat_kg,3,'.','') ?>"
                        required>

                    <small class="text-muted">

                        Contoh :
                        <strong>568.325</strong>

                    </small>

                </div>


                <div class="form-group">

                    <label>Keterangan</label>

                    <textarea
                        name="keterangan"
                        rows="4"
                        class="form-control"><?= $data->keterangan ?></textarea>

                </div>

                <hr>

                <button
                    type="submit"
                    class="btn btn-primary">

                    <i class="fas fa-save"></i>

                    Update

                </button>

                <a href="<?= base_url('produksi_telur') ?>"
                   class="btn btn-secondary">

                    Batal

                </a>

            </form>

        </div>

    </div>

</div>