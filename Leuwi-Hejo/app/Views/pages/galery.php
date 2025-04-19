<?= $this->extend('layout/template'); ?>
<?php $this->section('content'); ?>
<header class="header-galery">
    <h1>Galeri Lembah Pangaduan</h1>
</header>

<div class="container-galery">
    <h2 class="judul-deskripsi">Dapatkan Pengalaman-mu Dengan Kami Lembah Pangaduan </h2>
    <p class="description">
        Dapatkan pengalaman menarik-mu dengan kami di Lembah Pangaduan. Kami menyediakan berbagai fasilitas dan kegiatan
        yang dapat membuat liburan Anda semakin menyenangkan.
        Dapatkan pengalaman seru kamu, serta nikmati pemandangan alam yang menakjubkan, dan berbagai aktivitas seperti
        camping, glamping, dan camp at van untuk pengalaman menginap yang berbeda.
        Bagi pecinta alam, kami menawarkan trekking ke gunung Paniisan dan bukit 3G, serta tracking ke curug-curug indah
        seperti Leuwi Hejo, Leuwi Asih, dan Leuwi Kencana.
        Setiap momen yang Anda habiskan di sini akan menjadi kenangan tak terlupakan yang akan selalu Anda ingat dan
        ceritakan kepada teman dan keluarga.
    </p>

    <h2 class="judul-galery">Galeri Foto</h2>
    <div class="gallery">
        <img src="/img/1.jpg" alt="Wahana 1">
        <img src="/img/2.jpg" alt="Pemandangan 1">
        <img src="/img/3.jpg" alt="Pengunjung 1">
        <img src="/img/4.jpg" alt="Area Utama 1">
        <img src="/img/5.jpg" alt="Area Utama 1">
        <img src="/img/6.jpg" alt="Area Utama 1">
        <img src="/img/7.jpg" alt="Area Utama 1">
        <img src="/img/8.jpg" alt="Area Utama 1">
        <!-- Tambahkan lebih banyak gambar sesuai kebutuhan -->
    </div>

    <h2>Video Tur Singkat</h2>
    <div class="video-container">
        <iframe src="https://www.youtube.com/embed/VIDEO_ID" frameborder="0" allowfullscreen></iframe>
    </div>
</div>

<?php $this->endSection('content'); ?>