<?php
// session_start();

// cek apakah yang mengakses halaman ini sudah login
// if (!isset($_SESSION['login'])) {
//     header('location: ../../index.php?page=login&status=notlogin');
//     exit();
// }

require '../../config/config.php';

$roles = query("SELECT * FROM roles");

if (isset($_POST['submit'])) {
    $truncate = $conn->query('DELETE FROM tbl_prediksi');
    $obat       = htmlspecialchars($_POST['obat']);
    $periode    = htmlspecialchars($_POST['periode']);

    $data = $conn->query("SELECT penjualan_id, tgl_penjualan FROM tbl_penjualan ORDER BY tgl_penjualan ASC");
    foreach ($data as $no => $row) {
        $exId   = $row['penjualan_id'];
        $pecah  = explode("-", $row['tgl_penjualan']);
        $bulan  = $pecah[1];
        $tahun  = $pecah[0];

        $start  = $no + 1;
        $startCount = $periode + 1;
        $end    = $periode++;
        $prd = 3;

        // cek nilai penjualan pada periode tersebut
        $cekJumlah = $conn->query("SELECT jumlah FROM tbl_penjualan WHERE penjualan_id = $exId")->fetch_assoc();
        $jumlah = $cekJumlah['jumlah'];

        if ($bulan < 4) {
            $query = $conn->query("INSERT INTO tbl_prediksi (periode, jumlah, obat_id, bulan, tahun) VALUES ('$prd','$jumlah','$obat', '$bulan','$tahun')");
        }
        if ($periode <= 11) {
            $query_sum  = $conn->query("SELECT SUM(jumlah) as total FROM tbl_penjualan WHERE MONTH(tgl_penjualan) BETWEEN $start AND $end")->fetch_assoc();
            $total  = $query_sum['total'];
            $cekJumlah2 = $conn->query("SELECT jumlah FROM tbl_penjualan WHERE MONTH(tgl_penjualan) = '$periode'")->fetch_assoc();
            $at     = $cekJumlah2['jumlah'];

            $hasil  = $total / 3;
            $error  = $hasil - $at;
            $mad    = abs($hasil - $at);
            $mse    = pow($mad, 2);
            $mape   = ($mad / $at) * 100;
            $query2 = $conn->query("INSERT INTO tbl_prediksi (periode, jumlah, obat_id, bulan, tahun, hasil, error, mad, mse, mape) VALUES ('$prd','$at','$obat', '$periode','$tahun','$hasil', '$error','$mad','$mse','$mape')");
        }
        if ($periode == 12) {
            $sum_jumlah  = $conn->query("SELECT SUM(jumlah) as total FROM tbl_penjualan WHERE MONTH(tgl_penjualan) BETWEEN 09 AND 11")->fetch_assoc();
            $total_sum  = $sum_jumlah['total'];
            $avg = $total_sum / 3;
            $sum  = $conn->query("SELECT SUM(mad) as total_mad, SUM(mse) as total_mse, SUM(mape) as total_mape FROM tbl_prediksi")->fetch_assoc();
            $total_mad  = $sum['total_mad'];
            $total_mse  = $sum['total_mse'];
            $total_mape = $sum['total_mape'];

            $query3 = $conn->query("INSERT INTO tbl_prediksi (periode, obat_id, bulan, tahun, hasil, mad, mse, mape) VALUES ('$prd','$obat', '$periode','$tahun','$avg','$total_mad','$total_mse','$total_mape')");
        }

        if ($query2) {
            echo '
                    <script>
                        alert("Successfully added new forecasting!");
                        document.location="index.php?page=prediksi/hasil";
                    </script>
                ';
        } else {
            echo '
                    <script>
                        alert("Failed add new forecasting!");
                        document.location="index.php?page=prediksi";
                    </script>
                ';
        }
    }
}

?>
<title>Prediksi </title>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Prediksi</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pages: Prediksi</li>
        </ol>

        <div class="row gx-5 py-md-5 justify-content-center">
            <div class="col-md-4 py-md-4">
                <form class="form-container py-md-4" action="index.php?page=prediksi" method="POST">
                    <div class="mb-3">
                        <label for="obat" class="form-label">Nama Obat</label>
                        <select name="obat" id="obat" class="form-select">
                            <option selected>Pilih Obat</option>
                            <?php $data = $conn->query("SELECT * FROM tbl_obat"); ?>
                            <?php foreach ($data as $obat) : ?>
                                <option value="<?= $obat['obat_id'] ?>">
                                    <?= $obat['nama_obat'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="periode" class="form-label">Nilai Moving Average</label>
                        <select name="periode" id="periode" class="form-select">
                            <option selected>Pilih Nilai</option>
                            <?php
                            for ($i = 3; $i <= 11; $i++) { ?>
                                <option value="<?= $i ?>">
                                    Periode Ke - <?= $i ?>
                                </option>
                            <?php } ?>

                        </select>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Hitung</button>
                </form>
            </div>
        </div>
    </div>
</main>