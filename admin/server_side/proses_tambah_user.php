<?php 
require "../conn.php";
$nama=$conn->real_escape_string($_POST['nama']);
$user=$conn->real_escape_string($_POST['user']);
$pass=$conn->real_escape_string(md5($_POST['pass']));
$level=$conn->real_escape_string($_POST['level']);


    $sql2=$conn->query("INSERT INTO tbl_user VALUES('','$nama','$user','$pass','$level')");
        if ($sql2) {
            echo json_encode(array("status" => TRUE));
        } 
?>
