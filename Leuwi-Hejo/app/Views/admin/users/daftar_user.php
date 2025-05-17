<?= $this->extend('layout/template_admin'); ?>
<?= $this->section('content'); ?>


<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Tables</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
    For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official
        DataTables documentation</a>.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="tabel-user" width="100%" cellspacing="0">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Grup</th>
                        <th>Status</th>
                        <th>Terdaftar</th>
                    </tr>
                </thead>
                <tfoot class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Grup</th>
                        <th>Status</th>
                        <th>Terdaftar</th>
                    </tr>
                </tfoot>
                <tbody class="text-center">
                    <?php foreach ($users as $i => $user) : ?>
                        <tr>
                            <td><?= $i + 1 ?></td>

                            <!-- Foto Profil -->
                            <td>
                                <img src="<?= base_url('uploads/profile/' . ($user->image)) ?>" alt="Foto" width="40"
                                    height="40" class="rounded-circle">
                            </td>

                            <!-- Username -->
                            <td><?= esc($user->username) ?></td>

                            <!-- Email -->
                            <td><?= esc($user->email) ?></td>

                            <!-- Grup -->
                            <td>
                                <?php
                                $groupCount = count($user->groups);
                                $maxShown = 2; // jumlah maksimal grup yang ditampilkan
                                $shownGroups = array_slice($user->groups, 0, $maxShown);
                                ?>

                                <?php foreach ($shownGroups as $group): ?>
                                    <?php
                                    switch ($group) {
                                        case 'admin':
                                            $badgeClass = 'badge-danger';
                                            break;
                                        case 'super_admin':
                                            $badgeClass = 'badge-dark';
                                            break;
                                        case 'user':
                                            $badgeClass = 'badge-primary';
                                            break;
                                    }
                                    ?>
                                    <span class="badge <?= $badgeClass ?>"><?= esc(ucwords($group)) ?></span>
                                <?php endforeach; ?>

                            </td>

                            <!-- Status -->
                            <td>
                                <?php if ($user->active) : ?>
                                    <span class="badge badge-success">Aktif</span>
                                <?php else : ?>
                                    <span class="badge badge-secondary">Nonaktif</span>
                                <?php endif; ?>
                            </td>

                            <!-- Tanggal Daftar -->
                            <td><?= date('d M Y', strtotime($user->created_at)) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<?= $this->endSection(); ?>