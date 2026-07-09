<?php 
// 1. Selalu jalankan session di baris paling pertama
session_start();

// 2. Cek apakah user BELUM login
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: ../login.php");
    exit; // Menghentikan eksekusi skrip agar redirect berjalan sempurna
}

// 3. Cek apakah yang masuk BUKAN pelamar (misal panitia kesasar)
if ($_SESSION['peran'] !== 'pelamar') {
    echo "<script>
        alert('Anda tidak diijinkan mengakses halaman ini!');
        document.location.href = '../panitia/index.php';
        </script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Dashboard Pelamar</title>
</head>
<body>
    <h1>Dashboard Pelamar</h1>
    
    <?php 
    // Menampilkan nama user yang sedang login
    echo "<p>Selamat Datang <strong>" . htmlspecialchars($_SESSION['username']) . "</strong></p>";
    ?>
    
    <div class="container">
        <ul>
            <li><a href="index.php">Beranda</a></li>
            <li><a href="registrasi.php">Registrasi</a></li>
            <li><a href="dokumen.php">Dokumen</a></li>
            <li><a href="kelulusan.php">Kelulusan</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </div>
</body>
</html>