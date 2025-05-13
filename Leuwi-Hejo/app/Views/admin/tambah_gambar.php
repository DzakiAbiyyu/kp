<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<main>
    <div class="container mt-4">
        <h2>Tambah Gambar Baru</h2>

        <?php if (session()->getFlashdata('errors')) : ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('admin/beranda/tambah-gambar') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="gambar" class="form-label">Pilih Gambar (Hanya .jpg)</label>
                <input type="file" name="gambar" id="gambar" class="form-control" accept=".jpg,.jpeg" required>
            </div>

            <button type="submit" class="btn btn-primary">Upload Gambar</button>
            <a href="<?= base_url('admin/beranda') ?>" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

</main>
<?= $this->endSection(); ?>