<?php

// session_start();

// if(!isset($_SESSION["login"])){
//     header("Location: login.php");
//     exit;
// }

// require 'config/functions.php';

// // Pilih template berdasarkan role
// $template = getTemplate();

// $teacher = query("SELECT id FROM teacher");
// $class = query("SELECT id FROM class");
// $students = query("SELECT id FROM students");
// $mapel = query("SELECT id FROM mapel");
// $p = query("SELECT * FROM profile_school")[0];


// $t = count($teacher);
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
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <title>sibuk</title>
</head>
<body>
    <main>
        <?php include($template); ?>
        <h1>Dashboard</h1>
        <section class="dashboard">
            <div class="main-section">
                <div class="item">
                    <div class="text">
                        <p>Rombel</p>
                        <h2><?= $c; ?></h2>
                        <span>Jumlah Rombel</span>
                    </div>
                    <i class='bx bx-buildings'></i>
                </div>

                <div class="item">
                    <div class="text">
                        <p>Siswa</p>
                        <h2><?= $s; ?></h2>
                        <span>Jumlah Siswa</span>
                    </div>
                    <i class='bx bx-user-circle'></i>
                </div>

                <div class="item">
                    <div class="text">
                        <p>Guru</p>
                        <h2><?= $t; ?></h2>
                        <span>Jumlah Guru</span>
                    </div>
                    <i class='bx bxs-graduation'></i>
                </div>

                <div class="item">
                    <div class="text">
                        <p>Mapel</p>
                        <h2><?= $m; ?></h2>
                        <span>Jumlah Mapel</span>
                    </div>
                    <i class='bx bxs-graduation'></i>
                </div>
            </div>
        </section>

        <section class="school">
            <fieldset>
                <legend>Keterangan Sekolah</legend>
                <ul>
                    <li>
                        <label for="">NPSN</label>
                        <p>: <?= $p["npsn"] ?? '-'; ?></p>
                    </li>
                    <li>
                        <label for="">Nama Sekolah</label>
                        <p>: <?= $p["school_name"] ?? '-'; ?></p>
                    </li>
                    <li>
                        <label for="">Jenjang Pendidikan</label>
                        <p>: <?= $p["education_level"] ?? '-'; ?></p>
                    </li>
                    <li>
                        <label for="">Status</label>
                        <p>: <?= $p["school_status"] ?? '-'; ?></p>
                    </li>
                    <li>
                        <label for="">Nama Kepala Sekolah</label>
                        <p>: <?= $p["principal_name"] ?? '-'; ?></p>
                    </li>
                </ul>
            </fieldset>
        </section>
    </main>

    <script src="js/main.js"></script>
</body>
</html>