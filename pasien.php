<?php
include '../config/db.php';

function getAllPasien() {
    global $conn;
    $sql = "SELECT * FROM pasien";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}
?>
