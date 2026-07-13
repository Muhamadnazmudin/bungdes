<div class="container-fluid">

<?php

/* ==========================================================
| DATA LAPORAN
========================================================== */

$pendapatan       = $laporan['pendapatan'];
$beban            = $laporan['beban'];

$total_pendapatan = $laporan['total_pendapatan'];
$total_beban      = $laporan['total_beban'];

$laba_usaha       = $laporan['laba_usaha'];

$master_shu       = $laporan['master_shu'];

$sisa_shu         = $laporan['sisa_shu'];

$total_pembagian  = $laporan['total_pembagian'];

$laba             = $laporan['laba'];

$ppn              = $laporan['ppn'];

$laba_bersih      = $laporan['laba_bersih'];


/* ==========================================================
| MASTER BULAN
========================================================== */

$nama_bulan = [

    1  => 'Januari',
    2  => 'Februari',
    3  => 'Maret',
    4  => 'April',
    5  => 'Mei',
    6  => 'Juni',
    7  => 'Juli',
    8  => 'Agustus',
    9  => 'September',
    10 => 'Oktober',
    11 => 'November',
    12 => 'Desember'

];

?>


<!-- ==========================================================
     PAGE HEADER
========================================================== -->

<div class="d-sm-flex align-items-center justify-content-between mb-4">

    <h1 class="h3 mb-0 text-gray-800">

        <?= $title ?>

    </h1>

</div>



<!-- ==========================================================
     FILTER
========================================================== -->

<div class="card shadow mb-4">

    <div class="card-header py-3">

        <h6 class="m-0 font-weight-bold text-primary">

            Filter Laporan

        </h6>

    </div>

    <div class="card-body">

        <form method="get">

            <div class="row">

                <div class="col-md-4">

                    <label>Bulan</label>

                    <select
                        name="bulan"
                        class="form-control">

                        <option value="">

                            Semua Bulan

                        </option>

                        <?php foreach($nama_bulan as $k=>$v): ?>

                            <option
                                value="<?= $k ?>"
                                <?= ($bulan==$k)?'selected':'' ?>>

                                <?= $v ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>



                <div class="col-md-3">

                    <label>Tahun</label>

                    <select
                        name="tahun"
                        class="form-control">

                        <?php for($i=date('Y')-5;$i<=date('Y')+5;$i++): ?>

                            <option
                                value="<?= $i ?>"
                                <?= ($tahun==$i)?'selected':'' ?>>

                                <?= $i ?>

                            </option>

                        <?php endfor; ?>

                    </select>

                </div>



                <div class="col-md-5">

                    <label>&nbsp;</label>

                    <div>

                        <button
                            class="btn btn-primary">

                            <i class="fas fa-search"></i>

                            Tampilkan

                        </button>

                        <a
                            href="<?= base_url('laba_rugi/cetak_pdf?bulan='.$bulan.'&tahun='.$tahun) ?>"
                            class="btn btn-danger">

                            <i class="fas fa-file-pdf"></i>

                            PDF

                        </a>

                        <a
                            href="<?= base_url('laba_rugi/export_excel?bulan='.$bulan.'&tahun='.$tahun) ?>"
                            class="btn btn-success">

                            <i class="fas fa-file-excel"></i>

                            Excel

                        </a>

                    </div>

                </div>

            </div>

        </form>

    </div>

</div>



<!-- ==========================================================
     STATUS POSTING SHU
========================================================== -->

