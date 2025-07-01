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
$totalData = count(query("SELECT * FROM pasien"));

// Hitung total halaman
$totalHalaman = ceil($totalData / $jumlahDataPerHalaman);

// Ambil halaman aktif dari URL, default 1
$halamanAktif = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

// Tentukan data awal untuk query LIMIT
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$pasien = query("SELECT * FROM pasien");

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
        <h1>Data Pasien</h1>
        <section>
            <div class="addStudent">
                <a href="tambahpasien.php"><i class="bx bx-plus-circle"></i> Tambah Pasien</a>
                <div class="search">
                    <form action="" method="POST">
                        <input type="text" name="keyword" placeholder="Search . . .">
                        <button type="submit" name="search"><i class="bx bx-search-alt"></i></button>
                    </form>
                </div>
            </div>

            <div class="cont-table">
                <table>
                    <thead>
                        <tr>
                            <th>ID Pasien</th>
                            <th>Nama Lengkap</th>
                            <th>JK</th>
                            <th>Dokter</th>
                            <th>Poli</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($pasien as $p) : ?>
                        <tr>
                            <td><?= htmlspecialchars($p["id_pasien"]); ?></td>
                            <td><?= htmlspecialchars($p["nama"]); ?></td>
                            <td><?= htmlspecialchars($p["jk"]); ?></td>
                            <td><?= htmlspecialchars($p["dokter"]); ?></td>
                            <td><?= htmlspecialchars($p["poli"]); ?></td>
                            <td>
                                <ul>
                                    <li>
                                        <a href="print.php?id_pasien=<?= htmlspecialchars(urlencode($p["id_pasien"])); ?>">Cetak Laporan</a>
                                        <a href="lihatlaporan.php?id_pasien=<?= htmlspecialchars(urlencode($p["id_pasien"])); ?>" class="view">Lihat Laporan</a>
                                    </li>
                                </ul>
                            </td>
                        </tr>
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