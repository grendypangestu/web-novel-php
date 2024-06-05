<?php
require "koneksi.php";
$menarik = mysqli_query($koneksi, "SELECT  tb_buku.*, (SELECT GROUP_CONCAT(nama_genre SEPARATOR ', ') FROM tb_buku_genre INNER JOIN tb_genre ON tb_buku_genre.id_genre = tb_genre.id_genre WHERE tb_buku_genre.id_buku = tb_buku.id_buku) as nama_genre, tb_user.username
                                  FROM tb_buku 
                                  INNER JOIN tb_user ON tb_buku.id_user = tb_user.id_user
                                  ORDER BY tb_buku.nama_buku ASC LIMIT 20");
$terbaru = mysqli_query($koneksi, "SELECT  tb_buku.*, (SELECT GROUP_CONCAT(nama_genre SEPARATOR ', ') FROM tb_buku_genre INNER JOIN tb_genre ON tb_buku_genre.id_genre = tb_genre.id_genre WHERE tb_buku_genre.id_buku = tb_buku.id_buku) as nama_genre, tb_user.username
                                  FROM tb_buku
                                  INNER JOIN tb_user ON tb_buku.id_user = tb_user.id_user
                                  ORDER BY tb_buku.nama_buku ASC LIMIT 5");
$favorit = mysqli_query($koneksi, "SELECT  tb_buku.*, (SELECT GROUP_CONCAT(nama_genre SEPARATOR ', ') FROM tb_buku_genre INNER JOIN tb_genre ON tb_buku_genre.id_genre = tb_genre.id_genre WHERE tb_buku_genre.id_buku = tb_buku.id_buku) as nama_genre, tb_user.username
                                  FROM tb_buku
                                  INNER JOIN tb_user ON tb_buku.id_user = tb_user.id_user
                                  ORDER BY tb_buku.nama_buku DESC
                                  
                                   LIMIT 20");

$genre = mysqli_query($koneksi, "SELECT * FROM tb_genre ORDER BY nama_genre ASC");

$query = "SELECT * FROM tb_buku";
$result = mysqli_query($koneksi, $query);
$genre = mysqli_query($koneksi, "SELECT * FROM tb_genre ORDER BY nama_genre ASC LIMIT 5");
$selectedGenres = array();

?>


<!DOCTYPE html>
<html lang="en">

<head>
      <?php include 'include/css.php'; ?>
      <title>Beranda Bacacuy</title>
</head>

<body>
    <header class="col-12 bg-light p-2 d-flex justify-content-center">
        <div class="container d-flex row justify-content-center align-items-center">
            <div class="col-lg-3 col-sm-6 col-6 ">
                <img src="assets/img/img_properties/logo-bacacuy.png" class="logo me-auto ms-auto d-block" width="70%" alt="">
            </div>
            <div class="col-lg-6  d-sm-none d-md-block d-none">
                <div class="d-flex align-items-center justify-content-evenly">
                    <span class="fs-4 nav-item"><a class="nav-link" href="#">Terbaru</a></span>
                    <span class="fs-4">|</span>
                    <span class="fs-4 nav-item"><a class="nav-link" href="#">Favorit</a></span>
                    <span class="fs-4">|</span>
                    <span class="fs-4 nav-item"><a class="nav-link" href="#">Menarik</a></span>
                </div>
            </div>
            <div class="col-lg-3 col-sm-12 col-12 ">
           <form class="form-inline">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button">Search</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12  d-sm-none d-block">
                <div class="d-flex align-items-center justify-content-evenly">
                    <span class="fs-4 nav-item"><a class="nav-link" href="#">Terbaru</a></span>
                    <span class="fs-4">|</span>
                    <span class="fs-4 nav-item"><a class="nav-link" href="#">Favorit</a></span>
                    <span class="fs-4">|</span>
                    <span class="fs-4 nav-item"><a class="nav-link" href="#">Menarik</a></span>
                </div>
            </div>
        </div>
    </header>
    <nav class="col-12 bg-light p-1 mb-2">
        <div class="container">
            <div class="container d-flex d-md-flex align-items-center justify-content-center overflow-y-new">
                <?php foreach ($genre as $dg): ?>
                    <button class="btn btn-danger m-1 w-50 fs-7"><a class="nav-link" href="#">
                            <?= ucwords($dg['nama_genre']); ?>
                        </a></button>
                <?php endforeach; ?>
            </div>
        </div>
    </nav>
    <main class="col-12 container mt-4">
        <div class="container">
            <div id="carouselExampleIndicators" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                        class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="assets/img/slider/gambar1.jpeg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/img/slider/gambar2.jpeg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/img/slider/gambar3.jpeg" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </main>
    <section class="col-12 container mt-4">
        <div class="row my-5">
            <h1 class="text-center">Terbaru</h1>
            <p class="fw-light w-75 mx-auto text-center">Buku adalah kunci menuju dunia yang tak terbatas, di mana
                imajinasi dan pengetahuan bertemu.</p>
        </div>
<div class="justify-content-center my-5 mx-auto">
    <div class="row container mx-auto mt-1">
        <?php foreach ($terbaru as $tb): ?>
            <div class="col-6 col-md-4 col-lg-2 m-3 p-1">
                <!-- Tautan untuk setiap buku dengan menyertakan nama buku sebagai parameter GET -->
                <a href="detail_buku.php?nama_buku=<?= urlencode($tb['nama_buku']); ?>" class="text-decoration-none">
                    <div class="card">
                        <img src="assets/img/img_buku/<?= $tb['cover_buku']; ?>" class="card-img-top mx-auto" alt="<?= $tb['cover_buku']; ?>" style="height: 200px; width: 150px;">
                        <div class="card-body">
                            <h5 class="card-title fs-7 text-left"><?= $tb["nama_buku"]; ?></h5>
                            <p class="card-text fs-7 text-left"><?= ucwords($tb['nama_genre']); ?></p>
                            <p class="card-text fs-7 text-left">⭐ <?= $tb['rating_buku']; ?> / 10</p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>






    </section>
    <section class="container">
        <div class="row my-5">
            <h1 class="text-center">Favorit</h1>
            <p class="fw-light w-75 mx-auto text-center">"Makin banyak membaca, makin aku banyak berpikir, makin aku
                banyak belajar, makin aku sadar bahwa aku tak mengetahui apa pun.</p>
        </div>
        
        <div class="row g-1 my-5 mx-auto owl-carousel owl-theme">
            <?php foreach ($favorit as $bf): ?>
                <div class="col-6 product-item mx-auto">
                    <a href="detail_buku.php?nama_buku=<?= urlencode($bf['nama_buku']); ?>" class="text-decoration-none">
                    <div class="product-img">
                        <img width="210px" height="280px" src="assets/img/img_buku/<?= $bf['cover_buku']; ?>" alt="<?= $bf['cover_buku']; ?> " alt=""
                            class="d-block mx-auto">
                     
                    </div>

                    <div class="product-info p-3">
                        <h5 class="product-type m-auto d-block text-left">
                            <?= $bf["nama_buku"]; ?>
            </h5>
                        <a href="#" class="d-block text-dark text-decoration-none py-2 product-name"></a>
                     <p class="card-text rating  text-left"><?= $tb['nama_genre']; ?></p>
                        <p class="card-text rating text-left">⭐ <?= $tb['rating_buku']; ?> / 10</p>
                    
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="col-12 container">
        
        <div class="row my-5">
            <h1 class="text-center">Menarik</h1>
            <p class="fw-light w-75 mx-auto text-center">Buku adalah kunci menuju dunia yang tak terbatas, di mana
                imajinasi dan pengetahuan bertemu.</p>
        </div>

<div class="row container mx-auto mt-1 justify-content-left  my-5">
    <?php foreach ($menarik as $bm): ?>
        <div class="col-6 col-md-4 col-lg-2 m-3 p-1">
<a href="detail_buku.php?nama_buku=<?= urlencode($bm['nama_buku']); ?>" class="text-decoration-none">
                <div class="card">
                    <img src="assets/img/img_buku/<?= $bm['cover_buku']; ?>" class="card-img-top mx-auto" alt="<?= $bm['cover_buku']; ?>" style="height: 200px; width: 150px;">
                    <div class="card-body">
                        <h5 class="card-title fs-7 text-left"><?= $bm["nama_buku"]; ?></h5>
                        <p class="card-text fs-7 text-left"><?= ucwords($bm['nama_genre']); ?></p>
                        <p class="card-text fs-7 text-left">⭐ <?= $bm['rating_buku']; ?> / 10</p>
                    </div>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>

    </section>
    <footer class="col-12 bg-light mt-5 p-5">
        <div
            class="container col-lg-5 col-sm-8 col-12 d-block align-items-center justify-content-center d-flex flex-column">
            <img src="assets/asset/logo-bacacuy.png" class="w-75 me-auto ms-auto d-flex" alt="">
            <span class="fs-7 text-center">Copyright &copy;BacaCuy.com -BacaCuy Situs baca Komik </span>
        </div>
    </footer>







    <!-- jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- owl carousel -->
    <script src="assets/vendor/owl_carousel/owl.carousel.js"></script>
    <script src="assets/vendor/owl_carousel/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
    <script src="search.js"></script>

</body>

</html>