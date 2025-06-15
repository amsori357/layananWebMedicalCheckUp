<?php

require_once 'config/functions.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ambil username dari session (sesuai yang disimpan saat login)
$username = $_SESSION['username'] ?? '';

// Ambil data user
$userData = [];
if (!empty($username)) {
    // Gunakan prepared statement
    $stmt = $conn->prepare("SELECT fullname FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $userData = $result->fetch_assoc() ?? [];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/style.css">
    <title>Medical Check-Up</title>
</head>
<body>
    <aside>
        <div class="logo">
            <img src="img/sibuk.png" alt="">
            <a href="#">Check-Up <span>Sistem Medical Check-Up</span></a>
        </div>
         <nav>
            <ul>
                <li><a href="index.php"><span><i class='bx bxs-dashboard'></i></span>Dashboard</a></li>
                <li><a href="#" onclick="toggleMenu(event)"><span><i class='bx bx-dna'></i></span>Pemeriksaan<i class='bx bx-chevron-down' ></i></a>
                    <ul>
                        <li><a href="#">Jadwal Pemeriksaan</a></li>
                        <li><a href="#">Input Hasil Pemeriksaan</a></li>
                    </ul>
                </li>
                <li><a href="logout.php"><span><i class='bx bx-log-in-circle'></i></span>Logout</a></li>
            </ul>
        </nav>

        <div class="header">
            <div class="menu-toggle">
                <input type="checkbox">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <p style="text-transform: uppercase;">Hello <?= htmlspecialchars($userData['fullname'] ?? 'Pengguna') ?></p>
        </div>
    </aside>

    <script src="js/main.js"></script>
</body>
</html>