<?php
    include "connection.php";
    session_start();
    
    if (!$_SESSION['isLoggedIn']) 
    {
        header("location: login.php");
    }

    $id = $_GET['id'];

    $dbh = $koneksi->prepare("DELETE FROM penulis WHERE id = ?");
    $dbh->execute([$id]);

    header("Location: home.php");
    exit();
?>