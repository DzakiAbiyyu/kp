<?= $this->extend('layout/template_admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h3>Log Perubahan Role</h3>
    <div class="table-responsive">
        <table class="table table-hover table-sm mt-3 text-center align-middle">
            <thead class="bg-gradient-primary text-center">
                <tr>
                    <th>#</th>
                    <th>Oleh</th>
                    <th>Target</th>
                    <th>Role Lama</th>
                    <th>Role Baru</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($logs as $i => $log): ?>
                    <tr>
                        <td class="text-center"><?= $i + 1 ?></td>
                        <td><?= esc($log->changer_name) ?></td>
                        <td><?= esc($log->target_name) ?></td>
                        <td>
                            <?php foreach (json_decode($log->old_roles) as $role): ?>
                                <span class="badge badge-secondary"><?= esc($role) ?></span>
                            <?php endforeach ?>
                        </td>
                        <td>
                            <?php foreach (json_decode($log->new_roles) as $role): ?>
                                <span class="badge badge-success"><?= esc($role) ?></span>
                            <?php endforeach ?>
                        </td>
                        <td class="text-nowrap"><?= date('d M Y H:i', strtotime($log->changed_at)) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>