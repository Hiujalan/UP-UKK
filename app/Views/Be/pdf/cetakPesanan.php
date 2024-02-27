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
                <td>
                    <h3 class="judul">Data Pesanan Tanggal <?= date('d/m/y', strtotime($tanggalMulai)); ?> Sampai <?= date('d/m/y', strtotime($tanggalAkhir)); ?></h3>
                </td>
            </tr>
        </tbody>
    </table>

    <br>

    <table border="1" class="table">
        <thead>
            <tr>
                <th class="th" style="width: 120px; padding-top:10px; padding-bottom:10px;">Nama Produk</th>
                <th class="th" style="width: 120px;">Nama Pemesan</th>
                <th class="th" style="width: 100px;">Harga</th>
                <th class="th" style="width: 60px;">Jumlah</th>
                <th class="th" style="width: 90px;">Tanggal Mulai Sewa</th>
                <th class="th" style="width: 100px;">Validasi</th>
                <th class="th" style="width: 100px;">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pesananData as $pesanan) { ?>
                <tr>
                    <td class="td" style="padding-left:10px; padding-top:15px; padding-bottom:15px;"><?= isset($pesanan->barangNama) ? $pesanan->barangNama : $pesanan->jasaNama; ?></td>
                    <td class="td">
                        <center><?= $pesanan->userNama; ?></center>
                    </td>
                    <td class="td">
                        <center>Rp <?= isset($pesanan->barangHarga) ? number_format($pesanan->barangHarga, 0, ',', '.')  : number_format($pesanan->jasaHarga, 0, ',', '.'); ?></center>
                    </td>
                    <td class="td">
                        <center><?= $pesanan->pesananJumlah; ?></center>
                    </td>
                    <td class="td">
                        <center><?= isset($pesanan->pesananMulai) ? date('d/m/Y', strtotime($pesanan->pesananMulai)) : 'Tidak Ada'; ?></center>
                    </td>
                    <td class="td">
                        <center><?= $pesanan->pesananValidasi == '0' ? 'Belum Tervalidasi' : 'Sudah Tervalidasi'; ?></center>
                    </td>
                    <td class="td">
                        <center>Rp <?= number_format($pesanan->pesananTotal, 0, ',', '.'); ?></center>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <br>
    <table>
        <tbody>
            <tr>
                <td style="width: 413px;">
                </td>
                <td style="width: 150px;">
                    <p class="judul"><b>Total :</b></p>
                </td>
                <td style="width: 150px;">
                    <p><b>Rp <?= number_format($totalSemuaPesanan, 0, ',', '.'); ?></b> </p>
                </td>
            </tr>
        </tbody>
    </table>


</body>

</html>