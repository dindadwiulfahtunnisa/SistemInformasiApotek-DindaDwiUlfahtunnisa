<?php
session_start();

// cek apakah yang mengakses halaman ini sudah login
if (!isset($_SESSION['login'])) {
    header('location: ../../index.php?page=login&status=notlogin');
    exit();
}

require '../../config/functionDate.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../components/head.php'; ?>
    <?php include '../components/dashboard-css.php'; ?>
</head>

<body class="sb-nav-fixed">
    <!-- Top Navbar -->
    <?php include '../components/topnav.php'; ?>

    <div id="layoutSidenav">
        <!-- Sidebar -->
        <div id="layoutSidenav_nav">
            <?php include '../components/sidenav.php'; ?>
        </div>

        <!-- Content -->
        <div id="layoutSidenav_content">
            <?php include 'controllerDashboard.php'; ?>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted ms-auto">Copyright &copy; 2022 Dinda Dwi Ulfahtunnisa 18101152610635</div>
                        <!-- <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div> -->
                    </div>
                </div>
            </footer>
        </div>


    </div>


    <!-- JS -->
    <?php include '../components/dashboard-js.php'; ?>

    <script>
        window.addEventListener("DOMContentLoaded", (event) => {
            // Toggle the side navigation
            const sidebarToggle = document.body.querySelector("#sidebarToggle");
            if (sidebarToggle) {
                // Uncomment Below to persist sidebar toggle between refreshes
                // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
                //     document.body.classList.toggle('sb-sidenav-toggled');
                // }
                sidebarToggle.addEventListener("click", (event) => {
                    event.preventDefault();
                    document.body.classList.toggle("sb-sidenav-toggled");
                    localStorage.setItem("sb|sidebar-toggle", document.body.classList.contains("sb-sidenav-toggled"));
                });
            }
        });
    </script>
</body>

</html>