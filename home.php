<?php
    session_start();
    if (!$_SESSION['isLoggedIn']) 
    {
        header("location: login.php");
    }
    include "connection.php";
?>

    
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Selamat Datang</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>Informasi</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Username</td>
                            <td><?php echo htmlspecialchars($_SESSION['username']);?></td>
                        </tr>
                        <tr>
                            <td>User ID</td>
                            <td><?php echo htmlspecialchars($_SESSION['userid']);?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-center mt-3">
                    <a href="logout.php" class="btn btn-danger">Log Out</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Link Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
    $dbh = $koneksi->query("SELECT * FROM buku WHERE isdel = 0");
    $bukus = $dbh->fetch(PDO::FETCH_ASSOC);
?>

<a href="input.php">Tambah data</a>
<table border="1" >
    <tr>
        <th>No</th>
        <th>Judul</th>
        <th>Tahun Terbit</th>
        <th>Aksi</th>
    </tr>
    <?php
        $no = 1;
        while($bukus = $dbh->fetch(PDO::FETCH_ASSOC))
        {
    ?>
        <tr>
            <td><?php echo $no ?> </td>
            <td><?php echo $bukus['judul'] ?></td>
            <td><?php echo $bukus['tahun'] ?></td>
            <td><a href="edit.hp?id=1">Edit</a> | <a 
            href="delete.php?id=<?php echo $bukus['id']?>">Hapus</a></td>
        </tr>
    <?php
        $no++;
        }
    ?>

</table>