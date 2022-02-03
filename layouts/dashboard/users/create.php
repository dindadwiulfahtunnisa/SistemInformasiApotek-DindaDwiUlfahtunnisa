<?php
// session_start();

// cek apakah yang mengakses halaman ini sudah login
// if (!isset($_SESSION['login'])) {
//     header('location: ../../index.php?page=login&status=notlogin');
//     exit();
// }

require '../../config/config.php';

$roles = query("SELECT * FROM roles");

if (isset($_POST['submit'])) {
    $username   = htmlspecialchars($_POST['username']);
    $fullname   = htmlspecialchars($_POST['fullname']);
    $password   = htmlspecialchars($_POST['password']);
    $role_id    = htmlspecialchars($_POST['role_id']);

    $query_create = "INSERT INTO users (username, fullname, password, role_id) 
                        VALUES ('$username', '$fullname', '$password', '$role_id')";

    // Cek apakah username sudah ada di database
    $username_checker = "SELECT * FROM users WHERE username='$username'";
    $check = mysqli_query($conn, $username_checker) or die(mysqli_error($conn));

    if (mysqli_num_rows($check) == 0) {
        $create = mysqli_query($conn, $query_create) or die(mysqli_error($conn));

        if ($create) {
            echo '
                <script>
                    alert("Successfully added new User!");
                    document.location="index.php?page=users";
                </script>
            ';
        } else {
            echo '
                <script>
                    alert("Failed add new user!");
                    document.location="index.php?page=users";
                </script>
            ';
        }
    } else {
        echo '
            <script>
                alert("Use another username!");
                document.location="index.php?page=users/create";
             </script>
        ';
    }
}

?>
<title>Create User &mdash; PHP MVC </title>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Users</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pages: Users / Create</li>
        </ol>

        <div class="row gx-5 py-md-5 justify-content-center">
            <div class="col-md-4 py-md-4">
                <form class="form-container py-md-4" action="index.php?page=users/create" method="POST">
                    <div class=" mb-3">
                        <label for="fullname" class="form-label">Fullname</label>
                        <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Masukkan Nama Lengkap" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan Username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan Password" required>
                    </div>

                    <div class="mb-3">
                        <label for="role_id" class="form-label">Role</label>
                        <select name="role_id" id="role_id" class="form-select">
                            <option selected>Pilih Role</option>
                            <?php foreach ($roles as $role) : ?>
                                <option value="<?= $role['role_id'] ?>">
                                    <?= $role['role_level'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <!-- <input type="role_id" name="role_id" class="form-control" id="role_id" placeholder="Masukkan Password" required> -->
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-dark">Clear</button>
                    <a href="index.php?page=users" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</main>