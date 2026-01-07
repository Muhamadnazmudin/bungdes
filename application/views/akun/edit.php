<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Edit Akun</h1>

    <form method="post">

        <div class="form-group">
            <label>Kode Akun</label>
            <input type="text"
                   name="kode"
                   class="form-control"
                   value="<?= $akun->kode ?>"
                   required>
        </div>

        <div class="form-group">
            <label>Nama Akun</label>
            <input type="text"
                   name="nama"
                   class="form-control"
                   value="<?= $akun->nama ?>"
                   required>
        </div>

        <div class="form-group">
            <label>Jenis Akun</label>
            <select name="jenis" class="form-control" required>
                <option value="ASET" <?= $akun->jenis == 'ASET' ? 'selected' : '' ?>>ASET</option>
                <option value="KEWAJIBAN" <?= $akun->jenis == 'KEWAJIBAN' ? 'selected' : '' ?>>KEWAJIBAN</option>
                <option value="MODAL" <?= $akun->jenis == 'MODAL' ? 'selected' : '' ?>>MODAL</option>
                <option value="PENDAPATAN" <?= $akun->jenis == 'PENDAPATAN' ? 'selected' : '' ?>>PENDAPATAN</option>
                <option value="BEBAN" <?= $akun->jenis == 'BEBAN' ? 'selected' : '' ?>>BEBAN</option>
            </select>
        </div>
<div class="form-group">
    <label>Parent Akun (Opsional)</label>
    <select name="parent_id" class="form-control">
        <option value="">-- Tidak Ada --</option>
        <?php foreach ($parent as $p): ?>
            <option value="<?= $p->id ?>"
                <?= ($akun->parent_id == $p->id) ? 'selected' : '' ?>>
                <?= $p->kode ?> - <?= $p->nama ?>
            </option>
        <?php endforeach ?>
    </select>
</div>

<div class="form-group">
    <label>Status Akun</label>
    <select name="aktif" class="form-control" required>
        <option value="1" <?= $akun->aktif == 1 ? 'selected' : '' ?>>
            Aktif
        </option>
        <option value="0" <?= $akun->aktif == 0 ? 'selected' : '' ?>>
            Nonaktif
        </option>
    </select>
</div>

                    
        <button class="btn btn-success">
            Update
        </button>

        <a href="<?= base_url('akun') ?>" class="btn btn-secondary">
            Kembali
        </a>

    </form>

</div>
