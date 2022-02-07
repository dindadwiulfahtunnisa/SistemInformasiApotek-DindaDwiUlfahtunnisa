<?php

require '../../config/config.php';

$pembelians = query("SELECT * FROM tbl_pembelian
                        INNER JOIN tbL_obat ON tbl_pembelian.obat_id = tbl_obat.obat_id
                        INNER JOIN tbl_supplier ON tbl_pembelian.supplier_id = tbl_supplier.supplier_id
                    ");
$no = 1;

?>
<title>Data Pembelian</title>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Pembelian</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pages: Pembelian</li>
        </ol>

        <div class="card shadow-lg border-0 mb-4">
            <div class="card-header border-0 text-center p-4 bg-dark text-white">
                <i class="bi bi-table"></i>
                Table Data Pembelian
            </div>
            <div class="card-body">
                <a href="?page=pembelian/create" class="btn btn-sm btn-primary mb-3">Add Pembelian</a>
                <a href="?page=pembelian/laporan" class="btn btn-sm btn-primary mb-3">Laporan Pembelian</a>

                <table class="table table-bordered table-hover table-responsive-sm text-center">
                    <thead class="table-dark">
                        <th scope="col">No.</th>
                        <!-- <th scope="col">ID Pembelian</th> -->
                        <th scope="col">Kode Pembelian</th>
                        <!-- <th scope="col">ID Obat</th> -->
                        <th scope="col">Nama Obat</th>
                        <th scope="col">Kode Obat</th>
                        <!-- <th scope="col">ID Supplier</th> -->
                        <th scope="col">Nama Supplier</th>
                        <th scope="col">Tanggal Pembelian</th>
                        <th scope="col">Total Pembelian</th>
                        <th scope="col">Actions</th>
                    </thead>
                    <tbody>
                        <?php foreach ($pembelians as $pembelian) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <!-- <td><?= $pembelian['pembelian_id']; ?></td> -->
                                <td><?= $pembelian['kode_pembelian']; ?></td>
                                <!-- <td><?= $pembelian['obat_id']; ?></td> -->
                                <td><?= $pembelian['nama_obat']; ?></td>
                                <td><?= $pembelian['kode_obat']; ?></td>
                                <!-- <td><?= $pembelian['supplier_id']; ?></td> -->
                                <td><?= $pembelian['nama_supplier']; ?></td>
                                <td><?= $pembelian['tgl_pembelian']; ?></td>
                                <td><?= $pembelian['total_pembelian']; ?></td>
                                <td>
                                    <!-- <a href="index.php?page=pembelian/detail&id=<?= $pembelian['pembelian_id'] ?>" class="btn btn-sm btn-dark">Detail</a> -->
                                    <a href="index.php?page=pembelian/update&id=<?= $pembelian['pembelian_id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="index.php?page=pembelian/delete&id=<?= $pembelian['pembelian_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete pembelian?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
</main>

<!-- Button trigger modal -->