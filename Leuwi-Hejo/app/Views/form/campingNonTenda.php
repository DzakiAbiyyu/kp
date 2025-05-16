<?= $this->extend('layout/template'); ?>
<?php $this->section('content'); ?>

<div class="formInput">
    <form id="form-campinNonTenda" class="booking-form">
        <h4 class="mb-4">PAKET CAMPING NON TENDA</h4>
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
        <input type="hidden" id="hiddenInput" name="namaPaket" value="Camping Non Trakking">
        <div class="col-12 mb-3">
            <select class="form-select w-100" id="jenisKendaraan" required>
                <option value="" selected disabled>Pilih Transportasi</option>
                <option value="Motor">Motor</option>
                <option value="Mobil">Mobil</option>
            </select>
            <select class="form-select w-100" id="Motor" hidden disabled required>
                <option value="" selected hidden>Pilih Berapa Motor</option>
                <option value="satu">1</option>
                <option value="dua">2</option>
                <option value="tiga">3</option>
                <option value="empat">4</option>
                <option value="lima">5</option>
                <option value="enam">6</option>
                <option value="tujuh">7</option>
                <option value="delapan">8</option>
            </select>
            <select class="form-select w-100" id="Mobil" hidden disabled required>
                <option value="" selected hidden>Pilih Berapa Mobil</option>
                <option value="satu">1</option>
                <option value="dua">2</option>
                <option value="tiga">3</option>
                <option value="empat">4</option>
                <option value="lima">5</option>
                <option value="enam">6</option>
                <option value="tujuh">7</option>
                <option value="delapan">8</option>
            </select>
        </div>
        <input type="date" id="tanggal" name="tanggal" required>
        <button type="submit" class="btn btn-submit w-100">Kirim ke WhatsApp</button>
        <a href="/pages/pesanTiket">kembali</a>
    </form>
</div>

<?php $this->endSection('content'); ?>