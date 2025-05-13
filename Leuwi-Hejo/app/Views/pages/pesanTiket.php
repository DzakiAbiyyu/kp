<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container-tiket">
    <h1>Lembah Pangaduan</h1>

    <div class="section">
        <h2>Informasi Promo</h2>
        <p>Dapatkan diskon 10% untuk pembelian online sebelum tanggal 30 April 2025!</p>
    </div>

    <!-- <div class="informasi-paket"> -->
    <!-- </div> -->


    <div class="container-paket">
        <h2>Paket</h2>
        <div class="container-card">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Reguler</h5>
                    <div class="buttons">
                        <!-- <button class="Form"><a href="/form/hargaReguler"></a>Pilih</button> -->
                        <a href="/form/reguler">Pilih</a>
                        <button class="Informasi" data-url="/Jendela/informasiCampingNonTenda">Lihat-Informasi</button>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">CAMPING NON TENDA</h5>
                    <div class="buttons">
                        <!-- <button class="Form"><a href="/form/hargaReguler"></a>Pilih</button> -->
                        <a href="/form/campingNonTenda">Pilih</a>
                        <button class="Informasi" data-url="/Jendela/informasiCampingNonTenda">Lihat-Informasi</button>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">TRAKKING</h5>
                    <div class="buttons">
                        <!-- <button class="Form"><a href="/form/hargaReguler"></a>Pilih</button> -->
                        <a href="/form/trekking">Pilih</a>
                        <button class="Informasi" data-url="/jendela/Reguler">Lihat-Informasi</button>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">CAMPING</h5>
                    <div class="buttons">
                        <!-- <button class="Form"><a href="/form/hargaReguler"></a>Pilih</button> -->
                        <a href="/form/camping">Pilih</a>
                        <button class="Informasi" data-url="/Jendela/informasiCamping">Lihat-Informasi</button>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">CAMPING + TRAKKING</h5>
                    <div class="buttons">
                        <!-- <button class="Form"><a href="/form/hargaReguler"></a>Pilih</button> -->
                        <a href="/form/campingTrakking">Pilih</a>
                        <button class="Informasi" data-url="/jendela/Reguler">Lihat-Informasi</button>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">PERLENGKAPAN</h5>
                    <div class="buttons">
                        <!-- <button class="Form"><a href="/form/hargaReguler"></a>Pilih</button> -->
                        <a href="/form/hargaReguler">Pilih</a>
                        <button class="Informasi" data-url="/jendela/Reguler">Lihat-Informasi</button>
                    </div>
                </div>
            </div>


        </div>

    </div>

    <!-- Modal Informasi -->
    <div id="infoModalInformasi" class="popup-containerInformasi" style="display: none;">
        <div class="popup-content">
            <span onclick="closePopup()" class="close-btn">&times;</span>
            <div id="popupBodyInformasi"></div>
        </div>
    </div>

    <!-- Modal Form -->
    <div id="infoModalForm" class="popup-containerForm" style="display: none;">
        <div class="popup-content">
            <span onclick="closePopup()" class="close-btn">&times;</span>
            <div id="popupBodyForm"></div>
        </div>
    </div>


    <div class="section">
        <h2>Cara Pembelian Tiket</h2>
        <p>Anda dapat membeli tiket secara <strong>online</strong> melalui website ini atau <strong>offline</strong> di
            lokasi kami.</p>
    </div>

    <div class="section">
        <h2>Syarat & Ketentuan</h2>
        <p>Jam operasional: 09.00 - 17.00 WIB</p>
        <p>Kebijakan refund: Tiket yang dibeli tidak dapat direfund setelah tanggal pembelian.</p>
    </div>
    <div class="buttons">
        <button>Pesan-Tiket</button>
        <button>Refund-Tiket</button>
    </div>
</div>

<?= $this->endSection('content'); ?>