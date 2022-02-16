<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan</title>
</head>

<body>
    <table border="1" style="width: 100%">
        <tr>
            <th scope="col" width="3%">No.</th>
            <th scope="col" width="10%">Bulan</th>
            <th scope="col" width="10%">Terjual (At)</th>
            <th scope="col" width="10%">Periode</th>
            <th scope="col" width="10%">Average</th>
            <th scope="col">Error</th>
            <th scope="col">MAD</th>
            <th scope="col">MSE</th>
            <th scope="col">MAPE</th>
        </tr>
        <?php
        // $no = 1;
        include "../../../config/config.php";
        $query = $conn->query("SELECT * FROM tbl_prediksi");
        foreach ($query as $no => $a) :
        ?>
            <tr>
                <td><?= $no + 1; ?></td>
                <td><?= bulan($a['bulan']); ?></td>
                <td><?= $a['jumlah']; ?></td>
                <td><?= $a['periode']; ?></td>
                <td><?= $a['hasil']; ?>
                <td><?= $a['error'] ?></td>
                <td><?= $a['mad'] ?></td>
                <td><?= $a['mse'] ?></td>
                <td><?= $a['mape'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <script>
        window.print();
    </script>
</body>

</html>