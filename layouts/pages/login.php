<?php
require 'config/config.php';

if (isset($_SESSION['login'])) {
    header('location: layouts/dashboard/index.php?page=dashboard');
};

$status = isset($_GET['status']) ? $_GET['status'] : '';


if ($status == 'notlogin') {
    echo '
        <script>
            alert("Login Terlebih Dahulu!");
        </script>
    ';
} elseif ($status == 'gagal') {
    echo '
        <script>
            alert("Username atau Password Salah!");
        </script>
    ';
}
?>
<title>Login &mdash; PHP MVC</title>
<main class="bg-dark py-5">
    <div class="container p-md-5">
        <h4 class="text-white text-center font-weight-bold">Login Pengguna </h4>
        <div class="row gx-5 py-md-5 justify-content-center">
            <div class="col-md-4 py-md-4">
                <form class="form-container py-md-4" action="config/functionLogin.php" method="POST">
                    <div class="mb-5">
                        <label for="username" class="form-label text-white">Username</label>
                        <input type="text" name="username" class="form-control" id="username" required>
                    </div>
                    <div class="mb-5">
                        <label for="password" class="form-label text-white">Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>

                    <button type="submit" name="name" class="btn btn-primary">
                        Login
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>