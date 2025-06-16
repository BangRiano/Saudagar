<?php 
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Produk Terbaru - Saudagar</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- Header -->
  <header class="navbar">
    <div class="logo">SAUDAGAR</div>
    <nav>
      <a href="BERANDA.php">BERANDA</a>
      <a href="KATALOG.php">KATALOG</a>
      <a href="CASUAL.php">CASUAL</a>
      <a href="FORMAL.php">FORMAL</a>
      <a href="CLASIC.php">CLASSIC</a>
    </nav>
    <div class="icons">
      <span>👤 <?php echo $_SESSION['username']; ?></span>
      <span>🛒<sup>0</sup></span>
    </div>
    <div class="search-bar">
      <input type="text" placeholder="Cari produk..." onkeyup="searchProduct()" id="searchInput">
      <button onclick="searchProduct()">Cari</button>
    </div>
  </header>

  
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>

  <!-- Judul -->
  <h1 class="judul text-center my-4">Produk Terbaru</h1>

  <!-- Produk -->
  <section class="products d-flex flex-wrap justify-content-center gap-4">
    <?php
    // Daftar produk
    $produk = [
      ["img" => "images.png", "nama" => "Countryman Z1", "harga" => "Rp3.200.000"],
      ["img" => "saudagarwp-watch-product-6-150x150.jpg", "nama" => "Alexandria M2", "harga" => "Rp1.250.000"],
      ["img" => "fotonya/images (2).png", "nama" => "Craften Fighter K90", "harga" => "Rp3.900.000"],
      ["img" => "fotonya/saudagarwp-watch-product-8-300x400.jpg", "nama" => "Expedisi AT80", "harga" => "Rp4.450.000"],
      ["img" => "fotonya/saudagarwp-watch-product-4-300x400 (1).jpg", "nama" => "Tisson MS20", "harga" => "Rp6.350.000"],
     
    ];

    foreach ($produk as $item) {
      echo '
        <div class="product-card text-center">
          <img src="'.$item['img'].'" alt="'.$item['nama'].'" class="img-fluid">
          <p><strong>'.$item['nama'].'</strong></p>
          <p>'.$item['harga'].'</p>
          <button class="btn btn-primary">Tambah ke Keranjang</button>
        </div>
      ';
    }
    ?>
  </section>

  <!-- Tombol Logout -->
  <div class="text-center my-4">
    <a href="logout.php" class="btn btn-danger">Logout</a>
  </div>

  <!-- Footer -->
 <footer class="bg-dark text-white p-4">
  <div class="container">
    <div class="row text-center text-md-start">
      
      <!-- Kolom 1: SAUDAGAR WP -->
      <div class="col-md-4 mb-4">
        <h5>SAUDAGAR WP</h5>
        <p>Saudagar WP adalah tema toko online untuk WordPress dan WooCommerce.</p>
        <div class="d-flex gap-2 justify-content-center justify-content-md-start">
          <a href="#"><img src="images.jpeg" width="30" alt="Facebook"></a>
          <a href="#"><img src="Twitter.jpeg" width="30" alt="Twitter"></a>
          <a href="#"><img src="Instagram_logo_2022.svg.webp" width="30" alt="Instagram"></a>
        </div>
      </div>

      <!-- Kolom 2: LINK PENTING -->
      <div class="col-md-4 mb-4">
        <h5>LINK PENTING</h5>
        <ul class="list-unstyled" style="line-height: 1.8;">
          <li><a href="#" class="text-white text-decoration-none">Konfirmasi Pembayaran</a></li>
          <li><a href="#" class="text-white text-decoration-none">Pembayaran & Pengiriman</a></li>
          <li><a href="#" class="text-white text-decoration-none">Syarat & Ketentuan</a></li>
        </ul>
      </div>

      <!-- Kolom 3: MARKETPLACE -->
      <div class="col-md-4 mb-4">
        <h5>MARKETPLACE</h5>
        <div class="d-flex flex-wrap gap-2 justify-content-center justify-content-md-start">
          <a href="#"><img src="color-1024x576.png" width="25" alt="Blibli"></a>
          <a href="#"><img src="bukalapak.jpeg" width="25" alt="Bukalapak"></a>
          <a href="#"><img src="862228_720.jpg" width="25" alt="Tokopedia"></a>
          <a href="#"><img src="seller-lazada.jpg" width="25" alt="Lazada"></a>
          <a href="#"><img src="global-50009109-d252a9030f75c0f74e1290bd9869e1a2.png" width="25" alt="Shopee"></a>
          <a href="#"><img src="1200px-Tiktok_logo.svg.png" width="25" alt="TikTok"></a>
        </div>
      </div>
    </div>

    <div class="text-center mt-3">
      <p class="mb-0">&copy; 2025 Saudagar Luxury. All Rights Reserved.</p>
    </div>
  </div>
</footer>

  <!-- Script -->
  <script src="script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
