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
    <button id="mark-all-read" class="btn btn-sm btn-outline-primary mb-3 enhanced-btn">
        <i class="bi bi-check2-all me-1"></i> Tandai Semua Dibaca
    </button>

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

                    <!-- Kiri: Foto profil + ikon -->
                    <div class="d-flex align-items-center justify-content-center me-3 position-relative">
                        <!-- Foto Profil -->
                        <img src="<?= base_url('uploads/profile/' . ($notif->actor_image ?: 'default.svg')) ?>"
                            alt="Foto" width="45" height="45"
                            class="rounded-circle shadow-sm border border-light me-2">

                        <!-- Ikon Bulat -->
                        <div class="icon-circle bg-<?= esc($notif->type) ?>">
                            <i class="<?= esc($notif->icon) ?> text-white"></i>
                        </div>

                        <!-- Dot Merah -->
                        <?php if (!$notif->is_read): ?>
                            <span class="notification-dot"></span>
                        <?php endif ?>
                    </div>

                    <!-- Kanan: Isi notifikasi -->
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-1 text-<?= esc($notif->type) ?>">
                                <?= esc($notif->title) ?>
                            </h6>
                            <small class="text-muted">
                                <?= Time::parse($notif->created_at)->humanize() ?>
                            </small>
                        </div>
                        <p class="mb-0 text-secondary small"><?= ($notif->message) ?></p>
                    </div>
                </a>

            <?php endforeach ?>
        <?php endif ?>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).on('click', '#mark-all-read', function() {
        $.post("<?= base_url('admin/notifications/mark-all-read') ?>", function(response) {
            if (response.status === 'success') {
                location.reload();
            } else {
                alert('Gagal menandai notifikasi.');
            }
        }).fail(function(xhr) {
            console.error(xhr.responseText);
            alert('Terjadi error saat mengirim request.');
        });
    });
</script>


<?= $this->endSection() ?>