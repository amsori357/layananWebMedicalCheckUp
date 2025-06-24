<?php

session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require ('config/functions.php');

$template = getTemplate();

// Jumlah data per halaman
$jumlahDataPerHalaman = 5;

// Hitung total data kelas
$totalData = count(query("SELECT * FROM users"));

// Hitung total halaman
$totalHalaman = ceil($totalData / $jumlahDataPerHalaman);

// Ambil halaman aktif dari URL, default 1
$halamanAktif = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

// Tentukan data awal untuk query LIMIT
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$user = query("SELECT * FROM users");

if(isset($_POST["search"])){
    $pasien = search($_POST["keyword"]);
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
    <main>
        <?php include($template); ?>
        <h1>Data Pengguna</h1>
        <section>

            <div class="cont-table">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach($user as $p) : ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= htmlspecialchars($p["fullname"]); ?></td>
                            <td><?= htmlspecialchars($p["level"]); ?></td>
                            <td>
                                <ul>
                                    <li>
                                        <a href="hapuspengguna.php?id_user=<?= htmlspecialchars(urlencode($p["id_user"])); ?>" class="delete">Hapus</a>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="pagination-container">
                <?php if ($halamanAktif > 1): ?>
                    <a href="?page=<?= $halamanAktif - 1; ?>" class="pagination-arrow">&laquo;</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalHalaman; $i++): ?>
                    <a href="?page=<?= $i; ?>" 
                       class="pagination-link <?= ($i == $halamanAktif) ? 'active' : ''; ?>">
                       <?= $i; ?>
                    </a>
                <?php endfor; ?>

                <?php if ($halamanAktif < $totalHalaman): ?>
                    <a href="?page=<?= $halamanAktif + 1; ?>" class="pagination-arrow">&raquo;</a>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <script src="js/main.js"></script>
</body>
</html>