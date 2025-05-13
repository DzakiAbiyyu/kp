<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<main class="container py-4">
    <h2>Tambah Media Sosial</h2>
    <form action="<?= base_url('admin/beranda/simpan-media') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Media</label>
            <input type="text" name="nama" id="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="url" class="form-label">Link URL</label>
            <input type="url" name="url" id="url" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="ikon" class="form-label">Class Icon Font Awesome</label>
            <input type="text" name="ikon" id="ikon" class="form-control" placeholder="misal: fa-brands fa-facebook" required>
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar (opsional)</label>
            <input type="file" name="gambar" id="gambar" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?= base_url('admin/beranda') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</main>

<?= $this->endSection() ?>