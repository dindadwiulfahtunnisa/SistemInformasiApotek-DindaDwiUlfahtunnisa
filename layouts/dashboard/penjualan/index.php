<?php

require '../../config/config.php';

$penjualans = query("SELECT * FROM tbl_penjualan INNER JOIN tbL_obat ON tbl_penjualan.obat_id = tbl_obat.obat_id");
$no = 1;

?>
<title>Data Penjualan</title>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Penjualan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pages: Penjualan</li>
        </ol>

        <div class="card shadow-lg border-0 mb-4">
            <div class="card-header border-0 text-center p-4 bg-dark text-white">
                <i class="bi bi-table"></i>
                Table Data Penjualan
            </div>
            <div class="card-body">
                <a href="?page=penjualan/create" class="btn btn-sm btn-primary mb-3">Add Penjualan</a>

                <table class="table table-bordered table-hover table-responsive-sm text-center">
                    <thead class="table-dark">
                        <th scope="col">No.</th>
                        <!-- <th scope="col">ID Penjualan</th> -->
                        <th scope="col">Kode Penjualan</th>
                        <th scope="col">Nama Obat</th>
                        <th scope="col">Bulan</th>
                        <th scope="col">Tahun</th>
                        <th scope="col">Tanggal Penjualan</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Actions</th>
                    </thead>
                    <tbody>
                        <?php foreach ($penjualans as $penjualan) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <!-- <td><?= $penjualan['penjualan_id']; ?></td> -->
                                <td><?= $penjualan['kode_penjualan']; ?></td>
                                <td><?= $penjualan['nama_obat']; ?></td>
                                <td><?= $penjualan['bulan']; ?></td>
                                <td><?= $penjualan['tahun']; ?></td>
                                <td><?= $penjualan['tgl_penjualan']; ?></td>
                                <td><?= $penjualan['jumlah']; ?></td>
                                <td>
                                    <a href="index.php?page=penjualan/detail&id=<?= $penjualan['penjualan_id'] ?>" class="btn btn-sm btn-dark">Detail</a>
                                    <a href="index.php?page=penjualan/update&id=<?= $penjualan['penjualan_id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="index.php?page=penjualan/delete&id=<?= $penjualan['penjualan_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete Penjualan?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
</main>

<!-- Button trigger modal -->