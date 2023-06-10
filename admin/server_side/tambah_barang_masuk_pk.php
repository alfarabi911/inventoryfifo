<?php 
require "../conn.php";
$id_masuk=$conn->real_escape_string($_POST['id_masuk']);
$sql=$conn->query("INSERT INTO barang_masuk VALUES('$id_masuk',NULL)");
if ($sql) {
    echo json_encode(array("status" => TRUE));
}
?>