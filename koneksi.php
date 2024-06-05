<?php
	include 'include_admin/js.php';
	include 'include/js.php';
	session_start();
	date_default_timezone_set('Asia/Jakarta');

	$server 	= "localhost";
	$user		= "root";
	$password	= "";
	$database	= "bacacuy";
	
	$koneksi = mysqli_connect($server,$user,$password) or die("Koneksi Server Gagal!");
	$db = mysqli_select_db($koneksi, $database) or die("Gagal Pilih Database!");

// ====================== FUNCTION ======================
function setAlert($title='', $text='', $type='', $buttons='') {
	$_SESSION["alert"]["title"]		= $title;
	$_SESSION["alert"]["text"] 		= $text;
	$_SESSION["alert"]["type"] 		= $type;
	$_SESSION["alert"]["buttons"]	= $buttons; 
}

if (isset($_SESSION['alert'])) {
	$title 		= $_SESSION["alert"]["title"];
	$text 		= $_SESSION["alert"]["text"];
	$type 		= $_SESSION["alert"]["type"];
	$buttons	= $_SESSION["alert"]["buttons"];

	echo"
		<div id='msg' data-title='".$title."' data-type='".$type."' data-text='".$text."' data-buttons='".$buttons."'></div>
		<script>
			let title 		= $('#msg').data('title');
			let type 		= $('#msg').data('type');
			let text 		= $('#msg').data('text');
			let buttons		= $('#msg').data('buttons');

			if(text != '' && type != '' && title != '') {
				Swal.fire({
					title: title,
					text: text,
					icon: type,
				});
			}
		</script>
	";
	unset($_SESSION["alert"]);
}

function checkLogin() {
	if (!isset($_SESSION['id_user'])) {
		setAlert("Akses ditolak!", "Login terlebih dahulu!", "error");
		header('Location: login.php');
	} 
}

function checkLoginAtLogin() {
	if (isset($_SESSION['id_user'])) {
		setAlert("Anda sudah login!", "Selamat Datang!", "success");
		header('Location: index.php');
	}
}
// DATA USER
function dataUser() {
	global $koneksi;
	if (isset($_SESSION['id_user'])) {
		$id_user = $_SESSION['id_user'];
		return mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id_user = '$id_user'"));
	} else {
		echo "
		  <script>
		    document.location.href='logout.php'
		  </script>
		";
	}
}
// DATA USER

function ubahProfile($data) {
	global $koneksi;
	$id_user = $_SESSION['id_user'];
	$username = htmlspecialchars($data['username']);
	$nama_lengkap = htmlspecialchars(addslashes($data['nama_lengkap']));
	$photo_lama = htmlspecialchars($data['photo_lama']);
	if ($_FILES['photo_profile']['error'] === 4) {
		$photo_profile = $photo_lama;
	}else{
		$photo_profile = upload();
	}
	mysqli_query($koneksi, "UPDATE tb_user SET username = '$username', nama_lengkap = '$nama_lengkap', photo_profile = '$photo_profile' WHERE id_user = '$id_user'");
	riwayat($id_user, "Berhasil mengubah profile");
	return mysqli_affected_rows($koneksi);
}

function upload() {
	$nama_photo 	= $_FILES['photo_profile']['name'];
	$ukuran_photo 	= $_FILES['photo_profile']['size'];
	$error			= $_FILES['photo_profile']['error'];
	$tmp_name		= $_FILES['photo_profile']['tmp_name'];

	// cek aoakah mengupload photo
	if ($error === 4) {
		setAlert('Gagal mengubah photo', 'Pilih photo terlebih dahulu!', 'error');
		return false;
	}

	// cek ekstensi photo
	$ekstensi_photo_valid 	= ['jpg', 'jpeg', 'png', 'gif'];
	$ekstensi_photo 	  	=  explode('.', $nama_photo);
	$ekstensi_photo 	  	=  strtolower(end($ekstensi_photo));
	if (!in_array($ekstensi_photo, $ekstensi_photo_valid)) {
		setAlert('Gagal mengubah photo', 'Pilih photo yang berekstensi gambar!', 'error');
		return false;
	}

	// cek ukuran photo
	if ($ukuran_photo > 1000000) {
		setAlert('Gagal mengubah photo', 'Ukuran photo terlalu besar!', 'error');
		return false;
	}

	// generate random nama
	$nama_photo_baru = uniqid();
	$nama_photo_baru .= '.';
	$nama_photo_baru .= $ekstensi_photo;

	move_uploaded_file($tmp_name, '../assets/img/img_profiles/' . $nama_photo_baru);
	return $nama_photo_baru;
}



