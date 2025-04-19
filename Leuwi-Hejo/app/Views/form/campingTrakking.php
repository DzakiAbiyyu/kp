<?= $this->extend('layout/template'); ?>
<?php $this->section('content'); ?>

<div class="formInputReguler">
    <form id="form-pesan" class="booking-form">
        <h4 class="mb-4">CAMPING + TRAKKING</h4>
        <div class="mb-3">
            <input type="text" class="form-control" id="name" placeholder="Nama Lengkap" required minlength="5"
                maxlength="20">
        </div>
        <div class="mb-3">
            <input type="tel" class="form-control" id="nomor" placeholder="Nomor WhatsApp" pattern="[0-9]{10,13}"
                title="Masukkan nomor antara 10-13 digit angka">
        </div>
        <div class="mb-3">
            <input type="number" class="form-control" id="jumlah" placeholder="Jumlah Orang" required min="1" max="20">
        </div>
        <input type="hidden" id="hiddenInput" name="namaPaket" value="CampingTrakking">
        <div class="mb-3">
            <select class="form-select" id="paket" required>
                <option value="" selected disabled>Pilih Paket Wisata</option>
                <option value="Trakking Curug Leuwi Hejo">Trekking Curug Leuwi Hejo</option>
                <option value="Curug Putri Kencana">Trekking Curug Putri Kencana</option>
                <option value="Leuwi Asih">Trekking Leuwi Asih</option>
                <option value="Bukit Panisan">Trekking Bukit Paniisan</option>
                <option value="Trekking Bukit 3G ">Trekking Bukit Paniisan</option>
            </select>
            <!-- <select class="form-select" id="subPaket" hidden disabled required> -->
            <!-- <option value="" selected hidden>pilih Sub-Paket</option> -->
            <!-- </select> -->
        </div>
        <button type="submit" class="btn btn-submit w-100">Kirim ke WhatsApp</button>
        <a href="/pages/pesanTiket">kembali</a>
    </form>
</div>

<?php $this->endSection('content'); ?>