<?php
include_once '../config/db.php';

class PasienModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAll() {
        $result = $this->conn->query("SELECT * FROM pasien");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
