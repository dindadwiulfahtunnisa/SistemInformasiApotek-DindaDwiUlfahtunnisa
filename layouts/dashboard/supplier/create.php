<?php
// session_start();

require '../../config/config.php';

$obats = query("SELECT * FROM tbl_supplier");

if (isset($_POST['submit'])) {
    $kode_supplier  = htmlspecialchars($_POST['kode_supplier']);
    $nama_supplier  = htmlspecialchars($_POST['nama_supplier']);
    $alamat         = htmlspecialchars($_POST['alamat']);
    $nohp           = htmlspecialchars($_POST['nohp']);

    $query_create = "INSERT INTO tbl_supplier (
                        kode_supplier,
                        nama_supplier,
                        alamat,
                        nohp
                    ) VALUES (  
                        '$kode_supplier',
                        '$nama_supplier',
                        '$alamat',
                        '$nohp'
                    )";

    // Cek apakah username sudah ada di database
    $nama_supplier_checker = "SELECT * FROM tbl_supplier WHERE nama_supplier = '$nama_supplier'";
    $check = mysqli_query($conn, $nama_supplier_checker) or die(mysqli_error($conn));

    if (mysqli_num_rows($check) == 0) {
        $create = mysqli_query($conn, $query_create) or die(mysqli_error($conn));

        if ($create) {
            echo '
                <script>
                    alert("Successfully added new Supplier!");
                    document.location="index.php?page=supplier";
                </script>
            ';
        } else {
            echo '
                <script>
                    alert("Failed add new Supplier!");
                    document.location="index.php?page=supplier";
                </script>
            ';
        }
    } else {
        echo '
            <script>
                alert("Supplier name is already!");
                document.location="index.php?page=supplier/create";
             </script>
        ';
    }
}

?>
<title>Create Supplier</title>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Supplier</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pages: Supplier / Create</li>
        </ol>

        <div class="row gx-5 py-md-2 justify-content-center">
            <div class="col-md-4 py-md-4">
                <form class="form-container py-md-2" action="index.php?page=supplier/create" method="POST">
                    <div class="mb-3">
                        <label for="kode_supplier" class="form-label">Kode Supplier</label>
                        <input type="text" name="kode_supplier" class="form-control" id="kode_supplier" placeholder="Masukkan Kode Supplier" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_supplier" class="form-label">Nama Supplier</label>
                        <input type="text" name="nama_supplier" class="form-control" id="nama_supplier" placeholder="Masukkan Nama Supplier" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat Supplier</label>
                        <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Masukkan Alamat" required>
                    </div>
                    <div class="mb-3">
                        <label for="nohp" class="form-label">Nomor Hp</label>
                        <input type="text" name="nohp" class="form-control" id="nohp" placeholder="Masukkan No Hp Petugas" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-dark">Clear</button>
                    <a href="index.php?page=supplier" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</main>