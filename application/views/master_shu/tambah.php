<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <h1 class="h3 mb-0 text-gray-800">

            <?= $title ?>

        </h1>

        <a href="<?= base_url('master_shu') ?>"
           class="btn btn-secondary">

            <i class="fas fa-arrow-left"></i>

            Kembali

        </a>

    </div>

    <div class="card shadow">

        <div class="card-header py-3">

            <h6 class="m-0 font-weight-bold text-primary">

                Form Master SHU

            </h6>

        </div>

        <div class="card-body">

            <form method="post"
                  action="<?= base_url('master_shu/simpan') ?>">

                <div class="form-group">

                    <label>Nama Komponen SHU</label>

                    <input
                        type="text"
                        name="nama"
                        class="form-control"
                        required>

                </div>

                <div class="form-group">

                    <label>Akun Beban</label>

                    <select
                        name="akun_id"
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

                <div class="form-group">

                    <label>Dasar Perhitungan</label>

                    <select
                        name="dasar"
                        class="form-control"
                        required>

                        <option value="LABA_USAHA">

                            LABA USAHA

                        </option>

                        <option value="SISA_SHU">

                            SISA SHU

                        </option>

                    </select>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>Persentase (%)</label>

                            <input
                                type="number"
                                step="0.01"
                                name="persentase"
                                class="form-control"
                                required>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>Urutan</label>

                            <input
                                type="number"
                                name="urutan"
                                class="form-control"
                                value="1"
                                required>

                        </div>

                    </div>

                </div>

                <hr>

                <button
                    class="btn btn-success">

                    <i class="fas fa-save"></i>

                    Simpan

                </button>

                <a href="<?= base_url('master_shu') ?>"
                   class="btn btn-secondary">

                    Batal

                </a>

            </form>

        </div>

    </div>

</div>