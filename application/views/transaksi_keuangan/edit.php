<div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">Edit Transaksi Keuangan</h1>

<form method="post">

    <div class="form-group">
        <label>Tanggal</label>
        <input type="date"
               name="tanggal"
               class="form-control"
               value="<?= $transaksi->tanggal ?>"
               required>
    </div>

    <div class="form-group">
        <label>Jenis Transaksi</label>
        <select name="jenis" class="form-control" required>
            <option value="MASUK" <?= $transaksi->jenis=='MASUK'?'selected':'' ?>>Uang Masuk</option>
            <option value="KELUAR" <?= $transaksi->jenis=='KELUAR'?'selected':'' ?>>Uang Keluar</option>
        </select>
    </div>

    <div class="form-group">
        <label>Kas / Bank</label>
        <select name="kas_id" class="form-control" required>
            <?php foreach ($kas as $k): ?>
                <option value="<?= $k->id ?>"
                    <?= $transaksi->kas_id == $k->id ? 'selected' : '' ?>>
                    <?= $k->kode ?> - <?= $k->nama ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>

    <div class="form-group">
        <label>Akun</label>
        <select name="akun_id" class="form-control" required>
            <?php foreach ($akun as $a): ?>
                <option value="<?= $a->id ?>"
                    <?= $transaksi->akun_id == $a->id ? 'selected' : '' ?>>
                    <?= $a->kode ?> - <?= $a->nama ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>

    <div class="form-group">
        <label>Unit Usaha</label>
        <select name="unit_usaha_id" class="form-control" required>
            <?php foreach ($unit as $u): ?>
                <option value="<?= $u->id ?>"
                    <?= $transaksi->unit_usaha_id == $u->id ? 'selected' : '' ?>>
                    <?= $u->nama ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>

    <div class="form-group">
        <label>Nominal</label>
        <input type="number"
               name="nominal"
               class="form-control"
               value="<?= $transaksi->nominal ?>"
               required>
    </div>

    <div class="form-group">
        <label>Keterangan</label>
        <textarea name="keterangan"
                  class="form-control"
                  rows="3"><?= $transaksi->keterangan ?></textarea>
    </div>

    <button class="btn btn-success">
        Update
    </button>

    <a href="<?= base_url('transaksi_keuangan') ?>"
       class="btn btn-secondary">
        Kembali
    </a>

</form>

</div>
