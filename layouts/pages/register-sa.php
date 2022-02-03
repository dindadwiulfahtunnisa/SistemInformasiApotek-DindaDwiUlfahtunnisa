<?php
require 'config/config.php';

if (isset($_POST['submit'])) {
    $username   = $_POST['username'];
    $fullname   = $_POST['fullname'];
    $password   = $_POST['password'];
    $role_id    = 1; // 1 = superadmin

    $cek = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'") or die(mysqli_error($conn));

    if (mysqli_num_rows($cek) == 0) {
        $sql = mysqli_query(
            $conn,
            "INSERT INTO users (username, fullname, password, role_id) 
            VALUES ('$username', '$fullname', '$password', '$role_id')"
        ) or die(mysqli_error($conn));

        if ($sql) {
            echo '
                <script>
                    alert("Berhasil Register!");
                    document.location="index.php?page=login";
                </script>
            ';
        } else {
            echo '
                <div class="alert alert-warning">
                    Gagal melakukan proses register!
                </div>
            ';
        }
    } else {
        echo '
            <div class="alert alert-warning">
                Gagal, Nama sudah terdaftar!
            </div>
        ';
    }
}

?>
<title>Register &mdash; PHP MVC </title>
<main class="bg-dark py-5">
    <div class="container p-md-5">
        <h4 class="text-white text-center font-weight-bold">Daftar Akun Super Admin </h4>
        <div class="row gx-5 py-md-5 justify-content-center">
            <div class="col-md-4 py-md-4">
                <form class="form-container py-md-4" action="index.php?page=register1" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label text-white">Username</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan Username" required>
                    </div>
                    <div class=" mb-3">
                        <label for="fullname" class="form-label text-white">Fullname</label>
                        <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Masukkan Nama Lengkap" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label text-white">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan Password" required>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">
                        Register
                    </button>
                    <a href="index.php?page=login" class="btn btn-primary">
                        Login
                    </a>
                </form>
            </div>
        </div>
    </div>
</main>