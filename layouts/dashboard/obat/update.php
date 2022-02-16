<?php

// cek apakah yang mengakses halaman ini sudah login
if (!isset($_SESSION['login'])) {
    header('location: ../../index.php?page=login&status=notlogin');
    exit();
}

require '../../config/config.php';

// ambil id dari url
if (isset($_GET['id'])) {
    $obat_id = $_GET['id'];

    $obats = mysqli_query($conn, "SELECT * FROM tbl_obat WHERE obat_id = '$obat_id'");
    $suppliers = query("SELECT * FROM tbl_supplier ORDER BY supplier_id");


    //jika hasil query = 0 maka muncul pesan error
    if (mysqli_num_rows($obats) == 0) {
        echo '<div class="alert alert-warning">ID tidak ada dalam database.</div>';
        exit();
        //jika hasil query > 0
    } else {
        //membuat variabel $data dan menyimpan data row dari query
        $obat = mysqli_fetch_assoc($obats);
    }
}

if (isset($_POST['submit'])) {
    $obat_id        = htmlspecialchars($_POST['obat_id']);
    $kode_obat      = htmlspecialchars($_POST['kode_obat']);
    $nama_obat      = htmlspecialchars($_POST['nama_obat']);
    $kedaluwarsa    = htmlspecialchars($_POST['kedaluwarsa']);
    $harga_beli     = htmlspecialchars($_POST['harga_beli']);
    $harga_jual     = htmlspecialchars($_POST['harga_jual']);
    $satuan_obat    = htmlspecialchars($_POST['satuan_obat']);
    $stok           = htmlspecialchars($_POST['stok']);
    $supplier_id    = htmlspecialchars($_POST['supplier_id']);

    $query_update = "UPDATE tbl_obat SET
                        kode_obat   = '$kode_obat',
                        nama_obat   = '$nama_obat',
                        kedaluwarsa = '$kedaluwarsa',
                        harga_beli  = '$harga_beli',
                        harga_jual  = '$harga_jual',
                        satuan_obat = '$satuan_obat',
                        stok        = '$stok',
                        supplier_id = '$supplier_id'
                    WHERE obat_id = '$obat_id'
                    ";

    $update = mysqli_query($conn, $query_update) or die(mysqli_error($conn));

    if ($update) {
        echo '
            <script>
                alert("Successfully updated Obat!");
                document.location="index.php?page=obat";
            </script>
            ';
    } else {
        echo '
            <script>
                alert("Failed updated Obat!");
                document.location="index.php?page=obat/update&id=' . $obat_id . '";
            </script>
            ';
    }
}
?>
<title>Update Obat</title>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Obat</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pages: Obat / Update</li>
        </ol>

        <div class="row gx-5 py-md-5 justify-content-center">
            <div class="col-md-4 py-md-4">
                <form class="form-container py-md-4" action="index.php?page=obat/update&id=<?= $obat_id; ?>" method="POST">
                    <div class="mb-3">
                        <label for="obat_id" class="form-label">ID Obat</label>
                        <input type="text" name="obat_id" class="form-control" id="obat_id" value="<?= $obat['obat_id'] ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="kode_obat" class="form-label">Kode Obat</label>
                        <input type="text" name="kode_obat" class="form-control" id="kode_obat" value="<?= $obat['kode_obat'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_obat" class="form-label">Nama_Obat</label>
                        <input type="text" name="nama_obat" class="form-control" id="nama_obat" value="<?= $obat['nama_obat'] ?>" required>
                    </div>
                    <div class=" mb-3">
                        <label for="kedaluwarsa" class="form-label">Kedaluwarsa</label>
                        <input type="date" name="kedaluwarsa" class="form-control" id="kedaluwarsa" value="<?= $obat['kedaluwarsa'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga_beli" class="form-label">Harga Beli</label>
                        <input type="text" name="harga_beli" class="form-control" id="harga_beli" value="<?= $obat['harga_beli'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga_jual" class="form-label">Harga Jual</label>
                        <input type="text" name="harga_jual" class="form-control" id="harga_jual" value="<?= $obat['harga_jual'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="satuan_obat" class="form-label">Satuan Obat</label>
                        <!-- <input type="text" name="satuan_obat" class="form-control" id="satuan_obat" value="<?= $obat['satuan_obat'] ?>" required> -->
                        <select name="satuan_obat" id="satuan_obat" class="form-select" value="<?= $obat['satuan_obat'] ?>">
                            <option value="Tablet">Tablet</option>
                            <option value="Strip">Strip</option>
                            <option value="Pcs">Pcs</option>
                            <option value="Pack">Pack</option>
                            <option value="Tube">Tube</option>
                            <option value="Botol">Botol</option>
                            <option value="Botol">Kotak</option>

                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" name="stok" class="form-control" id="stok" value="<?= $obat['stok'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="supplier_id" class="form-label">Nama Supplier</label>
                        <select name="supplier_id" id="supplier_id" class="form-select" value="<?= $obat['supplier_id']; ?>">
                            <?php foreach ($suppliers as $supplier) : ?>
                                <option value="<?= $supplier['supplier_id'] ?>">
                                    <?= $supplier['nama_supplier'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <!-- <input type="role_id" name="role_id" class="form-control" id="role_id" placeholder="Masukkan Password" required> -->
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    <a href="index.php?page=obat" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</main>