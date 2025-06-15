<?php

$conn = new mysqli("localhost", "root", "", "checkup");
if($conn->connect_error){
    die('Connection failed') . $conn->connect_error;
}

function query($query){
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

// teacher

function tambahpasien($data){
    global $conn;

    $id = htmlspecialchars($data["id_pasien"]);
    $nama = htmlspecialchars($data["nama"]);
    $tgl = htmlspecialchars($data["tgl_lahir"]);
    $jk = htmlspecialchars($data["jk"]);
    $tlp = htmlspecialchars($data["no_tlp"]);
    $alamat = htmlspecialchars($data["alamat"]);

    $query = "INSERT INTO pasien VALUES ('$id', '$nama', '$tgl', '$jk', '$tlp', '$alamat')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function editpasien($data, $id){
    global $conn;

    $nama = htmlspecialchars($data["nama"]);
    $tgl = htmlspecialchars($data["tgl_lahir"]);
    $jk = htmlspecialchars($data["jk"]);
    $tlp = htmlspecialchars($data["no_tlp"]);
    $alamat = htmlspecialchars($data["alamat"]);

    $query = "UPDATE pasien SET nama = '$nama', tgl_lahir = '$tgl', jk = '$jk', no_tlp = '$tlp', alamat = '$alamat' WHERE id_pasien = $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function hapuspasien($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM pasien WHERE id_pasien = $id");
    return mysqli_affected_rows($conn);
}

function search($keyword) {
    $keyword = htmlspecialchars($keyword);
    $query = "SELECT * FROM pasien 
              WHERE nama LIKE '%$keyword%' 
              OR jk LIKE '%$keyword%' 
              OR no_tlp LIKE '%$keyword%' ";
    return query($query);
}

// login system

function register($data){
    global $conn;

    $fullname = strtolower(stripcslashes(htmlspecialchars($data["fullname"])));
    $level = strtolower(stripcslashes(htmlspecialchars($data["level"])));
    $username = strtolower(stripcslashes(htmlspecialchars($data["username"])));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $confirm_password = mysqli_real_escape_string($conn, $data["confirm_password"]);

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
    if(mysqli_fetch_assoc($result)){
        echo "<script> alert('Username telah digunakan, coba pakai username lain'); </script>";
        return false;
    }

    // cek konfirmasi password
    if($password != $confirm_password){
        echo "<script> alert('Konfirmasi Password tidak sesuai'); </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    // tambahkan ke database
    mysqli_query($conn, "INSERT INTO users VALUES ('', '$fullname', '$level', '$username', '$password')");

    return mysqli_affected_rows($conn);
}

function deleteuser($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM users WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function getTemplate() {
    if(!isset($_SESSION["level"])) {
        return 'theme.php'; // default
    }
    
    switch($_SESSION["level"]) {
        case 'admin': return 'theme.php';
        case 'dokter': return 'themedokter.php';
        case 'pasien': return 'themepasien.php';
        default: return 'theme.php';
    }
}