<div class="card shadow mb-4">

    <div class="card-header py-3">

        <h6 class="m-0 font-weight-bold text-info">

            Status Posting SHU

        </h6>

    </div>

    <div class="card-body">

        <div class="row align-items-center">

            <div class="col-md-8">

                <?php if($posting_shu): ?>

                    <div class="alert alert-success mb-0">

                        <h5>

                            <i class="fas fa-check-circle"></i>

                            SHU Sudah Diposting

                        </h5>

                        <small>

                            Tanggal Posting :

                            <strong>

                                <!-- <?= date('d-m-Y H:i',strtotime($posting_shu->tanggal_posting)) ?> -->

                            </strong>

                        </small>

                    </div>

                <?php else: ?>

                    <div class="alert alert-warning mb-0">

                        <h5>

                            <i class="fas fa-exclamation-triangle"></i>

                            SHU Belum Diposting

                        </h5>

                        <small>

                            Laporan ini masih berupa simulasi.

                        </small>

                    </div>

                <?php endif; ?>

            </div>



            <div class="col-md-4 text-right">

                <?php if(!$posting_shu): ?>

                    <form
                        action="<?= base_url('transaksi_keuangan/posting_shu') ?>"
                        method="post"
                        onsubmit="return confirm('Posting SHU akan membuat transaksi keuangan beserta jurnal.\n\nLanjutkan?');">

                        <input
                            type="hidden"
                            name="bulan"
                            value="<?= $bulan ?>">

                        <input
                            type="hidden"
                            name="tahun"
                            value="<?= $tahun ?>">

                        <button
                            class="btn btn-warning btn-lg">

                            <i class="fas fa-upload"></i>

                            Posting SHU

                        </button>

                    </form>

                <?php else: ?>

                    <button
                        class="btn btn-success btn-lg"
                        disabled>

                        <i class="fas fa-check"></i>

                        Sudah Diposting

                    </button>

                <?php endif; ?>

            </div>

        </div>

    </div>

</div>



<!-- ==========================================================
     LAPORAN
========================================================== -->

<div class="card shadow">

    <div class="card-body">

        <div class="text-center mb-4">

            <h4 class="font-weight-bold">

                BUMDES

            </h4>

            <h5>

                UNIT USAHA PETERNAKAN AYAM PETELUR

            </h5>

            <h4 class="font-weight-bold">

                LAPORAN LABA RUGI

            </h4>

            <p>

                Periode

                <strong>

                    <?= $bulan ? $nama_bulan[$bulan] : 'Januari s/d Desember' ?>

                    <?= $tahun ?>

                </strong>

            </p>

        </div>

        <table class="table table-bordered">

            <thead class="bg-light">

                <tr>

                    <th width="60" class="text-center">

                        No

                    </th>

                    <th>

                        Uraian

                    </th>

                    <th width="220" class="text-right">

                        Jumlah (Rp)

                    </th>

                </tr>

            </thead>

            <tbody>
                <!-- ==========================================================
     A. PENDAPATAN
========================================================== -->

<tr class="table-secondary font-weight-bold">

    <td class="text-center">

        A

    </td>

    <td colspan="2">

        PENDAPATAN

    </td>

</tr>

<?php $no=1; ?>

<?php foreach($pendapatan as $row): ?>

<tr>

    <td class="text-center">

        <?= $no++ ?>

    </td>

    <td>

        <?= $row->nama ?>

    </td>

    <td class="text-right">

        <?= number_format($row->total,0,',','.') ?>

    </td>

</tr>

<?php endforeach; ?>

<tr class="table-light font-weight-bold">

    <td></td>

    <td class="text-right">

        TOTAL PENDAPATAN

    </td>

    <td class="text-right">

        <?= number_format($total_pendapatan,0,',','.') ?>

    </td>

</tr>



<tr>

    <td colspan="3" style="height:15px"></td>

</tr>



<!-- ==========================================================
     B. BEBAN
========================================================== -->

<tr class="table-secondary font-weight-bold">

    <td class="text-center">

        B

    </td>

    <td colspan="2">

        BEBAN

    </td>

</tr>

<?php $no=1; ?>

<?php foreach($beban as $row): ?>

<tr>

    <td class="text-center">

        <?= $no++ ?>

    </td>

    <td>

        <?= $row->nama ?>

    </td>

    <td class="text-right">

        <?= number_format($row->total,0,',','.') ?>

    </td>

</tr>

<?php endforeach; ?>

<tr class="table-light font-weight-bold">

    <td></td>

    <td class="text-right">

        TOTAL BEBAN

    </td>

    <td class="text-right">

        <?= number_format($total_beban,0,',','.') ?>

    </td>

</tr>



<tr>

    <td colspan="3" style="height:15px"></td>

</tr>



<!-- ==========================================================
     C. LABA USAHA
========================================================== -->

<tr class="table-primary font-weight-bold">

    <td class="text-center">

        C

    </td>

    <td>

        LABA USAHA (A - B)

    </td>

    <td class="text-right">

        <?= number_format($laba_usaha,0,',','.') ?>

    </td>

</tr>



<tr>

    <td colspan="3" style="height:18px"></td>

</tr>

<!-- ==========================================================
     D. PEMBAGIAN SHU
========================================================== -->

<tr class="table-secondary font-weight-bold">

    <td class="text-center">

        D

    </td>

    <td colspan="2">

        PEMBAGIAN SHU

    </td>

