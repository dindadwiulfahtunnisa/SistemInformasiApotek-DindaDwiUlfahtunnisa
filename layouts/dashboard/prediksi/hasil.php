<?php
// session_start();

// cek apakah yang mengakses halaman ini sudah login
if (!isset($_SESSION['login'])) {
    header('location: ../../index.php?page=login&status=notlogin');
    exit();
}

require '../../config/config.php';

$query = query("SELECT * FROM tbl_prediksi ORDER BY bulan ASC");
// $no = 1

?>
<title>Prediksi</title>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Prediksi</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pages: Prediksi</li>
        </ol>

        <div class="card shadow-lg border-0 mb-4">
            <div class="card-header border-0 text-center p-4 bg-dark text-white">
                <i class="bi bi-table"></i>
                Table Data Prediksi
            </div>
            <div class="card-body border-0">
                <!-- <a href="?page=prediksi/create" class="btn btn-sm btn-primary mb-3"><i class="fa fa-plus mr-2"></i>Add Prediksi</a> -->
                <a href="prediksi/cetak.php" class="btn btn-sm btn-info mb-3 text-white" target="_blank"><i class="fa fa-print mr-2"></i>Cetak Laporan</a>

                <table class="table table-bordered table-hover table-responsive-sm text-center rounded">
                    <thead class="table-dark">
                        <th scope="col" width="3%">No.</th>
                        <th scope="col" width="10%">Bulan</th>
                        <th scope="col" width="10%">Terjual (At)</th>
                        <th scope="col" width="10%">Periode</th>
                        <th scope="col" width="10%">Average</th>
                        <th scope="col">Error</th>
                        <th scope="col">MAD</th>
                        <th scope="col">MSE</th>
                        <th scope="col">MAPE</th>
                        <!-- <th scope="col">Actions</th> -->
                    </thead>
                    <tbody>
                        <?php foreach ($query as $no => $a) : ?>
                            <?php
                            if ($a['hasil'] == '') {
                                $cHasil = '-';
                            } else {
                                $cHasil = $a['hasil'];
                            }
                            if ($a['error'] == '') {
                                $cError = '-';
                            } else {
                                $cError = $a['error'];
                            }
                            if ($a['mad'] == '') {
                                $cmad = '-';
                            } else {
                                $cmad = $a['mad'];
                            }
                            if ($a['mse'] == '') {
                                $cmse = '-';
                            } else {
                                $cmse = $a['mse'];
                            }
                            if ($a['mape'] == '') {
                                $cmape = '-';
                            } else {
                                $cmape = $a['mape'];
                            }
                            ?>
                            <tr>
                                <td><?= $no + 1; ?></td>
                                <td><?= bulan($a['bulan']); ?></td>
                                <td><?= $a['jumlah']; ?></td>
                                <td><?= $a['periode']; ?></td>
                                <td><?= $cHasil; ?>
                                <td><?= $cError ?></td>
                                <td><?= $cmad ?></td>
                                <td><?= $cmse ?></td>
                                <td><?= $cmape ?></td>
                                <!-- <td>
                                    <a href="index.php?page=users/update&id=<?= $user['user_id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="index.php?page=users/delete&id=<?= $user['user_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete user?')">Delete</a>
                                </td> -->
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
</main>

<!-- Button trigger modal -->