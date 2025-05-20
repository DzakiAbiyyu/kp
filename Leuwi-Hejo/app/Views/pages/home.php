<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>
<!-- HOME -->
<!-- Main Start -->

<main class="hero" id="hero">
    <div class="hero-text">
        <div class="hero-text container-hero-text">
            <h1 class="judul"><?= esc($konten['title'] ?? 'Judul Default'); ?></h1>
            <!-- H1 Maksimal 50 karakter -->
            <p class="deskripsi"><?= esc($konten['body'] ?? 'Deskripsi Default'); ?></p>
            <!-- P Maksimal 50 karakter -->
            <p class="deskripsi-dua" id="deskripsi-dua">Lembah membawa damai, airnya membawa cerita</p>

        </div>
        <div class="hero-buttons">
            <a href="/pages/galery" class="btn btn-gallery">Galeri</a>
            <a href="/pages/pesanTiket" class="btn btn-pesan-tiket">Pesan Tiket</a>
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
    const paragraphDua = document.getElementById('deskripsi-dua');
    // const navbarLinks = document.querySelectorAll('.navbar a');
    const navLinks = document.querySelectorAll('.navbar a, .navbar-extra a');



    images.forEach((src) => {
        const img = new Image();
        img.src = src;
    });

    // Fungsi untuk update warna link <a> di dalam navbar-nav dan navbar-extra

    function updateNavbarLink(themeIndex) {
        const navLinks = document.querySelectorAll('.navbar a, .navbar-extra a');

        // Warna berdasarkan tema
        let linkColor, hoverColor;

        switch (themeIndex) {
            case 0: // Tema Pagi
                linkColor = 'rgba(58, 47, 47, 0.85)';
                hoverColor = '#ffffff';
                break;
            case 1: // Tema Siang
                linkColor = 'rgba(112, 66, 20, 0.85)';
                hoverColor = '#ffffff';
                break;
            case 2: // Tema Sore
                linkcolor = 'rgba(249, 255, 254, 0.7)';
                hoverColor = '#ffffff';
                break;
            case 3: // Tema Malam
                linkColor = 'rgba(73, 118, 42, 0.85)';
                // linkColor = '#1B4332';
                hoverColor = '#ffffff';
                break;
            default:
                linkColor = 'rgba(58, 47, 47, 0.85)';
                hoverColor = '#3b2f2f';
        }

        // Update hanya warna pada link navbar
        navLinks.forEach(link => {
            link.style.color = linkColor;
            link.style.fontFamily = "'Montserrat', sans-serif";

            // Hapus event listener lama jika ada
            const oldMouseEnter = link.onmouseenter;
            const oldMouseLeave = link.onmouseleave;
            if (oldMouseEnter) link.removeEventListener('mouseenter', oldMouseEnter);
            if (oldMouseLeave) link.removeEventListener('mouseleave', oldMouseLeave);

            // Tambahkan event listener baru
            link.onmouseenter = function() {
                this.style.color = hoverColor;
            };

            link.onmouseleave = function() {
                this.style.color = linkColor;
            };

            link.addEventListener('mouseenter', link.onmouseenter);
            link.addEventListener('mouseleave', link.onmouseleave);
        });
    }

    // Set image awal
    hero.style.setProperty('--bg-before',
        `linear-gradient(to top, rgba(255, 183, 94, 0.8), transparent), url('${images[currentIndex]}')`);;
    hero.style.setProperty('--bg-after',
        `linear-gradient(to top, rgba(231, 69, 69, 0.5), transparent), url('${images[currentIndex]}')`);

    // Tambahkan styling default (misalnya Tema Pagi)
    heading.style.color = '#3b2f2f';
    heading.style.textShadow = '0 0 8px #ffa500';
    paragraph.style.color = '#5a4034';
    paragraphDua.style.color = '#5a4034';
    paragraph.style.textShadow = '0 0 8px #ffa500';
    paragraphDua.style.textShadow = '0 0 8px #ffa500';


    console.log('Tema Pagi diterapkan');
    console.log(heading.style.textShadow);

    // Inisialisasi navbar style untuk tema awal (pagi)
    updateNavbarLink(0);

    // updateNavbarLinkColors('');


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

        let gradientBefore;
        let gradientAfter;

        // Menetapkan styling untuk setiap tema
        if (nextIndex === 0) {
            // Tema Pagi
            gradientBefore = `linear-gradient(to top, rgba(255, 183, 94, 0.8), transparent)`;
            gradientAfter = `linear-gradient(to top, rgba(255, 228, 181, 0.5), transparent)`;

            heading.style.color = '#3b2f2f';
            heading.style.textShadow = '0 0 8px #ffa500';
            paragraph.style.color = '#5a4034';
            paragraphDua.style.color = '#5a4034';
            paragraph.style.textShadow = '0 0 8px #ffa500';
            paragraphDua.style.textShadow = '0 0 8px #ffa500';

            console.log('Tema Pagi diterapkan');
            console.log(heading.style.textShadow);
            updateNavbarLink(0);

        } else if (nextIndex === 1) {
            // Tema Siang
            gradientBefore = `linear-gradient(to top, rgba(255, 183, 94, 0.8), transparent)`;
            gradientAfter = `linear-gradient(to top, rgba(255, 228, 181, 0.5), transparent)`;

            heading.style.color = '#8B4513';
            heading.style.textShadow = '1px 1px 3px rgba(255, 248, 220, 0.8)';
            paragraph.style.color = '#704214';
            paragraph.style.textShadow = '1px 1px 3px rgba(255, 248, 220, 0.8)';
            paragraphDua.style.color = '#704214';
            paragraphDua.style.textShadow = '1px 1px 3px rgba(255, 248, 220, 0.8)';

            console.log('Tema Siang diterapkan');
            console.log(heading.style.textShadow);
            updateNavbarLink(1);
        } else if (nextIndex === 2) {
            // Tema Sore
            gradientBefore = `linear-gradient(to top, rgba(89, 123, 145, 0.7), transparent)`;
            gradientAfter = `linear-gradient(to top, rgba(0, 191, 255, 0.5), transparent)`;

            heading.style.color = '#d0ebff';
            heading.style.textShadow = '1px 1px 3px rgba(255, 255, 255, 0.7)';
            paragraph.style.color = '#d0ebff';
            paragraph.style.textShadow = '1px 1px 3px rgba(0, 91, 54, 0.7)';
            paragraphDua.style.color = '#c5e5ff';
            paragraphDua.style.textShadow = '1px 1px 3px rgba(0, 80, 48, 0.7)';

            console.log('Tema Sore diterapkan');
            console.log(heading.style.textShadow);
            updateNavbarLink(2);

        } else {
            // Tema MALAM
            gradientBefore = `linear-gradient(to top, rgba(10, 25, 47, 0.8), transparent)`;
            gradientAfter = `linear-gradient(to top, rgba(0, 0, 0, 0.6), transparent)`;


            heading.style.color = '#ffffff';
            heading.style.textShadow = '0 0 12px #6600cc'; // ungu terang

            paragraph.style.color = '#cccccc';
            paragraph.style.textShadow = '0 0 8px #6600cc';
            paragraphDua.style.color = '#cccccc';
            paragraphDua.style.textShadow = '0 0 8px #6600cc';

            console.log('Tema Malam diterapkan');
            console.log(heading.style.textShadow);
            updateNavbarLink(3);

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