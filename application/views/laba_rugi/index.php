<div class="container-fluid">

<?php

$total_pendapatan = 0;
$total_biaya      = 0;

$nama_bulan = [
    1=>'Januari',
    2=>'Februari',
    3=>'Maret',
    4=>'April',
    5=>'Mei',
    6=>'Juni',
    7=>'Juli',
    8=>'Agustus',
    9=>'September',
    10=>'Oktober',
    11=>'November',
    12=>'Desember'
];

?>

<!-- =====================================================
     PAGE HEADER
===================================================== -->

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

                        <?php

                        for($i=date('Y')-5;$i<=date('Y')+5;$i++):

                        ?>

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



<!-- =====================================================
     LAPORAN
===================================================== -->

<div class="card shadow">

<div class="card-body">

<div class="text-center mb-4">

    <h4 class="font-weight-bold mb-0">

        BUMDES

    </h4>

    <h5 class="mb-2">

        UNIT USAHA PETERNAKAN AYAM PETELUR

    </h5>

    <h5 class="font-weight-bold">

        LAPORAN LABA RUGI

    </h5>

    <p>

        Periode

        <strong>

        <?php

        if($bulan){

            echo $nama_bulan[$bulan];

        }else{

            echo "Januari s/d Desember";

        }

        ?>

        <?= $tahun ?>

        </strong>

    </p>

</div>



<table class="table table-bordered">

<thead class="bg-light">

<tr>

    <th width="60" class="text-center">

        NO

    </th>

    <th>

        URAIAN

    </th>

    <th width="220" class="text-right">

        JUMLAH (Rp)

    </th>

</tr>

</thead>

<tbody>


<!-- =====================================================
     A. PENDAPATAN
===================================================== -->

<tr class="table-secondary font-weight-bold">

    <td class="text-center">

        A

    </td>

    <td colspan="2">

        PENDAPATAN PENJUALAN

    </td>

</tr>

<?php

$no=1;

foreach($pendapatan as $p):

$total_pendapatan += $p->total;

?>

<tr>

    <td class="text-center">

        <?= $no++ ?>

    </td>

    <td>

        <?= $p->nama ?>

    </td>

    <td class="text-right">

        <?= number_format($p->total,0,',','.') ?>

    </td>

</tr>

<?php endforeach; ?>

<tr class="font-weight-bold bg-light">

    <td></td>

    <td class="text-right">

        Jumlah Pendapatan

    </td>

    <td class="text-right">

        <?= number_format($total_pendapatan,0,',','.') ?>

    </td>

</tr>


<tr>

    <td colspan="3" style="height:15px"></td>

</tr>


<!-- =====================================================
     B. BIAYA PRODUKSI
===================================================== -->

<tr class="table-secondary font-weight-bold">

    <td class="text-center">

        B

    </td>

    <td colspan="2">

        BIAYA PRODUKSI

    </td>

</tr>

<?php

$no=1;

foreach($beban as $b):

$total_biaya += $b->total;

?>

<tr>

    <td class="text-center">

        <?= $no++ ?>

    </td>

    <td>

        <?= $b->nama ?>

    </td>

    <td class="text-right">

        <?= number_format($b->total,0,',','.') ?>

    </td>

</tr>

<?php endforeach; ?>

<tr class="font-weight-bold bg-light">

    <td></td>

    <td class="text-right">

        Jumlah Biaya Produksi

    </td>

    <td class="text-right">

        <?= number_format($total_biaya,0,',','.') ?>

    </td>

</tr>

<?php

$laba_usaha = $total_pendapatan - $total_biaya;

?>

<tr>

    <td colspan="3" style="height:15px"></td>

</tr>

<tr class="table-primary font-weight-bold">

    <td class="text-center">

        C

    </td>

    <td>

        PENDAPATAN USAHA (A - B)

    </td>

    <td class="text-right">

        <?= number_format($laba_usaha,0,',','.') ?>

    </td>

</tr>
<?php

/* =====================================================
   PERSENTASE
===================================================== */

$persen_pengurus      = 30;

$persen_kades         = 5;
$persen_pades         = 25;
$persen_dana_sosial   = 10;
$persen_jasa_produksi = 10;
$persen_cadangan      = 10;
$persen_kesejahteraan = 10;


/* =====================================================
   D. GAJI PENGURUS
===================================================== */

$gaji_pengurus = $laba_usaha * $persen_pengurus / 100;


/* =====================================================
   SISA SHU
===================================================== */

$sisa_shu = $laba_usaha - $gaji_pengurus;


/* =====================================================
   PEMBAGIAN SHU
===================================================== */

$insentif_kades = $sisa_shu * $persen_kades / 100;

$pades = $sisa_shu * $persen_pades / 100;

$dana_sosial = $sisa_shu * $persen_dana_sosial / 100;

