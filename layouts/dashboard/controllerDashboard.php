<?php

$page = (isset($_GET['page'])) ? $_GET['page'] : '';
$status = (isset($_GET['status'])) ? $_GET['status'] : '';

switch ($page) {
    case 'dashboard':
        $menu = 'dashboard';
        include "dashboard.php";
        break;

    case 'roles':
        include "roles/index.php";
        break;

    case 'roles/create':
        include "roles/create.php";
        break;

    case 'roles/update':
        include "roles/update.php";
        break;

    case 'roles/delete':
        include "roles/delete.php";
        break;

    case 'users':
        include "users/index.php";
        break;

    case 'users/create':
        include "users/create.php";
        break;

    case 'users/update':
        include "users/update.php";
        break;

    case 'users/delete':
        include "users/delete.php";
        break;

    case 'obat':
        include "obat/index.php";
        break;

    case 'obat/create':
        include "obat/create.php";
        break;

    case 'obat/update':
        include "obat/update.php";
        break;

    case 'obat/delete':
        include "obat/delete.php";
        break;

    case 'supplier':
        include "supplier/index.php";
        break;

    case 'supplier/create':
        include "supplier/create.php";
        break;

    case 'supplier/update':
        include "supplier/update.php";
        break;

    case 'supplier/delete':
        include "supplier/delete.php";
        break;

    case 'pembelian':
        include "pembelian/index.php";
        break;

    case 'pembelian/create':
        include "pembelian/create.php";
        break;

    case 'pembelian/update':
        include "pembelian/update.php";
        break;

    case 'pembelian/delete':
        include "pembelian/delete.php";
        break;

    case 'pembelian/laporan':
        include "pembelian/laporan.php";
        break;

    case 'penjualan':
        include "penjualan/index.php";
        break;

    case 'penjualan/create':
        include "penjualan/create.php";
        break;

    case 'penjualan/update':
        include "penjualan/update.php";
        break;

    case 'penjualan/delete':
        include "penjualan/delete.php";
        break;

    case 'penjualan/laporan':
        include "penjualan/laporan.php";
        break;

    case 'prediksi':
        include "prediksi/index.php";
        break;

    case 'prediksi/create':
        include "prediksi/create.php";
        break;

    case 'prediksi/update':
        include "prediksi/update.php";
        break;

    case 'prediksi/delete':
        include "prediksi/delete.php";
        break;

    default: // Ini untuk set default jika isi dari $page tidak ada
        include "dashboard.php";
}
