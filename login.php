<?php
// 1. Mulai session di baris paling pertama
session_start();

// 2. Proteksi halaman: jika sudah login, langsung lempar ke halaman masing-masing
if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    if (isset($_SESSION['peran'])) {
        if ($_SESSION['peran'] == 'pelamar') {
            header("Location: pelamar/index.php");
            exit;
        } else if ($_SESSION['peran'] == 'panitia') {
            header("Location: panitia/index.php");
            exit;
        }
    }
}

// 3. Panggil file fungsi
require "fungsi.php";

// 4. Proses logika autentikasi saat tombol login ditekan
if (isset($_POST['login'])) {
    $status_login = login($_POST);

    if ($status_login == 1) {
        $_SESSION['login'] = true;
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['peran'] = 'pelamar';
        
        echo "<script>
            alert('Login Berhasil!!!');
            document.location.href = 'pelamar/index.php';
        </script>";
        exit;

    } else if ($status_login == 2) {
        $_SESSION['login'] = true;
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['peran'] = 'panitia';
        
        echo "<script>
            alert('Login Berhasil!!!');
            document.location.href = 'panitia/index.php';
        </script>";
        exit;

    } else if ($status_login == -1) {
        echo "<script>
            alert('Username tidak terdaftar');
            document.location.href = 'login.php';
        </script>";
        exit;

    } else {
        echo "<script>
            alert('Password anda salah!!!');
            document.location.href = 'login.php';
        </script>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">

    <title>Login - PSB</title>
</head>
<body>
    <div class="container">
        <h1>Selamat Datang</h1>
        <h2>Halaman Login</h2>
    </div>

    <div class="container">
        <hr>
        <p>Silahkan masukkan username dan password!</p>
        <form action="" method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>

            <label for="password">Password: </label>
            <input type="password" name="password" id="password" required>

            <input type="submit" name="login" value="Login">
        </form>
    </div>
</body>
</html>