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

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <style>
    /* Add this style block or put it in your style.css */
    .user-menu-container {
      position: relative;
      display: inline-block; /* To make the dropdown position relative to this container */
    }

    .user-menu-dropdown {
      display: none; /* Hidden by default */
      position: absolute;
      background-color: #f9f9f9;
      min-width: 200px; /* Adjust width as needed */
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
      right: 0; /* Align to the right of the icon */
      border-top: 3px solid red; /* The red line at the top */
      padding: 10px 0; /* Add some padding */
    }

    .user-menu-dropdown a {
      color: black;
      padding: 8px 15px;
      text-decoration: none;
      display: block;
      font-size: 0.9em; /* Adjust font size */
    }

    .user-menu-dropdown a:hover {
      background-color: #ddd;
    }

    .user-menu-dropdown .menu-id {
      padding: 8px 15px;
      font-weight: bold;
      color: #333;
      border-bottom: 1px solid #eee; /* Separator for ID */
      margin-bottom: 5px;
      font-size: 0.9em;
    }

    /* Show the dropdown menu on hover or click (we'll use JS for click) */
    .user-menu-dropdown.show {
      display: block;
    }
  </style>
</head>
<body>

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
      <div class="user-menu-container">
        <span onclick="toggleUserMenu()" style="cursor: pointer;">👤 <?php echo $_SESSION['username']; ?></span>
        <div id="userDropdown" class="user-menu-dropdown">
           <a href="#">Akun Saya</a>
          <a href="#">Pesanan Saya</a>
          <a href="#">Beli Lagi</a>
          <a href="#">Alamat</a>
          <a href="#">Ulasan Produk</a>
          <a href="logout.php">Logout</a>
        </div>
      </div>
      <span>🛒<sup>0</sup></span>
    </div>
    <div class="search-bar">
      <input type="text" placeholder="Cari produk..." onkeyup="searchProduct()" id="searchInput">
      <button onclick="searchProduct()">Cari</button>
    </div>
  </header>

  <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner text-center">
      <div class="carousel-item active">
        <img src="luxury-demo-banner-1.webp" class="d-block w-100 img-fluid" alt="Jam Tangan Kulit">
        <div class="carousel-caption d-none d-md-block">
          <h5>Jam Tangan Kulit</h5>
        </div>
      </div>
      <div class="carousel-item">
        <img src="fotonya/luxury-demo-banner-2.webp" class="d-block w-100 img-fluid" alt="Jam Tangan Mewah">
        <div class="carousel-caption d-none d-md-block">
          <h5>Jam Tangan Mewah</h5>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>

  <h1 class="judul text-center my-4">Produk Terbaru</h1>

  <section class="products d-flex flex-wrap justify-content-center gap-4">
    <?php
    // Daftar produk
    $produk = [
      ["img" => "images.png", "nama" => "Countryman Z1", "harga" => "Rp3.200.000"],
      ["img" => "saudagarwp-watch-product-6-150x150.jpg", "nama" => "Alexandria M2", "harga" => "Rp1.250.000"],
      ["img" => "saudagarwp-watch-product-10-300x300.jpg", "nama" => "Alexandria C21", "harga" => "Rp1.350.000"],
      ["img" => "saudagarwp-watch-product-17-300x300.jpg", "nama" => "Astro Sky GT120", "harga" => "Rp5.900.000"],
      ["img" => "fotonya/images (2).png", "nama" => "Craften Fighter K90", "harga" => "Rp3.900.000"],
      ["img" => "fotonya/saudagarwp-watch-product-8-300x400.jpg", "nama" => "Expedisi AT80", "harga" => "Rp4.450.000"],
      ["img" => "fotonya/saudagarwp-watch-product-4-300x400 (1).jpg", "nama" => "Tisson MS20", "harga" => "Rp6.350.000"],
      ["img" => "saudagarwp-watch-product-17-300x300.jpg", "nama" => "Expedisi MB50", "harga" => "Rp900.000"],
      ["img" => "fotonya/saudagarwp-watch-product-14-300x400.jpg", "nama" => "Tisson Race GH30", "harga" => "Rp5.200.000"],
      ["img" => "fotonya/saudagarwp-watch-product-1-300x400.jpg", "nama" => "Kelvin Ladies M220", "harga" => "Rp4.250.000"],
      ["img" => "fotonya/saudagarwp-watch-product-2-300x400.jpg", "nama" => "Gramic V80", "harga" => "Rp1.850.000"],
      ["img" => "fotonya/saudagarwp-watch-product-11.jpg", "nama" => "Kasion Sky Light", "harga" => "Rp2.900.000"],
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

  <div class="text-center my-4">
    <a href="logout.php" class="btn btn-danger">Logout</a>
  </div>

  <footer class="bg-dark text-white p-4">
  <div class="container">
    <div class="row text-center text-md-start">

      <div class="col-md-4 mb-4">
        <h5>SAUDAGAR WP</h5>
        <p>Saudagar WP adalah tema toko online untuk WordPress dan WooCommerce.</p>
        <div class="d-flex gap-2 justify-content-center justify-content-md-start">
          <a href="#"><img src="images.jpeg" width="30" alt="Facebook"></a>
          <a href="#"><img src="Twitter.jpeg" width="30" alt="Twitter"></a>
          <a href="#"><img src="Instagram_logo_2022.svg.webp" width="30" alt="Instagram"></a>
        </div>
      </div>

      <div class="col-md-4 mb-4">
        <h5>LINK PENTING</h5>
        <ul class="list-unstyled" style="line-height: 1.8;">
          <li><a href="#" class="text-white text-decoration-none">Konfirmasi Pembayaran</a></li>
          <li><a href="#" class="text-white text-decoration-none">Pembayaran & Pengiriman</a></li>
          <li><a href="#" class="text-white text-decoration-none">Syarat & Ketentuan</a></li>
        </ul>
      </div>

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

  <script src="script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function toggleUserMenu() {
      document.getElementById("userDropdown").classList.toggle("show");
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
      if (!event.target.matches('.user-menu-container span')) {
        var dropdowns = document.getElementsByClassName("user-menu-dropdown");
        for (var i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }
  </script>
</body>
</html>