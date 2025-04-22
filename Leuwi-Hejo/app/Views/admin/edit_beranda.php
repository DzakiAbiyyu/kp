<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<main>
    <div class="container mt-4">
        <h2>Edit Konten Halaman Utama</h2>
        <form action="/admin/beranda/update/<?= esc(data: $konten['slug']); ?>" method="post">
            <?= csrf_field(); ?>
            <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input type="text" class="form-control" name="judul" id="judul" value="<?= esc(data: $konten['title']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" name="body" id="body" rows="4" required><?= esc(data: $konten['body']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="/admin/beranda" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</main>

<?= $this->endSection(); ?>