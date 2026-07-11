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

                Form Edit Transaksi

            </h6>

        </div>

        <div class="card-body">

            <form action="<?= base_url('transaksi_keuangan/update/'.$transaksi->id) ?>" method="post">

                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>Tanggal</label>

                            <input type="date"
                                   name="tanggal"
                                   class="form-control"
                                   value="<?= $transaksi->tanggal ?>"
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

                                <option value="MASUK"
                                    <?= ($transaksi->jenis=='MASUK') ? 'selected' : '' ?>>

                                    Kas Masuk

                                </option>

                                <option value="KELUAR"
                                    <?= ($transaksi->jenis=='KELUAR') ? 'selected' : '' ?>>

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

                                <?php foreach($kas as $k): ?>

                                    <option value="<?= $k->id ?>"
                                        <?= ($k->id==$transaksi->kas_id)?'selected':'' ?>>

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

                                <?php foreach($akun as $a): ?>

                                    <option value="<?= $a->id ?>"
                                        <?= ($a->id==$transaksi->akun_id)?'selected':'' ?>>

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

                                <?php foreach($unit_usaha as $u): ?>

                                    <option value="<?= $u->id ?>"
                                        <?= ($u->id==$transaksi->unit_usaha_id)?'selected':'' ?>>

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
                                   value="<?= $transaksi->nominal ?>"
                                   required>

                        </div>

                    </div>

                </div>


                <div class="form-group">

                    <label>Keterangan</label>

                    <textarea name="keterangan"
                              rows="4"
                              class="form-control"><?= $transaksi->keterangan ?></textarea>

                </div>


                <hr>

                <button class="btn btn-primary">

                    <i class="fas fa-save"></i>

                    Update

                </button>

                <a href="<?= base_url('transaksi_keuangan') ?>"
                   class="btn btn-secondary">

                    Batal

                </a>

            </form>

        </div>

    </div>

</div>