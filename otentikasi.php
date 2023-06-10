<?php
session_start();

// Set durasi sesi menjadi 1 jam
ini_set('session.cookie_lifetime', 3600);
ini_set('session.gc_maxlifetime', 3600);

// Menyambungkan ke database
$conn = mysqli_connect("localhost", "root", "", "fifo");

// Mengambil data dari form login dan melakukan validasi input
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$phash = md5($password);
if (empty($username) || empty($password)) {
    header("location:index.php?error=3");
    exit();
}

// Melakukan query ke database untuk mencari username yang sesuai
$query = "SELECT * FROM tbl_user WHERE username = '$username'";
$result = mysqli_query($conn, $query);

// Memeriksa apakah username ditemukan dalam database
if (mysqli_num_rows($result) == 1) {
    // Memeriksa apakah password yang dimasukkan sesuai dengan username yang ada di database
    $data = mysqli_fetch_assoc($result);
    if ($data['password'] == $phash) {
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
            $_SESSION['namkar'] = $data['name'];
            $_SESSION['level'] = "karyawan";
            header("location:karyawan/index.php");
        }
    } else {
        // Password tidak sesuai dengan username yang ada di database
        header("location:index.php?error=1");
    }
} else {
    // Username tidak ditemukan dalam database
    header("location:index.php?error=2");
}
