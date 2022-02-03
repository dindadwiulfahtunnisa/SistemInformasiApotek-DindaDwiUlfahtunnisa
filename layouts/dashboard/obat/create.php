<?php
// session_start();

// cek apakah yang mengakses halaman ini sudah login
// if (!isset($_SESSION['login'])) {
//     header('location: ../../index.php?page=login&status=notlogin');
//     exit();
// }

require '../../config/config.php';

$obats = query("SELECT * FROM tbl_obat");

if (isset($_POST['submit'])) {
    $kode_obat      = htmlspecialchars($_POST['kode_obat']);
    $nama_obat      = htmlspecialchars($_POST['nama_obat']);
    $satuan_obat    = htmlspecialchars($_POST['satuan_obat']);
    $harga_obat     = htmlspecialchars($_POST['harga_obat']);
    $hargabeli      = htmlspecialchars($_POST['hargabeli']);
    $kedaluwarsa    = htmlspecialchars($_POST['kedaluwarsa']);
    $stok           = htmlspecialchars($_POST['stok']);

    $query_create = "INSERT INTO tbl_obat (kode_obat, nama_obat, satuan_obat, harga_obat, hargabeli, kedaluwarsa, stok) 
                        VALUES ('$kode_obat', '$nama_obat', '$satuan_obat', '$harga_obat', '$hargabeli', '$kedaluwarsa', '$stok')";

    // Cek apakah kode_obat sudah ada di database
    $username_checker = "SELECT * FROM tbl_obat WHERE kode_obat='$kode_obat'";
    $check = mysqli_query($conn, $username_checker) or die(mysqli_error($conn));

    if (mysqli_num_rows($check) == 0) {
        $create = mysqli_query($conn, $query_create) or die(mysqli_error($conn));

        if ($create) {
            echo '
                <script>
                    alert("Successfully added new Obat!");
                    document.location="index.php?page=obat";
                </script>
            ';
        } else {
            echo '
                <script>
                    alert("Failed add new obat!");
                    document.location="index.php?page=obat";
                </script>
            ';
        }
    } else {
        echo '
            <script>
                alert("Use another obat!");
                document.location="index.php?page=obat/create";
             </script>
        ';
    }
}

?>
<title>Create User &mdash; PHP MVC </title>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Obat</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pages: Obat / Create</li>
        </ol>

        <div class="row gx-5 py-md-5 justify-content-center">
            <div class="col-md-4 py-md-4">
                <form class="form-container py-md-4" action="index.php?page=obat/create" method="POST">
                    <div class="mb-3">
                        <label for="kode_obat" class="form-label">Kode Obat</label>
                        <input type="text" name="kode_obat" class="form-control" id="kode_obat" placeholder="Masukkan Kode Obat" required>
                    </div>
                    <div class=" mb-3">
                        <label for="nama_obat" class="form-label">Nama Obat</label>
                        <input type="text" name="nama_obat" class="form-control" id="nama_obat" placeholder="Masukkan Nama Obat" required>
                    </div>
                    <!-- <div class="mb-3">
                        <label for="satuab_obat" class="form-label">Satuan Jual</label>
                        <input type="text" name="satuab_obat" class="form-control" id="satuab_obat" placeholder="Masukkan Satuan Jual" required>
                    </div> -->
                    <div class="mb-3">
                        <label for="obat_id" class="form-label">Satuan Jual</label>
                        <select name="obat_id" id="obat_id" class="form-select">
                            <option selected>Pilih Satuan Jual</option>
                            <option value="Tablet">Tablet</option>
                            <option value="Strip">Strip</option>
                            <option value="Pcs">Pcs</option>
                            <option value="Pack">Pack</option>
                            <option value="Tube">Tube</option>
                            <option value="Botol">Botol</option>

                        </select>
                        <!-- <input type="obat_id" name="obat_id" class="form-control" id="obat_id" placeholder="Masukkan Password" required> -->
                    </div>
                    <div class="mb-3">
                        <label for="harga_obat" class="form-label">Harga Obat</label>
                        <input type="text" name="harga_obat" class="form-control" id="harga_obat" placeholder="Masukkan Harga Obat" required>
                    </div>
                    <div class="mb-3">
                        <label for="hargabeli" class="form-label">Harga Beli Obat</label>
                        <input type="text" name="hargabeli" class="form-control" id="hargabeli" placeholder="Masukkan Harga Beli Obat" required>
                    </div>
                    <div class="mb-3">
                        <label for="kedaluwarsa" class="form-label">Kedaluwarsa Obat</label>
                        <input type="date" name="kedaluwarsa" class="form-control" id="kedaluwarsa" placeholder="Masukkan Kedaluwarsa Obat" required>
                    </div>
                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok Obat</label>
                        <input type="text" name="stok" class="form-control" id="stok" placeholder="Masukkan Stok Obat" required>
                    </div>

                    <div class="mb-3">
                        <label for="role_id" class="form-label">Role</label>
                        <select name="role_id" id="role_id" class="form-select">
                            <option selected>Pilih Role</option>
                            <?php foreach ($roles as $role) : ?>
                                <option value="<?= $role['role_id'] ?>">
                                    <?= $role['role_level'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <!-- <input type="role_id" name="role_id" class="form-control" id="role_id" placeholder="Masukkan Password" required> -->
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-dark">Clear</button>
                    <a href="index.php?page=obat" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</main>