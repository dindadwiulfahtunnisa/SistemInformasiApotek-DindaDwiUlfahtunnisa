<?php

// cek apakah yang mengakses halaman ini sudah login
if (!isset($_SESSION['login'])) {
    header('location: ../../index.php?page=login&status=notlogin');
    exit();
}

require '../../config/config.php';

// ambil id dari url
if (isset($_GET['id'])) {
    $pembelian_id = $_GET['id'];

    $pembelians = mysqli_query($conn, "SELECT * FROM tbl_pembelian WHERE pembelian_id = '$pembelian_id'");
    $obats = query("SELECT * FROM tbl_obat");


    //jika hasil query = 0 maka muncul pesan error
    if (mysqli_num_rows($pembelians) == 0) {
        echo '<div class="alert alert-warning">ID tidak ada dalam database.</div>';
        exit();
        //jika hasil query > 0
    } else {
        //membuat variabel $data dan menyimpan data row dari query
        $pembelian = mysqli_fetch_assoc($pembelians);
    }
}

if (isset($_POST['submit'])) {
    $pembelian_id       = htmlspecialchars($_POST['pembelian_id']);
    $kode_pembelian     = htmlspecialchars($_POST['kode_pembelian']);
    $obat_id            = htmlspecialchars($_POST['obat_id']);
    $kode_obat          = htmlspecialchars($_POST['kode_obat']);
    $supplier_id        = htmlspecialchars($_POST['supplier_id']);
    $bulan              = htmlspecialchars($_POST['bulan']);
    $tahun              = htmlspecialchars($_POST['tahun']);
    $tgl_pembelian      = htmlspecialchars($_POST['tgl_pembelian']);
    $total_pembelian    = htmlspecialchars($_POST['total_pembelian']);

    $query_update = "UPDATE tbl_pembelian SET
                        kode_pembelian  = '$kode_pembelian',
                        obat_id         = '$obat_id',
                        kode_obat       = '$kode_obat',
                        supplier_id     = '$supplier_id',
                        bulan           = '$bulan',
                        tahun           = '$tahun',
                        tgl_pembelian   = '$tgl_pembelian',
                        total_pembelian = '$total_pembelian'
                    WHERE pembelian_id  = '$pembelian_id'
                    ";

    $update = mysqli_query($conn, $query_update) or die(mysqli_error($conn));

    if ($update) {
        echo '
            <script>
                alert("Successfully updated Pembelian!");
                document.location="index.php?page=pembelian";
            </script>
            ';
    } else {
        echo '
            <script>
                alert("Failed updated Pembelian!");
                document.location="index.php?page=pembelian/update&id=' . $pembelian_id . '";
            </script>
            ';
    }
}
?>
<title>Update Pembelian</title>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Pembelian</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pages: Pembelian / Update</li>
        </ol>

        <div class="row gx-5 py-md-5 justify-content-center">
            <div class="col-md-4 py-md-4">
                <form class="form-container py-md-4" action="index.php?page=pembelian/update&id=<?= $pembelian_id; ?>" method="POST">
                    <div class="mb-3">
                        <label for="pembelian_id" class="form-label">ID pembelian</label>
                        <input type="text" name="pembelian_id" class="form-control" id="pembelian_id" value="<?= $pembelian['pembelian_id'] ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="kode_pembelian" class="form-label">Kode pembelian</label>
                        <input type="text" name="kode_pembelian" class="form-control" id="kode_pembelian" value="<?= $pembelian['kode_pembelian'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="obat_id" class="form-label">Nama Obat</label>
                        <select name="obat_id" id="obat_id" class="form-select" value="<?= $pembelian['obat_id']; ?>">
                            <?php foreach ($obats as $obat) : ?>
                                <option value="<?= $obat['obat_id'] ?>">
                                    <?= $obat['nama_obat'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <?php
                    if (!isset($pembelian['obat_id'])) : ?>
                        <div class="mb-3">
                            <label for="kode_obat" class="form-label">Kode Obat</label>
                            <input type="text" name="kode_obat" class="form-control" id="kode_obat" value="<?= $pembelian['kode_obat'] ?>">
                        </div>
                    <?php else : ?>
                        <div class="mb-3">
                            <label for="kode_obat" class="form-label">Kode Obat</label>
                            <input type="text" name="kode_obat" class="form-control" id="kode_obat" value="<?= $obat['kode_obat'] ?>" readonly>
                        </div>
                    <?php endif ?>
                    <div class="mb-3">
                        <label for="bulan" class="form-label">Bulan</label>
                        <select name="bulan" id="bulan" class="form-select" value="<?= $pembelian['bulan'] ?>">
                            <option value="Januari">Januari</option>
                            <option value="Februari">Februari</option>
                            <option value="Maret">Maret</option>
                            <option value="April">April</option>
                            <option value="Mei">Mei</option>
                            <option value="Juni">Juni</option>
                            <option value="Juli">Juli</option>
                            <option value="Agustus">Agustus</option>
                            <option value="September">September</option>
                            <option value="Oktober">Oktober</option>
                            <option value="November">November</option>
                            <option value="Desember">Desember</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tahun" class="form-label">Tahun</label>
                        <input type="text" name="tahun" class="form-control" id="tahun" value="<?= $pembelian['tahun'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="tgl_pembelian" class="form-label">Tanggal Pembelian</label>
                        <input type="date" name="tgl_pembelian" class="form-control" id="tgl_pembelian" value="<?= $pembelian['tgl_pembelian'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="total_pembelian" class="form-label">Total Pembelian</label>
                        <input type="number" name="total_pembelian" class="form-control" id="total_pembelian" value="<?= $pembelian['total_pembelian'] ?>" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    <a href="index.php?page=pembelian" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</main>