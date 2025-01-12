<?php
    include "connection.php";
    session_start();

    if (!$_SESSION['isLoggedIn']) {
        header("location: login.php");
        exit();
    }

    $namaOri = $_POST['nama'];
    $namaEdit = $_POST['namaEdit'];

    // Debug: Check the values being used
    var_dump($namaOri, $namaEdit); 

    try {
        // Check the database connection
        if (!$koneksi) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Prepare and execute the UPDATE query
        $dbh = $koneksi->prepare("UPDATE penulis SET nama_penulis = ? WHERE nama_penulis = ?");
        $dbh->execute([$namaEdit, $namaOri]);

        // Check if any rows were updated
        if ($dbh->rowCount() > 0) {
            echo "Database updated successfully.";
        } else {
            echo "No rows updated. Check if 'namaOri' exists in the database.";
        }

        // Redirect after the update
        header("Location: home.php");
        exit();
        
    } catch (PDOException $e) {
        // Log the MySQL error to the browser console
        echo "<script>console.error('MySQL Error: " . $e->getMessage() . "');</script>";
    }
?>
