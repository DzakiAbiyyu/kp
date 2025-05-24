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
                        <div class="col-sm-4 font-weight-bold">
                            <i class="fas fa-user text-primary mr-2"></i>Username
                        </div>
                        <div class="col-sm-8"><?= esc($user->username) ?></div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4 font-weight-bold">
                            <i class="fas fa-envelope text-danger mr-2"></i>Email
                        </div>
                        <div class="col-sm-8"><?= esc($user->email) ?></div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4 font-weight-bold">
                            <i class="fas fa-check-circle text-success mr-2"></i>Status
                        </div>
                        <div class="col-sm-8">
                            <?= $user->active ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-secondary">Nonaktif</span>' ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4 font-weight-bold">
                            <i class="fas fa-calendar-alt text-warning mr-2"></i>Terdaftar
                        </div>
                        <div class="col-sm-8"><?= date('d M Y', strtotime($user->created_at)) ?></div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4 font-weight-bold">
                            <i class="fas fa-users text-info mr-2"></i>Grup
                        </div>
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

                    <div class="row mb-3">
                        <div class="col-sm-4 font-weight-bold">
                            <i class="fab fa-whatsapp text-success mr-2"></i>Nomor WhatsApp
                        </div>
                        <div class="col-sm-8 d-flex justify-content-between align-items-center">
                            <div><?= esc($user->phone_number ?? '-') ?></div>
                            <?php if (empty($user->phone_number)) : ?>
                                <button class="btn btn-sm btn-outline-success ml-2" data-toggle="modal" data-target="#editWhatsAppModal" title="Tambahkan Nomor WhatsApp">
                                    <i class="fas fa-plus"></i>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4 font-weight-bold">
                            <i class="fas fa-map-marker-alt text-danger mr-2"></i>Alamat
                        </div>
                        <div class="col-sm-8 d-flex justify-content-between align-items-center">
                            <div><?= esc($user->address ?? '-') ?></div>
                            <?php if (empty($user->address)) : ?>
                                <button class="btn btn-sm btn-outline-danger ml-2" data-toggle="modal" data-target="#editAddressModal" title="Tambahkan Alamat">
                                    <i class="fas fa-plus"></i>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>

            <hr>
            <!-- Collapsable Edit Profile Card -->
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseEditProfile" class="d-block card-header py-3 bg-gradient-primary" data-toggle="collapse"
                    role="button" aria-expanded="true" aria-controls="collapseEditProfile">
                    <h6 class="m-0 font-weight-bold text-white"><i class="fas fa-user-edit"></i> Edit Profil</h6>
                </a>

                <!-- Card Content - Collapse -->
                <?php $showCard = session()->getFlashdata('show_edit_card'); ?>
                <div class="collapse <?= $showCard ? 'show' : '' ?>" id="collapseEditProfile">
                    <!-- <div class="collapse" id="collapseEditProfile"> -->
                    <div class="card-body">
                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                        <?php endif ?>

                        <?php if (session()->getFlashdata('info')): ?>
                            <div class="alert alert-info"><?= session()->getFlashdata('info') ?></div>
                        <?php endif ?>

                        <?php if (session()->getFlashdata('errors')): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                        <li><?= esc($error) ?></li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        <?php endif ?>

                        <form action="<?= base_url('admin/profile/update') ?>" method="post">
                            <?= csrf_field() ?>

                            <div class="mb-3 row">
                                <label for="username" class="col-sm-3 col-form-label fw-semibold">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" name="username" id="username" class="form-control"
                                        value="<?= old('username', $user->username) ?>" placeholder="Masukkan username baru">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="email" class="col-sm-3 col-form-label fw-semibold">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" id="email" class="form-control"
                                        value="<?= old('email', $user->email) ?>" placeholder="Masukkan email baru">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="phone_number" class="col-sm-3 col-form-label fw-semibold">No WhatsApp</label>
                                <div class="col-sm-9">
                                    <input type="number" name="phone_number" id="phone_number" class="form-control"
                                        value="<?= old('phone_number', $user->phone_number) ?>" placeholder="Masukkan Nomor WhatsApp Baru">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="address" class="col-sm-3 col-form-label fw-semibold">Alamat</label>
                                <div class="col-sm-9">
                                    <input type="text-area" name="address" id="address" class="form-control"
                                        value="<?= old('address', $user->address) ?>" placeholder="Masukkan alamat Baru">
                                </div>
                            </div>


                            <div class="text-end">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>







<!-- Modal WhatsApp -->
<div class="modal fade" id="editWhatsAppModal" tabindex="-1" role="dialog" aria-labelledby="whatsappModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url('admin/profile/update') ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="field" value="phone_number">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="whatsappModalLabel">Tambah Nomor WhatsApp</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" name="value" placeholder="Contoh: 081234567890" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Alamat -->
<div class="modal fade" id="editAddressModal" tabindex="-1" role="dialog" aria-labelledby="addressModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url('admin/profile/update') ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="field" value="address">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addressModalLabel">Tambah Alamat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <textarea class="form-control" name="value" rows="3" placeholder="Tulis alamat lengkap..." required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Simpan</button>
                </div>
            </div>
        </form>
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