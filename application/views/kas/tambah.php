<div class="container-fluid">

<h1 class="h3 mb-4">Tambah Kas</h1>

<form method="post">

<div class="form-group">
    <label>Kode</label>
    <input type="text" name="kode" class="form-control" required>
</div>

<div class="form-group">
    <label>Nama</label>
    <input type="text" name="nama" class="form-control" required>
</div>

<div class="form-group">
    <label>Tipe</label>
    <select name="tipe" class="form-control" required>
        <option value="KAS">Kas</option>
        <option value="BANK">Bank</option>
    </select>
</div>

<div class="form-group">
    <label>Akun Kas (COA)</label>
    <select name="akun_id" class="form-control" required>
        <?php foreach($akun as $a): ?>
            <option value="<?= $a->id ?>">
                <?= $a->kode ?> - <?= $a->nama ?>
            </option>
        <?php endforeach ?>
    </select>
</div>

<div class="form-group">
    <label>Saldo Awal</label>
    <input type="number" name="saldo_awal" class="form-control" value="0">
</div>

<div class="form-group">
    <label>Keterangan</label>
    <textarea name="keterangan" class="form-control"></textarea>
</div>

<button class="btn btn-success">Simpan</button>
<a href="<?= base_url('kas') ?>" class="btn btn-secondary">Kembali</a>

</form>
</div>
