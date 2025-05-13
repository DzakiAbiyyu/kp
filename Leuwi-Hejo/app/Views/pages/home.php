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
            `linear-gradient(to top, rgba(255, 183, 94, 0.8), transparent), url('${images[currentIndex]}')`);;
        hero.style.setProperty('--bg-after',
            `linear-gradient(to top, rgba(231, 69, 69, 0.5), transparent), url('${images[currentIndex]}')`);

        // Tambahkan styling default (misalnya Tema Pagi)
        heading.style.color = '#3b2f2f';
        heading.style.textShadow = '0 0 20px rgb(85, 206, 85)';
        paragraph.style.color =
            '#5a4034';
        paragraph.style.textShadow = '0 0 8px #ffa500';
        console.log('Tema Pagi diterapkan');
        console.log(heading.style.textShadow);


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
            // nextIndex = currentIndex === images.length;
            nextIndex = (currentIndex + 1) % images.length;
            const nextImage = images[nextIndex];



            // const gradientBefore = `linear-gradient(to top, rgba(135, 206, 250, 0.7), transparent)`;
            // const gradientAfter = `linear-gradient(to top, rgba(10, 25, 47, 0.8), transparent)`;
            let gradientBefore;
            let gradientAfter;

            heading.style.textShadow = '0 0 20px rgb(85, 206, 85)';
            paragraph.style.textShadow = '0 0 8px #ffa500';



            // Menetapkan styling untuk setiap tema
            if (nextIndex === 0) {
                // Tema Pagi
                gradientBefore = `linear-gradient(to top, rgba(255, 183, 94, 0.8), transparent)`;
                gradientAfter = `linear-gradient(to top, rgba(255, 228, 181, 0.5), transparent)`;

                heading.style.color = '#3b2f2f';
                heading.style.textShadow = '0 0 20px rgb(85, 206, 85)';
                paragraph.style.color = '#5a4034';
                paragraph.style.textShadow = '0 0 8px #ffa500';

                console.log('Tema Pagi diterapkan');
                console.log(heading.style.textShadow);

            } else if (nextIndex === 1) {
                // Tema Siang
                gradientBefore = `linear-gradient(to top, rgba(255, 183, 94, 0.8), transparent)`;
                gradientAfter = `linear-gradient(to top, rgba(255, 228, 181, 0.5), transparent)`;

                heading.style.color = '#003366';
                heading.style.textShadow = '0 0 12px #87cefa';
                paragraph.style.color = '#004c99';
                paragraph.style.textShadow = '0 0 8px #87cefa';

                console.log('Tema Siang diterapkan');
                console.log(heading.style.textShadow);
            } else if (nextIndex === 2) {
                // Tema Sore
                gradientBefore = `linear-gradient(to top, rgba(135, 206, 250, 0.7), transparent)`;
                gradientAfter = `linear-gradient(to top, rgba(0, 191, 255, 0.5), transparent)`;

                heading.style.color = '#4b1e1e';
                heading.style.textShadow = '0 0 12px #ff6347';
                paragraph.style.color = '#6e2c2c';
                paragraph.style.textShadow = '0 0 8px #ff7f50';

                console.log('Tema Sore diterapkan');
                console.log(heading.style.textShadow);

            } else {
                // Tema MALAM
                gradientBefore = `linear-gradient(to top, rgba(10, 25, 47, 0.8), transparent)`;
                gradientAfter = `linear-gradient(to top, rgba(0, 0, 0, 0.6), transparent)`;


                heading.style.color = '#ffffff';
                heading.style.textShadow = '0 0 12px #6600cc'; // ungu terang

                paragraph.style.color = '#cccccc';
                paragraph.style.textShadow = '0 0 8px #6600cc';

                console.log('Tema Malam diterapkan');
                console.log(heading.style.textShadow);

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
            // Update currentIndex
            currentIndex = nextIndex;

            isBeforeActive = !isBeforeActive;
        }

        setInterval(changeBackground, 5000);
        // end slider  

    });
</script>


<!-- Main End -->

<?= $this->endSection(''); ?>