function ubahPassword($data) {
	global $koneksi;
	$id_user = $_SESSION['id_user'];
	$password_lama = htmlspecialchars($data['password_lama']); 
	$password_baru = htmlspecialchars($data['password_baru']); 
	$verifikasi_password_baru = htmlspecialchars($data['verifikasi_password_baru']); 
	// cek password lama sesuai dengan password pada database
	$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id_user = '$id_user'"));
	if (password_verify($password_lama, $data['password'])) {
		// cek password baru dengan verifikasi password baru
		if ($password_baru == $verifikasi_password_baru) {
			$password_baru = password_hash($password_baru, PASSWORD_DEFAULT);
			mysqli_query($koneksi, "UPDATE tb_user SET password = '$password_baru' WHERE id_user = '$id_user'");
			riwayat($id_user, "Berhasil mengubah password");
			return mysqli_affected_rows($koneksi);
		} else {
			setAlert('Gagal mengubah password', 'Password baru tidak sesuai dengan verifikasi password baru!', 'error');
			header('Location: profile.php');
		}
	} else {
		setAlert('Gagal mengubah password', 'Password lama tidak sesuai!', 'error');
		header('Location: profile.php');
	}
}

function riwayat($id_user, $tindakan) {
	global $koneksi;
	$tanggal = time();
	mysqli_query($koneksi, "INSERT INTO tb_riwayat VALUES ('', '$id_user', '$tindakan', '$tanggal')");
	return mysqli_affected_rows($koneksi);
}

function ubahGenre($data) {
	global $koneksi;
	$id_genre = htmlspecialchars($data['id_genre']);
	$nama_genre = htmlspecialchars(addslashes(ucwords($data['nama_genre'])));
	mysqli_query($koneksi, "UPDATE tb_genre SET nama_genre = '$nama_genre' WHERE id_genre = '$id_genre'");
	riwayat($_SESSION['id_user'], "Berhasil mengubah genre buku $nama_genre");
	return mysqli_affected_rows($koneksi);
}

function tambahGenre($data) {
	global $koneksi;
	$nama_genre = htmlspecialchars(addslashes(ucwords($data['nama_genre'])));
	mysqli_query($koneksi, "INSERT INTO tb_genre VALUES('', '$nama_genre')");
	riwayat($_SESSION['id_user'], "Berhasil menambahkan genre buku $nama_genre");
	return mysqli_affected_rows($koneksi);
}

function hapusGenre($id) {
	global $koneksi;
	$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_genre WHERE id_genre = '$id'"));
	$nama_genre = ucwords($data['nama_genre']);
	mysqli_query($koneksi, "DELETE FROM tb_genre WHERE id_genre = '$id'");
	riwayat($_SESSION['id_user'], "Berhasil menghapus genre buku $nama_genre");
	return mysqli_affected_rows($koneksi);
}


// ...

