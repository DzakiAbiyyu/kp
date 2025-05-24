<?= $this->extend('layout/template_admin') ?>
<?= $this->section('content') ?>

<h1><?= esc($title) ?></h1>

<?php if (session()->getFlashdata('errors')) : ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?= base_url('admin/gallery/store') ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <div class="mb-3">
        <label for="gambar" class="form-label">Pilih Gambar</label>
        <input type="file" name="gambar" id="gambar" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Upload</button>
    <a href="<?= base_url('admin/gallery') ?>" class="btn btn-secondary">Kembali</a>
</form>

<?= $this->endSection() ?>