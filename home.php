<?php
    session_start();
    if (!isset($_SESSION['isLoggedIn']) || !$_SESSION['isLoggedIn']) {
        header("location: login.php");
        exit;
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="fas fa-home"></i> Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="input.php"><i class="fas fa-plus"></i> Tambah Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

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
                            <td><i class="fas fa-user"></i> Username</td>
                            <td><?php echo htmlspecialchars($_SESSION['username']); ?></td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-id-badge"></i> User ID</td>
                            <td><?php echo htmlspecialchars($_SESSION['userid']); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-5">
            <h3><i class="fas fa-book"></i> Daftar Buku</h3>
            <table class="table table-bordered">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Tahun Terbit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        $query = $koneksi->query("SELECT * FROM buku WHERE isdel = 0");
                        while ($buku = $query->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $no; ?></td>
                        <td><?php echo htmlspecialchars($buku['judul']); ?></td>
                        <td><?php echo htmlspecialchars($buku['tahun']); ?></td>
                        <td class="text-center">
                            <button class="btn btn-primary btn-sm edit-btn" data-id="<?php echo $buku['id']; ?>" data-judul="<?php echo htmlspecialchars($buku['judul']); ?>" data-tahun="<?php echo htmlspecialchars($buku['tahun']); ?>"><i class="fas fa-edit"></i> Edit</button>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="<?php echo $buku['id']; ?>"><i class="fas fa-trash-alt"></i> Hapus</button>
                        </td>
                    </tr>
                    <?php
                        $no++;
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" method="POST" action="aksiedit.php">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editJudul" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="editJudul" name="judul">
                        </div>
                        <div class="mb-3">
                            <label for="editTahun" class="form-label">Tahun Terbit</label>
                            <input type="text" class="form-control" id="editTahun" name="tahun">
                        </div>
                        <input type="hidden" id="editId" name="id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Link Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script>
        $(document).ready(function () {
            // Edit button click
            $('.edit-btn').click(function () {
                const id = $(this).data('id');
                const judul = $(this).data('judul');
                const tahun = $(this).data('tahun');

                $('#editId').val(id);
                $('#editJudul').val(judul);
                $('#editTahun').val(tahun);

                $('#editModal').modal('show');
            });

            // Delete button click
            $('.delete-btn').click(function () {
                const id = $(this).data('id');
                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    window.location.href = `delete.php?id=${id}`;
                }
            });
        });
    </script>
</body>
</html>
