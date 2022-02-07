<?php

require '../../config/config.php';

$pembelians = query("SELECT * FROM tbl_pembelian INNER JOIN tbL_obat ON tbl_pembelian.obat_id = tbl_obat.obat_id");
$no = 1;

?>
<title>Laporan Pembelian</title>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Pembelian</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pages: Pembelian / Laporan</li>
        </ol>

        <div class="card shadow-lg border-0 mb-4">
            <div class="card-header border-0 text-center p-4 bg-dark text-white">
                LAPORAN PEMBELIAN OBAT
                <br>
                Apotek Ruhul J
                <br>
                Jln Pagambiran No.10B
            </div>
            <div class="card-body">
                <a href="?page=pembelian" class="btn btn-sm btn-primary mb-3">Kembali</a>

                <table class="table table-bordered table-hover table-responsive-sm text-center">
                    <thead class="table-dark">
                        <th scope="col">No.</th>
                        <!-- <th scope="col">ID Penjualan</th> -->
                        <th scope="col">Tanggal</th>
                        <th scope="col">Kode Obat</th>
                        <th scope="col">Nama Obat</th>
                        <th scope="col">Total Pembelian</th>
                    </thead>
                    <tbody>
                        <?php foreach ($pembelians as $pembelian) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <!-- <td><?= $pembelian['pembelian_id']; ?></td> -->
                                <td><?= $pembelian['tgl_pembelian']; ?></td>
                                <td><?= $pembelian['kode_obat']; ?></td>
                                <td><?= $pembelian['nama_obat']; ?></td>
                                <td><?= $pembelian['total_pembelian']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
</main>

<!-- Button trigger modal -->