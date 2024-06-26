<?php
session_start(); // Mulai sesi (jika belum ada)

// Daftar pengguna yang valid (contoh)
$valid_users = [
    'admin' => 'password',
    'user1' => 'password123',
    // Tambahkan pengguna lain sesuai kebutuhan
];

// Proses login jika form login telah disubmit
if (isset($_POST['login'])) {
    // Ambil data yang di-post dari form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Periksa apakah username ada dalam daftar pengguna yang valid
    if (array_key_exists($username, $valid_users)) {
        // Periksa apakah password cocok
        if ($valid_users[$username] === $password) {
            // Login berhasil
            $_SESSION['username'] = $username; // Simpan username dalam sesi
            header('Location: index.php'); // Redirect ke halaman dashboard atau halaman setelah login
            exit;
        } else {
            // Password tidak cocok
            echo "<script>alert('Password salah. Silakan coba lagi.'); window.location='login.php';</script>";
            exit;
        }
    } else {
        // Username tidak ditemukan dalam daftar pengguna yang valid
        echo "<script>alert('Username tidak ditemukan. Silakan coba lagi.'); window.location='login.php';</script>";
        exit;
    }
} else {
    // Jika pengguna mencoba mengakses langsung file ini tanpa melalui form login, maka redirect ke halaman login
    header('Location: login.php');
    exit;
}
?>
