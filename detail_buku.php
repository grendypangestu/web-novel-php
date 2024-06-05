<?php 
require 'koneksi.php';

// Periksa apakah parameter 'nama_buku' ada di URL
if(isset($_GET['nama_buku'])) {
    // Mengambil nilai parameter 'nama_buku' dari URL
    $nama_buku = $_GET['nama_buku'];

    // Query untuk mendapatkan detail buku berdasarkan nama buku
    $query = "SELECT tb_buku.*, 
                    (SELECT GROUP_CONCAT(nama_genre SEPARATOR ', ') FROM tb_buku_genre 
                     INNER JOIN tb_genre ON tb_buku_genre.id_genre = tb_genre.id_genre 
                     WHERE tb_buku_genre.id_buku = tb_buku.id_buku) as nama_genre, 
                    tb_user.username
              FROM tb_buku
              INNER JOIN tb_user ON tb_buku.id_user = tb_user.id_user
              WHERE tb_buku.nama_buku = '" . mysqli_real_escape_string($koneksi, $nama_buku) . "'";

    $result = mysqli_query($koneksi, $query);

    // Periksa apakah query berhasil dieksekusi dan hasilnya ditemukan
    if ($result && mysqli_num_rows($result) > 0) {
        // Ambil detail buku dari hasil query
        $detail_buku = mysqli_fetch_assoc($result);
    } else {
        // Redirect ke halaman lain jika buku tidak ditemukan
        header("Location: halaman_tidak_ditemukan.php");
        exit; // Hentikan eksekusi skrip selanjutnya
    }
} else {
    // Redirect ke halaman lain jika parameter nama_buku tidak diberikan
    header("Location: halaman_tidak_ditemukan.php");
    exit; // Hentikan eksekusi skrip selanjutnya
}

