<?php

session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require ('config/functions.php');

$template = getTemplate();

if(isset($_POST["submit"])){
    if(tambahpasien($_POST) > 0 ){
        echo "<script> alert('Pasien berhasil di tambahkan'); location.href = 'daftarpasien.php'; </script>";
    }else {
        echo "<script> alert('Pasien gagal di tambahkan'); location.href = 'daftarpasien.php'; </script>";
    }
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
        <h1>Tambah Pasien</h1>
        <section>
            <form action="" method="POST">
                <!-- Data Kelas -->
                <fieldset>
                    <legend>Data Pasien</legend>

                    <!-- <label for="id_pasien">ID Pasien</label> -->
                    <input type="hidden" name="id_pasien">

                    <label for="nama">Nama Lengkap</label>
                    <input type="text" name="nama"> 

                    <label for="tgl_lahir">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir"> 
                    
                    <label for="jk">Jenis Kelamin</label>
                    <select name="jk">
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="P">Perempuan</option>
                        <option value="L">Laki-Laki</option>
                    </select>

                    <label for="no_tlp">Nomor Telepon</label>
                    <input type="number" name="no_tlp">

                    <label for="alamat">Alamat Lengkap</label>
                    <input type="text" name="alamat">
                </fieldset>

                <button type="submit" name="submit">Tambah Pasien</button>
            </form>
        </section>
    </main>

    <script src="js/main.js"></script>
</body>
</html>