<!DOCTYPE html>
<?php 
include 'koneksi.php';

// Fetch all medications
$query = "SELECT * FROM obat;";
$sql = mysqli_query($conn, $query);
$no = 0;

// Search functionality
if (isset($_POST['bcari'])) {
    $keyword = $_POST['tcari'];
    $q = "SELECT * FROM obat WHERE idobat LIKE '%$keyword%' OR namaobat LIKE '%$keyword%'  ORDER BY idobat ASC";
} else {
    $q = "SELECT * FROM obat ORDER BY idobat ASC";
}

if (isset($_POST['breset'])) {
    $_POST['tcari'] = '';
    $q = "SELECT * FROM obat ORDER BY idobat ASC";
}

$sql = mysqli_query($conn, $q);

// Check for expired medications
$expiredMedications = [];
$currentDate = date('Y-m-d');
while ($result = mysqli_fetch_assoc($sql)) {
    if ($result['kadaluwarsa'] < $currentDate) {
        $expiredMedications[] = $result;
    }
    // Reset pointer for another loop
    $results[] = $result;
}

?>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Data Obat</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" crossorigin="anonymous"/>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="js/bootstrap.bundle.min.js"></script>
  <!-- Fontawesome -->
  <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="style.css">
  <!-- Custom JS -->
  <script src="script.js"></script>
</head>
<body>
  <div>
    <div class="sidebar" id="sidebar">
      <h4 class="mb-5 text-white">Nama Klinik</h4>
      <li><a class="text-white" href="index.php"><i class="bi bi-house mr-2"></i> Dashboard</a></li>
      <li><a class="text-white" href="rekammedis.php"><i class="bi bi-grid-fill mr-2"></i> Rekam Medis</a></li>
      <li><a class="text-white" href="pasien.php"><i class="fas fa-cat mr-2"></i> Pasien Saya</a></li>
      <li><a class="text-white" href="tracking.php"><i class="bi bi-bell mr-2"></i> Tracking</a></li>
      <li><a class="text-white" href="obat.php"><i class="fas fa-pills mr-2"></i> Obat</a></li>
      <li><a class="text-white" href="tagihan.php"><i class="fas fa-file-invoice mr-2"></i> Tagihan</a></li>
      <li><a class="text-white" href="#"><i class="bi bi-box-arrow-right mr-2"></i> Logout</a></li>
    </div>
  </div>

  <div class="p-4" id="main-content">
    <button class="btn-toggle btn btn-secondary" id="button-toggle"><i class="bi bi-list"></i></button>
    <div class="container-fluid">
      <figure>
        <h1 class="mt-4">Data Obat</h1>
        <blockquote class="blockquote"><p>Kucing Sehat Hanya Dalam Genggaman</p></blockquote>
        <figcaption class="blockquote-footer">Petpals <cite title="Source Title">Source Title</cite></figcaption>
      </figure>
      <a href="kelolaobat.php" type="button" class="btn btn-primary mb-3">Tambah Data <i class="fa fa-plus"></i></a>
      <form method="POST" action="" class="mb-3">
        <div class="input-group mb-3">
          <input type="text" name="tcari" id="tcari" value="<?php echo isset($_POST['tcari']) ? $_POST['tcari'] : ''; ?>" class="form-control" placeholder="Cari Data...">
          <button class="btn btn-primary" name="bcari" type="submit">Cari</button>
          <button class="btn btn-danger" name="breset" type="submit" id="reset-button">Reset</button>
        </div>
      </form>

      <?php if (!empty($expiredMedications)) { ?>
      <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Peringatan!</h4>
        <p>Obat-obat berikut telah melewati tanggal kedaluwarsa:</p>
        <ul>
          <?php foreach ($expiredMedications as $med) { ?>
          <li><?php echo $med['namaobat']; ?> (ID: <?php echo $med['idobat']; ?>) - Kadaluarsa: <?php echo $med['kadaluwarsa']; ?></li>
          <?php } ?>
        </ul>
      </div>
      <?php } ?>
    </div>

    <div class="container-fluid">
      <div class="table-responsive">
        <table class="table align-middle table-bordered table-hover">
          <thead>
            <tr>
              <th><center>No</center></th>
              <th><center>Id Obat</center></th>
              <th><center>Nama Obat</center></th>
              <th><center>Kategori</center></th>
              <th><center>Jumlah</center></th>
              <th><center>Lokasi Penyimpanan</center></th>
              <th><center>Harga</center></th>
              <th><center>Kadaluwarsa</center></th>
              <th><center>Aksi</center></th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 0;
            foreach ($results as $result) {
            ?>
              <tr>
                <td><center><?php echo ++$no; ?></center></td>
                <td><center><?php echo $result['idobat']; ?></center></td>
                <td><center><?php echo $result['namaobat']; ?></center></td>
                <td><center><?php echo $result['kategori']; ?></center></td>
                <td><center><?php echo $result['jumlah']; ?></center></td>
                <td><center><?php echo $result['lokasi_penyimpanan']; ?></center></td>
                <td><center><?php echo $result['harga']; ?></center></td>
                <td><center><?php echo $result['kadaluwarsa']; ?></center></td>
                <td>
                  <a href="prosesobat.php?hapus=<?php echo $result['idobat']; ?>" name="hapus" type="button" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Ingin Menghapus Data Tersebut?')"> 
                    <i class="fa fa-trash"></i>
                  </a>
                  <a href="kelolaobat.php?ubah=<?php echo $result['idobat']; ?>" type="button" class="btn btn-success btn-sm"> 
                    <i class="bi bi-pencil"></i>
                  </a>
                </td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script>
    // Toggle sidebar
    document.getElementById("button-toggle").addEventListener("click", () => {
      document.getElementById("sidebar").classList.toggle("active-sidebar");
      document.getElementById("main-content").classList.toggle("active-main-content");
    });

    // Clear search input when reset button is clicked
    document.getElementById("reset-button").addEventListener("click", () => {
      document.getElementById("tcari").value = '';
    });
  </script>
</body>
</html>
