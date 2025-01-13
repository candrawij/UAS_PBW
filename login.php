<?php
    session_start();
    if(isset($_SESSION['isLoggedIn']))
    {
     
        if($_SESSION['isLoggedIn'])
        {
            header("Location:home.php");
        }  
    }
   
?>

<!DOCTYPE html>
<html lang="en">
<head>

<head>
<head>
    <style>
        body {
            background-image: url('https://media.istockphoto.com/id/1019217092/id/foto/ruang-interior-perpustakaan-umum-yang-kabur-abstrak-ruang-buram-dengan-rak-buku-oleh-efek.jpg?s=612x612&w=0&k=20&c=CFByeoq4_Wr_WfgGCy5gZDc__-oNZytZm9uci18Mh_M=');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
    </style>
</head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<title>Document</title>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow p-4">
            <h3 class=" text-center mb-4"> login</h3>
                <form action="aksilogin.php" method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">Email=sample@gmail.com, pass=123</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
        </div>
    </div>
</body>
</html>