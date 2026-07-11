<!DOCTYPE html>
<html>

<head>

<meta charset="utf-8">

<style>

body{

    font-family: DejaVu Sans, sans-serif;
    font-size:11px;

}

table{

    width:100%;
    border-collapse:collapse;

}

table th,
table td{

    border:1px solid #000;
    padding:3px 5px;

}

.text-center{

    text-align:center;

}

.text-right{

    text-align:right;

}

.bold{

    font-weight:bold;

}

.bg{

    background:#eaeaea;

}

h2,h3,h4,p{

    margin:0;
    padding:2px;

}

.ttd{

    margin-top:60px;

}

</style>

</head>

<body>

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

<div class="text-center">

<h3>BUMDES</h3>

<h4>BINA USAHA MANDIRI DESA</h4>

<h3>LAPORAN LABA RUGI</h3>

<p>
<strong>
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

<br>

<table>

<thead>

<tr class="bg">

<th width="50">NO</th>

<th>URAIAN</th>

<th width="180">JUMLAH (Rp)</th>

</tr>

</thead>

<tbody>

<tr class="bg bold">

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

<tr class="bold">

<td></td>

<td class="text-right">

Jumlah Pendapatan

</td>

<td class="text-right">

<?= number_format($total_pendapatan,0,',','.') ?>

</td>

</tr>


<?php

$no=1;

?>

<tr>

<td colspan="3"></td>

</tr>

<tr class="bg bold">

<td class="text-center">

B

</td>

<td colspan="2">

BIAYA PRODUKSI

</td>

</tr>

<?php

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

<tr class="bold">

<td></td>

<td class="text-right">

Jumlah Biaya Produksi

</td>

<td class="text-right">

<?= number_format($total_biaya,0,',','.') ?>

</td>

</tr>

<?php

$laba_usaha = $total_pendapatan-$total_biaya;

$persen_pengurus=30;

$persen_kades=5;
$persen_pades=25;
$persen_dana_sosial=10;
$persen_jasa_produksi=10;
$persen_cadangan=10;
$persen_kesejahteraan=10;

$gaji_pengurus=$laba_usaha*$persen_pengurus/100;

$sisa_shu=$laba_usaha-$gaji_pengurus;

$insentif_kades=$sisa_shu*$persen_kades/100;

$pades=$sisa_shu*$persen_pades/100;

$dana_sosial=$sisa_shu*$persen_dana_sosial/100;

$jasa_produksi=$sisa_shu*$persen_jasa_produksi/100;

$cadangan=$sisa_shu*$persen_cadangan/100;

$kesejahteraan=$sisa_shu*$persen_kesejahteraan/100;

$total_shu=
$insentif_kades+
$pades+
$dana_sosial+
$jasa_produksi+
$cadangan+
$kesejahteraan;

$laba=$sisa_shu-$total_shu;

$ppn=12;

$nilai_ppn=$laba*$ppn/100;

$laba_bersih=$laba-$nilai_ppn;

?>
<!-- =====================================================
     C. PENDAPATAN USAHA
===================================================== -->

<tr>

    <td colspan="3"></td>

</tr>

<tr class="bg bold">

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


<!-- =====================================================
     D. GAJI PENGURUS
===================================================== -->

<tr>

    <td colspan="3"></td>

</tr>

<tr class="bg bold">

    <td class="text-center">

        D

    </td>

    <td>

        Gaji Pengurus BUMDes (<?= $persen_pengurus ?>%)

    </td>

    <td class="text-right">

        <?= number_format($gaji_pengurus,0,',','.') ?>

    </td>

</tr>

<tr class="bold">

    <td></td>

    <td>

        Sisa SHU

    </td>

    <td class="text-right">

        <?= number_format($sisa_shu,0,',','.') ?>

    </td>

</tr>


<!-- =====================================================
     E. PEMBAGIAN SHU
===================================================== -->

<tr>

    <td colspan="3"></td>

</tr>

<tr class="bg bold">

    <td class="text-center">

        E

    </td>

    <td colspan="2">

        PEMBAGIAN SHU

    </td>

</tr>

<tr>

    <td class="text-center">1</td>

    <td>

        Insentif Penasehat / Kepala Desa (<?= $persen_kades ?>%)

    </td>

    <td class="text-right">

        <?= number_format($insentif_kades,0,',','.') ?>

    </td>

</tr>

<tr>

    <td class="text-center">2</td>

    <td>

        PADes (<?= $persen_pades ?>%)

    </td>

    <td class="text-right">

        <?= number_format($pades,0,',','.') ?>

    </td>

</tr>

<tr>

    <td class="text-center">3</td>

    <td>

        Dana Sosial (<?= $persen_dana_sosial ?>%)

    </td>

    <td class="text-right">

        <?= number_format($dana_sosial,0,',','.') ?>

    </td>

</tr>

<tr>

    <td class="text-center">4</td>

    <td>

        Jasa Produksi (<?= $persen_jasa_produksi ?>%)

    </td>

    <td class="text-right">

        <?= number_format($jasa_produksi,0,',','.') ?>

    </td>

</tr>

<tr>

    <td class="text-center">5</td>

    <td>

        Cadangan (<?= $persen_cadangan ?>%)

    </td>

    <td class="text-right">

        <?= number_format($cadangan,0,',','.') ?>

    </td>

</tr>

<tr>

    <td class="text-center">6</td>

    <td>

        Kesejahteraan (<?= $persen_kesejahteraan ?>%)

    </td>

    <td class="text-right">

        <?= number_format($kesejahteraan,0,',','.') ?>

    </td>

</tr>

<tr class="bold">

    <td></td>

    <td>

        Jumlah Pembagian SHU

    </td>

    <td class="text-right">

        <?= number_format($total_shu,0,',','.') ?>

    </td>

</tr>


<!-- =====================================================
     F. LABA
===================================================== -->

<tr>

    <td colspan="3"></td>

</tr>

<tr class="bg bold">

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

        PPN (<?= $ppn ?>%)

    </td>

    <td class="text-right">

        <?= number_format($nilai_ppn,0,',','.') ?>

    </td>

</tr>

<tr class="bg bold">

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


<br><br><br>


<table style="border:none; margin-top:20px;">

<tr style="border:none;">

<td style="border:none;width:50%;text-align:center;">

Mengetahui,

<br>

Direktur BUMDes

<br><br><br><br><br><br><br>

<b>

Muhamad Nazmudin, S.Pd

</b>

</td>

<td style="border:none;width:50%;text-align:center;">

Bendahara

<br><br><br><br><br><br><br>

<b>

Abi Rahman Fadillah, S.Pd

</b>

</td>

</tr>

</table>

</body>

</html>