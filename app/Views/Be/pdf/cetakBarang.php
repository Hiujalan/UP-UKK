<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $active ?></title>

    <style>
        * {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        .judul {
            position: relative;
        }

        .table,
        .th,
        .td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <table>
        <tbody>
            <tr>
                <td>
                    <h3 class="judul">Data Barang Tanggal <?= date('d / m / y'); ?></h3>
                </td>
            </tr>
        </tbody>
    </table>

    <br>

    <table border="1" class="table">
        <thead>
            <tr>
                <th class="th" style="width: 200px; padding-top:10px; padding-bottom:10px;">Nama</th>
                <th class="th" style="width: 60px;">Stok</th>
                <th class="th" style="width: 150px;">Harga</th>
                <th class="th" style="width: 100px;">Satuan</th>
                <th class="th" style="width: 180px;">Spesifikasi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($barangData as $barang) { ?>
                <tr>
                    <td class="td" style="padding-left:10px; padding-top:15px; padding-bottom:15px;"><?= $barang['nama'] ?></td>
                    <td class="td">
                        <center><?= $barang['stok']; ?></center>
                    </td>
                    <td class="td">
                        <center>Rp <?= number_format($barang['harga'], 0, ',', '.')  ?></center>
                    </td>
                    <td class="td">
                        <center><?= $barang['satuan']; ?></center>
                    </td>
                    <?php isset($barang['spesifikasi']) ? $spesifikasi = json_decode($barang['spesifikasi']) : $spesifikasi[] = ''; ?>
                    <td class="td">
                        <ol>
                            <?php
                            if (isset($barang['spesifikasi'])) {
                                foreach ($spesifikasi as $spek) { ?>
                                    <li><?= $spek; ?></li>
                            <?php }
                            } ?>
                        </ol>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <br>


</body>

</html>