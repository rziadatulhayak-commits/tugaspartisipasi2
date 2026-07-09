<?php 
//fungsi koneksi ke database
$host = "localhost";
$username = "root";
$password = "";
$dbname = "db_rina";

$koneksi = mysqli_connect($host, $username, $password, $dbname);

//fungsi membuat akun
function buatAkun($data){
    global $koneksi;
    $username = strtolower(stripslashes($data['username']));
    $password = mysqli_real_escape_string($koneksi, $data['katasandi']);
    $email = strtolower(stripslashes($data['email']));
    $peran = "pelamar";

    //cek apakah pengguna sudah ada akun/belum (duplikasi akun)
    $queryCekUser = "SELECT username FROM tbl_user WHERE username = '$username'";
    $hasilCek = mysqli_query($koneksi,$queryCekUser);

    //jika pengguna belum terdaftar
    if(mysqli_num_rows($hasilCek) != 0){
        return -1;
    }else{
    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    //masukkan data ke database
    $queryInsert = "INSERT INTO tbl_user (username, password, email, peran) VALUES ('$username', '$password', '$email', '$peran')";
    mysqli_query($koneksi, $queryInsert);
    $hasilBuatAkun = mysqli_affected_rows($koneksi);//0 atau 1
    
    return $hasilBuatAkun;
    }
    

}

//fungsi login
function login($akun){
    global $koneksi;
    $username = mysqli_real_escape_string($koneksi, $akun['username']);
    $password = mysqli_real_escape_string($koneksi, $akun['password']);

    //cek username 
    $cekLoginUser = "SELECT username, password, peran FROM tbl_user WHERE username = '$username'";
    $hasilCekLoginUser = mysqli_query($koneksi, $cekLoginUser);

    if(mysqli_num_rows($hasilCekLoginUser) != 1){ 
        return -1; //usernamenya salah
    }else{
        //cek password
        $cekPassword = mysqli_fetch_assoc($hasilCekLoginUser);  
        if(password_verify($password, $cekPassword['password'])){
            if($cekPassword['peran'] == 'pelamar'){
                return 1; //username dan password benar, peran pelamar
            }else{
                return 2;//username dan password benar, peran panitia
            }
        }else{
            return 0; //username benar, password salah
        }
    }
}


//fungsi cek registrasi
function cekRegistrasi($username){
    global $koneksi;

    //cek username sudah isi
    $queryCekRegistrasi = "SELECT username FROM tbl_registrasi WHERE username = '$username'";
    $hasilCekRegistrasi = mysqli_query($koneksi, $queryCekRegistrasi);

    if(mysqli_num_rows($hasilCekRegistrasi) != 0){
        return 1; //sudah registrasi
    }else{
        return 0; //belum registrasi
    }
}   

//fungsi registrasi
function registrasi($data){
    global $koneksi;

    $username = $_SESSION['username'];
    $namaDepan = mysqli_real_escape_string($koneksi, $data['namaDepan']);
    $namaBelakang = mysqli_real_escape_string($koneksi, $data['namaBelakang']);
    $tempatLahir = mysqli_real_escape_string($koneksi, $data['tempatLahir']);
    $tglLahir = $data['tglLahir'];
    $jenisKelamin = $data['jenisKelamin'];
    $alamat = mysqli_real_escape_string($koneksi, $data['alamat']);
    $sekolahAsal = mysqli_real_escape_string($koneksi, $data['sekolahAsal']); 
    $telepon = mysqli_real_escape_string($koneksi, $data['telepon']);

      $namaAyah = mysqli_real_escape_string($koneksi, $dtregistrasi['namaAyah']);
    $pekerjaanAyah = mysqli_real_escape_string($koneksi, $dtregistrasi['pekerjaanAyah']);
    $penghasilanAyah = mysqli_real_escape_string($koneksi, $dtregistrasi['penghasilanAyah']);
    $namaIbu = mysqli_real_escape_string($koneksi, $dtregistrasi['namaIbu']);
    $pekerjaanIbu = mysqli_real_escape_string($koneksi, $dtregistrasi['pekerjaanIbu']);
    $penghasilanIbu = mysqli_real_escape_string($koneksi, $dtregistrasi['penghasilanIbu']);
    $query = "INSERT INTO tbl_registrasi
    (username,namaDepan,namaBelakang,tempatLahir,tglLahir,jenisKelamin,alamat,sekolahAsal,telepon)
    VALUES
    ('$username','$namaDepan','$namaBelakang','$tempatLahir','$tglLahir','$jenisKelamin','$alamat','$sekolahAsal','$telepon')";

    mysqli_query($koneksi,$query);

    return mysqli_affected_rows($koneksi);
}