<?php

require '../../config/config.php';

$penjualans = query("SELECT * FROM tbl_penjualan INNER JOIN tbL_obat ON tbl_penjualan.obat_id = tbl_obat.obat_id");
$no = 1;

?>
<title>Laporan Penjualan</title>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Penjualan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pages: Penjualan / Laporan</li>
        </ol>

        <div class="card shadow-lg border-0 mb-4">
            <div class="card-header border-0 text-center p-4 bg-dark text-white">
                LAPORAN PENJUALAN OBAT
                <br>
                Apotek Ruhul J
                <br>
                Jln Pagambiran No.10B
            </div>
            <div class="card-body">
                <a href="?page=penjualan" class="btn btn-sm btn-primary mb-3">Kembali</a>

                <table class="table table-bordered table-hover table-responsive-sm text-center">
                    <thead class="table-dark">
                        <th scope="col">No.</th>
                        <!-- <th scope="col">ID Penjualan</th> -->
                        <th scope="col">Tanggal</th>
                        <th scope="col">Kode Obat</th>
                        <th scope="col">Nama Obat</th>
                        <th scope="col">Total Penjualan</th>
                    </thead>
                    <tbody>
                        <?php foreach ($penjualans as $penjualan) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <!-- <td><?= $penjualan['penjualan_id']; ?></td> -->
                                <td><?= $penjualan['tgl_penjualan']; ?></td>
                                <td><?= $penjualan['kode_obat']; ?></td>
                                <td><?= $penjualan['nama_obat']; ?></td>
                                <td><?= $penjualan['jumlah']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
</main>

<!-- Button trigger modal -->