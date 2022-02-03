<?php
// session_start();

// cek apakah yang mengakses halaman ini sudah login
// if (!isset($_SESSION['login'])) {
//     header('location: ../../index.php?page=login&status=notlogin');
//     exit();
// }

require '../../config/config.php';

$obats = query("SELECT * FROM tbl_supplier");

if (isset($_POST['submit'])) {
    $supplier_id    = htmlspecialchars($_POST['supplier_id']);
    $kode_supplier    = htmlspecialchars($_POST['kode_supplier']);
    $nama_supplier  = htmlspecialchars($_POST['nama_supplier']);
    $nohp           = htmlspecialchars($_POST['nohp']);
    $alamat         = htmlspecialchars($_POST['alamat']);

    $query_create = "INSERT INTO users (supplier_id, kode_supplier, nama_supplier, nohp, alamat, supplier_id) 
                        VALUES ('$supplier_id', '$kode_supplier', '$nama_supplier', '$nohp', '$alamat', '$supplier_id')";

    // Cek apakah username sudah ada di database
    $username_checker = "SELECT * FROM tbl_supplier WHERE nama_supplier='$nama_supplier'";
    $check = mysqli_query($conn, $username_checker) or die(mysqli_error($conn));

    if (mysqli_num_rows($check) == 0) {
        $create = mysqli_query($conn, $query_create) or die(mysqli_error($conn));

        if ($create) {
            echo '
                <script>
                    alert("Successfully added new Supplier!");
                    document.location="index.php?page=supplier";
                </script>
            ';
        } else {
            echo '
                <script>
                    alert("Failed add new supplier!");
                    document.location="index.php?page=supplier";
                </script>
            ';
        }
    } else {
        echo '
            <script>
                alert("Use another supplier!");
                document.location="index.php?page=supplier/create";
             </script>
        ';
    }
}

?>
<title>Create User &mdash; PHP MVC </title>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Supplier</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pages: Supplier / Create</li>
        </ol>

        <div class="row gx-5 py-md-5 justify-content-center">
            <div class="col-md-4 py-md-4">
                <form class="form-container py-md-4" action="index.php?page=supplier/create" method="POST">
                    <div class="mb-3">
                        <label for="nama_supplier" class="form-label">Nama Supplier</label>
                        <input type="text" name="nama_supplier" class="form-control" id="nama_supplier" placeholder="Masukkan Nama Supplier" required>
                    </div>
                    <div class="mb-3">
                        <label for="nohp" class="form-label">No Hp</label>
                        <input type="text" name="nohp" class="form-control" id="nohp" placeholder="Masukkan No Hp Petugas" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat Supplier</label>
                        <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Masukkan Alamat" required>
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