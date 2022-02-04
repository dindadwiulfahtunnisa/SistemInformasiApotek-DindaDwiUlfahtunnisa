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
    $query_delete = "DELETE FROM tbl_penjualan WHERE penjualan_id = $id";

    mysqli_query($conn, $query_delete);
    return mysqli_affected_rows($conn);
}

if (delete($id) > 0) {
    echo '
        <script>
            alert("Successfully deleted Penjualan!");
            document.location="index.php?page=penjualan";
        </script>
    ';
} else {
    echo '
        <script>
            alert("Failed delete Penjualan!");
            document.location="index.php?page=penjualan";
        </script>
    ';
}
