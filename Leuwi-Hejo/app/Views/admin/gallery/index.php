<?= $this->extend('layout/template_admin') ?>
<?= $this->section('content') ?>

<h1><?= esc($title) ?></h1>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<div class="row">
    <!-- Tombol tambah card -->
    <div class="col-md-3 mb-4">
        <div class="card h-100 d-flex justify-content-center align-items-center text-center bg-light border-dashed">
            <a href="<?= base_url('admin/gallery/create') ?>" class="btn btn-outline-primary">
                <i class="fa fa-plus fa-2x"></i><br>
                Tambah Gambar
            </a>
        </div>
    </div>

    <!-- Daftar gambar -->
    <?php foreach ($gambar as $g) : ?>
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm h-100">
                <img src="<?= base_url('/uploads/gallery/' . $g['gambar']) ?>" class="card-img-top" alt="Gambar"
                    style="height: 200px; object-fit: cover;">
                <div class="card-body text-center">
                    <a href="<?= base_url('admin/gallery/edit/' . $g['id']) ?>" class="btn btn-warning btn-sm me-2">
                        <i class="fa fa-pen"></i> Edit
                    </a>
                    <a href="<?= base_url('admin/gallery/delete/' . $g['id']) ?>" class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin ingin menghapus?')">
                        <i class="fa fa-trash"></i> Hapus
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?= $this->endSection() ?>