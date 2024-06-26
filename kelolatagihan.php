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
$no_rm = '';
$tgl_transaksi = '';
$tgl_jatuhtempo = '';
$item = '';
$harga = '';
$jumlah = '';
$total = '';
$status_pem = '';

// Fetch existing idhewan values
$idhewanList = [];
$query = "SELECT id_hewan FROM tagihan";
$sql = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($sql)) {
    $idhewanList[] = $row['id_hewan'];
}

$editing = false;

if (isset($_GET['ubah'])) { 
    $idhewan = $_GET['ubah'];
    $editing = true;
    
    $query = "SELECT * FROM tagihan WHERE id_hewan = '$idhewan';";
    $sql = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($sql);
    $norm = $result['no_rm'];
    $namahewan = $result['nama_hewan'];
    $no_rm = $result['no_rm'];
    $tgl_transaksi = $result['tgl_transaksi'];
    $tgl_jatuhtempo = $result['tgl_jatuhtempo'];
    $item = $result['item'];
    $harga = $result['harga'];
    $jumlah = $result['jumlah'];
    $total = $result['total'];
    $status_pem  = $result['status_pem'];
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
            <a class="navbar-brand" href="#">Tambah tagihan</a>
        </div>
    </nav>
    <div class="container">
        <form method="POST" action="prosestagihan.php" class="row g-3 needs-validation" novalidate onsubmit="return validateIdHewan()">
            <input type="hidden" value="<?php echo isset($result['no']) ? $result['no'] : ''; ?>" name="no">
            <div class="col-md-4">
                <label for="idhewan" class="form-label">ID Hewan</label>
                <input type="text" class="form-control" name="idhewan" id="idhewan" value="<?php echo $idhewan; ?>" required>
                <div class="invalid-feedback" id="idhewan-feedback">ID Hewan already exists.</div>
            </div>
            <div class="col-md-4">
                <label for="namahewan" class="form-label">no_rm</label>
                <input type="text" class="form-control" name="no_rm" id="no_rm" value="<?php echo $no_rm; ?>" required>
                <div class="valid-feedback"></div>
            </div>
            <div class="col-md-4">
                <label for="namapemilik" class="form-label">nama_hewan</label>
                <input type="text" class="form-control" name="nama_hewan" id="nama_hewan" value="<?php echo $namahewan; ?>" required>
                <div class="valid-feedback"></div>
            </div>
            <div class="col-md-4">
                <label for="berat" class="form-label">tgl_transaksi</label>
                <div class="input-group has-validation">
                    <input type="date" class="form-control" name="tgl_transaksi" id="tgl_transaksi" value="<?php echo $tgl_transaksi; ?>" aria-describedby="inputGroupPrepend" required>
                </div>
            </div>
            <div class="col-md-4">
                <label for="berat" class="form-label">tgl_jatuhtempo</label>
                <div class="input-group has-validation">
                    <input type="date" class="form-control" name="tgl_jatuhtempo" id="tgl_jatuhtempo" value="<?php echo $tgl_jatuhtempo; ?>" aria-describedby="inputGroupPrepend" required>
                </div>
            </div>
            <div class="col-md-4">
                <label for="notelp" class="form-label">item</label>
                <input type="text" class="form-control" name="item" id="item" value="<?php echo $item; ?>" required>
                <div class="valid-feedback"></div>
            </div>
            <div class="col-md-4">
                <label for="jenishew" class="form-label">harga</label>
                <input type="text" class="form-control" name="harga" id="harga" value="<?php echo $harga; ?>" required>
                <div class="valid-feedback"></div>
            </div>
            <div class="col-md-4">
                <label for="warna" class="form-label">jumlah</label>
                <input type="text" class="form-control" name="jumlah" id="jumlah" value="<?php echo $jumlah; ?>" required>
                <div class="valid-feedback"></div>
            </div>
            <div class="col-md-4">
                <label for="umur" class="form-label">Sub total</label>
                <input disabled type="text" class="form-control" name="total1" id="total" value="<?php echo $total; ?>" required>
                <input type="hidden" name="total" id="total2" value="<?php echo $total; ?>">
                <div class="invalid-feedback">Please provide a valid umur.</div>
            </div>
            <div class="col-md-4">
                <label for="umur" class="form-label">total + B. Admin</label>
                <input disabled type="text" class="form-control" name="total1" id="total1" value="<?php echo $total; ?>" required>
                <div class="invalid-feedback">Please provide a valid umur.</div>
            </div>
            <div class="col-md-4">
                <label for="jk" class="form-label">status_pem</label>
                <select class="form-select" id="status_pem" name="status_pem" required>
                    <option selected disabled value="<?=$status_pem?>">Pilih Status Pembayaran</option>
                    <option value="paid">paid</option>
                    <option value="unpaid">unpaid</option>
                </select>
                <div class="invalid-feedback">Please select a valid state.</div>
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
                <a href="tagihan.php" class="btn btn-danger">
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

            if ((!editing && existingIdHewan.includes(idhewanInput)) || (editing && idhewanInput !== originalIdHewan && existingIdHewan.includes(idhewanInput))) {
                idhewanFeedback.style.display = 'block';
                return false;
            } else {
                idhewanFeedback.style.display = 'none';
                return true;
            }
        }

        function calculateTotals() {
            const harga = parseFloat(document.getElementById('harga').value.replace(/\D/g,'')) || 0;
            const jumlah = parseFloat(document.getElementById('jumlah').value.replace(/\D/g,'')) || 0;
            const adminFee = 5000;

            const subtotal = harga * jumlah;
            const total = subtotal + adminFee;

            // Set value to subtotal and total fields
            document.getElementById('total').value = subtotal.toLocaleString('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0, maximumFractionDigits: 0 });
            document.getElementById('total1').value = total.toLocaleString('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0, maximumFractionDigits: 0 });
            document.getElementById('total2').value = total;
        }

        // Event listeners for input fields
        document.getElementById('harga').addEventListener('input', calculateTotals);
        document.getElementById('jumlah').addEventListener('input', calculateTotals);

        // Initialize calculation on page load
        calculateTotals();

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