$jasa_produksi = $sisa_shu * $persen_jasa_produksi / 100;

$cadangan = $sisa_shu * $persen_cadangan / 100;

$kesejahteraan = $sisa_shu * $persen_kesejahteraan / 100;


/* =====================================================
   TOTAL PEMBAGIAN SHU
===================================================== */

$total_shu =
        $insentif_kades
      + $pades
      + $dana_sosial
      + $jasa_produksi
      + $cadangan
      + $kesejahteraan;

?>

<tr>

    <td colspan="3" style="height:18px;"></td>

</tr>

<!-- =====================================================
     D. GAJI PENGURUS
===================================================== -->

<tr class="table-warning font-weight-bold">

    <td class="text-center">

        D

    </td>

    <td>

        GAJI PENGURUS BUMDES (<?= $persen_pengurus ?>%)

    </td>

    <td class="text-right">

        <?= number_format($gaji_pengurus,0,',','.') ?>

    </td>

</tr>

<tr class="font-weight-bold">

    <td></td>

    <td>

        SISA SHU

    </td>

    <td class="text-right">

        <?= number_format($sisa_shu,0,',','.') ?>

    </td>

</tr>


<tr>

    <td colspan="3" style="height:18px;"></td>

</tr>


<!-- =====================================================
     E. PEMBAGIAN SHU
===================================================== -->

<tr class="table-secondary font-weight-bold">

    <td class="text-center">

        E

    </td>

    <td colspan="2">

        PEMBAGIAN SHU

    </td>

</tr>

<tr>

    <td class="text-center">

        1

    </td>

    <td>

        Insentif Penasehat / Kepala Desa (<?= $persen_kades ?>%)

    </td>

    <td class="text-right">

        <?= number_format($insentif_kades,0,',','.') ?>

    </td>

</tr>

<tr>

    <td class="text-center">

        2

    </td>

    <td>

        PADes (<?= $persen_pades ?>%)

    </td>

    <td class="text-right">

        <?= number_format($pades,0,',','.') ?>

    </td>

</tr>

<tr>

    <td class="text-center">

        3

    </td>

    <td>

        Dana Sosial (<?= $persen_dana_sosial ?>%)

    </td>

    <td class="text-right">

        <?= number_format($dana_sosial,0,',','.') ?>

    </td>

</tr>

<tr>

    <td class="text-center">

        4

    </td>

    <td>

        Jasa Produksi (<?= $persen_jasa_produksi ?>%)

    </td>

    <td class="text-right">

        <?= number_format($jasa_produksi,0,',','.') ?>

    </td>

</tr>

<tr>

    <td class="text-center">

        5

    </td>

    <td>

        Cadangan (<?= $persen_cadangan ?>%)

    </td>

    <td class="text-right">

        <?= number_format($cadangan,0,',','.') ?>

    </td>

</tr>

<tr>

    <td class="text-center">

        6

    </td>

    <td>

        Kesejahteraan (<?= $persen_kesejahteraan ?>%)

    </td>

    <td class="text-right">

        <?= number_format($kesejahteraan,0,',','.') ?>

    </td>

</tr>

<tr class="bg-light font-weight-bold">

    <td></td>

    <td>

        Jumlah Pembagian SHU

    </td>

    <td class="text-right">

        <?= number_format($total_shu,0,',','.') ?>

    </td>

</tr>
<?php

/* =====================================================
   F. LABA
===================================================== */

$laba = $sisa_shu - $total_shu;

/* =====================================================
   PPN
===================================================== */
/*
|-------------------------------------------------------
| Jika belum menggunakan PPN cukup ubah menjadi 0
|-------------------------------------------------------
*/

$persen_ppn = 12;

$nilai_ppn = $laba * $persen_ppn / 100;


/* =====================================================
   LABA SETELAH PAJAK
===================================================== */

$laba_bersih = $laba - $nilai_ppn;

?>

<tr>

    <td colspan="3" style="height:18px;"></td>

</tr>


<!-- =====================================================
     F. LABA
===================================================== -->

<tr class="table-warning font-weight-bold">

    <td class="text-center">

        F

    </td>

    <td>

        LABA

    </td>

    <td class="text-right">

        <?= number_format($laba,0,',','.') ?>

    </td>

</tr>


<tr>

    <td></td>

    <td>

        PPN (<?= $persen_ppn ?>%)

    </td>

    <td class="text-right">

        <?= number_format($nilai_ppn,0,',','.') ?>

    </td>

</tr>


<tr class="table-success font-weight-bold">

    <td></td>

    <td>

        LABA SETELAH PAJAK

    </td>

    <td class="text-right">

        <?= number_format($laba_bersih,0,',','.') ?>

    </td>

</tr>

</tbody>

</table>

</div>

</div>

</div>
