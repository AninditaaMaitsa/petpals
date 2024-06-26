<!DOCTYPE html>
<?php 
include 'koneksi.php';

// Initialize variables
$idobat = '';
$namaobat = '';
$kategori = '';
$jumlah = '';
$lokasi_penyimpanan = '';
$harga = '';
$kadaluwarsa = '';

// Fetch existing `idobat` values
$idobatList = [];
$query = "SELECT idobat FROM obat";
$sql = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($sql)) {
    $idobatList[] = $row['idobat'];
}

$editing = false;

if (isset($_GET['ubah'])) { 
    $idobat = $_GET['ubah'];
    $editing = true;
    
    $query = "SELECT * FROM obat WHERE idobat = '$idobat';";
    $sql = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($sql);

    $namaobat = $result['namaobat'];
    $kategori = $result['kategori'];
    $jumlah = $result['jumlah'];
    $lokasi_penyimpanan = $result['lokasi_penyimpanan'];
    $harga = $result['harga'];
    $kadaluwarsa = $result['kadaluwarsa'];
}
?>

<html>
<head>
    <meta charset="utf-8">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/datepicker.css" rel="stylesheet">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">
    <title>Petpals</title>
</head>
<body>
    <nav class="navbar navbar-light bg-light mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><?php echo $editing ? 'Edit Obat' : 'Tambah Obat'; ?></a>
        </div>
    </nav>
    <div class="container">
        <form method="POST" action="prosesobat.php" class="row g-3 needs-validation" novalidate onsubmit="return validateIdObat()">
            <input type="hidden" value="<?php echo isset($result['no']) ? $result['no'] : ''; ?>" name="no">
            <div class="col-md-4">
                <label for="idobat" class="form-label">ID Obat</label>
                <input type="text" class="form-control" name="idobat" id="idobat" value="<?php echo $idobat; ?>" required>
                <div class="invalid-feedback" id="idobat-feedback">ID Obat already exists.</div>
            </div>
            <div class="col-md-4">
                <label for="namaobat" class="form-label">Nama Obat</label>
                <input type="text" class="form-control" name="namaobat" id="namaobat" value="<?php echo $namaobat; ?>" required>
                <div class="valid-feedback"></div>
            </div>
            <div class="col-md-4">
                <label for="kategori" class="form-label">Kategori</label>
                <input type="text" class="form-control" name="kategori" id="kategori" value="<?php echo $kategori; ?>" required>
                <div class="valid-feedback"></div>
            </div>
            <div class="col-md-4">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" class="form-control" name="jumlah" id="jumlah" min="0" step="1" value="<?php echo $jumlah; ?>" required>
                <div class="valid-feedback"></div>
            </div>
            <div class="col-md-4">
                <label for="lokasi_penyimpanan" class="form-label">Lokasi Penyimpanan</label>
                <input type="text" class="form-control" name="lokasi_penyimpanan" id="lokasi_penyimpanan" value="<?php echo $lokasi_penyimpanan; ?>" required>
                <div class="valid-feedback"></div>
            </div>
            <div class="col-md-4">
                <label for="harga" class="form-label">Harga</label>
                <div class="input-group">
                    <span class="input-group-text" id="harga">Rp</span>
                    <input type="text" class="form-control" name="harga" id="harga" value="<?php echo $harga; ?>" required>
                    <div class="valid-feedback"></div>
                </div>
            </div>
            <div class="col-md-4">
                <label for="kadaluwarsa" class="form-label">Kadaluwarsa</label>
                <input type="date" class="form-control" name="kadaluwarsa" id="kadaluwarsa" value="<?php echo $kadaluwarsa; ?>" required>
                <div class="valid-feedback"></div>
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                    <label class="form-check-label" for="invalidCheck">
                        Agree to terms and conditions
                    </label>
                    <div class="invalid-feedback">You must agree before submitting.</div>
                </div>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit" value="<?php echo $editing ? 'edit' : 'add'; ?>" name="aksi">
                    <i class="fa fa-floppy-o" aria-hidden="true"></i>  
                    <?php echo $editing ? 'Simpan' : 'Tambah'; ?>
                </button>
                <a href="obat.php" class="btn btn-danger">
                    <i class="fa fa-times" aria-hidden="true"></i>  
                    Batal
                </a>
            </div>
        </form>
    </div>
    <!-- Bootstrap Bundle with Popper -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="/js/bootstrap-datepicker.js"></script>
    <script>
        // Pass existing idobat values to JavaScript
        const existingIdObat = <?php echo json_encode($idobatList); ?>;
        const editing = <?php echo json_encode($editing); ?>;
        const originalIdObat = <?php echo json_encode($idobat); ?>;
        
        function validateIdObat() {
            const idobatInput = document.getElementById('idobat').value;
            const idobatFeedback = document.getElementById('idobat-feedback');

            if (!editing && existingIdObat.includes(idobatInput)) {
                idobatFeedback.style.display = 'block';
                return false;
            } else if (editing && idobatInput !== originalIdObat && existingIdObat.includes(idobatInput)) {
                idobatFeedback.style.display = 'block';
                return false;
            } else {
                idobatFeedback.style.display = 'none';
                return true;
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Bootstrap form validation
            var forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });

            // Initialize datepicker
            $('.datepicker').datepicker();
        });
    </script>
</body>
</html>
