<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Rentalan IP</title>
  <link rel="stylesheet" href="index.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
   
</head>
<body>
<div class="container">
  
</div>
  <div class="navbar">
  <div><strong>Rentalan IP</strong></div>
  <div>
    <a href="sewa.php">Rent Now</a>
    <a href="review.php">Review</a>
    <?php if (isset($_SESSION['nama'])): ?>
      <a href="riwayat_pesanan.php">Riwayat</a>
      <a href="logout.php">Logout</a>
    <?php else: ?>
      <a href="register.php">Sign Up</a>
      <a href="login.php">Login</a>
    <?php endif; ?>
  </div>
</div>

</div>

  <div class="hero">
    <h1>Rentalan IP</h1>
    <p>Sewa iPhone berkualitas dengan mudah dan cepat melalui website kami</p>
  </div>

  <section class="section">
    <h2>Cara Memesan</h2>
    <div class="grid">
      <div class="card">
        <h3>1. Login / Daftar</h3>
        <p>Buat akun untuk memulai penyewaan</p>
      </div>
      <div class="card">
        <h3>2. Pilih iPhone</h3>
        <p>Lihat dan pilih iPhone yang ingin kamu sewa</p>
      </div>
      <div class="card">
        <h3>3. Isi Form Penyewaan</h3>
        <p>Masukkan tanggal sewa dan data lainnya</p>
      </div>
      <div class="card">
        <h3>4. Lakukan Pembayaran</h3>
        <p>Transfer atau pilih bayar di tempat</p>
      </div>
    </div>
  </section>

  <section class="about">
    <h2>Tentang Kami</h2>
    <p>Rentalan IP adalah layanan penyewaan iPhone terpercaya yang memberikan kemudahan dalam meminjam perangkat berkualitas tinggi untuk kebutuhan harian, acara, atau keperluan bisnis. Kami berkomitmen menghadirkan layanan cepat, transparan, dan aman bagi seluruh pelanggan kami.</p>
  </section>

  <section class="footer">
    <div class="col">
      <h3>Alamat</h3>
      <p>UPNVY, Sleman, Yogyakarta</p>
      <p>081234567891</p>
    </div>
    <div class="col">
      <h3>Halaman</h3>
      <a href="#">Privacy Policy</a>
      <a href="#">Terms of Use</a>
      <a href="#">Regulations</a>
    </div>
    
    <div class="col">
      <h3>Contact Us</h3>
      <a href="https://www.instagram.com/ilpranoto/">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
          <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
        </svg>
        Ilham Pranoto
      </a>
      <a href="https://www.instagram.com/vinabudiastuti/">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
          <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
        </svg>
        Alvina Kumala
      </a>
    </div>
  </section>

  <div class="copyright">
    <p>&copy; <?= date('Y') ?> Rentalan IP. All rights reserved.</p>
  </div>

</body>
</html>
