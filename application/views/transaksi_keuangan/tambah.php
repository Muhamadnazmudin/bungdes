<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <h1 class="h3 mb-0 text-gray-800">
            <?= $title ?>
        </h1>

        <a href="<?= base_url('transaksi_keuangan') ?>"
           class="btn btn-secondary">

            <i class="fas fa-arrow-left"></i>

            Kembali

        </a>

    </div>


    <div class="card shadow mb-4">

        <div class="card-header py-3">

            <h6 class="m-0 font-weight-bold text-primary">

                Form Tambah Transaksi

            </h6>

        </div>

        <div class="card-body">

            <form action="<?= base_url('transaksi_keuangan/simpan') ?>" method="post">

                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>Tanggal</label>

                            <input type="date"
                                   name="tanggal"
                                   class="form-control"
                                   value="<?= date('Y-m-d') ?>"
                                   required>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>Jenis Transaksi</label>

                            <select name="jenis"
                                    class="form-control"
                                    required>

                                <option value="">-- Pilih --</option>

                                <option value="MASUK">

                                    Kas Masuk

                                </option>

                                <option value="KELUAR">

                                    Kas Keluar

                                </option>

                            </select>

                        </div>

                    </div>

                </div>


                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>Kas / Bank</label>

                            <select name="kas_id"
                                    class="form-control"
                                    required>

                                <option value="">-- Pilih Kas --</option>

                                <?php foreach($kas as $k): ?>

                                    <option value="<?= $k->id ?>">

                                        <?= $k->nama ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>Akun</label>

                            <select name="akun_id"
                                    class="form-control"
                                    required>

                                <option value="">-- Pilih Akun --</option>

                                <?php foreach($akun as $a): ?>

                                    <option value="<?= $a->id ?>">

                                        <?= $a->kode ?>

                                        -

                                        <?= $a->nama ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                    </div>

                </div>


                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>Unit Usaha</label>

                            <select name="unit_usaha_id"
                                    class="form-control"
                                    required>

                                <option value="">-- Pilih Unit Usaha --</option>

                                <?php foreach($unit_usaha as $u): ?>

                                    <option value="<?= $u->id ?>">

                                        <?= $u->nama ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>Nominal</label>

                            <input type="number"
                                   name="nominal"
                                   class="form-control"
                                   min="1"
                                   placeholder="0"
                                   required>

                        </div>

                    </div>

                </div>


                <div class="form-group">

                    <label>Keterangan</label>

                    <textarea name="keterangan"
                              class="form-control"
                              rows="4"
                              placeholder="Masukkan keterangan transaksi..."></textarea>

                </div>


                <hr>

                <button type="submit"
                        class="btn btn-success">

                    <i class="fas fa-save"></i>

                    Simpan

                </button>

                <a href="<?= base_url('transaksi_keuangan') ?>"
                   class="btn btn-secondary">

                    Batal

                </a>

            </form>

        </div>

    </div>

</div>