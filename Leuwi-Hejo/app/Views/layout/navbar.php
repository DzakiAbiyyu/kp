<!-- Navbar Start -->
<nav class="navbar">
    <a href="#" class="navbar-logo">Lembah<span>Pangaduan</span></a>
    <div class="navbar-nav" id="navbarNav">
        <a href="/">Beranda</a>
        <a href="/pages/about">Tentang Kami</a>
        <a href="/pages/galery">Galeri</a>
        <a href="/pages/pesanTiket">Produk & Paket</a>
        <?php if (logged_in() && (in_groups('admin') || in_groups('super_admin'))) : ?>
            <a href="<?= base_url('/admin') ?>">Admin Panel</a>
        <?php endif; ?>

        <!-- Tombol Login/Logout ditambahkan di sini untuk tampilan mobile -->
        <?php if (logged_in()) : ?>
            <a href="<?= site_url('/logout') ?>" id="Logout-none">Logout</a>
        <?php else : ?>
            <a href="<?= site_url('/register') ?>" id="Daftar-none">Daftar</a>
            <a href="<?= site_url('/login') ?>" id="Masuk-none">Masuk</a>
        <?php endif ?>
    </div>
    <div class="navbar-extra" id="navbarNav">
        <!-- Tombol Login/Logout ditambahkan di sini untuk tampilan mobile -->
        <?php if (logged_in()) : ?>
            <a href="<?= site_url('/logout') ?>" id="Logout">Logout</a>
        <?php else : ?>
            <a href="<?= site_url('/register') ?>" id="Daftar">Daftar</a>
            <a href="<?= site_url('/login') ?>" id="Masuk">Masuk</a>
        <?php endif ?>


        <!-- Tombol hamburger untuk tampilan mobile -->
        <a href="#" id="hamburger-menu"><i data-feather="menu"></i></a>
    </div>
</nav>

<!-- Navbar End -->