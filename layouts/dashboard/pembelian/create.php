<?php
// session_start();

// cek apakah yang mengakses halaman ini sudah login
if (!isset($_SESSION['login'])) {
    header('location: ../../index.php?page=login&status=notlogin');
    exit();
}

require '../../config/config.php';

$pembelians = query("SELECT * FROM tbl_pembelian");
$obats = query("SELECT * FROM tbl_obat");
$suppliers = query("SELECT * FROM tbl_supplier");


if (isset($_POST['submit'])) {
    $kode_pembelian     = htmlspecialchars($_POST['kode_pembelian']);
    $obat_id            = htmlspecialchars($_POST['obat_id']);
    $kode_obat          = htmlspecialchars($_POST['kode_obat']);
    $supplier_id        = htmlspecialchars($_POST['supplier_id']);
    $tgl_pembelian      = htmlspecialchars($_POST['tgl_pembelian']);
    $total_pembelian    = htmlspecialchars($_POST['total_pembelian']);

    $query_create = "INSERT INTO tbl_pembelian (
                        kode_pembelian, obat_id,
                        kode_obat, supplier_id,
                        tgl_pembelian, total_pembelian
                        ) VALUES ( 
                            '$kode_pembelian', '$obat_id',
                            '$kode_obat',  '$supplier_id',
                            '$tgl_pembelian', '$total_pembelian'
                            )
                    ";

    // Cek apakah kode_pembelian sudah ada di database
    $kode_pembelian_checker = "SELECT * FROM tbl_pembelian WHERE kode_pembelian='$kode_pembelian'";
    $check = mysqli_query($conn, $kode_pembelian_checker) or die(mysqli_error($conn));

    if (mysqli_num_rows($check) == 0) {
        $create = mysqli_query($conn, $query_create) or die(mysqli_error($conn));

        if ($create) {
            echo '
                <script>
                    alert("Successfully added new Pembelian!");
                    document.location="index.php?page=pembelian";
                </script>
            ';
        } else {
            echo '
                <script>
                    alert("Failed add new Pembelian!");
                    document.location="index.php?page=pembelian";
                </script>
            ';
        }
    } else {
        echo '
            <script>
                alert("Use another Pembelian!");
                document.location="index.php?page=pembelian/create";
             </script>
        ';
    }
}

?>
<title>Create Pembelian</title>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Pembelian</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pages: Pembelian / Create</li>
        </ol>

        <div class="row gx-5 py-md-5 justify-content-center">
            <div class="col-md-4 py-md-4">
                <form class="form-container py-md-4" action="index.php?page=pembelian/create" method="POST">
                    <div class="mb-3">
                        <label for="kode_pembelian" class="form-label">Kode Pembelian</label>
                        <input type="text" name="kode_pembelian" class="form-control" id="kode_pembelian" placeholder="Masukkan Kode Pembelian" required>
                    </div>
                    <div class="mb-3">
                        <label for="obat_id" class="form-label">Nama Obat</label>
                        <select name="obat_id" id="obat_id" class="form-select" value="<?= $penjualan['obat_id']; ?>">
                            <option selected>Pilih Obat</option>
                            <?php foreach ($obats as $obat) : ?>
                                <option value="<?= $obat['obat_id'] ?>">
                                    <?= $obat['nama_obat'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kode_obat" class="form-label">Kode Obat</label>
                        <input type="text" name="kode_obat" class="form-control" id="kode_obat" placeholder="Masukkan Kode Obat" required>
                    </div>
                    <div class="mb-3">
                        <label for="supplier_id" class="form-label">Nama Supplier</label>
                        <select name="supplier_id" id="supplier_id" class="form-select" value="<?= $pembelian['supplier_id']; ?>">
                            <option selected>Pilih Supplier</option>
                            <?php foreach ($suppliers as $supplier) : ?>
                                <option value="<?= $supplier['supplier_id'] ?>">
                                    <?= $supplier['nama_supplier'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tgl_pembelian" class="form-label">Tanggal Pembelian</label>
                        <input type="date" name="tgl_pembelian" class="form-control" id="tgl_pembelian" placeholder="Masukkan Jumlah" required>
                    </div>
                    <div class="mb-3">
                        <label for="total_pembelian" class="form-label">Total Pembelian</label>
                        <input type="text" name="total_pembelian" class="form-control" id="total_pembelian" placeholder="Masukkan Total Pembelian" required>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-dark">Clear</button>
                    <a href="index.php?page=pembelian" class="btn btn-secondary">Cancel</a>
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