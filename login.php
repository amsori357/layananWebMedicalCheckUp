<?php
session_start();

if(isset($_SESSION["login"])) {
    switch($_SESSION["level"] ?? '') {
        case 'admin':
            header("Location: index.php");
            break;
        case 'dokter':
            header("Location: dashboarddokter.php");
            break;
        case 'pasien':
            header("Location: dashboardpasien.php");
            break;
        default:
            header("Location: index.php");
    }
    exit;
}

require 'config/functions.php';

if(isset($_POST["submit"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Ambil juga kolom role dari database
    $result = mysqli_query($conn, "SELECT username, password, level FROM users WHERE username = '$username'");

    // cek username
    if(mysqli_num_rows($result) === 1 ){
        
        // cek password
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row["password"])){
            // set session
            $_SESSION["login"] = true;
            $_SESSION["level"] = $row["level"]; // Simpan role user ke session
            $_SESSION["username"] = $row["username"]; // Simpan username jika diperlukan
            header("Location: index.php");

			switch($row["level"]) {
                case 'admin':
                    header("Location: index.php");
                    break;
                case 'dokter':
                    header("Location: dashboarddokter.php");
                    break;
                case 'pasien':
                    header("Location: dashboardpasien.php");
                    break;
                default:
                    header("Location: index.php");
            }
			
            exit;
        }
    }

    $error = true;
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" href="css/loginsystem.css">
    <title>Medical Check-Up</title>
</head>
<body>
	<div class="form-box">
	<h2>Login</h2>
	<?php if(isset($error)) : ?>
		<p>Username atau password yang anda masukan salah</p>
	<?php endif ?>
	<form action="" method="POST">
		<div class="input-group">
			<label for="username">Username</label>
			<input type="text" name="username" placeholder="Masukkan username" required />
		</div>
		<div class="input-group">
			<label for="password">Password</label>
			<input type="password" name="password" placeholder="Masukkan password" required />
		</div>
		<button type="submit" name="submit" class="btn">Masuk</button>
	</form>
	<div class="bottom-text">Belum punya akun? <a href="register.php">Daftar di sini</a></div>
</div>
</body>
</html>