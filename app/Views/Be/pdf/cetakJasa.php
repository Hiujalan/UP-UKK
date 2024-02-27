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
                    <h3 class="judul">Data Jasa Tanggal <?= date('d / m / y'); ?></h3>
                </td>
            </tr>
        </tbody>
    </table>

    <br>

    <table border="1" class="table">
        <thead>
            <tr>
                <th class="th" style="width: 200px; padding-top:10px; padding-bottom:10px;">Nama</th>
                <th class="th" style="width: 150px;">Harga</th>
                <th class="th" style="width: 100px;">Satuan</th>
                <th class="th" style="width: 240px;">Spesifikasi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jasaData as $jasa) { ?>
                <tr>
                    <td class="td" style="padding-left:10px; padding-top:15px; padding-bottom:15px;"><?= $jasa['nama'] ?></td>
                    <td class="td">
                        <center>Rp <?= number_format($jasa['harga'], 0, ',', '.')  ?></center>
                    </td>
                    <td class="td">
                        <center><?= $jasa['satuan']; ?></center>
                    </td>
                    <?php isset($jasa['spesifikasi']) ? $spesifikasi = json_decode($jasa['spesifikasi']) : $spesifikasi[] = ''; ?>
                    <td class="td">
                        <ol>
                            <?php
                            if (isset($jasa['spesifikasi'])) {
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