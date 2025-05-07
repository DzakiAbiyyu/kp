<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>
<!-- Main Start -->

<main class="hero" id="hero">
    <div class="hero-text">
        <div class="hero-text">
            <h1 class="judul"><?= esc($konten['title'] ?? 'Judul Default'); ?></h1>
            <p class="deskripsi"><?= esc($konten['body'] ?? 'Deskripsi Default'); ?></p>

            <div class="hero-buttons">
                <a href="/pages/galery" class="btn btn-gallery">Galeri</a>
                <a href="/pages/pesanTiket" class="btn btn-pesan-tiket">Pesan Tiket</a>
            </div>
        </div>

    </div>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // slider
        let images = [
            <?php foreach ($gambarList as $gambar): ?> '<?= base_url($gambar['gambar']); ?>',
            <?php endforeach; ?>
        ];


        let currentIndex = 0;
        const hero = document.getElementById('hero');
        const heading = document.querySelector('.judul');
        const paragraph = document.querySelector('.deskripsi');


        images.forEach((src) => {
            const img = new Image();
            img.src = src;
        });


        // Set image awal
        hero.style.setProperty('--bg-before',
            `linear-gradient(to top, rgba(255, 183, 94, 0.8), transparent), url('${images[currentIndex]}')`);
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
            // const gradientBefore = `linear-gradient(to top, rgba(135, 206, 250, 0.7), transparent)`;
            // const gradientAfter = `linear-gradient(to top, rgba(10, 25, 47, 0.8), transparent)`;
            let gradientBefore;
            let gradientAfter;



            if (currentIndex % 3 === 0) {
                // Tema PAGI
                gradientBefore = `linear-gradient(to top, rgba(255, 183, 94, 0.8), transparent)`;
                gradientAfter = `linear-gradient(to top, rgba(255, 228, 181, 0.5), transparent)`;

                heading.style.color = '#3b2f2f';
                paragraph.style.color = '#5a4034';
                // heading.style.fontFamily = 'Georgia, serif';
                // paragraph.style.fontFamily = 'Georgia, serif';

            } else if (currentIndex % 3 === 1) {
                // Tema SIANG
                gradientBefore = `linear-gradient(to top, rgba(135, 206, 250, 0.7), transparent)`;
                gradientAfter = `linear-gradient(to top, rgba(0, 191, 255, 0.5), transparent)`;

                heading.style.color = '#003366';
                paragraph.style.color = '#004c99';
                // heading.style.fontFamily = 'Segoe UI, Helvetica, sans-serif';
                // paragraph.style.fontFamily = 'Segoe UI, Helvetica, sans-serif';

            } else {
                // Tema MALAM
                gradientBefore = `linear-gradient(to top, rgba(10, 25, 47, 0.8), transparent)`;
                gradientAfter = `linear-gradient(to top, rgba(0, 0, 0, 0.6), transparent)`;


                heading.style.color = '#ffffff';
                paragraph.style.color = '#cccccc';
                // heading.style.fontFamily = 'Arial Black, sans-serif';
                // paragraph.style.fontFamily = 'Arial, sans-serif';
            }


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

    });
</script>


<!-- Main End -->

<?= $this->endSection(''); ?>