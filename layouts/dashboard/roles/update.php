<?php
// session_start();

// cek apakah yang mengakses halaman ini sudah login
// if (!isset($_SESSION['login'])) {
//     header('location: ../../index.php?page=login&status=notlogin');
//     exit();
// }

require '../../config/config.php';

// ambil id dari url
if (isset($_GET['id'])) {
    $role_id = $_GET['id'];

    $roles = mysqli_query($conn, "SELECT * FROM roles WHERE role_id = '$role_id'");


    //jika hasil query = 0 maka muncul pesan error
    if (mysqli_num_rows($roles) == 0) {
        echo '<div class="alert alert-warning">ID tidak ada dalam database.</div>';
        exit();
        //jika hasil query > 0
    } else {
        //membuat variabel $data dan menyimpan data row dari query
        $role = mysqli_fetch_assoc($roles);
    }
}

if (isset($_POST['submit'])) {
    $role_id    = $_POST['role_id'];
    $role_level    = htmlspecialchars($_POST['role_level']);

    $query_update = "UPDATE roles SET
                        role_level = '$role_level'
                    WHERE role_id = '$role_id'
                    ";

    $update = mysqli_query($conn, $query_update) or die(mysqli_error($conn));

    if ($update) {
        echo '
            <script>
                alert("Successfully updated Role!");
                document.location="index.php?page=roles";
            </script>
            ';
    } else {
        echo '
            <script>
                alert("Failed updated Role!");
                document.location="index.php?page=roles/update&id=' . $roles_id . '";
            </script>
            ';
    }
}
?>
<title>Update Role &mdash; PHP MVC </title>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Role</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pages: Role / Update</li>
        </ol>

        <div class="row gx-5 py-md-5 justify-content-center">
            <div class="col-md-4 py-md-4">
                <form class="form-container py-md-4" action="index.php?page=roles/update&id=<?= $role_id; ?>" method="POST">
                    <div class="mb-3">
                        <label for="role_id" class="form-label">ID Role</label>
                        <input type="text" name="role_id" class="form-control" id="username" value="<?= $role['role_id'] ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="role_level" class="form-label">Role Level</label>
                        <select name="role_level" id="role_id" class="form-select" ?>">
                            <!-- <option selected>Pilih Role</option> -->
                            <?php foreach ($roles as $role) : ?>
                                <option value="<?= $role['role_level'] ?>"><?= $role['role_level'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <input type="text" name="role_level" class="form-control" id="role_level" value="<?= $role['role_level'] ?>" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    <a href="index.php?page=roles" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</main>