<?php
// Koneksi ke database
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'fifo';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die('Koneksi database gagal: ' . $conn->connect_error);
}

// Mengambil username dari permintaan POST
$username = $_POST['username'];

// Mengecek apakah username sudah digunakan
$query = "SELECT * FROM tbl_user WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // Username sudah digunakan
    $response = array('status' => 'error', 'message' => 'Username sudah digunakan');
} else {
    // Username tersedia
    $response = array('status' => 'success');
}

// Mengirim respons dalam format JSON
header('Content-Type: application/json');
echo json_encode($response);

$stmt->close();
$conn->close();



// Koneksi ke database
// $db_host = 'localhost';
// $db_user = 'root';
// $db_pass = '';
// $db_name = 'fifo';

// $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
// if ($conn->connect_error) {
// die('Koneksi database gagal: ' . $conn->connect_error);
// }

// // Mengambil username dari permintaan POST
// $username = $_POST['username'];

// Mengecek apakah username sudah digunakan
// $query = "SELECT * FROM tbl_user WHERE username = '$username'";
// $result = $conn->query($query);
// if ($result->num_rows > 0) {
// // Username sudah digunakan
// $response = array('status' => 'error', 'message' => 'Username sudah digunakan');
// } else {
// // Username tersedia
// $response = array('status' => 'success');
// }

// Mengirim respons dalam format JSON
// header('Content-Type: application/json');
// echo json_encode($response);

// $conn->close();