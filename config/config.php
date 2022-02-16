<?php

//koneksi ke database mysql,
$localhost  = "localhost";
$username   = "root";
$password   = "";
$db         = "forecasting_apotek";

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

function Ribuan($angka)
{
    if ($angka == 0 | empty($angka)) {
        $ribuan = 0;
    } else {
        $ribuan = number_format(round($angka, 0, PHP_ROUND_HALF_UP), 0, ',', '.');
    }
    return $ribuan;
}

function formatRupiah($angka)
{

    if (is_numeric($angka)) {
        $format_rupiah = 'Rp ' . number_format($angka, '2', ',', '.');
        return $format_rupiah;
    } else {
        echo "$angka" . " bukan angka yang valid!" . "\n";
    }
}

function RibuanPpn($angka)
{
    if ($angka == 0 | empty($angka)) {
        $ribuan = 0;
    } else {
        $ppn = $angka * (1 / 100);
        $angka = $angka + $ppn;
        $ribuan = number_format(round($angka, 0, PHP_ROUND_HALF_UP), 0, ',', '.');
    }
    return $ribuan;
}

function tanggal_indonesia($tgl, $tampil_hari = true)
{
    $nama_hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu");
    $nama_bulan = array(
        1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
        "September", "Oktober", "November", "Desember"
    );

    $tahun = substr($tgl, 0, 4);
    $bulan = $nama_bulan[(int)substr($tgl, 5, 2)];
    $tanggal = substr($tgl, 8, 2);
    $time = substr($tgl, 10, 6);
    $text = "";
    if ($tampil_hari) {
        $urutan_hari = date('w', mktime(0, 0, 0, substr($tgl, 5, 2), $tanggal, $tahun));
        $hari = $nama_hari[$urutan_hari];
        $text .= $hari . ", ";
    }
    $text .= $tanggal . " " . $bulan . " " . $tahun . " " . $time;
    // $text .= $tanggal . " " . $bulan . " " . $tahun;
    return $text;
}

function TanggalIndo($date)
{
    $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

    $tahun = substr($date, 0, 4);
    $bulan = substr($date, 5, 2);
    $tgl   = substr($date, 8, 2);

    $result = $tgl . " " . $BulanIndo[(int) $bulan - 1] . " " . $tahun;
    return ($result);
}

if (!function_exists('bulan')) {
    function bulan($month)
    {
        $namaBulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $bulan = $namaBulan[intval($month)];
        return $bulan;
    }
}
