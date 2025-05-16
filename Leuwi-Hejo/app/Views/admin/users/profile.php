<?= $this->extend('layout/template_admin') ?>
<?= $this->section('content') ?>

<div class="container-fluid px-4">
    <h2 class="mb-4">Profil Pengguna</h2>

    <div class="card shadow">
        <div class="card-body">
            <h5 class="card-title"><?= esc($user->username) ?></h5>
            <p class="card-text"><strong>Email:</strong> <?= esc($user->email) ?></p>
            <p class="card-text"><strong>Status:</strong>
                <?php if ($user->active): ?>
                    <span class="badge badge-success">Aktif</span>
                <?php else: ?>
                    <span class="badge badge-secondary">Nonaktif</span>
                <?php endif; ?>
            </p>
            <p class="card-text"><strong>Role:</strong>
                <?= implode(', ', array_column($groups, 'name')) ?>
            </p>

            <p class="card-text"><strong>Tanggal Daftar:</strong> <?= esc($user->created_at) ?></p>
        </div>
    </div>
</div>

<?= $this->endSection() ?>