<?php
// session_start();

// cek apakah yang mengakses halaman ini sudah login
// if (!isset($_SESSION['login'])) {
//     header('location: ../../index.php?page=login&status=notlogin');
//     exit();
// }

require '../../config/config.php';

$status = isset($_GET['status']) ? $_GET['status'] : '';

$countUsers = mysqli_query($conn, "SELECT count(*) as total from users");
$jumlahUser = mysqli_fetch_assoc($countUsers);

$countKaryawan = mysqli_query($conn, "SELECT role_id, count(*) as total from users WHERE role_id = 4");
$jumlahKaryawan = mysqli_fetch_assoc($countKaryawan);

$countApoteker = mysqli_query($conn, "SELECT role_id, count(*) as total from users WHERE role_id = 3");
$jumlahApoteker = mysqli_fetch_assoc($countApoteker);

$countObat = mysqli_query($conn, "SELECT count(*) as total from tbl_obat");
$jumlahObat = mysqli_fetch_assoc($countObat);

$countSuppliers = mysqli_query($conn, "SELECT count(*) as total from tbl_supplier");
$jumlahSupplier = mysqli_fetch_assoc($countSuppliers);

if ($status == 'login') {
    echo '
        <script>
            alert("Welcome to Dashboard!");
        </script>
    ';
}

?>
<title>Dashboard &mdash; PHP MVC</title>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-dark text-white mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">Data Users</div>
                            <div class="col-md-6 text-center display-6"><?= $jumlahUser['total'] ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-dark text-white mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">Data Apoteker</div>
                            <div class="col-md-6 text-center display-6"><?= $jumlahApoteker['total'] ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-dark text-white mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">Data Karyawan</div>
                            <div class="col-md-6 text-center display-6"><?= $jumlahKaryawan['total'] ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-dark text-white mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">Data Suppliers</div>
                            <div class="col-md-6 text-center display-6"><?= $jumlahSupplier['total'] ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">Data Obat</div>
                            <div class="col-md-6 text-center display-6"><?= $jumlahObat['total'] ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">Data Penjualan</div>
                            <div class="col-md-6 text-center display-6">0</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">Data Pembelian</div>
                            <div class="col-md-6 text-center display-6">0</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">Data Prediksi</div>
                            <div class="col-md-6 text-center display-6">0</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Area Chart Example
                    </div>
                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Bar Chart Example
                    </div>
                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
        </div> -->

        <!-- <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Transaksi Terbaru
            </div>
        </div>
        <div class="card-body">

        </div> -->
    </div>
</main>