<?php
    include 'koneksi.php';

    if(isset($_POST['aksi'])){
        if($_POST['aksi'] == "add"){
            
            $idhewan = $_POST['idhewan'];
            $namapem = $_POST['namapem'];
            $namahewan = $_POST['namahewan'];
            $jk = $_POST['jk'];
            $notelp = $_POST['notelp'];
            $alamat = $_POST['alamat'];
            $dokterhewan = $_POST['dokterhewan'];
            $tglpendaf = $_POST['tglpendaf'];
            $jenishwn = $_POST['jenishwn'];
            $berathwn = $_POST['berathwn'];
            $warnabulu = $_POST['warnabulu'];
            $umur = $_POST['umur'];
            $riwobat = $_POST['riwobat'];

            $query = "INSERT INTO pasien VALUES(null, '$idhewan', '$namapem', '$namahewan', '$jk', '$notelp', '$alamat', '$dokterhewan', '$tglpendaf', '$jenishwn', '$berathwn', '$warnabulu', '$umur', '$riwobat')";
            $sql =  mysqli_query($conn, $query);

            if($sql){
                header("location: pasien.php");
                //echo "Data Berhasil Ditambahkan <a href='index.php'>[Home]</a>";
            
                
            } else {
                echo $query;
            }

           // echo $namapem." | ".$namahew." | ".$jk." | ".$notelp." | ".$alamat." | ".$dokterhewan." | ".$tglpendaf." | ".$jenishwn." | ".$berathwn." | ".$namahew." | ".$warnabulu." | ".$umur." | ".$riwobat;
           // echo "<br> Tambah Data <a href='index.php'>[Home]</a> ";
        } elseif ($_POST['aksi'] == "edit") {
            //echo "Edit Data <a href='index.php'>[Home]</a> ";
            $idhewan = $_POST['idhewan'];
            $namapem = $_POST['namapem'];
            $namahewan = $_POST['namahewan'];
            $jk = $_POST['jk'];
            $notelp = $_POST['notelp'];
            $alamat = $_POST['alamat'];
            $dokterhewan = $_POST['dokterhewan'];
            $tglpendaf = $_POST['tglpendaf'];
            $jenishwn = $_POST['jenishwn'];
            $berathwn = $_POST['berathwn'];
            $warnabulu = $_POST['warnabulu'];
            $umur = $_POST['umur'];
            $riwobat = $_POST['riwobat'];
            
            $query = "UPDATE pasien SET idhewan='$idhewan',
                                        namapem ='$namapem',
                                        namahewan = '$namahewan',
                                        jk = '$jk',
                                        notelp = '$notelp',
                                        alamat = '$alamat',
                                        dokterhewan = '$dokterhewan',
                                        tglpendaf = '$tglpendaf',
                                        jenishwn = '$jenishwn',
                                        berathwn ='$berathwn',
                                        warnabulu = '$warnabulu',
                                        umur = '$umur',
                                        riwobat = '$riwobat' 
                WHERE idhewan = '$idhewan';";
                $sql = mysqli_query($conn, $query);
                    header("location: pasien.php");
                    //echo "Data Berhasil Ditambahkan <a href='index.php'>[Home]</a>";
                
        }
    }

    if(isset($_GET['hapus'])){
        $idhewan = $_GET['hapus'];
            $query = "DELETE FROM pasien WHERE idhewan = '$idhewan';";
            $sql = mysqli_query($conn, $query);

            if($sql){
                header("location: pasien.php");
                //echo "Data Berhasil Ditambahkan <a href='index.php'>[Home]</a>";
            } else {
                echo $query;
            }
            echo "Hapus Data <a href='pasien.php'>[Home]</a> ";
        } 
?>