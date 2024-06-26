<?php
session_start(); // Start session if not already started
include 'koneksi.php';

// Login process
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to fetch password for the given email
    $query = "SELECT email, password FROM login WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        $db_password = $row['password'];

        // Verify password
        if($password === $db_password){
            // Credentials correct, set session and redirect
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            header('Location: index.php');
            exit;
        } else {
            // Incorrect password, show error message
            echo '<script>alert("Password Salah");</script>';
        }
    } else {
        // Email not found
        echo '<script>alert("Email tidak ditemukan");</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-5">
            <img src="assets/images/login.jpg" alt="login" class="login-card-img">
          </div>
          <div class="col-md-7">
            <div class="card-body">
              <div class="brand-wrapper">
                <img src="assets/images/logo.svg" alt="logo" class="logo">
              </div>
              <p class="login-card-description">Sign into your account</p>
              <form method="post">
                <div class="form-group">
                  <label for="email" class="sr-only">Email</label>
                  <input type="email" name="email" id="email" class="form-control" placeholder="Email address" required>
                </div>
                <div class="form-group mb-4">
                  <label for="password" class="sr-only">Password</label>
                  <input type="password" name="password" id="password" class="form-control" placeholder="***********" required>
                </div>
                <button type="submit" name="login" class="btn btn-block login-btn">Login</button>
              </form>
              <nav class="login-card-footer-nav">
                <a href="#!">Demo username : abcdefg@gmail.com.</a>
                <a href="#!">Demo Password : 12345</a>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
