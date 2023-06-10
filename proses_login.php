<?php
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include 'conn.php';

// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = md5($_POST['password']);

// menyeleksi data user dengan username dan password yang sesuai
$masuk = "SELECT * FROM tbl_user WHERE username='$username' AND password='$password'";

$result = mysqli_query($koneksi, $masuk);

if (mysqli_num_rows($result) == 0) {
    header("location:index.php?error=4");
    exit;
} else {
    $data = mysqli_fetch_assoc($result);
    if ($data['username'] === $username && $data['password'] === $password) {
        if ($data['level'] == "admin") {
            // buat session login dan username
            $_SESSION['id'] = $data['id'];
            $_SESSION['namkar'] = $data['name'];
            $_SESSION['username'] = $username;
            $_SESSION['level'] = "admin";
            // alihkan ke halaman dashboard admin
            header("location:admin/index.php");
        } else if ($data['level'] == "karu") {
            // buat session login dan username
            $_SESSION['id'] = $data['id'];
            $_SESSION['namkar'] = $data['name'];
            $_SESSION['username'] = $username;
            $_SESSION['level'] = "karu";
            header("location:karu/index.php");
        } else if ($data['level'] == "karyawan") {
            // buat session login dan username
            $_SESSION['username'] = $username;
            $_SESSION['level'] = "karyawan";
            header("location:karyawan/index.php");
        }
    } else {
        header("location:index.php?error=1");
        exit;
    }
}
    

// // menghitung jumlah data yang ditemukan
// $cek = mysqli_num_rows($masuk);


// // cek apakah username dan password di temukan pada database
// if($cek > 0){
 
//     $data = mysqli_fetch_assoc($masuk);
 
//     // cek jika user login sebagai admin
//     if($data['level']=="admin"){
 
//         // buat session login dan username
//         $_SESSION['id'] = $data['id'];
//         $_SESSION['namkar'] = $data['name'];
//         $_SESSION['username'] = $username;
//         $_SESSION['level'] = "admin";
//         // alihkan ke halaman dashboard admin
//         header("location:admin/index.php");
//      } else if($data['level']=="karu"){
//         // buat session login dan username
//         $_SESSION['id'] = $data['id'];
//         $_SESSION['namkar'] = $data['name'];
//         $_SESSION['username'] = $username;
//         $_SESSION['level'] = "karu";
//         header("location:karu/index.php");
//     } else if($data['level']=="karyawan"){
//         // buat session login dan username
//         $_SESSION['username'] = $username;
//         $_SESSION['level'] = "karyawan";
//         header("location:karyawan/index.php");
//     }
// }else{
//     header("location:index.php?error=1");
//     exit;
// }
