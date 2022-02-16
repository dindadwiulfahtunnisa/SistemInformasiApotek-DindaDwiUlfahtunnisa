<?php
// session_start();

// cek apakah yang mengakses halaman ini sudah login
if (!isset($_SESSION['login'])) {
    header('location: ../../index.php?page=login&status=notlogin');
    exit();
}

require '../../config/config.php';

$query = query("SELECT * FROM tbl_prediksi");
$no = 1

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
                <a href="?page=prediksi" class="btn btn-sm btn-primary mb-3">Add Prediksi</a>

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
                        <?php foreach ($query as $a) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= bulan($a['bulan']); ?></td>
                                <td><?= $a['jumlah']; ?></td>
                                <td><?= $a['periode']; ?></td>
                                <td><?= $a['hasil']; ?>
                                <td><?= $a['error'] ?></td>
                                <td><?= $a['mad'] ?></td>
                                <td><?= $a['mse'] ?></td>
                                <td><?= $a['mape'] ?></td>
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