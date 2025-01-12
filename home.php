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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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
                    <li class="nav-item me-3">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahModal">
                            <i class="fas fa-plus"></i> Tambah Data Buku
                        </button>
                    </li>
                    <li class="nav-item me-3">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahPenulisModal">
                            <i class="fas fa-plus"></i> Tambah Data Penulis
                        </button>
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
                        <th>Penulis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        $query = $koneksi->query("SELECT buku.*, penulis.id as id_penulis, penulis.nama_penulis FROM buku JOIN penulis ON buku.id_penulis = penulis.id WHERE isdel = 0");
                        while ($buku = $query->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $no; ?></td>
                        <td><?php echo htmlspecialchars($buku['judul']); ?></td>
                        <td><?php echo htmlspecialchars($buku['tahun']); ?></td>
                        <td><?php echo htmlspecialchars($buku['nama_penulis']); ?></td>
                        <td class="text-center">
                            <button class="btn btn-primary btn-sm edit-btn" data-id="<?php echo $buku['id']; ?>" data-judul="<?php echo htmlspecialchars($buku['judul']); ?>" data-tahun="<?php echo htmlspecialchars($buku['tahun']); ?>" data-nama_penulis="<?php echo htmlspecialchars($buku['nama_penulis']); ?>"><i class="fas fa-edit"></i> Edit</button>
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

        <div class="mt-5">
            <h3><i class="fas fa-pen"></i> Daftar Penulis</h3>
            <table class="table table-bordered">
                <thead class="table-dark text-center">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        $query = $koneksi->query("SELECT * FROM penulis");
                        while ($penulis = $query->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $no; ?></td>
                        <td><?php echo htmlspecialchars($penulis['nama_penulis']); ?></td>
                        <td class="text-center">
                            <button class="btn btn-primary btn-sm editPenulis-btn" data-nama="<?php echo htmlspecialchars($penulis['nama_penulis']); ?>"><i class="fas fa-edit"></i> Edit</button>
                            <button class="btn btn-danger btn-sm deletePenulis-btn" data-id="<?php echo $penulis['id']; ?>"><i class="fas fa-trash-alt"></i> Hapus</button>
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

    <!-- Modal Tambah Buku-->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah Data Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="tambahForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Buku</label>
                            <input type="text" class="form-control" id="judul" name="judul" required>
                        </div>
                        <div class="mb-3">
                            <label for="tahun" class="form-label">Tahun Terbit</label>
                            <input type="number" class="form-control" id="tahun" name="tahun" required>
                        </div>
                        <div class="mb-3">
                            <label for="penulis" class="form-label">Penulis</label>
                            <select class="form-control" id="id_penulis" name="id_penulis" required>
                            <?php
                            $penulisQuery = $koneksi->query("SELECT id, nama_penulis FROM penulis");
                            while ($penulis = $penulisQuery->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='{$penulis['id']}'>{$penulis['nama_penulis']}</option>";
                            }
                            ?>
                            </select>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Penulis-->
    <div class="modal fade" id="tambahPenulisModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah Data Penulis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="tambahPenulisForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Penulis</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Buku-->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editJudul" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="editJudul" name="judul" required>
                        </div>
                        <div class="mb-3">
                            <label for="editTahun" class="form-label">Tahun Terbit</label>
                            <input type="number" class="form-control" id="editTahun" name="tahun" required>
                        </div>
                        <div class="mb-3">
                            <label for="editPenulis" class="form-label">Penulis</label>
                            <select class="form-control" id="id_penulis" name="id_penulis" required>
                            <?php
                            $penulisQuery = $koneksi->query("SELECT id, nama_penulis FROM penulis");
                            while ($penulis = $penulisQuery->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='{$penulis['id']}'>{$penulis['nama_penulis']}</option>";
                            }
                            ?>
                            </select>
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

    <!-- Modal Edit Penulis-->
    <div class="modal fade" id="editPenulisModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data Penulis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editPenulisForm">
    <!-- Input Hidden untuk Nama Asli -->
    <input type="hidden" id="namaOri" name="namaOri">

    <div class="modal-body">
        <div class="mb-3">
            <label for="editNama" class="form-label">Nama Penulis</label>
            <input type="text" class="form-control" id="editNama" name="editNama" required>
        </div>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
    </div>
</form>

            </div>
        </div>
    </div>

    
    <!-- Modal Hapus Buku -->
    <div class="modal fade" id="hapusBukuModal" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus buku ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a id="confirmHapus" class="btn btn-danger" href="#">Hapus</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Hapus Penulis -->
    <div class="modal fade" id="hapusPenulisModal" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus penulis ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a id="confirmHapusBuku" class="btn btn-danger" href="#">Hapus</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Tambah Buku
            $('#tambahForm').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: 'input_buku.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        alert('Data berhasil ditambahkan!');
                        $('#tambahModal').modal('hide');
                        location.reload();
                    },
                    error: function () {
                        alert('Terjadi kesalahan saat menambahkan data.');
                    }
                });
            });

            // Tambah Penulis
            $('#tambahPenulisForm').on('submit', function (e) {
                e.preventDefault();
                
                $.ajax({
                    url: 'input_penulis.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        alert('Data berhasil ditambahkan!');
                        $('#tambahPenulisModal').modal('hide');
                        location.reload();
                    },
                    error: function () {
                        alert('Terjadi kesalahan saat menambahkan data.');
                    }
                });
            });

            // Edit Buku
            $('.edit-btn').click(function () {
                const id = $(this).data('id');
                const judul = $(this).data('judul');
                const tahun = $(this).data('tahun');
                const nama_penulis = $(this).data('nama_penulis');

                $('#editId').val(id);
                $('#editJudul').val(judul);
                $('#editTahun').val(tahun);
                $('#editPenulis').val(nama_penulis);

                $('#editModal').modal('show');
            });

            $('#editForm').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    url: 'edit_buku.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        alert('Data berhasil diperbarui!');
                        $('#editModal').modal('hide');
                        location.reload();
                    },
                    error: function () {
                        alert('Terjadi kesalahan saat memperbarui data.');
                    }
                });
            });
    
            // Edit Penulis
            $('.editPenulis-btn').click(function () {
                const namaOri = $(this).data('nama');  // Ambil nama asli penulis
                const namaEdit = namaOri;  // Nama yang akan diubah, dapat diubah nanti oleh pengguna

                $('#editNama').val(namaEdit);
                $('#namaOri').val(namaOri);

                    $('#editPenulisModal').modal('show');
            });


            $('#editPenulisForm').on('submit', function (e) {
                e.preventDefault();

                // Menggunakan serialize() untuk mengumpulkan data form
                const formData = $(this).serialize();

                $.ajax({
                    url: 'edit_penulis.php',
                    type: 'POST',
                    data: formData,  // Kirim data form
                    success: function (response) {
                        alert('Data berhasil diperbarui!');
                        $('#editPenulisModal').modal('hide');
                        location.reload();
                    },
                    error: function () {
                        alert('Terjadi kesalahan saat memperbarui data.');
                    }
                });
            });



            // Hapus Buku
            $('.delete-btn').click(function () {
                const deleteId = $(this).data('id');
                $('#confirmHapus').attr('href', `delete_buku.php?id=${deleteId}`);
                $('#hapusBukuModal').modal('show');
            });

            // Hapus Penulis
            $('.deletePenulis-btn').click(function () {
                const deleteId = $(this).data('id');
                $('#confirmHapusBuku').attr('href', `delete_penulis.php?id=${deleteId}`);
                $('#hapusPenulisModal').modal('show');
            });
        });
    </script>
</body>
</html>