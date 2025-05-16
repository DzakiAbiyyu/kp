<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<main class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <h2 class="mb-4 text-center">Edit Gambar Background</h2>

            <?php if (session()->getFlashdata('error_edit')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('error_edit') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success_edit')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success_edit') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form action="<?= base_url('admin/beranda/update-gambar/' . $gambar['id']) ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <div class="mb-3 text-center">
                            <label class="form-label fw-bold">Gambar Saat Ini:</label><br>
                            <img src="<?= base_url($gambar['gambar']) ?>" alt="Background" class="img-thumbnail" style="max-width: 100%; height: auto;">
                        </div>

                        <div class="mb-3">
                            <label for="gambar" class="form-label">Upload Gambar Baru <span class="text-muted">(JPG/JPEG)</span>:</label>
                            <input type="file" name="gambar" id="gambar" class="form-control" accept=".jpg,.jpeg" required>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary btn-custom">Update Gambar</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</main>


<?= $this->endSection(); ?>