<?php
    include "connection.php";
    session_start();
    
    if (!$_SESSION['isLoggedIn']) 
    {
        header("location: login.php");
    }

    $id = $_GET['id'];

    $dbh = $koneksi->prepare("SELECT * FROM buku WHERE id = ?");

    $dbh->execute([$id]);

    if($dbh->rowcount() == 1)
    {
        $data = $dbh->fetch(PDO::FETCH_ASSOC);
?>
    <form method="POST" action="aksiedit.php">
        Judul: <input name="judul" type="text" value="<?php echo $data['judul']?>"><br>
        Tahun Terbit: <input name="tahun" type="text" value="<?php echo $data['tahun']?>"><br>

        <input type="hidden" name="id" value="<?php echo $id?>">
        <button type="submit">Simpan</button>

    </form>
<?php
    }else
    {
        echo"<script>alert('Data tidak ditemukan')<?script";
        header("Location: home.php");
    }
    
?>


