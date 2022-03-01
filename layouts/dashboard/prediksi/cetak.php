<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan</title>
    <style>
        #thtd th,
        #thtd td {
            padding: 8px;
        }

        .date {
            font-size: 0.95em;

        }

        #container {
            margin-top: 20px;
            margin-right: 70px;
            margin-left: 70px;
        }
    </style>
</head>

<body>
    <div id="container">
        <table border="1" width="100%" cellspacing="8" style="margin-top: 20px; border-collapse: collapse;" class="date" id="thtd">
            <tr>
                <th scope="col" width="3%">No.</th>
                <th scope="col" width="10%">Bulan</th>
                <th scope="col" width="10%">Terjual (At)</th>
                <th scope="col" width="10%">Average</th>
                <th scope="col">Error</th>
                <th scope="col">MAD</th>
                <th scope="col">MSE</th>
                <th scope="col">MAPE</th>
            </tr>
            <?php
            // $no = 1;
            include "../../../config/config.php";
            $count = $conn->query("SELECT COUNT(mad) as mad, COUNT(mse) as mse, COUNT(mape) as mape from tbl_prediksi")->fetch_assoc();
            $tMad  = $count['mad'] - 1;
            $tMse  = $count['mse'] - 1;
            $tMape = $count['mape'] - 1;

            $ambil = $conn->query("SELECT mad, mse, mape FROM tbl_prediksi WHERE bulan = 12")->fetch_assoc();
            $hMad  = $ambil['mad'] / $tMad;
            $hMse  = $ambil['mse'] / $tMse;
            $hMape = $ambil['mape'] / $tMape;
            $query = $conn->query("SELECT * FROM tbl_prediksi ORDER BY bulan ASC");
            foreach ($query as $no => $a) :
                if ($a['hasil'] == '') {
                    $cHasil = '-';
                } else {
                    $cHasil = round($a['hasil'], 3);
                }
                if ($a['error'] == '') {
                    $cError = '-';
                } else {
                    $cError = round($a['error'], 3);
                }
                if ($a['mad'] == '') {
                    $cmad = '-';
                } else {
                    $cmad = round($a['mad'], 3);
                }
                if ($a['mse'] == '') {
                    $cmse = '-';
                } else {
                    $cmse = round($a['mse'], 3);
                }
                if ($a['mape'] == '') {
                    $cmape = '-';
                } else {
                    $cmape = round($a['mape'], 3);
                }
                if ($a['jumlah'] == '') {
                    $cjumlah = '-';
                } else {
                    $cjumlah = round($a['jumlah'], 3);
                }
            ?>
                <tr>
                    <td><?= $no + 1; ?></td>
                    <td><?= bulan($a['bulan']); ?></td>
                    <td width="5%" align="center"><?= $cjumlah; ?></td>
                    <td width="5%" align="center"><?= $cHasil ?> </td>
                    <td width="5%" align="center"><?= $cError ?></td>
                    <td width="5%" align="center"><?= $cmad ?></td>
                    <td width="5%" align="center"><?= $cmse ?></td>
                    <td width="5%" align="center"><?= $cmape ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <th colspan="5">Jumlah Nilai Error</th>
                <th><?= round($hMad, 3) ?></th>
                <th><?= round($hMse, 3) ?></th>
                <th><?= round($hMape, 3) ?></th>
            </tr>
        </table>

        <p>Hasil Prediksi :</p>
        <table border="1" width="20%" cellspacing="8" style="margin-top: 20px; border-collapse: collapse;" class="date" id="thtd">
            <?php
            $hsl = $conn->query("SELECT hasil, bulan FROM tbl_prediksi WHERE bulan = 12")->fetch_assoc();
            $hpTahun    = bulan($hsl['bulan']);
            $hpFt       = $hsl['hasil'];
            ?>
            <tr>
                <th>Bulan (n)</th>
                <th>Ft</th>
            </tr>
            <tr>
                <td align="center"><?= $hpTahun ?></td>
                <td align="center"><?= $hpFt ?></td>
            </tr>
        </table>
    </div>

    <script>
        window.print();
    </script>
</body>

</html>