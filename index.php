<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>iRentID - Sewa iPhone</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', sans-serif;
    }
  </style>
</head>
<body>

  <header class="navbar">
    <div><strong>RentalanIP</strong></div>
    <div>
      <a href="sewa.php">Rent Now</a>
      <a href="review.php">Review</a>
    </div>
  </header>

  <section class="hero">
    <h1>Sewa iPhone Terbaru Tanpa Ribet</h1>
    <p>Mulai dari Rp50.000/hari. Praktis, cepat, dan terpercaya.</p><br>
    <a href="sewa.php" class="btn">Sewa Sekarang</a>
  </section>

  <section class="section" style="background-color: #fefefe;">
    <h2>Mengapa Memilih RentalanIP
      ?</h2>
    <div class="grid">
      <div class="card">
        <h3>📱 iPhone Asli</h3>
        <p>Semua unit 100% original dan berkualitas.</p>
      </div>
      <div class="card">
        <h3>🚀 Proses Cepat</h3>
        <p>Pemesanan instan tanpa ribet dan verifikasi panjang.</p>
      </div>
      <div class="card">
        <h3>🛡️ Aman & Terjamin</h3>
        <p>Privasi pengguna selalu kami jaga sepenuhnya.</p>
      </div>
      <div class="card">
        <h3>💬 Support 24/7</h3>
        <p>Kami siap membantu kapan pun kamu butuh bantuan.</p>
      </div>
    </div>
  </section>

  <section class="section" style="background-color: #eef1f5;">
    <h2>Cara Sewa di RentalanIP
      
    </h2>
    <div class="grid">
      <div class="card">
        <div class="step-circle">1</div>
        <p>Pilih iPhone dari halaman katalog.</p>
      </div>
      <div class="card">
        <div class="step-circle">2</div>
        <p>Isi data penyewa dan alamat pengiriman.</p>
      </div>
      <div class="card">
        <div class="step-circle">3</div>
        <p>Tunggu konfirmasi dan barang langsung dikirim.</p>
      </div>
    </div>
  </section>

  <footer class="footer">
    <p>&copy; <?= date('Y') ?> RentalanIP
    . All rights reserved.</p>
  </footer>

</body>
</html>
