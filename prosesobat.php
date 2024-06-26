<?php
    include 'koneksi.php';

    if(isset($_POST['aksi'])){
        if($_POST['aksi'] == "add"){
            
            $idobat = $_POST['idobat'];
            $namaobat = $_POST['namaobat'];
            $kategori = $_POST['kategori'];
            $jumlah = $_POST['jumlah'];
            $lokasi_penyimpanan = $_POST['lokasi_penyimpanan'];
            $harga = $_POST['harga'];
            $kadaluwarsa = $_POST['kadaluwarsa'];

            $query = "INSERT INTO obat VALUES(null, '$idobat', '$namaobat', '$kategori', '$jumlah', '$lokasi_penyimpanan', '$harga', '$kadaluwarsa')";
            $sql =  mysqli_query($conn, $query);

            if($sql){
                header("location: obat.php");
                //echo "Data Berhasil Ditambahkan <a href='index.php'>[Home]</a>";
            
                
            } else {
                echo $query;
            }

        } elseif ($_POST['aksi'] == "edit") {

            $idobat = $_POST['idobat'];
            $namaobat = $_POST['namaobat'];
            $kategori = $_POST['kategori'];
            $jumlah = $_POST['jumlah'];
            $lokasi_penyimpanan = $_POST['lokasi_penyimpanan'];
            $harga = $_POST['harga'];
            $kadaluwarsa = $_POST['kadaluwarsa'];
            
            $query = "UPDATE obat SET 
                        namaobat ='$namaobat',
                        kategori = '$kategori',
                        jumlah = '$jumlah',
                        lokasi_penyimpanan = '$lokasi_penyimpanan',
                        harga = '$harga',
                        kadaluwarsa = '$kadaluwarsa'
                      WHERE idobat = '$idobat';";
            $sql = mysqli_query($conn, $query);
            if($sql){
                header("location: obat.php");
            } else {
                echo $query;
            }
        }
    }

    if(isset($_GET['hapus'])){
        $idobat = $_GET['hapus'];
        $query = "DELETE FROM obat WHERE idobat = '$idobat';";
        $sql = mysqli_query($conn, $query);

        if($sql){
            header("location: obat.php");
        } else {
            echo $query;
        }
    } 
?>
