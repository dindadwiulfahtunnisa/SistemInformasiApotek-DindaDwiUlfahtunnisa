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
    $obat       = htmlspecialchars($_POST['obat']);
    $periode    = htmlspecialchars($_POST['periode']);

    // kode prediksi
    $no = $conn->query("SELECT * FROM tbl_prediksi");
    $getNo = mysqli_num_rows($no);
    $rows = $getNo + 1;
    $kode = 'PR' . 00 . $rows;

    $data = $conn->query("SELECT penjualan_id, bulan, tahun FROM tbl_penjualan ORDER BY penjualan_id DESC LIMIT 1")->fetch_assoc();

    $exId   = $data['penjualan_id'];
    $bulan  = $data['bulan'];
    $tahun  = $data['tahun'];

    // hitung jumlah penjualan berdasarkan pilihan periode terakhir
    $query_sum  = mysqli_query($conn, "SELECT SUM(jumlah) as total FROM tbl_penjualan WHERE penjualan_id != $exId ORDER BY penjualan_id DESC LIMIT $periode")->fetch_assoc();
    $jumlah     = $query_sum['total'];

    // cek jumlah baris
    $query_row = mysqli_query($conn, "SELECT * FROM tbl_penjualan");
    $row    = mysqli_num_rows($query_row);
    $baris  = $row - 1;

    // cek nilai penjualan pada periode tersebut
    $cekJumlah = $conn->query("SELECT jumlah FROM tbl_penjualan WHERE penjualan_id = $exId")->fetch_assoc();

    $at     = $cekJumlah['jumlah'];
    $fc     = $jumlah / $baris;
    $error  = $fc - $at;
    $mad    = abs($fc - $at);
    $mse    = pow($mad, 2);
    $mape   = $mad / $at * 100;

    $query_create = "INSERT INTO tbl_prediksi (kode_ramalan, periode, jumlah, obat_id, bulan, tahun, hasil, error, mad, mse, mape) VALUES ('$kode','$periode','$at','$obat', '$bulan','$tahun','$fc', '$error','$mad','$mse','$mape')";

    $create = mysqli_query($conn, $query_create) or die(mysqli_error($conn));

    if ($create) {
        echo '
                <script>
                    alert("Successfully added new forecasting!");
                    document.location="index.php?page=prediksi";
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
                <form class="form-container py-md-4" action="index.php?page=prediksi/create" method="POST">
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