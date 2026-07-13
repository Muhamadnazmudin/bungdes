<!DOCTYPE html>
<html>

<head>

<meta charset="utf-8">

<style>

body{

    font-family: DejaVu Sans;

    font-size:11px;

}

table{

    width:100%;

    border-collapse:collapse;

}

th,td{

    border:1px solid #000;

    padding:6px;

}

.text-center{

    text-align:center;

}

.text-right{

    text-align:right;

}

.title{

    font-size:18px;

    font-weight:bold;

}

.subtitle{

    font-size:14px;

    font-weight:bold;

}

.section{

    background:#efefef;

    font-weight:bold;

}

.total{

    background:#f5f5f5;

    font-weight:bold;

}

</style>

</head>

<body>

<?php

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

    <div class="title">

        BUMDES

    </div>

    <div class="subtitle">

        UNIT USAHA PETERNAKAN AYAM PETELUR

    </div>

    <br>

    <div class="subtitle">

        LAPORAN LABA RUGI

    </div>

    <div>

        Periode

        <strong>

            <?= $bulan == ''

                ? 'Januari s/d Desember'

                : $nama_bulan[$bulan] ?>

            <?= $tahun ?>

        </strong>

    </div>

</div>

<br>

<table>

<thead>

<tr>

    <th width="40">No</th>

    <th>Uraian</th>

    <th width="180">

        Jumlah (Rp)

    </th>

</tr>

</thead>

<tbody>
    <tr class="section">

    <td class="text-center">

        A

    </td>

    <td colspan="2">

        PENDAPATAN

    </td>

</tr>

<?php $no=1; ?>

<?php foreach($laporan['pendapatan'] as $p): ?>

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

<tr class="total">

    <td></td>

    <td>

        Total Pendapatan

    </td>

    <td class="text-right">

        <?= number_format($laporan['total_pendapatan'],0,',','.') ?>

    </td>

</tr>
<tr>

    <td colspan="3" style="border:0;height:8px;"></td>

</tr>

<tr class="section">

    <td class="text-center">

        B

    </td>

    <td colspan="2">

        BEBAN

    </td>

</tr>

<?php $no=1; ?>

<?php foreach($laporan['beban'] as $b): ?>

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

<tr class="total">

    <td></td>

    <td>

        Total Beban

    </td>

    <td class="text-right">

        <?= number_format($laporan['total_beban'],0,',','.') ?>

    </td>

</tr>
<tr>

    <td colspan="3" style="border:0;height:8px;"></td>

</tr>

<tr class="section">

    <td class="text-center">

        C

    </td>

    <td>

        LABA USAHA

    </td>

    <td class="text-right">

        <?= number_format($laporan['laba_usaha'],0,',','.') ?>

    </td>

</tr>

<tr>

    <td colspan="3" style="border:0;height:8px;"></td>

</tr>

<tr class="section">

    <td class="text-center">

        D

    </td>

    <td colspan="2">

        PEMBAGIAN SHU

    </td>

</tr>

<?php

$no = 1;

?>

<?php foreach($laporan['master_shu'] as $item): ?>

<tr>

    <td class="text-center">

        <?= $no++ ?>

    </td>

    <td>

        <?= $item['nama'] ?>

        (<?= number_format($item['persentase'],2,',','.') ?>%)

    </td>

    <td class="text-right">

        <?= number_format($item['nominal'],0,',','.') ?>

    </td>

</tr>

<?php endforeach; ?>

<tr class="total">

    <td></td>

    <td>

        Total Pembagian SHU

    </td>

    <td class="text-right">

        <?= number_format($laporan['total_pembagian'],0,',','.') ?>

    </td>

</tr>
<tr>

    <td colspan="3" style="border:0;height:8px;"></td>

</tr>

<tr class="section">

    <td class="text-center">

        E

    </td>

    <td>

        SISA SHU

    </td>

    <td class="text-right">

        <?= number_format($laporan['sisa_shu'],0,',','.') ?>

    </td>

</tr>
<tr>

    <td colspan="3" style="border:0;height:8px;"></td>

</tr>

<tr class="section">

    <td class="text-center">

        F

    </td>

    <td>

        LABA

    </td>

    <td class="text-right">

        <?= number_format($laporan['laba'],0,',','.') ?>

    </td>

</tr>

<tr>

    <td></td>

    <td>

        PPN (12%)

    </td>

    <td class="text-right">

        <?= number_format($laporan['ppn'],0,',','.') ?>

    </td>

</tr>

<tr class="total">

    <td></td>

    <td>

        LABA BERSIH

    </td>

    <td class="text-right">

        <?= number_format($laporan['laba_bersih'],0,',','.') ?>

    </td>

</tr>

</tbody>

</table>

<br><br>

<table style="border:none;">

<tr style="border:none;">

    <td style="border:none;width:60%;"></td>

    <td style="border:none;text-align:center;">

        <?= date('d F Y') ?>

        <br><br>

        Mengetahui,

        <br><br><br><br><br>

        <strong>

            _______________________

        </strong>

        <br>

        Pengelola BUMDes

    </td>

</tr>

</table>

</body>

</html>