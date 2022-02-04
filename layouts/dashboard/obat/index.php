<?php
// session_start();

// cek apakah yang mengakses halaman ini sudah login
if (!isset($_SESSION['login'])) {
    header('location: ../../index.php?page=login&status=notlogin');
    exit();
}

require '../../config/config.php';

$obats = query("SELECT * FROM tbl_obat INNER JOIN tbl_supplier ON tbl_obat.supplier_id = tbl_supplier.supplier_id");
$no = 1

?>
<title>Data Obat</title>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Obat</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pages: Obat</li>
        </ol>

        <div class="card shadow-lg border-0 mb-4">
            <div class="card-header border-0 text-center p-4 bg-dark text-white">
                <i class="bi bi-table"></i>
                Table Data Obat
            </div>
            <div class="card-body">
                <a href="?page=obat/create" class="btn btn-sm btn-primary mb-3">Add Obat</a>

                <table class="table table-bordered table-hover table-responsive-sm text-center">
                    <thead class="table-dark">
                        <th scope="col">No.</th>
                        <!-- <th scope="col">ID Obat</th> -->
                        <th scope="col">Kode Obat</th>
                        <th scope="col">Nama Obat</th>
                        <th scope="col">Harga Beli</th>
                        <th scope="col">Harga Obat</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Kedaluwarsa</th>
                        <th scope="col">Nama Supplier</th>
                        <th scope="col">Actions</th>
                    </thead>
                    <tbody>
                        <?php foreach ($obats as $obat) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <!-- <td><?= $obat['obat_id']; ?></td> -->
                                <td><?= $obat['kode_obat']; ?></td>
                                <td><?= $obat['nama_obat']; ?></td>
                                <td>Rp <?= $obat['harga_beli']; ?></td>
                                <td>Rp <?= $obat['harga_jual']; ?></td>
                                <td><?= $obat['stok']; ?></td>
                                <td><?= $obat['kedaluwarsa']; ?></td>
                                <td><?= $obat['nama_supplier']; ?></td>
                                <td>
                                    <a href="index.php?page=obat/detail&id=<?= $obat['obat_id'] ?>" class="btn btn-sm btn-dark">Detail</a>
                                    <a href="index.php?page=obat/update&id=<?= $obat['obat_id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="index.php?page=obat/delete&id=<?= $obat['obat_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete Obat?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
</main>

<!-- Button trigger modal -->