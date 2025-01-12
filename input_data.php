<?php
    include "connection.php";
    session_start();
    
    if (!$_SESSION['isLoggedIn']) 
    {
        header("location: login.php");
    }

    $judul = $_POST['judul'];
    $tahun = $_POST['tahun'];
    $id_penulis = $_POST['id_penulis'];

    $dbh = $koneksi->prepare("INSERT INTO buku(judul,tahun,id_penulis,created_by,created_at) VALUES (?,?,?,?,?)");
    $dbh->execute([$judul,$tahun,$id_penulis,$_SESSION['userid'],date("Y-m-d H:i:s")]);

    header("Location: home.php");