<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<main class="container py-4">
    <h2>Edit Media Sosial</h2>
    <form action="<?= base_url('admin/beranda/update-media/' . $media['id']) ?>" method="post"
        enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Media</label>
            <input type="text" name="nama" id="nama" class="form-control" style="background-color:beige;" value="<?= esc($media['nama']) ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="link" class="form-label">Link URL</label>
            <input type="url" name="link" id="link" class="form-control" value="<?= esc($media['link']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="icon" class="form-label">Class Icon Font Awesome</label>
            <input type="text" name="icon" id="icon" class="form-control" style="background-color:beige;" value="<?= esc($media['icon']) ?>" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar Saat Ini</label>
            <?php if ($media['gambar']) : ?>
                <div><img src="<?= base_url($media['gambar']) ?>" alt="" width="100" class="mb-2"></div>
            <?php endif; ?>
            <!-- Gambar tidak bisa diganti -->
            <input type="file" class="form-control" disabled>
        </div>

        <button type="submit" class="btn btn-success">Perbarui</button>
        <a href="<?= base_url('admin/beranda') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</main>

<?= $this->endSection() ?>