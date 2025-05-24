<?= $this->extend('layout/template_admin') ?>
<?= $this->section('content') ?>

<h1><?= esc($title) ?></h1>

<form action="<?= base_url('admin/gallery/update/' . $gambar['id']) ?>" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label>Gambar Lama</label><br>
        <img src="/uploads/gallery/<?= $gambar['gambar'] ?>" width="200">
    </div>
    <div class="mb-3">
        <label for="gambar">Ganti Gambar</label>
        <input type="file" name="gambar" id="gambar" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
</form>

<?= $this->endSection() ?>