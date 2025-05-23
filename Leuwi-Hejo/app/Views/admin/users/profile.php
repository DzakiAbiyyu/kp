<?= $this->extend('layout/template_admin') ?>
<?= $this->section('content') ?>

<?php
// Ambil data user langsung dari database, agar image paling baru digunakan
$userModel = new \Myth\Auth\Models\UserModel();
$user = $userModel->find(user()->id);
?>

<div class="container mt-4">
    <h2 class="mb-4">Profil Pengguna</h2>

    <?php if ($msg = session()->getFlashdata('message')): ?>
        <div class="alert alert-success"><?= $msg ?></div>
    <?php elseif ($err = session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= $err ?></div>
    <?php endif ?>





    <div class="row align-items-start">
        <!-- CARD FOTO PROFIL -->
        <div class="col-lg-4 mb-4">
            <div class="card text-center shadow-sm p-3">
                <img id="preview-image" src="<?= base_url('uploads/profile/' . $user->image) . '?v=' . time() ?>"
                    class="rounded-circle border border-3 shadow mb-3" width="160" height="160" style="object-fit: cover;">

                <form action="<?= base_url('admin/profile/update-image') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <input type="file" name="image" class="form-control" accept="image/*" onchange="previewFile(this)" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm mb-2 w-100">
                        <i class="fas fa-upload"></i> Upload Foto
                    </button>
                </form>

                <?php if ($user->image !== 'default.svg') : ?>
                    <form action="<?= base_url('admin/profile/remove-image') ?>" method="post">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                            <i class="fas fa-trash-alt"></i> Hapus Foto
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </div>

        <!-- CARD INFO USER -->
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4 font-weight-bold">Username</div>
                        <div class="col-sm-8"><?= esc($user->username) ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 font-weight-bold">Email</div>
                        <div class="col-sm-8"><?= esc($user->email) ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 font-weight-bold">Status</div>
                        <div class="col-sm-8">
                            <?= $user->active ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-secondary">Nonaktif</span>' ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 font-weight-bold">Terdaftar</div>
                        <div class="col-sm-8"><?= date('d M Y', strtotime($user->created_at)) ?></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 font-weight-bold">Grup</div>
                        <div class="col-sm-8">
                            <?php
                            foreach ($groups as $group) {
                                $name = $group['name'];
                                switch ($name) {
                                    case 'admin':
                                        $color = 'primary';
                                        break;
                                    case 'super_admin':
                                        $color = 'info';
                                        break;
                                    case 'user':
                                        $color = 'success';
                                        break;
                                    default:
                                        $color = 'secondary';
                                }

                                echo '<span class="badge badge-' . $color . ' mr-1">' . esc(ucwords(str_replace('_', ' ', $name))) . '</span>';
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <h5>Edit Informasi</h5>
            <form action="<?= base_url('admin/profile/update-info') ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" value="<?= esc($user->username) ?>" required>
                </div>
                <div class="form-group mt-2">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= esc($user->email) ?>" required>
                </div>
                <button type="submit" class="btn btn-warning mt-3">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</div>


<!-- PREVIEW JS -->
<script>
    $('.custom-file-input').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    function previewFile(input) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-image').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
</script>

<?= $this->endSection() ?>