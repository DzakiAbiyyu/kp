<?php

/** @var array $notifications */
/** Halaman: admin/notifications/index.php */

use CodeIgniter\I18n\Time;

?>

<?= $this->extend('layout/template_admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2 class="mb-4">Daftar Notifikasi</h2>

    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success"><?= session('message') ?></div>
    <?php endif ?>

    <div class="list-group">
        <?php if (empty($notifications)): ?>
            <div class="text-center text-muted py-5">
                <i class="fas fa-bell-slash fa-2x mb-2"></i><br>
                Belum ada notifikasi.
            </div>
        <?php else: ?>
            <?php foreach ($notifications as $notif): ?>
                <a href="<?= base_url('admin/notifications/read/' . $notif->notification_id) ?>"
                    class="list-group-item list-group-item-action d-flex align-items-start <?= $notif->is_read ? '' : 'unread-notification' ?>">
                    <div class="mr-3 position-relative">
                        <img src="<?= base_url('uploads/profile/' . ($notif->actor_image)) ?>"
                            alt="Foto" width="45" height="45"
                            class="rounded-circle shadow-sm border border-light">

                        <?php if (!$notif->is_read): ?>
                            <span class="notification-dot"></span>
                        <?php endif ?>
                    </div>

                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-1 text-<?= $notif->type ?>">
                                <i class="<?= esc($notif->icon) ?>"></i> <?= esc($notif->title) ?>
                            </h6>
                            <small class="text-muted">
                                <?= Time::parse($notif->created_at)->humanize() ?>
                            </small>
                        </div>
                        <p class="mb-0 text-secondary small"><?= $notif->message ?> </p>
                    </div>
                </a>
            <?php endforeach ?>
        <?php endif ?>
    </div>
</div>

<?= $this->endSection() ?>