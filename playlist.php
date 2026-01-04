<?php 
session_start();
require 'function.php';

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION["username"];

// --- LOGIKA PENCARIAN DI PLAYLIST ---
if(isset($_POST['tombol_search'])){
    $keyword = $_POST['keyword'];
    // Query khusus mencari di dalam playlist user saja
    $songs = query("SELECT playlist.id_playlist, music.nama, music.kategori, music.penyanyi, music.tahun, music.gambar 
                    FROM playlist 
                    JOIN music ON playlist.id = music.id 
                    WHERE playlist.username = '$username' AND 
                    (music.nama LIKE '%$keyword%' OR music.penyanyi LIKE '%$keyword%')");
} else {
    // Query default tampilkan semua isi playlist user
    $songs = query("SELECT playlist.id_playlist, music.nama, music.kategori, music.penyanyi, music.tahun, music.gambar 
                    FROM playlist 
                    JOIN music ON playlist.id = music.id 
                    WHERE playlist.username = '$username'");
}

// Catatan: Pagination sengaja saya hilangkan dulu agar tidak error, 
// karena biasanya playlist tidak sebanyak data master.
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Playlist - OurMusic</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

    <style>
        #bg-video {
            position: fixed;
            top: 0;
            left: 0;
            min-width: 100%;
            min-height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .content {
            position: relative;
            z-index: 1;
            color: white;
        }
        table {
            background-color: rgba(255,255,255,0.5)
        }
    </style>

<body class="class="fw-bold fs-4 text-black style="font-family: 'Poppins';">

    <video autoplay muted loop id="bg-video">
        <source src="vid/bg_vid.mp4" type="video/mp4">
    </video>

    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #6d3500ff;">
        <div class="container">
            <a class="navbar-brand text-white" href="#">OurMusic</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link text-white" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="p-3">
        <div class="container">
            <h1 class="fw-bold fs-2 text-black">My Playlist</h1>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="indexz.php" class="btn btn-warning btn-sm">Kembali</a>
                
                <form action="" method="POST" style="width: 300px;">
                    <div class="input-group">
                        <input type="text" class="form-control" name="keyword" placeholder="Cari di playlist..." autocomplete="off">
                        <button class="btn btn-warning" type="submit" name="tombol_search">Cari</button>
                    </div>
                </form>
            </div>

            <table  class="table table-bordered table-sm fs-6">
                <thead class="table-warning">
                    <tr>
                        <th>No.</th>
                        <th>Judul</th>
                        <th>Genre</th>
                        <th>Penyanyi</th>
                        <th>Tahun Rilis</th>
                        <th>Cover</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($songs)) : ?>
                        <tr>
                            <td colspan="7" class="text-center italic">Playlist kosong atau musik tidak ditemukan.</td>
                        </tr>
                    <?php else : ?>
                        <?php $no = 1; ?>
                        <?php foreach($songs as $data): ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $data['nama'] ?></td>
                            <td><?= $data['kategori'] ?></td>
                            <td><?= $data['penyanyi'] ?></td>
                            <td><?= $data['tahun'] ?></td>
                            <td> 
                                <img src="img/<?= $data['gambar'] ?>" height="70" width="70" class="rounded shadow-sm">
                            </td>
                            <td>
                                <a href="hapus_playlist.php?id=<?= $data['id_playlist'] ?>" onclick="return confirm('Yakin ingin menghapus?');">
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </a>
                            </td>
                        </tr>
                        <?php $no++; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>