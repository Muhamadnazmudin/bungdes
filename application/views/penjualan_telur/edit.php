<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>

        <a href="<?= base_url('penjualan_telur') ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

    </div>

    <?php if($this->session->flashdata('error')) : ?>

        <div class="alert alert-danger">

            <?= $this->session->flashdata('error'); ?>

        </div>

    <?php endif; ?>

    <div class="row">

        <!-- Informasi Stok -->
        <div class="col-lg-4">

            <div class="card shadow mb-4 border-left-warning">

                <div class="card-header py-3">

                    <h6 class="m-0 font-weight-bold text-warning">

                        Informasi Stok

                    </h6>

                </div>

                <div class="card-body text-center">

                    <h2 class="font-weight-bold text-warning">

                        <?= number_format($stok,2,',','.') ?>

                    </h2>

                    <h5>Kg</h5>

                    <hr>

                    <small class="text-muted">

                        Sisa stok telur saat ini.

                    </small>

                </div>

            </div>

        </div>

        <!-- Form -->
        <div class="col-lg-8">

            <div class="card shadow mb-4">

                <div class="card-header py-3">

                    <h6 class="m-0 font-weight-bold text-primary">

                        Edit Penjualan Telur

                    </h6>

                </div>

                <div class="card-body">

                    <form action="<?= base_url('penjualan_telur/update/'.$row->id) ?>" method="post">

                        <input type="hidden"
                               name="unit_usaha_id"
                               value="<?= $row->unit_usaha_id ?>">

                        <div class="form-group">

                            <label>Tanggal</label>

                            <input
                                type="date"
                                name="tanggal"
                                class="form-control"
                                value="<?= $row->tanggal ?>"
                                required>

                        </div>

                        <div class="form-group">

                            <label>Nama Pembeli</label>

                            <input
                                type="text"
                                name="pembeli"
                                class="form-control"
                                value="<?= $row->pembeli ?>"
                                required>

                        </div>

                        <div class="form-group">

                            <label>Berat (Kg)</label>

                            <input
                                type="number"
                                step="0.01"
                                min="0.01"
                                id="berat_kg"
                                name="berat_kg"
                                class="form-control"
                                value="<?= $row->berat_kg ?>"
                                required>

                        </div>

                        <div class="form-group">

                            <label>Harga per Kg</label>

                            <input
                                type="number"
                                id="harga_kg"
                                name="harga_kg"
                                class="form-control"
                                value="<?= $row->harga_kg ?>"
                                required>

                        </div>

                        <div class="form-group">

                            <label>Total Penjualan</label>

                            <input
                                type="text"
                                id="total_view"
                                class="form-control bg-light"
                                readonly>

                            <input
                                type="hidden"
                                id="total"
                                name="total"
                                value="<?= $row->total ?>">

                        </div>

                        <div class="form-group">

                            <label>Keterangan</label>

                            <textarea
                                name="keterangan"
                                class="form-control"
                                rows="3"><?= $row->keterangan ?></textarea>

                        </div>

                        <hr>

                        <button class="btn btn-primary">

                            <i class="fas fa-save"></i>

                            Update

                        </button>

                        <a href="<?= base_url('penjualan_telur') ?>"
                           class="btn btn-secondary">

                            Batal

                        </a>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

function hitungTotal(){

    const kgInput = document.getElementById('berat_kg');
    const hargaInput = document.getElementById('harga_kg');
    const totalInput = document.getElementById('total');
    const totalView = document.getElementById('total_view');

    if(!kgInput || !hargaInput || !totalInput || !totalView){
        return;
    }

    let kg = parseFloat(kgInput.value) || 0;
    let harga = parseFloat(hargaInput.value) || 0;

    let total = kg * harga;

    totalInput.value = total;

    totalView.value = 'Rp ' + total.toLocaleString('id-ID');

}

document.addEventListener('DOMContentLoaded', function(){

    hitungTotal();

    document.getElementById('berat_kg').addEventListener('input', hitungTotal);

    document.getElementById('harga_kg').addEventListener('input', hitungTotal);

});

</script>