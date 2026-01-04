<?php 
session_start();
    if( !isset($_SESSION["login"]) ) {
        header("Location: login.php");
        exit;
    }

    require("function.php");

    $id = $_GET['id'];

    $query = query("SELECT * FROM music WHERE id = $id")[0];

    $music = $query;

    
    if(isset($_POST['tombol_submit'])){
        
        // jika query hapus data bernilai true (berhasil dihapus)s
        if(ubah_data($_POST) > 0){
            echo "
                <script>
                    alert('Data berhasil diubah di database!');
                    document.location.href = 'index.php';
                </script>
            ";
        }else{
            echo "
                <script>
                    alert('Data gagal diubah di database!');
                    document.location.href = 'index.php';
                </script>
            ";
        }

    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="class="fw-bold fs-4 text-black style="font-family: 'Poppins';">

    <!-- NAVBAR SECTION START  -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #6d3500ff;">
        <div class="container">
            <a class="navbar-brand text-white" href="#">OurMusic</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="indexz.php">Kategori Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- NAVBAR SECTION END  -->
   
<div class="p-4 container">
    <div class="row">
        <h1 class="mb-2">Ubah Data Music</h1>
        <a href="index.php" class="mb-2">Kembali</a>
        <div class="col-md-6">
            <form action="" method="POST" enctype="multipart/form-data">
                
                <input type="hidden" name="id" value="<?= $music['id'] ?>">
                
                <input type="hidden" name="gambarLama" value="<?= $music['gambar'] ?>">
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Judul</label>
                    <input type="text" class="form-control" name="nama" id="nama" value="<?= $music['nama'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Genre</label>
                    <input type="text" class="form-control" name="kategori" id="kategori" value="<?= $music['kategori'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Penyanyi</label>
                    <input type="text" class="form-control" name="penyanyi" id="penyanyi" value="<?= $music['penyanyi'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Tahun Rilis</label>
                    <input type="text" class="form-control" name="tahun" id="tahun" value="<?= $music['tahun'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Gambar Cover</label> <br>
                    <img src="img/<?= $music['gambar']; ?>" width="100" class="mb-2 shadow-sm rounded">
                    <input type="file" class="form-control" name="gambar" id="gambar">
                    <small class="text-muted">Pilih file baru jika ingin mengubah gambar.</small>
                </div>

                <div class="mb-3">
                    <button type="submit" name="tombol_submit" class="btn btn-warning">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>