<?= $this->extend('layout/template'); ?>
<?php $this->section('content'); ?>
<header class="tentangKami-hero">
    <div class="tentangKami-hero-content">
        <h1>Lembah Pangaduan</h1>
        <p>Menghadirkan Keindahan Alam Lewat Pengalaman Wisata</p>
    </div>
</header>

<section class="tentangKami-section tentangKami-intro">
    <div class="tentangKami-container">
        <h2>Siapa Kami?</h2>
        <p>Kami adalah komunitas pecinta alam yang berdedikasi untuk menghadirkan pengalaman wisata yang mendalam,
            berkelanjutan, dan berdampak positif.</p>
    </div>
    <hr>
</section>

<section class="tentangKami-section tentangKami-visiMisi">
    <div class="tentangKami-container">
        <h2>Latar Belakang</h2>
        <div class="tentangKami-grid">
            <div class="tentangKami-box">
                <p>Menjadi pelopor wisata alam yang berkelanjutan di Indonesia.</p>
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