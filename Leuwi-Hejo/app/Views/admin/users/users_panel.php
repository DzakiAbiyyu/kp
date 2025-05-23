<?= $this->extend('layout/template_admin') ?>
<?= $this->section('content') ?>

<!-- Tambahkan animate.css (opsional) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard User Panel</h1>
    </div>

    <div class="row">

        <?php
        $cards = [
            ['label' => 'Total Pengguna', 'count' => $totalUser, 'icon' => 'users', 'color' => 'primary'],
            ['label' => 'User Aktif', 'count' => $activeUser, 'icon' => 'user-check', 'color' => 'success'],
            ['label' => 'User Nonaktif', 'count' => $nonActiveUser, 'icon' => 'user-slash', 'color' => 'secondary'],
            ['label' => 'Jumlah Admin', 'count' => $adminCount, 'icon' => 'user-tie', 'color' => 'info'],
            ['label' => 'Super Admin', 'count' => $superAdminCount, 'icon' => 'crown', 'color' => 'danger'],
            ['label' => 'User Biasa', 'count' => $regularUserCount, 'icon' => 'user', 'color' => 'warning'],
        ];
        ?>

        <?php foreach ($cards as $card): ?>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-<?= $card['color'] ?> shadow h-100 py-2 animate__animated animate__fadeInUp position-relative">
                    <div class="card-body">
                        <div class="text-center">
                            <div class="text-xs font-weight-bold text-<?= $card['color'] ?> text-uppercase mb-2"><?= $card['label'] ?></div>
                            <h2 class="display-4 font-weight-bold text-dark count-up" data-count="<?= $card['count'] ?>">0</h2>
                        </div>
                        <div class="position-absolute" style="top: 1rem; right: 1rem;">
                            <i class="fas fa-<?= $card['icon'] ?> fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <?php if ($card['label'] === 'User Aktif'): ?>
                        <div class="position-absolute d-flex"
                            style="bottom: 0.75rem; right: 0.75rem;">
                            <?php
                            $maxShown = 4;
                            $shownUsers = array_slice($activeUsers, 0, $maxShown);
                            $remaining = count($activeUsers) - $maxShown;
                            ?>

                            <?php foreach ($shownUsers as $u): ?>
                                <img src="<?= base_url('uploads/profile/' . ($u->image ?: 'default.svg')) ?>"
                                    class="rounded-circle border border-white shadow-sm"
                                    style="width: 30px; height: 30px; object-fit: cover; margin-left: -8px;"
                                    title="<?= esc($u->username) ?>">
                            <?php endforeach; ?>

                            <?php if ($remaining > 0): ?>
                                <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center border border-white shadow-sm"
                                    style="width: 30px; height: 30px; margin-left: -8px; font-size: 0.75rem; cursor: pointer;"
                                    data-toggle="modal" data-target="#activeUsersModal"
                                    title="<?= $remaining ?> lainnya">
                                    +<?= $remaining ?>
                                </div>

                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        <?php endforeach ?>

    </div>
</div>


<!-- Modal: Daftar User Aktif -->
<div class="modal fade" id="activeUsersModal" tabindex="-1" role="dialog" aria-labelledby="activeUsersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="activeUsersModalLabel">User Aktif (<?= count($activeUsers) ?>)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php foreach ($activeUsers as $u): ?>
                    <div class="d-flex align-items-center mb-2">
                        <img src="<?= base_url('uploads/profile/' . ($u->image ?: 'default.svg')) ?>"
                            class="rounded-circle mr-2" style="width: 36px; height: 36px; object-fit: cover;">
                        <div>
                            <strong><?= esc($u->username) ?></strong><br>
                            <small class="text-muted"><?= esc($u->email) ?></small>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


<!-- jQuery sudah di-include -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Count-up script -->
<script>
    $(document).ready(function() {
        $('.count-up').each(function() {
            var $this = $(this);
            var countTo = parseInt($this.attr('data-count')) || 0;
            $({
                countNum: 0
            }).animate({
                countNum: countTo
            }, {
                duration: 1500,
                easing: 'swing',
                step: function() {
                    $this.text(Math.floor(this.countNum));
                },
                complete: function() {
                    $this.text(this.countNum);
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>