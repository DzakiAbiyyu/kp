<!-- Navbar Start -->
<nav class="navbar">
    <a href="#" class="navbar-logo">Lembah<span>Pangaduan</span></a>
    <div class="navbar-nav" id="navbarNav">
        <a href="/">Beranda</a>
        <a href="/pages/about">Tentang Kami</a>
        <a href="/pages/galery">Galeri</a>
        <a href="/pages/pesanTiket">Produk & Paket</a>

        <!-- Tombol Masuk dan Daftar ditambahkan di sini untuk tampilan mobile -->
    </div>
    <div class="navbar-extra">
        <?php if (logged_in()) : ?>
            <a href="<?= site_url('/logout') ?>">Logout</a>
        <?php else : ?>
            <a href="<?= site_url('/register') ?>">Daftar</a>
            <a href="<?= site_url('/login') ?>">Masuk</a>
        <?php endif ?>
        <a href="#" id="hamburger-menu"><i data-feather="menu"></i></a>
    </div>
</nav>
<!-- Navbar End -->