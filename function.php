<?php 

// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "ourmusic", 3307);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// fungsi untuk menampilkan data dari database
function query($query){
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

function get_user_by_id($username){
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    return mysqli_fetch_assoc($result);
}

function update_profile($data){
    global $conn;

    $username_lama = $data['username_lama']; 
    $username_baru = htmlspecialchars($data['username']);
    $email         = htmlspecialchars($data['email']);

    $query = "UPDATE user SET
                username = '$username_baru',
                email = '$email'
              WHERE username = '$username_lama'";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}



// fungsi untuk menambahkan data music
function tambah_data($data){
    global $conn;

    $nama = $data['nama'];
    $kategori = $data['kategori'];
    $penyanyi = $data['penyanyi'];
    $tahun = $data['tahun'];

// fungsi upload gambar
    $gambar = upload_gambar($nama, $penyanyi);
    if( !$gambar ) {
        return false;
    }

    $query = "INSERT INTO music (nama, kategori, penyanyi, tahun, gambar)
            VALUES ('$nama', '$kategori', '$penyanyi', '$tahun', '$gambar')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);    
}

// fungsi untuk menghapus music
function hapus_data($id){
    global $conn;

    $query = "DELETE FROM music WHERE id = $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);    
}

// fungsi untuk menghapus data playlist
function hapus_playlist($id){
    global $conn;

    $query = "DELETE FROM playlist WHERE id_playlist = $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);    
}


// fungsi untuk mengubah data music
function ubah_data($data){
    global $conn;

    $id = $data['id']; 
    $nama = htmlspecialchars($data['nama']);
    $kategori = htmlspecialchars($data['kategori']);
    $penyanyi = htmlspecialchars($data['penyanyi']);
    $tahun = htmlspecialchars($data['tahun']);
    $gambarLama = $data['gambarLama']; 

    // 4 berarti tidak ada file yang diupload
    if( $_FILES['gambar']['error'] === 4 ) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload_gambar($nama, $penyanyi);
    }

    // Query UPDATE
    $query = "UPDATE music SET
                nama = '$nama',
                kategori = '$kategori',
                penyanyi = '$penyanyi',
                tahun = '$tahun',
                gambar = '$gambar'
              WHERE id = $id";

    mysqli_query($conn, $query);
     
    return mysqli_affected_rows($conn); 
}

// fungsi untuk mencari data music
function search_data($keyword){
    $query = "SELECT * FROM music
			WHERE
			nama LIKE '%$keyword%' OR
			kategori LIKE '%$keyword%' OR
			penyanyi LIKE '%$keyword%' OR
			tahun LIKE '%$keyword%'";

	return query($query);
}

// fungsi untuk mencari data playlist
function search_playlist($keyword){
    $query = "SELECT * FROM playlist
			WHERE
			nama LIKE '%$keyword%' OR
			kategori LIKE '%$keyword%' OR
			penyanyi LIKE '%$keyword%' OR
			tahun LIKE '%$keyword%'";

	return query($query);
}


// fungsi upload gambar
function upload_gambar($nama, $penyanyi) {

    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if( $error === 4 ) {
        echo "<script>alert('Pilih gambar terlebih dahulu!');</script>";
        return false;
    }

    $ekstensiValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = strtolower(end(explode('.', $namaFile)));

    if( $ukuranFile > 2000000 ) {
        echo "<script>alert('Ukuran gambar terlalu besar!');</script>";
        return false;
    }

    $namaFileBaru = $nama . "_" . $penyanyi . "." . $ekstensiGambar;
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}


// fungsi register
function register($data_register) {
    global $conn;

    $username = strtolower(stripslashes($data_register['username']));
    $email = mysqli_real_escape_string($conn, $data_register['email']);
    $password = mysqli_real_escape_string($conn, $data_register['password']);
    $kode_admin = $data_register['kode_admin'];

// cek Username & email
    $cekUser = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if(mysqli_num_rows($cekUser) > 0) return "Username sudah terdaftar!";

    $cekEmail = mysqli_query($conn, "SELECT email FROM user WHERE email = '$email'");
    if(mysqli_num_rows($cekEmail) > 0) return "Email sudah terdaftar!";

    if (strlen($password) < 8) return "Password minimal 8 karakter!";

// penentuan role
    $role = 'user';
    if (!empty($kode_admin)) {
        if ($kode_admin === "psti12345") {
            $role = 'admin';
        } else {
            return "Kode Admin salah!";
        }
    }

    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO user (username, email, password, role) 
            VALUES('$username', '$email', '$password_hashed', '$role')";
    
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

// fungsi login
function login($data){
    global $conn;

    $username = mysqli_real_escape_string($conn, $data['username']);
    $password = $data['password'];

    // query user
    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);

        if(password_verify($password, $row['password'])) {

            // SET SESSION 
            $_SESSION['login'] = true;
            $_SESSION['id']    = $row['id'];
            $_SESSION['role']  = $row['role'];
            $_SESSION['username'] = $row['username'];

            return true;
        } else {
            return "Password salah!";
        }
    } else {
        return "Username tidak ditemukan!";
    }
}

//fungsi tambah data di playlist
function tambah_playlist($id, $username) {
    global $conn;
//cek apakah data sudah ada
    $cek = mysqli_query($conn, "SELECT * FROM playlist WHERE id = $id AND username = '$username'");
    
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Lagu sudah ada di playlist!');</script>";
        return false;
    }

    $query = "INSERT INTO playlist (id, username) VALUES ($id, '$username')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

?>