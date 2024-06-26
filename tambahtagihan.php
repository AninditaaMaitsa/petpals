<!DOCTYPE html>
<?php 
include 'koneksi.php';

// Initialize variables
$id_hewan = '';
$no_rm = '';
$nama_hewan = '';
$item = '';
$harga = '';
$jumlah = '';
$total = '';
$tgl_transaksi = '';
$tgl_jatuhtempo = '';
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
    $id_hewan = $_GET['ubah'];
    $editing = true;
    
    $query = "SELECT * FROM tagihan WHERE id_hewan = '$id_hewan';";
    $sql = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($sql);

    $id_hewan = $result['id_hewan'];
    $no_rm = $result['no_rm'];
    $nama_hewan = $result['nama_hewan'];
    $item = $result['item'];
    $harga = $result['harga'];
    $jumlah = $result['jumlah'];
    $total = $result['total'];
    $tgl_transaksi = $result['tgl_transaksi']; 
    $tgl_jatuhtempo = $result['tgl_jatuhtempo'];
    $status_pem = $result['status_pem'];
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
            <a class="navbar-brand" href="#">Tambah Tagihan</a>
        </div>
    </nav>
    <div class="container">
        <form method="POST" action="prosestagihan.php" class="row g-3 needs-validation" novalidate onsubmit="return validateIdHewan()">
            <input type="hidden" value="<?php echo isset($result['no']) ? $result['no'] : ''; ?>" name="no">
            <div class="col-md-4">
                <label for="id_hewan" class="form-label">ID Hewan</label>
                <input type="text" class="form-control" name="id_hewan" id="id_hewan" value="<?php echo $id_hewan; ?>" required>
                <div class="invalid-feedback" id="idhewan-feedback">ID Hewan already exists.</div>
            </div>
            <div class="col-md-4">
                <label for="no_rm" class="form-label">Nomer Rekam Medis</label>
                <input type="text" class="form-control" name="no_rm" id="no_rm" value="<?php echo $no_rm; ?>" required>
                <div class="valid-feedback"></div>
            </div>
            <div class="col-md-4">
                <label for="nama_hewan" class="form-label">Nama hewan</label>
                <input type="text" class="form-control" name="nama_hewan" id="nama_hewan" value="<?php echo $nama_hewan; ?>" required>
                <div class="valid-feedback"></div>
            </div>
            <div class="col-md-4">
                <label for="tgl_transaksi" class="form-label">Tanggal Transaksi</label>
                <input type="date" class="form-control" name="tgl_transaksi" id="tgl_transaksi" value="<?php echo $tgl_transaksi; ?>" required>
                <div class="valid-feedback"></div>
            </div>
            <div class="col-md-4">
                <label for="tgl_jatuhtempo" class="form-label">Tanggal Jatuh Tempo</label>
                <input type="date" class="form-control" name="tgl_jatuhtempo" id="tgl_jatuhtempo" value="<?php echo $tgl_jatuhtempo; ?>" required>
                <div class="valid-feedback"></div>
            </div>
            <div class="col-md-4">
                <label for="item" class="form-label">Item</label>
                <input type="text" class="form-control" name="item" id="item" value="<?php echo $item; ?>" required>
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
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" class="form-control" name="jumlah" id="jumlah" min="0" step="1" value="<?php echo $jumlah; ?>" required>
                <div class="valid-feedback"></div>
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="col-md-4">
                <label for="subtotal" class="form-label">Sub Total :</label>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control mb-2" name="subtotal" id="subtotal" readonly>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <label for="admin_fee" class="form-label">Biaya Admin</label>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control mb-2" name="admin_fee" id="admin_fee" value="5000" readonly>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <label for="total" class="form-label">Total</label>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control mb-2" name="total" id="total" readonly>
            </div>
            <div class="col-md-4"></div>
            <div class="col-12">
                <hr>
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
        const existingId_Hewan = <?php echo json_encode($idhewanList); ?>;
        const editing = <?php echo json_encode($editing); ?>;
        const originalId_Hewan = <?php echo json_encode($id_hewan); ?>;
        
        function validateIdHewan() {
            const id_hewanInput = document.getElementById('id_hewan').value;
            const id_hewanFeedback = document.getElementById('id_hewan-feedback');

            if (!editing && existingId_Hewan.includes(id_hewanInput)) {
                id_hewanFeedback.style.display = 'block';
                return false;
            } else if (editing && id_hewanInput !== originalId_Hewan && existingId_Hewan.includes(id_hewanInput)) {
                id_hewanFeedback.style.display = 'block';
                return false;
            } else {
                id_hewanFeedback.style.display = 'none';
                return true;
            }
        }

        function calculateTotals() {
            const harga = parseFloat(document.getElementById('harga').value) || 0;
            const jumlah = parseFloat(document.getElementById('jumlah').value) || 0;
            const adminFee = 5000;

            const subtotal = harga * jumlah;
            const total = subtotal + adminFee;

            document.getElementById('subtotal').value = subtotal;
            document.getElementById('total').value = total;
        }

        document.getElementById('harga').addEventListener('input', calculateTotals);
        document.getElementById('jumlah').addEventListener('input', calculateTotals);

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
