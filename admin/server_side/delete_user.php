<?php
require_once "../conn.php";

if (isset($_POST['id'])) {
    $id = $conn->real_escape_string($_POST['id']);

    $sql = "DELETE FROM tbl_user WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("status" => true));
    } else {
        echo json_encode(array("status" => false, "message" => "Error: " . $conn->error));
    }
} else {
    echo json_encode(array("status" => false, "message" => "ID is not set"));
}

$conn->close();
