<?php

require '../../config/config.php';

$suppliers = query("SELECT * FROM tbl_supplier");
$no = 1;

?>
<title>Data Supplier</title>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Supplier</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pages: Supplier</li>
        </ol>

        <div class="card shadow-lg border-0 mb-4">
            <div class="card-header border-0 text-center p-4 bg-dark text-white">
                <i class="bi bi-table"></i>
                Table Data Supplier
            </div>
            <div class="card-body">
                <a href="?page=supplier/create" class="btn btn-sm btn-primary mb-3">Add Supplier</a>

                <table class="table table-bordered table-hover table-responsive-sm text-center">
                    <thead class="table-dark">
                        <th scope="col">No.</th>
                        <!-- <th scope="col">ID Supplier</th> -->
                        <th scope="col">Kode Supplier</th>
                        <th scope="col">Nama Supplier</th>
                        <th scope="col">Alamat Supplier</th>
                        <th scope="col">Nomor Hp</th>
                        <th scope="col">Actions</th>
                    </thead>
                    <tbody>
                        <?php foreach ($suppliers as $supplier) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <!-- <td><?= $supplier['supplier_id']; ?></td> -->
                                <td><?= $supplier['kode_supplier']; ?></td>
                                <td><?= $supplier['nama_supplier']; ?></td>
                                <td><?= $supplier['alamat']; ?></td>
                                <td><?= $supplier['nohp']; ?></td>
                                <td>
                                    <a href="index.php?page=supplier/detail&id=<?= $supplier['supplier_id'] ?>" class="btn btn-sm btn-dark">Detail</a>
                                    <a href="index.php?page=supplier/update&id=<?= $supplier['supplier_id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="index.php?page=supplier/delete&id=<?= $supplier['supplier_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete user?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
</main>

<!-- Button trigger modal -->