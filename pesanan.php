<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
$result = mysqli_query($conn, "SELECT id FROM users WHERE username='$username'");

if (!$result) {
    die("Query error: " . mysqli_error($conn));
}

$user = mysqli_fetch_assoc($result);
if (!$user) {
    die("User tidak ditemukan di database.");
}

$user_id = $user['id'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pesanan Saya - Saudagar</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
  <h2 class="mb-4">Pesanan Saya</h2>
  <?php
  $pesanan_query = mysqli_query($conn, "SELECT * FROM orders WHERE user_id = $user_id ORDER BY order_date DESC");

  if (mysqli_num_rows($pesanan_query) == 0) {
      echo "<p>Tidak ada pesanan.</p>";
  }

  while ($order = mysqli_fetch_assoc($pesanan_query)) {
      echo "<div class='border p-3 mb-4'>";
      echo "<p><strong>Order ID:</strong> {$order['id']} | <strong>Status:</strong> {$order['status']} | <strong>Tanggal:</strong> {$order['order_date']}</p>";

      $order_id = $order['id'];
      $item_query = mysqli_query($conn, "
          SELECT p.name AS product_name, p.price AS harga_produk, p.stock, oi.quantity, oi.price
          FROM order_items oi
          JOIN products p ON oi.product_id = p.id
          WHERE oi.order_id = $order_id
      ");

      echo "<table class='table table-bordered'>";
      echo "<thead class='table-light'><tr><th>Produk</th><th>Harga</th><th>Jumlah</th><th>Subtotal</th><th>Stok Saat Ini</th></tr></thead><tbody>";

      while ($item = mysqli_fetch_assoc($item_query)) {
          $subtotal = $item['quantity'] * $item['price'];
          echo "<tr>
              <td>{$item['product_name']}</td>
              <td>Rp" . number_format($item['price']) . "</td>
              <td>{$item['quantity']}</td>
              <td>Rp" . number_format($subtotal) . "</td>
              <td>{$item['stock']}</td>
          </tr>";
      }

      echo "</tbody></table></div>";
  }
  ?>
</body>
</html>
