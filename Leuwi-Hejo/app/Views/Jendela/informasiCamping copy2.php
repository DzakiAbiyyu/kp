<style>
</style>
<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<!-- informasiCamping.php -->
<div class="informasi-camping">
    <h2>Informasi Paket</h2>
    <p>Berikut adalah daftar paket camping yang tersedia:</p>

    <div class="tabel-camping-container">
        <table class="tabel-camping">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Paket</th>
                    <th>Fasilitas</th>
                    <th>Harga</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Paket Reguler</td>
                    <td>Tenda, Matras, Makan 3x</td>
                    <td>Rp 250.000</td>
                    <td>Cocok untuk pemula</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Paket Non-Tenda</td>
                    <td>Matras, Makan 2x</td>
                    <td>Rp 180.000</td>
                    <td>Tanpa penyewaan tenda</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Paket Premium</td>
                    <td>Tenda Premium, Sleeping Bag, Makan 4x, Guide</td>
                    <td>Rp 400.000</td>
                    <td>Untuk pengalaman eksklusif</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Paket Trekking</td>
                    <td>Tenda, Trekking Guide, Makan 2x</td>
                    <td>Rp 300.000</td>
                    <td>Termasuk pendakian ringan</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection('content'); ?>