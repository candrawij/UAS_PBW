<?php
    include "connection.php";
    session_start();
    
    if (!$_SESSION['isLoggedIn']) 
    {
        header("location: login.php");
    }

    $id = $_POST['id'];
    $tahun = $_POST['tahun'];
    $judul = $_POST['judul'];
    $penulis = $_POST['id_penulis'];
    

    $dbh = $koneksi->prepare("UPDATE buku SET judul = ?, tahun = ?, id_penulis = ?, updated_by = ?, updated_at = ? WHERE id = ?");
    $dbh->execute(
        [
            $judul,
            $tahun,
            $penulis,
            $_SESSION['userid'],
            date("Y-m-d H:i:s"),
            $id
        ]
    );

    header("Location: home.php");
    exit();
?>