<?php 
require 'koneksi.php';
$keyword = $_GET["keyword"];
$query = "SELECT * FROM tb_buku
    WHERE
    nama_buku LIKE '%$keyword%' OR
    tahun_buku LIKE '%$keyword%' OR
    penulis_buku LIKE '%$keyword%'
    ORDER BY nama_buku ASC";
$buku = mysqli_query($koneksi, $query);
?>


<div class="row container mx-auto mt-1 justify-content-left  my-5">
     <?php foreach ($buku as $df): ?>
        <div class="col-6 col-md-4 col-lg-2 m-3 p-1">
<a href="detail_buku.php?nama_buku=<?= urlencode($df['nama_buku']); ?>" class="text-decoration-none">
                <div class="card">
                    <img src="assets/img/img_buku/<?= $df['cover_buku']; ?>" class="card-img-top mx-auto" alt="<?= $df['cover_buku']; ?>" style="height: 200px; width: 150px;">
                    <div class="card-body">
                        <h5 class="card-title fs-7 text-left"><?= $df["nama_buku"]; ?></h5>
                        <p class="card-text fs-7 text-left"><?= ucwords($df['nama_genre']); ?></p>
                        <p class="card-text fs-7 text-left">⭐ <?= $df['rating_buku']; ?> / 10</p>
                    </div>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>

