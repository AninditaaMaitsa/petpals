<!DOCTYPE html>
<?php 
include 'koneksi.php';

// untuk menampilkan semua data rekam medis
$query = "SELECT * FROM rekammedis;";
$sql = mysqli_query($conn, $query);
$no = 0;

// untuk cari data
// jika tombol cari diklik
if (isset($_POST['bcari'])) {
    // tampilkan data yang dicari
    $keyword = $_POST['tcari'];
    $q = "SELECT * FROM rekammedis WHERE idhewan LIKE '%$keyword%' OR namahewan LIKE '%$keyword%' OR norekam LIKE '%$keyword%' ORDER BY idhewan ASC";
} else {
    $q = "SELECT * FROM rekammedis ORDER BY idhewan ASC";
}

// Reset search
if (isset($_POST['breset'])) {
    $_POST['tcari'] = '';
    $q = "SELECT * FROM rekammedis ORDER BY idhewan ASC";
}

$sql = mysqli_query($conn, $q);
?>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Rekam Medis</title>
  <!-- bootstrap 5 css -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous"/>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="js/bootstrap.bundle.min.js"></script>
  <!-- Fontawesome -->
  <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <!-- Sambungkan file CSS -->
  <link rel="stylesheet" href="style.css">
  <!-- Sambungkan file JavaScript -->
  <script src="script.js"></script>
</head>
<body>
  <div>
    <div class="sidebar" id="sidebar">
      <h4 class="mb-5 text-white">Nama Klinik</h4>
      <li><a class="text-white" href="index.php"><i class="bi bi-house mr-2"></i> Dashboard</a></li>
      <li><a class="text-white" href="rekammedis.php"><i class="bi bi-grid-fill mr-2"></i>  Rekam Medis</a></li>
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
        <h1 class="mt-4"> Data Rekam Medis </h1>
        <blockquote class="blockquote"><p>Kucing Sehat Hanya Dalam Genggaman</p></blockquote>
        <figcaption class="blockquote-footer">Petpals <cite title="Source Title">Source Title</cite></figcaption>
      </figure>
      <a href="kelolarm.php" type="button" class="btn btn-primary mb-3">Tambah Data <i class="fa fa-plus"></i></a>
      <form method="POST" action="" class=" mb-3">
        <div class="input-group mb-3">
          <input type="text" name="tcari" id="tcari" value="<?php echo isset($_POST['tcari']) ? $_POST['tcari'] : ''; ?>" class="form-control" placeholder="Cari Data...">
          <button class="btn btn-primary" name="bcari" type="submit">Cari</button>
          <button class="btn btn-danger" name="breset" type="submit" id="reset-button">Reset</button>
        </div>
      </form>
    </div>

    <div class="container-fluid">
      <div class="table-responsive">
        <table class="table align-middle table-bordered table-hover">
          <thead>
            <tr>
              <th> No </th>
              <th> No Rekam Medis </th>
              <th> Tanggal Periksa </th>
              <th> Nama Hewan </th>
              <th> Id Hewan </th>
              <th> Berat Hewan </th>
              <th> Temperatur </th>
              <th> Tindakan </th>
              <th> Diagnosa </th>
              <th> Hasil Periksa </th>
              <th> Anamnesa </th>
              <th> Foto </th>
              <th> Aksi </th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($result = mysqli_fetch_assoc($sql)) {
            ?>
              <tr>
                <td><center><?php echo ++$no; ?></center></td>
                <td><center><?php echo $result['norekam']; ?></center></td>
                <td><center><?php echo $result['tgl_periksa']; ?></center></td>
                <td><center><?php echo $result['namahewan']; ?></center></td>
                <td><center><?php echo $result['idhewan']; ?></center></td>
                <td><center><?php echo $result['berathwn']; ?></center></td>
                <td><center><?php echo $result['temperatur']; ?></center></td>
                <td><center><?php echo $result['tindakan']; ?></center></td>
                <td><center><?php echo $result['diagnosa']; ?></center></td>
                <td><center><?php echo $result['hasil_periksa']; ?></center></td>
                <td><center><?php echo $result['gejala']; ?></center></td>
                <td><center><img src="img/<?php echo $result['foto']; ?>" style ="width:150px;"></center></td>
                <td>
                  <a href="prosesrm.php?hapus=<?php echo $result['idhewan']; ?>" name="hapus" type="button" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Ingin Menghapus Data Tersebut?')"> 
                    <i class="fa fa-trash"></i>
                  </a>
                  <a href="kelolarm.php?ubah=<?php echo $result['idhewan']; ?>" type="button" class="btn btn-success btn-sm"> 
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
    // event will be executed when the toggle-button is clicked
    document.getElementById("button-toggle").addEventListener("click", () => {
      // when the button-toggle is clicked, it will add/remove the active-sidebar class
      document.getElementById("sidebar").classList.toggle("active-sidebar");
      // when the button-toggle is clicked, it will add/remove the active-main-content class
      document.getElementById("main-content").classList.toggle("active-main-content");
    });

    // Clear search input when reset button is clicked
    document.getElementById("reset-button").addEventListener("click", () => {
      document.getElementById("tcari").value = '';
    });
  </script>
</body>
</html>