function tambahBuku($data, $selectedGenres) {
    global $koneksi;
    $nama_buku = htmlspecialchars(addslashes($data['nama_buku']));
    $tahun_buku = htmlspecialchars($data['tahun_buku']);
    $penulis_buku = htmlspecialchars(addslashes(ucwords($data['penulis_buku'])));
    $cover_buku = uploadBuku();
    $rating_buku = htmlspecialchars($data['rating_buku']);
    $tanggal_diposting = time();
    $id_user = $_SESSION['id_user'];
	$sipnosis = htmlspecialchars($data['sipnosis']);
		    
	
	if ($rating_buku > 10) {
        return "Rating buku tidak boleh melebihi 10";
    }

    // Check if at least one genre is selected
    if (empty($selectedGenres)) {
        return false; // No genre selected
    }

    if (!$cover_buku) {
        return false;
    }

    // Insert into tb_buku table
    mysqli_query($koneksi, "INSERT INTO tb_buku VALUES ('', '$nama_buku', '$tahun_buku', '$penulis_buku', '$cover_buku', '$rating_buku', '$tanggal_diposting', '$id_user','$sipnosis')");
    
    // Get the ID of the inserted book
    $id_buku = mysqli_insert_id($koneksi);

    // Insert into tb_buku_genre table for each selected genre
    foreach ($selectedGenres as $id_genre) {
        mysqli_query($koneksi, "INSERT INTO tb_buku_genre VALUES ('$id_buku', '$id_genre')");
    }

    riwayat($id_user, "Berhasil menambahkan buku $nama_buku");
    return mysqli_affected_rows($koneksi);
}




function uploadBuku() {
	$nama_cover 	= $_FILES['cover_buku']['name'];
	$ukuran_cover 	= $_FILES['cover_buku']['size'];
	$error			= $_FILES['cover_buku']['error'];
	$tmp_name		= $_FILES['cover_buku']['tmp_name'];

	// cek aoakah mengupload cover
	if ($error === 4) {
		setAlert('Gagal mengubah cover', 'Pilih cover terlebih dahulu!', 'error');
		return false;
	}

	// cek ekstensi cover
	$ekstensi_cover_valid 	= ['jpg', 'jpeg', 'png', 'gif'];
	$ekstensi_cover 	  	=  explode('.', $nama_cover);
	$ekstensi_cover 	  	=  strtolower(end($ekstensi_cover));
	if (!in_array($ekstensi_cover, $ekstensi_cover_valid)) {
		setAlert('Gagal mengubah cover', 'Pilih cover yang berekstensi gambar!', 'error');
		return false;
	}

	// cek ukuran cover
	if ($ukuran_cover > 1000000) {
		setAlert('Gagal mengubah cover', 'Ukuran cover terlalu besar!', 'error');
		return false;
	}

	// generate random nama
	$nama_cover_baru = uniqid();
	$nama_cover_baru .= '.';
	$nama_cover_baru .= $ekstensi_cover;

	move_uploaded_file($tmp_name, '../assets/img/img_buku/' . $nama_cover_baru);
	return $nama_cover_baru;
}


function hapusBuku($id) {
    global $koneksi;

    try {
        // Nonaktifkan pengecekan foreign key constraint
        mysqli_query($koneksi, "SET FOREIGN_KEY_CHECKS = 0");

        // Ambil data buku berdasarkan id
        $query_buku = mysqli_query($koneksi, "SELECT * FROM tb_buku WHERE id_buku = '$id'");
        $data_buku = mysqli_fetch_assoc($query_buku);
        $nama_buku = ucwords($data_buku['nama_buku']);

        // Hapus data buku dari tb_buku
        mysqli_query($koneksi, "DELETE FROM tb_buku WHERE id_buku = '$id'");

        // Aktifkan kembali pengecekan foreign key constraint
        mysqli_query($koneksi, "SET FOREIGN_KEY_CHECKS = 1");

        // Catat riwayat penghapusan buku
        riwayat($_SESSION['id_user'], "Berhasil menghapus buku $nama_buku");

        // Mengembalikan jumlah baris yang terpengaruh oleh operasi penghapusan data
        return mysqli_affected_rows($koneksi);
    } catch (Exception $e) {
        // Jika terjadi kesalahan, aktifkan kembali pengecekan foreign key constraint
        mysqli_query($koneksi, "SET FOREIGN_KEY_CHECKS = 1");
        throw $e; // lemparkan kembali exception
    }
}



