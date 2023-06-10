<?php 
require "../conn.php";
$kobar=$conn->real_escape_string($_POST['kobar']);
$nabar=$conn->real_escape_string($_POST['nabar']);
$jenis=$conn->real_escape_string($_POST['jenis']);
$rak=$conn->real_escape_string($_POST['rak']);
$sql=$conn->query("INSERT INTO barang VALUES ('$kobar','$nabar','$jenis','$rak') ");
if ($sql) {
    echo json_encode(array("status" => TRUE));
} else{
    echo json_encode(array("status" => FALSE));
}
