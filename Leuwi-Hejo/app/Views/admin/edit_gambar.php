<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<main>
    <h2>Edit Gambar Background</h2>

    <form action="<?= base_url('admin/beranda/update-gambar/' . $gambar['slug']) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label>Gambar Saat Ini:</label><br>
            <img src="<?= base_url($gambar['gambar']) ?>" alt="Background" style="max-width: 300px;" class="img-thumbnail">
        </div>

        <div class="mb-3">
            <label for="gambar">Upload Gambar Baru</label>
            <input type="file" name="gambar" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Gambar</button>
    </form>
</main>

<?= $this->endSection(); ?>