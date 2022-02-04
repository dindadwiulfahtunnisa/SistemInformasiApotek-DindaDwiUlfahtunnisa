<?php
// session_start();

// cek apakah yang mengakses halaman ini sudah login
if (!isset($_SESSION['login'])) {
    header('location: ../../index.php?page=login&status=notlogin');
    exit();
}

require '../../config/config.php';

$users = query("SELECT * FROM users INNER JOIN roles ON roles.role_id = users.role_id");
$no = 1

?>
<title>Data Users</title>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Users</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pages: Users</li>
        </ol>

        <div class="card shadow-lg border-0 mb-4">
            <div class="card-header border-0 text-center p-4 bg-dark text-white">
                <i class="bi bi-table"></i>
                Table Data User
            </div>
            <div class="card-body border-0">
                <a href="?page=users/create" class="btn btn-sm btn-primary mb-3">Add User</a>

                <table class="table table-bordered table-hover table-responsive-sm text-center rounded">
                    <thead class="table-dark">
                        <th scope="col">No.</th>
                        <!-- <th scope="col">ID User</th> -->
                        <th scope="col">Username</th>
                        <th scope="col">Fullname</th>
                        <th scope="col">Role</th>
                        <th scope="col">Actions</th>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <!-- <td><?= $user['user_id']; ?></td> -->
                                <td><?= $user['username']; ?></td>
                                <td class="text-capitalize"><?= $user['fullname']; ?></td>
                                <td class="text-capitalize"><?= $user['role_level']; ?>
                                </td>
                                <td>
                                    <a href="index.php?page=users/update&id=<?= $user['user_id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="index.php?page=users/delete&id=<?= $user['user_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete user?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
</main>

<!-- Button trigger modal -->