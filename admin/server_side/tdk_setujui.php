<?php
require "../conn.php";
$id_keluar = $conn->real_escape_string($_POST['id_keluar']);
$kobar = $conn->real_escape_string($_POST['kobar']);
$sql2 = $conn->query("UPDATE detail_barang_keluar SET status='2' WHERE id_keluar ='$id_keluar'  AND kobar='$kobar'");

if ($sql2) {
    echo "YES";
} else {
    echo "NO";
}
