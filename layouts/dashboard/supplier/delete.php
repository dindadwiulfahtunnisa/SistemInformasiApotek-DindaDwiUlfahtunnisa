<?php
// session_start();

require '../../config/config.php';

$id = $_GET['id'];

function delete($id)
{
    global $conn;
    $query_delete = "DELETE FROM tbl_supplier WHERE supplier_id = $id";

    mysqli_query($conn, $query_delete);
    return mysqli_affected_rows($conn);
}

if (delete($id) > 0) {
    echo '
        <script>
            alert("Successfully deleted Supplier!");
            document.location="index.php?page=supplier";
        </script>
    ';
} else {
    echo '
        <script>
            alert("Failed delete Supplier!");
            document.location="index.php?page=supplier";
        </script>
    ';
}
