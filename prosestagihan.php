<?php
include 'koneksi.php';

if (isset($_POST['aksi'])) {
    $id_hewan = $_POST['idhewan'];
    $no_rm = $_POST['no_rm'];
    $nama_hewan = $_POST['nama_hewan'];
    $item = $_POST['item'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];
    $total = $_POST['total'];
    $tgl_transaksi = $_POST['tgl_transaksi'];
    $tgl_jatuhtempo = $_POST['tgl_jatuhtempo'];
    $status_pem = $_POST['status_pem'];

    if ($_POST['aksi'] == "add") {
        $query = "INSERT INTO tagihan (id_hewan, no_rm, nama_hewan, item, harga, jumlah, total, tgl_transaksi, tgl_jatuhtempo, status_pem) VALUES ('$id_hewan', '$no_rm', '$nama_hewan', '$item', '$harga', '$jumlah', '$total', '$tgl_transaksi', '$tgl_jatuhtempo', '$status_pem')";
        $sql = mysqli_query($conn, $query);

        if ($sql) {
            header("location: tagihan.php");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } elseif ($_POST['aksi'] == "edit") {
        $query = "UPDATE tagihan SET 
                    no_rm = '$no_rm',
                    nama_hewan = '$nama_hewan',
                    item = '$item',
                    harga = '$harga',
                    jumlah = '$jumlah',
                    total = '$total',
                    tgl_transaksi = '$tgl_transaksi',
                    tgl_jatuhtempo = '$tgl_jatuhtempo',
                    status_pem = '$status_pem'
                  WHERE id_hewan = '$id_hewan'";
        $sql = mysqli_query($conn, $query);

        if ($sql) {
            header("location: tagihan.php");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

if (isset($_GET['hapus'])) {
    $id_hewan = $_GET['hapus'];
    $query = "DELETE FROM tagihan WHERE id_hewan = '$id_hewan'";
    $sql = mysqli_query($conn, $query);

    if ($sql) {
        header("location: tagihan.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
