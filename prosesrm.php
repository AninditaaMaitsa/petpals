<?php
include 'koneksi.php';

if(isset($_POST['aksi'])){
    if($_POST['aksi'] == "add"){        
        $norekam = $_POST['norekam'];
        $tgl_periksa = $_POST['tgl_periksa'];
        $namahewan = $_POST['namahewan'];
        $idhewan = $_POST['idhewan'];
        $berathwn = $_POST['berathwn'];
        $temperatur = $_POST['temperatur'];
        $tindakan = $_POST['tindakan'];
        $diagnosa = $_POST['diagnosa'];
        $hasil_periksa = $_POST['hasil_periksa'];
        $gejala = $_POST['gejala'];
        $foto = $_FILES['foto']['name'];

        $dir = "img/";
        $tmpFile = $_FILES['foto']['tmp_name'];

        move_uploaded_file($tmpFile, $dir.$foto);

        // Check if norekam already exists
        $checkQuery = "SELECT norekam FROM rekammedis WHERE norekam = ?";
        $stmt = mysqli_prepare($conn, $checkQuery);
        mysqli_stmt_bind_param($stmt, "s", $norekam);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if(mysqli_stmt_num_rows($stmt) > 0){
            echo "No Rekam Medis already exists. <a href='rekammedis.php'>Back</a>";
        } else {
            // Check if idhewan exists in pasien table
            $checkIdhewanQuery = "SELECT idhewan FROM pasien WHERE idhewan = ?";
            $stmt = mysqli_prepare($conn, $checkIdhewanQuery);
            mysqli_stmt_bind_param($stmt, "s", $idhewan);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            if(mysqli_stmt_num_rows($stmt) > 0){
                $query = "INSERT INTO rekammedis VALUES(null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, "sssssssssss", $norekam, $tgl_periksa, $namahewan, $idhewan, $berathwn, $temperatur, $tindakan, $diagnosa, $hasil_periksa, $gejala, $foto);
                $sql = mysqli_stmt_execute($stmt);

                if($sql){
                    header("location: rekammedis.php");
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            } else {
                echo "ID Hewan not found in Pasien table. <a href='rekammedis.php'>Back</a>";
            }
        }
    }
}

if(isset($_POST['aksi'])){
    if($_POST['aksi'] == "edit"){
        $no = $_POST['no'];
        $norekam = $_POST['norekam'];
        $tgl_periksa = $_POST['tgl_periksa'];
        $namahewan = $_POST['namahewan'];
        $idhewan = $_POST['idhewan'];
        $berathwn = $_POST['berathwn'];
        $temperatur = $_POST['temperatur'];
        $tindakan = $_POST['tindakan'];
        $diagnosa = $_POST['diagnosa'];
        $hasil_periksa = $_POST['hasil_periksa'];
        $gejala = $_POST['gejala'];
        
        $queryShow = "SELECT * FROM rekammedis WHERE no = ?";
        $stmt = mysqli_prepare($conn, $queryShow);
        mysqli_stmt_bind_param($stmt, "i", $no);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt)->fetch_assoc();

        if($_FILES['foto']['name'] == ""){
            $foto = $result['foto'];
        } else {
            $foto = $_FILES['foto']['name'];
            if(file_exists("img/".$result['foto'])){
                unlink("img/".$result['foto']);
            }
            move_uploaded_file($_FILES['foto']['tmp_name'], 'img/'.$_FILES['foto']['name']);
        }

        $query = "UPDATE rekammedis SET norekam = ?, tgl_periksa = ?, namahewan = ?, idhewan = ?, berathwn = ?, temperatur = ?, tindakan = ?, diagnosa = ?, hasil_periksa = ?, gejala = ?, foto = ? WHERE no = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssssssssssi", $norekam, $tgl_periksa, $namahewan, $idhewan, $berathwn, $temperatur, $tindakan, $diagnosa, $hasil_periksa, $gejala, $foto, $no);
        mysqli_stmt_execute($stmt);
        
        header("location: rekammedis.php");
    }
}

if(isset($_GET['hapus'])){
    $no = $_GET['hapus'];

    $queryShow = "SELECT * FROM rekammedis WHERE no = ?";
    $stmt = mysqli_prepare($conn, $queryShow);
    mysqli_stmt_bind_param($stmt, "i", $no);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt)->fetch_assoc();

    if(file_exists("img/".$result['foto'])){
        unlink("img/".$result['foto']);
    }

    $query = "DELETE FROM rekammedis WHERE no = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $no);
    mysqli_stmt_execute($stmt);

    if(mysqli_stmt_affected_rows($stmt) > 0){
        header("location: rekammedis.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