</tr>

<?php

$no = 1;

foreach($master_shu as $item):

?>

<tr>

    <td class="text-center">

        <?= $no++ ?>

    </td>

    <td>

        <?= $item['nama']; ?>

        <br>

        <small class="text-muted">

            <?= number_format($item['persentase'],2) ?> %

            dari

            <?= ($item['dasar']=='LABA_USAHA')
                ? 'Laba Usaha'
                : 'Sisa SHU'; ?>

        </small>

    </td>

    <td class="text-right">

        <?= number_format($item['nominal'],0,',','.') ?>

    </td>

</tr>

<?php endforeach; ?>



<tr class="table-light font-weight-bold">

    <td></td>

    <td>

        SISA SHU

    </td>

    <td class="text-right">

        <?= number_format($sisa_shu,0,',','.') ?>

    </td>

</tr>



<tr class="table-light font-weight-bold">

    <td></td>

    <td>

        TOTAL PEMBAGIAN SHU

    </td>

    <td class="text-right">

        <?= number_format($total_pembagian,0,',','.') ?>

    </td>

</tr>



<tr>

    <td colspan="3" style="height:18px"></td>

</tr>



<!-- ==========================================================
     E. LABA SEBELUM PAJAK
========================================================== -->

<tr class="table-warning font-weight-bold">

    <td class="text-center">

        E

    </td>

    <td>

        LABA SEBELUM PAJAK

    </td>

    <td class="text-right">

        <?= number_format($laba,0,',','.') ?>

    </td>

</tr>



<tr>

    <td></td>

    <td>

        PPN (12%)

    </td>

    <td class="text-right">

        <?= number_format($ppn,0,',','.') ?>

    </td>

</tr>



<tr class="table-success font-weight-bold">

    <td class="text-center">

        F

    </td>

    <td>

        LABA BERSIH

    </td>

    <td class="text-right">

        <?= number_format($laba_bersih,0,',','.') ?>

    </td>

</tr>
</tbody>

</table>

<hr>

<div class="row">

    <div class="col-md-7">

        <?php if($posting_shu): ?>

            <div class="alert alert-success mb-0">

                <h5>

                    <i class="fas fa-check-circle"></i>

                    SHU Sudah Diposting

                </h5>

                <p class="mb-1">

                    Tanggal Posting

                </p>

                <strong>

                    <!-- <?= date('d-m-Y H:i',strtotime($posting_shu->tanggal_posting)); ?> -->

                </strong>

                <hr>

                <small>

                    Posting SHU telah menghasilkan transaksi pada:

                    <ul class="mb-0 mt-2">

                        <li>Transaksi Keuangan</li>

                        <li>Jurnal Umum</li>

                        <li>Buku Besar</li>

                        <li>Buku Kas Umum</li>

                        <li>Arus Kas</li>

                        <li>Neraca</li>

                    </ul>

                </small>

            </div>

        <?php else: ?>

            <div class="alert alert-warning mb-0">

                <h5>

                    <i class="fas fa-exclamation-triangle"></i>

                    SHU Belum Diposting

                </h5>

                <p class="mb-0">

                    Nilai pembagian SHU di atas masih berupa simulasi.

                    Setelah dilakukan <strong>Posting SHU</strong>,
                    sistem akan membuat transaksi keuangan secara otomatis
                    sesuai data Master SHU.

                </p>

            </div>

        <?php endif; ?>

    </div>



    <div class="col-md-5 text-right align-self-center">

        <?php if(!$posting_shu): ?>

            <form
                action="<?= base_url('transaksi_keuangan/posting_shu'); ?>"
                method="post"
                onsubmit="return confirm('Posting SHU akan membuat transaksi keuangan dan jurnal otomatis.\n\nLanjutkan ?');">

                <input
                    type="hidden"
                    name="bulan"
                    value="<?= $bulan; ?>">

                <input
                    type="hidden"
                    name="tahun"
                    value="<?= $tahun; ?>">

                <button
                    class="btn btn-warning btn-lg">

                    <i class="fas fa-upload"></i>

                    Posting SHU

                </button>

            </form>

        <?php else: ?>

            <button
                class="btn btn-success btn-lg"
                disabled>

                <i class="fas fa-check"></i>

                Sudah Diposting

            </button>

        <?php endif; ?>

    </div>

</div>

</div>

</div>

</div>