// Query untuk mendapatkan komentar terkait buku
$komentar = mysqli_query($koneksi, "SELECT * FROM tb_komentar 
                                    INNER JOIN tb_buku ON tb_komentar.id_buku = tb_buku.id_buku 
                                    WHERE tb_komentar.id_buku = '" . mysqli_real_escape_string($koneksi, $detail_buku['id_buku']) . "' 
                                    ORDER BY tanggal_komentar DESC");

//Logika penambahan komentar
if (isset($_POST['btnTambahKomentar'])) {
    // Ambil data dari formulir
    $nama_komentar = $_POST['nama_komentar'];
    $isi_komentar = $_POST['isi_komentar'];

    // Query untuk menyimpan komentar ke database
    $insert_query = "INSERT INTO tb_komentar (id_buku, nama_komentar, isi_komentar, tanggal_komentar) 
                     VALUES ('" . mysqli_real_escape_string($koneksi, $detail_buku['id_buku']) . "', 
                             '" . mysqli_real_escape_string($koneksi, $nama_komentar) . "', 
                             '" . mysqli_real_escape_string($koneksi, $isi_komentar) . "', 
                             NOW())";

    // Eksekusi query penyimpanan komentar
    $insert_result = mysqli_query($koneksi, $insert_query);

    // Periksa apakah komentar berhasil disimpan
    if ($insert_result) {
        // Redirect kembali ke halaman detail buku setelah komentar berhasil disimpan
        header("Location: detail_buku.php?nama_buku=" . urlencode($nama_buku));
        exit;
    } else {
        // Tambahkan logika atau tindakan yang sesuai jika gagal menyimpan komentar
        // Misalnya, menampilkan pesan kesalahan atau mengarahkan pengguna ke halaman lain
        echo "Gagal menyimpan komentar.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
      <?php include 'include/css.php'; ?>
  <title><?= $detail_buku['nama_buku']; ?></title>
</head>

<body>
    <header class="col-12 bg-light p-2 d-flex justify-content-center">
        <!-- Sisipkan konten header di sini -->
    </header>
    <!-- Konten utama -->
    <main class="col-12 container mt-2">
        <!-- Tampilkan detail buku -->
        <div class="container row">
            <div class="col-12 col-md-3 col-lg-2p-2 align-items-center d-flex flex-column border">
                <img class="img-list-cover" src="assets/img/img_buku/<?= $detail_buku['cover_buku']; ?>" alt="<?= $detail_buku['cover_buku']; ?>" style="height: 200px; width: 150px;"style="height: 200px; width: 150px;">

            </div>
            <div class="col-lg-6 col-md-6  col-sm-12">
                <span class="fs-1 fw-bolder mb-2"><?= $detail_buku['nama_buku']; ?></span>
                <!-- Tampilkan informasi detail buku -->
                <div class="col-lg-10 col-md-10 col-sm-12 text-md-start text-sm-center mb-md-4">
                    <span class="fs-5"><?=$detail_buku['sipnosis'] ?></span>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-12">
                    <table class="table table-striped table-hover"> 
                        <tr>
                              <th scope="row">Genre</th>
                              <td>:</td>
                              <td><?= $detail_buku['nama_genre']; ?></td>
                            </tr>            
                            <tr>
                              <th scope="row">Tahun</th>
                              <td>:</td>
                              <td><?= $detail_buku['tahun_buku']; ?></td>
                            </tr>
                            <tr>
                              <th scope="row">Author</th>
                              <td>:</td>
                              <td><?= $detail_buku['penulis_buku']; ?></td>
                            </tr>
                            <tr>
                              <th scope="row">Tanggal Posting</th>
                              <td>:</td>
                              <td><?= date('d-m-Y, H:i:s', $detail_buku['tanggal_diposting']); ?></td>
                            </tr>
                            <tr>
                              <th scope="row">Rating</th>
                              <td>:</td>
                              <td><?= ucwords($detail_buku['rating_buku']); ?> / 10</td>
                            </tr>
                    </table>  
                    
                </div>


            </div>
            <!-- Sisipkan iklan atau konten lainnya di sini -->
               <div class="col-2 col-md-3 d-sm-none border d-md-flex align-items-center flex-column d-sm-flex ">
                <img src="assets/img/iklan/iklan.jpg" style="height: 500px; width: 270px;" alt="">

            </div>
        </div>
            <div class="row my-2">
      <div class="col-lg-6 my-2">
        <h3>Comments</h3>
        <form method="post">
          <input type="hidden" name="id_buku" value="<?= $id_buku; ?>">
          <div class="form-group">
            <label for="nama_komentar">Nama Komentar</label>
            <input type="text" name="nama_komentar" class="form-control" id="nama_komentar" required placeholder="Anonymous">
          </div>
          <div class="form-group">
            <label for="isi_komentar">Isi Komentar</label>
            <textarea name="isi_komentar" id="isi_komentar" class="form-control" name="isi_komentar" required placeholder="Something great"></textarea>
          </div>
          <div class="form-group">
            <button type="submit" name="btnTambahKomentar" class="btn btn-primary"><i class="fas fa-fw fa-paper-plane"></i> Send</button>
          </div>
        </form>
      </div>
      <div style="max-height: 275px; overflow-y: auto;" class="col-lg-6 my-2 text-dark">
        <?php foreach ($komentar as $dk): ?>
          <?php if ($komentar == NULL): ?>
            <h3 class="text-white">There are no comments yet</h3>
          <?php endif ?>
          <div class="card">
            <div class="card-body">
              <h5><?= $dk['nama_komentar']; ?></h5>
              <p class="card-text"><?= $dk['isi_komentar']; ?></p>
              <small class="text-muted float-right"><?= date("d-m-Y, H:i:s", $dk['tanggal_komentar']); ?></small>
            </div>
          </div>
        <?php endforeach ?>
      </div>
    </div>
    </main>
    <footer class="col-12 bg-light mt-5 p-5">
        <div
            class="container col-lg-5 col-sm-8 col-12 d-block align-items-center justify-content-center d-flex flex-column">
            <img src="assets/asset/logo-bacacuy.png" class="w-75 me-auto ms-auto d-flex" alt="">
            <span class="fs-7 text-center">Copyright &copy;BacaCuy.com -BacaCuy Situs baca Komik </span>
        </div>
    </footer>
</body>

</html>