function ubahBuku($data, $selectedGenres) {
    global $koneksi;
    $id_buku = htmlspecialchars($data['id_buku']);
    $nama_buku = htmlspecialchars(addslashes(ucwords($data['nama_buku'])));
    $tahun_buku = htmlspecialchars($data['tahun_buku']);
    $penulis_buku = htmlspecialchars(addslashes(ucwords($data['penulis_buku'])));
    $rating_buku = htmlspecialchars($data['rating_buku']);
	
    $tanggal_diposting = time();
	$sipnosis = htmlspecialchars($data['sipnosis']);
    $id_user = $_SESSION['id_user'];
    $cover_buku_lama = htmlspecialchars($data['cover_buku_lama']);


	    
	if ($rating_buku > 10) {
        return "Rating buku tidak boleh melebihi 10";
    }
    // Check if a new cover has been uploaded
    if ($_FILES['cover_buku']['error'] === 0) {
        $cover_buku = uploadBuku();
    } else {
        $cover_buku = $cover_buku_lama;
    }

    // Update the book in the tb_buku table
    mysqli_query($koneksi, "UPDATE tb_buku SET nama_buku = '$nama_buku', tahun_buku = '$tahun_buku', penulis_buku = '$penulis_buku', cover_buku = '$cover_buku', rating_buku = '$rating_buku', tanggal_diposting = '$tanggal_diposting', id_user = '$id_user', sipnosis = '$sipnosis' WHERE id_buku = '$id_buku'");

    // Delete the existing records in the tb_buku_genre table for this book
    mysqli_query($koneksi, "DELETE FROM tb_buku_genre WHERE id_buku = '$id_buku'");

    // Insert the new records in the tb_buku_genre table for this book
    foreach ($selectedGenres as $id_genre) {
        mysqli_query($koneksi, "INSERT INTO tb_buku_genre VALUES ('$id_buku', '$id_genre')");
    }

    riwayat($id_user, "Berhasil mengubah buku $nama_buku");
    return mysqli_affected_rows($koneksi);
}

// Fungsi untuk mendapatkan genre yang telah dipilih sebelumnya untuk buku yang sedang diubah
function getSelectedGenres($id_buku) {
    global $koneksi;

    // Inisialisasi array untuk menyimpan ID genre yang telah dipilih sebelumnya
    $selectedGenres = array();

    // Query untuk mendapatkan ID genre yang telah dipilih sebelumnya untuk buku yang sedang diubah
    $query = "SELECT id_genre FROM tb_buku_genre WHERE id_buku = '$id_buku'";
    $result = mysqli_query($koneksi, $query);

    // Periksa apakah query berhasil dieksekusi
    if ($result) {
        // Loop melalui hasil query dan tambahkan ID genre ke dalam array $selectedGenres
        while ($row = mysqli_fetch_assoc($result)) {
            $selectedGenres[] = $row['id_genre'];
        }
    }

    // Kembalikan array $selectedGenres
    return $selectedGenres;
}




function hapusKomentar($id) {
	global $koneksi;
	$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_komentar WHERE id_komentar = '$id'"));
	$nama_komentar = ucwords($data['nama_komentar']);
	$isi_komentar = ucwords($data['isi_komentar']);
	mysqli_query($koneksi, "DELETE FROM tb_komentar WHERE id_komentar = '$id'");
	riwayat($_SESSION['id_user'], "Berhasil menghapus komentar $nama_komentar | $isi_komentar");
	return mysqli_affected_rows($koneksi);
}

function tambahKomentar($data) {
	global $koneksi;
	$nama_komentar = htmlspecialchars(addslashes($data['nama_komentar']));
	$isi_komentar = htmlspecialchars(addslashes($data['isi_komentar']));
	$tanggal_komentar = time();
	$id_buku = $data['id_buku'];
	mysqli_query($koneksi, "INSERT INTO tb_komentar VALUES ('', '$nama_komentar', '$isi_komentar', '$tanggal_komentar', '$id_buku')");
	return mysqli_affected_rows($koneksi);

}

// Include koneksi.php di sini





