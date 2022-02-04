<?php

require '../../config/config.php';

// ambil id dari url
if (isset($_GET['id'])) {
    $supplier_id = $_GET['id'];

    $suppliers = mysqli_query($conn, "SELECT * FROM tbl_supplier  WHERE supplier_id = '$supplier_id'");

    //jika hasil query = 0 maka muncul pesan error
    if (mysqli_num_rows($suppliers) == 0) {
        echo '<div class="alert alert-warning">ID tidak ada dalam database.</div>';
        exit();
        //jika hasil query > 0
    } else {
        //membuat variabel $data dan menyimpan data row dari query
        $supplier = mysqli_fetch_assoc($suppliers);
    }
}

if (isset($_POST['submit'])) {
    $supplier_id    = htmlspecialchars($_POST['supplier_id']);
    $kode_supplier  = htmlspecialchars($_POST['kode_supplier']);
    $nama_supplier  = htmlspecialchars($_POST['nama_supplier']);
    $alamat         = htmlspecialchars($_POST['alamat']);
    $nohp           = htmlspecialchars($_POST['nohp']);

    $query_update = "UPDATE tbl_supplier SET
                        kode_supplier = '$kode_supplier',
                        nama_supplier = '$nama_supplier',
                        alamat        = '$alamat',
                        nohp          = '$nohp'
                    WHERE supplier_id = '$supplier_id'
                    ";

    $update = mysqli_query($conn, $query_update) or die(mysqli_error($conn));

    if ($update) {
        echo '
            <script>
                alert("Successfully updated Supplier!");
                document.location="index.php?page=supplier";
            </script>
            ';
    } else {
        echo '
            <script>
                alert("Failed updated Supplier!");
                document.location="index.php?page=supplier/update&id=' . $supplier_id . '";
            </script>
            ';
    }
}
?>
<title>Update Supplier</title>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Supplier</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pages: Suppliers / Update</li>
        </ol>

        <div class="row gx-5 py-md-5 justify-content-center">
            <div class="col-md-4 py-md-4">
                <form class="form-container py-md-4" action="index.php?page=supplier/update&id=<?= $supplier_id; ?>" method="POST">
                    <div class="mb-3">
                        <label for="supplier_id" class="form-label">ID Supplier</label>
                        <input type="text" name="supplier_id" class="form-control" id="supplier_id" value="<?= $supplier['supplier_id'] ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="kode_supplier" class="form-label">Kode Supplier</label>
                        <input type="text" name="kode_supplier" class="form-control" id="kode_supplier" value="<?= $supplier['kode_supplier'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_supplier" class="form-label">Nama Supplier</label>
                        <input type="text" name="nama_supplier" class="form-control" id="nama_supplier" value="<?= $supplier['nama_supplier'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat Supplier</label>
                        <input type="text" name="alamat" class="form-control" id="alamat" value="<?= $supplier['alamat'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="nohp" class="form-label">No HP Supplier</label>
                        <input type="text" name="nohp" class="form-control" id="nohp" value="<?= $supplier['nohp'] ?>" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    <a href="index.php?page=supplier" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</main>