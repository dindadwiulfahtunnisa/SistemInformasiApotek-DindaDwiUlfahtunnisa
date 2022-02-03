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
    $user_id = $_GET['id'];

    $users = mysqli_query($conn, "SELECT * FROM users WHERE user_id = '$user_id'");
    $roles = query("SELECT * FROM roles ORDER BY role_id");


    //jika hasil query = 0 maka muncul pesan error
    if (mysqli_num_rows($users) == 0) {
        echo '<div class="alert alert-warning">ID tidak ada dalam database.</div>';
        exit();
        //jika hasil query > 0
    } else {
        //membuat variabel $data dan menyimpan data row dari query
        $user = mysqli_fetch_assoc($users);
    }
}

if (isset($_POST['submit'])) {
    $user_id    = $_POST['user_id'];
    $username   = htmlspecialchars($_POST['username']);
    $fullname   = htmlspecialchars($_POST['fullname']);
    $password   = htmlspecialchars($_POST['password']);
    $role_id    = htmlspecialchars($_POST['role_id']);

    $query_update = "UPDATE users SET
                        username = '$username',
                        fullname = '$fullname',
                        password = '$password',
                        role_id = '$role_id'
                    WHERE user_id = '$user_id'
                    ";

    $update = mysqli_query($conn, $query_update) or die(mysqli_error($conn));

    if ($update) {
        echo '
            <script>
                alert("Successfully updated User!");
                document.location="index.php?page=users";
            </script>
            ';
    } else {
        echo '
            <script>
                alert("Failed updated User!");
                document.location="index.php?page=users/update&id=' . $user_id . '";
            </script>
            ';
    }
}
?>
<title>Update User &mdash; PHP MVC </title>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Users</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pages: Users / Update</li>
        </ol>

        <div class="row gx-5 py-md-5 justify-content-center">
            <div class="col-md-4 py-md-4">
                <form class="form-container py-md-4" action="index.php?page=users/update&id=<?= $user_id; ?>" method="POST">
                    <div class="mb-3">
                        <label for="user_id" class="form-label">ID User</label>
                        <input type="text" name="user_id" class="form-control" id="username" value="<?= $user['user_id'] ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="username" value="<?= $user['username'] ?>" required>
                    </div>
                    <div class=" mb-3">
                        <label for="fullname" class="form-label">Fullname</label>
                        <input type="text" name="fullname" class="form-control" id="fullname" value="<?= $user['fullname'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" value="<?= $user['password'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="role_id" class="form-label">Role</label>
                        <select name="role_id" id="role_id" class="form-select" value="<?= $user['role_id']; ?>">
                            <?php foreach ($roles as $role) : ?>
                                <option value="<?= $role['role_id'] ?>">
                                    <?= $role['role_level'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <!-- <input type="role_id" name="role_id" class="form-control" id="role_id" placeholder="Masukkan Password" required> -->
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    <a href="index.php?page=users" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</main>