<?php

session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require 'config/functions.php';

// // Pilih template berdasarkan role
$template = getTemplate();

$pasien = query("SELECT id_pasien FROM pasien");
// $class = query("SELECT id FROM class");
// $students = query("SELECT id FROM students");
// $mapel = query("SELECT id FROM mapel");
// $p = query("SELECT * FROM profile_school")[0];


$p = count($pasien);
// $c = count($class);
// $s = count($students);
// $m = count($mapel);

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
    <main>
        <?php include($template); ?>
        <h1>Dashboard</h1>
        <section class="dashboard">
            <div class="main-section">
                <div class="item">
                    <div class="text">
                        <p>Medical Check-Up</p>
                        <h2><?= $p; ?></h2>
                        <span>Jumlah Pasien</span>
                    </div>
                    <i class='bx bx-accessibility'></i>
                </div>

                <div class="item">
                    <div class="text">
                        <p>Medical Check-Up</p>
                        <h2><?= $p; ?></h2>
                        <span>Pemeriksaan</span>
                    </div>
                    <i class='bx bx-briefcase-alt-2'></i>
                </div>
            </div>
        </section>
    </main>
    <script src="js/main.js"></script>
</body>
</html>