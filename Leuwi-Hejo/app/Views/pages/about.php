<?= $this->extend('layout/template'); ?>
<?php $this->section('content'); ?>
<!-- <header class="tentangKami-hero"> -->
<!-- <div class="tentangKami-hero-content"> -->
<!-- <h1>Lembah Pangaduan</h1> -->
<!-- <p>Menghadirkan Keindahan Alam Lewat Pengalaman Wisata</p> -->
<!-- </div> -->
<!-- </header> -->

<section class="tentangKami-section tentangKami-intro">
    <div class="tentangKami-container siapa-kami">
        <!-- <h2><?= esc($konten['title']); ?></h2> -->
        <p><?= esc($konten['body']); ?></p>
        <p>Kami berkomitmen untuk memberikan fasilitas camping yang nyaman dan terjangkau, tanpa menghilangkan keaslian
            nuansa alam. Mulai dari area tenda yang luas, fasilitas umum yang bersih, hingga berbagai aktivitas outdoor
            seperti hiking/treking, outbound, dan api unggun malam hari, semuanya kami rancang untuk menciptakan momen
            tak terlupakan bagi setiap pengunjung.</p>
        <!-- <p>Kami adalah komunitas pecinta alam yang berdedikasi untuk menghadirkan pengalaman wisata yang mendalam,
            berkelanjutan, dan berdampak positif.</p> -->
    </div>
    <hr>
</section>

<section class="unix-tentang-kami">
    <div class="unix-container">
        <div class="unix-row">
            <!-- Visi -->
            <div class="unix-col unix-visi">
                <h2 class="unix-title">Visi</h2>
                <p>
                    <!-- Menjadi platform lelang terpercaya yang memberikan akses mudah dan transparan bagi semua pihak. -->
                    Menjadi destinasi camping terfavorit di sentul, yang memadukan petualangan alam dengan kenyamanan
                </p>
            </div>

            <!-- Misi -->
            <div class="unix-col unix-misi">
                <h2 class="unix-title">Misi</h2>
                <ul>
                    <li>Menyediakan layanan dan fasilitas camping berkualitas tinggi.</li>
                    <li>Mendorong kegiatan wisata ramah lingkungan.</li>
                    <li>Menumbuhkan semangat kebersamaan dan cinta alam bagi semua kalangan.</li>
                </ul>
            </div>
        </div>
    </div>
    <hr>
</section>

<section class="tentangKami-section">
    <div class="tentangKami-container apa-yang-membuat-kami-berbeda">
        <h2>apa yang membuat kami berbeda ?</h2>
        <div class="tentangKami-grid">
            <div class="tentangKami-box">
                <p>Lokasi camping terluas di sentul,</p>
                <p>Lokasi strategis, mudah dijangkau</p>
                <p>Fasilitas lengkap (toilet, mushola, listrik, air bersih)</p>
                <p>Tim profesional dan ramah</p>
                <p>Tersedia paket khusus untuk acara komunitas dan perusahaan</p>
                <p>Lingkungan aman dan cocok untuk segala usia</p>
            </div>
        </div>
        <div class="tentangKami-gallery-grid">
            <div class="img-box landscape-atas">
                <img src="/img/background/dua.jpg" alt="gambar-1">
            </div>
            <div class="img-box square-atas">
                <img src="/img/background/square-1.jpeg" alt="gambar-2">
            </div>
            <div class="img-box landscape-bawah">
                <img src="/img/background/dua.jpg" alt="gambar-3">
            </div>
            <div class="img-box square-bawah">
                <img src="/img/background/square-2.jpeg" alt="gambar-4">
            </div>
        </div>
    </div>
    <hr>
</section>

<section class="tentangKami-section tentangKami-tim">
    <div class="tentangKami-container">
        <h2>Tim Kami</h2>
        <div class="tentangKami-cards">
            <div class="tentangKami-card">
                <img src="/img/1.JPG" alt="Anggota Tim">
                <h4>Raka</h4>
                <p>Tour Guide & Fotografer</p>
            </div>
            <div class="tentangKami-card">
                <img src="/img/1.JPG" alt="Anggota Tim">
                <h4>Raka</h4>
                <p>Tour Guide & Fotografer</p>
            </div>
            <div class="tentangKami-card">
                <img src="/img/1.JPG" alt="Anggota Tim">
                <h4>Raka</h4>
                <p>Tour Guide & Fotografer</p>
            </div>
            <div class="tentangKami-card">
                <img src="/img/1.JPG" alt="Anggota Tim">
                <h4>Raka</h4>
                <p>Tour Guide & Fotografer</p>
            </div>

            <div class="tentangKami-card">
                <img src="/img/1.JPG" alt="Anggota Tim">
                <h4>Raka</h4>
                <p>Tour Guide & Fotografer</p>
            </div>
            <div class="tentangKami-card">
                <img src="/img/1.JPG" alt="Anggota Tim">
                <h4>Raka</h4>
                <p>Tour Guide & Fotografer</p>
            </div>
            <div class="tentangKami-card">
                <img src="/img/1.JPG" alt="Anggota Tim">
                <h4>Raka</h4>
                <p>Tour Guide & Fotografer</p>
            </div>
            <div class="tentangKami-card">
                <img src="/img/1.JPG" alt="Anggota Tim">
                <h4>Nisa</h4>
                <p>Koordinator Wisata</p>
            </div>
            <div class="tentangKami-card">
                <img src="/img/1.JPG" alt="Anggota Tim">
                <h4>Rendi</h4>
                <p>Ahli Survival & Safety</p>
            </div>
        </div>
    </div>
    <hr>
</section>

<section class="tentangKami-section tentangKami-footerPromo">
    <div class="tentangKami-container tentangKami-footerLayout">
        <div class="tentangKami-footerText">
            <h2>Bergabunglah Bersama Kami!</h2>
            <p>Ikuti petualangan tak terlupakan dan bantu jaga keindahan alam Indonesia.</p>
            <a href="/kontak" class="tentangKami-btn">Hubungi Kami</a>
        </div>
        <div class="tentangKami-mapWrapper">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.835434509993!2d144.95373631531652!3d-37.81627997975167!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11f1b9%3A0x5045675218ceed30!2sMelbourne%20Australia!5e0!3m2!1sen!2sid!4v1616181831184!5m2!1sen!2sid"
                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
</section>

<?php $this->endSection('content'); ?>