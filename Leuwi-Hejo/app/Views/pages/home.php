<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>
<!-- Main Start -->

<main class="hero">
    <div class="hero-text">
        <h1><?= esc($konten['title'] ?? 'Judul Default'); ?></h1>
        <p><?= esc($konten['body'] ?? 'Deskripsi Default'); ?></p>

        <div class="hero-buttons">
            <a href="/pages/galery" class="btn">Galeri</a>
            <a href="/pages/pesanTiket" class="btn btn-primary">Pesan Tiket</a>
        </div>
    </div>
</main>


<!-- Main End -->

<?= $this->endSection(''); ?>