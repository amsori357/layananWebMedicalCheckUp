<?php

session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require 'config/functions.php';

if(isset($_GET["id_pasien"]) && is_numeric($_GET["id_pasien"])){
    $id = (int)$_GET["id_pasien"];
    if(hapuspasien($id) > 0 ){
        echo "<script> alert('Data berhasil dihapus'); location.href= 'daftarpasien.php'; </script>";
    }else {
        echo "<script> alert('Data gagal dihapus'); location.href= 'daftarpasien.php'; </script>";
    }
}else {
    header("Location: errorpage.php");
    exit;
}


?>