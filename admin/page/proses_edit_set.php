<?php 
include "../conn.php";
$id=$_POST['id'];
$namkar=$_POST['namkar'];
$user=$_POST['user'];
$npass=md5($_POST['nupass']);

$sql2=$conn->query("UPDATE tbl_user SET password='$npass' WHERE username ='$user'");
if ($sql2) {
    echo json_encode(array("status" => TRUE));
} 
?>
