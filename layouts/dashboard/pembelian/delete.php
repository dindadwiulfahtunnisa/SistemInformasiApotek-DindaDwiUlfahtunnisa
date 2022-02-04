<?php
// session_start();

// cek apakah yang mengakses halaman ini sudah login
if (!isset($_SESSION['login'])) {
    header('location: ../../index.php?page=login&status=notlogin');
    exit();
}

require '../../config/config.php';

$id = $_GET['id'];

function delete($id)
{
    global $conn;
    $query_delete = "DELETE FROM tbl_pembelian WHERE pembelian_id = $id";

    mysqli_query($conn, $query_delete);
    return mysqli_affected_rows($conn);
}

if (delete($id) > 0) {
    echo '
        <script>
            alert("Successfully deleted Pembelian!");
            document.location="index.php?page=pembelian";
        </script>
    ';
} else {
    echo '
        <script>
            alert("Failed delete Pembelian!");
            document.location="index.php?page=pembelian";
        </script>
    ';
}
