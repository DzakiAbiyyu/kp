<?= $this->extend('layout/template'); ?>
<?php $this->section('content'); ?>

<div class="formInput">
    <form id="form-sewa-lahan" class="booking-form">
        <h4 class="mb-4">Reguler</h4>
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
        <input type="hidden" id="hiddenInput" name="namaPaket" value="Reguler">
        <div class="mb-3">
            <select class="form-select" id="Lahan" required>
                <option value="" selected disabled>Pilih Lahan</option>
                <option value="">Camping 1</option>
                <option value="">Camping 2</option>
                <option value="">Camping 3</option>
            </select>
            <select class="form-select" id="jenisKendaraan" required>
                <option value="" selected disabled>Pilih Transportasi</option>
                <option value="Motor">Motor</option>
                <option value="Mobil">Mobil</option>
            </select>
            <select class="form-select" id="Motor" hidden disabled required>
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
            <select class="form-select" id="Mobil" hidden disabled required>
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

        <!-- Perlengkapan Tenda (dibungkus satu div) -->
        <div class="mb-3 special-input">
            <div class="form-check satu">
                <label class="form-check-label satu" for="perlengkapanCheckbox">Perlengkapan Tenda</label>
                <input type="checkbox" class="form-check-input" id="perlengkapanCheckbox">
                <div id="perlengkapanError" class="invalid-feedback" hidden>
                    jika dicentang, Pilih setidaknya satu perlengkapan.
                </div>
            </div>

            <div id="perlengkapanList" class="mt-2" style="display: none;">
                <label class="form-label">Pilih Perlengkapan:</label>
                <div class="container-perlengkapan">
                    <div class="form-check"><input class="form-check-input perlengkapan-item" type="checkbox"
                            value="Matras" id="item1"><label class="form-check-label" for="item1">Matras</label></div>
                    <div class="form-check"><input class="form-check-input perlengkapan-item" type="checkbox"
                            value="Sleeping Bag" id="item2"><label class="form-check-label" for="item2">Sleeping
                            Bag</label></div>
                    <div class="form-check"><input class="form-check-input perlengkapan-item" type="checkbox"
                            value="Tenda Dome" id="item3"><label class="form-check-label" for="item3">Tenda Dome</label>
                    </div>
                    <div class="form-check"><input class="form-check-input perlengkapan-item" type="checkbox"
                            value="Kompor Camping" id="item4"><label class="form-check-label" for="item4">Kompor
                            Camping</label></div>
                    <div class="form-check"><input class="form-check-input perlengkapan-item" type="checkbox"
                            value="Gas Portable" id="item5"><label class="form-check-label" for="item5">Gas
                            Portable</label></div>
                    <div class="form-check"><input class="form-check-input perlengkapan-item" type="checkbox"
                            value="Meja Lipat" id="item6"><label class="form-check-label" for="item6">Meja Lipat</label>
                    </div>
                    <div class="form-check"><input class="form-check-input perlengkapan-item" type="checkbox"
                            value="Kursi Lipat" id="item7"><label class="form-check-label" for="item7">Kursi
                            Lipat</label></div>
                    <div class="form-check"><input class="form-check-input perlengkapan-item" type="checkbox"
                            value="Cooking Set" id="item8"><label class="form-check-label" for="item8">Cooking
                            Set</label></div>
                    <div class="form-check"><input class="form-check-input perlengkapan-item" type="checkbox"
                            value="Headlamp" id="item9"><label class="form-check-label" for="item9">Headlamp</label>
                    </div>
                    <div class="form-check"><input class="form-check-input perlengkapan-item" type="checkbox"
                            value="Trashbag" id="item10"><label class="form-check-label" for="item10">Trashbag</label>
                    </div>
                </div>
            </div>
        </div>


        <input type="date" id="tanggal" name="tanggal" required>
        <button type="submit" class="btn btn-submit w-100">Kirim ke WhatsApp</button>
        <a href="/pages/pesanTiket">kembali</a>
    </form>
</div>

<?php $this->endSection('content'); ?>