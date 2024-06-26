<?php
include 'koneksi.php';

if(isset($_POST['aksi'])){
    if($_POST['aksi'] == "add"){   
        $idhewan = $_POST['idhewan'];     
        $norekam = $_POST['norekam'];
        $tgl_pem= $_POST['tgl_pem'];
        $estimasi_tgl = $_POST['estimasi_tgl'];
        $tahap = $_POST['tahap'];
        $status = $_POST['status'];
        $tgl_tahapan = $_POST['tgl_tahapan'];
        $waktu_tahapan = $_POST['waktu_tahapan'];     
        $keterangan = $_POST['keterangan'];

        $query = "INSERT INTO tracking (idhewan, norekam, tgl_pem, estimasi_tgl, tahap, status, tgl_tahapan, waktu_tahapan, keterangan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssssssss", $idhewan, $norekam, $tgl_pem, $estimasi_tgl, $tahap, $status, $tgl_tahapan, $waktu_tahapan, $keterangan);
        mysqli_stmt_execute($stmt);

        if(mysqli_stmt_affected_rows($stmt) > 0){
            header("location: tracking.php");
            exit(); // Pastikan untuk keluar dari skrip setelah header
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

if(isset($_POST['aksi'])){
    if($_POST['aksi'] == "edit"){
        $idhewan = $_POST['idhewan'];     
        $norekam = $_POST['norekam'];
        $tgl_pem= $_POST['tgl_pem'];
        $estimasi_tgl = $_POST['estimasi_tgl'];
        $tahap = $_POST['tahap'];
        $status = $_POST['status'];
        $tgl_tahapan = $_POST['tgl_tahapan'];
        $waktu_tahapan = $_POST['waktu_tahapan'];
        $keterangan = $_POST['keterangan'];  

        $query = "UPDATE tracking SET idhewan= ?, norekam = ?, tgl_pem = ?, estimasi_tgl = ?, tahap = ?, status = ?, tgl_tahapan = ?, waktu_tahapan = ?, keterangan = ? WHERE no = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssssssssi", $idhewan, $norekam, $tgl_pem, $estimasi_tgl, $tahap, $status, $tgl_tahapan, $waktu_tahapan, $keterangan, $_POST['no']);
        mysqli_stmt_execute($stmt);

        if(mysqli_stmt_affected_rows($stmt) > 0){
            header("location: tracking.php");
            exit(); // Pastikan untuk keluar dari skrip setelah header
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

if(isset($_GET['hapus'])){
    $no = $_GET['hapus'];

    $query = "DELETE FROM tracking WHERE no = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $no);
    mysqli_stmt_execute($stmt);

    if(mysqli_stmt_affected_rows($stmt) > 0){
        header("location: tracking.php");
        exit(); // Pastikan untuk keluar dari skrip setelah header
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
