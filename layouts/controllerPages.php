<?php
$page = (isset($_GET['page'])) ? $_GET['page'] : '';

$status = (isset($_GET['status'])) ? $_GET['status'] : '';

switch ($page) {
    case 'home': // $page == home (jika isi dari $page adalah home)
        include "pages/home.php"; // load file home.php yang ada di folder pages
        break;

    case 'about': // $page == tentang (jika isi dari $page adalah tentang)
        include "pages/about.php"; // load file tentang.php yang ada di folder pages
        break;

    case 'login': // $page == login (jika isi dari $page adalah login)
        include "pages/login.php"; // load file login.php yang ada di folder pages
        break;

    case 'logout': // $page == login (jika isi dari $page adalah login)
        include "../config/functionLogout.php"; // load file login.php yang ada di folder pages
        break;

    case 'register': // $page == register (jika isi dari $page adalah register)
        include "pages/register.php"; // load file register.php yang ada di folder pages
        break;

    case 'register-sa': // $page == register (jika isi dari $page adalah register)
        include "pages/register-sa.php"; // load file register.php yang ada di folder pages
        break;

    default: // Ini untuk set default jika isi dari $page tidak ada pada 3 kondisi diatas
        include "pages/home.php";
}
