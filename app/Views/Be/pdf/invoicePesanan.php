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

        /* table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        } */

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
                <td style="width: 400px;">
                    <h3 class="judul">Invoice # <?= $pesananData[0]->pesananSlug; ?></h3>
                    <p>Tanggal : <?= date('d / m / Y', strtotime($pesananData[0]->pesananCreated)); ?></p>
                </td>
                <td style="width: 306px;">
                    <p class="judul">Pelanggan : </p>
                    <p style="margin-top: -15px;"> <b><?= $pesananData[0]->userNama; ?></b></p>
                    <?php $alamatUser = json_decode($pesananData[0]->userAlamat);  ?>
                    <p style="margin-top: -10px;"><?= $alamatUser->jalan; ?></p>
                </td>
            </tr>
        </tbody>
    </table>

    <br>

    <table border="1" class="table">
        <thead>
            <tr>
                <th class="th" style="width: 200px; padding-top:10px; padding-bottom:10px;">Nama</th>
                <th class="th" style="width: 70px;">Jumlah</th>
                <th class="th" style="width: 140px;">Harga</th>
                <th class="th" style="width: 150px;">Tanggal Sewa</th>
                <th class="th" style="width: 140px;">Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="td" style="padding-left:10px; padding-top:10px; padding-bottom:10px;"><?= isset($pesananData[0]->barangNama) ? $pesananData[0]->barangNama : $pesananData[0]->jasaNama; ?></td>
                <td class="td">
                    <center><?= $pesananData[0]->pesananJumlah; ?></center>
                </td>
                <td class="td">
                    <center>Rp <?= isset($pesananData[0]->barangHarga) ? number_format($pesananData[0]->barangHarga, 0, ',', '.')  : number_format($pesananData[0]->jasaHarga, 0, ',', '.'); ?></center>
                </td>
                <td class="td">
                    <center><?= isset($pesananData[0]->pesananMulai) ? date('d/m/Y', strtotime($pesananData[0]->pesananMulai)) : 'Tidak Ada'; ?></center>
                </td>
                <td class="td">
                    <center>Rp <?= number_format($pesananData[0]->pesananTotal, 0, ',', '.'); ?></center>
                </td>
            </tr>
        </tbody>
    </table>

    <br>
    <table>
        <tbody>
            <tr>
                <td style="width: 413px;">
                </td>
                <td style="width: 150px;">
                    <p class="judul">Total :</p>
                </td>
                <td style="width: 150px;">
                    <p>Rp <?= number_format($pesananData[0]->pesananTotal, 0, ',', '.'); ?></p>
                </td>
            </tr>
        </tbody>
    </table>

    <hr>

    <table>
        <tbody>
            <tr>
                <td style="width: 400px;">
                    <p class="judul"><b><?= $settingsData['nama']; ?></b></p>
                    <?php $alamat = json_decode($settingsData['alamat']) ?>
                    <p class="judul" style="margin-top: -10px;"><?= $alamat->jalan; ?>, <?= $alamat->kabupaten; ?></p>
                    <p class="judul" style="margin-top: -10px;">Telepon : <?= $settingsData['telp']; ?></p>
                </td>
                <td style="width: 303px;">
                </td>
            </tr>
        </tbody>
    </table>

</body>

</html>