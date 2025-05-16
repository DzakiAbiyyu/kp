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

        <div class="row">
            <!-- Form Upload -->
            <div class="col-md-6">
                <form action="<?= base_url('admin/beranda/tambah-gambar') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="form-group mb-3">
                        <label for="gambar">Pilih Gambar <span class="text-muted">(Hanya .jpg)</span></label>
                        <input type="file" name="gambar" id="gambar" class="form-control-file" accept=".jpg,.jpeg" required onchange="previewGambar()">
                    </div>

                    <button type="submit" class="btn btn-primary">Upload Gambar</button>
                    <a href="<?= base_url('admin/beranda') ?>" class="btn btn-secondary">Kembali</a>
                </form>
            </div>

            <!-- Preview Gambar -->
            <div class="col">
                <label>Preview</label>
                <div class="" style="border: 1px solid #ccc; height: 400px; display: flex; align-items:center; justify-content:center;">
                    <img id="preview-image" src="<?= base_url('img/background_default.png') ?>" alt="Preview" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    function previewGambar() {
        const file = document.getElementById('gambar').files[0];
        const preview = document.getElementById('preview-image');

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }
</script>

<?= $this->endSection(); ?>