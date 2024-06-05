<?php
  require '../koneksi.php';
  checkLogin();

  $buku = mysqli_query($koneksi, "SELECT  tb_buku.*, (SELECT GROUP_CONCAT(nama_genre SEPARATOR ', ') FROM tb_buku_genre INNER JOIN tb_genre ON tb_buku_genre.id_genre = tb_genre.id_genre WHERE tb_buku_genre.id_buku = tb_buku.id_buku) as nama_genre, tb_user.username
                                  FROM tb_buku
                                  INNER JOIN tb_user ON tb_buku.id_user = tb_user.id_user
                                  ORDER BY tb_buku.nama_buku ASC");

  $genre = mysqli_query($koneksi, "SELECT * FROM tb_genre ORDER BY nama_genre ASC");

  // Inisialisasi $selectedGenres
  $selectedGenres = array();

  // jika tombol ubah buku ditekan
  if (isset($_POST['btnUbahBuku'])) {
    // Dapatkan nilai $selectedGenres dari data buku yang sedang diubah
    $id_buku = $_POST['id_buku'];
    $selectedGenres = getSelectedGenres($id_buku); // Fungsi getSelectedGenres() harus Anda definisikan

    if (ubahBuku($_POST, $selectedGenres) > 0) {
      setAlert("Berhasil diubah", "Buku berhasil diubah", "success");
      header("Location: buku.php");
    }
  }

  // jika tombol tambah buku ditekan
  if (isset($_POST['btnTambahBuku'])) {
    $selectedGenres = isset($_POST['id_genre']) ? $_POST['id_genre'] : array();

    // Panggil fungsi tambahBuku dengan data buku dan genre
    if (tambahBuku($_POST, $selectedGenres) > 0) {
        $nama_buku = htmlspecialchars(addslashes(ucwords($_POST['nama_buku'])));
        setAlert("Berhasil ditambahkan", "Buku $nama_buku berhasil ditambahkan", "success");
        header("Location: buku.php");
        exit();
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
  <?php include '../include_admin/css.php'; ?>
  <title>Daftar Buku</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  
  <?php include '../include_admin/navbar.php'; ?>

  <?php include '../include_admin/sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm">
            <h1 class="m-0 text-dark">Daftar Buku</h1>
          </div><!-- /.col -->
          <div class="col-sm text-right">
            <button type="button" data-toggle="modal" data-target="#tambahBukuModal" class="btn btn-primary"><i class="fas fa-fw fa-plus"></i> Tambah Buku</button>
            <!-- Modal -->
            <div class="modal fade text-left" id="tambahBukuModal" tabindex="-1" role="dialog" aria-labelledby="tambahBukuModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <form method="post" enctype="multipart/form-data">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="tambahBukuModalLabel">Tambah Buku</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group text-center">
                        <a href="../assets/img/img_buku/default.png" class="enlarge" id="check_enlarge_photo">
                          <img src="../assets/img/img_buku/default.png" class="img-profile rounded" id="check_photo" alt="cover buku">
                        </a>
                        <div class="form-group">
                          <label for="photo">Cover Buku</label>
                          <input type="file" name="cover_buku" id="photo" class="btn btn-sm btn-primary form-control form-control-file" accept="image/*">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="nama_buku">Nama Buku</label>
                        <input type="text" name="nama_buku" required class="form-control" id="nama_buku">
                      </div>
                        <div class="form-group">
                        <label for="sipnosis">Sipnosis</label>
                        <textarea name="sipnosis" required class="form-control" id="sipnosis" cols="30" rows="10"></textarea>
                        
                      </div>
                      <div class="form-group">
                        <label for="tahun_buku">Tahun Buku</label>
                        <input type="number" name="tahun_buku" required class="form-control" id="tahun_buku">
                      </div>
                      <div class="form-group">
                        <label for="penulis_buku">Penulis buku</label>
                        <input type="text" name="penulis_buku" required class="form-control" id="penulis_buku">
                      </div>
                      <div class="form-group">
    <label for="rating_buku">Rating Buku (Maksimal 10)</label>
    <input type="number" step="0.01" name="rating_buku" required class="form-control" id="rating_buku" max="10" oninput="validateRating(this)">
    <span id="ratingError" style="color: red;"></span>
</div>

<script>
    function validateRating(input) {
        var rating = parseFloat(input.value);
        var maxRating = 10;

        if (rating > maxRating) {
            document.getElementById("ratingError").textContent = "Rating buku tidak boleh melebihi " + maxRating;
            input.value = maxRating; // Reset nilai input menjadi 10
        } else {
            document.getElementById("ratingError").textContent = ""; // Reset pesan error jika nilai valid
        }
    }
</script>

               <div class="form-group">
    <label for="id_genre">Genre:</label><br>
    <?php foreach ($genre as $dg): ?>
        <div class="form-check">
            <input type="checkbox" name="id_genre[]" id="genre<?= $dg['id_genre']; ?>" value="<?= $dg['id_genre']; ?>" class="form-check-input">
            <label class="form-check-label" for="genre<?= $dg['id_genre']; ?>"><?= ucwords($dg['nama_genre']); ?></label>
        </div>
    <?php endforeach ?>
</div>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                      <button type="submit" name="btnTambahBuku" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Simpan</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg">
            <div class="table-responsive">
              <table class="table table-bordered table-hover table-striped" id="table_id">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Cover Buku</th>
                    <th>Nama Buku</th>
                    <th>Tahun Buku</th>
                    <th>Penulis Buku</th>
                    <th>Rating Buku</th>
                    <th>Genre</th>
                    <th>Tanggal Diposting</th>
                    <th>Pemosting</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; ?>
                  <?php foreach ($buku as $df): ?>
         
                    <tr>
                      <td><?= $i++; ?></td>
                      <td>
                        <a href="../assets/img/img_buku/<?= $df['cover_buku']; ?>" class="enlarge">
                          <img class="img-list-cover" src="../assets/img/img_buku/<?= $df['cover_buku']; ?>" alt="<?= $df['cover_buku']; ?>">
                        </a>
                      </td>
                      <td><?= $df['nama_buku']; ?></td>
                      <td><?= $df['tahun_buku']; ?></td>
                      <td><?= $df['penulis_buku']; ?></td>
                      <td><?= ucwords($df['rating_buku']); ?></td>
                      <td><?= ucwords($df['nama_genre']); ?></td>
                      <td><?= date('d-m-Y, H:i:s', $df['tanggal_diposting']); ?></td>
                         <td><?= isset($df['username']) ? $df['username'] : ''; ?></td>
                      <td>
                        <button class="btn btn-sm m-1 text-center mx-auto btn-success" type="button" data-toggle="modal" data-target="#ubahBukuModal<?= $df['id_buku']; ?>"><i class="fas fa-fw fa-edit"></i> Ubah</button>
                        <!-- Modal -->
                        <div class="modal fade" id="ubahBukuModal<?= $df['id_buku']; ?>" tabindex="-1" role="dialog" aria-labelledby="ubahBukuModalLabel<?= $df['id_buku']; ?>" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <form method="post" enctype="multipart/form-data">
                              <input type="hidden" name="id_buku" value="<?= $df['id_buku']; ?>">
                              <input type="hidden" name="cover_buku_lama" value="<?= $df['cover_buku']; ?>">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="tambahBukuModalLabel">Ubah buku</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="form-group text-center">
                                    <a href="../assets/img/img_buku/<?= $df['cover_buku']; ?>" class="enlarge check_enlarge_photo">
                                      <img src="../assets/img/img_buku/<?= $df['cover_buku']; ?>" class="img-profile rounded check_photo" alt="cover buku">
                                    </a>
                                    <div class="form-group">
                                      <label for="cover_buku<?= $df['id_buku']; ?>">Cover Buku</label>
                                      <input type="file" name="cover_buku" id="cover_buku<?= $df['id_buku']; ?>" class="photo btn btn-sm btn-primary form-control form-control-file" accept="image/*">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="nama_buku<?= $df['id_buku']; ?>">Nama Buku</label>
                                    <input type="text" name="nama_buku" value="<?= $df['nama_buku']; ?>" required class="form-control" id="nama_buku<?= $df['id_buku']; ?>">
                                  </div>
                                  <div class="form-group">
                        <label for="sipnosis">Sipnosis</label>
                        <textarea name="sipnosis" value="<?= $df['sipnosis']; ?>" required class="form-control" id="sipnosis<?= $df['id_buku']; ?>" cols="30" rows="10" ></textarea>
                        
                      </div>
                                  <div class="form-group">
                                    <label for="tahun_buku<?= $df['id_buku']; ?>">Tahun Buku</label>
                                    <input type="number" name="tahun_buku" value="<?= $df['tahun_buku']; ?>" required class="form-control" id="tahun_buku<?= $df['id_buku']; ?>">
                                  </div>
                                  <div class="form-group">
                                    <label for="penulis_buku<?= $df['id_buku']; ?>">Penulis Buku</label>
                                    <input type="text" name="penulis_buku" value="<?= $df['penulis_buku']; ?>" required class="form-control" id="penulis_buku<?= $df['id_buku']; ?>">
                                  </div>
                                  <div class="form-group">
                                    <label for="rating_buku<?= $df['id_buku']; ?>">Rating Buku</label>
                                    <input type="number" step="0.01" name="rating_buku" value="<?= $df['rating_buku']; ?>" required class="form-control" id="rating_buku<?= $df['id_buku']; ?>" max="10" oninput="validateRating(this)">
                                    <span id="ratingError" style="color: red;"></span>
                                       </div>
                                       <?php $selectedGenres = getSelectedGenres($df['id_buku']); ?>

                          <div class="form-group">
    <label>Genre</label><br>
    <?php foreach ($genre as $dg): ?>
        <div class="form-check">
            <input type="checkbox" name="id_genre[]" id="id_genre<?= $df['id_buku'] . '_' . $dg['id_genre']; ?>" class="form-check-input" value="<?= $dg['id_genre']; ?>" <?= (in_array($dg['id_genre'], $selectedGenres)) ? 'checked' : ''; ?>>
            <label class="form-check-label" for="id_genre<?= $df['id_buku'] . '_' . $dg['id_genre']; ?>"><?= ucwords($dg['nama_genre']); ?></label>
        </div>
    <?php endforeach ?>
</div>


                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                                  <button type="submit" name="btnUbahBuku" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Simpan</button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                        <a href="hapus_buku.php?id_buku=<?= $df['id_buku']; ?>" data-nama="buku buku: <?= $df['nama_buku']; ?>" class="btn-hapus btn btn-sm m-1 text-center mx-auto btn-danger"><i class="fas fa-fw fa-trash"></i> Hapus</a>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2024 Grendy Aditya Pangestu</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

</div>
<!-- ./wrapper -->
</body>
</html>
