<?php
// session_start();

// cek apakah yang mengakses halaman ini sudah login
if (!isset($_SESSION['login'])) {
    header('location: ../../index.php?page=login&status=notlogin');
    exit();
}

require '../../config/config.php';

$suppliers = query("SELECT * FROM tbl_penjualan");
$obats = query("SELECT * FROM tbl_obat");


if (isset($_POST['submit'])) {
    $kode_penjualan     = htmlspecialchars($_POST['kode_penjualan']);
    $obat_id            = htmlspecialchars($_POST['obat_id']);
    $bulan              = htmlspecialchars($_POST['bulan']);
    $tahun              = htmlspecialchars($_POST['tahun']);
    $tgl_penjualan      = htmlspecialchars($_POST['tgl_penjualan']);
    $jumlah             = htmlspecialchars($_POST['jumlah']);

    $query_create = "INSERT INTO tbl_penjualan (
                        kode_penjualan, obat_id,
                        bulan, tahun,
                        tgl_penjualan, jumlah
                        ) VALUES ( 
                            '$kode_penjualan', '$obat_id',
                            '$bulan',  '$tahun',
                            '$tgl_penjualan', '$jumlah'
                            )
                    ";

    // Cek apakah kode_penjualan sudah ada di database
    $kode_penjualan_checker = "SELECT * FROM tbl_penjualan WHERE kode_penjualan='$kode_penjualan'";
    $check = mysqli_query($conn, $kode_penjualan_checker) or die(mysqli_error($conn));

    if (mysqli_num_rows($check) == 0) {
        $create = mysqli_query($conn, $query_create) or die(mysqli_error($conn));

        if ($create) {
            echo '
                <script>
                    alert("Successfully added new Penjualan!");
                    document.location="index.php?page=penjualan";
                </script>
            ';
        } else {
            echo '
                <script>
                    alert("Failed add new Penjualan!");
                    document.location="index.php?page=penjualan";
                </script>
            ';
        }
    } else {
        echo '
            <script>
                alert("Use another Penjualan!");
                document.location="index.php?page=penjualan/create";
             </script>
        ';
    }
}

?>
<title>Create Penjualan</title>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Penjualan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pages: Penjualan / Create</li>
        </ol>

        <div class="row gx-5 py-md-5 justify-content-center">
            <div class="col-md-4 py-md-4">
                <form class="form-container py-md-4" action="index.php?page=penjualan/create" method="POST">
                    <div class="mb-3">
                        <label for="kode_penjualan" class="form-label">Kode Penjualan</label>
                        <input type="text" name="kode_penjualan" class="form-control" id="kode_penjualan" placeholder="Masukkan Kode Penjualan" required>
                    </div>
                    <!-- <div class=" mb-3">
                        <label for="obat_id" class="form-label">ID Obat</label>
                        <input type="text" name="obat_id" class="form-control" id="obat_id" placeholder="Masukkan ID Obat" required>
                    </div> -->
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
                        <label for="bulan" class="form-label">Bulan</label>
                        <select name="bulan" id="bulan" class="form-select">
                            <option selected>Pilih Bulan</option>
                            <option value="Januari">Januari</option>
                            <option value="Februari">Februari</option>
                            <option value="Maret">Maret</option>
                            <option value="April">April</option>
                            <option value="Mei">Mei</option>
                            <option value="Juni">Juni</option>
                            <option value="Juli">Juli</option>
                            <option value="Agustus">Agustus</option>
                            <option value="September">September</option>
                            <option value="Oktober">Oktober</option>
                            <option value="November">November</option>
                            <option value="Desember">Desember</option>

                        </select>
                        <!-- <input type="satuan_obat" name="satuan_obat" class="form-control" id="satuan_obat" placeholder="Masukkan Password" required> -->
                    </div>
                    <div class="mb-3">
                        <label for="tahun" class="form-label">Tahun</label>
                        <input type="text" name="tahun" class="form-control" id="tahun" placeholder="Masukkan Tahun" required>
                    </div>
                    <div class="mb-3">
                        <label for="tgl_penjualan" class="form-label">Tanggal Penjualan</label>
                        <input type="date" name="tgl_penjualan" class="form-control" id="tgl_penjualan" placeholder="Masukkan Tanggal Penjualan" required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="text" name="jumlah" class="form-control" id="jumlah" placeholder="Masukkan Jumlah" required>
                    </div>
                    <!-- <div class="mb-3">
                        <label for="supplier_id" class="form-label">Supplier</label>
                        <select name="supplier_id" id="supplier_id" class="form-select" value="<?= $row['supplier_id'] ?>">
                            <option selected>Pilih Supplier</option>
                            <?php foreach ($suppliers as $supplier) : ?>
                                <option value="<?= $supplier['supplier_id'] ?>">
                                    <?= $supplier['nama_supplier'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div> -->
                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-dark">Clear</button>
                    <a href="index.php?page=supplier" class="btn btn-secondary">Cancel</a>
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