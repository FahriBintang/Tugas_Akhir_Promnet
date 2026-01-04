<?php 
session_start();
// Jika belum login ATAU role-nya bukan admin, lempar ke indexz.php (halaman user)
if( !isset($_SESSION["login"]) || $_SESSION["role"] !== 'admin' ) {
    header("Location: indexz.php");
    exit;
}
require "function.php";

    // $query = query("SELECT * FROM mahasiswa");
    // $mahasiswa = $query;

    // pagination
    // konfigurasi
    $jumlahDataPerHalaman = 5;
    $jumlahData = count(query("SELECT * FROM music"));
    $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
    $halamanAktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
    $awalData = ( $jumlahDataPerHalaman * $halamanAktif ) - $jumlahDataPerHalaman;

    $music = query("SELECT * FROM music LIMIT $awalData, $jumlahDataPerHalaman");
    if(isset($_POST['tombol_search'])){
        
        $music = search_data($_POST['keyword']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Data Music</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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

    <!-- NAVBAR SECTION START  -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #6d3500ff;">
        <div class="container">
            <li class="nav">
                <a class="nav-link text-white"></a>
            </li>
            <li class="nav">
                <a class="nav-link text-white"></a>
            </li>
            <a class="navbar-brand text-white" href="#">OurMusic</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="indexz.php">User Page</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link text-white" href="logout.php">Logout</a>
                    </li> -->
                </ul>
            </div>
        </div>

            <nav class="navbar navbar-expand-lg p-2">
            <div class="container"> <div class="d-flex justify-content-end">
            <div class="btn-group" >
            <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <?= $_SESSION['username'] ?>
            </button>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item text-dark" href="edit_profile.php">Edit Profile</a>
                </li>
                <li>
                    <a class="dropdown-item text-dark" href="logout.php">Logout</a>
                </li>
            </ul>
            </div>
                <li class="nav">
                    <a class="nav-link text-white"></a>
                </li>

                <li class="nav">
                    <a class="nav-link text-white"></a>
                </li>

            </div>
            </div>
    </nav>
    </nav>

    <!-- NAVBAR SECTION END  -->

    <!-- CONTENT SECTION START -->
    <section class="p-3">
        <div class="container">

    <h1 class="fw-bold fs-4 text-black" style="font-family: 'Poppins';">
        Hello Admin! Welcome to OurMusic
    </h1>

            <div class="d-flex justify-content-between align-items-center">
                <a href="tambah_data.php">
                    <button class=" btn-sm btn-warning">Tambah Data</button>
                </a>

            <nav aria-label="Page navigation example">
                    <ul class="pagination">
                            <!-- Tombol Previous -->
                        <?php if ($halamanAktif > 1) : ?>
                            <li class=" btn-sm btn-warning" class="page-item">
                                <a class="page-link" href="?halaman=<?= $halamanAktif - 1; ?>">&laquo;</a>
                            </li>
                        <?php endif; ?>


                        <!-- Daftar halaman -->
                        <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                            <?php if ($i == $halamanAktif) : ?>
                                <li class=" btn-sm btn-warning" class="page-item active">
                                    <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                                </li>
                            <?php else : ?>
                                <li class=" btn-sm btn-warning" class="page-item">
                                    <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                                </li>
                            <?php endif; ?>
                        <?php endfor; ?>


                        <!-- Tombol Next -->
                        <?php if ($halamanAktif < $jumlahHalaman) : ?>
                            <li class=" btn-sm btn-warning" class="page-item">
                                <a class="page-link" href="?halaman=<?= $halamanAktif + 1; ?>">&raquo;</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>

                <form class="mb-2" action="" method="POST">
                    <div class="input-group">
                        <input type="text" class="form-control" name="keyword" placeholder="Cari musik..." autocomplete="off">
                        <button class=" btn-sm btn-warning" type="submit" name="tombol_search">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>
                </form>
            </div>
            
            <table  class="table table-bordered table-sm fs-6 fw-bold">
                <tr>
                    <th>No.</th>
                    <th>Judul</th>
                    <th>Genre</th>
                    <th>Penyanyi</th>
                    <th>Tahun Rilis</th>
                    <th>Cover</th>
                    <th>Aksi</th>
                </tr>
                <?php $no=1 ?>
                <?php foreach($music as $data): ?>
                <tr>
                    <td> <?= $no ?> </td>
                    <td> <?= $data['nama'] ?> </td>
                    <td> <?= $data['kategori'] ?> </td>
                    <td> <?= $data['penyanyi'] ?> </td>
                    <td> <?= $data['tahun'] ?> </td>
                    <td> 
                        <img src="img/<?= $data['gambar'] ?> " height="70" width="70" alt="" class="rounded shadow-sm">
                    </td>

                    <td>
                        <a href="ubah_data.php?id=<?= $data['id'] ?>">
                            <button class="btn-sm btn-success">Edit</button>
                        </a>
                        
                        <a href="hapus_data.php?id=<?= $data['id'] ?>">
                            <button class="btn-sm btn-danger">Hapus</button>
                        </a>
                    </td>
                </tr>
                <?php $no++; ?>
                <?php endforeach; ?>
            </table>


        </div>
    </section>
    <!-- CONTENT SECTION END -->


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>