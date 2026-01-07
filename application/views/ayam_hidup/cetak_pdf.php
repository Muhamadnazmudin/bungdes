<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
        }
        h3 {
            text-align: center;
            margin-bottom: 5px;
        }
        p {
            text-align: center;
            margin-top: 0;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 4px;
        }
        th {
            background-color: #eee;
            text-align: center;
        }
        td {
            text-align: center;
        }
    </style>
</head>
<body>

<h3>LAPORAN AYAM</h3>
<p>BUMDes – Unit Usaha Ayam Petelur</p>

<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Kandang</th>
            <th>Keterangan</th>
            <th>Jumlah</th>
            <th>Masuk (Hidup)</th>
            <th>Keluar (Mati)</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $d): ?>
        <tr>
            <td><?= $d['tanggal'] ?></td>
            <td><?= $d['kandang'] ?></td>
            <td><?= $d['keterangan'] ?></td>
            <td><?= $d['jumlah'] ?></td>
            <td><?= $d['masuk'] ?></td>
            <td><?= $d['keluar'] ?></td>
            <td><strong><?= $d['total'] ?></strong></td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

</body>
</html>
