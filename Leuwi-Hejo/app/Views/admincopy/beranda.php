<?= $this->extend('layout/template_admin'); ?>
<?= $this->section('content'); ?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Manajemen Beranda</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/'); ?>" class="text-decoration-none">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Beranda</li>
        </ol>

        <!-- Kelola Konten -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h2>Kelola Konten Halaman Beranda</h2>

                <?php if (session()->getFlashdata('success_content')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('success_content'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                    </div>
                <?php endif; ?>

                <table class="table table-bordered mt-3">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="text-center">Judul</th>
                            <th class="text-center">Deskripsi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($konten as $k) : ?>
                            <tr>
                                <td class="text-center"><?= esc($k['title']); ?></td>
                                <td class="text-center"><?= esc($k['body']); ?></td>
                                <td class="text-center">
                                    <a href="/admin/beranda/edit/<?= esc($k['slug']); ?>"
                                        class="btn btn-outline-primary btn-sm">
                                        <i class="fa-solid fa-pen-to-square fa-xl"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Kelola Background -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h2 class="mb-4">Kelola Background Halaman Beranda</h2>

                <?php if (session()->getFlashdata('success_background')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('success_background'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                    </div>
                <?php endif; ?>

                <div class="row d-flex">
                    <?php foreach ($gambar as $g) : ?>
                        <div class="col-md-4 mb-3">
                            <div class="card shadow-sm rounded"
                                style="background: #f8f9fa; border: 1px solid #ddd; transition: all 0.3s ease;">
                                <img src="<?= base_url($g['gambar']) ?>" alt="Background" class="card-img-top rounded-top"
                                    style="width: 100%; height: 200px; object-fit: cover;">
                                <div class="card-body text-center">
                                    <a href="<?= base_url('admin/beranda/edit-gambar/' . $g['id']) ?>"
                                        class="btn btn-outline-primary btn-sm me-2">
                                        <i class="fa-solid fa-pen-to-square fa-lg"></i>
                                    </a>

                                    <button type="button"
                                        class="btn btn-sm btn-outline-danger btn-confirm-delete"
                                        data-bs-toggle="modal"
                                        data-bs-target="#confirmDeleteModal"
                                        data-id="<?= $g['id'] ?>"
                                        data-name="<?= esc($g['slug']) ?>"
                                        data-url="<?= base_url('admin/beranda/hapus-gambar/' . $g['id']) ?>"
                                        data-type="Gambar">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>



                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <!-- Card untuk Tambah Gambar -->
                    <div class="col-md-4 mb-3">
                        <a href="<?= base_url('admin/beranda/tambah-gambar') ?>" class="text-decoration-none">
                            <div class="card shadow-sm rounded"
                                style="background: #f8f9fa; border: 1px solid #ddd; cursor: pointer; transition: all 0.3s ease;">
                                <div class="rounded-top d-flex justify-content-center align-items-center"
                                    style="height: 200px; background-color: #e9ecef;">
                                    <i class="fa-solid fa-plus fa-3x text-primary"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- end kelola background -->
        <!-- kelola media sosial -->
        <div class="card mb-4">
            <div class="card-body">
                <h2 class="mb-4">Kelola Media Sosial</h2>
                <?php if (session()->getFlashdata('success_media')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('success_media'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                    </div>
                <?php endif; ?>

                <div class="row">
                    <?php foreach ($media as $m) : ?>
                        <div class="col-md-3 mb-3">
                            <div class="card text-center shadow-sm">
                                <div class="card-body">
                                    <i class="fa-brands fa-<?= esc($m['icon']) ?> fa-2x text-primary mb-2"></i>
                                    <h5 class="card-title"><?= esc($m['nama']) ?></h5>
                                    <p><a href="<?= esc($m['link']) ?>" target="_blank"
                                            class="btn btn-sm btn-outline-primary">Lihat</a></p>
                                    <a href="<?= base_url('admin/beranda/edit-media/' . $m['id']) ?>"
                                        class="btn btn-sm btn-outline-success me-1"><i class="fa-solid fa-pen"></i></a>
                                    <button type="button"
                                        class="btn btn-sm btn-outline-danger btn-confirm-delete"
                                        data-bs-toggle="modal"
                                        data-bs-target="#confirmDeleteModal"
                                        data-id="<?= $m['id'] ?>"
                                        data-name="<?= esc($m['nama']) ?>"
                                        data-url="<?= base_url('admin/beranda/hapus-media/' . $m['id']) ?>"
                                        data-type="Media Sosial">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="col-md-3 mb-3">
                        <a href="<?= base_url('admin/beranda/tambah-media') ?>" class="text-decoration-none">
                            <div class="card shadow-sm text-center" style="cursor: pointer; background-color: #f1f3f5;">
                                <div class="card-body d-flex align-items-center justify-content-center"
                                    style="height: 150px;">
                                    <i class="fa-solid fa-plus fa-2x text-primary"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-danger">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="confirmDeleteLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    Anda yakin ingin menghapus <strong id="itemType"></strong>: <span id="itemName"></span>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form method="post" id="deleteForm">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



</main>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.btn-confirm-delete');
        const deleteForm = document.getElementById('deleteForm');
        const itemType = document.getElementById('itemType');
        const itemName = document.getElementById('itemName');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const name = this.getAttribute('data-name');
                const type = this.getAttribute('data-type');
                const url = this.getAttribute('data-url');

                itemType.textContent = type;
                itemName.textContent = name;
                deleteForm.setAttribute('action', url);
            });
        });
    });
</script>


<?= $this->endsection(); ?>