<?php
include 'koneksi.php';

// Fetch existing idhewan and norekam values from rekammedis table
$idhewanList = [];
$norekamList = [];
$query = "SELECT idhewan, norekam FROM tracking";
$sql = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($sql)) {
    $idhewanList[] = $row['idhewan'];
    $norekamList[] = $row['norekam'];
}

// Initialize other variables
$idhewan = '';
$norekam = '';
$tgl_pem = '';
$estimasi_tgl = '';
$tahap = '';
$status ='';
$tgl_tahapan = '';
$waktu_tahapan = '';
$keterangan = '';
$isEdit = false;

// If 'ubah' parameter is set, fetch record from rekammedis table
if (isset($_GET['ubah'])) { 
    $idhewan = $_GET['ubah'];
    $isEdit = true;

    $query = "SELECT * FROM tracking WHERE idhewan = '$idhewan';";
    $sql = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($sql);

    $idhewan = $result['idhewan'];
    $norekam = $result['norekam'];
    $tgl_pem = $result['tgl_pem'];
    $estimasi_tgl = $result['estimasi_tgl'];
    $tahap = $result['tahap'];
    $status = $result['status'];
    $tgl_tahapan = $result['tgl_tahapan'];
    $waktu_tahapan = $result['waktu_tahapan'];
    $keterangan = $result['keterangan'];
}
?>

<!DOCTYPE html>
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
            <a class="navbar-brand" href="#">Edit Tracking</a>
        </div>
    </nav>
    <div class="container">
        <form method="POST" action="prosespendaftaran.php"  class="row g-3 needs-validation" novalidate enctype="multipart/form-data" onsubmit="return validateForm()">
            <input type="hidden" value="<?php echo isset($result['no']) ? $result['no'] : ''; ?>" name="no">
            <div class="col-md-4">
                <label for="norekam" class="form-label">No Rekam Medis</label>
                <input type="text" class="form-control" name="norekam" id="norekam" value="<?php echo $norekam; ?>" required>
                <div class="invalid-feedback" id="norekam-feedback">No Rekam Medis already exists.</div>
            </div>
            <div class="col-md-4">
                <label for="idhewan" class="form-label">Id Hewan</label>
                <input type="text" class="form-control" name="idhewan" id="idhewan" value="<?php echo $idhewan; ?>" required>
                <div class="invalid-feedback" id="norekam-feedback">No Rekam Medis already exists.</div>
            </div>
            <div class="col-md-4">
                <label for="tgl_pem" class="form-label">Tanggal dan Waktu Periksa</label>
                <input type="datetime-local" class="form-control" name="tgl_pem" id="tgl_pem" value="<?php echo $tgl_pem; ?>" required>
                <div class="invalid-feedback">Please provide a valid Tanggal Periksa.</div>
            </div>
            <div class="col-md-4">
                <label for="estimasi_tgl" class="form-label">Estimasi Tanggal dan Waktu Periksa</label>
                <input type="datetime-local" class="form-control" name="estimasi_tgl" id="estimasi_tgl" value="<?php echo $estimasi_tgl; ?>" required>
                <div class="invalid-feedback">Please provide a valid Tanggal Periksa.</div>
            </div>
            <div class="col-md-4">
                <label for="tahap" class="form-label">Tahap</label>
                <select class="form-select" id="tahap" name="tahap" required>
                    <option selected disabled value="">Pilih Tahapan</option>
                    <option <?php echo ($tahap == 'pendaftaran') ? 'selected' : ''; ?>>Pendaftaran</option>
                    <option <?php echo ($tahap == 'penanganan') ? 'selected' : ''; ?>>Penanganan</option>
                    <option <?php echo ($tahap == 'perawatan') ? 'selected' : ''; ?>>Perawatan</option>
                    <option <?php echo ($tahap == 'selesai') ? 'selected' : ''; ?>>Selesai</option>
                </select>
                <div class="invalid-feedback">Please select a valid state.</div>
            </div>
            <div class="col-md-4">
                <label for="status" class="form-label">Status Pemeriksaan</label>
                <select class="form-select" id="status" name="status" required>
                    <option selected disabled value="">Pilih Status Pemeriksaan</option>
                    <option <?php echo ($tahap == 'selesai') ? 'selected' : ''; ?>>Selesai</option>
                    <option <?php echo ($tahap == 'progress') ? 'selected' : ''; ?>>Dalam Penanganan</option>
                </select>
                <div class="invalid-feedback">Please select a valid state.</div>
            </div>
            <div class="col-md-4">
                <label for="tgl_tahapan" class="form-label">Tanggal Tahapan</label>
                <input type="date" class="form-control" name="tgl_tahapan" id="tgl_tahapan" value="<?php echo $tgl_tahapan; ?>" required>
                <div class="invalid-feedback">Please provide a valid Tanggal Periksa.</div>
            </div>
            <div class="col-md-4">
                <label for="waktu_tahapan" class="form-label">Waktu Tahapan</label>
                <input type="time" class="form-control" name="waktu_tahapan" id="waktu_tahapan" value="<?php echo $waktu_tahapan; ?>" required>
                <div class="invalid-feedback">Please provide a valid Tanggal Periksa.</div>
            </div>
            <div class="col-md-4">
                <label for="keterangan" class="form-label">Keterangan </label>
                <input type="text" class="form-control" name="keterangan" id="keterangan" value="<?php echo $keterangan; ?>" required>
                <div class="invalid-feedback" id="keterangan-feedback">Please provide a valid Keterangan.</div>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit" value="<?php echo isset($_GET['ubah']) ? 'edit' : 'add'; ?>" name="aksi">
                    <i class="fa fa-floppy-o" aria-hidden="true"></i>  
                    <?php echo isset($_GET['ubah']) ? 'Simpan' : 'Tambah'; ?>
                </button>
                <a href="tracking.php" class="btn btn-danger">
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
        // Pass existing idhewan and norekam values to JavaScript
        const existingIdHewan = <?php echo json_encode($idhewanList); ?>;
        const existingNorekam = <?php echo json_encode($norekamList); ?>;
        const isEdit = <?php echo json_encode($isEdit); ?>;
        
        function validateForm() {
            const idhewanInput = document.getElementById('idhewan').value;
            const norekamInput = document.getElementById('norekam').value;
            const norekamFeedback = document.getElementById('norekam-feedback');
            const idhewanFeedback = document.getElementById('idhewan-feedback');

            let isValid = true;

            if (!isEdit && existingIdHewan.includes(idhewanInput)) {
                idhewanFeedback.style.display = 'block';
                isValid = false;
            } else {
                idhewanFeedback.style.display = 'none';
            }

            if (existingNorekam.includes(norekamInput)) {
                norekamFeedback.style.display = 'block';
                isValid = false;
            } else {
                norekamFeedback.style.display = 'none';
            }

            return isValid;
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Bootstrap form validation
            var forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    const fotoInput = document.getElementById('foto');
                    if (!fotoInput.value && !isEdit) {
                        fotoInput.classList.add('is-invalid');
                    }

                    if (!form.checkValidity() || !validateForm()) {
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
