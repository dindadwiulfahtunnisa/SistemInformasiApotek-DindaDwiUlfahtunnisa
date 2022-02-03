<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">

    <a class="navbar-brand ps-3" href="index.php?page=dashboard">Apotek Ruhul J</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
        <i class="fas fa-bars"></i>
    </button>
    <div class="d-none d-md-inline-block ms-auto">
        <!-- Navbar-->
        <ul class="navbar-nav ms-md-0 me-3 me-lg-4">
            <li class="nav-item text-white">
                <a href="#" class="nav-link"><?= $timenow; ?> WIB. &mdash;</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle"></i>
                    <span class="text-capitalize fst-italic">
                        <?= $_SESSION['username']; ?> &bull; <?= $_SESSION['fullname']; ?>
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="../../config/functionLogout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
</nav>