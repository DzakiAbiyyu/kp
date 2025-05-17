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
            <p><strong>Username:</strong> <?= esc($currentUser->username) ?></p>
            <p><strong>Email:</strong> <?= esc($currentUser->email) ?></p>
            <p><strong>Role:</strong>
                <?php foreach ($currentUser->groups as $group): ?>
                    <span class="badge badge-info"><?= esc($group) ?></span>
                <?php endforeach ?>
            </p>
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
                            <form action="<?= base_url('admin/users/update-role') ?>" method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="user_id" value="<?= $user->id ?>">
                                <div class="d-flex flex-wrap justify-content-center mb-2">
                                    <?php foreach ($allGroups as $group): ?>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="roles[]" value="<?= $group->name ?>"
                                                id="role_<?= $user->id . '_' . $group->name ?>"
                                                <?= in_array($group->name, $user->groups) ? 'checked' : '' ?>
                                                <?= $currentUser->id == $user->id ? 'disabled' : '' ?>>
                                            <label class="form-check-label small" for="role_<?= $user->id . '_' . $group->name ?>">
                                                <?= ucfirst($group->name) ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary" <?= $currentUser->id == $user->id ? 'disabled' : '' ?>>Ubah</button>
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