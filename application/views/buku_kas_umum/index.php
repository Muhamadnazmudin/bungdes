<div class="container-fluid">

<div class="d-sm-flex align-items-center justify-content-between mb-4">

    <h1 class="h3 mb-0 text-gray-800">
        <?= $title ?>
    </h1>

</div>


<!-- =====================================================
     FILTER
===================================================== -->

<div class="card shadow mb-4">

    <div class="card-header py-3">

        <h6 class="m-0 font-weight-bold text-primary">

            Filter Buku Kas Umum

        </h6>

    </div>

    <div class="card-body">

        <form method="get">

            <div class="row">

                <div class="col-md-4">

                    <label>Kas / Bank</label>

                    <select
                        name="kas_id"
                        class="form-control"
                        required>

                        <option value="">-- Pilih Kas --</option>

                        <?php foreach($kas as $k): ?>

                            <option
                                value="<?= $k->id ?>"
                                <?= ($kas_id==$k->id)?'selected':'' ?>>

                                <?= $k->kode ?>

                                -

                                <?= $k->nama ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="col-md-3">

                    <label>Tanggal Awal</label>

                    <input
                        type="date"
                        name="tgl_awal"
                        class="form-control"
                        value="<?= $tgl_awal ?>">

                </div>

                <div class="col-md-3">

                    <label>Tanggal Akhir</label>

                    <input
                        type="date"
                        name="tgl_akhir"
                        class="form-control"
                        value="<?= $tgl_akhir ?>">

                </div>

                <div class="col-md-2">

                    <label>&nbsp;</label>

                    <button
                        class="btn btn-primary btn-block">

                        <i class="fas fa-search"></i>

                        Tampilkan

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>


<?php if($detail_kas): ?>


<!-- =====================================================
     INFO KAS
===================================================== -->

<div class="row">

    <div class="col-md-3">

        <div class="card border-left-primary shadow mb-4">

            <div class="card-body">

                <small>Saldo Awal</small>

                <h5>

                    Rp

                    <?= number_format($saldo_awal,0,',','.') ?>

                </h5>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card border-left-success shadow mb-4">

            <div class="card-body">

                <small>Total Debit</small>

                <h5>

                    Rp

                    <?= number_format($total_debit,0,',','.') ?>

                </h5>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card border-left-danger shadow mb-4">

            <div class="card-body">

                <small>Total Kredit</small>

                <h5>

                    Rp

                    <?= number_format($total_kredit,0,',','.') ?>

                </h5>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card border-left-info shadow mb-4">

            <div class="card-body">

                <small>Saldo Akhir</small>

                <h5>

                    Rp

                    <?= number_format($saldo_akhir,0,',','.') ?>

                </h5>

            </div>

        </div>

    </div>

</div>


<!-- =====================================================
     TABEL
===================================================== -->

<div class="card shadow">

    <div class="card-header py-3">

        <h6 class="m-0 font-weight-bold text-primary">

            Buku Kas Umum

        </h6>

    </div>

    <div class="card-body table-responsive">

        <table class="table table-bordered table-striped">

            <thead class="bg-light">

                <tr>

                    <th width="60">No</th>

                    <th width="120">Tanggal</th>

                    <th width="160">No Bukti</th>

                    <th>Uraian</th>

                    <th class="text-right" width="170">

                        Debit

                    </th>

                    <th class="text-right" width="170">

                        Kredit

                    </th>

                    <th class="text-right" width="170">

                        Saldo

                    </th>

                </tr>

            </thead>

            <tbody>

            <?php if(empty($data)): ?>

                <tr>

                    <td
                        colspan="7"
                        class="text-center">

                        Tidak ada data.

                    </td>

                </tr>

            <?php else: ?>

                <?php $no=1; ?>

                <?php foreach($data as $d): ?>

                    <tr>

                        <td>

                            <?= $no++ ?>

                        </td>

                        <td>

                            <?= date('d-m-Y',strtotime($d->tanggal)) ?>

                        </td>

                        <td>

                            <?= $d->no_bukti ?>

                        </td>

                        <td>

                            <?= $d->keterangan ?>

                        </td>

                        <td class="text-right">

                            <?= $d->debit
                                ? number_format($d->debit,0,',','.')
                                : '-' ?>

                        </td>

                        <td class="text-right">

                            <?= $d->kredit
                                ? number_format($d->kredit,0,',','.')
                                : '-' ?>

                        </td>

                        <td class="text-right font-weight-bold">

                            <?= number_format(
                                $d->saldo,
                                0,
                                ',',
                                '.'
                            ) ?>

                        </td>

                    </tr>

                <?php endforeach; ?>

            <?php endif; ?>

            </tbody>

            <tfoot class="bg-light font-weight-bold">

                <tr>

                    <td colspan="4" class="text-right">

                        TOTAL

                    </td>

                    <td class="text-right">

                        <?= number_format(
                            $total_debit,
                            0,
                            ',',
                            '.'
                        ) ?>

                    </td>

                    <td class="text-right">

                        <?= number_format(
                            $total_kredit,
                            0,
                            ',',
                            '.'
                        ) ?>

                    </td>

                    <td class="text-right">

                        <?= number_format(
                            $saldo_akhir,
                            0,
                            ',',
                            '.'
                        ) ?>

                    </td>

                </tr>

            </tfoot>

        </table>

    </div>

</div>

<?php endif; ?>

</div>