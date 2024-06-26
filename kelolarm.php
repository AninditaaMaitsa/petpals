<?php
include 'koneksi.php';

// Fetch existing idhewan and norekam values from rekammedis table
$idhewanList = [];
$norekamList = [];
$query = "SELECT idhewan, norekam FROM rekammedis";
$sql = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($sql)) {
    $idhewanList[] = $row['idhewan'];
    $norekamList[] = $row['norekam'];
}

// Initialize other variables
$norekam = '';
$tgl_periksa = '';
$namahewan = '';
$idhewan = '';
$berathwn = '';
$temperatur = '';
$tindakan = '';
$diagnosa = '';
$hasil_periksa = '';
$gejala = '';
$foto = '';
$isEdit = false;

// If 'ubah' parameter is set, fetch record from rekammedis table
if (isset($_GET['ubah'])) { 
    $idhewan = $_GET['ubah'];
    $isEdit = true;

    $query = "SELECT * FROM rekammedis WHERE idhewan = '$idhewan';";
    $sql = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($sql);

    $norekam = $result['norekam'];
    $tgl_periksa = $result['tgl_periksa'];
    $namahewan = $result['namahewan'];
    $idhewan = $result['idhewan'];
    $berathwn = $result['berathwn'];
    $temperatur = $result['temperatur'];
    $tindakan = $result['tindakan'];
    $diagnosa = $result['diagnosa'];
    $hasil_periksa = $result['hasil_periksa'];
    $gejala = $result['gejala'];
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
            <a class="navbar-brand" href="#">Tambah Rekam Medis</a>
        </div>
    </nav>
    <div class="container">
        <form method="POST" action="prosesrm.php"  class="row g-3 needs-validation" novalidate enctype="multipart/form-data" onsubmit="return validateForm()">
            <input type="hidden" value="<?php echo isset($result['no']) ? $result['no'] : ''; ?>" name="no">
            <div class="col-md-4">
                <label for="norekam" class="form-label">No Rekam Medis</label>
                <input type="text" class="form-control" name="norekam" id="norekam" value="<?php echo $norekam; ?>" required>
                <div class="invalid-feedback" id="norekam-feedback">No Rekam Medis already exists.</div>
            </div>
            <div class="col-md-4">
                <label for="tgl_periksa" class="form-label">Tanggal Periksa</label>
                <input type="date" class="form-control" name="tgl_periksa" id="tgl_periksa" value="<?php echo $tgl_periksa; ?>" required>
                <div class="invalid-feedback">Please provide a valid Tanggal Periksa.</div>
            </div>
            <div class="col-md-4">
                <label for="namahewan" class="form-label">Nama Hewan</label>
                <input type="text" class="form-control" name="namahewan" id="namahewan" value="<?php echo $namahewan; ?>" required>
                <div class="invalid-feedback">Please provide a valid Nama Hewan.</div>
            </div>
            <div class="col-md-4">
                <label for="idhewan" class="form-label">Id Hewan</label>
                <input type="text" class="form-control" name="idhewan" id="idhewan" value="<?php echo $idhewan; ?>" required>
                <div class="invalid-feedback">Please provide a valid Id Hewan.</div>
            </div>
            <div class="col-md-4">
                <label for="berathwn" class="form-label">Berat Hewan</label>
                <div class="input-group has-validation">
                    <input type="text" class="form-control" name="berathwn" id="berathwn" value="<?php echo $berathwn; ?>" aria-describedby="inputGroupPrepend" required>
                    <span class="input-group-text" id="basic-addon1">kg</span>
                    <div class="invalid-feedback">Please choose a Berat Hewan.</div>
                </div>
            </div>
            <div class="col-md-4">
                <label for="temperatur" class="form-label">Temperatur</label>
                <input type="text" class="form-control" name="temperatur" id="temperatur" value="<?php echo $temperatur; ?>" required>
                <div class="invalid-feedback">Please provide a valid Temperatur.</div>
            </div>
            <div class="col-md-4">
                <label for="diagnosa" class="form-label">Diagnosa</label>
                <input type="text" class="form-control" name="diagnosa" id="diagnosa" value="<?php echo $diagnosa; ?>" required>
                <div class="invalid-feedback">Please provide a valid diagnosa.</div>
            </div>
            <div class="col-md-4">
                <label for="tindakan" class="form-label">Tindakan</label>
                <input type="text" class="form-control" name="tindakan" id="tindakan" value="<?php echo $tindakan; ?>" required>
                <div class="invalid-feedback">Please provide a valid Tindakan.</div>
            </div>
            <div class="col-md-4">
                <label for="foto" class="form-label">Foto</label>
                <input <?php if(!isset($_GET['ubah'])){ echo "required";} ?> class="form-control" type="file" name="foto" id="foto" accept="image/*" <?php if(!isset($_GET['ubah'])){ echo "required";} ?>>
                <div class="invalid-feedback">Please provide a valid foto.</div>
            </div>
            <div class="col-md-4">
                <label for="hasil_periksa" class="form-label">Hasil Periksa</label>
                <textarea class="form-control" name="hasil_periksa" id="hasil_periksa" rows="3" required><?php echo $hasil_periksa; ?></textarea>
                <div class="invalid-feedback">Please provide a valid hasil periksa.</div>
            </div>
            <div class="col-md-4">
                <label for="gejala" class="form-label">Gejala</label>
                <textarea class="form-control" name="gejala" id="gejala" rows="3" required><?php echo $gejala; ?></textarea>
                <div class="invalid-feedback">Please provide a valid Gejala.</div>
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
                <button class="btn btn-primary" type="submit" value="<?php echo isset($_GET['ubah']) ? 'edit' : 'add'; ?>" name="aksi">
                    <i class="fa fa-floppy-o" aria-hidden="true"></i>  
                    <?php echo isset($_GET['ubah']) ? 'Simpan' : 'Tambah'; ?>
                </button>
                <a href="rekammedis.php" class="btn btn-danger">
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
