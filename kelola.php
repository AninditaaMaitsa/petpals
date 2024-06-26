<!DOCTYPE html>
<?php 
include 'koneksi.php';

// Initialize variables
$idhewan = '';
$namapem = '';
$namahewan = '';
$jk = '';
$notelp = '';
$alamat = '';
$dokterhewan = '';
$tglpendaf = '';
$jenishwn = '';
$berathwn = '';
$warnabulu = '';
$umur = '';
$riwobat = '';

// Fetch existing `idhewan` values
$idhewanList = [];
$query = "SELECT idhewan FROM pasien";
$sql = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($sql)) {
    $idhewanList[] = $row['idhewan'];
}

$editing = false;

if (isset($_GET['ubah'])) { 
    $idhewan = $_GET['ubah'];
    $editing = true;
    
    $query = "SELECT * FROM pasien WHERE idhewan = '$idhewan';";
    $sql = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($sql);

    $namapem = $result['namapem'];
    $namahewan = $result['namahewan'];
    $jk = $result['jk'];
    $notelp = $result['notelp'];
    $alamat = $result['alamat'];
    $dokterhewan = $result['dokterhewan'];
    $tglpendaf = $result['tglpendaf'];
    $jenishwn = $result['jenishwn'];
    $berathwn = $result['berathwn'];
    $warnabulu = $result['warnabulu'];
    $umur = $result['umur'];
    $riwobat = $result['riwobat'];
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
            <a class="navbar-brand" href="#">Tambah Pasien</a>
        </div>
    </nav>
    <div class="container">
        <form method="POST" action="proses.php" class="row g-3 needs-validation" novalidate onsubmit="return validateIdHewan()">
            <input type="hidden" value="<?php echo isset($result['no']) ? $result['no'] : ''; ?>" name="no">
            <div class="col-md-4">
                <label for="idhewan" class="form-label">ID Hewan</label>
                <input type="text" class="form-control" name="idhewan" id="idhewan" value="<?php echo $idhewan; ?>" required>
                <div class="invalid-feedback" id="idhewan-feedback">ID Hewan already exists.</div>
            </div>
            <div class="col-md-4">
                <label for="namahewan" class="form-label">Nama Hewan</label>
                <input type="text" class="form-control" name="namahewan" id="namahewan" value="<?php echo $namahewan; ?>" required>
                <div class="valid-feedback"></div>
            </div>
            <div class="col-md-4">
                <label for="namapemilik" class="form-label">Nama Pemilik</label>
                <input type="text" class="form-control" name="namapem" id="namapemilik" value="<?php echo $namapem; ?>" required>
                <div class="valid-feedback"></div>
            </div>
            <div class="col-md-4">
                <label for="berat" class="form-label">Berat Hewan</label>
                <div class="input-group has-validation">
                    <input type="text" class="form-control" name="berathwn" id="berat" value="<?php echo $berathwn; ?>" aria-describedby="inputGroupPrepend" required>
                    <span class="input-group-text" id="basic-addon1">kg</span>
                    <div class="invalid-feedback">Please choose a Berat Hewan.</div>
                </div>
            </div>
            <div class="col-md-4">
                <label for="notelp" class="form-label">No Telp</label>
                <input type="text" class="form-control" name="notelp" id="notelp" value="<?php echo $notelp; ?>" required>
                <div class="valid-feedback"></div>
            </div>
            <div class="col-md-4">
                <label for="jenishew" class="form-label">Jenis Hewan</label>
                <input type="text" class="form-control" name="jenishwn" id="jenishew" value="<?php echo $jenishwn; ?>" required>
                <div class="valid-feedback"></div>
            </div>
            <div class="col-md-4">
                <label for="warna" class="form-label">Warna Bulu</label>
                <input type="text" class="form-control" name="warnabulu" id="warna" value="<?php echo $warnabulu; ?>" required>
                <div class="valid-feedback"></div>
            </div>
            <div class="col-md-4">
                <label for="umur" class="form-label">Umur Hewan</label>
                <input type="text" class="form-control" name="umur" id="umur" value="<?php echo $umur; ?>" required>
                <div class="invalid-feedback">Please provide a valid umur.</div>
            </div>
            <div class="col-md-4">
                <label for="jk" class="form-label">Jenis Kelamin</label>
                <select class="form-select" id="jk" name="jk" required>
                    <option selected disabled value="">Pilih Jenis Kelamin</option>
                    <option <?php echo ($jk == 'Jantan') ? 'selected' : ''; ?>>Jantan</option>
                    <option <?php echo ($jk == 'Betina') ? 'selected' : ''; ?>>Betina</option>
                </select>
                <div class="invalid-feedback">Please select a valid state.</div>
            </div>
            <div class="col-md-4">
                <label for="dokterhewan" class="form-label">Dokter Hewan</label>
                <select class="form-select" id="dr" name="dokterhewan" required>
                    <option selected disabled value="">Pilih Dokter</option>
                    <option <?php echo ($dokterhewan == 'drh. Nivan') ? 'selected' : ''; ?>>drh. Nivan</option>
                    <option <?php echo ($dokterhewan == 'drh. Fey') ? 'selected' : ''; ?>>drh. Fey</option>
                </select>
                <div class="invalid-feedback">Please select a valid state.</div>
            </div>
            <div class="col-md-4">
                <label for="tanggal" class="form-label">Tanggal Pendaftaran</label>
                <input type="date" class="form-control" name="tglpendaf" id="tanggal" value="<?php echo $tglpendaf; ?>" required>
                <div class="valid-feedback"></div>
            </div>
            <div class="col-md-4">
                <label for="riwobat" class="form-label">Riwayat Obat</label>
                <input type="text" class="form-control" name="riwobat" id="riwobat" value="<?php echo $riwobat; ?>" required>
                <div class="invalid-feedback">Please provide a valid Riwayat Obat.</div>
            </div>
            <div class="col-md-6">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" name="alamat" id="alamat" rows="3" required><?php echo $alamat; ?></textarea>
                <div class="invalid-feedback">Please provide a valid Alamat.</div>
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
                <a href="pasien.php" class="btn btn-danger">
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
        // Pass existing idhewan values to JavaScript
        const existingIdHewan = <?php echo json_encode($idhewanList); ?>;
        const editing = <?php echo json_encode($editing); ?>;
        const originalIdHewan = <?php echo json_encode($idhewan); ?>;
        
        function validateIdHewan() {
            const idhewanInput = document.getElementById('idhewan').value;
            const idhewanFeedback = document.getElementById('idhewan-feedback');

            if (!editing && existingIdHewan.includes(idhewanInput)) {
                idhewanFeedback.style.display = 'block';
                return false;
            } else if (editing && idhewanInput !== originalIdHewan && existingIdHewan.includes(idhewanInput)) {
                idhewanFeedback.style.display = 'block';
                return false;
            } else {
                idhewanFeedback.style.display = 'none';
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
