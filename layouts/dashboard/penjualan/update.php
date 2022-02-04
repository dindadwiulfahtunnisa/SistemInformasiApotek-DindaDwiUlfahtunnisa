<?php

// cek apakah yang mengakses halaman ini sudah login
if (!isset($_SESSION['login'])) {
    header('location: ../../index.php?page=login&status=notlogin');
    exit();
}

require '../../config/config.php';

// ambil id dari url
if (isset($_GET['id'])) {
    $penjualan_id = $_GET['id'];

    $penjualans = mysqli_query($conn, "SELECT * FROM tbl_penjualan WHERE penjualan_id = '$penjualan_id'");
    $obats = query("SELECT * FROM tbl_obat");


    //jika hasil query = 0 maka muncul pesan error
    if (mysqli_num_rows($penjualans) == 0) {
        echo '<div class="alert alert-warning">ID tidak ada dalam database.</div>';
        exit();
        //jika hasil query > 0
    } else {
        //membuat variabel $data dan menyimpan data row dari query
        $penjualan = mysqli_fetch_assoc($penjualans);
    }
}

if (isset($_POST['submit'])) {
    $penjualan_id       = htmlspecialchars($_POST['penjualan_id']);
    $kode_penjualan     = htmlspecialchars($_POST['kode_penjualan']);
    $obat_id            = htmlspecialchars($_POST['obat_id']);
    $bulan              = htmlspecialchars($_POST['bulan']);
    $tahun              = htmlspecialchars($_POST['tahun']);
    $tgl_penjualan      = htmlspecialchars($_POST['tgl_penjualan']);
    $jumlah             = htmlspecialchars($_POST['jumlah']);

    $query_update = "UPDATE tbl_penjualan SET
                        kode_penjualan  = '$kode_penjualan',
                        obat_id         = '$obat_id',
                        bulan           = '$bulan',
                        tahun           = '$tahun',
                        tgl_penjualan   = '$tgl_penjualan',
                        jumlah          = '$jumlah'
                    WHERE penjualan_id  = '$penjualan_id'
                    ";

    $update = mysqli_query($conn, $query_update) or die(mysqli_error($conn));

    if ($update) {
        echo '
            <script>
                alert("Successfully updated Penjualan!");
                document.location="index.php?page=penjualan";
            </script>
            ';
    } else {
        echo '
            <script>
                alert("Failed updated Penjualan!");
                document.location="index.php?page=penjualan/update&id=' . $penjualan_id . '";
            </script>
            ';
    }
}
?>
<title>Update Penjualan</title>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Penjualan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pages: Penjualan / Update</li>
        </ol>

        <div class="row gx-5 py-md-5 justify-content-center">
            <div class="col-md-4 py-md-4">
                <form class="form-container py-md-4" action="index.php?page=penjualan/update&id=<?= $penjualan_id; ?>" method="POST">
                    <div class="mb-3">
                        <label for="penjualan_id" class="form-label">ID penjualan</label>
                        <input type="text" name="penjualan_id" class="form-control" id="penjualan_id" value="<?= $penjualan['penjualan_id'] ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="kode_penjualan" class="form-label">Kode penjualan</label>
                        <input type="text" name="kode_penjualan" class="form-control" id="kode_penjualan" value="<?= $penjualan['kode_penjualan'] ?>" required>
                    </div>
                    <!-- <div class="mb-3">
                        <label for="obat_id" class="form-label">ID Obat</label>
                        <input type="text" name="obat_id" class="form-control" id="obat_id" value="<?= $penjualan['obat_id'] ?>" required>
                    </div> -->
                    <div class="mb-3">
                        <label for="obat_id" class="form-label">Nama Obat</label>
                        <select name="obat_id" id="obat_id" class="form-select" value="<?= $penjualan['obat_id']; ?>">
                            <?php foreach ($obats as $obat) : ?>
                                <option value="<?= $obat['obat_id'] ?>">
                                    <?= $obat['nama_obat'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="bulan" class="form-label">Bulan</label>
                        <select name="bulan" id="bulan" class="form-select" value="<?= $penjualan['bulan'] ?>">
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
                        <input type="text" name="tahun" class="form-control" id="tahun" value="<?= $penjualan['tahun'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="tgl_penjualan" class="form-label">Tanggal Penjualan</label>
                        <input type="date" name="tgl_penjualan" class="form-control" id="tgl_penjualan" value="<?= $penjualan['tgl_penjualan'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" id="jumlah" value="<?= $penjualan['jumlah'] ?>" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    <a href="index.php?page=penjualan" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</main>