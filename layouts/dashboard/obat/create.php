<?php
// session_start();

// cek apakah yang mengakses halaman ini sudah login
if (!isset($_SESSION['login'])) {
    header('location: ../../index.php?page=login&status=notlogin');
    exit();
}

require '../../config/config.php';

$suppliers = query("SELECT * FROM tbl_supplier");


if (isset($_POST['submit'])) {
    $kode_obat      = htmlspecialchars($_POST['kode_obat']);
    $nama_obat      = htmlspecialchars($_POST['nama_obat']);
    $kedaluwarsa    = htmlspecialchars($_POST['kedaluwarsa']);
    $harga_beli     = htmlspecialchars($_POST['harga_beli']);
    $harga_jual     = htmlspecialchars($_POST['harga_jual']);
    $satuan_obat    = htmlspecialchars($_POST['satuan_obat']);
    $stok           = htmlspecialchars($_POST['stok']);
    $supplier_id    = htmlspecialchars($_POST['supplier_id']);

    $query_create = "INSERT INTO tbl_obat (
                        kode_obat, nama_obat,
                        kedaluwarsa, harga_beli,
                        harga_jual, satuan_obat, 
                        stok, supplier_id
                        ) VALUES ( 
                            '$kode_obat', '$nama_obat',
                            '$kedaluwarsa',  '$harga_beli',
                            '$harga_jual', '$satuan_obat',
                            '$stok', '$supplier_id'
                            )
                    ";

    // Cek apakah kode_obat sudah ada di database
    $nama_obat_checker = "SELECT * FROM tbl_obat WHERE nama_obat='$nama_obat'";
    $check = mysqli_query($conn, $nama_obat_checker) or die(mysqli_error($conn));

    if (mysqli_num_rows($check) == 0) {
        $create = mysqli_query($conn, $query_create) or die(mysqli_error($conn));

        if ($create) {
            echo '
                <script>
                    alert("Successfully added new Obat!");
                    document.location="index.php?page=obat";
                </script>
            ';
        } else {
            echo '
                <script>
                    alert("Failed add new obat!");
                    document.location="index.php?page=obat";
                </script>
            ';
        }
    } else {
        echo '
            <script>
                alert("Use another obat!");
                document.location="index.php?page=obat/create";
             </script>
        ';
    }
}

?>
<title>Create User &mdash; PHP MVC </title>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Obat</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pages: Obat / Create</li>
        </ol>

        <div class="row gx-5 py-md-5 justify-content-center">
            <div class="col-md-4 py-md-4">
                <form class="form-container py-md-4" action="index.php?page=obat/create" method="POST">
                    <div class="mb-3">
                        <label for="kode_obat" class="form-label">Kode Obat</label>
                        <input type="text" name="kode_obat" class="form-control" id="kode_obat" placeholder="Masukkan Kode Obat" required>
                    </div>
                    <div class=" mb-3">
                        <label for="nama_obat" class="form-label">Nama Obat</label>
                        <input type="text" name="nama_obat" class="form-control" id="nama_obat" placeholder="Masukkan Nama Obat" required>
                    </div>
                    <!-- <div class="mb-3">
                        <label for="satuab_obat" class="form-label">Satuan Jual</label>
                        <input type="text" name="satuab_obat" class="form-control" id="satuab_obat" placeholder="Masukkan Satuan Jual" required>
                    </div> -->
                    <div class="mb-3">
                        <label for="satuan_obat" class="form-label">Satuan Jual</label>
                        <select name="satuan_obat" id="satuan_obat" class="form-select">
                            <option selected>Pilih Satuan Jual</option>
                            <option value="Tablet">Tablet</option>
                            <option value="Strip">Strip</option>
                            <option value="Pcs">Pcs</option>
                            <option value="Pack">Pack</option>
                            <option value="Tube">Tube</option>
                            <option value="Botol">Botol</option>
                            <option value="Botol">Kotak</option>

                        </select>
                        <!-- <input type="satuan_obat" name="satuan_obat" class="form-control" id="satuan_obat" placeholder="Masukkan Password" required> -->
                    </div>
                    <div class="mb-3">
                        <label for="harga_beli" class="form-label">Harga Beli Obat</label>
                        <input type="text" name="harga_beli" class="form-control" id="harga_beli" placeholder="Masukkan Harga Beli Obat" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga_jual" class="form-label">Harga Jual Obat</label>
                        <input type="text" name="harga_jual" class="form-control" id="harga_jual" placeholder="Masukkan Harga Jual Obat" required>
                    </div>
                    <div class="mb-3">
                        <label for="kedaluwarsa" class="form-label">Kedaluwarsa Obat</label>
                        <input type="date" name="kedaluwarsa" class="form-control" id="kedaluwarsa" placeholder="Masukkan Kedaluwarsa Obat" required>
                    </div>
                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok Obat</label>
                        <input type="number" name="stok" class="form-control" id="stok" placeholder="Masukkan Stok Obat" required>
                    </div>
                    <div class="mb-3">
                        <label for="supplier_id" class="form-label">Supplier</label>
                        <select name="supplier_id" id="supplier_id" class="form-select" value="<?= $row['supplier_id'] ?>">
                            <option selected>Pilih Supplier</option>
                            <?php foreach ($suppliers as $supplier) : ?>
                                <option value="<?= $supplier['supplier_id'] ?>">
                                    <?= $supplier['nama_supplier'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-dark">Clear</button>
                    <a href="index.php?page=obat" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
    $('.btn-number').click(function(e) {
        e.preventDefault();

        fieldName = $(this).attr('data-field');
        type = $(this).attr('data-type');
        var input = $("input[name='" + fieldName + "']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if (type == 'minus') {

                if (currentVal > input.attr('min')) {
                    input.val(currentVal - 1).change();
                }
                if (parseInt(input.val()) == input.attr('min')) {
                    $(this).attr('disabled', true);
                }

            } else if (type == 'plus') {

                if (currentVal < input.attr('max')) {
                    input.val(currentVal + 1).change();
                }
                if (parseInt(input.val()) == input.attr('max')) {
                    $(this).attr('disabled', true);
                }

            }
        } else {
            input.val(0);
        }
    });
</script>