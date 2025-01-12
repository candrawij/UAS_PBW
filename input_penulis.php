<?php
    include "connection.php";
    session_start();
    
    if (!$_SESSION['isLoggedIn']) 
    {
        header("location: login.php");
    }

    $nama = $_POST['nama'];

    $dbh = $koneksi->prepare("INSERT INTO penulis(nama_penulis) VALUES (?)");
    $dbh->execute([$nama]);

    header("Location: home.php");