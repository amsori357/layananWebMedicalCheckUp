<?php 

require 'config/functions.php';

if(isset($_POST["submit"])){
    if(register($_POST) > 0 ){
        echo "<script> alert('Selamat anda berhasil mendaftar'); location.href= 'login.php'; </script>";
    }else {
        echo mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Register</title>
    <link rel="stylesheet" href="css/loginsystem.css">
</head>
<body>
    <div class="form-box">
        <h2>Register</h2>
        <form action="" method="POST">
            <div class="input-group">
                <label for="fullname">Nama Lengkap</label>
                <input type="text" name="fullname" placeholder="Masukkan nama lengkap" />
            </div>
            <div class="input-group">
                <label for="level">Level</label>
                <input type="text" name="level" placeholder="Contoh: 'admin', 'pasien', 'dokter'" />
            </div>
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="Masukkan username" />
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Masukkan password" />
            </div>

            <div class="input-group">
                <label for="confirm_password">Konfirmasi Password</label>
                <input type="password" name="confirm_password" placeholder="Masukkan password" />
            </div>
            <button type="submit" name="submit" class="btn">Daftar</button>
        </form>
        <div class="bottom-text">Sudah punya akun? <a href="login.php">Login di sini</a></div>
    </div>
</body>
</html>
