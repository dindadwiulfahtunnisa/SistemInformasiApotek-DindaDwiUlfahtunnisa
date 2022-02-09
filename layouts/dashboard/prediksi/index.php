<?php
// session_start();

// cek apakah yang mengakses halaman ini sudah login
// if (!isset($_SESSION['login'])) {
//     header('location: ../../index.php?page=login&status=notlogin');
//     exit();
// }

require '../../config/config.php';

$roles = query("SELECT * FROM roles");

if (isset($_POST['submit'])) {
    $role_level = htmlspecialchars($_POST['role_level']);

    $query_create = "INSERT INTO roles (role_level) 
                        VALUES ('$role_level')";

    // Cek apakah roles level sudah ada di database
    $level_checker = "SELECT * FROM roles WHERE role_level='$role_level'";
    $check = mysqli_query($conn, $level_checker) or die(mysqli_error($conn));

    if (mysqli_num_rows($check) == 0) {
        $create = mysqli_query($conn, $query_create) or die(mysqli_error($conn));

        if ($create) {
            echo '
                <script>
                    alert("Successfully added new Role Level!");
                    document.location="index.php?page=prediksi";
                </script>
            ';
        } else {
            echo '
                <script>
                    alert("Failed add new Role Level!");
                    document.location="index.php?page=prediksi";
                </script>
            ';
        }
    } else {
        echo '
            <script>
                alert("Use another Role Level!");
                document.location="index.php?page=prediksi/create";
             </script>
        ';
    }
}

?>
<title>Prediksi </title>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Prediksi</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pages: Prediksi</li>
        </ol>

        <div class="row gx-5 py-md-5 justify-content-center">
            <div class="col-md-4 py-md-4">
                <form class="form-container py-md-4" action="index.php?page=roles/create" method="POST">
                    <div class="mb-3">
                        <label for="obat_id" class="form-label">Nama Obat</label>
                        <select name="obat_id" id="obat_id" class="form-select" value="<?= $prediksi['obat_id']; ?>">
                            <option selected>Pilih Obat</option>
                            <?php foreach ($obats as $obat) : ?>
                                <option value="<?= $obat['obat_id'] ?>">
                                    <?= $obat['nama_obat'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="obat_id" class="form-label">Nilai Moving Average</label>
                        <select name="obat_id" id="obat_id" class="form-select" value="<?= $prediksi['obat_id']; ?>">
                            <option selected>Pilih Nilai</option>
                            <?php foreach ($obats as $obat) : ?>
                                <option value="<?= $obat['obat_id'] ?>">
                                    <?= $obat['nama_obat'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Hitung</button>
                </form>
            </div>
        </div>
    </div>
</main>