<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <a class="nav-link <?php if ($_GET['page'] == 'dashboard') echo 'active' ?>" href="index.php?page=dashboard">
                <div class="sb-nav-link-icon">
                    <i class="bi bi-house-door-fill"></i>
                </div>
                Dashboard
            </a>
            <!-- <?php
                    echo $_SESSION['role_id'];
                    ?> -->

            <?php if ($_SESSION['role_id'] == 1) : ?>
                <a class="nav-link <?php if ($_GET['page'] == 'roles') echo 'active' ?>" href="index.php?page=roles">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-file-person-fill"></i>
                    </div>
                    Data Roles
                </a>
                <a class="nav-link <?php if ($_GET['page'] == 'users') echo 'active' ?>" href="index.php?page=users">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    Data Users
                </a>
                <a class="nav-link <?php if ($_GET['page'] == 'obat') echo 'active' ?>" href="index.php?page=obat">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-bag-plus-fill"></i>
                    </div>
                    Data Obat
                </a>
                <a class="nav-link <?php if ($_GET['page'] == 'supplier') echo 'active' ?>" href="index.php?page=supplier">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-briefcase-fill"></i>
                    </div>
                    Data Supplier
                </a>
                <a class="nav-link <?php if ($_GET['page'] == 'pembelian') echo 'active' ?>" href="index.php?page=pembelian">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-cart-plus-fill"></i>
                    </div>
                    Transaksi Pembelian
                </a>
                <a class="nav-link <?php if ($_GET['page'] == 'penjualan') echo 'active' ?>" href="index.php?page=penjualan">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-cart-check-fill"></i>
                    </div>
                    Transaksi Penjualan
                </a>
                <a class="nav-link <?php if ($_GET['page'] == 'peramalan') echo 'active' ?>" href="index.php?page=peramalan">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-bar-chart-line-fill"></i>
                    </div>
                    Peramalan
                </a>

            <?php elseif ($_SESSION['role_id'] == 2) : ?>
                <!-- <a class="nav-link <?php if ($_GET['page'] == 'users') echo 'active' ?>" href="index.php?page=users">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    Data Users
                </a> -->
                <a class="nav-link <?php if ($_GET['page'] == 'obat') echo 'active' ?>" href="index.php?page=obat">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-bag-plus-fill"></i>
                    </div>
                    Data Obat
                </a>
                <a class="nav-link <?php if ($_GET['page'] == 'supplier') echo 'active' ?>" href="index.php?page=supplier">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-briefcase-fill"></i>
                    </div>
                    Data Supplier
                </a>
                <a class="nav-link <?php if ($_GET['page'] == 'pembelian') echo 'active' ?>" href="index.php?page=pembelian">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-cart-plus-fill"></i>
                    </div>
                    Transaksi Pembelian
                </a>
                <a class="nav-link <?php if ($_GET['page'] == 'peramalan') echo 'active' ?>" href="index.php?page=peramalan">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-bar-chart-line-fill"></i>
                    </div>
                    Peramalan
                </a>

            <?php else : ?>
                <a class="nav-link <?php if ($_GET['page'] == 'obat') echo 'active' ?>" href="index.php?page=obat">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-bag-plus-fill"></i>
                    </div>
                    Data Obat
                </a>
                <a class="nav-link <?php if ($_GET['page'] == 'penjualan') echo 'active' ?>" href="index.php?page=penjualan">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-briefcase-fill"></i>
                    </div>
                    Trnsaksi Penjualan
                </a>
                <a class="nav-link <?php if ($_GET['page'] == 'peramalan') echo 'active' ?>" href="index.php?page=peramalan">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-cart-plus-fill"></i>
                    </div>
                    Peramalan
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>