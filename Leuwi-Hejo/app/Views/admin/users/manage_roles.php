<?= $this->extend('layout/template_admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <h2 class="mb-4 text-center">Manajemen Role & Status User</h2>

    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success text-center"><?= session('message') ?></div>
    <?php elseif (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger text-center"><?= session('error') ?></div>
    <?php endif ?>
    <div class="card mb-4">
        <div class="card-header bg-light">
            <strong>Anda sedang login sebagai:</strong>
        </div>
        <div class="card-body">
            <div class="card-body d-flex flex-wrap align-items-center">
                <!-- Foto Profil -->
                <div class="me-4 mb-3 mb-md-0 text-center">
                    <img src="<?= base_url('uploads/profile/' . (!empty($currentUser->image) ? $currentUser->image : 'default.png')) ?>"
                        alt="Foto Profil" class="rounded-circle border shadow-sm"
                        width="100" height="100">
                </div>

                <!-- Informasi Akun -->
                <div>
                    <p class="mb-1"><strong>Username:</strong> <?= esc($currentUser->username) ?></p>
                    <p class="mb-1"><strong>Email:</strong> <?= esc($currentUser->email) ?></p>
                    <p class="mb-1"><strong>Role:</strong></p>

                    <!-- Badge Role -->
                    <div class="d-flex flex-wrap gap-2 mt-1">
                        <?php foreach ($currentUser->groups as $group): ?>
                            <?php
                            $badgeClass = 'bg-secondary';
                            $icon = 'fas fa-user';

                            if ($group === 'admin') {
                                $badgeClass = 'bg-danger';
                                $icon = 'fas fa-user-shield';
                            } elseif ($group === 'super_admin') {
                                $badgeClass = 'bg-dark';
                                $icon = 'fas fa-crown';
                            } elseif ($group === 'user') {
                                $badgeClass = 'bg-info';
                                $icon = 'fas fa-user';
                            }
                            ?>
                            <span class="badge text-white <?= $badgeClass ?> d-inline-flex align-items-center px-2 py-1" title="<?= ucfirst($group) ?>">
                                <i class="<?= $icon ?> me-1"></i> <?= ucfirst(str_replace('_', ' ', $group)) ?>
                            </span>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="table-responsive">
        <table class="table table-hover text-center">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $i => $user): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= esc($user->username) ?></td>
                        <td><?= esc($user->email) ?></td>
                        <td>
                            <form action="<?= base_url('admin/users/update-role') ?>" method="post"
                                class="d-flex align-items-center justify-content-between flex-wrap"
                                data-role-form>
                                <?= csrf_field() ?>
                                <input type="hidden" name="user_id" value="<?= $user->id ?>">

                                <div class="d-flex flex-wrap gap-2">
                                    <?php foreach ($allGroups as $group): ?>
                                        <div class="form-check form-check-inline m-0">
                                            <input class="form-check-input <?= $group->name ?>" type="checkbox" name="roles[]"
                                                value="<?= $group->name ?>"
                                                id="role_<?= $user->id . '_' . $group->name ?>"
                                                <?= in_array($group->name, $user->groups) ? 'checked' : '' ?>
                                                <?= $currentUser->id == $user->id ? 'disabled' : '' ?>
                                                data-bs-toggle="tooltip"
                                                title="Tandai untuk memberikan akses <?= ucfirst($group->name) ?>">
                                            <label class="form-check-label small" for="role_<?= $user->id . '_' . $group->name ?>">
                                                <?= ucfirst(str_replace('_', ' ', $group->name)) ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <div class="ms-2 mt-2 mt-md-0 d-flex gap-2">
                                    <button type="submit" class="btn btn-sm btn-primary btn-submit" <?= $currentUser->id == $user->id ? 'disabled' : '' ?>>
                                        <i class="fas fa-save me-1"></i> Ubah
                                    </button>
                                    <button class="btn btn-sm btn-secondary btn-reset" <?= $currentUser->id == $user->id ? 'disabled' : '' ?>>
                                        Reset
                                    </button>
                                </div>
                            </form>

                        </td>

                        <td>
                            <?= $user->active ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-secondary">Nonaktif</span>' ?>
                        </td>
                        <td>
                            <form action="<?= base_url('admin/users/toggle-status') ?>" method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="user_id" value="<?= $user->id ?>">
                                <button type="submit" class="btn btn-sm btn-warning" <?= $currentUser->id == $user->id ? 'disabled' : '' ?>>
                                    <?= $user->active ? 'Nonaktifkan' : 'Aktifkan' ?>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>