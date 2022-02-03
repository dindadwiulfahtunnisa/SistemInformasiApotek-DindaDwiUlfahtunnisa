<?php

//koneksi ke database mysql,
$localhost  = "localhost";
$username   = "root";
$password   = "";
$db         = "skripsi_dinda";

$conn = mysqli_connect($localhost, $username, $password, $db);

//cek jika koneksi ke mysql gagal, maka akan tampil pesan berikut
if (mysqli_connect_errno()) {
    echo "Gagal melakukan koneksi ke MySQL: " . mysqli_connect_error();
}

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $row = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
