<?php 
require "fungsi.php";

if (isset($_POST['buatakun'])) {
    // MENAMPUNG HASIL: Fungsi hanya berjalan 1 kali saja ke database!
    $hasil_daftar = buatAkun($_POST);

    if ($hasil_daftar > 0) {
        echo "<script>
        alert('Akun berhasil dibuat!!');
        document.location.href='login.php';
        </script>";
        exit;
    } else if ($hasil_daftar == -1) {
        echo "<script>
        alert('Error!!! username sudah terdaftar!!');
        </script>";
    } else {
        echo "<script>
        alert('Error!!! akun gagal dibuat!!');
        </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    
    <title>Penerimaan Siswa Baru</title>
</head>
<body>
    <div class="container">
        <h1>Selamat Datang</h1>
        <h2>Sistem Penerimaan Siswa Baru</h2>
        <h2>SMP Negeri 1 Pancasila</h2>
        <p>Sistem Informasi Penerimaan Siswa Baru tahun pelajaran 2026/2027 di SMP Negeri 1 Pancasila. Jika belum memiliki akun, silahkan buat akun terlebih dahulu</p>
    </div>

    <div class="container">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Buat Akun</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </div>

    <div class="container">
        <hr>
        <h2>Formulir Buat Akun</h2>
        <hr>
        <form action="" method="POST">            
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required><br>

            <label for="password">Kata Sandi</label>
            <input type="password" name="katasandi" id="password" required><br>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" required><br>

            <input type="submit" name="buatakun" value="Buat Akun">
        </form>
    </div>
</body>
</html>