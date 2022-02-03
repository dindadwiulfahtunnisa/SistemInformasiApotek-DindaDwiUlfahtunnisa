<?php
// session_start();

// cek apakah yang mengakses halaman ini sudah login
// if (!isset($_SESSION['login'])) {
//     header('location: ../../index.php?page=login&status=notlogin');
//     exit();
// }

require '../../config/config.php';

$id = $_GET['id'];

function delete($id)
{
    global $conn;
    $query_delete = "DELETE FROM users WHERE user_id = $id";

    mysqli_query($conn, $query_delete);
    return mysqli_affected_rows($conn);
}

if (delete($id) > 0) {
    echo '
        <script>
            alert("Successfully deleted User!");
            document.location="index.php?page=users";
        </script>
    ';
} else {
    echo '
        <script>
            alert("Failed delete User!");
            document.location="index.php?page=users";
        </script>
    ';
}
