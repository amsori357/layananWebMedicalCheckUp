<?php

session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require 'config/functions.php';

if(isset($_GET["id_user"]) && is_numeric($_GET["id_user"])){
    $id = (int)$_GET["id_user"];
    if(hapuspengguna($id) > 0 ){
        echo "<script> alert('Data berhasil dihapus'); location.href= 'pengguna.php'; </script>";
    }else {
        echo "<script> alert('Data gagal dihapus'); location.href= 'pengguna.php'; </script>";
    }
}else {
    header("Location: errorpage.php");
    exit;
}


?>