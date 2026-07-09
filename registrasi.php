<?php 
// 1. Set session
session_start();

// 2. Perbaikan path require fungsi.php (naik satu folder saja)
require "../fungsi.php";

// 3. Proteksi Halaman
if(!isset($_SESSION['login'])){
    header("location: ../login.php");
    exit;
} else if($_SESSION['login'] && $_SESSION['peran'] != 'pelamar'){
    echo "<script>
        alert('Anda tidak diijinkan mengakses halaman ini');
        document.location.href = '../panitia/index.php';
        </script>";
    exit;
}

// 4. Logika proses simpan data form registrasi (Pindahkan ke atas)
if(isset($_POST['registrasi'])){
    $hasil = registrasi($_POST);

    if($hasil > 0){
        echo "<script>
            alert('Registrasi Berhasil');
            document.location.href='dokumen.php';
        </script>";
        exit;
    } else {
        echo "<script>
            alert('Registrasi Gagal / Tidak ada perubahan data');
            document.location.href='registrasi.php';
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
    <title>Registrasi Siswa Baru</title>
</head>
<body>
    <h1>Formulir Pendaftaran Siswa Baru</h1>

    <?php 
    echo "Selamat Datang <strong>" . htmlspecialchars($_SESSION['username']) . "</strong>";
    ?>
    <div class="container">
        <ul>
            <li><a href="index.php">Beranda</a></li>
            <li><a href="#">Registrasi</a></li>
            <li><a href="dokumen.php">Dokumen</a></li>
            <li><a href="kelulusan.php">Kelulusan</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="container">
        <hr>
        <p>Silahkan isi biodata anda!!</p>
        
        <?php 
        $username = $_SESSION['username'];
        if(cekRegistrasi($username) == 0): 
        ?>
        
        <form action="" method="POST">
            <label for="namaDepan">Nama Depan</label>
            <input type="text" name="namaDepan" id="namaDepan" required>

            <label for="namaBelakang">Nama Belakang</label>
            <input type="text" name="namaBelakang" id="namaBelakang" required> <br><br>

            <label for="tempatLahir">Tempat Lahir</label>
            <input type="text" name="tempatLahir" id="tempatLahir" required> <br><br>

            <label for="tglLahir">Tanggal Lahir</label>
            <input type="date" name="tglLahir" id="tglLahir" required>

            <label for="jenisKelamin">Jenis Kelamin</label>
            <select name="jenisKelamin" id="jenisKelamin" required>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select><br>

            <label for="alamat">Alamat</label>
            <input type="text" name="alamat" id="alamat" required><br>

            <label for="sekolahAsal">Sekolah Asal</label>
            <input type="text" name="sekolahAsal" id="sekolahAsal" required><br><br>

            <label for="telepon">Telepon</label>
            <input type="text" name="telepon" id="telepon" required><br>

             <fieldset>
                <legend>Data Orang Tua</legend>

                <label for="namaAyah">Nama Ayah </label>
                <input type="text" name="namaAyah" id="namaAyah"> <br><br>

                <label for="pekerjaanAyah">Pekerjaan Ayah </label>
                <input type="text" name="pekerjaanAyah" id="pekerjaanAyah"> <br><br>

                <label for="penghasilanAyah">Penghasilan Ayah </label>
                <input type="number" name="penghasilanAyah" id="penghasilanAyah"><br><br>

                <label for="namaIbu">Nama Ibu </label>
                <input type="text" name="namaIbu" id="namaIbu"> <br><br>

                <label for="pekerjaanIbu">Pekerjaan Ibu </label>
                <input type="text" name="pekerjaanIbu" id="pekerjaanIbu"> <br><br>

                <label for="penghasilanIbu">Penghasilan Ibu </label>
                <input type="number" name="penghasilanIbu" id="penghasilanIbu"> <br><br>

            </fieldset>

            <input type="submit" name="registrasi" value="Registrasi">
        </form>
        
        <?php 
        else:
            echo "<p style='color: green; font-weight: bold;'>Anda sudah mengisi formulir registrasi.</p>";
        endif; 
        ?>
         
    </div>
</body>
</html>