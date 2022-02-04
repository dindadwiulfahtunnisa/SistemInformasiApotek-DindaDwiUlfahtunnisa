<?php
// session_start();

// cek apakah yang mengakses halaman ini sudah login
if (!isset($_SESSION['login'])) {
    header('location: ../../index.php?page=login&status=notlogin');
    exit();
}

require '../../config/config.php';

$roles = query("SELECT * FROM roles");
$no = 1

?>
<title>Data Roles</title>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Roles</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pages: Roles</li>
        </ol>

        <div class="card shadow-lg border-0 mb-4">
            <div class="card-header border-0 text-center p-4 bg-dark text-white">
                <i class="bi bi-table"></i>
                Table Data Role
            </div>
            <div class="card-body border-0">
                <a href="?page=roles/create" class="btn btn-sm btn-primary mb-3">Add Role</a>

                <table class="table table-bordered table-hover table-responsive-sm text-center rounded">
                    <thead class="table-dark">
                        <th scope="col">No.</th>
                        <!-- <th scope="col">ID Role</th> -->
                        <th scope="col">Role Level</th>
                        <th scope="col">Actions</th>
                    </thead>
                    <tbody>
                        <?php foreach ($roles as $role) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <!-- <td><?= $role['role_id']; ?></td> -->
                                <td><?= $role['role_level']; ?></td>
                                <td>
                                    <a href="index.php?page=roles/update&id=<?= $role['role_id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="index.php?page=roles/delete&id=<?= $role['role_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete Role?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
</main>