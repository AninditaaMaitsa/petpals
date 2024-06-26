<?php
include 'koneksi.php';
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
    header('Location: login.php');
    exit;
}
// Mengambil jumlah record rekam medis
$queryCountRekamMedis = "SELECT COUNT(*) AS total FROM rekammedis;";
$resultCountRekamMedis = mysqli_query($conn, $queryCountRekamMedis);
$rowCountRekamMedis = mysqli_fetch_assoc($resultCountRekamMedis);

// Mengambil jumlah record pasien
$queryCountPasien = "SELECT COUNT(*) AS total FROM pasien;";
$resultCountPasien = mysqli_query($conn, $queryCountPasien);
$rowCountPasien = mysqli_fetch_assoc($resultCountPasien);

// Mengambil jumlah record obat
$queryCountObat = "SELECT COUNT(*) AS total FROM obat;";
$resultCountObat = mysqli_query($conn, $queryCountObat);
$rowCountObat = mysqli_fetch_assoc($resultCountObat);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <!-- bootstrap 5 css -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Fontawesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <!-- Sambungkan file CSS -->
  <link rel="stylesheet" href="style.css">
  <!-- Sambungkan file JavaScript -->
  <script src="script.js"></script>
  <style>
    .custom-card {
      background-color: #1E366E;
      color: white;
      border: 1px solid #1E366E;
      border-radius: 10px; /* Menggunakan border-radius untuk membuat card berbentuk persegi */
      height: 100%; /* Menyamakan tinggi card */
      display: flex; /* Menjadikan konten di dalam card menjadi flexbox */
      flex-direction: column; /* Menjadikan konten di dalam card menjadi kolom */
      justify-content: space-between; /* Membuat konten di dalam card berjarak merata */
    }
    .custom-card .card-body {
      flex-grow: 1; /* Menyebarkan ruang kosong ke tingkat maksimum */
    }
    .custom-btn {
      background-color: #162A58;
      border-color: #162A58;
      color: white; /* Menambahkan warna teks agar terlihat jelas */
    }
    .custom-btn:hover {
      background-color: #0F1D3D;
      border-color: #0F1D3D;
      color: white;
    }
  </style>
</head>

<body>
  <div>
    <div class="sidebar" id="sidebar">
      <h4 class="mb-5 text-white">Nama Klinik</h4>
      <li>
        <a class="text-white" href="index.php">
          <i class="bi bi-house mr-2"></i>
          Dashboard
        </a>
      </li>
      <li>
        <a class="text-white" href="rekammedis.php">
          <i class="bi bi-grid-fill mr-2"></i>
          Rekam Medis
        </a>
      </li>
      <li>
        <a class="text-white" href="pasien.php">
          <i class="fas fa-cat mr-2"></i>
          Pasien Saya
        </a>
      </li>
      <li>
        <a class="text-white" href="Tracking.php">
          <i class="bi bi-bell mr-2"></i>
          Tracking
        </a>
      </li>
      <li>
        <a class="text-white" href="obat.php">
          <i class="fas fa-pills mr-2"></i>
          Obat
        </a>
      </li>
      <li>
        <a class="text-white" href="tagihan.php">
          <i class="fas fa-file-invoice mr-2"></i>
          Tagihan
        </a>
      </li>
      <li>
        <a class="text-white" href="logout.php">
          <i class="bi bi-box-arrow-right mr-2"></i>
          Logout
        </a>
      </li>
    </div>
  </div>

  <div class="p-4" id="main-content">
    <button class="btn-toggle btn btn-secondary" id="button-toggle">
      <i class="bi bi-list"></i>
    </button>
    <!-- main content -->
    <div class="container-fluid">
      <figure>
        <h1 class="mt-4"> Dashboard </h1>
        <blockquote class="blockquote">
          <p>Kucing Sehat Hanya Dalam Genggaman</p>
        </blockquote>
        <figcaption class="blockquote-footer">
          Petpals <cite title="Source Title">Source Title</cite>
        </figcaption>
      </figure>
    </div>

    <div class="row">
      <div class="col-sm-4">
        <div class="card custom-card">
          <div class="card-body">
            <h5 class="card-title"><?php echo $rowCountRekamMedis['total']; ?></h5>
            <p class="card-text">Data Rekam Medis</p>
            <a href="rekammedis.php" class="btn custom-btn">Info Lebih Lanjut  
            <i class="bi bi-arrow-right-circle"></i></a>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card custom-card">
          <div class="card-body">
            <h5 class="card-title"><?php echo $rowCountPasien['total']; ?></h5>
            <p class="card-text">Data Pasien</p>
            <a href="pasien.php" class="btn custom-btn">Info Lebih Lanjut  
            <i class="bi bi-arrow-right-circle"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card custom-card">
          <div class="card-body">
            <h5 class="card-title"><?php echo $rowCountObat['total']; ?></h5>
            <p class="card-text">Data Obat</p>
            <a href="obat.php" class="btn custom-btn">Info Lebih Lanjut  
            <i class="bi bi-arrow-right-circle"></i>
            </a>
          </div>
        </div>
      </div>
    </div>

  </div>

  <script>
    // event will be executed when the toggle-button is clicked
    document.getElementById("button-toggle").addEventListener("click", () => {
      // when the button-toggle is clicked, it will add/remove the active-sidebar class
      document.getElementById("sidebar").classList.toggle("active-sidebar");
      // when the button-toggle is clicked, it will add/remove the active-main-content class
      document.getElementById("main-content").classList.toggle("active-main-content");
    });
  </script>
</body>
</html>
