<div class="container-fluid">

<h1 class="h3 mb-4">Edit Kas</h1>

<form method="post">

<div class="form-group">
    <label>Kode</label>
    <input type="text" name="kode" class="form-control" value="<?= $kas->kode ?>">
</div>

<div class="form-group">
    <label>Nama</label>
    <input type="text" name="nama" class="form-control" value="<?= $kas->nama ?>">
</div>

<div class="form-group">
    <label>Tipe</label>
    <select name="tipe" class="form-control">
        <option value="KAS" <?= $kas->tipe=='KAS'?'selected':'' ?>>Kas</option>
        <option value="BANK" <?= $kas->tipe=='BANK'?'selected':'' ?>>Bank</option>
    </select>
</div>

<div class="form-group">
    <label>Akun Kas (COA)</label>
    <select name="akun_id" class="form-control">
        <?php foreach($akun as $a): ?>
            <option value="<?= $a->id ?>" <?= $kas->akun_id==$a->id?'selected':'' ?>>
                <?= $a->kode ?> - <?= $a->nama ?>
            </option>
        <?php endforeach ?>
    </select>
</div>

<div class="form-group">
    <label>Saldo Awal</label>
    <input type="number" name="saldo_awal" class="form-control" value="<?= $kas->saldo_awal ?>">
</div>

<div class="form-group">
    <label>Status</label>
    <select name="aktif" class="form-control">
        <option value="1" <?= $kas->aktif?'selected':'' ?>>Aktif</option>
        <option value="0" <?= !$kas->aktif?'selected':'' ?>>Nonaktif</option>
    </select>
</div>

<button class="btn btn-success">Update</button>
<a href="<?= base_url('kas') ?>" class="btn btn-secondary">Kembali</a>

</form>
</div>
