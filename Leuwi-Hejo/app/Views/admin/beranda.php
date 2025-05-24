<?= $this->extend('layout/template_admin'); ?>
<?= $this->section('content'); ?>


<div class="container-fluid px-4">
    <h1 class="mt-4">Manajemen Beranda</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="<?= base_url('admin/'); ?>" class="text-decoration-none">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Beranda</li>
    </ol>

    <!-- Kelola Konten -->
    <div class="card mb-4 shadow-sm" data-aos="fade-up">
        <div class="card-body">
            <h2>Kelola Konten Halaman Beranda</h2>
            <div class="table-responsive-sm">




                <table class="table table-bordered table-hover text-nowrap" width="100%" cellspacing="0">
                    <thead class="bg-gradient-primary">
                        <tr data-aos="fade-right" data-aos-delay="100">
                            <th class="text-center">Judul</th>
                            <th class="text-center">Deskripsi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($konten as $k) : ?>
                            <tr data-aos="fade-right" data-aos-delay="100">
                                <td class="text-center text-truncate" style="max-width: 150px;"><?= esc($k['title']); ?></td>
                                <td class="text-center text-truncate" style="max-width: 200px;"><?= esc($k['body']); ?></td>
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
    </div>

    <!-- Kelola Background -->
    <div class="card mb-4 shadow-sm" data-aos="fade-up">

        <div class="card-body">
            <h2 class="mb-4">Kelola Background Halaman Beranda</h2>
            <div class="row d-flex">
                <?php foreach ($gambar as $g) : ?>


                    <div class="col-12 col-sm-6 col-md-4 mb-3" data-aos="zoom-in">
                        <div class="card shadow-sm rounded hover-scale bg-light"
                            style="transition: transform 0.3s ease;">
                            <img src="<?= base_url($g['gambar']) ?>" alt="Background"
                                class="card-img-top rounded-top"
                                style="width: 100%; height: 200px; object-fit: cover;">
                            <div class="card-body text-center">
                                <a href="<?= base_url('admin/beranda/edit-gambar/' . $g['id']) ?>"
                                    class="btn btn-outline-primary btn-sm mr-2">
                                    <i class="fa fa-pen fa-lg"></i>
                                </a>
                                <button type="button"
                                    class="btn btn-sm btn-outline-danger btn-confirm-delete"
                                    data-id="<?= $g['id'] ?>"
                                    data-name="<?= esc($g['slug']) ?>"
                                    data-url="<?= base_url('admin/beranda/hapus-gambar/' . $g['id']) ?>"
                                    data-type="Gambar">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>


                <?php endforeach; ?>

                <!-- Card untuk Tambah Gambar -->
                <div class="col-12 col-sm-6 col-md-4 mb-3" data-aos="zoom-in-up" data-aos-delay="200">
                    <a href="<?= base_url('admin/beranda/tambah-gambar') ?>" class="text-decoration-none">
                        <div class="card shadow-sm rounded bg-light hover-scale"
                            style="cursor: pointer; transition: all 0.3s ease;">
                            <div class="rounded-top d-flex justify-content-center align-items-center"
                                style="height: 200px; background-color: #e9ecef;">
                                <i class="fa fa-plus fa-3x text-primary"></i>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>

    <!-- end kelola background -->
    <!-- kelola media sosial -->
    <div class="card mb-4 shadow-sm" data-aos="fade-up">

        <div class="card-body">
            <h2 class="mb-4">Kelola Media Sosial</h2>




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
                                    data-id="<?= $m['id'] ?>"
                                    data-name="<?= esc($m['nama']) ?>"
                                    data-url="<?= base_url('admin/beranda/hapus-media/' . $m['id']) ?>"
                                    data-type="Media Sosial">
                                    <i class="fa fa-trash"></i>
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
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-danger">

            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="confirmDeleteLabel">Konfirmasi Hapus</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                Anda yakin ingin menghapus <strong id="itemType"></strong>: <span id="itemName"></span>?
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form method="post" id="deleteForm">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- sweet alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const deleteButtons = document.querySelectorAll('.btn-confirm-delete');
        const deleteForm = document.getElementById('deleteForm');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const name = this.getAttribute('data-name');
                const type = this.getAttribute('data-type');
                const url = this.getAttribute('data-url');

                Swal.fire({
                    title: `Hapus ${type}?`,
                    text: `${type} "${name}" akan dihapus secara permanen.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteForm.setAttribute('action', url);
                        deleteForm.submit();
                    }
                });
            });
        });
    });
</script>
<form id="deleteForm" method="post" style="display: none;">
    <?= csrf_field() ?>
</form>



<!-- AOS Animation -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true
    });
</script>


<?= $this->endsection(); ?>