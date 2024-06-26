<?php
include 'koneksi.php';

if (isset($_POST['idhewan'])) {
    $idhewan = $_POST['idhewan'];

    $query = "SELECT namahewan, berathwn FROM pasien WHERE idhewan = '$idhewan'";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $response = array(
            'status' => 1,
            'data' => array(
                'namahewan' => $row['namahewan'],
                'berathwn' => $row['berathwn']
            )
        );
    } else {
        $response = array(
            'status' => 0
        );
    }

    echo json_encode($response);
}
?>
