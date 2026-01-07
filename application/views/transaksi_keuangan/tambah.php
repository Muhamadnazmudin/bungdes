<div class="container-fluid">

<h1 class="h3 mb-4">Input Transaksi Keuangan</h1>

<form method="post">

    <div class="form-group">
        <label>Tanggal</label>
        <input type="date" name="tanggal" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Jenis Transaksi</label>
        <select name="jenis" class="form-control" required>
            <option value="">-- Pilih --</option>
            <option value="MASUK">Uang Masuk</option>
            <option value="KELUAR">Uang Keluar</option>
        </select>
    </div>

    <div class="form-group">
        <label>Kas / Bank</label>
        <select name="kas_id" class="form-control" required>
            <?php foreach($kas as $k): ?>
                <option value="<?= $k->id ?>">
                    <?= $k->kode ?> - <?= $k->nama ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>

    <div class="form-group">
        <label>Akun</label>
        <select name="akun_id" class="form-control" required>
            <?php foreach($akun as $a): ?>
                <option value="<?= $a->id ?>">
                    <?= $a->kode ?> - <?= $a->nama ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>

    <div class="form-group">
        <label>Unit Usaha</label>
        <select name="unit_usaha_id" class="form-control" required>
            <?php foreach($unit_usaha as $u): ?>
                <option value="<?= $u->id ?>">
                    <?= $u->kode ?> - <?= $u->nama ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>

    <div class="form-group">
        <label>Nominal</label>
        <input type="number" name="nominal" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Keterangan</label>
        <textarea name="keterangan" class="form-control"></textarea>
    </div>

    <button class="btn btn-success">Simpan</button>
    <a href="<?= base_url('transaksi_keuangan') ?>" class="btn btn-secondary">Kembali</a>

</form>

</div>
