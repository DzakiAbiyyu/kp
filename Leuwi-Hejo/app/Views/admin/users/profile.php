<?= $this->extend('layout/template_admin') ?>
<?= $this->section('content') ?>

<?php
// Ambil data user langsung dari database, agar image paling baru digunakan
$userModel = new \Myth\Auth\Models\UserModel();
$user = $userModel->find(user()->id);
?>

<div class="container mt-4">
    <h2>Profil Pengguna</h2>

    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success"><?= session('message') ?></div>
    <?php endif; ?>

    <div class="row">
        <!-- CARD FOTO PROFIL -->
        <div class="col-md-4 mb-3">
            <div class="card text-center shadow">
                <div class="card-body">
                    <!-- Preview Gambar -->
                    <img id="preview-image" src="<?= base_url('uploads/profile/' . $user->image) . '?v=' . time() ?>"
                        width="150" height="150" class="rounded-circle shadow mb-3">

                    <!-- Form Upload -->
                    <form action="<?= base_url('admin/profile/update-image') ?>" method="post" enctype="multipart/form-data" class="mb-2">
                        <?= csrf_field() ?>
                        <div class="custom-file mb-2 text-left">
                            <input type="file" name="image" class="custom-file-input" id="customFile" accept="image/*" onchange="previewFile(this)" required>
                            <label class="custom-file-label" for="customFile">Pilih Foto</label>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <button type="submit" class="btn btn-sm btn-primary btn-block">
                                    <i class="fas fa-upload"></i> Upload Foto
                                </button>
                            </div>

                            <?php if ($user->image !== 'default.svg') : ?>
                                <div class="col">
                                    <form action="<?= base_url('admin/profile/remove-image') ?>" method="post">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-outline-danger btn-block">
                                            <i class="fas fa-trash-alt"></i> Hapus Foto
                                        </button>
                                    </form>
                                </div>
                            <?php endif; ?>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- CARD INFO USER -->
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Username</th>
                            <td><?= esc($user->username) ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?= esc($user->email) ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <?= $user->active ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-secondary">Nonaktif</span>' ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Terdaftar</th>
                            <td><?= date('d M Y', strtotime($user->created_at)) ?></td>
                        </tr>
                        <tr>
                            <th>Grup</th>
                            <td>
                                <?php
                                $groupModel = new \Myth\Auth\Models\GroupModel();
                                $groups = $groupModel->getGroupsForUser($user->id);
                                foreach ($groups as $group) {
                                    echo '<span class="badge badge-primary mr-1">' . esc(ucwords($group['name'])) . '</span>';
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
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