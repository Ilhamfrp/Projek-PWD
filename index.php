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

    body {
      background-color: #f5f5f5;
      color: #333;
    }

    .navbar {
      background-color: #1a1a1a;
      color: white;
      padding: 1em 2em;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .navbar a {
      color: white;
      margin: 0 1em;
      text-decoration: none;
      font-weight: bold;
    }

    .navbar a:hover {
      text-decoration: underline;
    }

    .hero {
      background: linear-gradient(to right, #00c3ff, #007bff);
      color: white;
      text-align: center;
      padding: 6em 2em;
    }

    .hero h1 {
      font-size: 2.5em;
      margin-bottom: 0.5em;
    }

    .hero p {
      font-size: 1.2em;
      margin-bottom: 1em;
    }

    .btn {
      background: white;
      color: #007bff;
      padding: 0.8em 1.5em;
      border-radius: 6px;
      text-decoration: none;
      font-weight: bold;
    }

    .btn:hover {
      background-color: #e0e0e0;
    }

    .section {
      padding: 4em 2em;
      text-align: center;
    }

    .section h2 {
      font-size: 1.8em;
      margin-bottom: 1em;
    }

    .grid {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 2em;
      margin-top: 2em;
    }

    .card {
      background: white;
      border-radius: 10px;
      padding: 1.5em;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      width: 250px;
    }

    .card h3 {
      margin-bottom: 0.5em;
      font-size: 1.1em;
    }

    .step-circle {
      width: 40px;
      height: 40px;
      background-color: #007bff;
      color: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 1em auto;
      font-weight: bold;
    }

    .footer {
      background-color: #1a1a1a;
      color: white;
      padding: 2em;
      text-align: center;
      margin-top: 3em;
    }
  </style>
</head>
<body>

  <header class="navbar">
    <div><strong>iRentID</strong></div>
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
    <h2>Mengapa Memilih iRentID?</h2>
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
    <h2>Cara Sewa di iRentID</h2>
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
    <p>&copy; <?= date('Y') ?> iRentID. All rights reserved.</p>
  </footer>

</body>
</html>
