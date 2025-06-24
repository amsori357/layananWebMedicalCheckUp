<?php

session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require 'config/functions.php';

$template = getTemplate();

if(isset($_GET["id_pasien"]) && is_numeric($_GET["id_pasien"])){
    $id = (int)$_GET["id_pasien"];

    $p = query("SELECT * FROM pasien WHERE id_pasien = $id")[0];

}

if(isset($_POST["submit"])){
    if(editpasien($_POST, $id) > 0 ){
        echo "<script> alert('Data berhasil diubah'); location.href= 'daftarpasien.php'; </script>";
    }else {
        echo "<script> alert('Data gagal diubah'); location.href= 'daftarpasien.php'; </script>";
    }
}

?>

<!DOCTYPE html>s
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
        <h1>Edit Data Pasien</h1>
        <section>
            <form action="" method="POST">
                <!-- Data Kelas -->
                <fieldset>
                    <legend>Data Pasien</legend>

                    <input type="hidden" name="id_pasien">

                    <label for="nama">Nama Lengkap</label>
                    <input type="text" name="nama" value="<?= htmlspecialchars($p["nama"]); ?>"> 

                    <label for="tgl_lahir">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" value="<?= htmlspecialchars($p["tgl_lahir"]); ?>"> 
                    
                    <label for="jk">Jenis Kelamin</label>
                    <select name="jk">
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="P" <?= htmlspecialchars($p["jk"] == "P") ? "selected" : ""; ?>>Perempuan</option>
                        <option value="L" <?= htmlspecialchars($p["jk"] == "L") ? "selected" : ""; ?>>Laki-Laki</option>
                    </select>

                    <label for="no_tlp">Nomor Telepon</label>
                    <input type="number" name="no_tlp" value="<?= htmlspecialchars($p["no_tlp"]); ?>">

                    <label for="alamat">Alamat Lengkap</label>
                    <input type="text" name="alamat" value="<?= htmlspecialchars($p["alamat"]); ?>">

                    <label for="jadwal_pemeriksaan">Jadwal Pemeriksaan</label>
                    <input type="date" name="jadwal_pemeriksaan" value="<?= htmlspecialchars($p["jadwal_pemeriksaan"]); ?>">

                    <label for="status_pemeriksaan">Apakah sudah di periksan / belum</label>
                    <select name="status_pemeriksaan">
                        <option value="">-- sudah / belum --</option>
                        <option value="Sudah Diperiksa" <?= htmlspecialchars($p["status_pemeriksaan"] == "Sudah Diperiksa") ? "selected" : ""; ?>>Sudah Diperiksa</option>
                        <option value="Belum Diperiksa" <?= htmlspecialchars($p["status_pemeriksaan"] == "Belum Diperiksa") ? "selected" : ""; ?>>Belum Diperiksa</option>
                    </select>
                </fieldset>

                <button type="submit" name="submit">Edit Pasien</button>
            </form>
        </section>
    </main>

    <script src="js/main.js"></script>
</body>
</html>