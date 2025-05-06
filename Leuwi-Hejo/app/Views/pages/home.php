<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>
<!-- Main Start -->

<main class="hero" id="hero">
    <div class="hero-text">
        <div class="hero-text">
            <h1><?= esc($konten['title'] ?? 'Judul Default'); ?></h1>
            <p><?= esc($konten['body'] ?? 'Deskripsi Default'); ?></p>

            <div class="hero-buttons">
                <a href="/pages/galery" class="btn">Galeri</a>
                <a href="/pages/pesanTiket" class="btn btn-primary">Pesan Tiket</a>
            </div>
        </div>

        <div class="footer-content">
            <p>&copy; <?= date('Y'); ?> Leuwi Hejo. Semua hak dilindungi</p>
        </div>

    </div>
</main>
<script>
    // slider
    let images = [
        <?php foreach ($gambarList as $gambar): ?> '<?= base_url($gambar['gambar']); ?>',
        <?php endforeach; ?>
    ];


    let currentIndex = 0;
    const hero = document.getElementById('hero');

    images.forEach((src) => {
        const img = new Image();
        img.src = src;
    });


    // Set image awal
    hero.style.setProperty('--bg-before',
        `linear-gradient(to top, rgba(236, 240, 164, 0.47), transparent), url('${images[currentIndex]}')`);
    currentIndex = (currentIndex + 1) % images.length;
    hero.style.setProperty('--bg-after',
        `linear-gradient(to top, rgba(231, 69, 69, 0.5), transparent), url('${images[currentIndex]}')`);

    // Tambahkan style agar pseudo-element bisa akses var
    const style = document.createElement('style');
    style.innerHTML = `
  .hero::before {
    background-image: var(--bg-before);
  }
  .hero::after {
    background-image: var(--bg-after);
  }
  `;
    document.head.appendChild(style);

    let isBeforeActive = true;

    function changeBackground() {
        currentIndex = (currentIndex + 1) % images.length;
        const nextImage = images[currentIndex];
        const gradientBefore = `linear-gradient(to top, rgba(231, 69, 69, 0.5), transparent)`;
        const gradientAfter = `linear-gradient(to top, rgba(5, 17, 154, 0.5), transparent)`;

        if (isBeforeActive) {
            hero.style.setProperty('--bg-after', `${gradientBefore}, url('${nextImage}')`);
            hero.classList.add('fade-to-after');
            hero.classList.remove('fade-to-before');

        } else {
            hero.style.setProperty('--bg-before', `${gradientAfter}, url('${nextImage}')`);
            hero.classList.add('fade-to-before');
            hero.classList.remove('fade-to-after');

        }

        isBeforeActive = !isBeforeActive;
    }

    setInterval(changeBackground, 5000);
    // end slider  
</script>


<!-- Main End -->

<?= $this->endSection(''); ?>